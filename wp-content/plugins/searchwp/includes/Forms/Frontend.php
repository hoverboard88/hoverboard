<?php

namespace SearchWP\Forms;

use SearchWP\Settings;
use SearchWP\Source;
use SearchWP\Utils;

/**
 * Display search forms on the frontend.
 *
 * @since 4.3.2
 */
class Frontend {

	/**
	 * Init.
	 *
	 * @since 4.3.2
	 */
	public function init() {

		add_shortcode( 'searchwp_form', [ __CLASS__, 'render' ] );

		$this->hooks();
	}

	/**
	 * Hooks.
	 *
	 * @since 4.3.2
	 */
	public function hooks() {

		self::register_gutenberg_block();

		if ( version_compare( get_bloginfo( 'version' ), '5.8', '>=' ) ) {
			add_filter( 'block_categories_all', [ __CLASS__, 'register_gutenberg_block_category' ] );
		} else {
			add_filter( 'block_categories', [ __CLASS__, 'register_gutenberg_block_category' ] );
		}

		add_action( 'wp_enqueue_scripts', [ __CLASS__, 'assets' ] );

		add_filter( 'searchwp\native\args', [ __CLASS__, 'set_native_search_engine' ] );

		add_filter( 'searchwp\query\mods', [ __CLASS__, 'taxonomy_mod' ], 20, 2 );
		add_filter( 'searchwp\query\mods', [ __CLASS__, 'author_mod' ], 20, 2 );
		add_filter( 'searchwp\query\mods', [ __CLASS__, 'post_type_mod' ], 20, 2 );

		add_action( 'searchwp\get_global_excerpt\the_content\before', function () {
			add_filter( 'pre_render_block', [ __CLASS__, 'disable_block_render' ], 10, 2 );
			add_filter( 'pre_do_shortcode_tag', [ __CLASS__, 'disable_shortcode_render' ], 10, 2 );
		} );

		add_action( 'searchwp\get_global_excerpt\the_content\after', function () {
			remove_filter( 'pre_render_block', [ __CLASS__, 'disable_block_render' ] );
			remove_filter( 'pre_do_shortcode_tag', [ __CLASS__, 'disable_shortcode_render' ] );
		} );
	}

	/**
	 * Register Search Forms Gutenberg block.
	 *
	 * @since 4.3.2
	 */
	private static function register_gutenberg_block() {

		register_block_type( SEARCHWP_PLUGIN_DIR . '/assets/gutenberg/build/search-form', [ 'render_callback' => [ __CLASS__, 'render' ] ] );

		wp_localize_script('searchwp-search-form-editor-script', 'searchwpForms', Storage::get_all() );
	}

	/**
	 * Add a block category for SearchWP if it doesn't exist already.
     *
     * @since 4.3.4
	 *
	 * @param array $categories Array of block categories.
	 *
	 * @return array
	 */
	public static function register_gutenberg_block_category( $categories ) {
		$category_slugs = wp_list_pluck( $categories, 'slug' );
		return in_array( 'searchwp', $category_slugs, true ) ? $categories : array_merge(
			$categories,
			array(
				array(
					'slug'  => 'searchwp',
					'title' => 'SearchWP',
					'icon'  => null,
				),
			)
		);
	}

	/**
	 * Load frontend assets.
	 *
	 * @since 4.3.2
	 */
	public static function assets() {

		// If WP is in script debug, or we pass ?script_debug in a URL - set debug to true.
		$debug = Utils::get_debug_assets_suffix();

		wp_register_style(
			'searchwp-forms',
			SEARCHWP_PLUGIN_URL . "assets/css/frontend/search-forms{$debug}.css",
			[],
			SEARCHWP_VERSION
		);

		wp_register_script(
			'searchwp-forms',
			SEARCHWP_PLUGIN_URL . "assets/js/frontend/search-forms{$debug}.js",
			[ 'jquery' ],
			SEARCHWP_VERSION,
			true
		);

		global $post;

		if ( ! is_a( $post, 'WP_Post' ) ) {
			return;
		}

		if ( ! has_shortcode( $post->post_content, 'searchwp_form' ) ) {
			return;
		}

		wp_enqueue_style( 'searchwp-forms' );
		wp_enqueue_script( 'searchwp-forms' );
	}

	/**
	 * Render form.
	 *
	 * @since 4.3.2
	 *
	 * @param array $args Args from a shortcode or a Gutenberg block.
	 */
	public static function render( $args ) {

		// Make sure the form contents doesn't get indexed.
		if ( did_action( 'searchwp\indexer\batch' ) ) {
			return '';
		}

		$form_id = isset( $args['id'] ) ? absint( $args['id'] ) : 0;

		if ( empty( $form_id ) ) {
			return '';
		}

		$form = Storage::get( $form_id );

		if ( empty( $form ) ) {
			return '';
		}

		if ( ! wp_style_is( 'searchwp-forms', 'enqueued' ) ) {
			wp_print_styles( [ 'searchwp-forms' ] );
		}

		if ( ! wp_script_is( 'searchwp-forms', 'enqueued' ) ) {
			wp_enqueue_script( 'searchwp-forms' );
		}

		ob_start();

		self::display_styles( $form );

		$target_url = ! empty( $form['target_url'] ) ? $form['target_url'] : false;

		if ( empty( $target_url ) ) {

			$target_page = isset( $form['target-page'] ) ? $form['target-page'] : false;
			$target_url  = ! empty( $target_page ) && is_numeric( $target_page ) ? get_permalink( $target_page ) : home_url( '/' );
		}

		?>
		<form id="<?php echo esc_attr( self::get_form_element_id( $form ) ); ?>" role="search" method="get" class="searchwp-form" action="<?php echo esc_url( $target_url ); ?>">
			<input type="hidden" name="swp_form[form_id]" value="<?php echo absint( $form_id ); ?>">
			<div class="swp-flex--col swp-flex--wrap swp-flex--gap-md">
				<div class="swp-flex--row swp-items-stretch swp-flex--gap-md">
					<div class="searchwp-form-input-container swp-items-stretch">
						<?php if ( ! empty( $form['category-search'] ) && ! empty( $form['category'] ) ) : ?>
							<select class="swp-select" name="swp_tax_limiter[category]">
								<option value=""><?php esc_html_e( 'Any Category', 'searchwp' ); ?></option>
								<?php foreach ( $form['category'] as $category_id ) : ?>
									<?php $category = get_term( $category_id, 'category' ); ?>
                                    <?php if ( $category instanceof \WP_Term ) : ?>
                                        <?php $selected_category_id = ! empty( $_GET['swp_tax_limiter']['category'] ) ? absint( $_GET['swp_tax_limiter']['category'] ) : 0; ?>
                                        <option value="<?php echo absint( $category->term_id ); ?>"<?php selected( $category->term_id, $selected_category_id ); ?>><?php echo esc_html( $category->name ); ?></option>
                                    <?php endif; ?>
								<?php endforeach; ?>
							</select>
						<?php endif; ?>

						<?php $search_input_name = ! empty( $form['input_name'] ) ? $form['input_name'] : 's'; ?>
						<?php $search_query = ! empty( $_GET[ $search_input_name ] ) ? sanitize_text_field( wp_unslash( $_GET[ $search_input_name ] ) ) : get_search_query(); ?>
						<input type="search"
                               class="swp-input--search swp-input"
						       placeholder="<?php echo esc_attr( $form['field-label'] ); ?>"
						       value="<?php echo esc_attr( $search_query ); ?>"
                               name="<?php echo esc_attr( $search_input_name ); ?>"
						       title="<?php echo esc_attr( $form['field-label'] ); ?>"
							<?php
							if ( function_exists( 'searchwp_live_search' ) && searchwp_live_search()->get( 'Settings_Api' )->get( 'enable-live-search' ) ) {
								echo ' data-swplive="true"';
								echo ' data-swpengine="' . ( ! empty( $form['engine'] ) ? esc_attr( $form['engine'] ) : 'default' ) . '"';
							}
							?>
                        />
					</div>

					<?php if ( ! empty( $form['search-button'] ) ) : ?>
						<input type="submit" class="search-submit swp-button" value="<?php echo esc_attr( ! empty( $form['button-label'] ) ? $form['button-label'] : __( 'Search', 'searchwp' ) ); ?>"/>
					<?php endif; ?>

				</div>

				<?php if ( ! empty( $form['advanced-search'] ) && ! empty( $form['advanced-search-filters'] ) ) : ?>
					<?php $is_advanced_filter_selected = ! empty( $_GET['swp_tax_limiter']['post_tag'] ) || ! empty( $_GET['swp_author_limiter'] ) || ! empty( $_GET['swp_post_type_limiter'] ); ?>
					<label class="swp-toggle swp-flex--row swp-margin-l-auto swp-flex--gap-md">
						<input class="swp-toggle-checkbox" type="checkbox" autocomplete="off" disabled <?php checked( $is_advanced_filter_selected ); ?>/>
						<div class="swp-toggle-switch swp-toggle-switch--mini"></div>
						<span class="swp-p">
							<?php esc_html_e( 'Advanced Search', 'searchwp' ); ?>
						</span>
					</label>
					<div class="searchwp-form-advanced-filters swp-flex--row swp-flex--gap-sm"<?php echo empty( $is_advanced_filter_selected ) ? 'style="display: none;"' : ''; ?>>
						<?php // TODO: Pack all form filter data into one variable to declutter $_POST. ?>
						<?php
							foreach ( $form['advanced-search-filters'] as $filter_name ) {
								$method_name = 'render_' . $filter_name . '_select';
								if ( method_exists( __CLASS__, $method_name ) ) {
									call_user_func( [ __CLASS__, $method_name ], $form );
								}
							}
						?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $form['quick-search'] ) && ! empty( $form['quick-search-items'] ) ) : ?>
					<div class="searchwp-form-quick-search">
						<span><?php esc_html_e( 'Popular searches', 'searchwp' ); ?>: </span>
						<?php foreach ( $form['quick-search-items'] as $item ) : ?>
                            <?php
                            $quick_search_link = add_query_arg(
                                [
									'swp_form' => [ 'form_id' => $form_id ],
									! empty( $form['input_name'] ) ? $form['input_name'] : 's' => esc_attr( $item ),
                                ],
								$target_url
                            );
                            ?>
							<a href="<?php echo esc_url( $quick_search_link ); ?>" class=""><?php echo esc_html( $item ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>
			<?php
			/**
			 * Fires after the search form fields.
			 *
			 * @since 4.3.16
			 *
			 * @param array $form Form data.
			 */
			do_action( 'searchwp\search_form\fields\after', $form );
			?>
		</form>
		<?php

		return ob_get_clean();
	}

	/**
	 * Render authors select element.
	 *
	 * @since 4.3.2
	 *
	 * @param array $form Form data.
	 * @param array $args Args for get_users().
	 */
	private static function render_authors_select( $form, $args = [] ) {

		$authors = self::get_authors( $form, $args );

		if ( empty( $authors ) ) {
			return;
		}

		$is_advanced_filter_selected = ! empty( $_GET['swp_tax_limiter']['post_tag'] ) || ! empty( $_GET['swp_author_limiter'] ) || ! empty( $_GET['swp_post_type_limiter'] );

		$selected_author_id = ! empty( $_GET['swp_author_limiter'] ) ? absint( $_GET['swp_author_limiter'] ) : 0;

		$return  = '<select class="swp-select" name="swp_author_limiter"' . disabled( ! $is_advanced_filter_selected, true, false ) . '>';
		$return .= '<option value="">' . __( 'Any Author', 'searchwp' ) . '</option>';

		foreach ( $authors as $author_id => $author ) {

			$option = sprintf(
				'<option value="%1$d" title="%2$s"%3$s>%4$s</option>',
				absint( $author_id ),
				/* translators: %s: Author's display name. */
				esc_attr( sprintf( __( 'Posts by %s' ), $author['display_name'] ) ),
				selected( $author_id, $selected_author_id, false ),
				$author['full_name']
			);

			$return .= $option;
		}

		$return .= '</select>';

		echo $return;
	}

	/**
	 * Render tags select element.
	 *
	 * @since 4.3.2
	 *
	 * @param array $form Form data.
	 * @param array $args Args for get_terms().
	 */
	private static function render_tags_select( $form, $args = [] ) {

		$tags = self::get_tags( $args );

		if ( empty( $tags ) ) {
			return;
		}

		$is_advanced_filter_selected = ! empty( $_GET['swp_tax_limiter']['post_tag'] ) || ! empty( $_GET['swp_author_limiter'] ) || ! empty( $_GET['swp_post_type_limiter'] );

		$selected_tag_id = ! empty( $_GET['swp_tax_limiter']['post_tag'] ) ? absint( $_GET['swp_tax_limiter']['post_tag'] ) : 0;

		$return = '<select class="swp-select" name="swp_tax_limiter[post_tag]"' . disabled( ! $is_advanced_filter_selected, true, false ) . '>';
		$return .= '<option value="">' . __( 'Any Tag', 'searchwp' ) . '</option>';

		foreach ( $tags as $tag ) {

			$option = sprintf(
				'<option value="%1$d" title="%2$s"%3$s>%2$s</option>',
				absint( $tag->term_id ),
				esc_html( $tag->name ),
				selected( $tag->term_id, $selected_tag_id, false )
			);

			$return .= $option;
		}

		$return .= '</select>';

		echo $return;
	}

	/**
	 * Render post types select element.
	 *
	 * @since 4.3.2
	 *
	 * @param array $form Form data.
	 * @param array $args Args for compatibility with other render methods.
	 */
	private static function render_post_types_select( $form, $args = [] ) {

		if ( empty( $form['post-type'] ) || ! is_array( $form['post-type'] ) ) {
			return;
		}

		$is_advanced_filter_selected = ! empty( $_GET['swp_tax_limiter']['post_tag'] ) || ! empty( $_GET['swp_author_limiter'] ) || ! empty( $_GET['swp_post_type_limiter'] );

		$selected_post_type = ! empty( $_GET['swp_post_type_limiter'] ) ? sanitize_text_field( wp_unslash( $_GET['swp_post_type_limiter'] ) ) : '';

		$return = '<select class="swp-select" name="swp_post_type_limiter"' . disabled( ! $is_advanced_filter_selected, true, false ) . '>';
		$return .= '<option value="">' . __( 'Any Post Type', 'searchwp' ) . '</option>';

		foreach ( $form['post-type'] as $source_name ) {

			$source = \SearchWP::$index->get_source_by_name( $source_name );

			if ( ! $source instanceof Source ) {
				continue;
			}

			$option = sprintf(
				'<option value="%1$s" title="%2$s"%3$s>%2$s</option>',
				esc_attr( $source->get_name() ),
				esc_html( $source->get_label() ),
				selected( $source->get_name(), $selected_post_type, false )
			);

			$return .= $option;
		}

		$return .= '</select>';

		echo $return;
	}

	/**
	 * Get tags to use on frontend and in mods.
	 *
	 * @since 4.3.2
	 *
	 * @param array $args Args for get_terms().
	 *
	 * @return array
	 */
	private static function get_tags( $args = [] ) {

		$defaults = array(
			'smallest'   => 8,
			'largest'    => 22,
			'unit'       => 'pt',
			'number'     => 45,
			'format'     => 'flat',
			'separator'  => "\n",
			'orderby'    => 'name',
			'order'      => 'ASC',
			'exclude'    => '',
			'include'    => '',
			'link'       => 'view',
			'taxonomy'   => 'post_tag',
			'post_type'  => '',
			'echo'       => true,
			'show_count' => 0,
		);

		$args = wp_parse_args( $args, $defaults );

		$tags = get_terms(
			array_merge(
				$args,
				array(
					'orderby' => 'count',
					'order'   => 'DESC',
				)
			)
		); // Always query top tags.

		if ( empty( $tags ) || is_wp_error( $tags ) ) {
			return [];
		}

		return $tags;
	}

	/**
	 * Get authors to use on frontend and in mods.
	 *
	 * @since 4.3.2
	 *
	 * @param array $form Form data.
	 * @param array $args Args for get_users().
	 *
	 * @return array
	 */
	private static function get_authors( $form, $args = [] ) {

		global $wpdb;

		$cache_key = SEARCHWP_PREFIX . 'form_authors_' . $form['id'];
		$cache     = wp_cache_get( $cache_key, '' );

		if ( ! empty( $cache ) ) {
			return $cache;
		}

		$defaults = [
			'orderby'       => 'name',
			'order'         => 'ASC',
			'number'        => '',
			'optioncount'   => false,
			'exclude_admin' => true,
			'show_fullname' => false,
			'hide_empty'    => true,
			'feed'          => '',
			'feed_image'    => '',
			'feed_type'     => '',
			'exclude'       => '',
			'include'       => '',
		];

		$parsed_args = wp_parse_args( $args, $defaults );

		$query_args = wp_array_slice_assoc(
			$parsed_args,
			[
				'orderby',
				'order',
				'number',
				'exclude',
				'include',
			]
		);

		$query_args['fields'] = 'ids';

		$post_types = self::get_post_types_from_engine_sources( $form );

		if ( empty( $post_types ) ) {
			return [];
		}

		$author_ids = get_users( $query_args );

		$post_counts            = [];
		$post_types_placeholder = implode( ', ', array_fill( 0, count( $post_types ), '%s' ) );

		// phpcs:disable
		/**
		 * Ignore phpcs warnings for the following query:
		 * - Found interpolated variable $post_types_placeholder.
		 * - Replacement variables found, but no valid placeholders found in the query
		 */
		$post_counts_query = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT DISTINCT post_author, COUNT(ID) AS count
				FROM {$wpdb->posts}
				WHERE ( post_type IN ($post_types_placeholder) AND ( post_status = 'publish' OR post_status = 'private' ) )
				GROUP BY post_author",
				$post_types
			)
		);
		// phpcs:enable

		foreach ( (array) $post_counts_query as $row ) {
			$post_counts[ $row->post_author ] = $row->count;
		}

		$authors = [];

		foreach ( $author_ids as $author_id ) {
			$posts = isset( $post_counts[ $author_id ] ) ? $post_counts[ $author_id ] : 0;

			if ( ! $posts && $parsed_args['hide_empty'] ) {
				continue;
			}

			$author = get_userdata( $author_id );

			if ( $parsed_args['exclude_admin'] && $author->display_name === 'admin' ) {
				continue;
			}

			if ( $parsed_args['show_fullname'] && $author->first_name && $author->last_name ) {
				$name = sprintf(
				/* translators: 1: User's first name, 2: Last name. */
					_x( '%1$s %2$s', 'Display name based on first name and last name' ),
					$author->first_name,
					$author->last_name
				);
			} else {
				$name = $author->display_name;
			}

			$authors[ $author_id ] = [
				'id'           => $author_id,
				'full_name'    => $name,
				'display_name' => $author->display_name,
			];
		}

		wp_cache_set( $cache_key, $authors, '', 1 );

		return $authors;
	}

	/**
	 * Gets the Post Types from the engine sources.
	 *
	 * @since 4.3.17
	 *
	 * @param array $form Form data.
	 *
	 * @return array|void
	 */
	public static function get_post_types_from_engine_sources( $form ) {

		$engine_name     = ! empty( $form['engine'] ) ? $form['engine'] : 'default';
		$engine_settings = Settings::get_engine_settings( $engine_name );

		$post_sources = array_filter(
			isset( $engine_settings['sources'] ) ? $engine_settings['sources'] : [],
			function ( $key ) {
				return strpos( $key, 'post' . SEARCHWP_SEPARATOR ) === 0;
			},
			ARRAY_FILTER_USE_KEY
		);

		// Get a list of post types from the engine sources.
		$post_types = array_filter(
			array_map(
				function ( $source ) {
					// Remove the 'post' prefix.
					$post_type = substr( $source, strlen( 'post' . SEARCHWP_SEPARATOR ) );

					return post_type_exists( $post_type ) ? $post_type : false;
				},
				array_keys( $post_sources )
			)
		);

		return $post_types;
	}

	/**
	 * Conditionally set native search engine to a form engine.
	 * Form engine must not have any custom (non-WP_Post) sources.
	 *
	 * @since 4.3.12
	 *
	 * @param array $args Native search args.
	 *
	 * @return array
	 */
	public static function set_native_search_engine( $args ) {

		if ( is_admin() ) {
			return $args; // Search Forms are not designed to work on admin side or via AJAX.
		}

		$form_id = isset( $_GET['swp_form']['form_id'] ) ? absint( $_GET['swp_form']['form_id'] ) : 0; // phpcs:ignore WordPress.Security.NonceVerification.Recommended
		$form    = Storage::get( $form_id );

		if ( empty( $form ) ) {
			return $args;
		}

		// Assume WP default results page if input_name is not explicitly set.
		if ( ! empty( $form['input_name'] ) && $form['input_name'] !== 's' ) {
			return $args;
		}

		$engine_name = ! empty( $form['engine'] ) ? $form['engine'] : 'default';

		if ( $engine_name === 'default' ) {
			return $args;
		}

		$engine_settings = Settings::get_engine_settings( $engine_name );

		if ( empty( $engine_settings ) ) {
			return $args;
		}

		$custom_sources = array_filter(
			isset( $engine_settings['sources'] ) ? $engine_settings['sources'] : [],
			function ( $key ) {
				return strpos( $key, 'post' . SEARCHWP_SEPARATOR ) !== 0;
			},
			ARRAY_FILTER_USE_KEY
		);

		// Set form engine as native engine only if it doesn't contain custom (non-WP_Post) sources.
		if ( empty( $custom_sources ) ) {
			$args['engine'] = $engine_name;
		}

		return $args;
	}

	/**
	 * Process taxonomy (tags, categories etc.) SearchWP Query mods.
	 *
	 * @since 4.3.2
	 *
	 * @param array           $mods  Existing mods.
	 * @param \SearchWP\Query $query Current SearchWP Query.
	 *
	 * @return array
	 */
	public static function taxonomy_mod( $mods, $query ) {

		global $wpdb;

		$form_id = isset( $_GET['swp_form']['form_id'] ) ? absint( $_GET['swp_form']['form_id'] ) : 0;

		if ( empty( $form_id ) ) {
			return $mods;
		}

		$form = Storage::get( $form_id );

		$engine = isset( $form['engine'] ) ? $form['engine'] : 'default';

		if ( $engine !== $query->get_engine()->get_name() ) {
			return $mods;
		}

		if ( empty( $form['advanced-search'] ) && empty( $form['category-search'] ) ) {
			return $mods;
		}

		// Only proceed if a Category was chosen from the dropdown.
		if ( empty( $_GET['swp_tax_limiter'] ) ) {
			return $mods;
		}

		$tax_limiter = $_GET['swp_tax_limiter'];

		if ( ! is_array( $tax_limiter ) ) {
			return $mods;
		}

		$tax_data = [];

		// TODO: Add filter for allowed categories.
		$allowed_taxonomies = [ 'category', 'post_tag' ];

		foreach ( $tax_limiter as $taxonomy => $term_id ) {
			$term_id = absint( $term_id );
			if ( empty( $term_id ) ) {
				continue;
			}
			if ( $taxonomy === 'category' ) {
				if ( empty( $form['category-search'] ) ) {
					continue;
				}
				if ( empty( $form['category'] ) || ! in_array( $term_id, (array) $form['category'] ) ) {
					continue;
				}
			}
			if ( $taxonomy === 'post_tag' ) {
				if ( empty( $form['advanced-search'] ) || ! in_array( 'tags', $form['advanced-search-filters'], true ) ) {
					return $mods;
				}
				if ( ! in_array( $term_id, self::get_tags( [ 'fields' => 'ids' ] ), true ) ) {
					return $mods;
				}
			}
			if ( in_array( $taxonomy, $allowed_taxonomies, true ) ) {
				$tax_data[] = [
					'taxonomy' => $taxonomy,
					'field'    => 'term_id',
					'terms'    => $term_id,
				];
			}
		}

		if ( empty( $tax_data ) ) {
			return $mods;
		}

		$alias     = 'swptax';
		$tax_query = new \WP_Tax_Query( $tax_data );
		$tq_sql    = $tax_query->get_sql( $alias, 'ID' );
		$mod       = new \SearchWP\Mod();

		// If the JOIN is empty, WP_Tax_Query assumes we have a JOIN with wp_posts, so let's make that.
		if ( ! empty( $tq_sql['join'] ) ) {
			// Queue the assumed wp_posts JOIN using our alias.
			$mod->raw_join_sql( function ( $runtime ) use ( $wpdb, $alias ) {
				return "LEFT JOIN {$wpdb->posts} {$alias} ON {$alias}.ID = {$runtime->get_foreign_alias()}.id";
			} );

			// Queue the WP_Tax_Query JOIN which already has our alias.
			$mod->raw_join_sql( $tq_sql['join'] );

			// Queue the WP_Tax_Query WHERE which already has our alias.
			$mod->raw_where_sql( '1=1 ' . $tq_sql['where'] );
		} else {
			// There's no JOIN here because WP_Tax_Query assumes a JOIN with wp_posts already
			// exists. We need to rebuild the tax_query SQL to use a functioning alias. The Mod
			// will ensure the JOIN, and we can use that Mod's alias to rebuild our tax_query.
			$mod->set_local_table( $wpdb->posts );
			$mod->on( 'ID', [ 'column' => 'id' ] );

			$mod->raw_where_sql( function ( $runtime ) use ( $tax_query ) {
				$tq_sql = $tax_query->get_sql( $runtime->get_local_table_alias(), 'ID' );

				return '1=1 ' . $tq_sql['where'];
			} );
		}

		$mods[] = $mod;

		return $mods;
	}

	/**
	 * Process post author SearchWP Query mods.
	 *
	 * @since 4.3.2
	 *
	 * @param array           $mods  Existing mods.
	 * @param \SearchWP\Query $query Current SearchWP Query.
	 *
	 * @return array
	 */
	public static function author_mod( $mods, $query ) {

		global $wpdb;

		$form_id = isset( $_GET['swp_form']['form_id'] ) ? absint( $_GET['swp_form']['form_id'] ) : 0;

		if ( empty( $form_id ) ) {
			return $mods;
		}

		$form = Storage::get( $form_id );

		$engine = isset( $form['engine'] ) ? $form['engine'] : 'default';

		if ( $engine !== $query->get_engine()->get_name() ) {
			return $mods;
		}

		if ( empty( $form['advanced-search'] ) || ! in_array( 'authors', $form['advanced-search-filters'], true ) ) {
			return $mods;
		}

		$author_id = isset( $_GET['swp_author_limiter'] ) ? absint( $_GET['swp_author_limiter'] ) : 0;

		if ( empty( $author_id ) ) {
			return $mods;
		}

		if ( ! array_key_exists( $author_id, self::get_authors( $form ) ) ) {
			return $mods;
		}

		$mod = new \SearchWP\Mod();
		$mod->set_local_table( $wpdb->posts );
		$mod->on( 'ID', [ 'column' => 'id' ] );

		$mod->raw_where_sql( function ( $mod ) use ( $author_id ) {
			return "{$mod->get_local_table_alias()}.post_author = " . $author_id;
		} );

		$mods[] = $mod;

		return $mods;
	}

	/**
	 * Process post type SearchWP Query mods.
	 *
	 * @since 4.3.2
	 *
	 * @param array           $mods  Existing mods.
	 * @param \SearchWP\Query $query Current SearchWP Query.
	 *
	 * @return array
	 */
	public static function post_type_mod( $mods, $query ) {

		$form_id = isset( $_GET['swp_form']['form_id'] ) ? absint( $_GET['swp_form']['form_id'] ) : 0;

		if ( empty( $form_id ) ) {
			return $mods;
		}

		$form        = Storage::get( $form_id );
		$form_engine = isset( $form['engine'] ) ? $form['engine'] : 'default';

		if ( $form_engine !== $query->get_engine()->get_name() ) {
			return $mods;
		}

		$form_post_types = (array) $form['post-type'];

        // If the form has no post types selected, there's nothing to work with.
        if ( empty( $form_post_types ) ) {
            return $mods;
        }

		$advanced_filter_enabled = ! empty( $form['advanced-search'] ) && in_array( 'post_types', $form['advanced-search-filters'], true );

		if ( $advanced_filter_enabled ) {
			$filter_post_type = isset( $_GET['swp_post_type_limiter'] ) ? sanitize_text_field( wp_unslash( $_GET['swp_post_type_limiter'] ) ) : '';
            if ( ! empty( $filter_post_type ) && in_array( $filter_post_type, $form_post_types, true ) ) {
	            $form_post_types = [ $filter_post_type ];
            }
		}

        $sources_names = array_map(
            function( $source ) { return $source->get_name(); },
            $query->get_engine()->get_sources()
        );

        // Save resources by returning early if form post types are identical to sources in engine's configuration.
        if ( array_diff( $form_post_types, $sources_names ) === array_diff( $sources_names, $form_post_types ) ) {
            return $mods;
        }

        // Make sure the filter's post type exists as a source in the engine's configuration.
        $mod_value = array_intersect( $sources_names, $form_post_types );

        if ( empty( $mod_value ) ) {
            return $mods;
        }

		$mod = new \SearchWP\Mod();

		$mod->set_where( [
			[
				'column'  => 'source',
				'value'   => $mod_value,
				'compare' => 'IN',
			]
		] );

		$mods[] = $mod;

		return $mods;
	}

	/**
	 * Display unique styles for a specific form.
	 *
	 * @since 4.3.2
	 *
	 * @param array $form Form data.
	 */
	private static function display_styles( $form ) {
		$el_id = '#' . self::get_form_element_id( $form )
		?>
		<style>
			<?php if ( isset( $form['swp-sfinput-shape'] ) && $form['swp-sfinput-shape'] === 'rectangle' ) : ?>
				<?php echo esc_html( $el_id ); ?> .swp-input,
				<?php echo esc_html( $el_id ); ?> .swp-select {
	                border: 1px solid <?php echo esc_html( $form['search-form-color'] ); ?>;
	                border-radius: 0;
	            }
				<?php echo esc_html( $el_id ); ?> .searchwp-form-input-container .swp-select {
                    border-right: 0;
                }
				<?php echo esc_html( $el_id ); ?> input[type=submit] {
                    border-radius: 0;
                }
			<?php endif; ?>

			<?php if ( isset( $form['swp-sfinput-shape'] ) && $form['swp-sfinput-shape'] === 'rounded' ) : ?>
				<?php echo esc_html( $el_id ); ?> .swp-input,
                <?php echo esc_html( $el_id ); ?> .swp-select {
                    border: 1px solid <?php echo esc_html( $form['search-form-color'] ); ?>;
                    border-radius: 5px;
                }
				<?php echo esc_html( $el_id ); ?> .searchwp-form-input-container .swp-select {
                    border-top-right-radius: 0;
                    border-bottom-right-radius: 0;
                    border-right: 0;
                }
				<?php echo esc_html( $el_id ); ?> .searchwp-form-input-container .swp-select + .swp-input {
                    border-top-left-radius: 0;
                    border-bottom-left-radius: 0;
                }
				<?php echo esc_html( $el_id ); ?> input[type=submit] {
                    border-radius: 5px;
                }
			<?php endif; ?>

			<?php if ( isset( $form['swp-sfinput-shape'] ) && $form['swp-sfinput-shape'] === 'underlined' ) : ?>
				<?php echo esc_html( $el_id ); ?> .swp-input,
				<?php echo esc_html( $el_id ); ?> .swp-select {
                    border: 0;
                    border-bottom: 1px solid <?php echo esc_html( $form['search-form-color'] ); ?>;
                    border-radius: 0;
                }
			<?php endif; ?>

			<?php if ( ! empty( $form['swp-sfinput-shape'] ) && ! empty( $form['search-form-color'] ) ) : ?>
                <?php echo esc_html( $el_id ); ?> .swp-toggle-checkbox:checked + .swp-toggle-switch,
                <?php echo esc_html( $el_id ); ?> .swp-toggle-switch--checked  {
                    background: <?php echo esc_html( $form['search-form-color'] ); ?>;
                }
			<?php endif; ?>

			<?php if ( ! empty( $form['search-form-font-size'] ) ) : ?>
                <?php echo esc_html( $el_id ); ?> * {
                    font-size: <?php echo absint( $form['search-form-font-size'] ); ?>px;
                }
			<?php endif; ?>

			<?php if ( ! empty( $form['button-background-color'] ) && isset( $form['swp-sfbutton-filled'] ) && $form['swp-sfbutton-filled'] === 'filled' ) : ?>
				<?php echo esc_html( $el_id ); ?> input[type=submit] {
                    background-color: <?php echo esc_html( $form['button-background-color'] ); ?>;
                }
			<?php endif; ?>

			<?php if ( isset( $form['swp-sfbutton-filled'] ) && $form['swp-sfbutton-filled'] === 'stroked' ) : ?>
				<?php echo esc_html( $el_id ); ?> input[type=submit] {
                    background-color: transparent;
                    border: 1px solid<?php echo ! empty( $form['search-form-color'] ) ? esc_html( $form['search-form-color'] ) : ''; ?>;
                }
			<?php endif; ?>

			<?php if ( ! empty( $form['button-font-color'] ) ) : ?>
				<?php echo esc_html( $el_id ); ?> input[type=submit] {
                    color: <?php echo esc_html( $form['button-font-color'] ); ?>;
                }
			<?php endif; ?>

			<?php if ( ! empty( $form['button-font-size'] ) ) : ?>
				<?php echo esc_html( $el_id ); ?> input[type=submit] {
                    font-size: <?php echo absint( $form['button-font-size'] ); ?>px;
                }
			<?php endif; ?>
		</style>
		<?php
	}

	/**
	 * Get form HTML element id.
	 *
	 * @since 4.3.2
	 *
	 * @param array $form Form data.
	 */
	private static function get_form_element_id( $form ) {

		$form_id = isset( $form['id'] ) ? absint( $form['id'] ) : 0;

		return 'searchwp-form-' . $form_id;
	}

	/**
	 * Disable Gutenberg block rendering.
	 *
	 * @param string|null $pre_render The pre-rendered content. Default null.
	 * @param array $parsed_block The block being rendered.
	 *
	 * @since 4.3.10
	 *
	 */
	public static function disable_block_render( $pre_render, $parsed_block ) {

		if ( ! isset( $parsed_block['blockName'] ) ) {
			return $pre_render;
		}

		return $parsed_block['blockName'] === 'searchwp/search-form' ? '' : $pre_render;
	}

	/**
	 * Disable Shortcode rendering.
	 *
	 * @param false|string $output Short-circuit return value. Either false or the value to replace the shortcode with.
	 * @param string $tag Shortcode name.
	 *
	 * @since 4.3.10
	 *
	 */
	public static function disable_shortcode_render( $output, $tag ) {

		return $tag === 'searchwp_form' ? '' : $output;
	}
}

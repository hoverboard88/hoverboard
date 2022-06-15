<?php
/**
 * SearchWP NavTab.
 *
 * @package SearchWP
 * @author  Jon Christopher
 */

namespace SearchWP\Admin;

/**
 * Class NavTab is responsible for modeling an OptionsView nav tab.
 *
 * @since 4.0
 */
class NavTab {

	/**
	 * Page tag.
	 *
	 * @since 4.2.0
     *
	 * @var string
	 */
	public $page = '';

	/**
	 * Tab tag.
	 *
	 * @since 4.0
     *
	 * @var string
	 */
	public $tab = '';

	/**
	 * Tab link.
	 *
	 * @since 4.0
     *
	 * @var string
	 */
	public $link = '';

	/**
	 * Tab label.
	 *
	 * @since 4.0
     *
	 * @var string
	 */
	public $label = '';

	/**
	 * Tab icon(s) as HTML class(es).
	 *
	 * @since 4.0
     *
	 * @var string
	 */
	public $icon = '';

	/**
	 * Is it a default tab?
	 *
	 * @since 4.2.0
     *
	 * @var bool
	 */
	public $is_default = false;

	/**
	 * Tab CSS classes.
	 *
	 * @since 4.0
     *
	 * @var string[]
	 */
	public $classes = [];

	/**
	 * NavTab constructor.
	 *
	 * @since 4.0
     *
	 * @param array $args Tab settings.
	 */
	public function __construct( array $args = [] ) {

		$defaults = [
			'page'    => '',
			'tab'     => '',
			'label'   => __( 'Settings', 'searchwp' ),
			'classes' => '',
			'icon'    => '',
		];

		$args = (array) wp_parse_args( $args, $defaults );

		$this->link    = '#';
		$this->classes = [ 'searchwp-settings-nav-tab' ];
		$this->page    = sanitize_title_with_dashes( $args['page'] );
		$this->tab     = sanitize_title_with_dashes( $args['tab'] );
		$this->label   = sanitize_text_field( $args['label'] );
		$this->icon    = sanitize_text_field( $args['icon'] );

        if ( isset( $args['is_default'] ) ) {
	        $this->is_default = (bool) $args['is_default'];
        } else {
	        $this->is_default = $this->tab === 'default';
        }

		if ( ! empty( $args['classes'] ) ) {
			$this->classes = array_merge( $this->classes, (array) $args['classes'] );
		}

		$this->check_for_active_state();

		if ( ! empty( $this->page ) || ! empty( $this->tab ) ) {
			$this->build_link();
		}

		add_action( 'searchwp\settings\nav\tab', [ $this, 'render' ] );
	}

	/**
	 * Render this Navigation Tab.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	public function render() {
		?>
        <li class="<?php echo esc_attr( implode( '-wrapper ', $this->classes ) . '-wrapper' ); ?>">
            <a href="<?php echo esc_url( $this->link ); ?>" class="<?php echo esc_attr( implode( ' ', $this->classes ) ); ?>">
				<span>
					<?php echo esc_html( $this->label ); ?>
					<?php if ( ! empty( $this->icon ) ) : ?>
                        <span class="<?php echo esc_attr( $this->icon ); ?>"></span>
					<?php endif; ?>
				</span>
            </a>
        </li>
		<?php
	}

	/**
	 * Build the link for this Nav Tab.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	private function build_link() {

		wp_create_nonce( 'searchwp-tab-' . $this->tab );

		$this->classes[] = 'searchwp-settings-nav-tab-' . sanitize_title_with_dashes( $this->tab );

		$this->link = add_query_arg( [] );

		if ( ! empty( $this->page ) ) {
			$this->link = add_query_arg(
				[ 'page' => 'searchwp-' . $this->page ],
				admin_url( 'admin.php' )
			);
		}

		if ( ! empty( $this->tab ) && ! $this->is_default ) {
			$this->link = add_query_arg(
				[ 'tab' => $this->tab ],
				$this->link
			);
		}
	}

	/**
	 * Check whether this Nav Tab is active and if so add CSS class.
	 *
	 * @since 4.0
     *
	 * @return void
	 */
	private function check_for_active_state() {

		if (
			( empty( $this->tab ) && ! isset( $_GET['tab'] ) ) ||
			( $this->is_default && ! isset( $_GET['tab'] ) ) ||
			( isset( $_GET['tab'] ) && $this->tab === $_GET['tab'] )
		) {
			$this->classes[] = 'searchwp-settings-nav-tab-active postbox';
		}
	}
}

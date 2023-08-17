<?php

// class to add admin submenu page

class ESAB_Admin_Page {

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'admin_menu', [ $this, 'esab_admin_menu' ] );

        // enqueue admin assets
        add_action( 'admin_enqueue_scripts', [ $this, 'esab_admin_assets' ] );
    }

    /**
     * Enqueue admin scripts
     */
    public function esab_admin_assets($screen) {
        if( $screen === 'settings_page_esab-accordion' ){
            wp_enqueue_style( 'esab-admin-style', ESAB_URL . 'admin/admin.css', [], ESAB_VERSION );
            // JS
            wp_enqueue_script( 'esab-admin-script', ESAB_URL . 'admin/admin.js', [ 'jquery' ], ESAB_VERSION, true );
        }
    }

    /**
     * Add admin menu
     */
    public function esab_admin_menu() {
        add_submenu_page(
            'options-general.php',
            __( 'Easy Accordion', 'easy-accordion-block' ),
            __( 'Easy Accordion', 'easy-accordion-block' ),
            'manage_options',
            'esab-accordion',
            [ $this, 'esab_admin_page' ]
        );
    }

    /**
     * Admin page
     */
    public function esab_admin_page() {
        ?>
        <div class="esab__wrap">
            <div class="plugin_max_container">
                <div class="plugin__head_container">
                    <div class="plugin_head">
                        <h1 class="plugin_title">
                            <?php _e( 'Easy Accordion Block', 'easy-accordion-block' ); ?>
                        </h1>
                        <p class="plugin_description">
                            <?php _e( 'Easy Accordion Block is a Gutenberg block plugin that allows you to create accordion blocks with ease in Gutenberg Editor without any coding knowledge', 'easy-accordion-block' ); ?>
                        </p>
                    </div>
                </div>
                <div class="plugin__body_container">
                    <div class="plugin_body">
                        <div class="tabs__panel_container">
                            <div class="tabs__titles">
                                <p class="tab__title active" data-tab="tab1">
                                    <?php _e( 'Help and Support', 'easy-accordion-block' ); ?>
                                </p>
                                <p class="tab__title" data-tab="tab2">
                                    <?php _e( 'Changelog', 'easy-accordion-block' ); ?>
                                </p>
                            </div>
                            <div class="tabs__container">
                                <div class="tabs__panels">
                                    <div class="tab__panel active" id="tab1">
                                        <div class="tab__panel_flex">
                                            <div class="tab__panel_left">
                                                <h3 class="video__title">
                                                    <?php _e( 'Video Tutorial', 'easy-accordion-block' ); ?>
                                                </h3>
                                                <p class="video__description">
                                                    <?php _e( 'Watch the video tutorial to learn how to use the plugin. It will help you start your own design quickly.', 'easy-accordion-block' ); ?>
                                                </p>
                                                <div class="video__container">
                                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/Hh3LNLpwzX4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                </div>
                                            </div>
                                            <div class="tab__panel_right">
                                                <div class="single__support_panel">
                                                    <h3 class="support__title">
                                                        <?php _e( 'Get Support', 'easy-accordion-block' ); ?>
                                                    </h3>
                                                    <p class="support__description">
                                                        <?php _e( 'If you find any issue or have any suggestion, please let me know.', 'easy-accordion-block' ); ?>
                                                    </p>
                                                    <a href="https://wordpress.org/support/plugin/easy-accordion-block/" class="support__link" target="_blank">
                                                        <?php _e( 'Support', 'easy-accordion-block' ); ?>
                                                    </a>
                                                </div>
                                                <div class="single__support_panel">
                                                    <h3 class="support__title">
                                                        <?php _e( 'Spread Your Love', 'easy-accordion-block' ); ?>
                                                    </h3>
                                                    <p class="support__description">
                                                        <?php _e( 'If you like this plugin, please share your opinion', 'easy-accordion-block' ); ?>
                                                    </p>
                                                    <a href="https://wordpress.org/support/plugin/easy-accordion-block/reviews/" class="support__link" target="_blank">
                                                        <?php _e( 'Rate the Plugin', 'easy-accordion-block' ); ?>
                                                    </a>
                                                </div>
                                                <div class="single__support_panel">
                                                    <h3 class="support__title">
                                                        <?php _e( 'Similar Blocks', 'easy-accordion-block' ); ?>
                                                    </h3>
                                                    <p class="support__description">
                                                        <?php _e( 'Want to get more similar blocks, please visit my website', 'easy-accordion-block' ); ?>
                                                    </p>
                                                    <a href="https://makegutenblock.com" class="support__link" target="_blank">
                                                        <?php _e( 'Visit my Website', 'easy-accordion-block' ); ?>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="custom__block_request">
                                            <h3 class="custom__block_request_title">
                                                <?php _e( 'Need to Hire Me?', 'easy-accordion-block' ); ?>
                                            </h3>
                                            <p class="custom__block_request_description">
                                                <?php _e( 'I am available for any freelance projects. Please feel free to share your project detail with me.', 'easy-accordion-block' ); ?>
                                            </p>
                                            <div class="available__links">
                                                <a href="mailto:zbinsaifullah@gmail.com" class="available__link mail" target="_blank">
                                                    <?php _e( 'Send Email', 'easy-accordion-block' ); ?>
                                                </a>
                                                <a href="https://makegutenblock.com/contact" class="available__link web" target="_blank">
                                                    <?php _e( 'Send Message', 'easy-accordion-block' ); ?>
                                                </a>
                                                <a href="https://www.fiverr.com/devs_zak" class="available__link fiverr" target="_blank">
                                                    <?php _e( 'Fiverr', 'easy-accordion-block' ); ?>
                                                </a>
                                                <a href="https://www.upwork.com/freelancers/~010af183b3205dc627" class="available__link upwork" target="_blank">
                                                    <?php _e( 'UpWork', 'easy-accordion-block' ); ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab__panel" id="tab2">
                                        <div class="change__log_head">
                                            <h3 class="change__log_title">
                                                <?php _e( 'Changelog', 'easy-accordion-block' ); ?>
                                            </h3>
                                            <p class="change__log_description">
                                                <?php _e( 'This is the changelog of the plugin. You can see the changes in each version.', 'easy-accordion-block' ); ?>
                                            </p>
                                            <div class="change__notes">
                                                <div class="single__note">
                                                    <span class="info change__note"><?php _e( 'i', 'easy-accordion-block' ); ?></span>
                                                    <span class="note__description"><?php _e( 'Info', 'easy-accordion-block' ); ?></span>
                                                </div>
                                                <div class="single__note">
                                                    <span class="feature change__note"><?php _e( 'N', 'easy-accordion-block' ); ?></span>
                                                    <span class="note__description"><?php _e( 'New Feature', 'easy-accordion-block' ); ?></span>
                                                </div>
                                                <div class="single__note">
                                                    <span class="update change__note"><?php _e( 'U', 'easy-accordion-block' ); ?></span>
                                                    <span class="note__description"><?php _e( 'Update', 'easy-accordion-block' ); ?></span>
                                                </div>
                                                <div class="single__note">
                                                    <span class="fixing change__note"><?php _e( 'F', 'easy-accordion-block' ); ?></span>
                                                    <span class="note__description"><?php _e( 'Issue Fixing', 'easy-accordion-block' ); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="change__log_body">
                                            <div class="single__log">
                                                <div class="plugin__info">
                                                    <span class="log__version">1.1.0</span>
                                                    <span class="log__date">2023-02-21</span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note feature">N</span>
                                                    <span class="description__text"><?php _e( 'Multiple items opening feature is added', 'easy-accordion-block' ); ?></span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note fixing">F</span>
                                                    <span class="description__text"><?php _e( 'Style related PHP Errors are fixed', 'easy-accordion-block' ); ?></span>
                                                </div>
                                            </div>
                                            <div class="single__log">
                                                <div class="plugin__info">
                                                    <span class="log__version">1.0.4</span>
                                                    <span class="log__date">2022-11-05</span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note feature">N</span>
                                                    <span class="description__text"><?php _e( 'Scripts load only when the block is used', 'easy-accordion-block' ); ?></span>
                                                </div>
                                            </div>
                                            <div class="single__log">
                                                <div class="plugin__info">
                                                    <span class="log__version">1.0.3</span>
                                                    <span class="log__date">2022-10-17</span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note fixing">F</span>
                                                    <span class="description__text"><?php _e( 'Accordions Margin issue on Editor', 'easy-accordion-block' ); ?></span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note fixing">F</span>
                                                    <span class="description__text"><?php _e( 'Style issues on duplicate item', 'easy-accordion-block' ); ?></span>
                                                </div>
                                            </div>
                                            <div class="single__log">
                                                <div class="plugin__info">
                                                    <span class="log__version">1.0.2</span>
                                                    <span class="log__date">2022-10-12</span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note info">i</span>
                                                    <span class="description__text"><?php _e( 'Separate Admin assets in admin folder', 'easy-accordion-block' ); ?></span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note fixing">F</span>
                                                    <span class="description__text"><?php _e( 'Editor Width Fix', 'easy-accordion-block' ); ?></span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note fixing">F</span>
                                                    <span class="description__text"><?php _e( 'Replace Arrow Icons to fix color change issue', 'easy-accordion-block' ); ?></span>
                                                </div>
                                            </div>
                                            <div class="single__log">
                                                <div class="plugin__info">
                                                    <span class="log__version">1.0.1</span>
                                                    <span class="log__date">2022-10-09</span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note update">U</span>
                                                    <span class="description__text"><?php _e( 'Redirect to admin page while activating', 'easy-accordion-block' ); ?></span>
                                                </div>
                                            </div>
                                            <div class="single__log">
                                                <div class="plugin__info">
                                                    <span class="log__version">1.0.0</span>
                                                    <span class="log__date">2022-09-29</span>
                                                </div>
                                                <div class="log__description">
                                                    <span class="change__note info">i</span>
                                                    <span class="description__text"><?php _e( 'Initial Release', 'easy-accordion-block' ); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

new ESAB_Admin_Page();
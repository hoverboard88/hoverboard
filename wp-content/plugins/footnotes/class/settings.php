<?php
/**
 * Includes the Settings class to handle all Plugin settings.
 *
 * @filesource
 * @author Stefan Herndler
 * @since 1.5.0 14.09.14 10:43
 *
 * Edited for:
 * 2.0.4  restore arrow settings  2020-11-02T2115+0100
 * 2.0.7  remove hook the_post  2020-11-06T1342+0100
 * 2.1.0  add read-on button label customization  2020-11-08T2149+0100
 * 2.1.1  fix tooltips on site by alternative  2020-11-11T1819+0100
 * 2.1.1  fix disabling backlink symbol  2020-11-16T2021+0100
 * 2.1.1  fix superscript by making it optional
 * 2.1.1  fix start pages by option to hide ref container
 * 2.1.1  fix ref container by option restoring 3-column layout
 * 2.1.1  fix ref container by option to switch index/symbol  2020-11-16T2022+0100
 * 2.1.3  fix ref container positioning by priority level  2020-11-17T0205+0100
 * 2.1.4  more settings container keys  2020-12-03T0955+0100
 * 2.1.6  option to disable URL line wrapping   2020-12-09T1606+0100
 * 2.1.6  set default priority level of the_content to 98   2020-12-10T0447+0100
 * 2.2.0  reference container custom position shortcode  2020-12-13T2056+0100
 * 2.2.2  Custom CSS settings container migration  2020-12-15T0709+0100
 *
 * Last modified: 2020-12-15T0744+0100
 */


/**
 * The class loads all Settings from each WordPress Settings container.
 * It a Setting is not defined yet, the default value will be used.
 * Each Setting will be validated and sanitized when loaded from the container.
 *
 * @author Stefan Herndler
 * @since 1.5.0
 */
class MCI_Footnotes_Settings {


    /**
     *       SETTINGS CONTAINER KEY DEFINITIONS
     */

    /**
     * Settings Container Key for the label of the reference container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_REFERENCE_CONTAINER_NAME = "footnote_inputfield_references_label";

    /**
     * Settings Container Key to collapse the reference container by default.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var bool
     */
    const C_BOOL_REFERENCE_CONTAINER_COLLAPSE = "footnote_inputfield_collapse_references";

    /**
     * Settings Container Key for the positioning of the reference container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_REFERENCE_CONTAINER_POSITION = "footnote_inputfield_reference_container_place";

    /**
     * Settings Container Key to combine identical footnotes.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var bool
     */
    const C_BOOL_COMBINE_IDENTICAL_FOOTNOTES = "footnote_inputfield_combine_identical";

    /**
     * Settings Container Key for the start of the footnotes short code.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_FOOTNOTES_SHORT_CODE_START = "footnote_inputfield_placeholder_start";

    /**
     * Settings Container Key for the end of the footnotes short code.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_FOOTNOTES_SHORT_CODE_END = "footnote_inputfield_placeholder_end";

    /**
     * Settings Container Key for the user defined start of the footnotes short code.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_FOOTNOTES_SHORT_CODE_START_USER_DEFINED = "footnote_inputfield_placeholder_start_user_defined";

    /**
     * Settings Container Key for the user defined end of the footnotes short code.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_FOOTNOTES_SHORT_CODE_END_USER_DEFINED = "footnote_inputfield_placeholder_end_user_defined";

    /**
     * Settings Container Key for the counter style of the footnotes.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_FOOTNOTES_COUNTER_STYLE = "footnote_inputfield_counter_style";

    /**
     * Settings Container Key for the 'I love footnotes' text.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_FOOTNOTES_LOVE = "footnote_inputfield_love";

    /**
     * Settings Container Key to look for footnotes in post excerpts.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_BOOL_FOOTNOTES_IN_EXCERPT = "footnote_inputfield_search_in_excerpt";

    /**
     * Settings Container Key for the Expert mode.
     *
     * @author Stefan Herndler
     * @since 1.5.5
     * @var string
     *
     * @since 2.1.6: this setting removed as irrelevant since priority level setting is permanently visible   2020-12-09T2107+0100
     */
    const C_BOOL_FOOTNOTES_EXPERT_MODE = "footnote_inputfield_enable_expert_mode";

    /**
     * Settings Container Key for the styling before the footnotes index.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_FOOTNOTES_STYLING_BEFORE = "footnote_inputfield_custom_styling_before";

    /**
     * Settings Container Key for the styling after the footnotes index.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_FOOTNOTES_STYLING_AFTER = "footnote_inputfield_custom_styling_after";

    /**
     * Settings Container Key for the mouse-over box to be enabled.
     *
     * @author Stefan Herndler
     * @since 1.5.2
     * @var string
     */
    const C_BOOL_FOOTNOTES_MOUSE_OVER_BOX_ENABLED = "footnote_inputfield_custom_mouse_over_box_enabled";

    /**
     * Settings Container Key for alternative tooltip implementation
     *
     * @since 2.1.4
     * @var string
     *
     * 2020-11-11T1817+0100
     */
    const C_BOOL_FOOTNOTES_MOUSE_OVER_BOX_ALTERNATIVE = "footnote_inputfield_custom_mouse_over_box_alternative";

    /**
     * Settings Container Key for the mouse-over box to display only an excerpt.
     *
     * @author Stefan Herndler
     * @since 1.5.4
     * @var string
     */
    const C_BOOL_FOOTNOTES_MOUSE_OVER_BOX_EXCERPT_ENABLED = "footnote_inputfield_custom_mouse_over_box_excerpt_enabled";

    /**
     * Settings Container Key for the mouse-over box to define the max. length of the enabled excerpt.
     *
     * @author Stefan Herndler
     * @since 1.5.4
     * @var string
     */
    const C_INT_FOOTNOTES_MOUSE_OVER_BOX_EXCERPT_LENGTH = "footnote_inputfield_custom_mouse_over_box_excerpt_length";

    /**
     * Settings Container Key for the mouse-over box to define the positioning.
     *
     * @author Stefan Herndler
     * @since 1.5.7
     * @var string
     */
    const C_STR_FOOTNOTES_MOUSE_OVER_BOX_POSITION = "footnote_inputfield_custom_mouse_over_box_position";

    /**
     * Settings Container Key for the mouse-over box to define the offset (x).
     *
     * @author Stefan Herndler
     * @since 1.5.7
     * @var string
     */
    const C_INT_FOOTNOTES_MOUSE_OVER_BOX_OFFSET_X = "footnote_inputfield_custom_mouse_over_box_offset_x";

    /**
     * Settings Container Key for the mouse-over box to define the offset (y).
     *
     * @author Stefan Herndler
     * @since 1.5.7
     * @var string
     */
    const C_INT_FOOTNOTES_MOUSE_OVER_BOX_OFFSET_Y = "footnote_inputfield_custom_mouse_over_box_offset_y";

    /**
     * Settings Container Key for the mouse-over box to define the color.
     *
     * @author Stefan Herndler
     * @since 1.5.6
     * @var string
     */
    const C_STR_FOOTNOTES_MOUSE_OVER_BOX_COLOR = "footnote_inputfield_custom_mouse_over_box_color";

    /**
     * Settings Container Key for the mouse-over box to define the background color.
     *
     * @author Stefan Herndler
     * @since 1.5.6
     * @var string
     */
    const C_STR_FOOTNOTES_MOUSE_OVER_BOX_BACKGROUND = "footnote_inputfield_custom_mouse_over_box_background";

    /**
     * Settings Container Key for the mouse-over box to define the border width.
     *
     * @author Stefan Herndler
     * @since 1.5.6
     * @var string
     */
    const C_INT_FOOTNOTES_MOUSE_OVER_BOX_BORDER_WIDTH = "footnote_inputfield_custom_mouse_over_box_border_width";

    /**
     * Settings Container Key for the mouse-over box to define the border color.
     *
     * @author Stefan Herndler
     * @since 1.5.6
     * @var string
     */
    const C_STR_FOOTNOTES_MOUSE_OVER_BOX_BORDER_COLOR = "footnote_inputfield_custom_mouse_over_box_border_color";

    /**
     * Settings Container Key for the mouse-over box to define the border radius.
     *
     * @author Stefan Herndler
     * @since 1.5.6
     * @var string
     */
    const C_INT_FOOTNOTES_MOUSE_OVER_BOX_BORDER_RADIUS = "footnote_inputfield_custom_mouse_over_box_border_radius";

    /**
     * Settings Container Key for the mouse-over box to define the max width.
     *
     * @author Stefan Herndler
     * @since 1.5.6
     * @var string
     */
    const C_INT_FOOTNOTES_MOUSE_OVER_BOX_MAX_WIDTH = "footnote_inputfield_custom_mouse_over_box_max_width";

    /**
     * Settings Container Key for the mouse-over box to define the box-shadow color.
     *
     * @author Stefan Herndler
     * @since 1.5.8
     * @var string
     */
    const C_STR_FOOTNOTES_MOUSE_OVER_BOX_SHADOW_COLOR = "footnote_inputfield_custom_mouse_over_box_shadow_color";

    /**
     * Settings Container Key for the Hyperlink arrow.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_HYPERLINK_ARROW = "footnote_inputfield_custom_hyperlink_symbol";

    /**
     * Settings Container Key for the user defined Hyperlink arrow.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     */
    const C_STR_HYPERLINK_ARROW_USER_DEFINED = "footnote_inputfield_custom_hyperlink_symbol_user";

    /**
     * Settings Container Key for the user defined styling.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var string
     *
     * Edited:
     * 2.2.2  migrate Custom CSS to a dedicated tab  2020-12-15T0520+0100
     */
    const C_STR_CUSTOM_CSS = "footnote_inputfield_custom_css";
    const C_STR_CUSTOM_CSS_NEW = "footnote_inputfield_custom_css_new";
    const C_BOOL_CUSTOM_CSS_MIGRATED = "footnote_inputfield_custom_css_migrated";

    /**
     * Settings Container Key the activation of the_title hook.
     *
     * @author Stefan Herndler
     * @since 1.5.5
     * @var string
     */
    const C_BOOL_EXPERT_LOOKUP_THE_TITLE = "footnote_inputfield_expert_lookup_the_title";

    /**
     * Settings Container Key the activation of the_content hook.
     *
     * @author Stefan Herndler
     * @since 1.5.5
     * @var string
     */
    const C_BOOL_EXPERT_LOOKUP_THE_CONTENT = "footnote_inputfield_expert_lookup_the_content";

    /**
     * Settings Container Key the activation of the_excerpt hook.
     *
     * @author Stefan Herndler
     * @since 1.5.5
     * @var string
     */
    const C_BOOL_EXPERT_LOOKUP_THE_EXCERPT = "footnote_inputfield_expert_lookup_the_excerpt";

    /**
     * Settings Container Key the activation of widget_title hook.
     *
     * @author Stefan Herndler
     * @since 1.5.5
     * @var string
     */
    const C_BOOL_EXPERT_LOOKUP_WIDGET_TITLE = "footnote_inputfield_expert_lookup_widget_title";

    /**
     * Settings Container Key the activation of widget_text hook.
     *
     * @author Stefan Herndler
     * @since 1.5.5
     * @var string
     */
    const C_BOOL_EXPERT_LOOKUP_WIDGET_TEXT = "footnote_inputfield_expert_lookup_widget_text";

    /**
     * Settings Container Key for the label of the 'Read on' button in truncated tooltips
     *
     * @since 2.1.0
     * @var string
     *
     * 2020-11-08T2106+0100
     */
    const C_STR_FOOTNOTES_TOOLTIP_READON_LABEL = "footnote_inputfield_readon_label";

    /**
     * Settings Container Keys for options fixing default layout
     *
     * @since 2.1.1
     * @var string
     *
     * 2020-11-16T0859+0100
     */
    const C_BOOL_FOOTNOTES_REFERRER_SUPERSCRIPT_TAGS        = "footnotes_inputfield_referrer_superscript_tags";
    const C_BOOL_REFERENCE_CONTAINER_BACKLINK_SYMBOL_ENABLE = "footnotes_inputfield_reference_container_backlink_symbol_enable";
    const C_BOOL_REFERENCE_CONTAINER_START_PAGE_ENABLE      = "footnotes_inputfield_reference_container_start_page_enable";
    const C_BOOL_REFERENCE_CONTAINER_3COLUMN_LAYOUT_ENABLE  = "footnotes_inputfield_reference_container_3column_layout_enable";
    const C_BOOL_REFERENCE_CONTAINER_BACKLINK_SYMBOL_SWITCH = "footnotes_inputfield_reference_container_backlink_symbol_switch";

    /**
     * Settings Container Keys for hook priority levels
     *
     * @since 2.1.1 (the_content)
     * @since 2.1.2
     * @var string
     *
     * 2020-11-16T0859+0100
     * 2020-11-20T0620+0100
     */
    const C_INT_EXPERT_LOOKUP_THE_TITLE_PRIORITY_LEVEL    = "footnote_inputfield_expert_lookup_the_title_priority_level";
    const C_INT_EXPERT_LOOKUP_THE_CONTENT_PRIORITY_LEVEL  = "footnote_inputfield_expert_lookup_the_content_priority_level";
    const C_INT_EXPERT_LOOKUP_THE_EXCERPT_PRIORITY_LEVEL  = "footnote_inputfield_expert_lookup_the_excerpt_priority_level";
    const C_INT_EXPERT_LOOKUP_WIDGET_TITLE_PRIORITY_LEVEL = "footnote_inputfield_expert_lookup_widget_title_priority_level";
    const C_INT_EXPERT_LOOKUP_WIDGET_TEXT_PRIORITY_LEVEL  = "footnote_inputfield_expert_lookup_widget_text_priority_level";

    /**
     * Settings Container Keys for the link element option
     * Settings Container Keys for backlink typography and layout
     * Settings Container Keys for tooltip font size
     * Settings Container Keys for page layout support
     * Settings Container Keys for scroll offset and duration
     * Settings Container Keys for tooltip display durations
     *
     * @since 2.1.4
     * @var string|bool|int
     *
     * 2020-11-26T1002+0100
     * 2020-11-30T0427+0100
     * 2020-12-03T0501+0100
     * 2020-12-05T0425+0100
     */

    // link element option:
    const C_BOOL_LINK_ELEMENT_ENABLED               =  "footnote_inputfield_link_element_enabled";

    // backlink typography:
    const C_BOOL_BACKLINKS_SEPARATOR_ENABLED        = "footnotes_inputfield_backlinks_separator_enabled";
    const C_STR_BACKLINKS_SEPARATOR_OPTION          = "footnotes_inputfield_backlinks_separator_option";
    const C_STR_BACKLINKS_SEPARATOR_CUSTOM          = "footnotes_inputfield_backlinks_separator_custom";
    const C_BOOL_BACKLINKS_TERMINATOR_ENABLED       = "footnotes_inputfield_backlinks_terminator_enabled";
    const C_STR_BACKLINKS_TERMINATOR_OPTION         = "footnotes_inputfield_backlinks_terminator_option";
    const C_STR_BACKLINKS_TERMINATOR_CUSTOM         = "footnotes_inputfield_backlinks_terminator_custom";

    // backlink layout:
    const C_BOOL_BACKLINKS_COLUMN_WIDTH_ENABLED     = "footnotes_inputfield_backlinks_column_width_enabled";
    const C_INT_BACKLINKS_COLUMN_WIDTH_SCALAR       = "footnotes_inputfield_backlinks_column_width_scalar";
    const C_STR_BACKLINKS_COLUMN_WIDTH_UNIT         = "footnotes_inputfield_backlinks_column_width_unit";
    const C_BOOL_BACKLINKS_COLUMN_MAX_WIDTH_ENABLED = "footnotes_inputfield_backlinks_column_max_width_enabled";
    const C_INT_BACKLINKS_COLUMN_MAX_WIDTH_SCALAR   = "footnotes_inputfield_backlinks_column_max_width_scalar";
    const C_STR_BACKLINKS_COLUMN_MAX_WIDTH_UNIT     = "footnotes_inputfield_backlinks_column_max_width_unit";
    const C_BOOL_BACKLINKS_LINE_BREAKS_ENABLED      = "footnotes_inputfield_backlinks_line_breaks_enabled";

    // tooltip font size:
    // called mouse over box not tooltip for consistency
    const C_BOOL_MOUSE_OVER_BOX_FONT_SIZE_ENABLED   = "footnotes_inputfield_mouse_over_box_font_size_enabled";
    const C_FLO_MOUSE_OVER_BOX_FONT_SIZE_SCALAR     = "footnotes_inputfield_mouse_over_box_font_size_scalar";
    const C_STR_MOUSE_OVER_BOX_FONT_SIZE_UNIT       = "footnotes_inputfield_mouse_over_box_font_size_unit";

    // page layout support:
    const C_STR_FOOTNOTES_PAGE_LAYOUT_SUPPORT       = "footnotes_inputfield_page_layout_support";

    // scroll offset and duration:
    const C_INT_FOOTNOTES_SCROLL_OFFSET             = "footnotes_inputfield_scroll_offset";
    const C_INT_FOOTNOTES_SCROLL_DURATION           = "footnotes_inputfield_scroll_duration";

    // tooltip display durations:
    // called mouse over box not tooltip for consistency
    const C_INT_MOUSE_OVER_BOX_FADE_IN_DELAY        = "footnotes_inputfield_mouse_over_box_fade_in_delay";
    const C_INT_MOUSE_OVER_BOX_FADE_IN_DURATION     = "footnotes_inputfield_mouse_over_box_fade_in_duration";
    const C_INT_MOUSE_OVER_BOX_FADE_OUT_DELAY       = "footnotes_inputfield_mouse_over_box_fade_out_delay";
    const C_INT_MOUSE_OVER_BOX_FADE_OUT_DURATION    = "footnotes_inputfield_mouse_over_box_fade_out_duration";

    /**
     * Settings Container Key for URL wrap option
     *
     * This is made optional because it causes weird line breaks.
     * Unicode-compliant browsers break URLs at slashes.
     *
     * @since 2.1.6
     * @var bool
     *
     * 2020-12-09T1554+0100..2020-12-13T1313+0100
     */
    const C_BOOL_FOOTNOTE_URL_WRAP_ENABLED          =  "footnote_inputfield_url_wrap_enabled";

    /**
     * Settings Container Key for reference container position shortcode
     *
     * @since 2.2.0
     * @var string
     *
     * 2020-12-13T2056+0100
     */
    const C_STR_REFERENCE_CONTAINER_POSITION_SHORTCODE  =  "footnote_inputfield_reference_container_position_shortcode";


    /**
     * Stores a singleton reference of this class.
     *
     * @author Stefan Herndler
     * @since  1.5.0
     * @var MCI_Footnotes_Settings
     */
    private static $a_obj_Instance = null;

    /**
     * Contains all Settings Container names.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var array
     *
     * Edited:
     * 2.2.2  added tab for Custom CSS  2020-12-15T0740+0100
     *
     * These are the storage container names, one per dashboard tab.
     */
    private $a_arr_Container = array(
        "footnotes_storage",
        "footnotes_storage_custom",
        "footnotes_storage_expert",
        "footnotes_storage_custom_css",
    );

    /**
     * Contains all Default Settings for each Settings Container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var array
     */
    private $a_arr_Default = array(

        "footnotes_storage" => array(

            self::C_STR_FOOTNOTES_SHORT_CODE_START => '((',
            self::C_STR_FOOTNOTES_SHORT_CODE_END => '))',
            self::C_STR_FOOTNOTES_SHORT_CODE_START_USER_DEFINED => '',
            self::C_STR_FOOTNOTES_SHORT_CODE_END_USER_DEFINED => '',
            self::C_STR_FOOTNOTES_COUNTER_STYLE => 'arabic_plain',
            self::C_INT_FOOTNOTES_SCROLL_OFFSET   => 20,
            self::C_INT_FOOTNOTES_SCROLL_DURATION => 380,

            self::C_STR_REFERENCE_CONTAINER_NAME => 'References',
            self::C_BOOL_REFERENCE_CONTAINER_COLLAPSE => 'no',
            self::C_STR_REFERENCE_CONTAINER_POSITION => 'post_end',
            self::C_BOOL_COMBINE_IDENTICAL_FOOTNOTES => 'yes',

            // whether to enqueue additional style sheet:
            self::C_STR_FOOTNOTES_PAGE_LAYOUT_SUPPORT => 'none',

            self::C_STR_REFERENCE_CONTAINER_POSITION_SHORTCODE      => '[[references]]',
            self::C_BOOL_REFERENCE_CONTAINER_START_PAGE_ENABLE      => 'yes',
            self::C_BOOL_REFERENCE_CONTAINER_3COLUMN_LAYOUT_ENABLE  => 'no',
            self::C_BOOL_REFERENCE_CONTAINER_BACKLINK_SYMBOL_ENABLE => 'yes',
            self::C_BOOL_REFERENCE_CONTAINER_BACKLINK_SYMBOL_SWITCH => 'no',

            // backlink separators and terminators are often not preferred.
            // but a choice must be provided along with the ability to customize:
            self::C_BOOL_BACKLINKS_SEPARATOR_ENABLED  => 'yes',
            self::C_STR_BACKLINKS_SEPARATOR_OPTION    => 'comma',
            self::C_STR_BACKLINKS_SEPARATOR_CUSTOM    => '',
            self::C_BOOL_BACKLINKS_TERMINATOR_ENABLED => 'no',
            self::C_STR_BACKLINKS_TERMINATOR_OPTION   => 'full_stop',
            self::C_STR_BACKLINKS_TERMINATOR_CUSTOM   => '',

            // set backlinks column width:
            self::C_BOOL_BACKLINKS_COLUMN_WIDTH_ENABLED => 'no',
            self::C_INT_BACKLINKS_COLUMN_WIDTH_SCALAR  => '50',
            self::C_STR_BACKLINKS_COLUMN_WIDTH_UNIT    => 'px',

            // set backlinks column max width:
            self::C_BOOL_BACKLINKS_COLUMN_MAX_WIDTH_ENABLED => 'no',
            self::C_INT_BACKLINKS_COLUMN_MAX_WIDTH_SCALAR  => '140',
            self::C_STR_BACKLINKS_COLUMN_MAX_WIDTH_UNIT    => 'px',

            // whether a <br /> tag is inserted:
            self::C_BOOL_BACKLINKS_LINE_BREAKS_ENABLED => 'no',

            // whether to enable URL line wrapping:
            self::C_BOOL_FOOTNOTE_URL_WRAP_ENABLED => 'yes',

            // whether to use link elements:
            self::C_BOOL_LINK_ELEMENT_ENABLED => 'yes',

            // excerpt should be disabled:
            self::C_BOOL_FOOTNOTES_IN_EXCERPT => 'no',

            // since removal of the_post hook, expert mode is no danger zone
            // not for experts only; raising awareness about relative positioning
            // changed default to 'yes':
            self::C_BOOL_FOOTNOTES_EXPERT_MODE => 'yes',

            self::C_STR_FOOTNOTES_LOVE => 'no',

        ),

        "footnotes_storage_custom" => array(

            self::C_STR_FOOTNOTES_TOOLTIP_READON_LABEL => 'Continue reading',

            self::C_BOOL_FOOTNOTES_REFERRER_SUPERSCRIPT_TAGS => 'yes',

            // The default footnote referrer surroundings should be square brackets:
            // * with respect to baseline footnote referrers new option;
            // * as in English or US American typesetting;
            // * for better UX thanks to a more button-like appearance;
            // * for stylistic consistency with the expand-collapse button;
            self::C_STR_FOOTNOTES_STYLING_BEFORE => '[',
            self::C_STR_FOOTNOTES_STYLING_AFTER => ']',

            self::C_BOOL_FOOTNOTES_MOUSE_OVER_BOX_ENABLED => 'yes',

            // alternative, low-script tooltips using CSS for transitions
            // in response to user demand for website with jQuery UI outage
            self::C_BOOL_FOOTNOTES_MOUSE_OVER_BOX_ALTERNATIVE => 'no',

            // The mouse over content truncation should be enabled by default
            // to raise awareness of the functionality and to prevent the screen
            // from being filled at mouse-over, and to allow the Continue reading:
            self::C_BOOL_FOOTNOTES_MOUSE_OVER_BOX_EXCERPT_ENABLED => 'yes',

            // The truncation length is raised from 150 to 200 chars:
            self::C_INT_FOOTNOTES_MOUSE_OVER_BOX_EXCERPT_LENGTH => 200,

            // The default position should not be lateral because of the risk
            // the box gets squeezed between note anchor at line end and window edge,
            // and top because reading at the bottom of the window is more likely:
            self::C_STR_FOOTNOTES_MOUSE_OVER_BOX_POSITION => 'top center',

            self::C_INT_FOOTNOTES_MOUSE_OVER_BOX_OFFSET_X => 0,
            // The vertical offset must be negative for the box not to cover
            // the current line of text (web coordinates origin is top left):
            self::C_INT_FOOTNOTES_MOUSE_OVER_BOX_OFFSET_Y => -7,

            // tooltip display durations:
            // called mouse over box not tooltip for consistency
            self::C_INT_MOUSE_OVER_BOX_FADE_IN_DELAY      =>   0,
            self::C_INT_MOUSE_OVER_BOX_FADE_IN_DURATION   => 200,
            self::C_INT_MOUSE_OVER_BOX_FADE_OUT_DELAY     => 400,
            self::C_INT_MOUSE_OVER_BOX_FADE_OUT_DURATION  => 200,

            // tooltip font size reset to legacy by default since 2.1.4;
            // was set to inherit since 2.1.1 as it overrode custom CSS,
            // is moved to settings since 2.1.4    2020-12-04T1023+0100
            self::C_BOOL_MOUSE_OVER_BOX_FONT_SIZE_ENABLED => 'yes',
            self::C_FLO_MOUSE_OVER_BOX_FONT_SIZE_SCALAR   => 13,
            self::C_STR_MOUSE_OVER_BOX_FONT_SIZE_UNIT     => 'px',

            self::C_STR_FOOTNOTES_MOUSE_OVER_BOX_COLOR => '',
            // The mouse over box shouldn’t feature a colored background
            // by default, due to diverging user preferences. White is neutral:
            self::C_STR_FOOTNOTES_MOUSE_OVER_BOX_BACKGROUND => '#ffffff',

            self::C_INT_FOOTNOTES_MOUSE_OVER_BOX_BORDER_WIDTH => 1,
            self::C_STR_FOOTNOTES_MOUSE_OVER_BOX_BORDER_COLOR => '#cccc99',

            // The mouse over box corners mustn’t be rounded as that is outdated:
            self::C_INT_FOOTNOTES_MOUSE_OVER_BOX_BORDER_RADIUS => 0,

            // The width should be limited to start with, for the box to have shape:
            self::C_INT_FOOTNOTES_MOUSE_OVER_BOX_MAX_WIDTH => 450,

            self::C_STR_FOOTNOTES_MOUSE_OVER_BOX_SHADOW_COLOR => '#666666',
            self::C_STR_HYPERLINK_ARROW => '&#8593;',
            self::C_STR_HYPERLINK_ARROW_USER_DEFINED => '',

            // Custom CSS migrates to a dedicated tab:
            self::C_STR_CUSTOM_CSS => '',

        ),

        "footnotes_storage_expert" => array(

            // checkboxes

            // Titles should all be enabled by default to prevent users from
            // thinking at first that the feature is broken in post titles.
            // See <https://wordpress.org/support/topic/more-feature-ideas/>
            // Yet in titles, footnotes are functionally pointless in WordPress.
            self::C_BOOL_EXPERT_LOOKUP_THE_TITLE => '',

            // This is the only useful one:
            self::C_BOOL_EXPERT_LOOKUP_THE_CONTENT => 'checked',

            // And the_excerpt is disabled by default following @nikelaos in
            // <https://wordpress.org/support/topic/jquery-comes-up-in-feed-content/#post-13110879>
            // <https://wordpress.org/support/topic/doesnt-work-any-more-11/#post-13687068>
            self::C_BOOL_EXPERT_LOOKUP_THE_EXCERPT => '',

            self::C_BOOL_EXPERT_LOOKUP_WIDGET_TITLE => '',

            // The widget_text hook must be disabled, because a footnotes container is inserted
            // at the bottom of each widget, but multiple containers in a page are not disambiguated.
            // E.g. enabling this causes issues with footnotes in Elementor accordions.
            self::C_BOOL_EXPERT_LOOKUP_WIDGET_TEXT => '',

            // initially hard-coded default
            // shows "9223372036854780000" instead of 9223372036854775807 in the numbox
            // empty should be interpreted as PHP_INT_MAX, but a numbox cannot be set to empty:
            // <https://github.com/Modernizr/Modernizr/issues/171>
            // interpret -1 as PHP_INT_MAX instead
            self::C_INT_EXPERT_LOOKUP_THE_TITLE_PRIORITY_LEVEL    => PHP_INT_MAX,

            // Priority level of the_content, as the only relevant priority level
            // must be less than 99 because social buttons may yield scripts that
            // contain the strings '((' and '))', i.e. the default footnote start
            // and end short codes, causing issues with fake footnotes.
            self::C_INT_EXPERT_LOOKUP_THE_CONTENT_PRIORITY_LEVEL  => 98,
            self::C_INT_EXPERT_LOOKUP_THE_EXCERPT_PRIORITY_LEVEL  => PHP_INT_MAX,
            self::C_INT_EXPERT_LOOKUP_WIDGET_TITLE_PRIORITY_LEVEL => PHP_INT_MAX,
            self::C_INT_EXPERT_LOOKUP_WIDGET_TEXT_PRIORITY_LEVEL  => PHP_INT_MAX,

        ),

        "footnotes_storage_custom_css" => array(

            self::C_STR_CUSTOM_CSS_NEW => '',
            self::C_BOOL_CUSTOM_CSS_MIGRATED => '',

        ),

    );

    /**
     * Contains all Settings from each Settings container as soon as this class is initialized.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @var array
     */
    private $a_arr_Settings = array();

    /**
     * Class Constructor. Loads all Settings from each WordPress Settings container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     */
    private function __construct() {
        $this->loadAll();
    }

    /**
     * Returns a singleton of this class.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @return MCI_Footnotes_Settings
     */
    public static function instance() {
        // no instance defined yet, load it
        if (self::$a_obj_Instance === null) {
            self::$a_obj_Instance = new self();
        }
        // return a singleton of this class
        return self::$a_obj_Instance;
    }

    /**
     * Returns the name of a specified Settings Container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @param int $p_int_Index Settings Container Array Key Index.
     * @return string Settings Container name.
     */
    public function getContainer($p_int_Index) {
        return $this->a_arr_Container[$p_int_Index];
    }

    /**
     * Returns the default values of a specific Settings Container.
     *
     * @author Stefan Herndler
     * @since 1.5.6
     * @param int $p_int_Index Settings Container Aray Key Index.
     * @return array
     */
    public function getDefaults($p_int_Index) {
        return $this->a_arr_Default[$this->a_arr_Container[$p_int_Index]];
    }

    /**
     * Loads all Settings from each Settings container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     */
    private function loadAll() {
        // clear current settings
        $this->a_arr_Settings = array();
        for ($i = 0; $i < count($this->a_arr_Container); $i++) {
            // load settings
            $this->a_arr_Settings = array_merge($this->a_arr_Settings, $this->Load($i));
        }
    }

    /**
     * Loads all Settings from specified Settings Container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @param int $p_int_Index Settings Container Array Key Index.
     * @return array Settings loaded from Container of Default Settings if Settings Container is empty (first usage).
     */
    private function Load($p_int_Index) {
        // load all settings from container
        $l_arr_Options = get_option($this->getContainer($p_int_Index));
        // load all default settings
        $l_arr_Default = $this->a_arr_Default[$this->getContainer($p_int_Index)];

        // no settings found, set them to their default value
        if (empty($l_arr_Options)) {
            return $l_arr_Default;
        }
        // iterate through all available settings ( = default values)
        foreach($l_arr_Default as $l_str_Key => $l_str_Value) {
            // available setting not found in the container
            if (!array_key_exists($l_str_Key, $l_arr_Options)) {
                // define the setting with its default value
                $l_arr_Options[$l_str_Key] = $l_str_Value;
            }
        }
        // iterate through each setting in the container
        foreach($l_arr_Options as $l_str_Key => $l_str_Value) {
            // remove all whitespace at the beginning and end of a setting
            //$l_str_Value = trim($l_str_Value);
            // write the sanitized value back to the setting container
            $l_arr_Options[$l_str_Key] = $l_str_Value;
        }
        // return settings loaded from Container
        return $l_arr_Options;
    }

    /**
     * Updates a whole Settings container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @param int $p_int_Index Index of the Settings container.
     * @param array $p_arr_newValues new Settings.
     * @return bool
     */
    public function saveOptions($p_int_Index, $p_arr_newValues) {
        if (update_option($this->getContainer($p_int_Index), $p_arr_newValues)) {
            $this->loadAll();
            return true;
        }
        return false;
    }

    /**
     * Returns the value of specified Settings name.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     * @param string $p_str_Key Settings Array Key name.
     * @return mixed Value of the Setting on Success or Null in Settings name is invalid.
     */
    public function get($p_str_Key) {
        return array_key_exists($p_str_Key, $this->a_arr_Settings) ? $this->a_arr_Settings[$p_str_Key] : null;
    }

    /**
     * Deletes each Settings Container and loads the default values for each Settings Container.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     *
     * Edit: This didn’t actually work.
     * @since 2.2.0 this function is not called any longer when deleting the plugin,
     * to protect user data against loss, since manually updating a plugin is safer
     * done by deleting and reinstalling (see the warning about database backup).
     * 2020-12-13T1353+0100
     */
    public function ClearAll() {
        // iterate through each Settings Container
        for ($i = 0; $i < count($this->a_arr_Container); $i++) {
            // delete the settings container
            delete_option($this->getContainer($i));
        }
        // set settings back to the default values
        $this->a_arr_Settings = $this->a_arr_Default;
    }

    /**
     * Register all Settings Container for the Plugin Settings Page in the Dashboard.
     * Settings Container Label will be the same as the Settings Container Name.
     *
     * @author Stefan Herndler
     * @since 1.5.0
     */
    public function RegisterSettings() {
        // register all settings
        for ($i = 0; $i < count($this->a_arr_Container); $i++) {
            register_setting($this->getContainer($i), $this->getContainer($i));
        }
    }
}

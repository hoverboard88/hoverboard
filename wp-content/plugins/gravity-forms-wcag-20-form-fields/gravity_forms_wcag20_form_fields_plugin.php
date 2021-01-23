<?php
/*
Plugin Name: WCAG 2.0 form fields for Gravity Forms
Description: Extends the Gravity Forms plugin. Modifies fields and improves validation so that forms meet WCAG 2.0 accessibility requirements.
Tags: Gravity Forms, wcag, accessibility, forms
Version: 1.7.2
Author: Adrian Gordon
Author URI: https://www.itsupportguides.com
License: GPL2
Text Domain: gravity-forms-wcag-20-form-fields

------------------------------------------------------------------------
Copyright 2015 Adrian Gordon

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA

*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

load_plugin_textdomain( 'gravity-forms-wcag-20-form-fields', false, dirname( plugin_basename( __FILE__ ) ) . '/lang' );

add_action( 'admin_notices', array( 'ITSP_GF_WCAG20_Form_Fields', 'admin_warnings' ), 20 );

if ( ! class_exists( 'ITSP_GF_WCAG20_Form_Fields' ) ) {
    class ITSP_GF_WCAG20_Form_Fields {
		private static $name = 'WCAG 2.0 form fields for Gravity Forms';
		private static $slug = 'gravity-forms-wcag-20-form-fields';

        /**
         * Construct the plugin object
         */
		 public function __construct() {
			// register plugin functions through 'gform_loaded' -
			// this delays the registration until all plugins have been loaded, ensuring it does not run before Gravity Forms is available.
            add_action( 'gform_loaded', array( $this, 'register_actions' ) );
        } // END __construct

		/**
         * Register plugin functions
         */
		function register_actions() {
				//start plug in
				add_filter( 'gform_column_input_content',  array( $this, 'change_column_add_title_wcag' ), 10, 6 );
				add_filter( 'gform_field_content',  array( $this, 'change_fields_content_wcag' ), 10, 5 );
				add_action( 'gform_enqueue_scripts',  array( $this, 'queue_scripts' ), 90, 3 );
				add_filter( 'gform_tabindex', '__return_false' );   //disable tab-index
				add_filter( 'gform_validation_message', array( $this, 'change_validation_message' ), 10, 2 );
		 } // END register_actions

		function change_validation_message( $message, $form ) {
			$referrer = isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : $_SERVER["REQUEST_URI"];
			$error = '';
			$message = ''; // clear $messages so default GF error message is not displayed (There was a problem with your submission. Errors have been highlighted below.)
			foreach ( $form['fields'] as $field ) {
				$failed_field = $field->failed_validation;
				$failed[] = $failed_field;
				$failed_message = strip_tags( $field->validation_message );
				if ( $failed_field ) {
					$error .= '<li><a href="' . $referrer . '#field_' . $form['id'] . '_' . $field['id'] .'">' . $field['label'] . ' - ' . ( ( "" == $field['errorMessage'] ) ? $failed_message:$field['errorMessage'] ) . '</a></li>';
				}
			}

			$length  = count( array_keys( $failed, true ) );
			$prompt  = sprintf( _n( 'There was %s error found in the information you submitted', 'There were %s errors found in the information you submitted', $length, 'gravity-forms-wcag-20-form-fields' ), $length );

			$message .= "<div id='error' aria-live='assertive' role='alert'>";
			$message .= "<div class='validation_error' ";
			if( ! has_action( 'itsg_gf_wcag_disable_tabindex' ) ) {
				$message .= "tabindex='-1'";
			}
			$message .= ">";
			$message .= $prompt;
			$message .= "</div>";
			$message .= "<ol class='validation_list'>";
			$message .= $error;
			$message .= "</ol>";
			$message .= "</div>";
			return $message;
		} // END change_validation_message

		/**
         * Replaces field content for repeater lists
		 * - adds title to input fields using the column title
         */
		function change_column_add_title_wcag( $input, $input_info, $field, $text, $value, $form_id ) {
			if ( ! is_admin() && 'print-entry' != RGForms::get( 'gf_page' ) ) {
				if ( ! $field->enableColumns ) {
					$text = htmlspecialchars( $field->label, ENT_QUOTES );
				}
				$input = str_replace( "<input ", "<input title='{$text}'", $input );
			}
			return $input;
		} // END change_column_add_title_wcag

		/**
         * Main function
		 * - Replaces field content with WCAG 2.0 compliant HTML
         */
		function change_fields_content_wcag( $content, $field, $value, $lead_id, $form_id ) {

			// we don't need to change the form  in admin or entry
			if ( is_admin() || 'print-entry' == RGForms::get( 'gf_page' ) ) {
				return $content;
			}


			$field_type = rgar( $field, 'type' );
			$field_required = rgar( $field, 'isRequired' );
			$field_failed_valid = rgar( $field, 'failed_validation' );
			$field_label = htmlspecialchars( rgar( $field, 'label' ), ENT_QUOTES );
			$field_id = rgar( $field, 'id' );
			$field_page = rgar( $field, 'pageNumber' );
			$current_page = GFFormDisplay::get_current_page( $form_id );
			$field_description = rgar( $field, 'description' );
			$field_maxFileSize = rgar( $field, 'maxFileSize' );
			$field_allowedExtensions = rgar( $field, 'allowedExtensions' );

			if ( 'fileupload' == $field_type ) {
				// wrap in fieldset
				if( ! empty( $field_maxFileSize ) ) {
					// turn max file size to human understandable term
					$file_limit = $field_maxFileSize. ' mega bytes';
				}

				if ( ! empty( $field_allowedExtensions ) ) {
					// add accept attribute with comma separated list of accept file types
					$content = str_replace( " type='file' ", " type='file' accept='" . $field_allowedExtensions . "'", $content);
				}

				// only add if either max file size of extension limit specified for field
				if ( !empty( $field_maxFileSize ) ) {
					//add title attirbute to file input field
					$content = str_replace( " type='file' ", " type='file' title='{$field_label}' ", $content );
					//if aria-describedby attribute not already present
					if ( false !== strpos( strtolower( $content ), 'aria-describedby' ) )  {
						$content = str_replace( " aria-describedby='", " aria-describedby='field_{$form_id}_{$field_id}_fmessage ", $content );
					} else {
						// aria-describedby attribute is already present
						$content = str_replace( " name='input_", " aria-describedby='field_{$form_id}_{$field_id}_fmessage' name='input_", $content );
					}
					$content .= "<span id='field_{$form_id}_{$field_id}_fmessage' class='sr-only'>";
					if( !empty( $field_maxFileSize ) ) {
						$content .= __( 'Maximum file size', 'gravity-forms-wcag-20-form-fields' ) . ' - ' . $file_limit . '. ';
					}
					$content .= "</span>";
				}
			}

			// CHECKBOX, RADIO, OPTION UPLOAD FIELDS
			//
			// wrap radio and checkbox fields in fieldset
			// adds aria-required='true' if required field
			// if 'other choice' enabled - label the hidden field
			elseif ( 'checkbox' == $field_type || 'radio' == $field_type || 'option' == $field_type ) {
				// adds labels to radio 'other' field - both the radio and input fields.
				if( 'radio' == $field_type ) {
					foreach( $field['choices'] as $key => $choice ) {
						$isotherchoice = isset( $choice['isOtherChoice'] ) ? $choice['isOtherChoice'] : null;
						if ( $isotherchoice ) {
							$choice_position = $key;
							// add label to radio
							$content = str_replace( "<li class='gchoice_{$form_id}_{$field_id}_" . $choice_position . "'><input name='input_" . $field_id . "' ", "<li class='gchoice_{$form_id}_{$field_id}_" . $choice_position . "'><label id='label_{$form_id}_{$field_id}_" . $choice_position . "' for='choice_{$form_id}_{$field_id}_" . $choice_position . "' class='sr-only'>" . __( 'Other', 'gravity-forms-wcag-20-form-fields' )." </label><label id='label_{$form_id}_{$field_id}_other' for='input_{$form_id}_{$field_id}_other' class='sr-only'>" . __( 'Other', 'gravity-forms-wcag-20-form-fields' )." </label><input name='input_" . $field_id . "' ", $content );
						}
					}
				}

				//wrap in fieldset
				//if <fieldset> not already present
				if ( true !== strpos( strtolower( $content ), 'fieldset' ) )  {
					if ( $field_required ) {
						// GF now ends label with two blank spaces
						$content = str_replace( "<label class='gfield_label'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
					} else {
						// GF now ends label with two blank spaces
						$content = str_replace( "<label class='gfield_label'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
					}
					$content .= "</fieldset>";
				}
			}

			// NAME FIELD
			//
			// name field in fieldset
			// adds aria-required='true' if required field
			elseif ( 'name' == $field_type ) {
				// wrap in fieldset
				// includes variations for 2-8 depending on field configuration
				if ( $field_required ) {
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
				} else {
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>",$content );
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
				}
				$content .= "</fieldset>";
			}

			// EMAIL FIELD
			//
			// wrap email field with confirmation enable in fieldset
			// adds aria-required='true' if required field
			elseif ( 'email' == $field_type && rgar( $field, 'emailConfirmEnabled' ) ) {
				//wrap in fieldset
				if ( $field_required ) {
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
				} else {
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
				}
				$content .= "</fieldset>";
			}

			// ADDRESS FIELD
			//
			// address field in fieldset
			// adds aria-required='true' if required field
			elseif ( 'address' == $field_type ) {
				//wrap in fieldset
				if ( $field_required ) {
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
				} else {
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
				}
				$content .= "</fieldset>";
			}

			// TIME FIELD
			elseif ( 'time' == $field_type ) {
				//wrap in fieldset
				if ( $field_required ) {
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex' for='input_{$form_id}_{$field_id}_1' >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
				} else {
					$content = str_replace( "<label class='gfield_label gfield_label_before_complex' for='input_{$form_id}_{$field_id}_1' >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
				}
				$content .= "</fieldset>";

				// add sr-only label for AM/PM select drop download
				$content = str_replace( "<select name='input_{$field_id}[]' id='input_{$form_id}_{$field_id}_3'", "<label for='input_{$form_id}_{$field_id}_3' class='sr-only' >" . __( 'AM/PM', 'gravity-forms-wcag-20-form-fields' ) . "</label><select name='input_{$field_id}[]' id='input_{$form_id}_{$field_id}_3'", $content );
			}

			// LIST FIELD
			//
			// wrap list fields in fieldset
			// set shim input type to hidden
			// add hidden table header for add/remove column
			elseif ( 'list' == $field_type ) {
				//wrap list fields in fieldset
				if ( $field_required ) {
					$content = str_replace( "<label class='gfield_label'  >{$field_label}<span class='gfield_required'>*</span></label>", "<fieldset aria-required='true' class='gfieldset'><legend class='gfield_label'>{$field_label}<span class='gfield_required'>*</span></legend>", $content );
				} else {
					$content = str_replace( "<label class='gfield_label'  >{$field_label}</label>", "<fieldset class='gfieldset'><legend class='gfield_label'>{$field_label}</legend>", $content );
				}

				$content .= "</fieldset>";
			}

			// WEBSITE field
			//
			// add description for website field
			elseif ( 'website' == $field_type ){
				$content = str_replace( "<label class='gfield_label' for='input_{$form_id}_{$field_id}' >" . $field_label, "<label class='gfield_label' for='input_{$form_id}_{$field_id}' >{$field_label} <span id='field_{$form_id}_{$field_id}_dmessage' class='sr-only'> - " . __( 'enter a valid website URL for example https://www.google.com', 'gravity-forms-wcag-20-form-fields' ) . "</span>", $content );

				// attach to aria-described-by
				$content = str_replace( " name='input_", " aria-describedby='field_{$form_id}_{$field_id}_dmessage' name='input_", $content );
			}

			// DATE FIELD
			//
			// add description for date field
			elseif ( 'date' == $field_type ) {
				if ( 'dmy' == $field['dateFormat'] ) {
					$date_format = 'dd/mm/yyyy';
				} elseif ( 'dmy_dash' == $field['dateFormat'] ) {
					$date_format = 'dd-mm-yyyy';
				} elseif ( 'dmy_dot' == $field['dateFormat'] ) {
					$date_format = 'dd.mm.yyyy';
				} elseif ( 'ymd_slash' == $field['dateFormat'] ) {
					$date_format = 'yyyy/mm/dd';
				} elseif ( 'ymd_dash' == $field['dateFormat'] ) {
					$date_format = 'yyyy-mm-dd';
				} elseif ( 'ymd_dot' == $field['dateFormat'] ) {
					$date_format = 'yyyy.mm.dd';
				} else {
					$date_format = 'mm/dd/yyyy';
				}

				$content = str_replace( "<label class='gfield_label' for='input_{$form_id}_{$field_id}' >{$field_label}", "<label class='gfield_label' for='input_{$form_id}_{$field_id}' >{$field_label} <span id='field_{$form_id}_{$field_id}_dmessage' class='sr-only'> - " . sprintf( __( 'must be %s format', 'gravity-forms-wcag-20-form-fields' ), $date_format ) . "</span>", $content );

				// attach to aria-described-by
				$content = str_replace( " name='input_", " aria-describedby='field_{$form_id}_{$field_id}_dmessage' name='input_", $content);
			}

			// ALL FIELDS

			// add screen reader text for required fields
			if( $field_required ) {
				$text_required =  __( 'Required', 'gravity-forms-wcag-20-form-fields' );
				//add screen reader only 'Required' message to asterisk
				$content = str_replace( "*</span>", " * <span class='sr-only'> {$text_required}</span></span>", $content );
			}

			return $content;
		} // END change_fields_content_wcag

		/*
         * Enqueue styles and scripts.
         */
		public static function queue_scripts( $form, $is_ajax ) {
			if ( ! is_admin() ) {
				$min = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG || isset( $_GET['gform_debug'] ) ? '' : '.min';

				/*
			     * CSS styles - remove border, margin and padding from fieldset
				 */
				wp_enqueue_style( 'gravity-forms-wcag-20-form-fields-css', plugins_url( "css/gf_wcag20_form_fields{$min}.css", __FILE__ ) );

				/*
				 * Looks for links in form body (in descriptions, HTML fields etc.)
				 * changes them to open in a new window and adds/appends
				 * 'this link will open in a new window' to title for screen reader users.
				 */

				wp_register_script( 'gf_wcag20_form_fields_js', plugins_url( "/js/gf_wcag20_form_fields{$min}.js", __FILE__ ),  array( 'jquery' ) );

				$failed_validation = false;

				foreach ( $form['fields'] as $field ) {
					$failed_validation = $field->failed_validation;
					if ( $failed_validation ) {
						break;
					}
				}

				$settings_array = array(
					'new_window_text' => esc_js( __( 'this link will open in a new window', 'gravity-forms-wcag-20-form-fields' ) ),
					'failed_validation' => $failed_validation
				);

				wp_localize_script( 'gf_wcag20_form_fields_js', 'gf_wcag20_form_fields_settings', $settings_array );

				// Enqueued script with localized data.
				wp_enqueue_script( 'gf_wcag20_form_fields_js' );

			}
		}  // END queue_scripts

		/*
         * Warning message if Gravity Forms is not installed and enabled
         */
		public static function admin_warnings() {
			if ( !self::is_gravityforms_installed() ) {
				$gravityforms_url = '<a href="https://rocketgenius.pxf.io/dbOK" target="_blank" >' . __( 'download the latest version', 'gravity-forms-wcag-20-form-fields' ) . '</a>';

				printf(
					'<div class="error"><h3>%s</h3><p>%s</p><p>%s</p></div>',
						__( 'Warning', 'gravity-forms-wcag-20-form-fields' ),
						sprintf ( __( 'The plugin %s requires Gravity Forms to be installed.', 'gravity-forms-wcag-20-form-fields' ), '<strong>'.self::$name.'</strong>' ),
						sprintf ( __( 'Please %s of Gravity Forms and try again.', 'gravity-forms-wcag-20-form-fields' ), $gravityforms_url )
				);
			}
		} // END admin_warnings

		/*
         * Check if GF is installed
         */
        private static function is_gravityforms_installed() {
			return class_exists( 'GFCommon' );
        } // END is_gravityforms_installed
	}
    $ITSP_GF_WCAG20_Form_Fields = new ITSP_GF_WCAG20_Form_Fields();
}
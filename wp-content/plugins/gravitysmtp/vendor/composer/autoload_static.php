<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitafc46fa43a9f59f1824e8877a98abe17
{
    public static $files = array (
        'de106312193d3b5d7e278f8e63c27774' => __DIR__ . '/../..' . '/includes/functions_include.php',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Get_Paginated_Debug_Log_Items' => __DIR__ . '/../..' . '/includes/logging/endpoints/get-paginated-debug-log-items.php',
        'Get_Paginated_Log_Items' => __DIR__ . '/../..' . '/includes/logging/endpoints/get-paginated-items.php',
        'Get_Paginated_Suppression_Items' => __DIR__ . '/../..' . '/includes/suppression/endpoints/get-paginated-items.php',
        'Gravity_Forms\\Gravity_SMTP\\Alerts\\Alerts_Handler' => __DIR__ . '/../..' . '/includes/alerts/class-alerts-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Alerts\\Alerts_Service_Provider' => __DIR__ . '/../..' . '/includes/alerts/class-alerts-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Alerts\\Config\\Alerts_Config' => __DIR__ . '/../..' . '/includes/alerts/config/class-alerts-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Alerts\\Config\\Alerts_Endpoints_Config' => __DIR__ . '/../..' . '/includes/alerts/config/class-alerts-endpoints-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Alerts\\Connectors\\Alert_Connector' => __DIR__ . '/../..' . '/includes/alerts/connectors/interface-alert-connector.php',
        'Gravity_Forms\\Gravity_SMTP\\Alerts\\Connectors\\Slack_Alert_Connector' => __DIR__ . '/../..' . '/includes/alerts/connectors/class-slack-alert-connector.php',
        'Gravity_Forms\\Gravity_SMTP\\Alerts\\Connectors\\Twilio_Alert_Connector' => __DIR__ . '/../..' . '/includes/alerts/connectors/class-twilio-alert-connector.php',
        'Gravity_Forms\\Gravity_SMTP\\Alerts\\Endpoints\\Save_Alerts_Settings_Endpoint' => __DIR__ . '/../..' . '/includes/alerts/endpoints/class-save-alerts-settings-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\App_Service_Provider' => __DIR__ . '/../..' . '/includes/apps/class-apps-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Config\\Apps_Config' => __DIR__ . '/../..' . '/includes/apps/config/class-apps-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Config\\Dashboard_Config' => __DIR__ . '/../..' . '/includes/apps/config/class-dashboard-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Config\\Email_Log_Config' => __DIR__ . '/../..' . '/includes/apps/config/class-email-log-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Config\\Email_Log_Single_Config' => __DIR__ . '/../..' . '/includes/apps/config/class-email-log-single-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Config\\Settings_Config' => __DIR__ . '/../..' . '/includes/apps/config/class-settings-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Config\\Tools_Config' => __DIR__ . '/../..' . '/includes/apps/config/class-tools-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Endpoints\\Get_Dashboard_Data_Endpoint' => __DIR__ . '/../..' . '/includes/apps/endpoints/class-get-dashboard-data-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Migration\\Endpoints\\Migrate_Settings_Endpoint' => __DIR__ . '/../..' . '/includes/migration/endpoints/class-migrate-settings-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Setup_Wizard\\Config\\Setup_Wizard_Config' => __DIR__ . '/../..' . '/includes/apps/setup-wizard/config/class-setup-wizard-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Setup_Wizard\\Config\\Setup_Wizard_Endpoints_Config' => __DIR__ . '/../..' . '/includes/apps/setup-wizard/config/class-setup-wizard-endpoints-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Setup_Wizard\\Endpoints\\License_Check_Endpoint' => __DIR__ . '/../..' . '/includes/apps/setup-wizard/endpoints/class-license-check-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Apps\\Setup_Wizard\\Setup_Wizard_Service_Provider' => __DIR__ . '/../..' . '/includes/apps/setup-wizard/class-setup-wizard-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Assets\\Assets_Service_Provider' => __DIR__ . '/../..' . '/includes/assets/class-assets-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Config\\Connector_Config' => __DIR__ . '/../..' . '/includes/connectors/config/class-connector-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Config\\Connector_Endpoints_Config' => __DIR__ . '/../..' . '/includes/connectors/config/class-connector-endpoints-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Connector_Base' => __DIR__ . '/../..' . '/includes/connectors/class-connector-base.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Connector_Factory' => __DIR__ . '/../..' . '/includes/connectors/class-connector-factory.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Connector_Service_Provider' => __DIR__ . '/../..' . '/includes/connectors/class-connector-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Endpoints\\Check_Background_Tasks_Endpoint' => __DIR__ . '/../..' . '/includes/connectors/endpoints/class-check-background-tasks-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Endpoints\\Cleanup_Data_Endpoint' => __DIR__ . '/../..' . '/includes/connectors/endpoints/class-cleanup-data-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Endpoints\\Get_Connector_Emails' => __DIR__ . '/../..' . '/includes/connectors/endpoints/class-get-connector-emails-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Endpoints\\Get_Single_Email_Data_Endpoint' => __DIR__ . '/../..' . '/includes/connectors/endpoints/class-get-single-email-data-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Endpoints\\Save_Connector_Settings_Endpoint' => __DIR__ . '/../..' . '/includes/connectors/endpoints/class-save-connector-settings-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Endpoints\\Save_Plugin_Settings_Endpoint' => __DIR__ . '/../..' . '/includes/connectors/endpoints/class-save-plugin-settings-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Endpoints\\Send_Test_Endpoint' => __DIR__ . '/../..' . '/includes/connectors/endpoints/class-send-test-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Oauth\\Google_Oauth_Handler' => __DIR__ . '/../..' . '/includes/connectors/oauth/class-google-oauth-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Oauth\\Microsoft_Oauth_Handler' => __DIR__ . '/../..' . '/includes/connectors/oauth/class-microsoft-oauth-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Oauth\\Zoho_Oauth_Handler' => __DIR__ . '/../..' . '/includes/connectors/oauth/class-zoho-oauth-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Oauth_Data_Handler' => __DIR__ . '/../..' . '/includes/connectors/class-oauth-data-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Amazon' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-amazon.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Brevo' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-brevo.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Generic' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-generic.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Google' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-google.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Mailchimp' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-mailchimp.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Mailgun' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-mailgun.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Microsoft' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-microsoft.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Phpmail' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-phpmail.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Postmark' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-postmark.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_SMTP2GO' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-smtp2go.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Sendgrid' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-sendgrid.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Sparkpost' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-sparkpost.php',
        'Gravity_Forms\\Gravity_SMTP\\Connectors\\Types\\Connector_Zoho' => __DIR__ . '/../..' . '/includes/connectors/types/class-connector-zoho.php',
        'Gravity_Forms\\Gravity_SMTP\\Data_Store\\Const_Data_Store' => __DIR__ . '/../..' . '/includes/datastore/class-const-data-store.php',
        'Gravity_Forms\\Gravity_SMTP\\Data_Store\\Data_Store' => __DIR__ . '/../..' . '/includes/datastore/interface-data-store.php',
        'Gravity_Forms\\Gravity_SMTP\\Data_Store\\Data_Store_Router' => __DIR__ . '/../..' . '/includes/datastore/class-data-store-router.php',
        'Gravity_Forms\\Gravity_SMTP\\Data_Store\\Opts_Data_Store' => __DIR__ . '/../..' . '/includes/datastore/class-opts-data-store.php',
        'Gravity_Forms\\Gravity_SMTP\\Data_Store\\Plugin_Opts_Data_Store' => __DIR__ . '/../..' . '/includes/datastore/class-plugin-opts-data-store.php',
        'Gravity_Forms\\Gravity_SMTP\\Email_Management\\Config\\Managed_Email_Types_Config' => __DIR__ . '/../..' . '/includes/email-management/config/class-managed-email-types-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Email_Management\\Email_Management_Service_Provider' => __DIR__ . '/../..' . '/includes/email-management/class-email-management-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Email_Management\\Email_Stopper' => __DIR__ . '/../..' . '/includes/email-management/class-email-stopper.php',
        'Gravity_Forms\\Gravity_SMTP\\Email_Management\\Managed_Email' => __DIR__ . '/../..' . '/includes/email-management/class-managed-email.php',
        'Gravity_Forms\\Gravity_SMTP\\Enums\\Connector_Status_Enum' => __DIR__ . '/../..' . '/includes/enums/class-connector-status-enum.php',
        'Gravity_Forms\\Gravity_SMTP\\Enums\\Integration_Enum' => __DIR__ . '/../..' . '/includes/enums/class-integration-enum.php',
        'Gravity_Forms\\Gravity_SMTP\\Enums\\Status_Enum' => __DIR__ . '/../..' . '/includes/enums/class-status-enum.php',
        'Gravity_Forms\\Gravity_SMTP\\Enums\\Suppression_Reason_Enum' => __DIR__ . '/../..' . '/includes/enums/class-suppression-reason-enum.php',
        'Gravity_Forms\\Gravity_SMTP\\Enums\\Zoho_Datacenters_Enum' => __DIR__ . '/../..' . '/includes/enums/class-zoho-datacenters-enum.php',
        'Gravity_Forms\\Gravity_SMTP\\Environment\\Config\\Environment_Endpoints_Config' => __DIR__ . '/../..' . '/includes/environment/config/class-environment-endpoints-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Environment\\Endpoints\\Uninstall_Endpoint' => __DIR__ . '/../..' . '/includes/environment/endpoints/class-uninstall-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Environment\\Environment_Details' => __DIR__ . '/../..' . '/includes/environment/class-environment-details.php',
        'Gravity_Forms\\Gravity_SMTP\\Environment\\Environment_Service_Provider' => __DIR__ . '/../..' . '/includes/environment/class-environment-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Errors\\Error_Handler' => __DIR__ . '/../..' . '/includes/errors/class-error-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Errors\\Error_Handler_Service_Provider' => __DIR__ . '/../..' . '/includes/errors/class-error-handler-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Experimental_Features\\Experiment_Features_Handler' => __DIR__ . '/../..' . '/includes/experimental-features/class-experimental-features-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Experimental_Features\\Experimental_Features_Service_Provider' => __DIR__ . '/../..' . '/includes/experimental-features/class-experimental-features-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Feature_Flags\\Config\\Feature_Flags_Config' => __DIR__ . '/../..' . '/includes/feature-flags/config/class-feature-flags-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Feature_Flags\\Feature_Flag_Manager' => __DIR__ . '/../..' . '/includes/feature-flags/class-feature-flag-manager.php',
        'Gravity_Forms\\Gravity_SMTP\\Feature_Flags\\Feature_Flag_Repository' => __DIR__ . '/../..' . '/includes/feature-flags/class-feature-flag-repository.php',
        'Gravity_Forms\\Gravity_SMTP\\Feature_Flags\\Feature_Flags_Service_Provider' => __DIR__ . '/../..' . '/includes/feature-flags/class-feature-flags-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Gravity_SMTP' => __DIR__ . '/../..' . '/includes/class-gravity-smtp.php',
        'Gravity_Forms\\Gravity_SMTP\\Handler\\Config\\Handler_Endpoints_Config' => __DIR__ . '/../..' . '/includes/handler/config/class-handler-endpoints-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Handler\\Endpoints\\Resend_Email_Endpoint' => __DIR__ . '/../..' . '/includes/handler/endpoints/class-resend-email-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Handler\\External\\Gravity_Forms_Note_Handler' => __DIR__ . '/../..' . '/includes/handler/external/class-gravity-forms-note-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Handler\\Handler_Service_Provider' => __DIR__ . '/../..' . '/includes/handler/class-handler-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Handler\\Mail_Handler' => __DIR__ . '/../..' . '/includes/handler/class-mail-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Config\\Logging_Endpoints_Config' => __DIR__ . '/../..' . '/includes/logging/config/class-logging-endpoints-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Debug\\Debug_Log_Event_Handler' => __DIR__ . '/../..' . '/includes/logging/debug/class-debug-log-event-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Debug\\Debug_Logger' => __DIR__ . '/../..' . '/includes/logging/debug/class-debug-logger.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Debug\\Null_Logger' => __DIR__ . '/../..' . '/includes/logging/debug/class-null-logger.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Debug\\Null_Logging_Provider' => __DIR__ . '/../..' . '/includes/logging/debug/class-null-logging-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Endpoints\\Delete_Debug_Logs_Endpoint' => __DIR__ . '/../..' . '/includes/logging/endpoints/class-delete-debug-logs-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Endpoints\\Delete_Email_Endpoint' => __DIR__ . '/../..' . '/includes/logging/endpoints/class-delete-email-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Endpoints\\Delete_Events_Endpoint' => __DIR__ . '/../..' . '/includes/logging/endpoints/class-delete-events-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Endpoints\\Get_Email_Message_Endpoint' => __DIR__ . '/../..' . '/includes/logging/endpoints/class-get-email-message-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Endpoints\\Log_Item_Endpoint' => __DIR__ . '/../..' . '/includes/logging/endpoints/class-log-item-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Endpoints\\View_Log_Endpoint' => __DIR__ . '/../..' . '/includes/logging/endpoints/class-view-log-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Log\\Logger' => __DIR__ . '/../..' . '/includes/logging/log/class-logger.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Log\\WP_Mail_Logger' => __DIR__ . '/../..' . '/includes/logging/log/class-wp-mail-logger.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Logging_Service_Provider' => __DIR__ . '/../..' . '/includes/logging/class-logging-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Logging\\Scheduling\\Handler' => __DIR__ . '/../..' . '/includes/logging/scheduling/handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Managed_Email_Types' => __DIR__ . '/../..' . '/includes/email-management/class-managed-email-types.php',
        'Gravity_Forms\\Gravity_SMTP\\Migration\\Config\\Migration_Endpoints_Config' => __DIR__ . '/../..' . '/includes/migration/config/class-migration-endpoints-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Migration\\Data\\Migration_Data_Gravityforms' => __DIR__ . '/../..' . '/includes/migration/data/class-migration-data-gravityforms.php',
        'Gravity_Forms\\Gravity_SMTP\\Migration\\Data\\Migration_Data_Wpmailsmtp' => __DIR__ . '/../..' . '/includes/migration/data/class-migration-data-wpmailsmtp.php',
        'Gravity_Forms\\Gravity_SMTP\\Migration\\Migration' => __DIR__ . '/../..' . '/includes/migration/class-migration.php',
        'Gravity_Forms\\Gravity_SMTP\\Migration\\Migration_Service_Provider' => __DIR__ . '/../..' . '/includes/migration/class-migration-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Migration\\Migrator' => __DIR__ . '/../..' . '/includes/migration/class-migrator.php',
        'Gravity_Forms\\Gravity_SMTP\\Migration\\Migrator_Collection' => __DIR__ . '/../..' . '/includes/migration/class-migrator-collection.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Debug_Log_Model' => __DIR__ . '/../..' . '/includes/models/class-debug-log-model.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Event_Model' => __DIR__ . '/../..' . '/includes/models/class-event-model.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator' => __DIR__ . '/../..' . '/includes/models/hydrators/interface-hydrator.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Amazon' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-amazon.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Brevo' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-brevo.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Factory' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-factory.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Generic' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-generic.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Google' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-google.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Mailgun' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-mailgun.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Microsoft' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-microsoft.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Phpmail' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-phpmail.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Postmark' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-postmark.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_Sendgrid' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-sendgrid.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Hydrators\\Hydrator_WP_Mail' => __DIR__ . '/../..' . '/includes/models/hydrators/class-hydrator-wp-mail.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Log_Details_Model' => __DIR__ . '/../..' . '/includes/models/class-log-details-model.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Notifications_Model' => __DIR__ . '/../..' . '/includes/models/class-notifications-model.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Suppressed_Emails_Model' => __DIR__ . '/../..' . '/includes/models/class-suppressed-emails-model.php',
        'Gravity_Forms\\Gravity_SMTP\\Models\\Traits\\Can_Compare_Dynamically' => __DIR__ . '/../..' . '/includes/models/traits/trait-can-compare-dynamically.php',
        'Gravity_Forms\\Gravity_SMTP\\Pages\\Admin_Page' => __DIR__ . '/../..' . '/includes/pages/class-admin-page.php',
        'Gravity_Forms\\Gravity_SMTP\\Pages\\Page_Service_Provider' => __DIR__ . '/../..' . '/includes/pages/class-page-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Routing\\Handlers\\Primary_Backup_Handler' => __DIR__ . '/../..' . '/includes/routing/handlers/class-primary-backup-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Routing\\Handlers\\Routing_Handler' => __DIR__ . '/../..' . '/includes/routing/handlers/interface-routing-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Routing\\Routing_Service_Provider' => __DIR__ . '/../..' . '/includes/routing/class-routing-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Suppression\\Config\\Suppression_Settings_Config' => __DIR__ . '/../..' . '/includes/suppression/config/class-suppression-settings-config.php',
        'Gravity_Forms\\Gravity_SMTP\\Suppression\\Endpoints\\Add_Suppressed_Emails_Endpoint' => __DIR__ . '/../..' . '/includes/suppression/endpoints/class-add-suppressed-emails-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Suppression\\Endpoints\\Reactivate_Suppressed_Emails_Endpoint' => __DIR__ . '/../..' . '/includes/suppression/endpoints/class-reactivate-suppressed-emails-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Suppression\\Suppression_Service_Provider' => __DIR__ . '/../..' . '/includes/suppression/class-suppression-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Telemetry\\Telemetry_Background_Processor' => __DIR__ . '/../..' . '/includes/telemetry/class-telemetry-background-processor.php',
        'Gravity_Forms\\Gravity_SMTP\\Telemetry\\Telemetry_Handler' => __DIR__ . '/../..' . '/includes/telemetry/class-telemetry-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Telemetry\\Telemetry_Service_Provider' => __DIR__ . '/../..' . '/includes/telemetry/class-telemetry-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Telemetry\\Telemetry_Snapshot_Data' => __DIR__ . '/../..' . '/includes/telemetry/class-telemetry-snapshot-data.php',
        'Gravity_Forms\\Gravity_SMTP\\Tracking\\Open_Pixel_Handler' => __DIR__ . '/../..' . '/includes/tracking/class-open-pixel-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Tracking\\Tracking_Service_Provider' => __DIR__ . '/../..' . '/includes/tracking/class-tracking-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Translations\\TranslationsPress' => __DIR__ . '/../..' . '/includes/translations/class-translationspress.php',
        'Gravity_Forms\\Gravity_SMTP\\Translations\\Translations_Service_Provider' => __DIR__ . '/../..' . '/includes/translations/class-translations-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Users\\Roles' => __DIR__ . '/../..' . '/includes/users/class-roles.php',
        'Gravity_Forms\\Gravity_SMTP\\Users\\Users_Service_Provider' => __DIR__ . '/../..' . '/includes/users/class-users-service-provider.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\AWS_Signature_Handler' => __DIR__ . '/../..' . '/includes/utils/class-aws-signature-handler.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Attachments_Saver' => __DIR__ . '/../..' . '/includes/utils/class-attachments-saver.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Basic_Encrypted_Hash' => __DIR__ . '/../..' . '/includes/utils/class-basic-ecrypted-hash.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Booliesh' => __DIR__ . '/../..' . '/includes/utils/class-booleish.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Fast_Endpoint' => __DIR__ . '/../..' . '/includes/utils/class-fast-endpoint.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Header_Parser' => __DIR__ . '/../..' . '/includes/utils/class-header-parser.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Import_Data_Checker' => __DIR__ . '/../..' . '/includes/utils/class-import-data-checker.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Recipient' => __DIR__ . '/../..' . '/includes/utils/class-recipient.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Recipient_Collection' => __DIR__ . '/../..' . '/includes/utils/class-recipient-collection.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Recipient_Parser' => __DIR__ . '/../..' . '/includes/utils/class-recipient-parser.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\SQL_Filter_Parser' => __DIR__ . '/../..' . '/includes/utils/class-sql-filter-parser.php',
        'Gravity_Forms\\Gravity_SMTP\\Utils\\Source_Parser' => __DIR__ . '/../..' . '/includes/utils/class-source-parser.php',
        'Gravity_Forms\\Gravity_Tools\\API\\Gravity_Api' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/API/class-gravity-api.php',
        'Gravity_Forms\\Gravity_Tools\\API\\Oauth_Handler' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/API/class-oauth-handler.php',
        'Gravity_Forms\\Gravity_Tools\\Apps\\Registers_Apps' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Apps/trait-registers-apps.php',
        'Gravity_Forms\\Gravity_Tools\\Assets\\Asset_Processor' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Assets/class-asset-processor.php',
        'Gravity_Forms\\Gravity_Tools\\Background_Processing\\Background_Process' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Background_Processing/class-background-process.php',
        'Gravity_Forms\\Gravity_Tools\\Background_Processing\\WP_Async_Request' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Background_Processing/class-wp-async-request.php',
        'Gravity_Forms\\Gravity_Tools\\Cache\\Cache' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Cache/class-cache.php',
        'Gravity_Forms\\Gravity_Tools\\Config' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/class-config.php',
        'Gravity_Forms\\Gravity_Tools\\Config\\App_Config' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Config/class-app-config.php',
        'Gravity_Forms\\Gravity_Tools\\Config_Collection' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/class-config-collection.php',
        'Gravity_Forms\\Gravity_Tools\\Config_Data_Parser' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/class-config-data-parser.php',
        'Gravity_Forms\\Gravity_Tools\\Data\\Oauth_Data_Handler' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Data/interface-oauth-data-handler.php',
        'Gravity_Forms\\Gravity_Tools\\Data\\Transient_Strategy' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Data/class-transient-strategy.php',
        'Gravity_Forms\\Gravity_Tools\\Endpoints\\Endpoint' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Endpoints/class-endpoint.php',
        'Gravity_Forms\\Gravity_Tools\\License\\API_Response' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/License/class-api-response.php',
        'Gravity_Forms\\Gravity_Tools\\License\\License_API_Connector' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/License/class-license-api-connector.php',
        'Gravity_Forms\\Gravity_Tools\\License\\License_API_Response' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/License/class-license-api-response.php',
        'Gravity_Forms\\Gravity_Tools\\License\\License_API_Response_Factory' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/License/class-license-api-response-factory.php',
        'Gravity_Forms\\Gravity_Tools\\License\\License_Statuses' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/License/class-license-statuses.php',
        'Gravity_Forms\\Gravity_Tools\\Logging\\DB_Logging_Provider' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Logging/class-db-logging-provider.php',
        'Gravity_Forms\\Gravity_Tools\\Logging\\File_Logging_Provider' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Logging/class-file-logging-provider.php',
        'Gravity_Forms\\Gravity_Tools\\Logging\\Log_Line' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Logging/class-log-line.php',
        'Gravity_Forms\\Gravity_Tools\\Logging\\Logger' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Logging/class-logger.php',
        'Gravity_Forms\\Gravity_Tools\\Logging\\Logging_Provider' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Logging/interface-logging-provider.php',
        'Gravity_Forms\\Gravity_Tools\\Logging\\Parsers\\File_Log_Parser' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Logging/parsers/class-file-log-parser.php',
        'Gravity_Forms\\Gravity_Tools\\Model\\Form_Model' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Model/class-form-model.php',
        'Gravity_Forms\\Gravity_Tools\\Providers\\Config_Collection_Service_Provider' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Providers/class-config-collection-service-provider.php',
        'Gravity_Forms\\Gravity_Tools\\Providers\\Config_Service_Provider' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Providers/class-config-service-provider.php',
        'Gravity_Forms\\Gravity_Tools\\Service_Container' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/class-service-container.php',
        'Gravity_Forms\\Gravity_Tools\\Service_Provider' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/class-service-provider.php',
        'Gravity_Forms\\Gravity_Tools\\Telemetry\\Telemetry_Data' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Telemetry/class-telemetry-data.php',
        'Gravity_Forms\\Gravity_Tools\\Telemetry\\Telemetry_Processor' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Telemetry/class-telemetry-processor.php',
        'Gravity_Forms\\Gravity_Tools\\Updates\\Auto_Updater' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Updates/class-auto-updater.php',
        'Gravity_Forms\\Gravity_Tools\\Updates\\Updates_Service_Provider' => __DIR__ . '/../..' . '/includes/updates/class-updates-service-provider.php',
        'Gravity_Forms\\Gravity_Tools\\Upgrades\\Upgrade_Routines' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Upgrades/class-upgrade-routines.php',
        'Gravity_Forms\\Gravity_Tools\\Utils\\Common' => __DIR__ . '/..' . '/gravityforms/gravity-tools/src/Utils/class-common.php',
        'Gravity_Forms\\Gravity_Tools\\Utils\\Utils_Service_Provider' => __DIR__ . '/../..' . '/includes/utils/class-utils-service-provider.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInitafc46fa43a9f59f1824e8877a98abe17::$classMap;

        }, null, ClassLoader::class);
    }
}
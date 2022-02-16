<?php

/**
 * Add notification when lite version activated
 * Recurrence: 20 Days
 *
 * @since 7.12.3
 */
final class ExactMetrics_Notification_Upgrade_For_Post_Templates extends ExactMetrics_Notification_Event
{
    public $notification_id = 'exactmetrics_notification_upgrade_for_popular_posts_templates';
    public $notification_interval = 20; // in days
    public $notification_type = array( 'basic', 'lite', 'plus' );
    public $notification_icon = 'star';
    public $notification_category = 'insight';
    public $notification_priority = 3;

    /**
     * Build Notification
     *
     * @return array $notification notification is ready to add
     *
     * @since 7.12.3
     */
    public function prepare_notification_data( $notification ) {
        $notification['title'] = __( 'Upgrade to ExactMetrics Pro', 'google-analytics-dashboard-for-wp' );
        // Translators: upgrade for form conversion notification content
        $notification['content'] = __( 'Upgrade ExactMetrics Pro and use up to 20+ Popular Post templates to help improve engagement and interaction on your site.', 'google-analytics-dashboard-for-wp' );
        $notification['btns']    = array(
            "get_exactmetrics_pro" => array(
                'url'           => $this->get_upgrade_url(),
                'text'          => __( 'Get ExactMetrics Pro', 'google-analytics-dashboard-for-wp' ),
                'is_external'   => true,
            ),
        );

        return $notification;
    }
}

// initialize the class
new ExactMetrics_Notification_Upgrade_For_Post_Templates();

<?php
namespace Ankit\Plugins\Rpm;

/**
 * Class Frontend
 * @package Ankit\Plugins\Rpm
 */
class Frontend
{
    public function __construct()
    {
        //add_filter( 'wp_nav_menu_objects', array( $this, 'rpm_filter' ), 0 );
        add_filter('wp_get_nav_menu_items', array($this, 'get_nav_menu_items'));
    }

    function get_nav_menu_items($items)
    {
        global $wpdb;

        foreach ($items as $key => $item) {

            if ($item->post_type == 'nav_menu_item') {

                // latest
                if ($item->object == 'post_type') {

                    $sql = "SELECT ID
							FROM $wpdb->posts
							WHERE $wpdb->posts.post_type = '$item->type' AND $wpdb->posts.post_status = 'publish'
							ORDER BY $wpdb->posts.menu_order, $wpdb->posts.post_date DESC
							LIMIT 1";

                    $post_id = $wpdb->get_var($sql);
                    $item->object_id = $post_id;
                    $item->url = get_permalink($post_id);

                    // archive and all single
                    if (get_query_var('post_type') == $item->type) {
                        $item->classes[] = 'current-menu-item';
                        $item->current = true;
                    }
                }

            }
        }
        return $items;
    }
}

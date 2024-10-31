<?php
namespace Ankit\Plugins\Rpm;

/**
 * Class Admin
 * @package Ankit\Plugins\Rpm
 */
class Admin
{

    public function __construct()
    {
        add_action('admin_head-nav-menus.php', array($this, 'add_meta_box'));
        add_filter('wp_setup_nav_menu_item', array($this, 'setup_nav_menu_item'));
    }

    function add_meta_box()
    {
        add_meta_box('rpm_post_type', 'Post Type', array($this, 'meta_box_content'), 'nav-menus', 'side', 'default');
    }

    function meta_box_content()
    {
        $post_types = get_post_types(array('show_in_nav_menus' => true), 'object');

        unset($post_types['page']); // exclude Page object

        if ($post_types) {
            foreach ($post_types as $post_type) {
                $post_type->classes = array();
                $post_type->type = $post_type->name;
                $post_type->object_id = $post_type->name;
                $post_type->title = $post_type->labels->name;
                $post_type->object = 'post_type';

                $post_type->menu_item_parent = null;
                $post_type->url = null;
                $post_type->target = null;
                $post_type->attr_title = null;
                $post_type->xfn = null;
                $post_type->db_id = null;
                $post_type->description = null;
            }
            $walker = new \Walker_Nav_Menu_Checklist(array());
            ?>
            <div id="rpm-post-type" class="posttypediv">
                <div id="tabs-panel-rpm" class="tabs-panel tabs-panel-active">
                    <ul id="rpm-list" class="categorychecklist form-no-clear">
                        <?php echo walk_nav_menu_tree(array_map('wp_setup_nav_menu_item', $post_types), 0, (object)array('walker' => $walker)); ?>
                    </ul>
                </div>
            </div>
            <p class="button-controls">
					<span class="add-to-menu">
						<input type="submit" class="button-secondary submit-add-to-menu"
                               value="<?php esc_attr_e('Add to Menu'); ?>" name="add-rpm-menu-item"
                               id="submit-rpm-post-type"/>
					</span>
            </p>
            <?php
        }
    }

    function setup_nav_menu_item($item)
    {
        if (isset($item->object)) {
            if ($item->object == 'post_type') {
                $item->type_label = 'Post Type';

            }
        }
        return $item;
    }
}

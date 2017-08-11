<?php
/**
 * Created by PhpStorm.
 * User: shahnuralam
 * Date: 11/9/15
 * Time: 7:44 PM
 */

namespace WPDM\admin\menus;


class Stats
{
    function __construct()
    {
        add_action('admin_menu', array($this, 'Menu'));
    }

    function Menu()
    {
        $menu_access_cap = apply_filters('wpdm_admin_menu_stats', WPDM_MENU_ACCESS_CAP);
        add_submenu_page('edit.php?post_type=wpdmpro', __('History &lsaquo; Download Manager','download-manager'), __('History','download-manager'), $menu_access_cap, 'wpdm-stats', array($this, 'UI'));
    }

    function UI()
    {
        include(WPDM_BASE_DIR."admin/tpls/stats.php");
    }


}
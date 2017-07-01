<?php
/* Country Custom Post Type */
if( !function_exists( 'create_country_post_type' ) ){
    function create_country_post_type(){

      $labels = array(
        'name' => __( 'Countries'),
        'singular_name' => __( 'Countries' ),
		'menu_name'           => __( 'CSC'),
		'all_items'           => __( 'Countries'),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New Country'),
        'edit_item' => __('Edit Country'),
        'new_item' => __('New Country'),
        'view_item' => __('View Country'),
        'search_items' => __('Search Countries'),
        'not_found' =>  __('No Country found'),
        'not_found_in_trash' => __('No Country found in Trash'),
        'parent_item_colon' => ''
      );

      $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
		//'show_in_menu' => 'edit.php',
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        //'menu_position' => 1,
        'exclude_from_search' => true,
        'supports' => array('title','thumbnail','editor'),
        'rewrite' => array( 'slug' => __('countries', 'framework') ),
		'menu_icon' => ''
      );

      register_post_type('countries',$args);
    }
}
add_action('init', 'create_country_post_type');

function country_admin_head(){
//Below css will add the menu icon for Roster Slider admin menu
?>
<style type="text/css">#adminmenu .menu-icon-countries div.wp-menu-image:before { content: "\f123"; }</style>
<?php
}
add_action('admin_head', 'country_admin_head');

/* Add Custom Columns */
if( !function_exists( 'countries_edit_columns' ) ){
    function countries_edit_columns($columns)
    {

        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __( 'Country Title','framework' ),
			"date" => __( 'Publish Time','framework' )
        );

        return $columns;
    }
}
add_filter("manage_edit-countries_columns", "countries_edit_columns");
?>
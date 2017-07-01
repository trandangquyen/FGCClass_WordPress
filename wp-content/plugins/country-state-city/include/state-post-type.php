<?php
/* State Custom Post Type */
if( !function_exists( 'create_state_post_type' ) ){
    function create_state_post_type(){

      $labels = array(
        'name' => __( 'States'),
        'singular_name' => __( 'States' ),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New State'),
        'edit_item' => __('Edit State'),
        'new_item' => __('New State'),
        'view_item' => __('View State'),
        'search_items' => __('Search States'),
        'not_found' =>  __('No State found'),
        'not_found_in_trash' => __('No State found in Trash'),
        'parent_item_colon' => ''
      );

      $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
		'show_in_menu' => 'edit.php?post_type=countries',
        'query_var' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => 1,
        'exclude_from_search' => true,
        'supports' => array('title','thumbnail','editor'),
        'rewrite' => array( 'slug' => __('states', 'framework') ),
		'menu_icon' => ''
      );

      register_post_type('states',$args);
    }
}
add_action('init', 'create_state_post_type');

function state_admin_head(){
//Below css will add the menu icon for Roster Slider admin menu
?>
<style type="text/css">#adminmenu .menu-icon-states div.wp-menu-image:before { content: "\f123"; }</style>
<?php
}
add_action('admin_head', 'state_admin_head');

add_action( 'add_meta_boxes', 'state_meta_box_add' );
function state_meta_box_add()
{
    add_meta_box( 'state-meta-box-id', 'Provide Related Information', 'state_meta_box_cb', 'states', 'side', 'high' );
}

function state_meta_box_cb( $post )
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
	//print_r( $values['state_meta_box_country']);exit;
    $selected = isset( $values['state_meta_box_country'] ) ?  $values['state_meta_box_country']: '';
     
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'state_meta_box_nonce', 'meta_box_nonce' );
	
	/* country */
	$country_array = array( "" => __('Select Country','framework') );
	$country_posts = get_posts( array( 'post_type' => 'countries', 'posts_per_page' => -1, 'suppress_filters' => 0 ) );
	
	if(!empty($country_posts)){
		foreach( $country_posts as $country_post ){
			$country_array[$country_post->ID] =$country_post->post_title;
		}
	}
    ?>
    <p>
        <label for="state_meta_box_country"><strong>Country: </strong></label></p>
        <select name="state_meta_box_country" id="state_meta_box_country" class="required" required title="Please Select Country">
            <?php foreach($country_array as $key=>$val){?>
            <option value="<?php echo $key;?>" <?php selected( $selected[0], $key ); ?>><?php echo $val;?></option>
            <?php }?>
        </select>
    
    <?php   
}

add_action( 'save_post', 'state_meta_box_save' );
function state_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'state_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    //if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
    // Make sure your data is set before trying to save it
     if( isset( $_POST['state_meta_box_country'] ) )
        update_post_meta( $post_id, 'state_meta_box_country',  $_POST['state_meta_box_country'] );
}


/* Add Custom Columns */
if( !function_exists( 'states_edit_columns' ) ){
    function states_edit_columns($columns)
    {

        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __( 'State Title','framework' ),
            "country" => __( 'Country','framework' ),
			 "date" => __( 'Publish Time','framework' )
        );

        return $columns;
    }
}
add_filter("manage_edit-states_columns", "states_edit_columns");

if( !function_exists( 'states_custom_columns' ) ){
    function states_custom_columns($column){
        global $post;
        switch ($column)
        {
            case 'country':
                $ID = get_post_meta($post->ID,'state_meta_box_country',true);
                echo get_the_title( $ID );
				/*if(!empty($address)){
                    echo $address;
                }
                else{
                    _e('No Address Provided!','framework');
                }*/
                break;
        }
    }
}
add_action("manage_posts_custom_column", "states_custom_columns");

?>
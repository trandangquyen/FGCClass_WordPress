<?php
/* City Custom Post Type */
if( !function_exists( 'create_city_post_type' ) ){
    function create_city_post_type(){

      $labels = array(
        'name' => __( 'Cities'),
        'singular_name' => __( 'Cities' ),
        'add_new' => __('Add New'),
        'add_new_item' => __('Add New City'),
        'edit_item' => __('Edit City'),
        'new_item' => __('New City'),
        'view_item' => __('View City'),
        'search_items' => __('Search Cities'),
        'not_found' =>  __('No City found'),
        'not_found_in_trash' => __('No City found in Trash'),
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
        'rewrite' => array( 'slug' => __('cities', 'framework') ),
		'menu_icon' => ''
      );

      register_post_type('cities',$args);
    }
}
add_action('init', 'create_city_post_type');

function city_admin_head(){
//Below css will add the menu icon for Roster Slider admin menu
?>
<style type="text/css">#adminmenu .menu-icon-cities div.wp-menu-image:before { content: "\f123"; }</style>
<?php
}
add_action('admin_head', 'city_admin_head');

add_action( 'add_meta_boxes', 'city_meta_box_add' );
function city_meta_box_add()
{
    add_meta_box( 'city-meta-box-id', 'Provide Related Information', 'city_meta_box_cb', 'cities', 'side', 'high' );
}

function city_meta_box_cb( $post )
{
    // $post is already set, and contains an object: the WordPress post
    global $post;
    $values = get_post_custom( $post->ID );
	//print_r( $values['state_meta_box_country']);exit;
    $selectedCountry = isset( $values['city_meta_box_country'] ) ?  $values['city_meta_box_country']: '';
    $selectedState = isset( $values['city_meta_box_state'] ) ?  $values['city_meta_box_state']: ''; 
    // We'll use this nonce field later on when saving.
    wp_nonce_field( 'city_meta_box_nonce', 'meta_box_nonce' );
	
	/* Country */
	$country_array = array( "" => __('Select Country','framework') );
	$country_posts = get_posts( array( 'post_type' => 'countries', 'posts_per_page' => -1, 'suppress_filters' => 0 ) );
	if(!empty($country_posts)){
		foreach( $country_posts as $country_post ){
			$country_array[$country_post->ID] =$country_post->post_title;
		}
	}
	
	/* State */
	$state_array = array( "" => __('Select State','framework') );
	if($selectedCountry)
	{
		$state_posts = get_posts( array( 'post_type' => 'states', 'posts_per_page' => -1, 'suppress_filters' => 0, 'meta_query' => array(
			array(
				'key' => 'state_meta_box_country',
				'value' => $selectedCountry,
			)
		) ) );
	}
	if(!empty($state_posts)){
		foreach( $state_posts as $state_post ){
			$state_array[$state_post->ID] =$state_post->post_title;
		}
	}
    ?>
    <p>
        <label for="city_meta_box_country"><strong>Country:</strong> </label>
        </p>
       <select name="city_meta_box_country" id="city_meta_box_country" class="required" required title="Please Select Country">
            <?php foreach($country_array as $key=>$val){?>
            <option value="<?php echo $key;?>" <?php selected( $selectedCountry[0], $key ); ?>><?php echo $val;?></option>
            <?php }?>
        </select>
    <p>
        <label for="city_meta_box_state"><strong>State:</strong> </label>
        </p>
        <select name="city_meta_box_state" id="city_meta_box_state" class="required" required  title="Please Select State">
            <?php foreach($state_array as $key=>$val){?>
            <option value="<?php echo $key;?>" <?php selected( $selectedState[0], $key ); ?>><?php echo $val;?></option>
            <?php }?>
        </select>
    </p>
    <?php   
}

add_action( 'save_post', 'city_meta_box_save' );
function city_meta_box_save( $post_id )
{
    // Bail if we're doing an auto save
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'city_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    //if( !current_user_can( 'edit_post' ) ) return;
	
	// now we can actually save the data
    $allowed = array(
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
    // Make sure your data is set before trying to save it
     if( isset( $_POST['city_meta_box_country'] ) )
        update_post_meta( $post_id, 'city_meta_box_country',  $_POST['city_meta_box_country'] );
	if( isset( $_POST['city_meta_box_state'] ) )
        update_post_meta( $post_id, 'city_meta_box_state',  $_POST['city_meta_box_state'] );	
}


/* Add Custom Columns */
if( !function_exists( 'cities_edit_columns' ) ){
    function cities_edit_columns($columns)
    {

        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __( 'City Title','framework' ),
            "state" => __( 'State','framework' ),
			"country1" => __( 'Country','framework' ),
			"date" => __( 'Publish Time','framework' )
        );

        return $columns;
    }
}
add_filter("manage_edit-cities_columns", "cities_edit_columns");

if( !function_exists( 'cities_custom_columns' ) ){
    function cities_custom_columns($column){
        global $post;
        switch ($column)
        {
			 case 'state':
				$ID = get_post_meta($post->ID,'city_meta_box_state',true);
				echo get_the_title( $ID );
				/*if(!empty($address)){
					echo $address;
				}
				else{
					_e('No Address Provided!','framework');
				}*/
				break;
            case 'country1':
                $ID = get_post_meta($post->ID,'city_meta_box_country',true);
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
add_action("manage_posts_custom_column", "cities_custom_columns");
?>
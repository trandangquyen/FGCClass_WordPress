<?php
/**
 * The template for displaying meta box in page/post
 *
 * This adds Layout Options, Header Freatured Image Options, Single Page/Post Image
 * This is only for the design purpose and not used to save any content
 *
 * @package Catch Themes
 * @subpackage Clean Education
 * @since Clean Education 0.1
 */

/**
 * Class to Renders and save metabox options
 *
 * @since Clean Education 0.1
 */
class clean_education_meta_box {
	private $meta_box;

	private $fields;

	/**
	* Constructor
	*
	* @since Clean Education 0.1
	*
	* @access public
	*
	*/
	public function __construct( $meta_box_id, $meta_box_title, $post_type ) {

		$this->meta_box = array (
			'id' 		=> $meta_box_id,
			'title' 	=> $meta_box_title,
			'post_type' => $post_type,
		);

		$this->fields = array(
			'clean-education-layout-option',
			'clean-education-header-image',
			'clean-education-featured-image'
		);


		// Add metaboxes
		add_action( 'add_meta_boxes', array( $this, 'add' ) );

		add_action( 'save_post', array( $this, 'save' ) );

		// Enqueue Scripts/Styles
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts_styles' ) );
   	}

	/**
	* Add Meta Box for multiple post types.
	*
	* @since Clean Education 0.1
	*
	* @access public
	*/
	public function add($postType) {
		if ( in_array( $postType, $this->meta_box['post_type'] ) ) {
			add_meta_box( $this->meta_box['id'], $this->meta_box['title'], array( $this, 'show' ), $postType );
		}
	}

	/**
	* Renders metabox
	*
	* @since Clean Education 0.1
	*
	* @access public
	*/
	public function show() {
		global $post;

		$layout_options       = clean_education_metabox_layouts();
		$featured_img_options = clean_education_metabox_featured_image_options();
		$header_image_options = clean_education_metabox_header_featured_image_options();


	    // Use nonce for verification
	    wp_nonce_field( basename( __FILE__ ), 'clean_education_custom_meta_box_nonce' );

	    // Begin the field table and loop  ?>
	    <div id="clean-education-ui-tabs" class="ui-tabs">
		    <ul class="clean-education-ui-tabs-nav" id="clean-education-ui-tabs-nav">
		    	<li><a href="#frag1"><?php esc_html_e( 'Layout Options', 'clean-education' ); ?></a></li>
		    	<li><a href="#frag3"><?php esc_html_e( 'Header Featured Image Options', 'clean-education' ); ?></a></li>
		    	<li><a href="#frag4"><?php esc_html_e( 'Single Page/Post Image', 'clean-education' ); ?></a></li>
		    </ul>
		    <div id="frag1" class="catch_ad_tabhead">
		    	<table id="layout-options" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                    <select name="clean-education-layout-option" id="custom_element_grid_class">
		      					<?php
			                    foreach ( $layout_options as $field ) {
			                        $metalayout = get_post_meta( $post->ID, $field['id'], true );
			                        if ( empty( $metalayout ) ){
			                            $metalayout='default';
			                        }
			                   	?>
			                   		<option value="<?php echo $field['value']; ?>" <?php selected( $metalayout, $field['value'] ); ?>><?php echo $field['label']; ?></option>
		    					<?php
		    					} // end foreach
			                    ?>
		                    </select>
		                </tr>
		            </tbody>
		        </table>
		    </div>

	    	<div id="frag3" class="catch_ad_tabhead">
		    	<table id="header-image-metabox" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                    <?php
		                    foreach ( $header_image_options as $field ) {

							 	$metaheader = get_post_meta( $post->ID, $field['id'], true );

		                        if ( empty( $metaheader ) ){
		                            $metaheader='default';
		                        }
		                    ?>

	                        <td style="width: 100px;">
	                            <label class="description">
	                                <input type="radio" name="<?php echo $field['id']; ?>" value="<?php echo $field['value']; ?>" <?php checked( $field['value'], $metaheader ); ?>/>&nbsp;&nbsp;<?php echo $field['label']; ?>
	                            </label>
	                        </td>

		                    <?php
		                    } // end foreach
		                    ?>
		                </tr>
		            </tbody>
		        </table>
		    </div>

		    <div id="frag4" class="catch_ad_tabhead">
		    	<table id="featured-image-metabox" class="form-table" width="100%">
		            <tbody>
		                <tr>
		                    <select name="clean-education-featured-image" id="custom_element_grid_class">
		      					<?php
			                    foreach ( $featured_img_options as $field ) {
			                        $meta_feat_img = get_post_meta( $post->ID, $field['id'], true );
			                        if ( empty( $meta_feat_img ) ){
			                            $meta_feat_img='default';
			                        }
			                   	?>
			                   		<option value="<?php echo $field['value']; ?>" <?php selected( $meta_feat_img, $field['value'] ); ?>><?php echo $field['label']; ?></option>
		    					<?php
		    					} // end foreach
			                    ?>
		                    </select>
		                </tr>
		            </tbody>
		        </table>
		    </div>
		</div>
	<?php
	}

	/**
	 * Save custom metabox data
	 *
	 * @action save_post
	 *
	 * @since Clean Education 0.1
	 *
	 * @access public
	 */
	public function save( $post_id ) {
		global $post_type;

		$post_type_object = get_post_type_object( $post_type );

	    if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                      // Check Autosave
	    || ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )        // Check Revision
	    || ( ! in_array( $post_type, $this->meta_box['post_type'] ) )                  // Check if current post type is supported.
	    || ( ! check_admin_referer( basename( __FILE__ ), 'clean_education_custom_meta_box_nonce') )    // Check nonce - Security
	    || ( ! current_user_can( $post_type_object->cap->edit_post, $post_id ) ) )  // Check permission
	    {
	      return $post_id;
	    }

	    foreach ( $this->fields as $field ) {
			$new = $_POST[ $field ];

			if ( '' == $new || array() == $new ) {
				return;
			}
			else {
				if ( ! update_post_meta ( $post_id, $field, sanitize_key( $new ) ) ) {
					add_post_meta( $post_id, $field, sanitize_key( $new ), true );
				}
			}
		} // end foreach
	}

	public function enqueue_scripts_styles( $hook ) {
		if ( 'post.php' == $hook || 'post-new.php' == $hook ) {
		    //Scripts
		    wp_enqueue_script( 'clean-education-metabox', get_template_directory_uri() . '/js/metabox.min.js', array( 'jquery-ui-tabs' ), CLEAN_EDUCATION_THEME_VERSION );

		    wp_enqueue_style( 'clean-education-metabox-tabs', get_template_directory_uri() . '/css/metabox-tabs.css' );
		}
	}
}

$clean_education_metabox = new clean_education_meta_box(
	'clean-education-options', 					//metabox id
	esc_html__( 'Clean Education Options', 'clean-education' ), //metabox title
	array( 'page', 'post' )				//metabox post types
);
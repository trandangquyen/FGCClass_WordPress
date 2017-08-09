<?php
/**
 * Plugin Name: FGC Quotes
 * Plugin URI: http://localhost:8080/
 * Description: Quotes of Famous Peoples
 * Version: 1.0
 * Author: Phạm Hiếu
 * Author URI: http://vanhieu.wdev.fgct.net
 */
define( 'QUOTES_NAME', '');
define( 'QUOTES_DIR', plugin_dir_path( __FILE__ ));
define( 'QUOTES_VERSION', '1.0');

$fgc_quotes_countdown_config = [
    'force_install' => true, // Force drop old table when diff version plugin -> Lost old data
    'table_quotes' => $wpdb->prefix . 'fgc_quotes',
    'table_countdown' => $wpdb->prefix . 'fgc_countdown_timer',
];

class FGCQuotesAndCountdown {

    public $quotes;

    function __construct() {
        global $wpdb, $fgc_quotes_countdown_config;
        add_action('admin_menu', array($this, 'fgc_create_menu'));
    }

    // Tạo menu plugin trên Dashboard trang Admin
    function fgc_create_menu() {
        $fgc_menu_slug = basename(__FILE__);
        add_menu_page('FGC Quotes', 'FGC Quotes', 'manage_options', $fgc_menu_slug . '-quotes-countdown', array($this, 'manager_quotes'), '', 4);
//        add_submenu_page($fgc_menu_slug, 'FGC Quotes Manager', 'Quotes', 'manage_options');
        add_submenu_page($fgc_menu_slug, 'FGC Quotes Manager', 'Quotes', 'manage_options', $fgc_menu_slug . '-quote', array($this, 'manager_quotes'));
        // add_submenu_page($fgc_menu_slug, 'FGC Countdown Manager', 'Countdown Timer', 'manage_options');
    }

    // Hiển thị danh sách tất cả các Quotes
    function fgc_list_quotes() {
        global $wpdb;
        ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">List FGC Quotes</h1> | <a href="?<?php echo $_SERVER['QUERY_STRING']; ?>&action=add" class="page-title-action">Add New Quotes</a>
            <?php if (isset($_GET['settings-updated'])) { ?>
                <div id="message" class="updated">
                    <p><strong><?php _e('Settings saved.') ?></strong></p>
                </div>
            <?php } ?>
            <table class="wp-list-table widefat fixed striped posts" style="width:80%; ">
                <thead>
                    <tr>
                        <th scope="col" id="title" class="manage-column column-author">Quote ID</th>
                        <th scope="col" id="title" class="manage-column column-author">Quote Name</th>
                        <th scope="col" id="count" class="manage-column column-author">Quote Contents</th>
                        <th scope="col" id="public" class="manage-column column-author">Quote Author</th>
                        <th scope="col" id="public" class="manage-column column-author">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $list_quotes = $wpdb->get_results("SELECT * FROM wp_fgc_quotes ", ARRAY_A);
//                    var_dump($list_quotes);                    exit();
                    foreach ($list_quotes as $quote) {
                        echo '<td>' . $quote['id'] . '</td>
                        <td>' . $quote['quote_name'] . '</td>
                        <td> ' . $quote['quote_contents'] . ' </td>                        
                        <td> ' . $quote['quote_author'] . ' </td>                        
                        <td> <a href="?' . $_SERVER['QUERY_STRING'] . '&action=edit&id=' . $quote['id'] . '">Edit</a> | <a href="?' . $_SERVER['QUERY_STRING'] . '&action=delete&id=' . $quote['id'] . '">Delete</a> </td>
                    </tr>';
                    }
                    ?>
                </tbody>
            </table>

            <h2> Note : Để hiển thị Quotes ra post hoặc page dùng shortcode [custom_quotes]</h2>
        </div>
        <?php
    }

    function get_quotes($id) {
        global $wpdb;
        $quotes = $wpdb->get_results("SELECT * FROM wp_fgc_quotes WHERE id ='$id'");
        if ($quotes)
            return $quotes;
        return null;
    }

    // Add new quotes
    function add_quotes() {
        global $wpdb;
        echo '<div class="wrap">';
        echo '<h2>ADD NEW QUOTE</h2>';
        if (isset($_POST['submit'])) {
//            $quote_name = sanitize_text_field($_REQUEST['quote_name']);
//            $quote_name = get_the_content($_REQUEST['quote_name']);
            $quote_contents = sanitize_textarea_field($_REQUEST['quote_contents']);
            $quote_author = sanitize_text_field($_REQUEST['quote_author']);
            if (!$quote_contents) {
                printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter quote contents!'));
            } elseif (!$quote_author) {
                printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter quote author!'));
            } else {
                $quote = $wpdb->get_row("SELECT * FROM wp_fgc_quotes WHERE quote_contents = '$quote_contents'");
                if ($quote)
                    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Quote ' . $quote_contents . '  exist!'));
                else {
                    $wpdb->insert('wp_fgc_quotes', array('quote_name' => $quote_name, 'quote_contents' => $quote_contents, 'quote_author' => $quote_author));
                    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Add quote with contents <i> ' . $quote_contents . '</i> success!'));
                }
            }
        }
        ?>
        <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
            <?php wp_nonce_field('nonce_add_quote', 'nonce_add_quote'); ?>
            <table class="form-table">

                <tr valign="top">
                    <th scope="row">Quote Contents : </th>
                    <!--<td><input type="" style="width:100%" name="quote_contents" value="" /></td>-->
                    <td><textarea name="quote_contents" style="width: 60%; height: 200px" placeholder="Enter Quote Contents"  value="" /></textarea></td>
                    <!--<td><textarea name="quote_contents" /></td>-->
                </tr>
                <tr>
                    <th scope="row">Quote Author : </th>
                    <td><input type="text" name="quote_author" value="" placeholder="Enter Quote Author"></td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Add New Quote">
                <input type="button" name="submit" onclick="location.href = '?page=<?php echo $_REQUEST['page']; ?>';" class="button button-cancel" value="Back to list Quotes">
            </p>
        </form>

        <?php
        echo '</div>';
    }

    function edit_quotes($quote) {
        global $wpdb;
        echo '<div class="wrap">';
        echo '<h2> EDIT QUOTE </h2>';
        if (!$quote)
            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('No quotes select!'));
        else {
            $fgc_quote = (array) $wpdb->get_row("SELECT * FROM wp_fgc_quotes WHERE id = " . $quote);
            $fgc_quote_id = (int) $wpdb->get_row("SELECT id FROM wp_fgc_quotes WHERE id = " . $quote);
            $fgc_quote_name = $wpdb->get_row("SELECT quote_name FROM wp_fgc_quotes WHERE id = " . $quote);
            $fgc_quote_contents = $wpdb->get_row("SELECT quote_contents FROM wp_fgc_quotes WHERE id = " . $quote);
            $fgc_quote_author = $wpdb->get_row("SELECT quote_author FROM wp_fgc_quotes WHERE id = " . $quote);
//            var_dump($fgc_quote_id);            exit();
            if (!$fgc_quote)
                printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Quote ' . $quote . ' doesn\'t exist!'));
            else {
                if (isset($_POST['submit'])) {
                    $quote_name = sanitize_text_field($_REQUEST['quote_name']);
                    $quote_contents = sanitize_textarea_field($_REQUEST['quote_contents']);
                    $quote_author = sanitize_text_field($_REQUEST['quote_author']);
                    if (!$quote_contents)
                        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter Quote Contents!'));
                    elseif (!$quote_author)
                        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter Quote Author!'));
                    else {
                        $wpdb->update('wp_fgc_quotes', ['quote_name' => $quote_name, 'quote_contents' => $quote_contents, 'quote_author' => $quote_author], ['id' => $quote]);
                        printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Update quote ' . $quote_contents . ' by' . $quote_author . ' success!'));
                        $fgc_quote = (array) $wpdb->get_row("SELECT * FROM wp_fgc_quotes WHERE id = " . $quote);
                    }
                }
                ?>
                <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
                    <?php wp_nonce_field('nonce_edit_quote', 'nonce_edit_quote'); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Quote ID: </th>
                            <td><label><?php echo $fgc_quote_id; ?></label></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Quote name: </th>
                            <td><input type="text" name="quote_name" value="" placeholder="" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Quote Contents : </th>
                            <!--<td><input type="" style="width:100%" name="quote_contents" value="" /></td>-->
                            <td><textarea name="quote_contents" style="width: 60%; height: 200px" placeholder="Enter Quote Contents"  value="" /></textarea></td>
                            <!--<td><textarea name="quote_contents" /></td>-->
                        </tr>
                        <tr>
                            <th scope="row">Quote Author : </th>
                            <td><input type="text" name="quote_author" value="" placeholder="Enter Quote Author"></td>

                        </tr>
                    </table>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
                        <input type="button" name="submit" onclick="location.href = '?page=<?php echo $_REQUEST['page']; ?>';" class="button button-cancel" value="Cancel">
                        <input type="button" name="submit" onclick="location.href = '?<?php echo $_SERVER['QUERY_STRING']; ?>&action=delete&id=<?php echo $quote; ?>';" class="button button-cancel" value="Delete">
                    </p>
                </form>
                <?php
            }
        }
        echo '</div>';
    }

    function delete_quotes($quote) {
        global $wpdb;

        $wpdb->delete('wp_fgc_quotes', ['id' => $quote]);
        $url = $_SERVER['HTTP_REFERER'];
        echo '<script>location.href=\'' . $url . '\';</script>';
    }

    function manager_quotes() {

        $quote = new FGCQuotesAndCountdown();
        $action = isset($_GET['action']) ? $_GET['action'] : null;
        $id = isset($_GET['id']) ? (int) $_GET['id'] : null;
        switch ($action) {
            case 'add':
                $quote->add_quotes($id);
                break;
            case 'edit':
                $quote->edit_quotes($id);
                break;
            case 'view':
                $quote->view_quotes($id);
                break;
            case 'delete':
                $quote->delete_quotes($id);
                break;
            default:
                $quote->fgc_list_quotes();
                break;
        }
        //$class->list_class();
    }

    

    function show_quotes() {
        global $wpdb;
        $fgc_quotes = (array) $wpdb->get_results("SELECT * FROM wp_fgc_quotes");
//    echo '<pre>';
//    var_dump($fgc_quotes);
//    echo '</pre>';
//    exit();
        ?>
        <style type="text/css">
            .quote-contain {
                /*overflow: auto;*/            
            }
            .quote-contain .quotes {
                width: 32.6%;
                float: left;
                height: 175px;
                line-height: 100%;
                text-align: center;
                margin: 4px;
                padding: 15px;
                color: #FFF;
                border-radius: 4px; 
                font-style: italic;

            }
            .quote-contain .quotes-odd {
                background-color: #d6e8ff;
            }
            .quote-contain .quotes-even {
                background-color: #e4e4e4;
            }
            .quote-contain .quotes span {
                font-style: italic;
                font-size: 20px;
                color: #000;
                /*text-shadow: 2px 2px #fff;*/
            }
            .quote-contain .quotes p :before {
                content: "&#10030;";
            }
            .quote-contain .quotes p {
                font-size: 15px;
                font-weight: bold;
                margin-top: 20px;
                color: #b9860a;
                text-shadow: 2px 2px #fff;
            }
        </style>


        <div class="quote-contain" id="quotes">
            <?php
            foreach ($fgc_quotes as $key => $quote) {
                if ($key % 2 == 0) {
                    echo
                    '<div class="quotes quotes-even">
                <span > &#8220;' . $quote->quote_contents . '&#8221;</span> </br>
                <p>&#x270D; ' . $quote->quote_author . '</p>
            </div>';
                } else {
                    echo
                    '<div class="quotes quotes-odd">
                <span > &#8220;' . $quote->quote_contents . '&#8221;</span> </br>
                <p>&#x270D; ' . $quote->quote_author . '</p>
            </div>';
                }
            }
            ?>
        </div>
        <?php
    }
    function quotes_plugin_install() {
        global $wpdb, $fgc_quotes_countdown_config ;
        $quotes_version = get_option("fgc_quote_versions");
        
        if($quotes_version != QUOTES_VERSION){
            $charset_collate = $wpdb->get_charset_collate();
            $insert_data_quotes= true;
            $sql = '';
            $message = [];
            if($fgc_quotes_countdown_config["force_install"]== TRUE){
                $wpdb->query( "DROP TABLE IF EXISTS {$fgc_quotes_countdown_config['table_quotes']}" );
            }
            if ($wpdb->get_var("SHOW TABLES LIKE '{$fgc_quotes_countdown_config['table_quotes']}'") != $fgc_quotes_countdown_config['table_quotes']) {
                $sql .= "CREATE TABLE ".$fgc_quotes_countdown_config['table_quotes'] ." (
                    id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    quote_name varchar(50),
                    quote_contents text NOT NULL UNIQUE,
                    quote_author varchar(50) NOT NULL UNIQUE,
                    
                ) $charset_collate;";
                
            } else {
                $insert_data_quotes = false;
                $message[] = 'Table '.$fgc_quotes_countdown_config['table_quotes'].' exist!';
            }
            if(!empty($sql)) {
                require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
                dbDelta( $sql );
                update_option( "fgc_quote_versions", QUOTES_VERSION);
                
                if($insert_data_quotes == true){
                    $wpdb->insert($fgc_quotes_countdown_config['table_quotes'], array('quote_name' => 'Friendly', 'quote_contents' => 'We must let go of the life we have planned, so as to accept the one that is waiting for us', 'quote_author' => 'Joseph Campbell'));
                    $wpdb->insert($fgc_quotes_countdown_config['table_quotes'], array('quote_name' => 'Nature', 'quote_contents' => 'Look deep into nature, and then you will understand everything better', 'quote_author' => 'Albert Einstein'));
                    $wpdb->insert($fgc_quotes_countdown_config['table_quotes'], array('quote_name' => 'Nature', 'quote_contents' => 'Try not to become a man of success, but rather try to become a man of value.', 'quote_author' => 'Albert Einstein'));
                    $wpdb->insert($fgc_quotes_countdown_config['table_quotes'], array('quote_name' => 'Nature', 'quote_contents' => 'The Vietnamese people deeply love independence, freedom and peace. But in the face of United States aggression they have risen up, united as one man.', 'quote_author' => 'Ho Chi Minh'));
                    $wpdb->insert($fgc_quotes_countdown_config['table_quotes'], array('quote_name' => 'Nature', 'quote_contents' => 'It was patriotism, not communism, that inspired me.', 'quote_author' => 'Ho Chi Minh'));
                    
                    $message[] = 'Insert data class success!';
                }                    
            } else {
                $message[] = 'Nothing tho query Database!';
            }
        }
    
    }
function register_quote_shortcode(){
    ob_start();
    show_quotes();
    return ob_get_clean();
}
    
}
// Registration new shortcode name [custom_quotes]
add_shortcode('custom_quotes', array('FGCQuotesAndCountdown','register_quote_shortcode'));

// Registration Activation Hook
register_activation_hook( __FILE__, array('FGCQuotesAndCountdown', 'plugin_install'));
new FGCQuotesAndCountdown();
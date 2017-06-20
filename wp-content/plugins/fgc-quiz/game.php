<?php
class Quiz_game {
    private $table_class;
    private $table_timetable;
    private $table_game;

    public $list_game;
    function __construct() {
        global $wpdb;
        $this->table_class = $wpdb->prefix . "fgc_class";
        $this->table_timetable = $wpdb->prefix . "fgc_timetable";
        $this->table_game = $wpdb->prefix . "fgc_game";

        $this->list_game = $wpdb->get_results( "SELECT * FROM $this->table_game ORDER BY name ASC", ARRAY_A);
    }

    public function get_game($id) {
        if(isset($this->list_game[$id])) return $this->list_game[$id];
        //$game = (array) $wpdb->get_row("SELECT * FROM $this->table_game WHERE id = '$id'");
        return null;
    }
    public function list_game() {
    ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">List game</h1> | <a href="?<?php echo $_SERVER['QUERY_STRING']; ?>&action=add" class="page-title-action">Add game</a>
        <?php if( isset($_GET['settings-updated']) ) { ?>
            <div id="message" class="updated">
                <p><strong><?php _e('Settings saved.') ?></strong></p>
            </div>
        <?php } ?>
        <table class="wp-list-table widefat fixed striped posts" style="width:60%">
        <thead>
            <tr>
                <th scope="col" id="title" class="manage-column column-author">ID</th>
                <th scope="col" id="title" class="manage-column column-author">Name game</th>
                <th scope="col" id="count" class="manage-column column-author">URL</th>
                <th scope="col" id="public" class="manage-column column-author">Public</th>
                <th scope="col" id="action" class="manage-column column-author">Action</th>
            </tr>
        </thead>

        <tbody id="the-list">
            <?php 
            foreach ($this->list_game as $game) {
                echo '<td>'.$game['id'].'</td>
                    <td>'.$game['name'].'</td>
                    <td> '.$game['url'].' </td>
                    <td> '.($game['public']==1 ? 'Public' : 'Private').' </td>
                    <td> <a href="?'.$_SERVER['QUERY_STRING'].'&action=edit&id='.$game['id'].'">Edit</a> | <a href="?'.$_SERVER['QUERY_STRING'].'&action=delete&id='.$game['id'].'">Delete</a> </td>
                </tr>';
            }
            ?>
        </tbody></table>
        </div>
        <?php 
    }
    public function edit_game($game_id) {
        global $wpdb;
        echo '<div class="wrap">';
        if(!$game_id) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('No game select!'));
        else {
            $game = (array) $wpdb->get_row("SELECT * FROM $this->table_game WHERE id = ".$game_id);
            if(!$game) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('game '.$game_id.' doesn\'t exist!'));
            else {
                if( isset($_POST['submit']) ) {
                    $game_name = sanitize_text_field($_REQUEST['game_name']);
                    $game_url = sanitize_text_field($_REQUEST['game_url']);
                    if(!$game_name) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter game name!'));
                    elseif(!$game_url) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter game URL!'));
                    else {
                        $game_public = (isset($_POST['public']) && $_POST['public']==1) ? 1 : 0;
                        $wpdb->update($this->table_game, ['name'=>$game_name,'url'=>$game_url,'public'=>$game_public], ['id'=>$game_id]);
                        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Update game '.$game_name.' success!'));
                        $game = (array) $wpdb->get_row("SELECT * FROM $this->table_game WHERE id = ".$game_id);
                    }
                }
                ?>
                <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
                    <?php wp_nonce_field( 'nonce_edit_game', 'nonce_edit_game'); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Game name: </th>
                            <td><input type="text" name="game_name" value="<?php echo $game['name']; ?>" /></td>
                        </tr>
                        <tr valign="top">
                            <th scope="row">Game URL: </th>
                            <td><input type="text" style="width:100%" name="game_url" value="<?php echo $game['url']; ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Public game: </th>
                            <td><input type="checkbox" name="public" value="1" id="public"<?php if($game['public']==1) echo ' checked="checked"'; ?>></td>
                        </tr>
                    </table>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
                        <input type="button" name="submit" onclick="location.href='?page=<?php echo $_REQUEST['page']; ?>';" class="button button-cancel" value="Cancel">
                        <input type="button" name="submit" onclick="location.href='?<?php echo $_SERVER['QUERY_STRING']; ?>&action=delete&game_id=<?php echo $game_id; ?>';" class="button button-cancel" value="Delete">
                    </p>
                </form>
                <?php
            }
        }
        echo '</div>';
    }
    public function add_game() {
        global $wpdb;
        echo '<div class="wrap">';
        echo '<h2>Add new class</h2>';
        if( isset($_POST['submit']) ) {
            $game_name = sanitize_text_field($_REQUEST['game_name']);
            $game_url = sanitize_text_field($_REQUEST['game_url']);
            if(!$game_name) {
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter game name!') );
            } elseif(!$game_url) {
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter game url!') );
            } else {
                $game = $wpdb->get_row("SELECT * FROM $this->table_game WHERE name = '$game_name'");
                if($game)
                    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Game '.$game_name.'  exist!'));
                else {
                    $game_public = (isset($_POST['public']) && $_POST['public']==1) ? 1 : 0;
                    $wpdb->insert($this->table_game, array('name' => $game_name, 'url' => $game_url, 'public' => $game_public));
                    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Add game '.$game_name.' success!'));
                }
            }
        }
        ?>
        <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
            <?php wp_nonce_field( 'nonce_add_game', 'nonce_add_game'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Game name: </th>
                    <td><input type="text" name="game_name" value="" /></td>
                </tr>
                <tr valign="top">
                    <th scope="row">Game URL: </th>
                    <td><input type="text" style="width:100%" name="game_url" value="" /></td>
                </tr>
                <tr>
                    <th scope="row">Public game: </th>
                    <td><input type="checkbox" name="public" value="1" id="public"></td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="Add">
                <input type="button" name="submit" onclick="location.href='?page=<?php echo $_REQUEST['page']; ?>';" class="button button-cancel" value="Cancel">
            </p>
        </form>
    <?php
        echo '</div>';
    }
    
}
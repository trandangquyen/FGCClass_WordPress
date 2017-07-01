<?php
class Quiz_class {
    private $table_class;
    private $table_timetable;
    private $table_game;

    //public $list_class;
    function __construct() {
        global $wpdb, $fgc_config;
        $this->table_class = $fgc_config['table_class'];
        $this->table_timetable = $fgc_config['table_timetable'];
        $this->table_game = $fgc_config['table_game'];

        //$this->list_class = $wpdb->get_results( "SELECT * FROM $this->table_class ORDER BY name ASC", ARRAY_A);
    }

    public function list_class() {
        global $wpdb;
    ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">List class</h1> | <a href="?<?php echo $_SERVER['QUERY_STRING']; ?>&action=add" class="page-title-action">Add</a>
        <?php if( isset($_GET['settings-updated']) ) { ?>
            <div id="message" class="updated">
                <p><strong><?php _e('Settings saved.') ?></strong></p>
            </div>
        <?php } ?>
        <table class="wp-list-table widefat fixed striped posts" style="width:60%">
        <thead>
            <tr>
                <th scope="col" id="title" class="manage-column column-author">Class name</th>
                <th scope="col" id="count" class="manage-column column-author">Members</th>
                <th scope="col" id="public" class="manage-column column-author">Public</th>
                <th scope="col" id="action" class="manage-column column-author">Action</th>
            </tr>
        </thead>
        <tbody id="the-list">
            <?php 
            $list_class = $wpdb->get_results( "SELECT * FROM $this->table_class ORDER BY name ASC", ARRAY_A);
            //echo '<pre>';var_dump($this->list_class);echo '</pre>';
            foreach ($list_class as $class) {
                $args = array('meta_key' => '_class_id','meta_value' => $class['id'],'orderby' => 'nicename', 'order' => 'ASC',); 
                $list_users = (array) get_users( $args );
                $class['members'] = count($list_users);
                echo '<tr class="">
                    <td>'.$class['name'].'</td>
                    <td> '.$class['members'].' </td>
                    <td> '.($class['public']==1 ? 'Public' : 'Private').' </td>
                    <td> <a href="?'.$_SERVER['QUERY_STRING'].'&action=view&id='.$class['id'].'">View</a> | <a href="?'.$_SERVER['QUERY_STRING'].'&action=delete&id='.$class['id'].'">Delete</a> | <a href="?'.$_SERVER['QUERY_STRING'].'&action=edit&id='.$class['id'].'">Edit</a> </td>
                </tr>';
            }
            ?>
        </tbody></table>
        </div>
        <?php 
    }
    public function view_class($class_id) {
        global $wpdb;
        echo '<div class="wrap">';
        if(!$class_id) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('No class select!'));
        else {
            $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE id = ".$class_id);
            //var_dump($class);exit;
            if(!$class) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Class '.$class_id.' doesn\'t exist!'));
            else {
                echo '<h2>List member of class: '.$class['name'].'</h2>';

                $args = array(
                    'meta_key'     => '_class_id',
                    'meta_value'   => $class_id,
                    'orderby'      => 'nicename',
                    'order'        => 'ASC',
                ); 
                $list_users = get_users( $args ); ?>
                <table class="wp-list-table widefat fixed striped posts" style="width:60%">
                    <thead>
                        <tr>
                            <th scope="col" id="title" class="manage-column column-author">Name</th>
                            <th scope="col" id="count" class="manage-column column-author">Email</th>
                            <th scope="col" id="action" class="manage-column column-author">Action</th>
                        </tr>
                    </thead>

                    <tbody id="the-list">
                        <?php
                        if(!empty($list_users)) foreach ( $list_users as $user ) {
                            echo '<tr>';
                            echo '<td>' . esc_html( $user->user_nicename ) . '</td>';
                            echo '<td>' . esc_html( $user->user_email ) . '</td>';
                            echo '<td> <a href="?'.$_SERVER['QUERY_STRING'].'&action=remove&user_id='.$user->ID.'&id='.$class_id.'">Remove from class</a> </td>';
                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table> <br />
                <input type="button" name="submit" onclick="location.href='?<?php echo $_SERVER['QUERY_STRING']; ?>&action=add_member&id=<?php echo $class_id; ?>';" class="button button-primary" value="Add member">
                <?php
            }
        }
        echo '</div>';
    }
    public function edit_class($class_id) {
        global $wpdb;
        echo '<div class="wrap">';
        if(!$class_id) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('No class select!'));
        else {
            $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE id = ".$class_id);
            if(!$class) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Class '.$class_id.' doesn\'t exist!'));
            else {
                if( isset($_POST['submit']) ) {
                    $class_name = sanitize_text_field($_REQUEST['class_name']);
                    if(!$class_name) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter class name!'));
                    else {
                        $class_public = (isset($_POST['public']) && $_POST['public']==1) ? 1 : 0;
                        $wpdb->update($this->table_class, ['name'=>$class_name,'public'=>$class_public], ['id'=>$class_id]);
                        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Update class '.$class_name.' success!'));
                        $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE id = ".$class_id);
                    }
                }
                ?>
                <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
                    <?php wp_nonce_field( 'nonce_edit_class', 'nonce_edit_class'); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Class name: </th>
                            <td><input type="text" name="class_name" value="<?php echo $class['name']; ?>" /></td>
                        </tr>
                        <tr>
                            <th scope="row">Public class: </th>
                            <td><input type="checkbox" name="public" value="1" id="public"<?php if($class['public']==1) echo ' checked="checked"'; ?>></td>
                        </tr>
                    </table>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
                        <input type="button" name="submit" onclick="location.href='?page=<?php echo $_REQUEST['page']; ?>';" class="button button-cancel" value="Cancel">
                        <input type="button" name="submit" onclick="location.href='?<?php echo $_SERVER['QUERY_STRING']; ?>&action=delete&id=<?php echo $class_id; ?>';" class="button button-cancel" value="Delete">
                    </p>
                </form>
                <?php
            }
        }
        echo '</div>';
    }
    public function add_class() {
        global $wpdb;
        echo '<div class="wrap">';
        echo '<h2>Add new class</h2>';
        if( isset($_POST['submit']) ) {
            $class_name = sanitize_text_field($_REQUEST['class_name']);
            if(!$class_name) {
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter class name!') );
            } else {
                $class = $wpdb->get_row("SELECT * FROM $this->table_class WHERE name = '$class_name'");
                if($class)
                    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Class '.$class_name.'  exist!'));
                else {
                    $class_public = (isset($_POST['public']) && $_POST['public']==1) ? 1 : 0;
                    $wpdb->insert($this->table_class, array('name' => $class_name, 'members' => 0, 'public' => $class_public));
                    $wpdb->insert($this->table_timetable, array('class_id' => $wpdb->insert_id));
                    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Add class '.$class_name.' success!'));
                }
            }
        }
        ?>
        <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
            <?php wp_nonce_field( 'nonce_add_class', 'nonce_add_class'); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Class name: </th>
                    <td><input type="text" name="class_name" value="" /></td>
                </tr>
                <tr>
                    <th scope="row">Public class: </th>
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
    public function add_member($class_id) {
        global $wpdb;
        echo '<div class="wrap">';
        //echo '<pre>';var_dump($this->list_class);echo '</pre>';
        if(!$class_id) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('No class select!'));
        else {
            $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE id = ".$class_id);
            if(!$class)
                printf( '<div class="notice notice-error"><p>Class '.$class_id.' doesn\'t exist!</p></div>');
            else {
                $class_name = $class['name'];
                echo '<h2>Add member to class: '.$class_name.'</h2>';
                if( isset($_POST['submit']) ) {
                    $query = sanitize_text_field($_REQUEST['query']);
                    if(!$query)
                        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Please enter username or email!') );
                    else {
                        if (filter_var($query, FILTER_VALIDATE_EMAIL))
                            $user = get_user_by( 'email', $query );
                        else
                            $user = get_user_by( 'login', $query );
                        if(!$user)
                            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('User '.$query.' doesn\'t exist!'));
                        else {
                            $user_class_old = get_the_author_meta('_class_id', $user->ID );
                            if($user_class_old && $class_id == $user_class_old)
                                printf( '<div class="notice notice-error"><p>User '.$query.' already exists in this class!</p></div>');
                            else {
                                //if($user_class_old) $wpdb->query($wpdb->prepare("UPDATE $this->table_class SET members = members-1 WHERE id = %d;",$user_class_old));
                                //$wpdb->query($wpdb->prepare("UPDATE $this->table_class SET members = members+1 WHERE id = %d;",$class_id));

                                update_user_meta( $user->ID, '_class_id', $class_id );
                                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Add user '.$query.' success!'));
                                //$_REQUEST['query'] = '';
                            }
                        }
                    }
                }
                ?>
                <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
                    <?php wp_nonce_field( 'nonce_add_member', 'nonce_add_member'); ?>
                    <table class="form-table">
                        <tr valign="top">
                            <th scope="row">Username or email: </th>
                            <td><input type="text" name="query" value="<?php echo @$_REQUEST['query']; ?>" /></td>
                        </tr>
                    </table>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Add">
                        <input type="button" name="submit" onclick="location.href='?page=<?php echo $_REQUEST['page']; ?>';" class="button button-cancel" value="Cancel">
                    </p>
                </form>
                <?php
            }
        }
        echo '</div>';
    }
    public function delete_class($class_id) {
        global $wpdb;
        echo '<div class="wrap">';
        if(!$class_id) {
            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('No class to delete!') );
        } else {
            $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE id = '$class_id'");
            if(!$class)
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Class ID '.$class_id.' doesn\'t exist!'));
            else {
                $wpdb->delete( $this->table_timetable, ['class_id'=>$class_id]);
                $wpdb->delete( $this->table_class, ['id'=>$class_id]);
                // REMOVE user meta _class_id  <-------------------------------
                /*$args = array(
                    'meta_key'     => '_class_id',
                    'meta_value'   => $class_id,
                    'orderby'      => 'nicename',
                    'order'        => 'ASC',
                ); 
                $list_users = get_users( $args );
                if(!empty($list_users)) foreach ( $list_users as $user ) { delete_user_meta( $user->ID, '_class_id');}*/
                $sql = "DELETE FROM {$wpdb->prefix}usermeta WHERE meta_key = '_class_id' AND meta_value = '{$class_id}'";
                $wpdb->query($sql);
                // < ---------------- REMOVE post meta class_id too ----------------------------------------------------
                /*$args = array(
                    'meta_key'     => '_class_id',
                    'meta_value'   => $class_id,
                ); 
                $list_posts = get_posts( $args );
                if(!empty($list_posts)) foreach ( $list_posts as $post ) {
                    delete_post_meta( $post->ID, '_class_id');
                }*/
                $sql = "DELETE FROM {$wpdb->prefix}postmeta WHERE meta_key = '_class_id' AND meta_value = '{$class_id}'";
                $wpdb->query($sql);

                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Delete class '.$class['name'].' success!'));
            }
        }
        echo '<input type="button" name="submit" onclick="location.href=\'admin.php?page='.$_REQUEST['page'].'\';" class="button button-cancel" value="Back">';
        echo '</div>';
    }

    public function remove_from_class($user_id,$class_id) {
        global $wpdb;
        $user = get_userdata($user_id);

        echo '<div class="wrap">';
        if(!$class_id) {
            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('No class select!') );
        } else {
            $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE id = '$class_id'");
            if(!$class)
                printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Class ID '.$class_id.' doesn\'t exist!'));
            else {
                $user = get_user_by( 'ID', $user_id);
                if(empty($user))
                    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('User ID '.$user_id.' doesn\'t exist!'));
                else {
                    update_user_meta( $user_id, '_class_id', '');
                    //$wpdb->query($wpdb->prepare("UPDATE $this->table_class SET members = members-1 WHERE id = %d;",$class_id));

                    printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Remove '.$user->user_nicename.' from class '.$class['name'].' success.'));
                }
            }
        }
        echo '</div>';
    }
}
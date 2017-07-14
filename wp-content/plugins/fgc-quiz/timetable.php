<?php
class Quiz_timetable {
    private $table_class;
    private $table_timetable;
    private $table_game;

    //public $list_class;
    //public $list_timetable;
    //public $list_class_timetable; // have timetable in class

    private $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

    function __construct() {
        global $wpdb, $fgc_config;
        $this->table_class = $fgc_config['table_class'];
        $this->table_timetable = $fgc_config['table_timetable'];
        $this->table_game = $fgc_config['table_game'];

        //$sql = "SELECT * FROM $this->table_timetable INNER JOIN $this->table_class ON $this->table_timetable .class_id = $this->table_class .id ORDER BY $this->table_class .name ASC";
        //$this->list_class = $this->list_timetable = $wpdb->get_results( $sql, ARRAY_A);

        /*$sql = "SELECT m1.* FROM timetable m1 LEFT JOIN timetable m2 ON (m1.class_id = m2.class_id AND m1.id < m2.id) WHERE m2.id IS NULL ORDER BY m1.class_id ASC";
        $sql = "SELECT tmp_timetable.*, class.name as class_name from class inner join (SELECT m1.* FROM timetable m1 LEFT JOIN timetable m2 ON (m1.class_id = m2.class_id AND m1.id < m2.id) WHERE m2.id IS NULL ORDER BY m1.class_id ASC) as tmp_timetable on class.id = tmp_timetable.class_id";
        $sql = "SELECT tmp_timetable.*, tmp_class.name as class_name from class tmp_class inner join (SELECT m1.* FROM timetable m1 LEFT JOIN timetable m2 ON (m1.class_id = m2.class_id AND m1.id < m2.id) WHERE m2.id IS NULL ORDER BY m1.class_id ASC) as tmp_timetable on tmp_class.id = tmp_timetable.class_id";*/
        //$sql = "SELECT tmp_class.id as class_id, tmp_class.name as class_name, tmp_timetable.* from $this->table_class tmp_class left join (SELECT m1.* FROM $this->table_timetable m1 LEFT JOIN $this->table_timetable m2 ON (m1.class_id = m2.class_id AND m1.id < m2.id) WHERE m2.id IS NULL ORDER BY m1.class_id ASC) as tmp_timetable on tmp_class.id = tmp_timetable.class_id";
        //$this->list_class_timetable = $wpdb->get_results( $sql, ARRAY_A);

    }

    public function list_timetable() {
        global $wpdb;
        $sql = "SELECT tmp_class.id as class_id, tmp_class.name as class_name, tmp_timetable.* from $this->table_class tmp_class left join (SELECT m1.* FROM $this->table_timetable m1 LEFT JOIN $this->table_timetable m2 ON (m1.class_id = m2.class_id AND m1.id < m2.id) WHERE m2.id IS NULL ORDER BY m1.class_id ASC) as tmp_timetable on tmp_class.id = tmp_timetable.class_id";
        $list_class_timetable = $wpdb->get_results( $sql, ARRAY_A);
    ?>
        <div class="wrap">
            <h1 class="wp-heading-inline">List timetable</h1>
        <?php if( isset($_GET['settings-updated']) ) { ?>
            <div id="message" class="updated">
                <p><strong><?php _e('Settings saved.') ?></strong></p>
            </div>
        <?php } ?>
        <table class="wp-list-table widefat fixed striped posts" style="width:60%">
        <thead>
            <tr>
                <th scope="col" id="title" class="manage-column column-author">Class name</th>
                <th scope="col" id="title" class="manage-column column-author">Update at</th>
                <th scope="col" id="action" class="manage-column column-author">Action</th>
            </tr>
        </thead>

        <tbody id="the-list">
            <?php 
            foreach ($list_class_timetable as $class_timetable) {
                echo '<tr>
                    <td>'.$class_timetable['class_name'].'</td>
                    <td>'.$class_timetable['updated_at'].'</td>
                    <td> <a href="?'.$_SERVER['QUERY_STRING'].'&action=view&id='.$class_timetable['class_id'].'">View</a> | <a href="?'.$_SERVER['QUERY_STRING'].'&action=edit&id='.$class_timetable['class_id'].'">Edit</a> </td>
                </tr>';
            }
            ?>
        </tbody></table>
        </div>
        <?php 
    }
    //
    public function edit_timetable($class_id) {
        global $wpdb;
        echo '<div class="wrap">';
        if(!$class_id) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('No class select!'));
        else {
            $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE id = ".$class_id);
            if(!$class) printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-error'), esc_html('Class '.$class_id.' doesn\'t exist!'));
            else {
                $timetable = (array) $wpdb->get_row("SELECT * FROM $this->table_timetable WHERE class_id = '$class_id' ORDER BY updated_at DESC");
                /* Declare variable to store info changed timetable of class -> compare diff 
                 */
                $timetable_md5_old = '';
                $timetable_md5_new = '';
                if($timetable) {
                    foreach($this->days as $day) {
                        //if(isset($timetable[$day]) && !empty($timetable[$day])) $timetable_md5_old .= $timetable[$day];
                        if(isset($timetable[$day])) $timetable_md5_old .= $timetable[$day];
                    }
                }

                if(isset($_POST['submit']) && !empty($_POST['time'])) {
                    //echo '<pre>';var_dump($_POST);echo '</pre>';exit;
                    $update = [];
                    foreach($this->days as $day) {
                        if(isset($_POST['time'][$day])) {
                            $update[$day] = $_POST['time'][$day];
                            $timetable_md5_new .= $_POST['time'][$day];
                        }
                    }
                    if(!empty($update)) {
                        if(md5($timetable_md5_new) != md5($timetable_md5_old)) {
                            $default = array('class_id' => $class_id,'updated_at' => gmdate("Y-m-d H:i:s",time()+7*3600));
                            $insert = array_merge($default, $update);
                            /* When create new class, will create a row empty timetable for that class.
                            * So will update that row, not insert new row */
                            if($timetable_md5_old=='' && $timetable)
                                $wpdb->update($this->table_timetable, $insert, ['id'=>$timetable['id']]);
                            else
                                $wpdb->insert($this->table_timetable, $insert);
                            // Get new data timetable after update new data
                            $timetable = (array) $wpdb->get_row("SELECT * FROM $this->table_timetable WHERE class_id = '$class_id' ORDER BY updated_at DESC");
                            printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Update timetable of class '.$class['name'].' success!') );
                        } else printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr('notice notice-success'), esc_html('Nothing changed!') );
                    }
                }
                ?>
                 <h1 class="wp-heading-inline">Edit timetable of class <?php echo $class['name']; ?></h1>
                <form action="admin.php?<?php echo $_SERVER['QUERY_STRING']; ?>" method="POST">
                    <?php wp_nonce_field( 'nonce_edit_timetable', 'nonce_edit_timetable'); ?>
                    <table class="wp-list-table widefat fixed striped posts" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" id="title" class="manage-column column-author">Member</th>
                                <?php 
                                foreach($this->days as $day) {
                                    echo '<th scope="col" id="count" class="manage-column column-author">'.ucfirst($day).'</th>';
                                } ?>
                            </tr>
                        </thead>
                        <tbody id="the-list">
                            <?php
                            $args = array(
                                'meta_key'     => '_class_id',
                                'meta_value'   => $class_id,
                                'orderby'      => 'nicename',
                                'order'        => 'ASC',
                            ); 
                            $list_users = get_users( $args );
                            if(empty($list_users)) $list_users = array(1);
                            $i = 0;
                            foreach ( $list_users as $user ) {
                                $name = isset($user->user_nicename) ? $user->user_nicename : 'No member';
                                echo '<tr>
                                    <td>'.$name.'</td>';
                                if($i==0) foreach($this->days as $day) {
                                    $time = $timetable[$day];
                                    echo '<th scope="col" class="manage-column column-author" rowspan="'.count($list_users).'">
                                            <textarea name="time['.$day.']" style="width:100%">'.$time.'</textarea>
                                        </th>';
                                }
                                echo '</tr>';
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                    <p class="submit">
                        <input type="submit" name="submit" id="submit" class="button button-primary" value="Save">
                        <input type="button" name="submit" onclick="location.href='?page=<?php echo $_REQUEST['page'].'&action=view&id='.$class_id; ?>';" class="button button-cancel" value="Back">
                    </p>
                </form>
                <?php 
            }
        }
        echo '</div>';
    }
    public function view_timetable($class_id,$return=false) {
        global $wpdb;
        $html = '<div class="wrap">';
        
        if(!$class_id) $html .= '<div class="notice notice-error"><p>No class select!</p></div>';
        else {
            if(preg_match('/^(\d+)$/',$class_id))
                $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE id = ".$class_id);
            else {
                $class = (array) $wpdb->get_row("SELECT * FROM $this->table_class WHERE name = '".$class_id."'");
                if($class) $class_id = $class['id'];
            }
            if(!$class) $html .= '<div class="notice notice-error"><p>Class '.$class_id.' doesn\'t exist!</p></div>';
            else {
                //$html .= '<h1 class="wp-heading-inline">Timetable of class '.$class['name'].'</h1>';
                $timetable = (array) $wpdb->get_row("SELECT * FROM $this->table_timetable WHERE class_id = '$class_id' ORDER BY updated_at DESC");
                $list_timetable_history = (array) $wpdb->get_results("SELECT * FROM $this->table_timetable WHERE class_id = '$class_id' AND id <> {$timetable['id']} ORDER BY updated_at DESC");
                ob_start();
                ?>
                    <h1 class="wp-heading-inline">Timetable of class <?php echo $class['name']; ?></h1>
                    <?php 
                    if(is_admin())
                        echo '<a href="?'.$_SERVER['QUERY_STRING'].'&action=edit&id='.$class_id.'" class="page-title-action">Edit</a>';
                    ?>
                    <table class="wp-list-table widefat fixed striped posts" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col" id="title" class="manage-column column-author">Member</th>
                                <?php 
                                foreach($this->days as $day) {
                                    echo '<th scope="col" id="count" class="manage-column column-author">'.ucfirst($day).'</th>';
                                } ?>
                            </tr>
                        </thead>
                        <tbody id="the-list">
                            <?php
                            $args = array(
                                'meta_key'     => '_class_id',
                                'meta_value'   => $class_id,
                                'orderby'      => 'nicename',
                                'order'        => 'ASC',
                            ); 
                            $list_users = get_users( $args );
                            if(empty($list_users)) $list_users = array(1);
                            $i = 0;
                            foreach ( $list_users as $user ) {
                                $name = isset($user->user_nicename) ? $user->user_nicename : 'No member';
                                echo '<tr>
                                    <td>'.$name.'</td>';
                                if($i==0) foreach($this->days as $day) {
                                    $time = $timetable[$day];
                                    echo '<th scope="col" class="manage-column column-author" rowspan="'.count($list_users).'">'.$time.'</th>';
                                }
                                echo '</tr>';
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table> <br />
                    <?php
                    $html .= ob_get_clean();

                    if(is_admin() && !empty($list_timetable_history)) {
                        //echo '<pre>';var_dump($list_timetable_history);echo '</pre>';
                        $html .= '<h1 class="wp-heading-inline">History changed timetable of class '.$class['name'].'</h1>
                        <table class="wp-list-table widefat fixed striped posts" style="width:100%">
                            <thead>';
                            $html .= '<tr>
                                    <th scope="col" id="title" class="manage-column column-author">Updated at</th>';
                                    foreach($this->days as $day) {
                                        $html .= '<th scope="col" id="count" class="manage-column column-author">'.ucfirst($day).'</th>';
                                    }
                                $html .= '<th scope="col" id="title" class="manage-column column-author">Action</th>';
                            $html .= '</tr>';
                            $html .= '</thead>
                            <tbody id="the-list">';
                            foreach($list_timetable_history as $item) {
                                $item = (array) $item;
                                $html .= '<tr>
                                        <td>'.$item['updated_at'].'</td>';
                                        foreach($this->days as $day) {
                                            $time = $item[$day];
                                            $html .= '<th scope="col" class="manage-column column-author">'.$time.'</th>';
                                        }
                                $html .= '<td> <a href="?'.$_SERVER['QUERY_STRING'].'&action=apply_timetable&id='.$item['id'].'" title="Apply this timetable">Apply</a> | <a href="?'.$_SERVER['QUERY_STRING'].'&action=delete_history&id='.$item['id'].'">Delete</a> </td>';
                                $html .= '</tr>';
                            }
                            $html .= '</tbody>
                        </table>';
                    }
            }
        }
        $html .= '</div><br />';
        if($return) return $html;
        else echo $html;
    }
    public function apply_timetable($timetable_id) {
        global $wpdb;
        $wpdb->update($this->table_timetable, ['updated_at'=>gmdate("Y-m-d H:i:s",time()+7*3600)], ['id'=>$timetable_id]);
        $url = $_SERVER['HTTP_REFERER'];
        echo '<script>location.href=\''.$url.'\';</script>';
    }
    public function delete_timetable($timetable_id) {
        global $wpdb;
        $wpdb->delete( $this->table_timetable, ['id'=>$timetable_id]);
        $url = $_SERVER['HTTP_REFERER'];
        echo '<script>location.href=\''.$url.'\';</script>';
    }
}
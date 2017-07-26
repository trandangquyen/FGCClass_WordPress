<?php
    include_once (__DIR__.'/../Model/event-model.php');
    //echo $_SERVER['QUERY_STRING'];
    if(strpos($_SERVER['QUERY_STRING'],'page=all-events-list') !== false)
    {
        $all_events = $new_event ->show_all_event();
        if(isset($_REQUEST['edit-event']))
        {
            include_once (__DIR__.'/../View/edit-event.php');
        }elseif (isset($_REQUEST['delete-event']))
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'events_post';
            $id = $_REQUEST['delete-event'];
            $id = array( 'ID' => $id );
            $formats =  array( '%d' );
            $new_event->delete_event($table_name,$id,$formats);
            echo "<script>location.href='admin.php?page=all-events-list';</script>";
        }
        else
        include_once (__DIR__.'/../View/show-all-event.php');
    }
    if(strpos($_SERVER['QUERY_STRING'],'page=add-new-event') !== false)
    {
        if (isset($_POST['event-submit'])) {
            // Debugging output, since you are having troubles finding the issue.
            // echo "SAVING ENTRY";
            // Get the nonce value for validation
            $nonce = $_POST['ticket_nonce'];
            // If the nonce does not verify, do NOT process the form.
            if (!wp_verify_nonce($nonce, 'MyNonceAction')) {
                // If this spits out an error, that means the nonce failed
                echo 'Security error. Do not process the form.';
                return;
            }
            // add data
            global $wpdb;
            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $date = date("m/d/Y h:i A");
            $final = strtotime($date);
            $time_posted = date("Y-m-d h:i:s", $final);
            $table_name = $wpdb->prefix . 'events_post';
            $event_post_author = get_current_user_id();
            $event_time_start = strtotime($_POST['datetimepicker-start']);
            $event_time_start = date('Y-m-d h:i:s',$event_time_start);
            $event_time_end = strtotime($_POST['datetimepicker-end']);
            $event_time_end = date('Y-m-d h:i:s',$event_time_end);
            $data = array(
                'event_post_author' => $event_post_author,
                'event_post_title' => $_POST['event-title'] ,
                'event_post_content' => $_POST['event-content'],
                'event_post_date' => $time_posted,
                'event_post_start' => $event_time_start,
                'event_post_end' => $event_time_end,
                'event_post_location' => $_POST['event-location'],
                'event_post_status' => $_POST['event-status']
            );

            // Debugging: Lets see what we're trying to save
            //var_dump($data);

            // FOR database SQL injection security, set up the formats
            $formats = array(
                '%d', // event_post_author should be a integer
                '%s', // event_post_title should be a string
                '%s', // event_post_content should be a string
                '%s', // event_post_date should be a string
                '%s', // event_post_start should be a string
                '%s', // event_post_end should be a string
                '%s', // event_post_location should be a string
                '%s', // event_post_status should be a string
            );
            $check_insert_event = $new_event->insert_event_post($table_name,$data,$formats);
            if($check_insert_event)
            {

                include_once (__DIR__.'/../View/edit-event.php');
            }

            else{

                include_once (__DIR__.'/../View/add-new-event.php');
            }
        }
        else if (isset($_GET['edit-event'])){
            include_once (__DIR__.'/../View/edit-event.php');
        }
        else if (isset($_POST['event-update'])){
            //global $wpdb;
            $post_id = $_POST['post_id'];
            //var_dump($post_id);
            //exit;
            $post_title = $_POST['event-title'];
            $post_content = $_POST['event-content'];
            $event_time_start = strtotime($_POST['datetimepicker-start']);
            $event_time_start = date('Y-m-d h:i:s',$event_time_start);
            $event_time_end = strtotime($_POST['datetimepicker-end']);
            $event_time_end = date('Y-m-d h:i:s',$event_time_end);
            $table = 'wp_events_post';
            $data = array(
                'event_post_title' => $post_title,
                'event_post_content'=>$post_content,
                'event_post_start' => $event_time_start,
                'event_post_end' => $event_time_end,
                'event_post_location' => $_POST['event-location'],
                'event_post_status' => $_POST['event-status']
            );
            $where = array('id'=>$post_id);
            echo $new_event->edit_event_post($table,$data,$where);
            include_once (__DIR__.'/../View/edit-event.php');
        }

        else{
            include_once (__DIR__.'/../View/add-new-event.php');
        }
    }
    if(strpos($_SERVER['QUERY_STRING'],'page=all-category-event') !== false)
    {

        if(isset($_POST['event-add-category'])){
            $category_name = $_POST['category-name'];
            $category_parent = isset($_POST['cat-parent'])?$_POST['cat-parent'] : '';
            $table_name = 'wp_events_category';
            $data = array(
                'event_category_name' => $category_name,
                'parent' => $category_parent
            );
            $formats = array(
                '%s',
                '%d',
            );
            $add_event_category = $new_event->insert_event_post($table_name,$data,$formats);
        }
        include_once (__DIR__.'/../View/event-category.php');
    }



?>
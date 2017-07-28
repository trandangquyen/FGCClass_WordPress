<?php
//load Object Model
include_once (__DIR__.'/../Model/event-model.php');
//load controller for View
include_once (__DIR__.'/../lib/load-view.php');

class EventController{
    protected $current_page;
    protected $neweventmodel;
    protected $view;
    //Constructor
    public function __construct()
    {
        $this->neweventmodel = new EventManagerModel();
        $this->current_page = isset($_GET['page']) ? $_GET['page'] : null;
        $this->view = new ViewLoader();
    }
    //funtion to get current urls and do actions
    public function ShowCurrentPage(){
        switch($this->current_page){
            case 'all-events-list': $this->ShowAllEvents(); break;
            case 'add-new-event': $this->AddEditEvent(); break;
            case 'all-category-event': $this->ShowAllCategory(); break;
            default : break;
        }

    }
    //Show all events
    public function ShowAllEvents(){

        //var_dump($all_events);
        if(isset($_REQUEST['edit-event']))
        {
            $this->view->load('edit-event');
            //include_once (__DIR__.'/../View/edit-event.php');
        }elseif (isset($_REQUEST['delete-event']))
        {
            global $wpdb;
            $table_name = $wpdb->prefix . 'events_post';
            $id = $_REQUEST['delete-event'];
            $id = array( 'ID' => $id );
            $formats =  array( '%d' );
            $this->neweventmodel->delete_event($table_name,$id,$formats);
            echo "<script>location.href='admin.php?page=all-events-list';</script>";
        }
        else
            $data = array(
                'all_events' => $this->neweventmodel->show_all_event()
            );
            $this->view->load('show-all-event',$data);
    }
    //function to add new or delete events
    public function AddEditEvent(){
        // in add new event case
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
            // begin to execute add data action
            global $wpdb;
            //set timezone
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
            $check_insert_event = $this->neweventmodel->insert_event_post($table_name,$data,$formats);

            if($check_insert_event)
            {
                //if insert data success, check id of event_post to load edit page.
                //CASE1 : Edit & update
                /*if(isset($_GET['edit-event']))
                {
                    $post_id = $_GET['edit-event'];

                }*/
                //CASE2 : ADD NEW
//                else{
                    global $wpdb;
                    if(!isset($_POST['post_id']))
                        $post_id = $wpdb->insert_id;
                    else
                        $post_id = $_POST['post_id'];

//                }
                $data = array(
                    'results' => $this->neweventmodel->show_single_event($post_id)
                );
                $this->view->load('edit-event',$data);
            }

            else{
                $this->view->load('add-new-event');
            }
        }
        // in edit event case
        else if (isset($_GET['edit-event'])){
            $post_id = $_GET['edit-event'];
            $data = array(
                'results' => $this->neweventmodel->show_single_event($post_id)
            );
            $this->view->load('edit-event',$data);
        }
        // in update event case
        else if (isset($_POST['event-update'])){
            $post_id = $_POST['post_id'];
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
            echo $this->neweventmodel->edit_event_post($table,$data,$where);
            //$post_id = $_GET['edit-event'];
            $data = array(
                'results' => $this->neweventmodel->show_single_event($post_id)
            );
            $this->view->load('edit-event',$data);
        }

        else{
            $this->view->load('add-new-event');
        }
    }
    // function to show all event category
    public function ShowAllCategory(){
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
            $add_event_category = $this->neweventmodel->insert_event_post($table_name,$data,$formats);
        }
        $data = array(
            'results' => $this->neweventmodel->show_event_category()
        );
        $this->view->load('event-category',$data);
    }

}
$controller = new EventController();
$controller->ShowCurrentPage() ;


?>
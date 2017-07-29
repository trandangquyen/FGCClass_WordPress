<?php
//load Object Model
include_once (__DIR__.'/../Model/event-model.php');
//load controller for View
include_once (__DIR__.'/../lib/load-view.php');

class ShowEventController{
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
    //Show all events
    public function ShowAllEvents(){
        //echo 'heloooo'; exit;
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

}
$controller = new ShowEventController();
$controller->ShowAllEvents() ;


?>
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
    //Show all category
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
$controller = new ShowEventController();
$controller->ShowAllCategory() ;


?>
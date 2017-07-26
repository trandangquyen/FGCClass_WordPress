<?php
class ManagerEvent{
    private $wpdb;
    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
    }
    // insert a new event post
    public function insert_event_post($table_name,$data,$formats)
    {
        global $wpdb;
        // Debugging: Turn on error reporting for db to see if there's a database error
        $wpdb->show_errors();
        //var_dump($data); exit;
        // Actually attempt to insert the data
        $sql_event_insert = $this->wpdb->insert($table_name, $data, $formats);


        if($sql_event_insert)
            return true;
        else
            return false;
    }
    //update a event post
    public function edit_event_post($table = null, $data= null,$where = null,$format = null, $where_format = null )
    {
        $result = $this->wpdb->update( $table, $data, $where, $format, $where_format );
        if($result)
            return '<div class="edit-success"> Cập nhật thành công! </div>';
        else
            return '<div class="edit-fail"> Warning! Cập nhật thất bại, nội dung chưa được thay đổi! </div>';
    }
    public function show_all_event(){
        $results = $this->wpdb->get_results(
            "
            SELECT *
            FROM wp_events_post
            "
        );
            return $results;
    }
    public function delete_event($table,$id,$formats){
        $result = $this->wpdb->delete( $table, $id, $formats );
        $this->wpdb->show_errors($result);

    }
}
$new_event = new ManagerEvent();


?>
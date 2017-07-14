<?php 
class FGC_Quiz_Widget_Timetable extends WP_Widget {
    function __construct() {
        parent::__construct (
            'fgc_quiz_widget', // id của widget
            'Class Timetable', // tên của widget
            array(
                'description' => 'Widget show timetable' // mô tả
            )
        );
    }

    /**
        * Tạo form option cho widget
        */
    function form( $instance ) {
        global $wpdb, $fgc_config;
        parent::form( $instance );

        //Biến tạo các giá trị mặc định trong form
        $default = array(
            'title' => 'Timetable',
            'class_id' => '',
        );

        //Gộp các giá trị trong mảng $default vào biến $instance để nó trở thành các giá trị mặc định
        $instance = wp_parse_args( (array) $instance, $default);

        //Tạo biến riêng cho giá trị mặc định trong mảng $default
        $title = esc_attr( $instance['title'] );
        $class_id = esc_attr( $instance['class_id'] );
        $list_class = $wpdb->get_results( "SELECT * FROM {$fgc_config['table_class']} ", ARRAY_A);

        //Hiển thị form trong option của widget
        echo 'Nhập tiêu đề: <input class="widefat" type="text" name="'.$this->get_field_name('title').'" value="'.$title.'" />';
        echo 'Class: <br /><select name="'.$this->get_field_name('class_id').'">
            <option value="">-- Select class --</option>';
            foreach ($list_class as $class) {
                echo '<option value="'.$class['id'].'"'.($class_id == $class['id'] ? ' selected' : '').'>'.$class['name'].'</option>';
            }
        echo '</select>';

    }

    /**
    * save widget form
    */

    function update( $new_instance, $old_instance ) {
        parent::update( $new_instance, $old_instance );

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['class_id'] = strip_tags($new_instance['class_id']);
        return $instance;
    }

    /**
    * Show widget
    */
    function widget( $args, $instance ) {
 
        extract( $args );
        $title = apply_filters( 'widget_title', $instance['title'] );
        $class_id = apply_filters( 'widget_title', $instance['title'] );
 
        echo $before_widget;
 
        //In tiêu đề widget
        echo $before_title.$title.$after_title;
 
        // Nội dung trong widget
 
        echo "This will show timetable of ";
 
        // Kết thúc nội dung trong widget
 
        echo $after_widget;
    }
 
}
<?php

foreach ( $results as $result )
{
    $show_event_time_start = $result->event_post_start;
    $show_event_time_end = $result->event_post_end;
    $show_event_location = $result->event_post_location;
    $post_title = $result->event_post_title;
    $post_content = $result->event_post_content;
    $post_status = $result->event_post_status;
    $post_id = $result->id;
    $current_attachment_id = $result->attachment_id;

}
date_default_timezone_set('Asia/Ho_Chi_Minh');
$show_event_time_start = new DateTime($show_event_time_start);
$show_event_time_end = new DateTime($show_event_time_end);
$show_event_time_start = date_format($show_event_time_start,"m/d/Y h:i A");
$show_event_time_end  = date_format($show_event_time_end ,"m/d/Y h:i A");

?>
<div class="row">
    <div class="col-sm-8">
        <a href="?page=event.add-new-event&action=add" class="add-eventbt btn btn-primary" role="button">Thêm sự kiện</a>
        <h2>Sửa sự kiện</h2>
        <form action="?page=event.add-new-event" method="post" enctype="multipart/form-data">
            <?php
            // Add a nonce field
            wp_nonce_field('MyNonceAction', 'ticket_nonce');
            ?>
            <div class="form-group">
                <label for="event-title">Tên sự kiện</label>
                <input id="event-title" name="event-title" type="text" class="form-control" value="<?php echo $post_title; ?>"
                       placeholder="Nhập tiêu đề">
            </div>
            <div class="form-group">
                <label for="event-content">Nội dung sự kiện</label>
                <textarea name="event-content" id="event-content" class="form-control" rows="20"> <?php echo $post_content; ?> </textarea>
            </div>
            <input type="hidden"  name="post_id" value="<?php echo $post_id;?>">
            <div class="row">
                <div class='col-sm-3'>
                    <label for="datetimepicker-start">Thời gian bắt đầu</label>
                    <input type='text' name="datetimepicker-start" class="form-control" id='datetimepicker-start' value="<?php echo $show_event_time_start; ?>" placeholder="<?php echo (isset($show_event_time_start)? $show_event_time_start:'Chọn thời gian bắt đầu'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Chọn thời gian bắt đầu'"/>
                </div>
                <div class='col-sm-3'>
                    <label for="datetimepicker-end">Thời gian kết thúc</label>
                    <input type='text' name="datetimepicker-end" class="form-control" id='datetimepicker-end' value="<?php echo $show_event_time_end; ?>" placeholder="<?php echo (isset($show_event_time_end)? $show_event_time_end:'Chọn thời gian kết thúc'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Chọn thời gian kết thúc'"/>
                    <div class="error-time">Thời gian kết thúc nhỏ</div>
                </div>
                <div class='col-sm-3'>
                    <label for="event-location">Địa điểm</label>
                    <input type='text' name="event-location" class="form-control" id='event-location' value="<?php echo $show_event_location; ?>" placeholder="<?php echo (isset($show_event_location)? $show_event_location:'Nhập vào địa điểm'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập vào địa điểm'"/>
                </div>
                <div class='col-sm-3'>
                    <div class="radio">
                        <label><input id="happening" type="radio" name="event-status" value="happening" <?php echo (($post_status == 'happening')?  'checked': 'disabled')?>>Đang diễn ra</label>
                    </div>
                    <div class="radio">
                        <label><input id="upcoming" type="radio" name="event-status" value="upcoming" <?php echo (($post_status == 'upcoming')?  'checked': 'disabled')?>>Sắp diễn ra</label>
                    </div>
                    <div class="radio">
                        <label><input id="expired" type="radio" name="event-status" value="expired" <?php echo (($post_status == 'expired')? 'checked': 'disabled')?>>Đã kết thúc</label>
                    </div>

                </div>
            </div>
            <div class="current-thumbnail"><?php echo wp_get_attachment_image( $current_attachment_id, 'post-thumb-wide' ) ;?></div>
            <input type="file" name="my_image_upload" id="my_image_upload"  multiple="false" />
            <input type="hidden" name="post_attach_id" id="post_attach_id" value="0" />
            <input type="hidden" name="current_attachment_id" id="current_attachment_id" value="<?php echo $current_attachment_id; ?>" />
            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#datetimepicker-start , #datetimepicker-end').datetimepicker();
                });
            </script>
            <button type="submit" class="event-edit btn btn-primary" name="event-update">Update</button>
        </form>
    </div>
</div>
<script>
    CKEDITOR.replace( 'event-content' );
</script>
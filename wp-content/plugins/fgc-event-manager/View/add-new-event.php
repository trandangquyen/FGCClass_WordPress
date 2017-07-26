<?php

?>
<div class="row">
    <div class="col-sm-8">
        <h2>Thêm sự kiện</h2>
        <form action="?<?php echo $_SERVER['QUERY_STRING']; ?>&action=edit" method="post">
            <?php
            // Add a nonce field
            wp_nonce_field('MyNonceAction', 'ticket_nonce');
            ?>
            <div class="form-group">
                <label for="event-title">Tên sự kiện</label>
                <input id="event-title" name="event-title" type="text" class="form-control"
                       placeholder="Nhập tiêu đề">
            </div>
            <div class="form-group">
                <label for="event-content">Nội dung sự kiện</label>
                <textarea name="event-content" id="event-content" class="form-control" rows="20"></textarea>
            </div>
            <input type="hidden" name="post-id" value="Norway">
            <div class="row">
                <div class='col-sm-3'>
                    <label for="datetimepicker-start">Thời gian bắt đầu</label>
                    <input type='text' name="datetimepicker-start" class="form-control" id='datetimepicker-start' placeholder="<?php echo (isset($show_event_time_start)? $show_event_time_start:'Chọn thời gian bắt đầu'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Chọn thời gian bắt đầu'"/>
                </div>
                <div class='col-sm-3'>
                    <label for="datetimepicker-end">Thời gian kết thúc</label>
                    <input type='text' name="datetimepicker-end" class="form-control" id='datetimepicker-end' placeholder="<?php echo (isset($show_event_time_end)? $show_event_time_end:'Chọn thời gian kết thúc'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Chọn thời gian kết thúc'"/>
                    <div class="error-time">Thời gian kết thúc nhỏ</div>
                </div>
                <div class='col-sm-3'>
                    <label for="event-location">Địa điểm</label>
                    <input type='text' name="event-location" class="form-control" id='event-location' placeholder="<?php echo (isset($show_event_time_location)? $show_event_time_location:'Nhập vào địa điểm'); ?>"  onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nhập vào địa điểm'"/>
                </div>
                <div class='col-sm-3'>
                    <div class="radio">
                        <label><input id="happening" type="radio" name="event-status" value="happening" disabled>Đang diễn ra</label>
                    </div>
                    <div class="radio">
                        <label><input id="upcoming" type="radio" name="event-status" value="upcoming" disabled>Sắp diễn ra</label>
                    </div>
                    <div class="radio">
                        <label><input id="expired" type="radio" name="event-status" value="expired" disabled>Đã kết thúc</label>
                    </div>

                </div>
            </div>


            <script type="text/javascript">
                jQuery(document).ready(function($) {
                    $('#datetimepicker-start , #datetimepicker-end').datetimepicker();
                });
            </script>
            <button type="submit" class="btn btn-primary event-submit" name="event-submit">Submit</button>
        </form>
    </div>
</div>
<script>
    CKEDITOR.replace( 'event-content' );
</script>
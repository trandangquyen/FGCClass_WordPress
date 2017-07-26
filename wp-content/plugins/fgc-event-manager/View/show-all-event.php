
<table class="table table-striped">
    <thead>
    <tr>
        <th>STT</th>
        <th>Tên bài viết</th>
        <th>Thời gian bắt đầu</th>
        <th>Thời gian kết thúc</th>
        <th>Địa điểm</th>
        <th>Sửa/Xóa</th>
        <th>Tác giả</th>
        <th>Trạng thái</th>
    </tr>
    </thead>
    <tbody>
    <?php
    foreach ( $all_events as $key => $result ):
        $author = get_userdata( $result->event_post_author );
    ?>
    <tr>
        <th scope="row"><?php echo $key+1 ?></th>
        <td><?php echo $result->event_post_title; ?></td>
        <td><?php echo $result->event_post_start; ?></td>
        <td><?php echo $result->event_post_end; ?></td>
        <td><?php echo $result->event_post_location; ?></td>
        <td><a href="?page=add-new-event&edit-event=<?php echo $result->id?>">Sửa</a> | <a href="?page=all-events-list&delete-event=<?php echo $result->id; ?>">Xóa</a></td>
        <td><?php echo $author->user_nicename; ?></td>
        <td><?php echo $result->event_post_status; ?></td>
    </tr>
    <?php endforeach;  ?>
    </tbody>
</table>
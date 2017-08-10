
<div class="list-category" id="show-event-cat">
    <div class="row">
        <div class="col-xs-4">
            <h2>Thêm danh mục mới</h2>
            <form action="" method="post">
                <input type="text" id="event-category-name" name="category-name" placeholder="Nhập tên danh mục">
                <div class="select-cat-parent">
                    <h3>Chọn danh mục cha</h3>
                    <?php
                    foreach ($results as $result):
                        ?>
                        <div class="item-wrapper"><input type="radio" name="cat-parent" value="<?php echo $result->id; ?>"><span><?php echo $result->event_category_name; ?></span></div>
                    <?php endforeach; ?>
                </div>
                <button type="submit" class="add-category btn btn-primary" name="event-add-category">Submit</button>
            </form>
        </div>


        <div class="col-xs-3">
            <h2>Tất cả danh mục</h2>
            <?php
            foreach ($results as $result):
            ?>
            <div class="item-wrapper"><input type="checkbox"><span><?php echo $result->event_category_name; ?></span></div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

function open_media_up(target){
    tb_show('', 'media-upload.php?type=image&post_id=1&TB_iframe=true&flash=0');
        window.send_to_editor = function (html) {
            imgurl = jQuery('img', html).attr('src');
            jQuery(target).val(imgurl);
            tb_remove();
    };
    return false;
}

<div class="wrap w3eden" style="margin-top: 45px">

    <div class="panel panel-default" id="wpdm-wrapper-panel">
        <div class="panel-heading">
            <button type="button" id="cdh" class="btn btn-default btn-sm pull-right" style="font-weight: 600"><i class="sinc fa fa-refresh color-green"></i><?php _e("Clear Download History",'download-manager'); ?></button>
            <b><i class="fa fa-bar-chart-o color-purple"></i> &nbsp; <?php echo __('Download History','download-manager'); ?></b>

        </div>

        <div class="tab-content" style="padding: 15px;" id="dstats">
<?php 

$type = WPDM_BASE_DIR."admin/tpls/stats/history.php";

include($type);

?>
</div>
</div>

    <style>
        .notice, .updated{
            display: none !important;
        }
    </style>
    <script>
        jQuery(function ($) {
            $('#cdh').on('click', function () {
                if(!confirm("<?php _e('Are you sure? There is no going back!', 'download-manager'); ?>")) return false;
                var olabel = $(this).html();
                var ow = $(this).width();
                $(this).css('width', (ow+30)+"px");
                $(this).html('<i class="sinc fa fa-refresh fa-spin color-green"></i> &nbsp; <?php _e("Clearing...",'download-manager'); ?>');
                $.post(ajaxurl, {action:'wpdm_clear_stats'}, function (res) {
                    $('#cdh').html(olabel);
                    $('#dstats').html("<div class='alert alert-info'><?php _e('Download History is Empty', 'download-manager'); ?></div>");
                });

            });
        });
    </script>
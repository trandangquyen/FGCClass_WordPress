(function($) {
    function checkTimeEvent(){
        $("#datetimepicker-end,#datetimepicker-start").blur(function(){
            var timeStart = $('#datetimepicker-start').val();
            var timeEnd = $('#datetimepicker-end').val();
            var currentDate = new Date();
            timeStart = new Date(timeStart);
            timeEnd = new Date(timeEnd);
            var startTimeSecond = timeStart.getTime();
            var endTimeSecond = timeEnd.getTime();
            var currentTimeSecond = currentDate.getTime();
            if (endTimeSecond < startTimeSecond) {
                alert("Lỗi! Ngày kết thúc nhỏ hơn ngày bắt đầu");
                $(this).val('');
            }
            if(currentTimeSecond >= startTimeSecond && currentTimeSecond <= endTimeSecond)
            {
                console.log('dang dien ra');
                $('#happening').prop({
                    "checked": true,
                    "disabled": false,
                });
                $('#happening').closest('.radio').siblings().find('input').prop({
                    "checked" : false,
                    "disabled": true,
                });
            }
            else if(currentTimeSecond < startTimeSecond && currentTimeSecond < endTimeSecond)
            {
                $('#upcoming').prop({
                    "checked": true,
                    "disabled": false,
                });
                $('#upcoming').closest('.radio').siblings().find('input').prop({
                    "checked" : false,
                    "disabled": true,
                });
            }
            else if(currentTimeSecond > endTimeSecond)
            {
                $('#expired').prop({
                    "checked": true,
                    "disabled": false,
                });
                $('#expired').closest('.radio').siblings().find('input').prop({
                    "checked" : false,
                    "disabled": true,
                });
            }
            else{
                $('#expired').prop({
                    "checked": true,
                    "disabled": false,
                });
                $('#expired').closest().siblings().find('input').prop({
                    "checked" : false,
                    "disabled": true,
                });
            }

        });

    }

    /* OnLoad Page */
    $(document).ready(function($) {
        checkTimeEvent();
    });

})(jQuery);
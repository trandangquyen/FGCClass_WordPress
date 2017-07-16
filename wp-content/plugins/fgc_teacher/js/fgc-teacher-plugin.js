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
                $('#happening').siblings('input').prop({
                    "checked" : false,
                    "disabled": true,
                });
            }
            else if(currentTimeSecond < startTimeSecond && currentTimeSecond < endTimeSecond)
            {
                console.log('sap dien ra');
                $('#upcoming').prop({
                    "checked": true,
                    "disabled": false,
                });
                $('#upcoming').siblings('input').prop({
                    "checked" : false,
                    "disabled": true,
                });
            }
            else if(currentTimeSecond > endTimeSecond)
            {
                console.log('da ket thuc');
                $('#expired').prop({
                    "checked": true,
                    "disabled": false,
                });
                $('#expired').siblings('input').prop({
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

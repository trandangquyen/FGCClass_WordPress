    <!-- Footer starts -->
    <footer role="contentinfo">
        <div class="footer-bg"></div>
        <div class="container-full">
        	
            <div class="row">
                <div class="col-sm-12">
				 <?php if($meta_arr['ics_enable_subscribe']==1){ ?>
                    <form method="post" action="" class="subscribe-form">
                        <p><?php echo $meta_arr['ics_subscribe_text'];?></p>
                        <input type="email" name="email" id="subscribe-email" placeholder="<?php echo stripslashes($meta_arr['ics_subscribe_label']);?>" required="">
                        <button id="subscribe-submit"><?php echo stripslashes($meta_arr['ics_subscribe_bttn']);?></button>
                        <div class="subscribe-error-field"></div>
                        <div class="subscribe-message"></div>
                    </form><!-- /.subscribe-form -->
				<?php } ?>
                    <div class="social-media">
                        <p><?php echo stripslashes($meta_arr['ics_smb_text']);?></p>
                        <ul>
	                        <?php
	                        /******************* SOCIAL MEDIA ICONS *******************/
	                        	$sm_arr = ics_sm_types();
	                        	foreach($sm_arr as $k=>$v){
	                        		if(isset($meta_arr[$k]) && $meta_arr[$k]!=''){
	                        			?>
	                        				<li><a href="<?php echo $meta_arr[$k];?>" target="_blank"><i class="fa-ics fa-<?php echo $v;?>-ics"></i></a></li>
	                        			<?php 
	                        		}
	                        	}
	                        ?>                        	
                        </ul>
               
                    </div><!-- /.social-media -->
                    
                     <small><?php echo stripslashes($meta_arr['ics_copyright']);?></small>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer ends -->

    <!-- Scripts -->
    <script src="<?php echo ICS_DIR_URL;?>files/js/vendor/jquery-1.11.0.min.js"></script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/jquery-ui.min.js"></script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/supersized.3.2.7.min.js"></script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/jquery.countdown.js"></script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/owl.carousel.min.js"></script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/jquery.fittext.js"></script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/retina-1.1.0.min.js"></script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/bootstrap.min.js"></script>
    <?php    
            if($meta_arr['ics_count_down_type']=='circles'){
                echo '<script src="'.ICS_DIR_URL.'files/js/jquery.knob.js"></script>';
            }
    ?>
    <!--[if lte IE 9]>
		    <script src="<?php echo ICS_DIR_URL;?>files/js/jquery.placeholder.js"></script>
		    <script type="text/javascript">$('input, textarea').placeholder();</script>
	    <![endif]-->
    <?php
        if($meta_arr['ics_bk_type']=='video'){
        	?>
            	<script src="<?php echo ICS_DIR_URL;?>files/js/jquery.tubular.1.0.js" type="text/javascript"></script>
        	<?php
        }elseif($meta_arr['ics_bk_type']=='parallax'){
        	?>
        		<script src="<?php echo ICS_DIR_URL;?>files/js/jquery.parallaxify.min.js" type="text/javascript"></script>
        	<?php 
        }
    ?>
    <script>
    //JS VIDEO BACKGROUND
    <?php
        if($meta_arr['ics_bk_type']=='video'){
			if(!class_exists('Mobile_Detect'))
            require ICS_DIR_PATH . 'includes/Mobile_Detect.php';
			
            $detect = new Mobile_Detect();
            if( (($detect->isMobile()) || ($detect->isTablet())) && (isset($meta_arr['ics_video_mobile']) && $meta_arr['ics_video_mobile']==1) ) $meta_arr['ics_bk_type'] = 'single_image';
            else{
                ?>
                   $(document).ready(function() {
                        $('.wrap').tubular({videoId: '<?php echo $meta_arr['ics_video_bk'];?>', mute: <?php if(isset($meta_arr['ics_sound_on']) && $meta_arr['ics_sound_on']==1) echo 'false';else echo 'true';?>}); // where idOfYourVideo is the YouTube ID.
                   });
                <?php
           }

        }elseif($meta_arr['ics_bk_type']=='parallax'){
            	///PARALAX	
            	?>
        	$(function(){
        		$(document).ready(function() {
        			$.parallaxify({
        				positionProperty: 'transform',
        				responsive: true,
        				motionType: 'natural',
        				mouseMotionType: 'performance',
        				motionAngleX: 70,
        				motionAngleY: 70,
        				alphaFilter: 0.5,
        				adjustBasePosition: true,
        				alphaPosition: 0.025,
        			});
        		});
        	});
        	<?php 
        }
    ?>
    
    //THE COUNTDOWN
	<?php if($meta_arr["ics_end_date"] != '') { ?>
        until_time = '<?php echo $meta_arr["ics_end_date"];?>' + ' ' + '<?php echo $meta_arr["ics_end_time"];?>';
        until_timestamp = '<?php echo $end_time;?>';
    <?php } else {?>
	    until_time = '01/01/01';
	<?php } ?>	

        <?php
             if($meta_arr['ics_count_down_type']=='circles'){
             	if($meta_arr["ics_end_date"]!='' && $meta_arr["ics_end_time"]!=''){
               ?>
               //COUNTDOWN WITH CIRCLES

        		function indeed_current_date(){
                    var date = new Date();
                    //var utc = date.getTime() + (date.getTimezoneOffset() * 60000);
					var utc = date.getTime();
                    var new_date = new Date(utc);// + (3600000))
                    return new_date;
        		}

                function indeed_countdown() {
                    //var target_date = new Date(window.until_time); // set target date
					var d = new Date();
					d.setTime(until_timestamp*1000);
					target_date = d;                    
                        current_date = indeed_current_date(); // get fixed current date

                    var difference = target_date - current_date;
                    
                    if (difference < 0) {
                        clearInterval(interval);
                        if (callback && typeof callback === 'function') callback();
                        return;
                    }
                    
                   
                    var _second = 1000,
                        _minute = _second * 60,
                        _hour = _minute * 60,
                        _day = _hour * 24;
                    var days = Math.floor(difference / _day),
                        hours = Math.floor((difference % _day) / _hour),
                        minutes = Math.floor((difference % _hour) / _minute),
                        seconds = Math.floor((difference % _minute) / _second);
                        days = (String(days).length >= 2) ? days : '0' + days;
                        hours = (String(hours).length >= 2) ? hours : '0' + hours;
                        minutes = (String(minutes).length >= 2) ? minutes : '0' + minutes;
                        seconds = (String(seconds).length >= 2) ? seconds : '0' + seconds;
                    var ref_days = (days === 1) ? 'day' : 'Days',
                        ref_hours = (hours === 1) ? 'hour' : 'Hours',
                        ref_minutes = (minutes === 1) ? 'minute' : 'Minutes',
                        ref_seconds = (seconds === 1) ? 'second' : 'Seconds';
        			$(".second").val(seconds).trigger("change");
        			$(".minutes").val(minutes).trigger("change");
        			$(".hours").val(hours).trigger("change");
                    $(".days").val(days).trigger("change");
        		}
        		var interval = setInterval(indeed_countdown, 0);
                $(function($) {

                    $(".knob").knob({
                        change : function (value) {
                            //console.log("change : " + value);
                        },
                        release : function (value) {
                            //console.log(this.$.attr('value'));
                            //console.log("release : " + value);
                        },
                        cancel : function () {
                            //console.log("cancel : ", this);
                        },
                        /*format : function (value) {
                            return value + '%';
                        },*/
                        draw : function () {

                            // "tron" case
                            if(this.$.data('skin') == 'tron') {

                                this.cursorExt = 0.3;

                                var a = this.arc(this.cv)  // Arc
                                    , pa                   // Previous arc
                                    , r = 1;

                                this.g.lineWidth = this.lineWidth;

                                if (this.o.displayPrevious) {
                                    pa = this.arc(this.v);
                                    this.g.beginPath();
                                    this.g.strokeStyle = this.pColor;
                                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, pa.s, pa.e, pa.d);
                                    this.g.stroke();
                                }

                                this.g.beginPath();
                                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor ;
                                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, a.s, a.e, a.d);
                                this.g.stroke();

                                this.g.lineWidth = 2;
                                this.g.beginPath();
                                this.g.strokeStyle = this.o.fgColor;
                                this.g.arc( this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                                this.g.stroke();

                                return false;
                            }
                        }
                    });
                });
                <?php
				}//end of not empty date & time
             }//end of circles
             else{
             ?>
             //COUNTDOWN WITH DIGITS

        $('.countdown').downCount({
            date : until_time,
            until_timestamp : '<?php echo $end_time;?>'
        });

             <?php
             }
        ?>

$(function () {
    "use strict";
    <?php
        if($meta_arr['ics_bk_type']=='single_image'){
    ?>
      $.supersized({
          slides: [{ image: '<?php echo $meta_arr["ics_background_img"];?>' }]
      });
    <?php
        }elseif($meta_arr['ics_bk_type']=='slides' || $meta_arr['ics_bk_type']=='slides_with_effect'){
            if($meta_arr['ics_bk_type']=='slides') $slides = unserialize($meta_arr['ics_img_arr']);
            else $slides = unserialize($meta_arr['ics_img_arr_effect']);
            ?>
                    // background
                    $.supersized({

                		// Functionality
                		slide_interval          :   4000,		// Length between transitions
                		transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                		transition_speed		:	700,		// Speed of transition

                		// Components
                		slides 					:  	[			// Slideshow Images

                        <?php
                            foreach($slides as $slide){
                                ?>
                                    {image : '<?php echo $slide;?>'},
                                <?php
                            }
                        ?>
                  									]
                	});
            <?php
        }
    ?>
});
	<?php 
		$time_arr = array( 'ics_days_word', 
						   'ics_day_word', 
						   'ics_hours_word', 
						   'ics_hour_word', 
						   'ics_minutes_word', 
						   'ics_minute_word',
						   'ics_seconds_word',
						   'ics_second_word',
						 );
		foreach($time_arr as $val){
			echo ics_test_meta_return_js_var($val, $meta_arr[$val]);
		}
	?>
    </script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/global.js"></script>
    <script src="<?php echo ICS_DIR_URL;?>files/js/front_end.js"></script>

</body>
</html>
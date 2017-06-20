<?php
  $url = get_admin_url() . 'admin.php?page=ics_admin';
  if(isset($_REQUEST['tab'])) $tab = $_REQUEST['tab'];
  else $tab = 'general_options';
?>
<script>
    ics_url = "<?php echo ICS_DIR_URL;?>";
	ics_base_url = '<?php echo get_site_url();?>';
</script>
<!--top menu -->
<div class="ics-wrap">
        <!--h2 class="nav-tab-wrapper">
            <?php
                $menu_items = array( 'general_options' => 'General Options', 
                					 'timeout'=> 'TimeOut', 
                					 'content' => 'Content', 
                					 'background' => 'Background', 
                					 'subscribe' => 'Subscribe',
                					 'security' => 'Security' );
                foreach($menu_items as $k=>$v){
                    $class = 'nav-tab';
                    if($k==$tab) $class .= ' nav-tab-active';
                    echo '<a href="'.$url.'&tab='.$k.'" class="'.$class.'">'.$v.'</a>';
                }
            ?>
        </h2-->
<style>
	/*TO EXCLUDE THE UPDATE INFO*/
	.update-nag, .updated{
		display:none;
	}
</style>		
<div class="ics_admin_header">
  <div class="ics-main-side">
	<div class="ics_left_side">
		<img src="<?php echo ICS_DIR_URL;?>files/images/dashboard-logo.jpg"/>
	</div>
	<div class="ics_right_side">
		<ul>
		<?php 
		 $menu_items = array( 'general_options' => 'General Options', 
		 						'timeout'=> 'TimeOut', 
		 						'content' => 'Content', 
		 						'background' => 'Background', 
		 						'subscribe' => 'Subscribe', 
		 						'security' => 'Security',
		 						'help' => 'Help', );
		foreach ($menu_items as $k=>$v){
                    $class = '';
                    if($k==$tab) $class .= 'selected';
                    ?>
						<li class="<?php echo $class;?>">
							<a href="<?php echo $url.'&tab='.$k;?>">
								<div class="ics_page_title">
								<i class="ics-fa-menu ics-icon-<?php echo $k;?>"></i>
								<?php echo $v;?>
								</div>
							</a>
						</li>
                    <?php 
                }
            ?>
		</ul>
	</div>
	<div class="clear"></div>
   </div>
</div>   		
<!-- /top menu-->
<?php

    switch($tab){
        case "general_options":
            if(isset($_REQUEST['ics_submit_bttn'])) ics_return_arr_update('general_options');
            $meta_arr = ics_return_arr_val('general_options');
        ?>

        <div class="metabox-holder ics-indeed">
            <form method="post" action="">
                <div class="stuffbox">
                    <h3>
                        <label>Enable Coming Soon Page</label>
                    </h3>
                    <div class="inside">
                        <table class="ics-form-table indeed_admin_table" >
        	                <tbody>
                                <tr>
                                    <td>
                                          <?php
                                              $checked = ics_checkSelected($meta_arr['ics_enable'], 1, 'checkbox');
                                          ?>
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onChange="check_and_h_num(this,'#ics_enable_h');" <?php echo $checked;?>>
                                                <label class="onoffswitch-label" for="myonoffswitch">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
											<div >
												<p style="font-style:italic; color:#666; margin: 10px 0; font-weight:bold;"><span style="color:#ee3733; font-style:normal;">Important: </span>The plugin leaves the website available for Admin Users. If you want to check how is looking the Coming Soon page, logOut or try the website into another browser/window.</p>
                                            </div>
											<input type="hidden" value="<?php echo $meta_arr['ics_enable'];?>" name="ics_enable" id="ics_enable_h" />

                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit">
                            <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                        </div>
                    </div>
                </div>
                
                <div class="stuffbox">
                     <h3>
                        <label>Layout Options</label>
                    </h3>          
                    <div class="inside">
                    	<div style="text-align: center;">
							<div class="ics-layout-wrapper">				
								<div id="ics-layout-1" class="ics-dashboard-img <?php if($meta_arr['ics_layout']==1) echo 'ics-selected-img';?>" onClick="ics_change_layout(1);">
									<img src="<?php echo ICS_DIR_URL;?>files/images/mac_layout_1.png" />
								</div>
								<div class="ics-layout-title">With Special CountDown</div>
							</div>
							<div class="ics-layout-wrapper">
	                   	    	<div id="ics-layout-2" class="ics-dashboard-img <?php if($meta_arr['ics_layout']==2) echo 'ics-selected-img';?>" onClick="ics_change_layout(2);">
	                            	<img src="<?php echo ICS_DIR_URL;?>files/images/mac_layout_2.png" />
	                        	</div>
								<div class="ics-layout-title">Middle Magic Title</div>
							</div>
	                        <input type="hidden" id="ics_layout" value="<?php echo $meta_arr['ics_layout'];?>" name="ics_layout" />                         	
                    	</div>              	
                    	<div class="submit">
	                    	<input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
	                    </div> 
                    </div>     
                </div>
                <div class="stuffbox ics-special-box">
                    <h3>
                        <label>Main Color</label>
                    </h3>
                    <div class="inside">
                        <table class="ics-form-table indeed_admin_table" >
        	                <tbody>
                                <tr>
                                    <td>
                                        <ul id="colors_ul" class="colors_ul">
                                            <?php
                                                $color_scheme = array('#0a9fd8', '#38cbcb', '#27bebe', '#0bb586', '#94c523', '#6a3da3', '#f1505b', '#ee3733', '#f36510', '#f8ba01');
                                                $i = 0;
                                                foreach($color_scheme as $color){
                                                    $class = 'color_scheme_item';
                                                    if($color==$meta_arr['ics_general_color']) $class = 'color_scheme_item-selected';
                                                    if( $i==5 ) echo "<div class='clear'></div>";
                                                    ?>
                                                        <li class="<?php echo $class;?>" onClick="ics_generalColor(this, '<?php echo $color;?>', '#ics_general_color' )" style="background-color: <?php echo $color;?>;"></li>
                                                    <?php
                                                    $i++;
                                                }
                                            ?>
                                        </ul>
                                        <input type="hidden" value="<?php echo $meta_arr['ics_general_color'];?>" name="ics_general_color" id="ics_general_color" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit">
                            <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                        </div>
                    </div>
                </div>

                <div class="stuffbox">
                    <h3>
                        <label>Change Page Effect</label>
                    </h3>
                    <div class="inside">
                        <table class="ics-form-table indeed_admin_table" >
        	                <tbody>
                                <tr>
                                    <td>
                                        <select value="<?php echo $meta_arr['ics_change_page_effect'];?>" name="ics_change_page_effect" style="min-width:200px; margin-top:10px;">
                                            <?php
                                                $effects = array(
                                                                 'fadeIn' => 'FadeIn',
                                                                 'blind' => 'Blind',
                                                                 'clip' => 'Clip',
                                                                 'drop' => 'Drop',
                                                                 'explode' => 'Explode',
                                                                 'fold' => 'Fold',
                                                                 'puff' => 'Puff',
                                                                 'slide' => 'Slide Left',
                                                                 'slide_right' => 'Slide Right',
                                                                 'slide_up' => 'Slide Up',
                                                                 );
                                                foreach($effects as $k=>$v){
                                                    $select = ics_checkSelected($meta_arr['ics_change_page_effect'], $k, 'select');
                                                    ?>
                                                        <option value="<?php echo $k;?>" <?php echo $select;?> ><?php echo $v;?></option>
                                                    <?php
                                                }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit">
                            <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                        </div>
                    </div>
                </div>
				<div class="stuffbox">
                    <h3>
                        <label>Meta Settings</label>
                    </h3>
                    <div class="inside">
                        <table class="ics-form-table indeed_admin_table" >
        	                <tbody>
                                <tr>
                                    <th>
                                        Meta Title
                                    </th>
                                    <td>
                                        <input type="text" value="<?php echo $meta_arr['ics_meta_title'];?>" name="ics_meta_title" style="width:300px;" />
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Meta KeyWords
                                    </th>
                                    <td>
                                        <input type="text" value="<?php echo $meta_arr['ics_meta_keywords'];?>" name="ics_meta_keywords"  style="width:300px;"/>
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Meta Description
                                    </th>
                                    <td>
                                        <input type="text" value="<?php echo $meta_arr['ics_meta_description'];?>" name="ics_meta_description"  style="width:300px;"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit">
                            <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                        </div>
                    </div>
                </div>
                <div class="stuffbox">
                    <h3>
                        <label>Favicon</label>
                    </h3>
                    <div class="inside">
                        <table class="ics-form-table indeed_admin_table" >
        	                <tbody>
                                <tr>
                                    <td>
                                        <input type="text" value="<?php echo $meta_arr['ics_favicon'];?>" name="ics_favicon" onClick="open_media_up(this);" class="indeed_large_input_text"/>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit">
                            <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                        </div>
                    </div>
                </div>
				 <div class="stuffbox ics-special-box">
                    <h3>
                        <label>Custom CSS</label>
                    </h3>
                    <div class="inside">
					<table class="ics-form-table indeed_admin_table" >
        	                <tbody>
                                <tr>
                                    <td>
                                        <textarea style="width: 450px;height: 150px;" name="ics_custom_css" ><?php echo $meta_arr['ics_custom_css'];?></textarea>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="submit">
                            <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                        </div>
					</div>
				 </div>	
            </form>
        </div>

        <?php
        break;

        case "timeout":
            if(isset($_REQUEST['ics_submit_bttn'])) ics_return_arr_update('timeout');
            $meta_arr = ics_return_arr_val('timeout');
        ?>
          <div class="metabox-holder ics-indeed">
              <form method="post" action="">
                  
                  <div class="stuffbox">
                      <h3>
                          <label>End Time:</label>
                      </h3>
                      <div class="inside">
                          <table class="ics-form-table indeed_admin_table" >
          	                <tbody>
                                  <tr>
                                      <td>
                                          <input type="text" class="ics-datepicker-field" value="<?php echo $meta_arr['ics_end_date'];?>" name="ics_end_date" /><input type="text" class="time" value="<?php echo $meta_arr['ics_end_time'];?>" name="ics_end_time"/>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                          <div class="submit">
                              <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                          </div>                                
                      </div>
                  </div>
                   
                  <div class="stuffbox">
                      <h3>
                          <label>Auto Turn Off:</label>
                      </h3>
                      <div class="inside">
                          <table class="ics-form-table indeed_admin_table" >
          	                <tbody>
                                  <tr>
                                      <td>
                                          <?php
                                              $checked = ics_checkSelected($meta_arr['ics_auto_turnoff'], 1, 'checkbox');
                                          ?>
                                            <div class="onoffswitch">
                                                <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" onChange="check_and_h_num(this,'#ics_auto_turnoff');" <?php echo $checked;?>>
                                                <label class="onoffswitch-label" for="myonoffswitch">
                                                    <span class="onoffswitch-inner"></span>
                                                    <span class="onoffswitch-switch"></span>
                                                </label>
                                            </div>
											<div >
												<p style="font-style:italic; color:#666; margin: 10px 0; font-weight:bold;">When Time is out turn off.</p>
                                            </div>
											<input type="hidden" value="<?php echo $meta_arr['ics_auto_turnoff'];?>" name="ics_auto_turnoff" id="ics_auto_turnoff" />	
							          </td>
                                  </tr>
                              </tbody>
                          </table>
                          <div class="submit">
                              <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                          </div>                                
                      </div>
                  </div>
                                   
				  <div class="stuffbox"> 
                      <h3>
                          <label>CountDown Type:</label>
                      </h3>
                      <div class="inside">
                          <table class="ics-form-table indeed_admin_table" >
          	                <tbody>
                                  <tr>
                                      <td>
                                          <?php
                                              $checked = ics_checkSelected($meta_arr['ics_count_down_type'], 'digits', 'radio');
                                          ?>
                                          <input type="radio" value="digits" name="ics_count_down_type" <?php echo $checked;?>/> <strong>Digits</strong>
                                      </td>
                                  </tr>
                                  <tr>
                                      <td>
                                          <?php
                                              $checked = ics_checkSelected($meta_arr['ics_count_down_type'], 'circles', 'radio');
                                          ?>
                                          <input type="radio" value="circles" name="ics_count_down_type" <?php echo $checked;?>/> <strong>Circles</strong>
                                      </td>
                                  </tr>
                              </tbody>
                          </table>
                          <div class="submit">
                              <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                          </div>
                      </div>
                  </div>
                <div class="stuffbox">
                    <h3>
                        <label>Time Labels</label>
                    </h3>
                    <div class="inside">
                         <table class="ics-form-table indeed_admin_table" >
        	                <tbody>
                                <tr>
                                    <td>
                                    	Days:
                                    </td>
                                    <td>
                                    	<input type="text" value="<?php echo $meta_arr['ics_days_word'];?>" name="ics_days_word" id="ics_days_word" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	Day:
                                    </td>
                                    <td>
                                    	<input type="text" value="<?php echo $meta_arr['ics_day_word'];?>" name="ics_day_word" id="ics_day_word" />
                                    	<div style="font-style:italic; color:#666;font-size: 11px;display:inline-block;margin-left: 10px;">
											<p>Available only for Digits CountDown Type</p>
        								</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	Hours:
                                    </td>
                                    <td>
                                    	<input type="text" value="<?php echo $meta_arr['ics_hours_word'];?>" name="ics_hours_word" id="ics_hours_word" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	Hour:
                                    </td>
                                    <td>
                                    	<input type="text" value="<?php echo $meta_arr['ics_hour_word'];?>" name="ics_hour_word" id="ics_hour_word" />
                                    	<div style="font-style:italic; color:#666;font-size: 11px;display:inline-block;margin-left: 10px;">
											<p>Available only for Digits CountDown Type</p>
        								</div>
                                    </td>                                
                                </tr>
                                <tr>
                                    <td>
                                    	Minutes:
                                    </td>
                                    <td>
                                    	<input type="text" value="<?php echo $meta_arr['ics_minutes_word'];?>" name="ics_minutes_word" id="ics_minutes_word" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	Minute:
                                    </td>
                                    <td>
                                    	<input type="text" value="<?php echo $meta_arr['ics_minute_word'];?>" name="ics_minute_word" id="ics_minute_word" />
                                    	<div style="font-style:italic; color:#666;font-size: 11px;display:inline-block;margin-left: 10px;">
											<p>Available only for Digits CountDown Type</p>
        								</div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	Seconds:
                                    </td>
                                    <td>
                                    	<input type="text" value="<?php echo $meta_arr['ics_seconds_word'];?>" name="ics_seconds_word" id="ics_seconds_word" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                    	Second:
                                    </td>
                                    <td>
                                    	<input type="text" value="<?php echo $meta_arr['ics_second_word'];?>" name="ics_second_word" id="ics_second_word" />
                                    	<div style="font-style:italic; color:#666;font-size: 11px;display:inline-block;margin-left: 10px;">
											<p>Available only for Digits CountDown Type</p>
        								</div>
                                    </td>
                                </tr>                                  
                             </tbody>
                           </table> 
                        <div class="submit">
                            <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                        </div>                 
                    </div>
                </div>
              </form>
          </div>
        <?php
        break;

        case "content":
            if(isset($_REQUEST['ics_submit_bttn'])) ics_return_arr_update('content');
            $meta_arr = ics_return_arr_val('content');
?>
<div class="metabox-holder ics-indeed">
    <form method="post" action="">
        <div class="stuffbox">
            <h3>
                <label>Logo</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <th>
                                Image
                            </th>
                            <td>
                                <input type="text" value="<?php echo $meta_arr['ics_logo'];?>" name="ics_logo" onClick="open_media_up(this);" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                Height
                            </th>
                            <td>
                                <input type="number" value="<?php echo $meta_arr['ics_logo_height'];?>" name="ics_logo_height" min="0" max="200"/> px
                            </td>
                        </tr>
						<tr>
                            <td colspan="2" style="font-style:italic; color:#888;">
                               Max Height size allowed by the Coming Soon Layout is 200px. The recommended height size is 130px
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>Main Title</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <th scope="row">
                                Home Label:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_home_label']));?>" name="ics_home_label" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <div class="ics_space_btw"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Line 1:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_title_1']));?>" name="ics_title_1" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Line 2:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_title_2']));?>" name="ics_title_2" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Line 3:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_title_3']));?>" name="ics_title_3" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Subtitle:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_subtitle']));?>" name="ics_subtitle" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>Social Media Links</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <th scope="row">
                                Before Social Media Text:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_smb_text']));?>" name="ics_smb_text" class="indeed_large_input_text"/>
                            </td>
                        </tr>
						<tr>
						  <td colspan="2" style="padding-left: 20px;"><h4>Links</h4></td> 
						</tr>
						<?php 
							$sm_arr = array('ics_facebook'=>'Facebook', 
											'ics_twitter'=>'Twitter', 
											'ics_googleplus'=>'Google+', 
											'ics_linkedin'=>'Linkedin', 
											'ics_instagram'=>'Instagram', 
											'ics_pinterest'=>'Pinterest',
											'ics_youtube'=>'Youtube',
											'ics_vk'=>'VK',
											'ics_vimeo'=>'Vimeo',
											'ics_dribbble'=>'Dribbble');
							foreach($sm_arr as $k=>$value){
								?>
			                        <tr>
			                            <th scope="row" style="padding-left: 20px;">
			                                <?php echo $value?>:
			                            </th>
			                            <td>
			                                <input type="text" value="<?php echo $meta_arr[$k];?>" name="<?php echo $k;?>" class="indeed_large_input_text"/>
			                            </td>
			                        </tr>
			                    <?php 
								}//end foreach 
			                    ?>
                                                
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>Copyright Text</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_copyright']));?>" name="ics_copyright" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>"About" Page</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <th scope="row">
                                Enable:
                            </th>
                            <td>
                                <?php
                                    $checked = ics_checkSelected($meta_arr['ics_about_page_enable'], 1, 'checkbox');
                                ?>
                              <div class="onoffswitch_andtype">
                                  <input type="checkbox" name="onoffswitch_andtype" class="onoffswitch_andtype-checkbox" id="onoff_ics_about_page_enable" onChange="check_and_h_num(this,'#ics_about_page_enable');" <?php echo $checked;?>>
                                  <label class="onoffswitch_andtype-label" for="onoff_ics_about_page_enable">
                                      <span class="onoffswitch_andtype-inner">
                                          <span class="onoffswitch_andtype-active"><span class="onoffswitch_andtype-switch">ON</span></span>
                                          <span class="onoffswitch_andtype-inactive"><span class="onoffswitch_andtype-switch">OFF</span></span>
                                      </span>
                                  </label>
                              </div>
                            </td>
                            <input type="hidden" value="<?php echo $meta_arr['ics_about_page_enable'];?>" name="ics_about_page_enable" id="ics_about_page_enable" />
                        </tr>
                        <tr>
                            <th>
                                Menu Label
                            </th>
                            <td>
                                <input type="text" name="ics_about_label" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_about_label']));?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <div class="ics_space_btw"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Title:
                            </th>
                            <td>
                                 <input type="text" name="ics_about_title" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_about_title']));?>" class="indeed_large_input_text" style="margin-bottom: 25px;"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Content:
                            </th>
                            <td>
                                <?php
                                    $str = stripslashes($meta_arr['ics_about_text']);
                                    $editor_id = "ics_about_content";
                                    $settings = array("textarea_rows"=>4, "editor_class"=>"indeed_textarea_editor", "textarea_name"=>"ics_about_text");
                                    wp_editor($str, $editor_id, $settings );
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row" colspan="2" style="padding-left:20px;"><h4>
                                Icons:
								</h4>
                            </td>
						</tr>
						<tr>
						<th scope="row"></th>
                            <td>
                                <table>
                                    <?php
                                        $icons = array(
                                                        'fa-camera-ics' => array( "text" => $meta_arr['fa-camera-ics-text'],
                                                                              "enable_fa-camera-ics" => $meta_arr['fa-camera-ics-enable']),
                                                        'fa-bolt-ics' => array( "text" => $meta_arr['fa-bolt-ics-text'],
                                                                              "enable_fa-bolt-ics" => $meta_arr['fa-bolt-ics-enable']),
                                                        'fa-users-ics' => array( "text" => $meta_arr['fa-users-ics-text'],
                                                                              "enable_fa-users-ics" => $meta_arr['fa-users-ics-enable']),
                                                        'fa-circle-o-ics' => array( "text" => $meta_arr['fa-circle-o-ics-text'],
                                                                              "enable_fa-circle-o-ics" => $meta_arr['fa-circle-o-ics-enable']),
                                                        'fa-inbox-ics' => array( "text" => $meta_arr['fa-inbox-ics-text'],
                                                                              "enable_fa-inbox-ics" => $meta_arr['fa-inbox-ics-enable']),
                                                        'fa-desktop-ics' => array( "text" => $meta_arr['fa-desktop-ics-text'],
                                                                              "enable_fa-desktop-ics" => $meta_arr['fa-desktop-ics-enable']),
                                                      );
                                        foreach($icons as $k=>$v){
                                            $checked = ics_checkSelected($meta_arr[$k.'-enable'], 1, 'checkbox');
                                            ?>
                                              <tr>
                                                  <td>
                                                      <input type="checkbox" <?php echo $checked;?> onClick="check_and_h_num(this, '#h_<?php echo $k;?>');"  /><i class="fa-ics <?php echo $k;?> awe_icons"></i> <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr[$k.'-text']));?>" name="<?php echo $k;?>-text" />
                                                      <input type="hidden" value="<?php echo $meta_arr[$k.'-enable'];?>" name="<?php echo $k;?>-enable" id="h_<?php echo $k;?>" />
                                                  </td>
                                              </tr>
                                            <?php
                                        }
                                    ?>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>"Contact" Page</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <th scope="row">
                                Enable:
                            </th>
                            <td>
                                <?php
                                    $checked = ics_checkSelected($meta_arr['ics_contact_page_enable'], 1, 'checkbox');
                                ?>
                              <div class="onoffswitch_andtype">
                                  <input type="checkbox" name="onoffswitch_andtype" class="onoffswitch_andtype-checkbox" id="onoff_ics_contact_page_enable" onChange="check_and_h_num(this,'#ics_contact_page_enable');" <?php echo $checked;?>>
                                  <label class="onoffswitch_andtype-label" for="onoff_ics_contact_page_enable">
                                      <span class="onoffswitch_andtype-inner">
                                          <span class="onoffswitch_andtype-active"><span class="onoffswitch_andtype-switch">ON</span></span>
                                          <span class="onoffswitch_andtype-inactive"><span class="onoffswitch_andtype-switch">OFF</span></span>
                                      </span>
                                  </label>
                              </div>
                            </td>
                            <input type="hidden" value="<?php echo $meta_arr['ics_contact_page_enable'];?>" name="ics_contact_page_enable" id="ics_contact_page_enable" />
                        </tr>
                        <tr>
                            <th>
                                Menu Label
                            </th>
                            <td>
                                <input type="text" name="ics_contact_label" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_contact_label']));?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                 <div class="ics_space_btw"></div>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Title:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_contact_title']));?>" name="ics_contact_title" class="indeed_large_input_text" />
                            </td>
                        </tr>
						<tr>
						  <td colspan="2" style="padding-left: 20px;"><h4>Labels</h4></td> 
						</tr>
                        <tr>
                            <th scope="row" style="padding-left: 20px;">
                                Name Label:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_contact_name']));?>" name="ics_contact_name" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="padding-left: 20px;">
                                E-mail Label:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_contact_email']));?>" name="ics_contact_email" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="padding-left: 20px;">
                                Message Label:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_contact_message']));?>" name="ics_contact_message" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="padding-left: 20px;">
                                Submit:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_contact_submit']));?>" name="ics_contact_submit" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row" style="padding-left: 20px;">
                                Succes Message:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_contact_s_msg']));?>" name="ics_contact_s_msg" class="indeed_large_input_text" style="margin-bottom: 20px;"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <span class="ics-colored">Target E-mail:</span>
                            </th>
                            <td>
                                <input type="text" value="<?php echo $meta_arr['ics_target_email'];?>" name="ics_target_email" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>"More Info" PopUp</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <th scope="row">
                                Enable:
                            </th>
                            <td>
                                <?php
                                    $checked = ics_checkSelected($meta_arr['ics_enable_more_info'], 1, 'checkbox');
                                ?>
                              <div class="onoffswitch_andtype">
                                  <input type="checkbox" name="onoffswitch_andtype" class="onoffswitch_andtype-checkbox" id="onoff_ics_more_enable" onChange="check_and_h_num(this,'#ics_enable_more_info');" <?php echo $checked;?>>
                                  <label class="onoffswitch_andtype-label" for="onoff_ics_more_enable">
                                      <span class="onoffswitch_andtype-inner">
                                          <span class="onoffswitch_andtype-active"><span class="onoffswitch_andtype-switch">ON</span></span>
                                          <span class="onoffswitch_andtype-inactive"><span class="onoffswitch_andtype-switch">OFF</span></span>
                                      </span>
                                  </label>
                              </div>
                            </td>
                            <input type="hidden" value="<?php echo $meta_arr['ics_enable_more_info'];?>" name="ics_enable_more_info" id="ics_enable_more_info" />
                        </tr>
						<tr>
                            <th scope="row">
                                "Find out more":
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_more_info_text']));?>" name="ics_more_info_text" class="indeed_large_input_text"/>
                            </td>
                        </tr>
						<tr>
                            <th scope="row">
                                PopUp Title:
                            </th>
                            <td>
                                <input type="text" value="<?php echo htmlspecialchars(stripslashes($meta_arr['ics_title_more_info']));?>" name="ics_title_more_info" class="indeed_large_input_text"/>
                            </td>
                        </tr>                        
                        <tr>
                            <th scope="row">
                                Content:
                            </th>
                            <td>
                                 <?php
                                    $str = stripslashes($meta_arr['ics_more_info']);
                                    $editor_id = "ics_more_content";
                                    $settings = array("textarea_rows"=>4, "editor_class"=>"indeed_textarea_editor", "textarea_name" => "ics_more_info");
                                    wp_editor($str, $editor_id, $settings );
                                 ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
    </form>
</div>

<?php
        break;//end of content
        case "background":
            if(isset($_REQUEST['ics_submit_bttn'])) ics_return_arr_update('background');
            $meta_arr = ics_return_arr_val('background');
?>
<div class="metabox-holder ics-indeed">
    <form method="post" action="">
        <div class="stuffbox">
            <h3>
                <label>Background</label>
            </h3>
            <div class="inside">
				<div class="background-set-wrapper">
				  <div class="background-set-option">	
					<div class="ics-selection <?php isb_admin_check_selection($meta_arr['ics_bk_type'], 'solid_color', 'ics-selected');?>" id="solid_color">
						<?php  $checked = ics_checkSelected($meta_arr['ics_bk_type'], 'solid_color', 'radio'); ?>
                                <input type="radio" name="ics_bk_type" value="solid_color" <?php echo $checked;?> onClick="isc_select_bk_type_radio('#solid_color');" />
						Solid Color:		
					</div>
					<div class="ics-selection-content">
						<div class="ism-label">
							Color:
						</div>
						<div class="ism-inputs">
						<input type="text" id="ics_background_select" name="ics_color_bk" value="<?php echo $meta_arr['ics_color_bk'];?>"/>
										<script>
											jQuery('#ics_background_select').ColorPicker({
												onChange: function (hsb, hex, rgb) {
													jQuery('#ics_background_select').val('#' + hex);
												}
											});
										</script>
						</div>
						<div class="clear"></div>
					</div>
				  </div>	
				  
				  <div class="background-set-option">	
					<div class="ics-selection <?php isb_admin_check_selection($meta_arr['ics_bk_type'], 'single_image', 'ics-selected');?>" id="single_image">
						<?php $checked = ics_checkSelected($meta_arr['ics_bk_type'], 'single_image', 'radio'); ?>
                                <input type="radio" name="ics_bk_type" value="single_image" <?php echo $checked;?> onClick="isc_select_bk_type_radio('#single_image');" />
						Single Image:	
					</div>
					<div class="ics-selection-content">
						<div class="ism-label">
							Choose an Image:
						</div>
						<div class="ism-inputs">
						 	<input type="text" value="<?php echo $meta_arr['ics_background_img'];?>" name="ics_background_img" onClick="open_media_up(this);" class="indeed_large_input_text"/>
						</div>
						<div class="clear"></div>
					</div>
				  </div>
				  
				  <div class="background-set-option">	
					<div class="ics-selection <?php isb_admin_check_selection($meta_arr['ics_bk_type'], 'parallax', 'ics-selected');?>" id="parallax">
						 <?php $checked = ics_checkSelected($meta_arr['ics_bk_type'], 'parallax', 'radio');?>
                                <input type="radio" name="ics_bk_type" value="parallax" <?php echo $checked;?> onClick="isc_select_bk_type_radio('#parallax');" />
                                Parallax Image	
					</div>
					<div class="ics-selection-content">
						<div class="ism-label">
							Choose an Image:
						</div>
						<div class="ism-inputs">
						 	<input type="text" value="<?php echo $meta_arr['ics_parallax_image'];?>" name="ics_parallax_image" onClick="open_media_up(this);" class="indeed_large_input_text"/>
						</div>
						<div class="clear"></div>
					</div>
				  </div>
				  
				  <div class="background-set-option">	
					<div class="ics-selection <?php isb_admin_check_selection($meta_arr['ics_bk_type'], 'slides', 'ics-selected');?>" id="slides">
						  <?php $checked = ics_checkSelected($meta_arr['ics_bk_type'], 'slides', 'radio');?>
                                <input type="radio" name="ics_bk_type" value="slides" <?php echo $checked;?> onClick="isc_select_bk_type_radio('#slides');" />
                                SlideShow (normal)
					</div>
					<div class="ics-selection-content">
						<div class="ism-label">
							Manage Slides:
						</div>
						<div class="ism-inputs">
						 	 <ul id="sortable">
    									<?php
                                            if($meta_arr['ics_img_arr']!=''){
            									@$slides = (unserialize($meta_arr['ics_img_arr']));
            									if (is_array($slides)) {
            										foreach($slides as $k=>$v) {
            											echo '<li class="ui-state-default slider_li_t"><img onclick="jQuery(this).parent().remove();" class="close_slide_icon" src="'.ICS_DIR_URL.'files/images/close_2.png" ><input type="text" value="'.$v.'" class="slider-input indeed_large_input_text" name="ics_img_arr[]" onclick="open_media_up(this);" /></li>';
            										}
            									}
                                            }
    									?>
									</ul>
                                    <div id="add_row"><i class="icon-plus"></i> Slide</div>
						</div>
						<div class="clear"></div>
					</div>
				  </div>
				  
				  <div class="background-set-option">	
					<div class="ics-selection <?php isb_admin_check_selection($meta_arr['ics_bk_type'], 'slides_with_effect', 'ics-selected');?>" id="slides_with_effect">
						 <?php $checked = ics_checkSelected($meta_arr['ics_bk_type'], 'slides_with_effect', 'radio');?>
                                <input type="radio" name="ics_bk_type" value="slides_with_effect" <?php echo $checked;?> onClick="isc_select_bk_type_radio('#slides_with_effect');"/>
                                SlideShow (effects)
					</div>
					<div class="ics-selection-content">
						<div class="ism-label">
							Manage Slides:
						</div>
						<div class="ism-inputs">
						 	<ul id="sortable2">
    									<?php
                                            if($meta_arr['ics_img_arr_effect']!=''){
            									@$slides = (unserialize($meta_arr['ics_img_arr_effect']));
            									if (is_array($slides)) {
            										foreach($slides as $k=>$v) {
            											echo '<li class="ui-state-default slider_li_t"><img onclick="jQuery(this).parent().remove();" class="close_slide_icon" src="'.ICS_DIR_URL.'files/images/close_2.png" ><input type="text" value="'.$v.'" class="slider-input indeed_large_input_text" name="ics_img_arr_effect[]" onclick="open_media_up(this);" /></li>';
            										}
            									}
                                            }
    									?>
									</ul>
                                    <div id="add_row_2"><i class="icon-plus"></i> Slide</div>
						</div>
						<div class="clear"></div>
					</div>
				  </div>
				  
				  
				  <div class="background-set-option">	
					<div class="ics-selection <?php isb_admin_check_selection($meta_arr['ics_bk_type'], 'video', 'ics-selected');?>" id="video">
						  <?php  $checked = ics_checkSelected($meta_arr['ics_bk_type'], 'video', 'radio'); ?>
                                <input type="radio" name="ics_bk_type" value="video" <?php echo $checked;?> onClick="isc_select_bk_type_radio('#video');"/>
                                Video Background
					</div>
					<div class="ics-selection-content">
						<div class="ism-label">
							Add Youtube Video:
						</div>
						<div class="ism-inputs">
						 	 <div>
                                	<input type="text" value="<?php echo $meta_arr['ics_video_bk'];?>" name="ics_video_bk" class="indeed_large_input_text" /> <span class="ics_info">( Youtube Video ID )</span>
                                </div>
                                <div style="margin-top: 30px">
                                	<div style="display: inline-block;">
		                                  <?php
		                                  	   $checked = ics_checkSelected($meta_arr['ics_sound_on'], 1, 'checkbox');
		                                  ?>
			                              <div class="onoffswitch_andtype">
			                                  <input type="checkbox" name="onoffswitch_andtype" class="onoffswitch_andtype-checkbox" id="onoff_ics_about_page_enable" onChange="check_and_h_num(this,'#ics_sound_on');" <?php echo $checked;?>>
			                                  <label class="onoffswitch_andtype-label" for="onoff_ics_about_page_enable">
			                                      <span class="onoffswitch_andtype-inner">
			                                          <span class="onoffswitch_andtype-active"><span class="onoffswitch_andtype-switch">ON</span></span>
			                                          <span class="onoffswitch_andtype-inactive"><span class="onoffswitch_andtype-switch">OFF</span></span>
			                                      </span>
			                                  </label>
			                              </div>
										  <input type="hidden" value="<?php echo $meta_arr['ics_sound_on'];?>" name="ics_sound_on" id="ics_sound_on" />                                                                 
                                	</div> 
                                	<div style="display: inline-block;font-weight: 700;"> with Background Sound </div>
                                </div>  
								<div style="margin-top: 30px">
                                	<div style="display: inline-block;">
		                                  <?php
		                                  	   $checked = ics_checkSelected($meta_arr['ics_video_mobile'], 1, 'checkbox');
		                                  ?>
			                              <div class="onoffswitch_andtype">
			                                  <input type="checkbox" name="onoffswitch_andtype" class="onoffswitch_andtype-checkbox" id="onoff_ics_video_mobile" onChange="check_and_h_num(this,'#ics_video_mobile');" <?php echo $checked;?>>
			                                  <label class="onoffswitch_andtype-label" for="onoff_ics_video_mobile">
			                                      <span class="onoffswitch_andtype-inner">
			                                          <span class="onoffswitch_andtype-active"><span class="onoffswitch_andtype-switch">ON</span></span>
			                                          <span class="onoffswitch_andtype-inactive"><span class="onoffswitch_andtype-switch">OFF</span></span>
			                                      </span>
			                                  </label>
			                              </div>
										  <input type="hidden" value="<?php echo $meta_arr['ics_video_mobile'];?>" name="ics_video_mobile" id="ics_video_mobile" />                                                                 
                                	</div> 
                                	<div style="display: inline-block;font-weight: 700;"> Replace with Static Image on Mobile devices </div>
                                </div>
						</div>
						<div class="clear"></div>
					</div>
				  </div>
				  
				</div>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>Darkness</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <td>
                                <input type="number" name="ics_background_d" value="<?php echo $meta_arr['ics_background_d'];?>" step="0.01" min="0" max="1" style="min-width:120px;"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>Pattern</label>
            </h3>
            <div class="inside" style="margin-top:10px;">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <td>
							 <div style="display:inline-block;margin-right: 20px;">
							 <?php $checked = ics_checkSelected($meta_arr['ics_bk_pn'], 'none', 'radio'); $selected = ''; if($checked) $selected = "-selected";?>
                                  <input type="radio" name="ics_bk_pn" value="none" <?php echo $checked;?> style="display:inline-block; vertical-align:super;"/> 
								  <div class="ics-pattern<?php echo $selected;?>" style="background-color:#FFF; vertical-align:text-bottom;"> <span class="ics-colored" style=" font-weight:bold;vertical-align: sub;">None</span></div>
                              </div>
                            <?php
                              $patterns_dir = ICS_DIR_PATH . 'files/images/patterns' ;
                              if(is_readable($patterns_dir)){
                                  if ($handle = opendir( $patterns_dir )) {
                                      while (false !== (@$entry = readdir($handle))) {
                                          if(strpos($entry, '.')>1){
                                            @$patt_arr = explode('_', $entry);
                                            @$patt_arr = explode('.', $patt_arr[1]);
                                            if($patt_arr) $patterns[$patt_arr[0]] = $entry;
                                          }
                                      }
                                      ksort($patterns);
                                      foreach($patterns as $pattern){
                                              $checked = ics_checkSelected($meta_arr['ics_bk_pn'], $pattern, 'radio');
                                              $selected = ''; if($checked) $selected = "-selected";
                                            ?>
                                                <div style="display:inline-block;margin-right: 20px; margin-bottom:10px;">
                                                    <input type="radio" name="ics_bk_pn" value="<?php echo $pattern;?>" <?php echo $checked;?>  style="display:inline-block; vertical-align:super;"/>
        											<div class="ics-pattern<?php echo $selected;?>" style="background-image:url('<?php echo ICS_DIR_URL.'files/images/patterns/'.$pattern;?>');"></div>
                                                </div>
                                            <?php
                                      }
                                  }
                              }
                            ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
    </form>
</div>
        <?php
        break;

        case 'subscribe':
            if(isset($_REQUEST['ics_submit_bttn'])) ics_return_arr_update('subscribe');
            $meta_arr = ics_return_arr_val('subscribe');
        ?>
<div class="metabox-holder ics-indeed">
    <form method="post" action="">
        <div class="stuffbox">
            <h3>
                <label>Labels</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
					   <tr>
                            <th scope="row">
                                Enable:
                            </th>
                            <td>
                                <?php
                                    $checked = ics_checkSelected($meta_arr['ics_enable_subscribe'], 1, 'checkbox');
                                ?>
                              <div class="onoffswitch_andtype">
                                  <input type="checkbox" name="onoffswitch_andtype" class="onoffswitch_andtype-checkbox" id="onoff_ics_enable_subscribe" onChange="check_and_h_num(this,'#ics_enable_subscribe');" <?php echo $checked;?>>
                                  <label class="onoffswitch_andtype-label" for="onoff_ics_enable_subscribe">
                                      <span class="onoffswitch_andtype-inner">
                                          <span class="onoffswitch_andtype-active"><span class="onoffswitch_andtype-switch">ON</span></span>
                                          <span class="onoffswitch_andtype-inactive"><span class="onoffswitch_andtype-switch">OFF</span></span>
                                      </span>
                                  </label>
                              </div>
                            </td>
                            <input type="hidden" value="<?php echo $meta_arr['ics_enable_subscribe'];?>" name="ics_enable_subscribe" id="ics_enable_subscribe" />
                        </tr>
						<tr>
                            <th scope="row">
                                <br/>
                            </th>
                            <td></td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Subscribe Text:
                            </th>
                            <td>
                                <input type="text" value="<?php echo $meta_arr['ics_subscribe_text'];?>" name="ics_subscribe_text" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Subscribe Label:
                            </th>
                            <td>
                                <input type="text" value="<?php echo $meta_arr['ics_subscribe_label'];?>" name="ics_subscribe_label" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Subscribe Button:
                            </th>
                            <td>
                                <input type="text" value="<?php echo $meta_arr['ics_subscribe_bttn'];?>" name="ics_subscribe_bttn" class="indeed_large_input_text"/>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                Subscribe Succes Message:
                            </th>
                             <td>
                                <input type="text" value="<?php echo $meta_arr['ics_subscribe_msg'];?>" name="ics_subscribe_msg" class="indeed_large_input_text"  style="margin-bottom:20px;"/>
                             </td>
                        </tr>
                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
        <div class="stuffbox">
            <h3>
                <label>Subscribe Type</label>
            </h3>
            <div class="inside">
                <table class="ics-form-table indeed_admin_table" >
	                <tbody>
                        <tr>
                            <th style="padding-top:5px;">
                                Subscribe Type
                            </th>
                            <td>
                                <select name="ics_subscribe_type" onChange="updateViewEmailS( this );">
                                    <?php
                                        $subscribe_types = array(
                                                                    'aweber' => 'AWeber',
                                                                    'campaign_monitor' => 'CampaignMonitor',
                                                                    'constant_contact' => 'Constant Contact',
                                                                    'email_list' => 'E-mail List',
                                                                    'get_response' => 'GetResponse',
                                                                    'icontact' => 'IContact',
                                                                    'madmimi' => 'Mad Mimi',
                                                                    'mailchimp' => 'MailChimp',
                                                                    'mymail' => 'MyMail',
                                                                    'wysija' => 'Wysija',
                                                                 );
                                        foreach($subscribe_types as $k=>$v){
                                            $selected = ics_checkSelected($meta_arr['ics_subscribe_type'], $k, 'select');
                                            ?>
                                                <option value="<?php echo $k;?>" <?php echo $selected;?> ><?php echo $v;?></option>
                                            <?php
                                        }
                                    ?>
                                </select>

                            </td>
                        </tr>
        <!-- aweber options -->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='aweber') $display = 'table-row';
                        ?>
                        <tr id="aweber_settings" style="display: <?php echo $display;?>">
                            <th>AWeber Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            Auth Code
                                        </td>
                                        <td>
                                            <textarea id="ics_auth_code" name="ics_aweber_auth_code" style="min-width: 375px;"><?php echo $meta_arr['ics_aweber_auth_code'];?></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="https://auth.aweber.com/1.0/oauth/authorize_app/751d27ee" target="_blank" class="indeed_info_link">Get Your Auth Code From Here</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Unique List ID:
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_aweber_list'];?>" name="ics_aweber_list" style="min-width: 375px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="https://www.aweber.com/users/settings/" target="_blank" class="indeed_info_link">Get Unique List ID</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div onClick="connect_aweber( '#ics_auth_code' );" class="button button-primary button-large">Connect</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

        <!--mailchimp option-->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='mailchimp') $display = 'table-row';
                        ?>
                        <tr id="mailchimp_settings" style="display: <?php echo $display;?>">
                            <th>Mailchimp Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            API Key
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_mailchimp_api'];?>" name="ics_mailchimp_api" style="min-width: 375px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank" class="indeed_info_link">Where can I find my API Key?</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            ID List
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_mailchimp_id_list'];?>" name="ics_mailchimp_id_list" style="min-width: 375px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="http://kb.mailchimp.com/article/how-can-i-find-my-list-id/" target="_blank" class="indeed_info_link">Where can I find List ID?</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

        <!-- get response options -->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='get_response') $display = 'table-row';
                        ?>
                        <tr id="get_response_settings" style="display: <?php echo $display;?>">
                            <th>GetResponse Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            GetResponse API Key
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_getResponse_api_key'];?>" name="ics_getResponse_api_key" style="min-width: 240px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="http://www.getresponse.com/learning-center/glossary/api-key.html" target="_blank" class="indeed_info_link">Where can I find my API Key?</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            GetResponse Campaign Token
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_getResponse_token'];?>" name="ics_getResponse_token" style="min-width: 240px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="https://app.getresponse.com/campaign_list.html " target="_blank" class="indeed_info_link">Where can I find Campaign Token?</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

        <!-- campaign monitor options -->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='campaign_monitor') $display = 'table-row';
                        ?>
                        <tr id="campaign_monitor_settings" style="display: <?php echo $display;?>">
                            <th>Campaign Monitor Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            CampaignMonitor API Key
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_cm_api_key'];?>" name="ics_cm_api_key" style="min-width: 270px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="https://www.campaignmonitor.com/api/getting-started/#apikey" target="_blank" class="indeed_info_link">Where can I find API Key ?</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            CampaignMonitor List ID
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_cm_list_id'];?>" name="ics_cm_list_id" style="min-width: 270px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="https://www.campaignmonitor.com/api/clients/#subscriber_lists" target="_blank" class="indeed_info_link">Where can I find List ID?</a>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

        <!-- icontact options -->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='icontact') $display = 'table-row';
                        ?>
                        <tr id="icontact_settings" style="display: <?php echo $display;?>">
                            <th>IContact Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            iContact Username
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_icontact_user'];?>" name="ics_icontact_user" style="min-width: 280px;"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            iContact App ID
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_icontact_appid'];?>" name="ics_icontact_appid" style="min-width: 280px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <a href="http://www.icontact.com/developerportal/documentation/register-your-app/" target="_blank" class="indeed_info_link">Where can I get my App ID?</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            iContact App Password
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_icontact_pass'];?>" name="ics_icontact_pass" style="min-width: 280px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            iContact List ID
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_icontact_list_id'];?>" name="ics_icontact_list_id" style="min-width: 280px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div>
                                                <a href="https://app.icontact.com/icp/core/mycontacts/lists" target="_blank" class="indeed_info_link">Click on the list name:</a>
                                            </div>
                                            <div>
                                                Click on the list name and get the ID from the URL (ex:  https://app.icontact.com/icp/core/mycontacts/lists/edit/<b>ID_LIST</b>/?token=f155cba025333b071d49974c96ae0894 )
                                            </div>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

        <!-- constant_contact options -->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='constant_contact') {$display = 'table-row'; $cc_lists = ics_return_cc_list($meta_arr['ics_cc_user'],$meta_arr['ics_cc_pass']);}
                        ?>
                        <tr id="constant_contact_settings" style="display: <?php echo $display;?>">
						
                            <th>Constant Contact Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            Constant Contact Username
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_cc_user'];?>" id="ics_cc_user" name="ics_cc_user" style="min-width: 260px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Constant Contact Password
                                        </td>
                                        <td>
                                            <input type="password" value="<?php echo $meta_arr['ics_cc_pass'];?>" id="ics_cc_pass" name="ics_cc_pass" style="min-width: 260px;" />
                                        </td>
                                    </tr>
									<tr>
                                        <td></td>
                                        <td>
                                            <div onClick="get_cc_list( '#ics_cc_user', '#ics_cc_pass' );" class="button button-primary button-large">Get Lists</div>
                                        </td>
                                    </tr>
									<tr>
                                        <td>
                                            Constant Contact List
                                        </td>
                                        <td>
										<select id="ics_cc_list" name="ics_cc_list" style="min-width: 260px;" >
										<?php if(count($cc_lists) > 0){
											foreach($cc_lists as $key => $value){
												$selected = '';
												if($meta_arr['ics_cc_list'] == $key) $selected = "selected";
											 		echo '<option value="'.$key.'" '.$selected.'>'.$value['name'].'</option>';
											 }
											}
                                         ?>   
											</select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>



        <!-- wysija options -->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='wysija') $display = 'table-row';
                        ?>
                        <tr id="wysija_settings" style="display: <?php echo $display;?>">
                            <th>Wysija Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            Select Wysija List:
                                        </td>
                                        <td>
                                            <?php
                                                $obj = new IndeedMailServices();
                                                $wysija_list = $obj->indeed_returnWysijaList();
                                                if($wysija_list){
                                                    ?>
                                                        <select name="ics_wysija_list_id">
                                                            <?php
                                                                foreach($wysija_list as $k=>$v){
                                                                    $selected = ics_checkSelected( $meta_arr['ics_wysija_list_id'], $k, 'select' );
                                                                    ?>
                                                                      <option value="<?php echo $k;?>" <?php echo $selected;?> ><?php echo $v;?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    <?php
                                                }else echo "No List available <input type='hidden' name='ics_wysija_list_id' value=''/> ";
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

        <!-- myMail options -->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='mymail') $display = 'table-row';
                        ?>
                        <tr id="mymail_settings" style="display: <?php echo $display;?>">
                            <th>MyMail Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            Select MyMail List:
                                        </td>
                                        <td>
                                            <?php
                                                $mymailList = $obj->indeed_getMyMailLists();
                                                if($mymailList){
                                                    ?>
                                                        <select name="ics_mymail_list_id">
                                                            <?php
                                                                foreach($mymailList as $k=>$v){
                                                                    $selected = ics_checkSelected( $meta_arr['ics_mymail_list_id'], $k, 'select' );
                                                                    ?>
                                                                      <option value="<?php echo $k;?>" <?php echo $selected;?> ><?php echo $v;?></option>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    <?php
                                                }else echo "No List available <input type='hidden' name='ics_mymail_list_id' value=''/> ";
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

        <!-- myMail options -->
                        <?php
                            $display = 'none';
                            if($meta_arr['ics_subscribe_type']=='madmimi') $display = 'table-row';
                        ?>
                        <tr id="madmimi_settings" style="display: <?php echo $display;?>">
                            <th>MyMail Settings</th>
                            <td>
                                <table>
                                    <tr>
                                        <td>
                                            MyMail Username Or Email:
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_madmimi_username'];?>" name="ics_madmimi_username" style="min-width: 260px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            MyMail Api Key:
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_madmimi_apikey'];?>" name="ics_madmimi_apikey" style="min-width: 260px;" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            MyMail List Name:
                                        </td>
                                        <td>
                                            <input type="text" value="<?php echo $meta_arr['ics_madmimi_listname'];?>" name="ics_madmimi_listname" style="min-width: 260px;" />
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

        <!-- email list -->
                        <tr>
                            <th>
                                <span class="ics-colored">Saved E-mail List</span>
                            </th>
                            <td>
                                <?php
                                    @$email_list = get_option('ics_email_list');
                                ?>
                                <textarea disabled style="width: 450px;height: 100px;"><?php echo $email_list;?></textarea>
                            </td>
                        </tr>



                    </tbody>
                </table>
                <div class="submit">
                    <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
                </div>
            </div>
        </div>
    </form>
</div>
        <?php
        break;
		case 'help':
		?>
			<div class="metabox-holder ics-indeed">
				<div class="stuffbox">
					  <h3>
					    <label style="text-transform: uppercase; font-size:16px;">
					      Contact Support
					    </label>
					  </h3>
					  <div class="inside">
					  	  <div class="submit" style="float:left; width:80%;">
						  In order to contact Indeed support team you need to create a ticket providing all the necessary details via our support system: support.wpindeed.com
						  </div>
						  <div class="submit" style="float:left; width:20%; text-align:center;">
						  		<a href="http://support.wpindeed.com/open.php?topicId=13" target="_blank" class="button button-primary button-large"> Submit Ticket</a>
						  </div>
						  <div class="clear"></div>
					  </div>
				</div>
		<div class="stuffbox">
		  <h3>
		    <label style="text-transform: uppercase; font-size:16px;">
		      Documentation
		    </label>
		  </h3>
		  <div class="inside">
		  	  <iframe src="http://demoics.wpindeed.com/documentation/" width="100%" height="1000px" ></iframe>
		  </div>
		</div>	
			</div>
		<?php 
	break;
	
	case 'security':
		if (!empty($_REQUEST['ics_submit_bttn'])){
			ics_return_arr_update('security');
		}
		$meta_arr = ics_return_arr_val('security');
		?>
		
		        <div class="metabox-holder ics-indeed">
		            <form method="post" action="">
		                <div class="stuffbox">
		                    <h3>
		                        <label>WP Roles</label>
		                    </h3>
		                    <div class="inside">
							<h2>Website Access</h2>
							<p>Set which User can see the website instead of the main Coming Soon page based on his WP Role.</p>
		                        <table class="ics-form-table indeed_admin_table" style="margin-top:20px;" >
		        	                <tbody>
		                                <tr>
		                                    <td>
			                                    <div style="width: 49%; vertical-align: top; display: inline-block;">
			                                    
				                                    <div style="opacity: 0.7;">
														<span style="font-weight:bold; display:inline-block; width: 30%; vertical-align: top;">Administrator</span>
							                              <div class="onoffswitch_andtype" style="display:inline-block;">
							                                  <input type="checkbox" name="onoffswitch_andtype" class="onoffswitch_andtype-checkbox" checked disabled>
							                                  <label class="onoffswitch_andtype-label" for="onoff_ics_contact_page_enable">
							                                      <span class="onoffswitch_andtype-inner">
							                                          <span class="onoffswitch_andtype-active"><span class="onoffswitch_andtype-switch">ON</span></span>
							                                          <span class="onoffswitch_andtype-inactive"><span class="onoffswitch_andtype-switch">OFF</span></span>
							                                      </span>
							                                  </label>
							                              </div>	
													</div>	
													
												<?php 
													//$meta_arr['ics_wp_roles']
													if (!empty($meta_arr['ics_wp_roles'])){
														$ics_wp_roles = explode(',', $meta_arr['ics_wp_roles']);	
													} else {
														$ics_wp_roles = array();
													}													
													$roles = get_editable_roles();
													if (!empty($roles['administrator'])){
														unset($roles['administrator']);
													}																
													$count = count($roles) + 1;
													$break = ceil($count/2);
													$i = 1;
													foreach ($roles as $role=>$arr){
														$checked = (in_array($role, $ics_wp_roles)) ? 'checked' : '';														
														?>
														<div>
															<span style="font-weight:bold; display:inline-block; width: 30%; vertical-align: top;"><?php echo $arr['name'];?></span>
								                              <div class="onoffswitch_andtype" style="display:inline-block;">
								                                  <input type="checkbox" name="onoffswitch_andtype" class="onoffswitch_andtype-checkbox" id="<?php echo $role;?>_checkbox" onChange="ics_make_inputh_string(this, '<?php echo $role;?>', '#ics_wp_roles');" <?php echo $checked;?>>
								                                  <label class="onoffswitch_andtype-label" for="<?php echo $role;?>_checkbox">
								                                      <span class="onoffswitch_andtype-inner">
								                                          <span class="onoffswitch_andtype-active"><span class="onoffswitch_andtype-switch">ON</span></span>
								                                          <span class="onoffswitch_andtype-inactive"><span class="onoffswitch_andtype-switch">OFF</span></span>
								                                      </span>
								                                  </label>
								                              </div>														
														</div>																		
														<?php 	
														$i++;
														if ($count>7 && $i==$break){
															?>
																</div>
																<div style="width: 49%; vertical-align: top; display: inline-block;">	
															<?php 	
														}
													}
												?>		  
												</div>   
												<input type="hidden" value="<?php echo $meta_arr['ics_wp_roles'];?>" name="ics_wp_roles" id="ics_wp_roles" />                               
											</td>
		                                </tr>
		                            </tbody>
		                        </table>
		                        <div class="submit">
		                            <input type="submit" value="Save changes" name="ics_submit_bttn" class="button button-primary button-large" />
		                        </div>
		                    </div>
		                </div>
		           </form>
		       </div>
		       
		       <?php 
		       		if (!empty($_POST['add_new'])){
		       			if ($_POST['ihc_visible_url_type']=='url'){
		       				$data_key = 'ics_visible_urls';	
		       			} else {
		       				$data_key = 'ics_visible_urls_keywords';
		       			}
		       			$data = get_option($data_key);
		       			if ($data && is_array($data)){
		       				if (!in_array($_REQUEST['ics_visible_url'], $data)){
		       					$data[] = $_REQUEST['ics_visible_url'];
		       				}		       				
		       			} else {
		       				$data[] = $_REQUEST['ics_visible_url'];
		       			}
		       			update_option($data_key, $data);
		       		}		       		
		       ?>
		        <div class="metabox-holder ics-indeed">
		            <form method="post" action="">
		                <div class="stuffbox">
		                    <h3>
		                        <label>Visible URLs - Add New</label>
		                    </h3>
		                    <div class="inside">
							<p>Provide access on certain Page or couple of pages for your regular visitors which are not logged. On default settings, all Pages are restricted.</p>
		                    	<div style="margin-bottom:20px; margin-top:10px;">
		                    		<div style="font-weight:bold;">URL identify based on: </div>
		                    		<select name="ihc_visible_url_type">
		                    			<option value="url">Full Path</option>
		                    			<option value="keyword">Keyword</option>
		                    		</select>
		                    	</div>
		                    	<div><div style="font-weight:bold;">URL Path/Keyword: </div> <input type="text" name="ics_visible_url" style="min-width: 600px;"/></div>
		                        <div class="submit">
		                            <input type="submit" value="Save" name="add_new" class="button button-primary button-large" />
		                        </div>		                    
		                    </div>
		                </div>
		            </form>
		        </div>	
		        
		        <?php 
		        $data_url = get_option('ics_visible_urls');
		        $data_keyword = get_option('ics_visible_urls_keywords');
		        if ((!empty($data_url) && is_array($data_url)) || (!empty($data_keyword) && is_array($data_keyword))){
		        ?>
			        	<div class="metabox-holder ics-indeed">
			                <div class="stuffbox">
			                    <h3>
			                        <label>Visible URLs - List</label>
			                    </h3>
			                    <div class="inside">
			                    	<?php 
										if (!empty($data_url) && is_array($data_url)){
									?>
			                    	<table class="wp-list-table widefat fixed tags">
										<thead>
											<tr>
												<th>URL Path</th>
												<th width="100px">Delete</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($data_url as $i=>$value){
													?>
													<tr id="ics_visible_url_<?php echo $i;?>">
														<td><?php echo $value;?></td>
														<td style="text-align:center;"><i class="fa-ics fa-delete-ics" onClick="ics_remove_visible_link('<?php echo $value;?>', 'url', <?php echo $i;?>);"></i></td>
													</tr>												
													<?php 	
												}
											?>
										</tbody>
									</table> 
								<?php 				
									}				
								?>                
			                    </div>
			                    <div class="inside">
			                    	<?php 
			                    		
										if (!empty($data_keyword) && is_array($data_keyword)){
									?>
			                    	<table class="wp-list-table widefat fixed tags">
										<thead>
											<tr>
												<th>Keyword</th>
												<th width="100px">Delete</th>
											</tr>
										</thead>
										<tbody>
											<?php 
												foreach ($data_keyword as $i=>$value){
													?>
													<tr id="ics_visible_keyword_<?php echo $i;?>">
														<td><?php echo $value;?></td>
														<td style="text-align:center;"><i class="fa-ics fa-delete-ics" onClick="ics_remove_visible_link('<?php echo $value;?>', 'keyword', <?php echo $i;?>);"></i></td>
													</tr>												
													<?php 	
												}
											?>
										</tbody>
									</table> 
								<?php 				
									}				
								?>                
			                    </div>			                    
			                </div>
			      		</div>					      
		<?php 
			}
		break;
}//end of switch
?>
</div>
<?php require ICS_DIR_PATH . 'includes/views/header_1.php';?>
    <div class="wrap">
        <div class="container-full">
        <div class="special-overlay"></div>
        <?php if($meta_arr['ics_bk_type']=='parallax'){?>
	        		<div class="ism-parallax" data-parallaxify-range-x="80" data-parallaxify-range-y="80"></div>
	    <?php }
	        ics_return_video_controllers($meta_arr);
        ?>
		<link href='http://fonts.googleapis.com/css?family=Poiret+One' rel='stylesheet' type='text/css'>
            <div class="row">
                <header role="banner">
                    <div class="col-xs-12">
                        <a href="javascript:void(0)" class="site-logo">
                            <?php if($meta_arr['ics_logo']!=''){ ?><img src="<?php echo $meta_arr['ics_logo'];?>" alt="Logo"  style="max-height: <?php echo $meta_arr['ics_logo_height'];?>px;" class="img-responsive" /><?php } ?>
                        </a><!-- /.site-logo -->
                    </div>
                    <div class="col-xs-12">
                        <div class="nav-container">
                            <div class="nav-toggle"><i class="fa-ics fa-bars-ics"></i></div>
                            <nav role="navigation">
                                <ul role="menu">
                                	<?php $i= 0;?>
                                    <?php if($meta_arr['ics_about_page_enable']==1 || $meta_arr['ics_contact_page_enable']==1){?>
                                            <li><a href="javascript:void(0)" class="active" id="a_menu_<?php echo $i;?>"><?php echo stripslashes($meta_arr['ics_home_label']);?></a>  </li>
                                    <?php $i++;} ?>
                                    <?php if($meta_arr['ics_about_page_enable']==1){ ?>
                                            <li> <a href="javascript:void(0)" id="a_menu_<?php echo $i;?>" ><?php echo stripslashes($meta_arr['ics_about_label']);?></a></li>
                                    <?php $i++;} ?>
                                    <?php if($meta_arr['ics_contact_page_enable']==1){ ?>
                                            <li><a href="javascript:void(0)" id="a_menu_<?php echo $i;?>"><?php echo stripslashes($meta_arr['ics_contact_label']);?></a> </li>
                                    <?php } ?>
                                </ul>
                            </nav>
                        </div><!-- /.nav-container -->
                    </div>
                </header>
                <div class="clearfix"></div>
            </div>
            <div class="content-holder">
                <main role="main" class="clearfix">
                    <div class="row">
                        <div class="col-md-7 col-lg-7 top-lines">
						
						 <div class="page-panels">
                            <!-- Home panel starts -->
                            <section class="pnl-1" style="display:block;">
                            <div style="text-align:center;">
                            <div class="tag-line">
                                <h1 class="hm-1"><?php echo stripslashes($meta_arr['ics_title_1']);?> <span class="zoomed"><?php echo stripslashes($meta_arr['ics_title_2']);?></span></h1>                              
                                <h2 class="hm-2"><?php echo stripslashes($meta_arr['ics_title_3']);?></h2>
                                <h3 class="hm-4"><?php echo stripslashes($meta_arr['ics_subtitle']);?></h3>
                            </div><!-- /.tag-line -->
                       
                       
                            <!-- Home panel ends -->
							</div>
                            </section>	
							<?php
							if($meta_arr['ics_about_page_enable']==1){
							?>
                            <!-- Company panel starts -->
                            <section class="pnl-2">
                                <div class="col-offset">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h3><?php echo $meta_arr['ics_about_title'];?></h3>
                                    </div>
                                    <p><?php echo htmlspecialchars_decode(stripslashes($meta_arr['ics_about_text']));?></p>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div id="owl-slider" class="owl-carousel">
                                            <?php
                                                $icons = array( 'fa-camera-ics',
                                                                'fa-bolt-ics',
                                                                'fa-users-ics',
                                                                'fa-circle-o-ics',
                                                                'fa-inbox-ics',
                                                                'fa-desktop-ics'
                                                                );
                                                foreach($icons as $icon){
                                                    if($meta_arr[$icon.'-enable']==1){
                                                      ?>
                                                     <div class="item">
                                                        <div class="slider-icon-container"><i class="fa-ics <?php echo $icon;?>"></i></div>
                                                        <p><?php echo stripslashes($meta_arr[$icon.'-text']);?></p>
                                                     </div>
                                                      <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </section>
                            <!-- Company panel ends -->
							<?php
								}if($meta_arr['ics_contact_page_enable']==1){
								?>
                            <!-- Contact panel starts -->
                            <section class="pnl-3">
                                <div class="col-offset">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h3><?php echo stripslashes($meta_arr['ics_contact_title']);?></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <form method="post" action="" class="contact-form">
                                            <div class="col-md-6">
                                            <?php
                                                $placeholder = stripslashes($meta_arr['ics_contact_name']);
                                                if($placeholder!='') $placeholder .= ' *';
                                            ?>
                                                <input type="text" name="name" id="ics_name" placeholder="<?php echo $placeholder;?>" class="txt-name">
                                            <?php
                                                $placeholder = stripslashes($meta_arr['ics_contact_email']);
                                                if($placeholder!='') $placeholder .= ' *';
                                            ?>
                                                <input type="text" name="email" id="ics_contact-email" placeholder="<?php echo $placeholder;?>" class="txt-email">
                                            </div>
                                            <div class="col-md-6">
                                            <?php
                                                $placeholder = stripslashes($meta_arr['ics_contact_message']);
                                                if($placeholder!='') $placeholder .= ' *';
                                            ?>
                                                <textarea rows="4" name="message" cols="60" id="ics_message" placeholder="<?php echo $placeholder;?>" class="txt-message"></textarea>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="col-sm-6">
                                                <button id="contact-submit" class="btn-contact"><i class="fa-ics fa-envelope-o-ics"></i><?php echo stripslashes($meta_arr['ics_contact_submit']);?></button>
                                                <div class="contact-error-field"></div>
                                                <div class="contact-message"></div>
                                            </div>
                                        </form><!-- /.contact-form -->
                                    </div>
                                </div>
                            </section>
							<?php
								}
							?>
                            <!-- Contact panel ends -->
                        </div>
                    </div>
                    </div>
                </main>
            </div>
        </div>
			
	 <?php if($meta_arr['ics_enable_more_info']==1){ ?>
		<div class="more-utils">
		 <div class="row">
				<div class="col-md-7 col-lg-7 col-bordered utils-wrapper">
					<div class="util">
						<a class="call-at" data-toggle="modal" data-target="#myModal">
							<i class="fa-ics fa-bullhorn-ics"></i>
						</a>
						<span class="tooltip-show">
							<?php echo stripslashes($meta_arr['ics_more_info_text']);?>
							<span class="tooltip-arrow"></span>
						</span>
					</div>
				</div>
			</div>
		  </div>	
		       

                            <!-- Modal starts -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title">
                                            	<?php if (isset($meta_arr['ics_title_more_info'])):?>
                                            		<?php echo htmlspecialchars(stripslashes($meta_arr['ics_title_more_info']));?>
                                            	<?php else : ?>
                                            		More info
                                            	<?php endif;?>
                                            </h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>
                                                <?php echo htmlspecialchars_decode(stripslashes($meta_arr['ics_more_info']));?>
                                            </p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!-- Modal ends -->
		 <?php } ?>
		</div>
    </div>
<?php require ICS_DIR_PATH . 'includes/views/footer_1.php';?>    
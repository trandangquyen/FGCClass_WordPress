<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <title><?php echo $meta_arr['ics_meta_title'];?></title>

    <meta name="description" content="<?php echo $meta_arr['ics_meta_description'];?>" />
    <meta name="keywords" content="<?php echo $meta_arr['ics_meta_keywords'];?>" />
    <meta name="author" content="" />

    <!-- Mobile specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Apple Touch Icons -->
    <link rel="apple-touch-icon" sizes="144x144" href="images/icons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="images/icons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="images/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" href="images/icons/apple-touch-icon.png">

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo $meta_arr['ics_favicon'];?>">

    <!-- Google fonts -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic">

    <!-- Stylesheets -->
    <link href="<?php echo ICS_DIR_URL;?>files/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo ICS_DIR_URL;?>files/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo ICS_DIR_URL;?>files/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo ICS_DIR_URL;?>files/css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo ICS_DIR_URL;?>files/css/animate.css" rel="stylesheet">
    <link href="<?php echo ICS_DIR_URL;?>files/css/global.css" rel="stylesheet">
    <link href="<?php echo ICS_DIR_URL;?>files/css/ics_front_end.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    <style>
        <?php
            if($meta_arr['ics_bk_type']=='solid_color'){
                ?>

                    body{
                      background-color : <?php echo $meta_arr['ics_color_bk'];?> !important;
                    }

                 <?php
            }elseif($meta_arr['ics_bk_type']=='slides_with_effect'){
            ?>
                #supersized img{
                    -webkit-animation: spinBackground 100s linear infinite;
                    -moz-animation: spinBackground 100s linear infinite;
                    animation: spinBackground 100s linear infinite;
                }
            <?php
            }elseif($meta_arr['ics_bk_type']=='parallax'){
            	///PARALAX	
				?>
				.ism-parallax {
					left: -25%;
					top: -25%;
					overflow: hidden;
					margin: 0;
					padding: 0;
					z-index: -999999;
					position: fixed;
					width: 150%;
					height: 150%;
					background-image: url(<?php echo $meta_arr['ics_parallax_image'];?>);
					-webkit-background-size: cover;
					background-size: cover;
				}
            	<?php 
            }
        $overlay = 'background: rgba(0,0,0,'.$meta_arr['ics_background_d'].')';
        if(isset($meta_arr['ics_bk_pn']) && $meta_arr['ics_bk_pn']!='' && $meta_arr['ics_bk_pn']!='none') $overlay .= ' url('.ICS_DIR_URL.'files/images/patterns/'.$meta_arr['ics_bk_pn'].') repeat;';
        ?>
        .overlay{
            <?php echo $overlay;?>
        }
		.overlay-top-left, .overlay-top-right, .special-overlay{
			<?php echo $overlay;?>
		}
        <?php
            if(isset($meta_arr['ics_general_color']) && $meta_arr['ics_general_color']!='') echo ics_return_general_color( $meta_arr['ics_general_color'] );
        	
            // Social Media Style
            echo ics_sm_style_header($meta_arr);  
			
			if(isset($meta_arr['ics_custom_css']) && $meta_arr['ics_custom_css']!='')  
			   echo  $meta_arr['ics_custom_css'];      
        ?>
    </style>
    <script>
        var subscribe_msg = '<?php echo stripslashes($meta_arr['ics_subscribe_msg']);?>';
        var send_msg_succes = '<?php echo stripslashes($meta_arr['ics_contact_s_msg']);?>';
        var subscribe_type = '<?php echo $meta_arr['ics_subscribe_type'];?>';
        var mailchimp_api = '<?php echo $meta_arr['ics_mailchimp_api'];?>';
        var mailchimp_id_list = '<?php echo $meta_arr['ics_mailchimp_id_list'];?>';
        var nav_effect = '<?php echo $meta_arr['ics_change_page_effect'];?>';
    </script>
</head>
<body class="ics-layout-<?php echo $meta_arr['ics_layout'] ?>">

    <!-- Begin preloader -->
    <div id="preloader"><div id="status">
        <div id="circleG">
            <div id="circleG_1" class="circleG"></div>
            <div id="circleG_2" class="circleG"></div>
            <div id="circleG_3" class="circleG"></div>
        </div></div>
    </div>
    <!-- End preloader -->


    <div class="overlay"></div><!-- /.overlay -->
	<?php if($meta_arr['ics_layout'] == 2){?>
	<div class="overlay-top-left"></div>
	<div class="overlay-top-right"></div>
	<?php } ?>
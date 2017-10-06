<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php if(is_home()) bloginfo('name'); else wp_title(''); ?></title>
    <?php wp_head(); ?>

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,900italic,900,700italic,700,500italic,500,400italic' rel='stylesheet' type='text/css'>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->

    <meta name="viewport" content="width=device-width">
</head>
   
<body <?php body_class(); ?>>
   	<header class="container">	
	    <nav class="transparent" role="navigation">
			<?php wp_nav_menu(
				array(
			            'container'       => 'container',
			            'container_class' => 'right side-nav',
			            'container_id'    => 'slide-out',
			            'menu'			  => '',
			            'menu_class'      => '',
			            'menu_id'         => '',
			            'items_wrap' => '<ul id="slide-out" class="side-nav">%3$s</ul>'
			            )
	        	);
			?>
	    	<a href="#" data-activates="slide-out" class="button-collapse show-on-large">
	    		<i class="mdi-navigation-menu"></i>
	    	</a>
	    </nav>
			<a href="/">
				<img src="<?php bloginfo('template_url'); ?>/image/my-logo-done.png" alt="farry logo image" class="logo-img">
			</a>
    </header> 

        
     	
       

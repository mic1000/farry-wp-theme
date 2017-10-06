<?php
/*
 * 
 * Template name: archive
 * 
 */

get_header();

$post = get_post();
            
echo do_shortcode($post->post_content);

$recent_posts = wp_get_recent_posts();
?>

<div class="row">
    <div class="container text-center" style=" margin:1em auto; min-height:30em;  padding: 10em;">
    			<h1>404 - <i class="fa fa-truck" id="icon-large" aria-hidden="true"></i></h1>
    			<a href="/">hem</a>    

    </div>
</div>
<?php        
get_footer();
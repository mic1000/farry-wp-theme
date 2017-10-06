<?php get_header(); ?>
<div class="container about-wrapper">
  <div class="row">
      <div class="col l6 m6 s12">
          <img src="<?php bloginfo('template_url'); ?>/image/profile.png" alt="farry profile image" class="responsive-img"/>
      </div>
      <div class="col l6 m6 s12">
          <h5>ABOUT ME</h5>
          <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
     </div>
  </div>   
</div>

    
<?php get_footer(); ?>
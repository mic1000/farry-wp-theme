<?php get_header(); ?>
<div class="profile-body">
       <div class="container">
      <div class="row">
            <h4 class="title center">Portfolio</h4>
              <div class="col s12">                   
                <?php 
                    $teamArgs = array('post_type' => 'Portfolio','nopaging' => true );
                    $query = new WP_Query($teamArgs);
                    while ($query -> have_posts() ) : $query -> the_post(); 
                ?>
                <div class="col l4 m6 s12">
                    <div class="card medium">
                        <div class="card-image waves-effect waves-block waves-light">
                          <?php the_post_thumbnail( 'mediu' )  ; ?>
                        </div>
                        <div class="card-content">
                          <span class="card-title activator grey-text text-darken-4"><?php the_title();?><i class="material-icons right">more_vert</i></span>
                          <p><a href="<?php the_permalink() ?>">READ MORE</a></p>
                        </div>
                        <div class="card-reveal">
                          <span class="card-title grey-text text-darken-4"><?php the_title();?>
                            <i class="material-icons right">close</i>
                          </span>
                            <p class="project-description">
                                <?php echo(types_render_field("project-description", array("row" => true ) ));?>    
                            </p>
                        </div>
                    </div>
                </div>
                <?php endwhile;?>

            </div>
        </div>
    </div>
    </div>

<?php get_footer(); ?>
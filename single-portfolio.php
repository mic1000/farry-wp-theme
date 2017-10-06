<?php
/**
 * Template Name: single servce
 */

get_header(); ?>
	<section class="skills-body">
	<?php the_title( '<h3 class="center">', '</h3>' ); ?>
		<?php if( have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="container">
			<div class="row">
				<div class="col l12 m6 s12">
					<p class="center card-panel">
						<?php echo(types_render_field("project-description", array('raw' => true,'class' => 'center') ));?>
					</p>
				</div>
				<div class="col l12 m6 s12">
					<?php echo(types_render_field("project-images", 
							array( 'class' => 'responsive-img card-panel', 'separator' => '<br>') ));
					?>
				</div>
			</div>
		</div>
		<?php endwhile; endif; ?>
	</section><!-- col-md-10 -->	
	<div class="load-img">
		<div class=" holder-img"></div>
	</div>

<?php get_footer(); ?>
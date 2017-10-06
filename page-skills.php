<?php get_header(); ?>
<div class="skills-body">
	<div class="container">
		<div class="row">
		<div class="experience-wrapper">
			<!-- Tools block -->
			<div class="col s12 m6 l6 ">
				<h4 class="text-grey darken-3">Tools</h4>
				<?php
					$args = array('post_type' => 'skill-done','order'   => 'ASC');
					$query = new WP_Query($args);
					while($query -> have_posts()) : $query -> the_post();
				?>
					<div class="tool-block">
						<i class="<?php echo(types_render_field( "icon-tool", array( 'raw' => true) )); ?> icon"></i>
						<span class="title"><?php echo(types_render_field( "tool-name", array( 'raw' => false) )); ?></span>
					</div>
				<?php endwhile; ?>	
			</div>

			<!-- Achivement block -->
			<div class="col s12 m6 l6 ">
				<h4 class="text-grey darken-3">Achivement</h4>
				<?php
					$args = array('post_type' => 'achievement');
					$query = new WP_Query($args);
					while($query -> have_posts()) : $query -> the_post();
				?>	
				<div class="tool-block">
						<i class="<?php echo(types_render_field( "achievements-icon", array( 'raw' => true) )); ?> icon"></i>
						<span class="title"><?php echo(types_render_field( "achievements-title", array( 'raw' => false) )); ?></span>
				</div>
				<?php endwhile; ?>	
			</div>
		</div>

		<!-- Education block -->

			<div class="row">
			<div class="experience-wrapper">
				<div class="col s12 m6 l6 ">
					<h4 class="text-grey darken-3">Education</h4>
					<?php
						$args = array('post_type' => 'education','order'   => 'ASC');
						$query = new WP_Query($args);
						while($query -> have_posts()) : $query -> the_post();
					?>	
					<div class="education-block">
						<div class="school-single-entry">
							<i class="mdi-image-crop-square square"></i>
							<span class="date-title">
								<?php the_title(); ?>
							</span>
							<h6><?php echo(types_render_field('school-name', array())); ?></h6>
							<div class="col m12 right">
								* <?php echo(types_render_field('education-lessons', array('separator'=>'</br> * '))); ?>
							</div>	
							</div>
					</div>
					<?php endwhile; ?>		
				</div>


		<!-- EXPERIENCE block -->

				<div class="col s12 m6 l6 ">
					<h4 class="text-grey darken-3">EXPERIENCE</h4>
					<?php
						$args = array('post_type' => 'experience','order'   => 'ASC');
						$query = new WP_Query($args);
						while($query -> have_posts()) : $query -> the_post();
					?>
					<div class="education-block">
						<div class="school-single-entry">
							<i class="mdi-image-crop-square square"></i>
							<span class="date-title">
								<?php the_title(); ?>	
							</span>
							<h6><?php echo(types_render_field('experience-title', array())); ?></h6>
							<div class="col m12 right">
								* <?php echo(types_render_field('experiences', array('separator'=>'</br> * '))); ?>
							</div>
						</div>
					</div>
					<?php endwhile; ?>	
				</div>
			</div>
		</div>
	</div>
</div>
</div>
    
<?php get_footer(); ?>
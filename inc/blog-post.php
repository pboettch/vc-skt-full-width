<?php
/*
	Template Name: Blog
 */

get_header(); ?>

	<div id="primary" class="content-area">
    	 <div id="content" class="site-content container">
		<main id="main" class="site-main" role="main">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        		<header>
                		<h1 class="entry-title"><?php the_title(); ?></h1>
                </header>
        	<?php endwhile; else: endif; ?>
        		<div class="blog-post">

					<?php query_posts("cat=0"); ?>
                    <?php if( have_posts() ) : while( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>

			<?php skt_full_width_pagination(); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'index' ); ?>

		<?php endif; ?>
			</div><!-- blog-post --><?php get_sidebar(); ?><div class="clear"></div>
		</main><!-- main -->


<?php get_footer(); ?>
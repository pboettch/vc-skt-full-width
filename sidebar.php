<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package SKT Full Width
 */
?>
<div id="sidebar">
    <div class="recent-post">
    	<h1 class="widget-title">Recent Posts</h1>
		<?php $the_query = new WP_Query( 'posts_per_page=2' ); ?>
        <?php if( $the_query->have_posts() ) : while( $the_query->have_posts() ) : $the_query->the_post(); ?>
            <div class="post-box">
                <div class="thumb"><?php the_post_thumbnail(); ?></div><!-- thumb -->
                <div class="post-text">
					<?php
                    $excerpt = get_the_excerpt();
                    echo skt_full_width_string_limit_words($excerpt,7);
                    ?>
                    <div><a href="<?php the_permalink(); ?>">Read more..</a></div>
                </div><!-- post-text -->
            </div><!-- post-box -->
            <div class="clear"></div>
        <?php endwhile; else : endif; ?>
        <?php wp_reset_postdata(); ?>
    </div><!-- recent-post -->
    
	<?php do_action( 'before_sidebar' ); ?>

    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
        <aside id="archives" class="widget">
            <h1 class="widget-title"><?php _e( 'Archives', 'skt-full-width' ); ?></h1>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>
        <aside id="meta" class="widget">
            <h1 class="widget-title"><?php _e( 'Meta', 'skt-full-width' ); ?></h1>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>
    <?php endif; // end sidebar widget area ?>
	
</div><!-- sidebar -->
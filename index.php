<?php
/**
 * Fallback index template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">
	<div class="container section">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1><?php the_title(); ?></h1>
					<div><?php the_content(); ?></div>
				</article>
			<?php endwhile; ?>
		<?php else : ?>
			<p><?php esc_html_e( 'No content found.', 'excellence-school' ); ?></p>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>

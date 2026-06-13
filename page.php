<?php
/**
 * Generic page template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">
	<?php while ( have_posts() ) : the_post(); ?>
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				<?php if ( $post->post_parent ) : ?>
					&nbsp;/&nbsp;
					<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>"><?php echo esc_html( get_the_title( $post->post_parent ) ); ?></a>
				<?php endif; ?>
				&nbsp;/&nbsp;
				<span><?php the_title(); ?></span>
			</div>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<div class="container section">
		<div class="entry-content">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>

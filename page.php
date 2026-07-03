<?php
/**
 * Generic page template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">
	<?php
	while ( have_posts() ) :
		the_post();
		$title_hi   = get_post_meta( get_the_ID(), '_esb_title_hi', true );
		$content_hi = get_post_meta( get_the_ID(), '_esb_content_hi', true );
		?>
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				<?php if ( $post->post_parent ) : ?>
					&nbsp;/&nbsp;
					<a href="<?php echo esc_url( get_permalink( $post->post_parent ) ); ?>"><?php echo esc_html( get_the_title( $post->post_parent ) ); ?></a>
				<?php endif; ?>
				&nbsp;/&nbsp;
				<span><?php the_title(); ?></span>
			</div>
			<?php if ( $title_hi ) : ?>
				<h1 data-lang-show="en"><?php the_title(); ?></h1>
				<h1 data-lang-show="hi"><?php echo esc_html( $title_hi ); ?></h1>
			<?php else : ?>
				<h1><?php the_title(); ?></h1>
			<?php endif; ?>
		</div>
	</section>
	<div class="container section">
		<?php if ( $content_hi ) : ?>
			<div class="entry-content" data-lang-show="en"><?php the_content(); ?></div>
			<div class="entry-content" data-lang-show="hi"><?php echo apply_filters( 'the_content', $content_hi ); ?></div>
		<?php else : ?>
			<div class="entry-content"><?php the_content(); ?></div>
		<?php endif; ?>
	</div>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>

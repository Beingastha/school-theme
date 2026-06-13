<?php
/**
 * Template Name: Gallery
 *
 * Photo gallery page. Content (images, captions, layout) is managed
 * entirely from the block editor — add/edit a "Gallery" block on this
 * page in wp-admin to change the photos shown here.
 *
 * @package excellence-school
 */
get_header();
$estd = esb_opt( 'esb_estd', '1965' );
?>
<main id="main">
	<?php while ( have_posts() ) : the_post(); ?>

	<!-- Page Hero -->
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span data-en="Gallery" data-hi="गैलरी"><?php echo esc_html( get_the_title() ); ?></span>
			</div>
			<span class="eyebrow light" data-en="Estd. <?php echo esc_attr( $estd ); ?>" data-hi="स्थापना <?php echo esc_attr( $estd ); ?>">
				<?php echo esc_html( 'Estd. ' . $estd ); ?>
			</span>
			<h1 data-en="<?php echo esc_attr( get_the_title() ); ?>" data-hi="गैलरी">
				<?php the_title(); ?>
			</h1>
		</div>
	</section>

	<!-- Gallery Content (Gutenberg) -->
	<div class="container section">
		<div class="entry-content gallery-page-content">
			<?php the_content(); ?>
		</div>
	</div>

	<?php endwhile; ?>
</main>
<?php get_footer(); ?>

<?php
/**
 * Single Circular / Notice template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">
	<?php while ( have_posts() ) : the_post();
	$ref_no   = get_post_meta( get_the_ID(), '_esb_circular_no', true );
	$file_url = get_post_meta( get_the_ID(), '_esb_circular_file', true );
	?>
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<a href="<?php echo esc_url( home_url( '/circulars/' ) ); ?>"><?php esc_html_e( 'Circulars & Notices', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span><?php the_title(); ?></span>
			</div>
			<span class="eyebrow light">
				<?php echo esc_html( get_the_date() ); ?>
				<?php if ( $ref_no ) : ?>
					&nbsp;·&nbsp; <?php echo esc_html( $ref_no ); ?>
				<?php endif; ?>
			</span>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<div class="container section">
		<div class="entry-content" style="max-width:720px">
			<?php the_content(); ?>
			<?php if ( $file_url ) : ?>
			<p>
				<a class="btn btn-gold" href="<?php echo esc_url( $file_url ); ?>" target="_blank" rel="noopener noreferrer"
				   data-en="Download PDF" data-hi="पीडीएफ डाउनलोड करें">
					<?php esc_html_e( 'Download PDF', 'excellence-school' ); ?>
				</a>
			</p>
			<?php endif; ?>
		</div>
	</div>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>

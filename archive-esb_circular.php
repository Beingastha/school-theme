<?php
/**
 * Circulars & Notices archive template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span><?php esc_html_e( 'Circulars & Notices', 'excellence-school' ); ?></span>
			</div>
			<span class="eyebrow light" data-en="Circulars &amp; Notices" data-hi="परिपत्र व सूचनाएं"><?php esc_html_e( 'Circulars & Notices', 'excellence-school' ); ?></span>
			<h1 data-en="School Circulars &amp; Notices" data-hi="विद्यालय परिपत्र व सूचनाएं"><?php esc_html_e( 'School Circulars & Notices', 'excellence-school' ); ?></h1>
			<p data-en="Stay updated with the latest official notices, circulars and announcements from the school administration."
			   data-hi="विद्यालय प्रशासन की नवीनतम सूचनाओं, परिपत्रों व घोषणाओं से अपडेट रहें।">
				<?php esc_html_e( 'Stay updated with the latest official notices, circulars and announcements from the school administration.', 'excellence-school' ); ?>
			</p>
		</div>
	</section>
	<section class="section">
		<div class="container">
			<?php if ( have_posts() ) : ?>
			<div class="circular-list">
				<?php while ( have_posts() ) : the_post();
				$ref_no   = get_post_meta( get_the_ID(), '_esb_circular_no', true );
				$file_url = get_post_meta( get_the_ID(), '_esb_circular_file', true );
				$link_url = $file_url ? $file_url : get_permalink();
				?>
				<div class="circular-row reveal">
					<div class="cdate">
						<div class="m"><?php echo esc_html( get_the_date( 'M' ) ); ?></div>
						<div class="d"><?php echo esc_html( get_the_date( 'd' ) ); ?></div>
					</div>
					<div class="cbody">
						<h3><?php the_title(); ?></h3>
						<?php if ( $ref_no ) : ?>
						<div class="cref"><?php echo esc_html( $ref_no ); ?></div>
						<?php endif; ?>
					</div>
					<div class="cact">
						<a class="btn btn-outline" href="<?php echo esc_url( $link_url ); ?>"
						   <?php echo $file_url ? 'target="_blank" rel="noopener noreferrer"' : ''; ?>
						   data-en="<?php echo $file_url ? 'Download' : 'View'; ?>" data-hi="<?php echo $file_url ? 'डाउनलोड करें' : 'देखें'; ?>">
							<?php echo $file_url ? esc_html__( 'Download', 'excellence-school' ) : esc_html__( 'View', 'excellence-school' ); ?>
						</a>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
			<?php else : ?>
				<p data-en="No circulars or notices have been published yet." data-hi="अभी तक कोई परिपत्र या सूचना प्रकाशित नहीं की गई है।">
					<?php esc_html_e( 'No circulars or notices have been published yet.', 'excellence-school' ); ?>
				</p>
			<?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>

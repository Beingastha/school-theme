<?php
/**
 * Circulars & Notices section — pulls from esb_circular CPT
 *
 * @package excellence-school
 */
$query = new WP_Query( [
	'post_type'      => 'esb_circular',
	'posts_per_page' => 4,
	'orderby'        => 'date',
	'order'          => 'DESC',
] );

$static = [
	[ 'date_en' => '05 Jun 2026', 'title_en' => 'Summer Vacation Notice 2026', 'title_hi' => 'ग्रीष्मकालीन अवकाश सूचना 2026', 'ref' => 'SES/2026/021' ],
	[ 'date_en' => '28 May 2026', 'title_en' => 'Annual Sports Meet — Schedule', 'title_hi' => 'वार्षिक खेलकूद — समय सारणी', 'ref' => 'SES/2026/019' ],
	[ 'date_en' => '15 May 2026', 'title_en' => 'Admission Form Submission Deadline', 'title_hi' => 'प्रवेश फॉर्म जमा करने की अंतिम तिथि', 'ref' => 'SES/2026/017' ],
];
?>
<section class="section" id="circulars" style="background:var(--cream)">
	<div class="container">
		<div class="section-head reveal" style="display:flex;justify-content:space-between;align-items:flex-end;max-width:none;gap:24px;flex-wrap:wrap">
			<div style="max-width:620px">
				<span class="eyebrow" data-en="Circulars &amp; Notices" data-hi="परिपत्र व सूचनाएं">
					<?php esc_html_e( 'Circulars & Notices', 'excellence-school' ); ?>
				</span>
				<h2 data-en="Latest Updates from the School" data-hi="विद्यालय की नवीनतम सूचनाएं">
					<?php esc_html_e( 'Latest Updates from the School', 'excellence-school' ); ?>
				</h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/circulars/' ) ); ?>" class="btn btn-outline"
			   data-en="View All" data-hi="सभी देखें">
				<?php esc_html_e( 'View All', 'excellence-school' ); ?>
			</a>
		</div>
		<div class="circular-list">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post();
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
				<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( $static as $item ) : ?>
				<div class="circular-row reveal">
					<div class="cdate">
						<div class="m"><?php echo esc_html( substr( $item['date_en'], 3, 3 ) ); ?></div>
						<div class="d"><?php echo esc_html( substr( $item['date_en'], 0, 2 ) ); ?></div>
					</div>
					<div class="cbody">
						<h3 data-en="<?php echo esc_attr( $item['title_en'] ); ?>" data-hi="<?php echo esc_attr( $item['title_hi'] ); ?>">
							<?php echo esc_html( $item['title_en'] ); ?>
						</h3>
						<div class="cref"><?php echo esc_html( $item['ref'] ); ?></div>
					</div>
					<div class="cact">
						<a class="btn btn-outline" href="<?php echo esc_url( home_url( '/circulars/' ) ); ?>"
						   data-en="View" data-hi="देखें">
							<?php esc_html_e( 'View', 'excellence-school' ); ?>
						</a>
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
/**
 * Template Name: Staff
 *
 * Displays the school's teaching and non-teaching staff, grouped by
 * designation. Staff members are managed via the "Staff" custom post
 * type (Name = post title, photo = featured image, designation /
 * qualification via the Staff Details meta box, order = page order).
 *
 * @package excellence-school
 */
get_header();
$estd = esb_opt( 'esb_estd', '1965' );

$staff_query = new WP_Query(
	[
		'post_type'      => 'esb_staff',
		'posts_per_page' => -1,
		'orderby'        => 'menu_order',
		'order'          => 'ASC',
		'no_found_rows'  => true,
	]
);

$groups = [
	'lecturer' => [
		'en'    => 'Senior Secondary Faculty (Lecturers)',
		'hi'    => 'वरिष्ठ माध्यमिक संकाय (व्याख्याता)',
		'items' => [],
	],
	'pgt'      => [
		'en'    => 'Higher Secondary Faculty (PGT)',
		'hi'    => 'उच्चतर माध्यमिक संकाय (पीजीटी)',
		'items' => [],
	],
	'tgt'      => [
		'en'    => 'Secondary Faculty (TGT)',
		'hi'    => 'माध्यमिक संकाय (टीजीटी)',
		'items' => [],
	],
	'support'  => [
		'en'    => 'Administrative & Support Staff',
		'hi'    => 'प्रशासनिक एवं सहयोगी स्टाफ',
		'items' => [],
	],
];

if ( $staff_query->have_posts() ) {
	while ( $staff_query->have_posts() ) {
		$staff_query->the_post();
		$role       = get_post_meta( get_the_ID(), '_esb_staff_role', true );
		$role_upper = strtoupper( $role );

		if ( str_contains( $role_upper, 'TGT' ) ) {
			$key = 'tgt';
		} elseif ( str_contains( $role_upper, 'PGT' ) || str_contains( $role_upper, 'UMS' ) ) {
			$key = 'pgt';
		} elseif ( str_contains( $role_upper, 'LECTURER' ) ) {
			$key = 'lecturer';
		} else {
			$key = 'support';
		}

		$groups[ $key ]['items'][] = get_the_ID();
	}
	wp_reset_postdata();
}
?>
<main id="main">
	<?php while ( have_posts() ) : the_post(); ?>

	<!-- Page Hero -->
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<a href="<?php echo esc_url( esb_page_url( 'about' ) ); ?>" data-en="About" data-hi="परिचय"><?php esc_html_e( 'About', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span data-en="Staff" data-hi="स्टाफ"><?php echo esc_html( get_the_title() ); ?></span>
			</div>
			<span class="eyebrow light" data-en="Estd. <?php echo esc_attr( $estd ); ?>" data-hi="स्थापना <?php echo esc_attr( $estd ); ?>">
				<?php echo esc_html( 'Estd. ' . $estd ); ?>
			</span>
			<h1 data-en="<?php echo esc_attr( get_the_title() ); ?>" data-hi="हमारा स्टाफ">
				<?php the_title(); ?>
			</h1>
			<?php if ( get_the_content() ) : ?>
				<div class="entry-content" style="max-width:760px;color:rgba(255,255,255,.82)">
					<?php the_content(); ?>
				</div>
			<?php endif; ?>
		</div>
	</section>

	<?php foreach ( $groups as $group ) :
		if ( empty( $group['items'] ) ) {
			continue;
		}
		?>
		<div class="container section staff-section">
			<div class="section-head reveal">
				<span class="eyebrow" data-en="Faculty" data-hi="संकाय"><?php esc_html_e( 'Faculty', 'excellence-school' ); ?></span>
				<h2 data-en="<?php echo esc_attr( $group['en'] ); ?>" data-hi="<?php echo esc_attr( $group['hi'] ); ?>"><?php echo esc_html( $group['en'] ); ?></h2>
			</div>
			<div class="staff-grid stagger-grid">
				<?php foreach ( $group['items'] as $staff_id ) :
					$name    = get_the_title( $staff_id );
					$name_hi = get_post_meta( $staff_id, '_esb_staff_name_hi', true );
					$role    = get_post_meta( $staff_id, '_esb_staff_role', true );
					$role_hi = get_post_meta( $staff_id, '_esb_staff_role_hi', true );
					$qual    = get_post_meta( $staff_id, '_esb_staff_qualification', true );
					$qual_hi = get_post_meta( $staff_id, '_esb_staff_qualification_hi', true );
					?>
					<div class="card staff-card reveal">
						<?php esb_thumb( $staff_id, 'medium', esc_attr( $name ), 'staff-photo' ); ?>
						<div class="body">
							<h3<?php if ( $name_hi ) : ?> data-en="<?php echo esc_attr( $name ); ?>" data-hi="<?php echo esc_attr( $name_hi ); ?>"<?php endif; ?>><?php echo esc_html( $name ); ?></h3>
							<?php if ( $role ) : ?>
								<p class="role"<?php if ( $role_hi ) : ?> data-en="<?php echo esc_attr( $role ); ?>" data-hi="<?php echo esc_attr( $role_hi ); ?>"<?php endif; ?>><?php echo esc_html( $role ); ?></p>
							<?php endif; ?>
							<?php if ( $qual ) : ?>
								<p class="qual"<?php if ( $qual_hi ) : ?> data-en="<?php echo esc_attr( $qual ); ?>" data-hi="<?php echo esc_attr( $qual_hi ); ?>"<?php endif; ?>><?php echo esc_html( $qual ); ?></p>
							<?php endif; ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	<?php endforeach; ?>

	<?php endwhile; ?>
</main>
<?php get_footer(); ?>

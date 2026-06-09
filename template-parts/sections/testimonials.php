<?php
/**
 * Testimonials section — pulls from esb_testimonial CPT
 *
 * @package excellence-school
 */
$query = new WP_Query( [
	'post_type'      => 'esb_testimonial',
	'posts_per_page' => 3,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
] );

$static = [
	[
		'stars'   => 5,
		'quote'   => 'The science labs and the ATAL Tinkering Lab opened a whole new world of innovation for me. This school truly lived up to its name — Excellence.',
		'name'    => 'Ananya Sharma',
		'role'    => 'Student, Class XII Science',
		'initials'=> 'AS',
	],
	[
		'stars'   => 5,
		'quote'   => 'As a government school, the quality of education and facilities is remarkable. The hostel gives my son a safe, disciplined environment to study.',
		'name'    => 'Rajesh Kumar Verma',
		'role'    => 'Parent',
		'initials'=> 'RV',
	],
	[
		'stars'   => 5,
		'quote'   => 'The boxing training transformed my life. I represented the school at state level, and the discipline I learned here guides me every day.',
		'name'    => 'Priya Patel',
		'role'    => 'Alumni, Batch 2022',
		'initials'=> 'PP',
	],
];
?>
<section class="section testimonials">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow center" data-en="Testimonials" data-hi="प्रशंसापत्र">
				<?php esc_html_e( 'Testimonials', 'excellence-school' ); ?>
			</span>
			<h2 data-en="What Our Community Says" data-hi="हमारा समुदाय क्या कहता है">
				<?php esc_html_e( 'What Our Community Says', 'excellence-school' ); ?>
			</h2>
		</div>
		<div class="grid test-grid">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$author   = get_post_meta( get_the_ID(), '_esb_author_name', true );
				$role_txt = get_post_meta( get_the_ID(), '_esb_author_role', true );
				$initials = get_post_meta( get_the_ID(), '_esb_initials', true );
				if ( ! $initials ) {
					$words    = explode( ' ', $author );
					$initials = strtoupper( substr( $words[0] ?? '', 0, 1 ) . substr( $words[1] ?? '', 0, 1 ) );
				}
				?>
				<div class="card test-card reveal">
					<div class="stars">★★★★★</div>
					<p><?php echo wp_kses_post( get_the_content() ); ?></p>
					<div class="who">
						<span class="av"><?php echo esc_html( $initials ); ?></span>
						<span>
							<span class="nm"><?php echo esc_html( $author ?: get_the_title() ); ?></span><br />
							<span class="rl"><?php echo esc_html( $role_txt ); ?></span>
						</span>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( $static as $t ) : ?>
				<div class="card test-card reveal">
					<div class="stars"><?php echo esc_html( str_repeat( '★', $t['stars'] ) ); ?></div>
					<p><?php echo esc_html( $t['quote'] ); ?></p>
					<div class="who">
						<span class="av"><?php echo esc_html( $t['initials'] ); ?></span>
						<span>
							<span class="nm"><?php echo esc_html( $t['name'] ); ?></span><br />
							<span class="rl"><?php echo esc_html( $t['role'] ); ?></span>
						</span>
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

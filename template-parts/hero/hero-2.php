<?php
/**
 * Hero 2 — Split layout
 *
 * @package excellence-school
 */
$hero_image_id = (int) get_theme_mod( 'esb_hero_image', 0 );
$hero_img_url  = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'large' ) : '';
$pass_rate     = esb_opt( 'esb_stat_pass_rate', '98' );
$students      = esb_opt( 'esb_stat_students', '2000' );
$estd          = esb_opt( 'esb_estd', '1965' );
$short_name    = esb_opt( 'esb_school_short_name', 'Subhash Excellence School' );
$eyebrow       = esb_opt( 'esb_hero_eyebrow', '' ) ?: ( 'Estd. ' . $estd . ' · ' . $short_name );
$eyebrow_hi    = 'स्थापना ' . $estd . ' · ' . $short_name;

$h1  = esb_pg( 'hero2_h1',  'Where Excellence Becomes a Habit.' );
$sub = esb_pg( 'hero2_sub', 'A premier government institution in Bhopal offering Science, Commerce and Humanities with modern labs, a tinkering lab, and championship sports.' );

/*
 * For the typewriter effect we extract the "cycling word" from the headline.
 * Default: wrap "Excellence" with cycling alternatives.
 * The cycle words are the same language as the hero (EN only — cycler doesn't switch with lang toggle).
 */
$cycle_words = 'Excellence|Distinction|Achievement|Heritage';
// Replace first occurrence of "Excellence" in h1 with the cycle span if it exists.
$h1_rendered = $h1;
if ( str_contains( $h1, 'Excellence' ) ) {
	$h1_rendered = str_replace(
		'Excellence',
		'<span class="type-cycle" data-words="' . esc_attr( $cycle_words ) . '" aria-label="Excellence">Excellence</span><br>',
		$h1,
		$count
	);
}
?>
<section class="hero-variant" id="hero-2">
	<div class="hero2">
		<?php if ( $hero_img_url ) : ?>
			<div class="hero-bg-img" style="background-image: url('<?php echo esc_url( $hero_img_url ); ?>');"></div>
		<?php endif; ?>
		<div class="container">

			<!-- Hero Content -->
			<div class="hero2-content">
				<span class="eyebrow light hero-enter" data-delay="1"
				      data-en="<?php echo esc_attr( $eyebrow ); ?>"
				      data-hi="<?php echo esc_attr( $eyebrow_hi ); ?>">
					<?php echo esc_html( $eyebrow ); ?>
				</span>

				<h1 class="hero-enter" data-delay="2" data-lang-show="en">
					<?php
					// h1_rendered may contain a <span> for the cycler — allowed safe HTML.
					echo wp_kses( $h1_rendered, [
						'span' => [
							'class'       => [],
							'data-words'  => [],
							'aria-label'  => [],
						],
						'br'   => [],
					] );
					?>
				</h1>
				<h1 class="hero-enter" data-delay="2" data-lang-show="hi">
					जहाँ उत्कृष्टता<br>एक आदत बन जाती है।
				</h1>

				<p class="sub hero-enter" data-delay="3"
				   data-en="<?php echo esc_attr( $sub ); ?>"
				   data-hi="भोपाल का एक प्रमुख शासकीय संस्थान — आधुनिक प्रयोगशालाओं, टिंकरिंग लैब और चैम्पियनशिप खेलों के साथ विज्ञान, वाणिज्य और मानविकी।">
					<?php echo esc_html( $sub ); ?>
				</p>

				<div class="cta-row hero-enter" data-delay="4">
					<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>"
					   class="btn btn-gold btn-arrow"
					   data-en="Apply for Admission" data-hi="प्रवेश हेतु आवेदन">
						<?php esc_html_e( 'Apply for Admission', 'excellence-school' ); ?>
					</a>
					<a href="<?php echo esc_url( esb_page_url( 'academics' ) ); ?>"
					   class="btn btn-ghost-light"
					   data-en="Explore Academics" data-hi="शिक्षा देखें">
						<?php esc_html_e( 'Explore Academics', 'excellence-school' ); ?>
					</a>
				</div>

				<div class="mini-stats stagger-grid hero-enter" data-delay="5">
					<div class="reveal">
						<div class="n"><?php echo esc_html( $pass_rate ); ?>%</div>
						<div class="l" data-en="Board Pass Rate" data-hi="बोर्ड उत्तीर्ण दर"><?php esc_html_e( 'Board Pass Rate', 'excellence-school' ); ?></div>
					</div>
					<div class="reveal">
						<div class="n"><?php echo esc_html( number_format( (int) $students ) ); ?>+</div>
						<div class="l" data-en="Students" data-hi="विद्यार्थी"><?php esc_html_e( 'Students', 'excellence-school' ); ?></div>
					</div>
					<div class="reveal">
						<div class="n"><?php echo esc_html( (int) gmdate( 'Y' ) - (int) $estd ); ?></div>
						<div class="l" data-en="Years of Service" data-hi="वर्षों की सेवा"><?php esc_html_e( 'Years of Service', 'excellence-school' ); ?></div>
					</div>
				</div>
			</div>


		</div>
	</div>
</section>

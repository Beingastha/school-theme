<?php
/**
 * Hero 3 — Crest forward, centered
 *
 * @package excellence-school
 */
$pass_rate  = esb_opt( 'esb_stat_pass_rate', '98' );
$students   = esb_opt( 'esb_stat_students', '2000' );
$faculty    = esb_opt( 'esb_stat_faculty', '70' );
$estd       = esb_opt( 'esb_estd', '1965' );
$short_name = esb_opt( 'esb_school_short_name', 'Subhash Excellence School' );
$full_name  = esb_opt( 'esb_school_name', 'Govt. Subhash Excellence Higher Secondary School, Bhopal' );
$eyebrow    = esb_opt( 'esb_hero_eyebrow', '' ) ?: ( 'Estd. ' . $estd . ' · ' . $short_name );
$eyebrow_hi = 'स्थापना ' . $estd . ' · ' . $short_name;
$sub        = esb_pg( 'hero3_sub', "Nurturing tomorrow's leaders through quality education, modern facilities, and holistic development — open to every section of society." );
?>
<section class="hero-variant" id="hero-3">
	<div class="hero3">
		<div class="container">

			<div class="hero-enter hero-enter-scale" data-delay="1">
				<?php esb_logo_large(); ?>
			</div>

			<span class="eyebrow center light hero-enter" data-delay="2"
			      data-en="<?php echo esc_attr( $eyebrow ); ?>"
			      data-hi="<?php echo esc_attr( $eyebrow_hi ); ?>">
				<?php echo esc_html( $eyebrow ); ?>
			</span>

			<h1 class="hero-enter" data-delay="3"
			    data-en="<?php echo esc_attr( $full_name ); ?>"
			    data-hi="शासकीय सुभाष उत्कृष्ट उच्चतर माध्यमिक विद्यालय, भोपाल">
				<?php echo esc_html( $full_name ); ?>
			</h1>

			<p class="sub hero-enter" data-delay="4"
			   data-en="<?php echo esc_attr( $sub ); ?>"
			   data-hi="गुणवत्तापूर्ण शिक्षा, आधुनिक सुविधाओं और समग्र विकास के माध्यम से कल के नेताओं का निर्माण — समाज के हर वर्ग के लिए।">
				<?php echo esc_html( $sub ); ?>
			</p>

			<div class="cta-row hero-enter" data-delay="5">
				<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>"
				   class="btn btn-gold btn-arrow"
				   data-en="Apply for Admission" data-hi="प्रवेश हेतु आवेदन">
					<?php esc_html_e( 'Apply for Admission', 'excellence-school' ); ?>
				</a>
				<a href="<?php echo esc_url( esb_page_url( 'about' ) ); ?>"
				   class="btn btn-ghost-light"
				   data-en="About the School" data-hi="विद्यालय के बारे में">
					<?php esc_html_e( 'About the School', 'excellence-school' ); ?>
				</a>
			</div>

			<div class="stat-strip stagger-grid hero-enter" data-delay="6">
				<div class="reveal">
					<div class="n"><?php echo esc_html( $estd ); ?></div>
					<div class="l" data-en="Established" data-hi="स्थापित"><?php esc_html_e( 'Established', 'excellence-school' ); ?></div>
				</div>
				<div class="reveal">
					<div class="n"><?php echo esc_html( $pass_rate ); ?>%</div>
					<div class="l" data-en="Board Results" data-hi="बोर्ड परिणाम"><?php esc_html_e( 'Board Results', 'excellence-school' ); ?></div>
				</div>
				<div class="reveal">
					<div class="n"><?php echo esc_html( number_format( (int) $students ) ); ?>+</div>
					<div class="l" data-en="Students" data-hi="विद्यार्थी"><?php esc_html_e( 'Students', 'excellence-school' ); ?></div>
				</div>
				<div class="reveal">
					<div class="n"><?php echo esc_html( $faculty ); ?>+</div>
					<div class="l" data-en="Faculty" data-hi="शिक्षक"><?php esc_html_e( 'Faculty', 'excellence-school' ); ?></div>
				</div>
			</div>

		</div>
	</div>
</section>
<?php
function esb_logo_large(): void {
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	if ( $custom_logo_id ) {
		$logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );
	} else {
		$logo_url = get_template_directory_uri() . '/assets/images/logo.webp';
	}
	echo '<img class="crest crest-big" src="' . esc_url( $logo_url ) . '" alt="' . esc_attr__( 'School for Excellence Bhopal crest', 'excellence-school' ) . '" width="124" height="124" />';
}

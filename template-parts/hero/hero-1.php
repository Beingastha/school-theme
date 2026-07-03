<?php
/**
 * Hero 1 — Stately full-bleed
 *
 * @package excellence-school
 */
$hero_image_id = (int) get_theme_mod( 'esb_hero_image', 0 );
$hero_img_url  = $hero_image_id ? wp_get_attachment_image_url( $hero_image_id, 'full' ) : '';

$_estd    = esb_opt( 'esb_estd', '1965' );
$_short   = esb_opt( 'esb_school_short_name', 'Subhash Excellence School' );
$_eyebrow = esb_opt( 'esb_hero_eyebrow', '' ) ?: ( 'Estd. ' . $_estd . ' · ' . $_short );
$_ey_hi   = 'स्थापना ' . $_estd . ' · ' . $_short;

$_h1  = esb_pg( 'hero1_h1',  'A Government School of Distinction.' );
$_sub = esb_pg( 'hero1_sub', "Nurturing tomorrow's leaders in Subhash Shivaji Nagar — where academic excellence, character, and opportunity meet under one roof." );

/* Typewriter on "Distinction" */
$_h1_rendered = $_h1;
if ( str_contains( $_h1, 'Distinction' ) ) {
	$_h1_rendered = str_replace(
		'Distinction',
		'<span class="type-cycle" data-words="Distinction|Excellence|Achievement|Heritage" aria-label="Distinction">Distinction</span>',
		$_h1
	);
}
?>
<section class="hero-variant" id="hero-1">
	<div class="hero1">
		<div class="hero-bg">
			<?php if ( $hero_img_url ) : ?>
				<img src="<?php echo esc_url( $hero_img_url ); ?>" alt="" aria-hidden="true" />
			<?php else : ?>
				<div class="ph" data-label="campus-aerial.jpg — 1920×1080"></div>
			<?php endif; ?>
		</div>
		<div class="scrim"></div>
		<div class="container">

			<span class="eyebrow light hero-enter" data-delay="1"
			      data-en="<?php echo esc_attr( $_eyebrow ); ?>"
			      data-hi="<?php echo esc_attr( $_ey_hi ); ?>">
				<?php echo esc_html( $_eyebrow ); ?>
			</span>

			<h1 class="hero-enter" data-delay="2" data-lang-show="en">
				<?php
				echo wp_kses( $_h1_rendered, [
					'span' => [
						'class'      => [],
						'data-words' => [],
						'aria-label' => [],
					],
				] );
				?>
			</h1>
			<h1 class="hero-enter" data-delay="2" data-lang-show="hi">
				<?php echo esc_html( esb_pg_hi( 'hero1_h1', 'प्रतिष्ठित शासकीय उत्कृष्टता विद्यालय।' ) ); ?>
			</h1>

			<p class="sub hero-enter" data-delay="3"
			   data-en="<?php echo esc_attr( $_sub ); ?>"
			   data-hi="<?php echo esc_attr( esb_pg_hi( 'hero1_sub', 'सुभाष शिवाजी नगर में कल के नेताओं का निर्माण — जहाँ शैक्षणिक उत्कृष्टता, चरित्र और अवसर एक छत के नीचे मिलते हैं।' ) ); ?>">
				<?php echo esc_html( $_sub ); ?>
			</p>

			<div class="cta-row hero-enter" data-delay="4">
				<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>"
				   class="btn btn-gold btn-arrow"
				   data-en="Apply for Admission" data-hi="प्रवेश हेतु आवेदन">
					<?php esc_html_e( 'Apply for Admission', 'excellence-school' ); ?>
				</a>
				<a href="<?php echo esc_url( esb_page_url( 'about' ) ); ?>"
				   class="btn btn-ghost-light"
				   data-en="Principal's Message" data-hi="प्राचार्य का संदेश">
					<?php esc_html_e( "Principal's Message", 'excellence-school' ); ?>
				</a>
			</div>

			<div class="accolades hero-enter" data-delay="5">
				<span class="accolade">
					<span class="diamond"></span>
					<span data-en="MP Board of Secondary Education" data-hi="माध्यमिक शिक्षा मंडल, म.प्र.">
						<?php esc_html_e( 'MP Board of Secondary Education', 'excellence-school' ); ?>
					</span>
				</span>
				<span class="accolade">
					<span class="diamond"></span>
					<span data-en="ATAL Tinkering Lab · NITI Aayog" data-hi="अटल टिंकरिंग लैब · नीति आयोग">
						<?php esc_html_e( 'ATAL Tinkering Lab · NITI Aayog', 'excellence-school' ); ?>
					</span>
				</span>
				<span class="accolade">
					<span class="diamond"></span>
					<span data-en="Excellence in Sports" data-hi="खेल में उत्कृष्टता">
						<?php esc_html_e( 'Excellence in Sports', 'excellence-school' ); ?>
					</span>
				</span>
			</div>

		</div>
	</div>
</section>

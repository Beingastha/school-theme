<?php
/**
 * Homepage template (set as static front page)
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">

	<!-- ===== HERO VARIANTS ===== -->
	<div data-hero-variant>
		<?php
		get_template_part( 'template-parts/hero/hero', '1' );
		get_template_part( 'template-parts/hero/hero', '2' );
		get_template_part( 'template-parts/hero/hero', '3' );
		?>
	</div>

	<?php if ( esb_section_visible( 'circulars' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/circulars' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'stats_band' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/stats-band' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'why_choose_us' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/why-choose-us' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'principal_message' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/principal-message' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'academic_excellence' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/academic-excellence' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'achievements' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/achievements' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'facilities' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/facilities' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'student_life' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/student-life' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'news_events' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/news-events' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'testimonials' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/testimonials' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'admissions_cta' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/admissions-cta' ); ?>
	<?php endif; ?>

	<?php if ( esb_section_visible( 'contact' ) ) : ?>
		<?php get_template_part( 'template-parts/sections/contact' ); ?>
	<?php endif; ?>

</main>
<?php get_footer(); ?>

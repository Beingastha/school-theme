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

	<?php get_template_part( 'template-parts/sections/stats-band' ); ?>
	<?php get_template_part( 'template-parts/sections/why-choose-us' ); ?>
	<?php get_template_part( 'template-parts/sections/principal-message' ); ?>
	<?php get_template_part( 'template-parts/sections/academic-excellence' ); ?>
	<?php get_template_part( 'template-parts/sections/achievements' ); ?>
	<?php get_template_part( 'template-parts/sections/facilities' ); ?>
	<?php get_template_part( 'template-parts/sections/student-life' ); ?>
	<?php get_template_part( 'template-parts/sections/news-events' ); ?>
	<?php get_template_part( 'template-parts/sections/testimonials' ); ?>
	<?php get_template_part( 'template-parts/sections/gallery' ); ?>
	<?php get_template_part( 'template-parts/sections/admissions-cta' ); ?>
	<?php get_template_part( 'template-parts/sections/contact' ); ?>

</main>
<?php get_footer(); ?>

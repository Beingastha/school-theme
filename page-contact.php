<?php
/**
 * Template Name: Contact
 * Contact page template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">

	<!-- Page Hero -->
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span data-en="Contact" data-hi="संपर्क करें"><?php esc_html_e( 'Contact', 'excellence-school' ); ?></span>
			</div>
			<span class="eyebrow light" data-en="Get in Touch" data-hi="संपर्क करें">
				<?php esc_html_e( 'Get in Touch', 'excellence-school' ); ?>
			</span>
			<h1 data-en="Contact Us" data-hi="संपर्क करें">
				<?php esc_html_e( 'Contact Us', 'excellence-school' ); ?>
			</h1>
			<p data-en="Reach out with any question about admissions, academics or campus life — our team is happy to help."
			   data-hi="प्रवेश, शिक्षा या परिसर जीवन से जुड़े किसी भी प्रश्न के लिए संपर्क करें — हमारी टीम सहायता हेतु तत्पर है।">
				<?php esc_html_e( 'Reach out with any question about admissions, academics or campus life — our team is happy to help.', 'excellence-school' ); ?>
			</p>
		</div>
	</section>

	<?php get_template_part( 'template-parts/sections/contact' ); ?>

</main>
<?php get_footer(); ?>

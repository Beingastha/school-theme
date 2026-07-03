<?php
/**
 * 404 Not Found template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">

	<section class="pagehero err404-hero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span data-en="Page Not Found" data-hi="पृष्ठ नहीं मिला"><?php esc_html_e( 'Page Not Found', 'excellence-school' ); ?></span>
			</div>
			<span class="eyebrow light" data-en="Error 404" data-hi="त्रुटि 404"><?php esc_html_e( 'Error 404', 'excellence-school' ); ?></span>
			<div class="err404-num" aria-hidden="true">404</div>
			<h1 data-en="This Page Has Gone Missing" data-hi="यह पृष्ठ नहीं मिल रहा है">
				<?php esc_html_e( 'This Page Has Gone Missing', 'excellence-school' ); ?>
			</h1>
			<p data-en="The page you're looking for may have been moved, renamed, or doesn't exist. Try searching below or head back to the homepage."
			   data-hi="आप जिस पृष्ठ की तलाश कर रहे हैं वह स्थानांतरित, नाम-परिवर्तित या अनुपलब्ध हो सकता है। नीचे खोजें या होमपेज पर वापस जाएं।">
				<?php esc_html_e( "The page you're looking for may have been moved, renamed, or doesn't exist. Try searching below or head back to the homepage.", 'excellence-school' ); ?>
			</p>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<form role="search" method="get" class="err404-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div class="field">
					<label for="err404-s" data-en="Search the Site" data-hi="साइट खोजें"><?php esc_html_e( 'Search the Site', 'excellence-school' ); ?></label>
					<input type="search"
					       id="err404-s"
					       name="s"
					       value="<?php echo esc_attr( get_search_query() ); ?>"
					       placeholder="<?php esc_attr_e( 'Search for admissions, academics, facilities…', 'excellence-school' ); ?>" />
				</div>
				<button type="submit" class="btn btn-gold btn-arrow" data-en="Search" data-hi="खोजें"><?php esc_html_e( 'Search', 'excellence-school' ); ?></button>
			</form>

			<div class="rule-diamond err404-rule"><span class="diamond"></span></div>

			<span class="eyebrow center" data-en="Popular Pages" data-hi="लोकप्रिय पृष्ठ" style="display:flex"><?php esc_html_e( 'Popular Pages', 'excellence-school' ); ?></span>

			<div class="err404-links">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="err404-link">
					<span data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></span>
					<span class="err404-arrow">→</span>
				</a>
				<a href="<?php echo esc_url( esb_page_url( 'about' ) ); ?>" class="err404-link">
					<span data-en="About Us" data-hi="परिचय"><?php esc_html_e( 'About Us', 'excellence-school' ); ?></span>
					<span class="err404-arrow">→</span>
				</a>
				<a href="<?php echo esc_url( esb_page_url( 'academics' ) ); ?>" class="err404-link">
					<span data-en="Academics" data-hi="शिक्षा"><?php esc_html_e( 'Academics', 'excellence-school' ); ?></span>
					<span class="err404-arrow">→</span>
				</a>
				<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>" class="err404-link">
					<span data-en="Admissions" data-hi="प्रवेश"><?php esc_html_e( 'Admissions', 'excellence-school' ); ?></span>
					<span class="err404-arrow">→</span>
				</a>
				<a href="<?php echo esc_url( esb_page_url( 'gallery' ) ); ?>" class="err404-link">
					<span data-en="Gallery" data-hi="गैलरी"><?php esc_html_e( 'Gallery', 'excellence-school' ); ?></span>
					<span class="err404-arrow">→</span>
				</a>
				<a href="<?php echo esc_url( esb_page_url( 'contact' ) ); ?>" class="err404-link">
					<span data-en="Contact" data-hi="संपर्क करें"><?php esc_html_e( 'Contact', 'excellence-school' ); ?></span>
					<span class="err404-arrow">→</span>
				</a>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>

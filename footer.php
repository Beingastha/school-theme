<?php
/**
 * Footer template
 *
 * @package excellence-school
 */
$school_name = esb_opt( 'esb_school_name', 'School for Excellence' );
$subtitle     = esb_opt( 'esb_school_subtitle', 'Subhash Nagar · Bhopal' );
$address      = esb_opt( 'esb_address', 'Subhash Shivaji Nagar, Bhopal, MP – 462016' );
$phone        = esb_opt( 'esb_phone', '+91 755-255-2490' );
$email        = esb_opt( 'esb_email', 'govt.hss.excellence.subhash@gmail.com' );
$udise        = esb_opt( 'esb_udise', '23320301711' );
$facebook     = esb_opt( 'esb_facebook', 'https://www.facebook.com/100064206661897' );
$instagram    = esb_opt( 'esb_instagram', 'https://www.instagram.com/_subhashians_' );
$linkedin     = esb_opt( 'esb_linkedin', 'https://in.linkedin.com/company/school-for-excellence-shivaji-nagar-bhopal' );
$youtube      = esb_opt( 'esb_youtube', 'https://www.youtube.com/watch?v=aMfvYKTnO50' );
?>
<footer class="footer">
	<div class="container">
		<div class="footer-top">

			<!-- Brand & description -->
			<div>
				<div class="fbrand">
					<?php esb_logo(); ?>
					<div>
						<div class="n1" data-en="<?php echo esc_attr( $school_name ); ?>" data-hi="उत्कृष्टता विद्यालय">
							<?php echo esc_html( $school_name ); ?>
						</div>
						<div class="n2" data-en="<?php echo esc_attr( $subtitle ); ?>" data-hi="सुभाष नगर · भोपाल">
							<?php echo esc_html( $subtitle ); ?>
						</div>
					</div>
				</div>
				<p class="fdesc" data-en="A Government School of Excellence under the Department of School Education, Government of Madhya Pradesh — committed to nurturing tomorrow's leaders through quality education and holistic development."
				   data-hi="स्कूल शिक्षा विभाग, मध्य प्रदेश शासन के अंतर्गत एक शासकीय उत्कृष्टता विद्यालय — गुणवत्तापूर्ण शिक्षा व समग्र विकास के माध्यम से कल के नेताओं को तैयार करने हेतु प्रतिबद्ध।">
					<?php esc_html_e( 'A Government School of Excellence under the Department of School Education, Government of Madhya Pradesh — committed to nurturing tomorrow\'s leaders through quality education and holistic development.', 'excellence-school' ); ?>
				</p>
				<div class="socials">
					<?php if ( $facebook ) : ?>
					<a class="social" href="<?php echo esc_url( $facebook ); ?>" aria-label="Facebook" rel="noopener noreferrer" target="_blank">f</a>
					<?php endif; ?>
					<?php if ( $instagram ) : ?>
					<a class="social" href="<?php echo esc_url( $instagram ); ?>" aria-label="Instagram" rel="noopener noreferrer" target="_blank">ig</a>
					<?php endif; ?>
					<?php if ( $linkedin ) : ?>
					<a class="social" href="<?php echo esc_url( $linkedin ); ?>" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank">in</a>
					<?php endif; ?>
					<?php if ( $youtube ) : ?>
					<a class="social" href="<?php echo esc_url( $youtube ); ?>" aria-label="YouTube" rel="noopener noreferrer" target="_blank">yt</a>
					<?php endif; ?>
				</div>
			</div>

			<!-- Quick Links -->
			<div>
				<h4 data-en="Quick Links" data-hi="त्वरित लिंक"><?php esc_html_e( 'Quick Links', 'excellence-school' ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/about/' ) ); ?>" data-en="About Us" data-hi="परिचय"><?php esc_html_e( 'About Us', 'excellence-school' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/academics/' ) ); ?>" data-en="Academics" data-hi="शिक्षा"><?php esc_html_e( 'Academics', 'excellence-school' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/admissions/' ) ); ?>" data-en="Admissions" data-hi="प्रवेश"><?php esc_html_e( 'Admissions', 'excellence-school' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#gallery' ) ); ?>" data-en="Gallery" data-hi="गैलरी"><?php esc_html_e( 'Gallery', 'excellence-school' ); ?></a></li>
				</ul>
			</div>

			<!-- Explore -->
			<div>
				<h4 data-en="Explore" data-hi="अन्वेषण"><?php esc_html_e( 'Explore', 'excellence-school' ); ?></h4>
				<ul>
					<li><a href="<?php echo esc_url( home_url( '/#facilities' ) ); ?>" data-en="Facilities" data-hi="सुविधाएं"><?php esc_html_e( 'Facilities', 'excellence-school' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#achievements' ) ); ?>" data-en="Achievements" data-hi="उपलब्धियां"><?php esc_html_e( 'Achievements', 'excellence-school' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#news' ) ); ?>" data-en="News &amp; Events" data-hi="समाचार"><?php esc_html_e( 'News & Events', 'excellence-school' ); ?></a></li>
					<li><a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" data-en="Contact" data-hi="संपर्क"><?php esc_html_e( 'Contact', 'excellence-school' ); ?></a></li>
				</ul>
			</div>

			<!-- Contact -->
			<div>
				<h4 data-en="Contact" data-hi="संपर्क"><?php esc_html_e( 'Contact', 'excellence-school' ); ?></h4>
				<ul>
					<li data-en="<?php echo esc_attr( $address ); ?>" data-hi="सुभाष शिवाजी नगर, भोपाल, म.प्र. – 462016">
						<?php echo esc_html( $address ); ?>
					</li>
					<li><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></li>
					<li><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></li>
					<li data-en="UDISE Code: <?php echo esc_attr( $udise ); ?>" data-hi="यूडाइस कोड: <?php echo esc_attr( $udise ); ?>">
						<?php echo esc_html( 'UDISE Code: ' . $udise ); ?>
					</li>
				</ul>
			</div>
		</div>

		<div class="footer-rule"></div>

		<div class="footer-bottom">
			<span data-en="© <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( $school_name ); ?>, Subhash Shivaji Nagar, Bhopal. All Rights Reserved."
			      data-hi="© <?php echo esc_html( gmdate( 'Y' ) ); ?> उत्कृष्टता विद्यालय, सुभाष शिवाजी नगर, भोपाल। सर्वाधिकार सुरक्षित।">© <?php echo esc_html( gmdate( 'Y' ) . ' ' . $school_name ); ?>, Subhash Shivaji Nagar, Bhopal. All Rights Reserved.</span>
			<span data-en="Department of School Education · Madhya Pradesh" data-hi="स्कूल शिक्षा विभाग · मध्य प्रदेश"><?php esc_html_e( 'Department of School Education · Madhya Pradesh', 'excellence-school' ); ?></span>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

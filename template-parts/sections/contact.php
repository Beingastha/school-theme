<?php
/**
 * Contact section
 *
 * @package excellence-school
 */
$address    = esb_opt( 'esb_address', 'Subhash Shivaji Nagar, Bhopal, Madhya Pradesh – 462016' );
$phone      = esb_opt( 'esb_phone', '+91 755-255-2490' );
$email      = esb_opt( 'esb_email', 'govt.hss.excellence.subhash@gmail.com' );
$hours      = esb_opt( 'esb_hours', 'Monday – Saturday · 8:00 AM – 4:00 PM' );
$maps_embed = esb_opt( 'esb_maps_embed', '' );
?>
<section class="section" id="contact">
	<div class="container">
		<div class="contact-grid">
			<div class="reveal">
				<span class="eyebrow" data-en="Contact Us" data-hi="संपर्क करें">
					<?php esc_html_e( 'Contact Us', 'excellence-school' ); ?>
				</span>
				<h2 style="font-size:clamp(34px,4.5vw,50px);margin-top:16px"
				    data-en="We'd Love to Hear From You"
				    data-hi="हमें आपसे सुनकर खुशी होगी">
					<?php esc_html_e( "We'd Love to Hear From You", 'excellence-school' ); ?>
				</h2>
				<div class="contact-list">
					<div class="contact-item">
						<span class="ic"><span class="diamond"></span></span>
						<div>
							<div class="k" data-en="Address" data-hi="पता"><?php esc_html_e( 'Address', 'excellence-school' ); ?></div>
							<div class="v" data-en="<?php echo esc_attr( $address ); ?>" data-hi="सुभाष शिवाजी नगर, भोपाल, मध्य प्रदेश – 462016">
								<?php echo esc_html( $address ); ?>
							</div>
						</div>
					</div>
					<div class="contact-item">
						<span class="ic"><span class="diamond"></span></span>
						<div>
							<div class="k" data-en="Phone" data-hi="फोन"><?php esc_html_e( 'Phone', 'excellence-school' ); ?></div>
							<div class="v">
								<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>">
									<?php echo esc_html( $phone ); ?>
								</a>
							</div>
						</div>
					</div>
					<div class="contact-item">
						<span class="ic"><span class="diamond"></span></span>
						<div>
							<div class="k" data-en="Email" data-hi="ईमेल"><?php esc_html_e( 'Email', 'excellence-school' ); ?></div>
							<div class="v">
								<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
							</div>
						</div>
					</div>
					<div class="contact-item">
						<span class="ic"><span class="diamond"></span></span>
						<div>
							<div class="k" data-en="Office Hours" data-hi="कार्यालय समय"><?php esc_html_e( 'Office Hours', 'excellence-school' ); ?></div>
							<div class="v" data-en="<?php echo esc_attr( $hours ); ?>" data-hi="सोमवार – शनिवार · प्रातः 8 – सायं 4">
								<?php echo esc_html( $hours ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="map-card reveal">
				<?php if ( $maps_embed ) : ?>
					<iframe
						src="<?php echo esc_url( $maps_embed ); ?>"
						allowfullscreen=""
						loading="lazy"
						referrerpolicy="no-referrer-when-downgrade"
						title="<?php esc_attr_e( 'School location map', 'excellence-school' ); ?>">
					</iframe>
				<?php else : ?>
					<div class="ph" data-label="campus-map.jpg — Subhash Shivaji Nagar, Bhopal"></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>

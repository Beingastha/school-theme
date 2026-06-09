<?php
/**
 * Admissions CTA banner
 *
 * @package excellence-school
 */
$year      = (int) gmdate( 'Y' );
$cta_h2    = esb_pg( 'home_cta_h2',   'Give Your Child the Excellence They Deserve' );
$cta_body  = esb_pg( 'home_cta_body', 'Join the School for Excellence, Bhopal and open the door to quality education, modern facilities and a community that believes in every child. Limited seats available.' );
?>
<section class="adm-cta">
	<div class="container reveal">
		<span class="eyebrow center light"
		      data-en="Admissions Open · <?php echo esc_attr( $year . '–' . ( $year + 1 ) ); ?>"
		      data-hi="प्रवेश प्रारंभ · <?php echo esc_attr( $year . '–' . ( $year + 1 ) ); ?>">
			<?php echo esc_html( 'Admissions Open · ' . $year . '–' . ( $year + 1 ) ); ?>
		</span>
		<h2 data-en="<?php echo esc_attr( $cta_h2 ); ?>"
		    data-hi="अपने बच्चे को वह उत्कृष्टता दें जिसके वे हकदार हैं">
			<?php echo esc_html( $cta_h2 ); ?>
		</h2>
		<p data-en="<?php echo esc_attr( $cta_body ); ?>"
		   data-hi="उत्कृष्टता विद्यालय, भोपाल से जुड़ें और गुणवत्तापूर्ण शिक्षा, आधुनिक सुविधाओं व हर बच्चे में विश्वास रखने वाले समुदाय के द्वार खोलें। सीमित सीटें उपलब्ध।">
			<?php echo esc_html( $cta_body ); ?>
		</p>
		<div class="cta-row">
			<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>"
			   class="btn btn-gold btn-arrow"
			   data-en="Apply for Admission" data-hi="प्रवेश हेतु आवेदन">
				<?php esc_html_e( 'Apply for Admission', 'excellence-school' ); ?>
			</a>
			<a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>"
			   class="btn btn-ghost-light"
			   data-en="Contact for Details" data-hi="विवरण हेतु संपर्क">
				<?php esc_html_e( 'Contact for Details', 'excellence-school' ); ?>
			</a>
		</div>
	</div>
</section>

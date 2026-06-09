<?php
/**
 * Stats band section
 *
 * @package excellence-school
 */
$pass_rate = esb_opt( 'esb_stat_pass_rate', '98' );
$students  = esb_opt( 'esb_stat_students', '2000' );
$faculty   = esb_opt( 'esb_stat_faculty', '70' );
$awards    = esb_opt( 'esb_stat_awards', '150' );
?>
<section class="stats-band">
	<div class="container">
		<div class="stats-grid reveal">
			<div>
				<div class="stat-num"><span data-count="<?php echo esc_attr( $pass_rate ); ?>">0</span><span class="suffix">%</span></div>
				<div class="stat-label" data-en="Board Pass Rate (<?php echo esc_attr( gmdate( 'Y' ) ); ?>)" data-hi="बोर्ड उत्तीर्ण दर (<?php echo esc_attr( gmdate( 'Y' ) ); ?>)">
					<?php echo esc_html( 'Board Pass Rate (' . gmdate( 'Y' ) . ')' ); ?>
				</div>
			</div>
			<div>
				<div class="stat-num"><span data-count="<?php echo esc_attr( $students ); ?>">0</span><span class="suffix">+</span></div>
				<div class="stat-label" data-en="Students Enrolled" data-hi="नामांकित विद्यार्थी">
					<?php esc_html_e( 'Students Enrolled', 'excellence-school' ); ?>
				</div>
			</div>
			<div>
				<div class="stat-num"><span data-count="<?php echo esc_attr( $faculty ); ?>">0</span><span class="suffix">+</span></div>
				<div class="stat-label" data-en="Expert Faculty" data-hi="विशेषज्ञ शिक्षक">
					<?php esc_html_e( 'Expert Faculty', 'excellence-school' ); ?>
				</div>
			</div>
			<div>
				<div class="stat-num"><span data-count="<?php echo esc_attr( $awards ); ?>">0</span><span class="suffix">+</span></div>
				<div class="stat-label" data-en="State &amp; District Awards" data-hi="राज्य व जिला पुरस्कार">
					<?php esc_html_e( 'State & District Awards', 'excellence-school' ); ?>
				</div>
			</div>
		</div>
	</div>
</section>

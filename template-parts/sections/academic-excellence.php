<?php
/**
 * Academic Excellence / Board Results section
 *
 * @package excellence-school
 */
$bars = [];
for ( $i = 1; $i <= 4; $i++ ) {
	$default_names_en = [ 1 => 'Class XII · Science',    2 => 'Class XII · Commerce',   3 => 'Class XII · Humanities', 4 => 'Class X · All Streams' ];
	$default_names_hi = [ 1 => 'कक्षा 12 · विज्ञान',  2 => 'कक्षा 12 · वाणिज्य', 3 => 'कक्षा 12 · मानविकी', 4 => 'कक्षा 10 · सभी' ];
	$default_pcts     = [ 1 => 99, 2 => 98, 3 => 97, 4 => 96 ];

	$bars[] = [
		'en'  => esb_opt( "esb_result_{$i}_name_en", $default_names_en[$i] ),
		'hi'  => esb_opt( "esb_result_{$i}_name_hi", $default_names_hi[$i] ),
		'pct' => (int) esb_opt( "esb_result_{$i}_pct", (string) $default_pcts[$i] ),
	];
}
$desc_en = esb_opt( 'esb_results_desc_en', 'Our Class XII Science cohort recorded a 99% pass rate in 2025, with multiple students placing in the district merit list. Dedicated remedial sessions and competitive-exam coaching ensure no learner is left behind.' );
$desc_hi = esb_opt( 'esb_results_desc_hi', 'हमारे कक्षा 12 विज्ञान समूह ने 2025 में 99% उत्तीर्ण दर दर्ज की, जिसमें कई विद्यार्थी जिला मेरिट सूची में रहे। समर्पित उपचारात्मक सत्र और प्रतियोगी कोचिंग सुनिश्चित करती है कि कोई पीछे न छूटे।' );

$streams = [
	[ 'en' => 'Science',    'hi' => 'विज्ञान',   'desc_en' => 'PCM & PCB with NEET / JEE foundation coaching.', 'desc_hi' => 'पीसीएम व पीसीबी, नीट/जेईई फाउंडेशन कोचिंग के साथ।' ],
	[ 'en' => 'Commerce',   'hi' => 'वाणिज्य',   'desc_en' => 'Accountancy, Economics & Business Studies.',     'desc_hi' => 'लेखाशास्त्र, अर्थशास्त्र व व्यवसाय अध्ययन।' ],
	[ 'en' => 'Humanities', 'hi' => 'मानविकी',   'desc_en' => 'History, Political Science, Geography & more.',  'desc_hi' => 'इतिहास, राजनीति विज्ञान, भूगोल व अधिक।' ],
	[ 'en' => 'Foundation', 'hi' => 'आधार',       'desc_en' => 'Strong Class IX–X grounding across subjects.',  'desc_hi' => 'कक्षा 9–10 में सभी विषयों की मजबूत नींव।' ],
];
?>
<section class="section" id="academics">
	<div class="container">
		<div class="section-head reveal">
			<span class="eyebrow" data-en="Academic Excellence" data-hi="शैक्षणिक उत्कृष्टता">
				<?php esc_html_e( 'Academic Excellence', 'excellence-school' ); ?>
			</span>
			<h2 data-en="Board Results That Speak for Themselves" data-hi="परिणाम जो स्वयं बोलते हैं">
				<?php esc_html_e( 'Board Results That Speak for Themselves', 'excellence-school' ); ?>
			</h2>
			<p data-en="Consistent, top-tier performance in the MP Board examinations across every stream."
			   data-hi="प्रत्येक संकाय में एमपी बोर्ड परीक्षाओं में निरंतर, श्रेष्ठ प्रदर्शन।">
				<?php esc_html_e( 'Consistent, top-tier performance in the MP Board examinations across every stream.', 'excellence-school' ); ?>
			</p>
		</div>
		<div class="results-grid reveal">
			<div class="result-bars">
				<?php foreach ( $bars as $bar ) : ?>
				<div class="result-bar">
					<div class="top">
						<span class="nm" data-en="<?php echo esc_attr( $bar['en'] ); ?>" data-hi="<?php echo esc_attr( $bar['hi'] ); ?>">
							<?php echo esc_html( $bar['en'] ); ?>
						</span>
						<span class="pct"><?php echo esc_html( $bar['pct'] ); ?>%</span>
					</div>
					<div class="track"><span class="fill" style="--w:<?php echo esc_attr( $bar['pct'] ); ?>%"></span></div>
				</div>
				<?php endforeach; ?>
			</div>
			<div>
				<p class="muted"
				   data-en="<?php echo esc_attr( $desc_en ); ?>"
				   data-hi="<?php echo esc_attr( $desc_hi ); ?>">
					<?php echo esc_html( $desc_en ); ?>
				</p>
				<div class="stream-cards">
					<?php foreach ( $streams as $stream ) : ?>
					<div class="stream-card">
						<h4 data-en="<?php echo esc_attr( $stream['en'] ); ?>" data-hi="<?php echo esc_attr( $stream['hi'] ); ?>">
							<?php echo esc_html( $stream['en'] ); ?>
						</h4>
						<p data-en="<?php echo esc_attr( $stream['desc_en'] ); ?>" data-hi="<?php echo esc_attr( $stream['desc_hi'] ); ?>">
							<?php echo esc_html( $stream['desc_en'] ); ?>
						</p>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</section>

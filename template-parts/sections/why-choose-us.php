<?php
/**
 * Why Choose Us section
 *
 * @package excellence-school
 */
$card_defaults = [
	1 => [
		'en'      => 'Academic Rigour',
		'hi'      => 'शैक्षणिक कठोरता',
		'desc_en' => 'A merit-driven curriculum across Science, Commerce and Humanities, with focused coaching for board and competitive exams.',
		'desc_hi' => 'विज्ञान, वाणिज्य और मानविकी में योग्यता-आधारित पाठ्यक्रम, बोर्ड व प्रतियोगी परीक्षाओं हेतु केंद्रित कोचिंग के साथ।',
	],
	2 => [
		'en'      => 'Modern Infrastructure',
		'hi'      => 'आधुनिक अवसंरचना',
		'desc_en' => 'Smart classrooms, science labs, a computer lab and an ATAL Tinkering Lab sanctioned by NITI Aayog for hands-on STEM learning.',
		'desc_hi' => 'स्मार्ट कक्षाएं, विज्ञान प्रयोगशालाएं, कंप्यूटर लैब और नीति आयोग द्वारा स्वीकृत अटल टिंकरिंग लैब।',
	],
	3 => [
		'en'      => 'Championship Sports',
		'hi'      => 'चैम्पियनशिप खेल',
		'desc_en' => 'Professional coaching in boxing, cricket and badminton has produced district and state-level champions year after year.',
		'desc_hi' => 'बॉक्सिंग, क्रिकेट और बैडमिंटन में पेशेवर कोचिंग ने हर साल जिला व राज्य स्तरीय चैंपियन तैयार किए हैं।',
	],
	4 => [
		'en'      => 'Holistic Development',
		'hi'      => 'समग्र विकास',
		'desc_en' => 'Beyond marks — debate, arts, NCC, scouts and community service shape confident, responsible citizens.',
		'desc_hi' => 'अंकों से परे — वाद-विवाद, कला, एनसीसी, स्काउट और सामुदायिक सेवा आत्मविश्वासी, जिम्मेदार नागरिक तैयार करते हैं।',
	],
	5 => [
		'en'      => 'Residential Facility',
		'hi'      => 'आवासीय सुविधा',
		'desc_en' => 'A safe, disciplined hostel offers students from across the region a focused environment to live and learn.',
		'desc_hi' => 'एक सुरक्षित, अनुशासित छात्रावास क्षेत्र भर के विद्यार्थियों को रहने और सीखने हेतु केंद्रित वातावरण देता है।',
	],
	6 => [
		'en'      => 'Education for All',
		'hi'      => 'सबके लिए शिक्षा',
		'desc_en' => 'World-class learning, open to every section of society — upholding the promise of an equitable public education.',
		'desc_hi' => 'विश्वस्तरीन शिक्षा, समाज के हर वर्ग के लिए — समतापूर्ण सार्वजनिक शिक्षा के वादे को निभाते हुए।',
	],
];

$query = new WP_Query( [
	'post_type'      => 'esb_feature',
	'posts_per_page' => -1,
	'orderby'        => 'menu_order title',
	'order'          => 'ASC',
] );

$cards = [];
if ( $query->have_posts() ) {
	while ( $query->have_posts() ) {
		$query->the_post();
		$hi_title = get_post_meta( get_the_ID(), '_esb_feature_title_hi', true );
		$hi_desc  = get_post_meta( get_the_ID(), '_esb_feature_desc_hi', true );
		$cards[] = [
			'en'      => get_the_title(),
			'hi'      => $hi_title ?: get_the_title(),
			'desc_en' => get_the_content(),
			'desc_hi' => $hi_desc ?: get_the_content(),
		];
	}
	wp_reset_postdata();
} else {
	foreach ( $card_defaults as $i => $defaults ) {
		$title = esb_pg( "wcu_card_{$i}_title", $defaults['en'] );
		$desc  = esb_pg( "wcu_card_{$i}_desc",  $defaults['desc_en'] );
		$cards[] = [
			'en'      => $title,
			'hi'      => $defaults['hi'],
			'desc_en' => $desc,
			'desc_hi' => $defaults['desc_hi'],
		];
	}
}


$wcu_h2  = esb_pg( 'wcu_h2',  'A Foundation Built on Trust & Merit' );
$wcu_sub = esb_pg( 'wcu_sub', "As a designated Government School of Excellence, we combine the reach of public education with the standards of India's leading private schools." );
?>
<section class="section">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow center" data-en="Why Choose Us" data-hi="हमें क्यों चुनें">
				<?php esc_html_e( 'Why Choose Us', 'excellence-school' ); ?>
			</span>
			<h2 data-en="<?php echo esc_attr( $wcu_h2 ); ?>" data-hi="विश्वास और योग्यता पर आधारित नींव">
				<?php echo esc_html( $wcu_h2 ); ?>
			</h2>
			<p data-en="<?php echo esc_attr( $wcu_sub ); ?>"
			   data-hi="एक नामित शासकीय उत्कृष्टता विद्यालय के रूप में, हम सार्वजनिक शिक्षा की पहुँच को भारत के अग्रणी निजी विद्यालयों के मानकों के साथ जोड़ते हैं।">
				<?php echo esc_html( $wcu_sub ); ?>
			</p>
		</div>
		<div class="grid why-grid stagger-grid">
			<?php foreach ( $cards as $card ) : ?>
			<div class="card why-card reveal">
				<div class="ic"><span class="diamond"></span></div>
				<h3 data-en="<?php echo esc_attr( $card['en'] ); ?>" data-hi="<?php echo esc_attr( $card['hi'] ); ?>">
					<?php echo esc_html( $card['en'] ); ?>
				</h3>
				<p data-en="<?php echo esc_attr( $card['desc_en'] ); ?>" data-hi="<?php echo esc_attr( $card['desc_hi'] ); ?>">
					<?php echo esc_html( $card['desc_en'] ); ?>
				</p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

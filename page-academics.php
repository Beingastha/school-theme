<?php
/**
 * Template Name: Academics
 * Academics page template
 *
 * @package excellence-school
 */
get_header();

/* Page content via esb_pg() */
$hero_h1      = esb_pg( 'acad_hero_h1',  'Learning Without Limits' );
$hero_sub     = esb_pg( 'acad_hero_sub', 'A rigorous, future-ready curriculum across Science, Commerce and Humanities — backed by modern labs and dedicated coaching for board and competitive exams.' );
$results_desc = esb_pg( 'acad_results_desc', 'In 2025, our Class XII Science cohort recorded a 99% pass rate, with several students placing in the district merit list and scoring above 95%. Our results reflect a culture of disciplined preparation, individual attention and high expectations held for every student.' );
$cta_h2       = esb_pg( 'acad_cta_h2',  'Build Your Future With Us' );

/* Streams */
$stream_configs = [
	'sci' => [
		'default_name' => 'Science',
		'hi'           => 'विज्ञान',
		'item_defaults' => [
			'Physics, Chemistry, Mathematics (PCM)',
			'Physics, Chemistry, Biology (PCB)',
			'NEET / JEE foundation coaching',
			'Practical-led lab learning',
		],
		'item_hi' => [
			'भौतिकी, रसायन, गणित (पीसीएम)',
			'भौतिकी, रसायन, जीव विज्ञान (पीसीबी)',
			'नीट / जेईई फाउंडेशन कोचिंग',
			'प्रयोग-आधारित प्रयोगशाला अधिगम',
		],
	],
	'com' => [
		'default_name' => 'Commerce',
		'hi'           => 'वाणिज्य',
		'item_defaults' => [
			'Accountancy & Book-keeping',
			'Business Studies',
			'Economics & Mathematics',
			'Commerce career guidance',
		],
		'item_hi' => [
			'लेखाशास्त्र व बही-खाता',
			'व्यवसाय अध्ययन',
			'अर्थशास्त्र व गणित',
			'वाणिज्य कैरियर मार्गदर्शन',
		],
	],
	'hum' => [
		'default_name' => 'Humanities',
		'hi'           => 'मानविकी',
		'item_defaults' => [
			'History & Political Science',
			'Geography & Economics',
			'Hindi & English literature',
			'Civil services orientation',
		],
		'item_hi' => [
			'इतिहास व राजनीति विज्ञान',
			'भूगोल व अर्थशास्त्र',
			'हिंदी व अंग्रेजी साहित्य',
			'सिविल सेवा अभिमुखीकरण',
		],
	],
];

$streams = [];
foreach ( $stream_configs as $slug => $cfg ) {
	$stream_name = esb_pg( "acad_{$slug}_name", $cfg['default_name'] );
	$items       = [];
	foreach ( $cfg['item_defaults'] as $n => $default_item ) {
		$idx     = $n + 1;
		$item_en = esb_pg( "acad_{$slug}_item_{$idx}", $default_item );
		$item_hi = $cfg['item_hi'][ $n ];
		$items[] = [ $item_en, $item_hi ];
	}
	$streams[] = [
		'en'    => $stream_name,
		'hi'    => $cfg['hi'],
		'items' => $items,
	];
}

/* Approach cards */
$approach_defaults = [
	1 => [ 'Concept-First Teaching', 'अवधारणा-प्रथम शिक्षण', 'Smart classrooms and visual aids build deep understanding before rote — so students reason, not just remember.', 'स्मार्ट कक्षाएं व दृश्य सामग्री रटने से पहले गहरी समझ बनाती हैं।' ],
	2 => [ 'Exam Mastery',           'परीक्षा निपुणता',        'Regular tests, remedial sessions and competitive-exam coaching ensure every learner is board-ready and beyond.',   'नियमित परीक्षाएं, उपचारात्मक सत्र व प्रतियोगी कोचिंग।' ],
	3 => [ 'Learning by Doing',      'करके सीखना',             'Science labs and the ATAL Tinkering Lab turn theory into hands-on experiments, projects and real innovation.',       'विज्ञान प्रयोगशालाएं व अटल टिंकरिंग लैब सिद्धांत को प्रयोगों में बदलती हैं।' ],
];
$approaches = [];
foreach ( $approach_defaults as $i => [ $en, $hi, $desc_en, $desc_hi ] ) {
	$approaches[] = [
		esb_pg( "acad_app_{$i}_title", $en ),
		$hi,
		esb_pg( "acad_app_{$i}_desc",  $desc_en ),
		$desc_hi,
	];
}

/* Result bars */
$bar_defaults = [
	1 => [ 'Class XII · Science',    'कक्षा 12 · विज्ञान',  99 ],
	2 => [ 'Class XII · Commerce',   'कक्षा 12 · वाणिज्य', 98 ],
	3 => [ 'Class XII · Humanities', 'कक्षा 12 · मानविकी', 97 ],
	4 => [ 'Class X · All Streams',  'कक्षा 10 · सभी',      96 ],
];
$bars = [];
foreach ( $bar_defaults as $i => [ $en, $hi, $def_pct ] ) {
	$bars[] = [
		'en'  => esb_pg( "acad_bar_{$i}_label", $en ),
		'hi'  => $hi,
		'pct' => (int) esb_pg( "acad_bar_{$i}_pct", (string) $def_pct ),
	];
}

/* Academic facilities */
$acfac_defaults = [
	1 => [ 'Science Laboratories', 'विज्ञान प्रयोगशालाएं', 'Physics, Chemistry and Biology labs with modern apparatus for regular practical sessions.', 'science-lab.jpg' ],
	2 => [ 'ATAL Tinkering Lab',   'अटल टिंकरिंग लैब',   'A NITI Aayog–sanctioned lab for robotics, electronics and 21st-century STEM skills.',     'atl.jpg' ],
	3 => [ 'Library & Resources',  'पुस्तकालय व संसाधन', 'Over 5,000 books, periodicals and digital resources for study, research and exam prep.',   'library.jpg' ],
];
$acfacs = [];
foreach ( $acfac_defaults as $i => [ $en, $hi, $desc, $img ] ) {
	$acfacs[] = [
		esb_pg( "acad_fac_{$i}_title", $en ),
		$hi,
		esb_pg( "acad_fac_{$i}_desc",  $desc ),
		$img,
	];
}
?>
<main id="main">

	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span data-en="Academics" data-hi="शिक्षा"><?php esc_html_e( 'Academics', 'excellence-school' ); ?></span>
			</div>
			<span class="eyebrow light" data-en="Academics" data-hi="शिक्षा"><?php esc_html_e( 'Academics', 'excellence-school' ); ?></span>
			<h1 data-en="<?php echo esc_attr( $hero_h1 ); ?>" data-hi="असीमित अधिगम"><?php echo esc_html( $hero_h1 ); ?></h1>
			<p data-en="<?php echo esc_attr( $hero_sub ); ?>"
			   data-hi="विज्ञान, वाणिज्य व मानविकी में कठोर, भविष्य-तैयार पाठ्यक्रम।">
				<?php echo esc_html( $hero_sub ); ?>
			</p>
		</div>
	</section>

	<!-- Streams -->
	<section class="section">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow" data-en="Higher Secondary Streams" data-hi="उच्चतर माध्यमिक संकाय"><?php esc_html_e( 'Higher Secondary Streams', 'excellence-school' ); ?></span>
				<h2 data-en="Choose Your Path" data-hi="अपना मार्ग चुनें"><?php esc_html_e( 'Choose Your Path', 'excellence-school' ); ?></h2>
			</div>
			<div class="stream-grid">
				<?php foreach ( $streams as $stream ) : ?>
				<div class="card stream-big reveal">
					<div class="head">
						<span class="tag" data-en="Class XI – XII" data-hi="कक्षा 11 – 12"><?php esc_html_e( 'Class XI – XII', 'excellence-school' ); ?></span>
						<h3 data-en="<?php echo esc_attr( $stream['en'] ); ?>" data-hi="<?php echo esc_attr( $stream['hi'] ); ?>"><?php echo esc_html( $stream['en'] ); ?></h3>
					</div>
					<div class="body">
						<ul>
							<?php foreach ( $stream['items'] as [ $item_en, $item_hi ] ) : ?>
							<li>
								<span class="diamond"></span>
								<span data-en="<?php echo esc_attr( $item_en ); ?>" data-hi="<?php echo esc_attr( $item_hi ); ?>"><?php echo esc_html( $item_en ); ?></span>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Approach -->
	<section class="section approach">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center" data-en="Our Approach" data-hi="हमारा दृष्टिकोण"><?php esc_html_e( 'Our Approach', 'excellence-school' ); ?></span>
				<h2 data-en="How We Teach" data-hi="हम कैसे पढ़ाते हैं"><?php esc_html_e( 'How We Teach', 'excellence-school' ); ?></h2>
			</div>
			<div class="grid approach-grid">
				<?php foreach ( $approaches as [ $en, $hi, $desc_en, $desc_hi ] ) : ?>
				<div class="card approach-card reveal">
					<div class="ic"><span class="diamond"></span></div>
					<h3 data-en="<?php echo esc_attr( $en ); ?>" data-hi="<?php echo esc_attr( $hi ); ?>"><?php echo esc_html( $en ); ?></h3>
					<p data-en="<?php echo esc_attr( $desc_en ); ?>" data-hi="<?php echo esc_attr( $desc_hi ); ?>"><?php echo esc_html( $desc_en ); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Board Results -->
	<section class="section">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow" data-en="Board Results" data-hi="बोर्ड परिणाम"><?php esc_html_e( 'Board Results', 'excellence-school' ); ?></span>
				<h2 data-en="A Record of Results" data-hi="परिणामों का रिकॉर्ड"><?php esc_html_e( 'A Record of Results', 'excellence-school' ); ?></h2>
				<p data-en="Consistent top-tier performance in the MP Board examinations." data-hi="एमपी बोर्ड परीक्षा में निरंतर श्रेष्ठ प्रदर्शन।"><?php esc_html_e( 'Consistent top-tier performance in the MP Board examinations.', 'excellence-school' ); ?></p>
			</div>
			<div class="results-grid reveal">
				<div class="result-bars">
					<?php foreach ( $bars as $bar ) : ?>
					<div class="result-bar">
						<div class="top">
							<span class="nm" data-en="<?php echo esc_attr( $bar['en'] ); ?>" data-hi="<?php echo esc_attr( $bar['hi'] ); ?>"><?php echo esc_html( $bar['en'] ); ?></span>
							<span class="pct"><?php echo esc_html( $bar['pct'] ); ?>%</span>
						</div>
						<div class="track"><span class="fill" style="--w:<?php echo esc_attr( $bar['pct'] ); ?>%"></span></div>
					</div>
					<?php endforeach; ?>
				</div>
				<div>
					<p class="muted" data-en="<?php echo esc_attr( $results_desc ); ?>"
					   data-hi="हमारे परिणाम अनुशासित तैयारी, व्यक्तिगत ध्यान व उच्च अपेक्षाओं की संस्कृति को दर्शाते हैं।">
						<?php echo esc_html( $results_desc ); ?>
					</p>
					<div style="display:flex;gap:14px;flex-wrap:wrap;margin-top:24px">
						<span class="pill gold" data-en="District Toppers" data-hi="जिला टॉपर"><?php esc_html_e( 'District Toppers', 'excellence-school' ); ?></span>
						<span class="pill gold" data-en="95%+ Scorers" data-hi="95%+ अंक"><?php esc_html_e( '95%+ Scorers', 'excellence-school' ); ?></span>
						<span class="pill gold" data-en="State Merit List" data-hi="राज्य मेरिट सूची"><?php esc_html_e( 'State Merit List', 'excellence-school' ); ?></span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Academic Facilities -->
	<section class="section acfac">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center light" data-en="Academic Facilities" data-hi="शैक्षणिक सुविधाएं"><?php esc_html_e( 'Academic Facilities', 'excellence-school' ); ?></span>
				<h2 data-en="Where Learning Comes Alive" data-hi="जहाँ अधिगम जीवंत होता है"><?php esc_html_e( 'Where Learning Comes Alive', 'excellence-school' ); ?></h2>
			</div>
			<div class="grid acfac-grid">
				<?php foreach ( $acfacs as [ $title, $title_hi, $desc, $img ] ) : 
					$mapped_file = match( $img ) {
						'science-lab.jpg' => 'academics-lab',
						'atl.jpg'         => 'computer-lab',
						'library.jpg'     => 'library',
						default           => '',
					};
					$img_url = $mapped_file ? esb_get_image_url_by_filename( $mapped_file ) : '';
				?>
				<div class="acfac-card reveal">
					<?php if ( $img_url ) : ?>
						<div style="height:190px; overflow:hidden;">
							<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" style="object-fit:cover; width:100%; height:100%;" />
						</div>
					<?php else : ?>
						<div class="ph dark" data-label="<?php echo esc_attr( $img ); ?>"></div>
					<?php endif; ?>
					<div class="body">
						<h3 data-en="<?php echo esc_attr( $title ); ?>" data-hi="<?php echo esc_attr( $title_hi ); ?>"><?php echo esc_html( $title ); ?></h3>
						<p><?php echo esc_html( $desc ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="adm-cta">
		<div class="container reveal" style="text-align:center;padding:clamp(56px,7vw,90px) 28px">
			<span class="eyebrow center light" data-en="Ready to Begin?" data-hi="शुरू करने को तैयार?"><?php esc_html_e( 'Ready to Begin?', 'excellence-school' ); ?></span>
			<h2 style="color:#fff;font-size:clamp(36px,5vw,58px);margin:16px auto 0;max-width:18ch"
			    data-en="<?php echo esc_attr( $cta_h2 ); ?>" data-hi="हमारे साथ अपना भविष्य बनाएं">
				<?php echo esc_html( $cta_h2 ); ?>
			</h2>
			<div class="cta-row" style="display:flex;justify-content:center;gap:16px;flex-wrap:wrap;margin-top:32px">
				<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>" class="btn btn-gold btn-arrow"
				   data-en="Apply for Admission" data-hi="प्रवेश हेतु आवेदन">
					<?php esc_html_e( 'Apply for Admission', 'excellence-school' ); ?>
				</a>
				<a href="<?php echo esc_url( home_url( '/#contact' ) ); ?>" class="btn btn-ghost-light"
				   data-en="Contact Us" data-hi="संपर्क करें">
					<?php esc_html_e( 'Contact Us', 'excellence-school' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>

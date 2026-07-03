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
		$item_hi = esb_pg_hi( "acad_{$slug}_item_{$idx}", $cfg['item_hi'][ $n ] );
		$items[] = [ $item_en, $item_hi ];
	}
	$streams[] = [
		'en'    => $stream_name,
		'hi'    => esb_pg_hi( "acad_{$slug}_name", $cfg['hi'] ),
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
		esb_pg_hi( "acad_app_{$i}_title", $hi ),
		esb_pg( "acad_app_{$i}_desc",  $desc_en ),
		esb_pg_hi( "acad_app_{$i}_desc", $desc_hi ),
	];
}

/* Curriculum levels (Classes I-XII) */
$curr_intro = esb_pg( 'acad_curr_intro', 'Our curriculum follows the Madhya Pradesh Board of Secondary Education (MPBSE) syllabus for Classes I-XII, aligned with the National Curriculum Framework (NCF), the National Education Policy (NEP) 2020 and NCERT standards — building a strong foundation from the primary years through to board-exam success.' );

$level_defaults = [
	1 => [
		'Primary — Classes I-V', 'प्राथमिक — कक्षा I-V',
		'Foundational literacy, numeracy and environmental awareness through activity-based, NEP-aligned learning.',
		'गतिविधि-आधारित, एनईपी-अनुरूप शिक्षण के माध्यम से बुनियादी साक्षरता, अंकगणित व पर्यावरणीय जागरूकता।',
	],
	2 => [
		'Middle — Classes VI-VIII', 'मध्य — कक्षा VI-VIII',
		'Subject-wise teaching begins, building conceptual understanding in Science, Mathematics, Social Science, Hindi and English.',
		'विषयवार शिक्षण आरंभ — विज्ञान, गणित, सामाजिक विज्ञान, हिंदी व अंग्रेजी में वैचारिक समझ का निर्माण।',
	],
	3 => [
		'Secondary — Classes IX-X', 'माध्यमिक — कक्षा IX-X',
		'Focused preparation for MP Board (MPBSE) Class X examinations, with regular tests and NCERT-based teaching.',
		'एमपी बोर्ड (एमपीबीएसई) कक्षा 10 परीक्षाओं की केंद्रित तैयारी, नियमित परीक्षण व एनसीईआरटी-आधारित शिक्षण के साथ।',
	],
	4 => [
		'Senior Secondary — Classes XI-XII', 'वरिष्ठ माध्यमिक — कक्षा XI-XII',
		'Specialisation in Science, Commerce or Humanities streams with board-exam and competitive-exam coaching.',
		'विज्ञान, वाणिज्य या मानविकी संकाय में विशेषज्ञता, बोर्ड व प्रतियोगी परीक्षा कोचिंग के साथ।',
	],
];
$levels = [];
foreach ( $level_defaults as $i => [ $name_en, $name_hi, $desc_en, $desc_hi ] ) {
	$levels[] = [
		'name_en' => esb_pg( "acad_level_{$i}_name", $name_en ),
		'name_hi' => esb_pg_hi( "acad_level_{$i}_name", $name_hi ),
		'desc_en' => esb_pg( "acad_level_{$i}_desc", $desc_en ),
		'desc_hi' => esb_pg_hi( "acad_level_{$i}_desc", $desc_hi ),
	];
}

/* Examination pattern */
$exam_defaults = [
	1 => [
		'Periodic Tests', 'आवधिक परीक्षण',
		'Regular class tests are held throughout the year to track progress and identify areas needing extra attention.',
		'वर्ष भर नियमित कक्षा परीक्षण आयोजित किए जाते हैं ताकि प्रगति पर नज़र रखी जा सके और अतिरिक्त ध्यान देने योग्य विषयों की पहचान हो सके।',
	],
	2 => [
		'Half-Yearly Examinations', 'अर्ध-वार्षिक परीक्षा',
		'A comprehensive mid-term exam assesses learning from the first half of the academic syllabus.',
		'एक व्यापक अर्ध-वार्षिक परीक्षा शैक्षणिक पाठ्यक्रम के पहले भाग के अधिगम का आकलन करती है।',
	],
	3 => [
		'Annual / Board Examinations', 'वार्षिक / बोर्ड परीक्षा',
		'Final examinations cover the full syllabus — conducted by the school for Classes I-IX & XI, and by MPBSE for Classes X & XII.',
		'अंतिम परीक्षाएं पूरे पाठ्यक्रम को कवर करती हैं — कक्षा I-IX व XI के लिए विद्यालय द्वारा, तथा कक्षा X व XII के लिए एमपीबीएसई द्वारा आयोजित।',
	],
];
$exams = [];
foreach ( $exam_defaults as $i => [ $title_en, $title_hi, $desc_en, $desc_hi ] ) {
	$exams[] = [
		'title_en' => esb_pg( "acad_exam_{$i}_title", $title_en ),
		'title_hi' => esb_pg_hi( "acad_exam_{$i}_title", $title_hi ),
		'desc_en'  => esb_pg( "acad_exam_{$i}_desc", $desc_en ),
		'desc_hi'  => esb_pg_hi( "acad_exam_{$i}_desc", $desc_hi ),
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
		'hi'  => esb_pg_hi( "acad_bar_{$i}_label", $hi ),
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
		esb_pg_hi( "acad_fac_{$i}_title", $hi ),
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
			<h1 data-en="<?php echo esc_attr( $hero_h1 ); ?>" data-hi="<?php echo esc_attr( esb_pg_hi( 'acad_hero_h1', 'असीमित अधिगम' ) ); ?>"><?php echo esc_html( $hero_h1 ); ?></h1>
			<p data-en="<?php echo esc_attr( $hero_sub ); ?>"
			   data-hi="<?php echo esc_attr( esb_pg_hi( 'acad_hero_sub', 'विज्ञान, वाणिज्य व मानविकी में कठोर, भविष्य-तैयार पाठ्यक्रम।' ) ); ?>">
				<?php echo esc_html( $hero_sub ); ?>
			</p>
		</div>
	</section>

	<!-- Curriculum Across Classes -->
	<section class="section">
		<div class="container">
			<div class="section-head reveal">
				<span class="eyebrow" data-en="Curriculum" data-hi="पाठ्यक्रम"><?php esc_html_e( 'Curriculum', 'excellence-school' ); ?></span>
				<h2 data-en="A Continuum From Class I to XII" data-hi="कक्षा I से XII तक की निरंतरता"><?php esc_html_e( 'A Continuum From Class I to XII', 'excellence-school' ); ?></h2>
				<p data-en="<?php echo esc_attr( $curr_intro ); ?>"
				   data-hi="<?php echo esc_attr( esb_pg_hi( 'acad_curr_intro', 'हमारा पाठ्यक्रम कक्षा I-XII के लिए मध्य प्रदेश माध्यमिक शिक्षा मंडल (एमपीबीएसई) के पाठ्यक्रम पर आधारित है, जो राष्ट्रीय पाठ्यचर्या रूपरेखा (एनसीएफ), राष्ट्रीय शिक्षा नीति (एनईपी) 2020 व एनसीईआरटी मानकों के अनुरूप है — जो प्राथमिक वर्षों से लेकर बोर्ड परीक्षा की सफलता तक एक मजबूत आधार तैयार करता है।' ) ); ?>">
					<?php echo esc_html( $curr_intro ); ?>
				</p>
			</div>
			<div class="grid levels-grid">
				<?php foreach ( $levels as $level ) : ?>
				<div class="card level-card reveal">
					<div class="n" data-en="<?php echo esc_attr( $level['name_en'] ); ?>" data-hi="<?php echo esc_attr( $level['name_hi'] ); ?>"><?php echo esc_html( $level['name_en'] ); ?></div>
					<p data-en="<?php echo esc_attr( $level['desc_en'] ); ?>" data-hi="<?php echo esc_attr( $level['desc_hi'] ); ?>"><?php echo esc_html( $level['desc_en'] ); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
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

	<!-- Examination Pattern -->
	<section class="section">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center" data-en="Assessment" data-hi="मूल्यांकन"><?php esc_html_e( 'Assessment', 'excellence-school' ); ?></span>
				<h2 data-en="Examination Pattern" data-hi="परीक्षा प्रणाली"><?php esc_html_e( 'Examination Pattern', 'excellence-school' ); ?></h2>
			</div>
			<div class="grid examp-grid">
				<?php foreach ( $exams as $exam ) : ?>
				<div class="card approach-card reveal">
					<div class="ic"><span class="diamond"></span></div>
					<h3 data-en="<?php echo esc_attr( $exam['title_en'] ); ?>" data-hi="<?php echo esc_attr( $exam['title_hi'] ); ?>"><?php echo esc_html( $exam['title_en'] ); ?></h3>
					<p data-en="<?php echo esc_attr( $exam['desc_en'] ); ?>" data-hi="<?php echo esc_attr( $exam['desc_hi'] ); ?>"><?php echo esc_html( $exam['desc_en'] ); ?></p>
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
					   data-hi="<?php echo esc_attr( esb_pg_hi( 'acad_results_desc', 'हमारे परिणाम अनुशासित तैयारी, व्यक्तिगत ध्यान व उच्च अपेक्षाओं की संस्कृति को दर्शाते हैं।' ) ); ?>">
						<?php echo esc_html( $results_desc ); ?>
					</p>
					<div style="display:flex;gap:14px;flex-wrap:wrap;margin-top:24px">
						<?php
						$pill_defaults = [
							1 => [ 'District Toppers', 'जिला टॉपर' ],
							2 => [ '95%+ Scorers', '95%+ अंक' ],
							3 => [ 'State Merit List', 'राज्य मेरिट सूची' ],
						];
						foreach ( $pill_defaults as $i => [ $pill_en_default, $pill_hi_default ] ) :
							$pill_en  = esb_pg( "acad_pill_{$i}_en", $pill_en_default );
							$pill_hi  = esb_pg( "acad_pill_{$i}_hi", $pill_hi_default );
							$pill_url = esb_pg( "acad_pill_{$i}_url", '' );
							$tag      = $pill_url ? 'a' : 'span';
						?>
						<<?php echo esc_html( $tag ); ?> class="pill gold"<?php echo $pill_url ? ' href="' . esc_url( $pill_url ) . '"' : ''; ?> data-en="<?php echo esc_attr( $pill_en ); ?>" data-hi="<?php echo esc_attr( $pill_hi ); ?>"><?php echo esc_html( $pill_en ); ?></<?php echo esc_html( $tag ); ?>>
						<?php endforeach; ?>
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
			    data-en="<?php echo esc_attr( $cta_h2 ); ?>" data-hi="<?php echo esc_attr( esb_pg_hi( 'acad_cta_h2', 'हमारे साथ अपना भविष्य बनाएं' ) ); ?>">
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

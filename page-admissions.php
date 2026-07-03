<?php
/**
 * Template Name: Admissions
 * Admissions page template
 *
 * @package excellence-school
 */
get_header();
$phone   = esb_opt( 'esb_phone', '+91 982-645-4530' );
$email   = esb_opt( 'esb_email', 'principalgovtsubhash@excellencebhopal.in' );
$address = esb_opt( 'esb_address', 'Subhash Shivaji Nagar, Bhopal, Madhya Pradesh – 462016' );
$year    = (int) gmdate( 'Y' );
$desk_id  = (int) get_theme_mod( 'esb_admissions_desk_image', 0 );
$desk_url = $desk_id ? wp_get_attachment_image_url( $desk_id, 'large' ) : '';

$sent = isset( $_GET['enquiry'] ) && 'sent' === sanitize_key( wp_unslash( $_GET['enquiry'] ?? '' ) );

/* Page content */
$hero_sub = esb_pg( 'adm_hero_sub', 'Join a community where every child is challenged, supported and inspired to excel. Applications for Classes IX to XII are now open.' );
$cta_h2   = esb_pg( 'adm_cta_h2',  "Secure Your Child's Seat Today" );

/* Steps */
$step_defaults = [
	1 => [ 'Enquire',           'पूछताछ',            'Submit the enquiry form below or visit the school office to register your interest.',      'नीचे दिया फॉर्म भरें या रुचि दर्ज करने हेतु विद्यालय कार्यालय आएं।' ],
	2 => [ 'Submit Documents',  'दस्तावेज जमा करें', 'Provide the required documents and the completed admission form at the office.',           'आवश्यक दस्तावेज व भरा हुआ प्रवेश फॉर्म कार्यालय में जमा करें।' ],
	3 => [ 'Interaction',       'वार्तालाप',           'A short interaction or entry assessment for the chosen class and stream.',                 'चयनित कक्षा व संकाय हेतु संक्षिप्त वार्तालाप या प्रवेश मूल्यांकन।' ],
	4 => [ 'Confirmation',      'पुष्टि',              'On selection, complete enrolment formalities and welcome to the family!',                  'चयन पर, नामांकन औपचारिकताएं पूरी करें और परिवार में स्वागत है!' ],
];
$steps = [];
foreach ( $step_defaults as $i => [ $en, $hi, $desc_en, $desc_hi ] ) {
	$steps[] = [
		(string) $i,
		esb_pg( "adm_step_{$i}_title", $en ),
		esb_pg_hi( "adm_step_{$i}_title", $hi ),
		esb_pg( "adm_step_{$i}_desc",  $desc_en ),
		esb_pg_hi( "adm_step_{$i}_desc", $desc_hi ),
	];
}

/* Eligibility */
$elig_defaults = [
	1 => [ 'Class IX – X',          'कक्षा 9 – 10',        'Passed previous class',        'पिछली कक्षा उत्तीर्ण' ],
	2 => [ 'Class XI – Science',    'कक्षा 11 – विज्ञान',  'Class X with required %',      'कक्षा 10 आवश्यक % सहित' ],
	3 => [ 'Class XI – Commerce',   'कक्षा 11 – वाणिज्य',  'Class X passed',               'कक्षा 10 उत्तीर्ण' ],
	4 => [ 'Class XI – Humanities', 'कक्षा 11 – मानविकी',  'Class X passed',               'कक्षा 10 उत्तीर्ण' ],
];
$elig = [];
foreach ( $elig_defaults as $i => [ $k_en, $k_hi, $v_en, $v_hi ] ) {
	$elig[] = [
		esb_pg( "adm_elig_{$i}_class", $k_en ),
		esb_pg_hi( "adm_elig_{$i}_class", $k_hi ),
		esb_pg( "adm_elig_{$i}_req",   $v_en ),
		esb_pg_hi( "adm_elig_{$i}_req", $v_hi ),
	];
}

/* Documents */
$doc_defaults = [
	1 => "Previous year's marksheet / report card",
	2 => 'Transfer Certificate (TC) from previous school',
	3 => 'Aadhaar card of student',
	4 => 'Birth certificate (for Class IX)',
	5 => 'Caste / income certificate (if applicable)',
	6 => 'Passport-size photographs (4)',
];
$doc_hi = [
	1 => 'पिछले वर्ष की अंकसूची / रिपोर्ट कार्ड',
	2 => 'पिछले विद्यालय का स्थानांतरण प्रमाणपत्र (टीसी)',
	3 => 'विद्यार्थी का आधार कार्ड',
	4 => 'जन्म प्रमाणपत्र (कक्षा 9 हेतु)',
	5 => 'जाति / आय प्रमाणपत्र (यदि लागू)',
	6 => 'पासपोर्ट आकार के फोटो (4)',
];
$docs = [];
foreach ( $doc_defaults as $i => $en ) {
	$text = esb_pg( "adm_doc_{$i}", $en );
	if ( '' !== $text ) {
		$docs[] = [ $text, esb_pg_hi( "adm_doc_{$i}", $doc_hi[ $i ] ) ];
	}
}

/* Dates */
$date_defaults = [
	1 => [ 'Jun', 'जून', '15', 'Applications Open',   'आवेदन प्रारंभ',         'Enquiry & forms available at the office and online.',  'पूछताछ व फॉर्म कार्यालय व ऑनलाइन उपलब्ध।' ],
	2 => [ 'Jul', 'जुल', '10', 'Last Date to Apply',  'आवेदन की अंतिम तिथि',  'Submit completed forms with all documents.',            'सभी दस्तावेजों सहित भरे फॉर्म जमा करें।' ],
	3 => [ 'Jul', 'जुल', '20', 'Session Begins',      'सत्र प्रारंभ',           'New academic session commences.',                      'नया शैक्षणिक सत्र प्रारंभ।' ],
];
$dates = [];
foreach ( $date_defaults as $i => [ $m_en, $m_hi, $def_day, $def_title_en, $title_hi, $def_desc_en, $desc_hi ] ) {
	$month    = esb_pg( "adm_date_{$i}_month", $m_en );
	$day      = esb_pg( "adm_date_{$i}_day",   $def_day );
	$title_en = esb_pg( "adm_date_{$i}_title", $def_title_en );
	$desc_en  = esb_pg( "adm_date_{$i}_desc",  $def_desc_en );
	if ( '' !== $month || '' !== $title_en ) {
		$dates[] = [
			$month,
			esb_pg_hi( "adm_date_{$i}_month", $m_hi ),
			$day,
			$title_en,
			esb_pg_hi( "adm_date_{$i}_title", $title_hi ),
			$desc_en,
			esb_pg_hi( "adm_date_{$i}_desc", $desc_hi ),
		];
	}
}

/* FAQs */
$faq_defaults = [
	1 => [ 'Is this a government school?', 'क्या यह शासकीय विद्यालय है?', 'Yes. We are a designated Government School of Excellence under the Department of School Education, Madhya Pradesh, affiliated with the MP Board of Secondary Education.', 'हाँ। हम स्कूल शिक्षा विभाग, मध्य प्रदेश के अंतर्गत एक नामित शासकीय उत्कृष्टता विद्यालय हैं।' ],
	2 => [ 'Which classes can I apply for?', 'मैं किन कक्षाओं में आवेदन कर सकता हूँ?', 'Admissions are offered for Classes IX to XII, with Science, Commerce and Humanities streams at the higher secondary level (XI–XII).', 'कक्षा 9 से 12 तक प्रवेश दिया जाता है।' ],
	3 => [ 'Is hostel accommodation available?', 'क्या छात्रावास सुविधा उपलब्ध है?', 'Yes, a safe and disciplined hostel facility is available for eligible students from outside Bhopal, subject to availability. Please enquire at the office for details.', 'हाँ, पात्र विद्यार्थियों हेतु छात्रावास सुविधा उपलब्ध है।' ],
	4 => [ 'How will I be informed about selection?', 'चयन की सूचना कैसे मिलेगी?', 'Our admissions team will contact you by phone or email after the document verification and interaction stage.', 'हमारी प्रवेश टीम फोन या ईमेल से संपर्क करेगी।' ],
	5 => [ '', '', '', '' ],
	6 => [ '', '', '', '' ],
];
$faqs = [];
foreach ( $faq_defaults as $i => [ $q_en, $q_hi, $a_en, $a_hi ] ) {
	$q = esb_pg( "adm_faq_{$i}_q", $q_en );
	$a = esb_pg( "adm_faq_{$i}_a", $a_en );
	if ( '' !== $q && '' !== $a ) {
		$faqs[] = [ $q, esb_pg_hi( "adm_faq_{$i}_q", $q_hi ), $a, esb_pg_hi( "adm_faq_{$i}_a", $a_hi ) ];
	}
}
?>
<main id="main">

	<!-- Page Hero -->
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span data-en="Admissions" data-hi="प्रवेश"><?php esc_html_e( 'Admissions', 'excellence-school' ); ?></span>
			</div>
			<span class="pill gold" style="margin-bottom:14px"
			      data-en="Admissions Open · <?php echo esc_attr( $year . '–' . ( $year + 1 ) ); ?>"
			      data-hi="प्रवेश प्रारंभ · <?php echo esc_attr( $year . '–' . ( $year + 1 ) ); ?>">
				<?php echo esc_html( 'Admissions Open · ' . $year . '–' . ( $year + 1 ) ); ?>
			</span>
			<h1 data-en="Admissions <?php echo esc_attr( $year . '–' . ( $year + 1 ) ); ?>"
			    data-hi="प्रवेश <?php echo esc_attr( $year . '–' . ( $year + 1 ) ); ?>">
				<?php echo esc_html( 'Admissions ' . $year . '–' . ( $year + 1 ) ); ?>
			</h1>
			<p data-en="<?php echo esc_attr( $hero_sub ); ?>"
			   data-hi="<?php echo esc_attr( esb_pg_hi( 'adm_hero_sub', 'एक ऐसे समुदाय से जुड़ें जहाँ हर बच्चे को चुनौती, सहयोग व उत्कृष्टता की प्रेरणा मिलती है।' ) ); ?>">
				<?php echo esc_html( $hero_sub ); ?>
			</p>
			<div class="cta-row" style="display:flex;gap:16px;flex-wrap:wrap;margin-top:30px">
				<a href="#apply" class="btn btn-gold btn-arrow" data-en="Start Application" data-hi="आवेदन शुरू करें">
					<?php esc_html_e( 'Start Application', 'excellence-school' ); ?>
				</a>
				<a href="#dates" class="btn btn-ghost-light" data-en="Important Dates" data-hi="महत्वपूर्ण तिथियां">
					<?php esc_html_e( 'Important Dates', 'excellence-school' ); ?>
				</a>
			</div>
		</div>
	</section>

	<!-- Steps -->
	<section class="section">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center" data-en="How to Apply" data-hi="आवेदन कैसे करें"><?php esc_html_e( 'How to Apply', 'excellence-school' ); ?></span>
				<h2 data-en="Four Simple Steps" data-hi="चार सरल चरण"><?php esc_html_e( 'Four Simple Steps', 'excellence-school' ); ?></h2>
			</div>
			<div class="steps-grid">
				<?php foreach ( $steps as [ $num, $en, $hi, $desc_en, $desc_hi ] ) : ?>
				<div class="card step-card reveal">
					<div class="n"><?php echo esc_html( str_pad( $num, 2, '0', STR_PAD_LEFT ) ); ?></div>
					<h3 data-en="<?php echo esc_attr( $en ); ?>" data-hi="<?php echo esc_attr( $hi ); ?>"><?php echo esc_html( $en ); ?></h3>
					<p data-en="<?php echo esc_attr( $desc_en ); ?>" data-hi="<?php echo esc_attr( $desc_hi ); ?>"><?php echo esc_html( $desc_en ); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Eligibility & Documents -->
	<section class="section elig">
		<div class="container">
			<div class="elig-grid">
				<div class="reveal">
					<span class="eyebrow" data-en="Eligibility" data-hi="पात्रता"><?php esc_html_e( 'Eligibility', 'excellence-school' ); ?></span>
					<h2 style="font-size:clamp(30px,4vw,44px);margin-top:14px" data-en="Classes &amp; Streams" data-hi="कक्षाएं व संकाय"><?php esc_html_e( 'Classes & Streams', 'excellence-school' ); ?></h2>
					<p class="muted" style="margin-top:14px;margin-bottom:26px"
					   data-en="Admissions are offered for the following classes for the <?php echo esc_attr( $year . '–' . ( $year + 1 ) ); ?> academic session, subject to seat availability and departmental norms."
					   data-hi="शैक्षणिक सत्र हेतु निम्न कक्षाओं में प्रवेश।">
						<?php echo esc_html( 'Admissions are offered for the following classes for the ' . $year . '–' . ( $year + 1 ) . ' academic session, subject to seat availability and departmental norms.' ); ?>
					</p>
					<div class="elig-table">
						<div class="elig-row head">
							<span class="k" data-en="Class" data-hi="कक्षा"><?php esc_html_e( 'Class', 'excellence-school' ); ?></span>
							<span class="v" data-en="Eligibility" data-hi="पात्रता"><?php esc_html_e( 'Eligibility', 'excellence-school' ); ?></span>
						</div>
						<?php foreach ( $elig as [ $k_en, $k_hi, $v_en, $v_hi ] ) : ?>
						<div class="elig-row">
							<span class="k" data-en="<?php echo esc_attr( $k_en ); ?>" data-hi="<?php echo esc_attr( $k_hi ); ?>"><?php echo esc_html( $k_en ); ?></span>
							<span class="v" data-en="<?php echo esc_attr( $v_en ); ?>" data-hi="<?php echo esc_attr( $v_hi ); ?>"><?php echo esc_html( $v_en ); ?></span>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="reveal">
					<span class="eyebrow" data-en="Documents Required" data-hi="आवश्यक दस्तावेज"><?php esc_html_e( 'Documents Required', 'excellence-school' ); ?></span>
					<h2 style="font-size:clamp(30px,4vw,44px);margin-top:14px;margin-bottom:24px" data-en="What to Bring" data-hi="क्या लाएं"><?php esc_html_e( 'What to Bring', 'excellence-school' ); ?></h2>
					<ul class="doc-list">
						<?php foreach ( $docs as [ $en, $hi ] ) : ?>
						<li>
							<span class="diamond"></span>
							<span data-en="<?php echo esc_attr( $en ); ?>" data-hi="<?php echo esc_attr( $hi ); ?>"><?php echo esc_html( $en ); ?></span>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</section>

	<!-- Important Dates -->
	<?php if ( ! empty( $dates ) ) : ?>
	<section class="section" id="dates">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center" data-en="Important Dates" data-hi="महत्वपूर्ण तिथियां"><?php esc_html_e( 'Important Dates', 'excellence-school' ); ?></span>
				<h2 data-en="Mark Your Calendar" data-hi="कैलेंडर में अंकित करें"><?php esc_html_e( 'Mark Your Calendar', 'excellence-school' ); ?></h2>
			</div>
			<div class="dates-grid">
				<?php foreach ( $dates as [ $m_en, $m_hi, $d, $title_en, $title_hi, $desc_en, $desc_hi ] ) : ?>
				<div class="card date-card reveal">
					<div class="cal">
						<div class="m" data-en="<?php echo esc_attr( $m_en ); ?>" data-hi="<?php echo esc_attr( $m_hi ); ?>"><?php echo esc_html( $m_en ); ?></div>
						<div class="d"><?php echo esc_html( $d ); ?></div>
					</div>
					<div>
						<h3 data-en="<?php echo esc_attr( $title_en ); ?>" data-hi="<?php echo esc_attr( $title_hi ); ?>"><?php echo esc_html( $title_en ); ?></h3>
						<p data-en="<?php echo esc_attr( $desc_en ); ?>" data-hi="<?php echo esc_attr( $desc_hi ); ?>"><?php echo esc_html( $desc_en ); ?></p>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- Enquiry Form -->
	<section class="section" id="apply" style="background:var(--cream)">
		<div class="container">
			<div class="apply-grid">
				<div class="reveal">
					<span class="eyebrow" data-en="Admission Enquiry" data-hi="प्रवेश पूछताछ"><?php esc_html_e( 'Admission Enquiry', 'excellence-school' ); ?></span>
					<h2 style="font-size:clamp(32px,4.5vw,50px);margin-top:14px" data-en="Begin Your Application" data-hi="अपना आवेदन शुरू करें"><?php esc_html_e( 'Begin Your Application', 'excellence-school' ); ?></h2>

					<?php if ( $sent ) : ?>
					<div class="form-card" style="margin-top:24px;color:var(--green-700);font-weight:600;text-align:center;padding:40px">
						<?php esc_html_e( '✓ Thank you! Our admissions team will contact you shortly.', 'excellence-school' ); ?>
					</div>
					<?php else : ?>
					<form class="form-card" style="margin-top:24px" method="post" action="">
						<?php wp_nonce_field( 'esb_enquiry_submit', 'esb_enquiry_nonce' ); ?>
						<div class="form-row">
							<div class="field">
								<label for="enquiry_student" data-en="Student's Name" data-hi="विद्यार्थी का नाम"><?php esc_html_e( "Student's Name", 'excellence-school' ); ?></label>
								<input type="text" id="enquiry_student" name="enquiry_student" placeholder="Full name" required />
							</div>
							<div class="field">
								<label for="enquiry_name" data-en="Parent's Name" data-hi="अभिभावक का नाम"><?php esc_html_e( "Parent's Name", 'excellence-school' ); ?></label>
								<input type="text" id="enquiry_name" name="enquiry_name" placeholder="Full name" required />
							</div>
						</div>
						<div class="form-row">
							<div class="field">
								<label for="enquiry_phone" data-en="Phone" data-hi="फोन"><?php esc_html_e( 'Phone', 'excellence-school' ); ?></label>
								<input type="tel" id="enquiry_phone" name="enquiry_phone" placeholder="+91" required />
							</div>
							<div class="field">
								<label for="enquiry_email" data-en="Email" data-hi="ईमेल"><?php esc_html_e( 'Email', 'excellence-school' ); ?></label>
								<input type="email" id="enquiry_email" name="enquiry_email" placeholder="you@email.com" />
							</div>
						</div>
						<div class="form-row">
							<div class="field">
								<label for="enquiry_class" data-en="Class Applying For" data-hi="आवेदित कक्षा"><?php esc_html_e( 'Class Applying For', 'excellence-school' ); ?></label>
								<select id="enquiry_class" name="enquiry_class">
									<option><?php esc_html_e( 'Class IX', 'excellence-school' ); ?></option>
									<option><?php esc_html_e( 'Class X', 'excellence-school' ); ?></option>
									<option><?php esc_html_e( 'Class XI', 'excellence-school' ); ?></option>
									<option><?php esc_html_e( 'Class XII', 'excellence-school' ); ?></option>
								</select>
							</div>
							<div class="field">
								<label for="enquiry_stream" data-en="Stream (XI–XII)" data-hi="संकाय (11–12)"><?php esc_html_e( 'Stream (XI–XII)', 'excellence-school' ); ?></label>
								<select id="enquiry_stream" name="enquiry_stream">
									<option><?php esc_html_e( 'Science', 'excellence-school' ); ?></option>
									<option><?php esc_html_e( 'Commerce', 'excellence-school' ); ?></option>
									<option><?php esc_html_e( 'Humanities', 'excellence-school' ); ?></option>
									<option><?php esc_html_e( 'Not applicable', 'excellence-school' ); ?></option>
								</select>
							</div>
						</div>
						<div class="field">
							<label for="enquiry_message" data-en="Message (optional)" data-hi="संदेश (वैकल्पिक)"><?php esc_html_e( 'Message (optional)', 'excellence-school' ); ?></label>
							<textarea id="enquiry_message" name="enquiry_message" rows="3" placeholder="<?php esc_attr_e( "Anything you'd like us to know", 'excellence-school' ); ?>"></textarea>
						</div>
						<button type="submit" class="btn btn-gold btn-arrow" style="width:100%"
						        data-en="Submit Enquiry" data-hi="पूछताछ भेजें">
							<?php esc_html_e( 'Submit Enquiry', 'excellence-school' ); ?>
						</button>
						<p class="form-note" data-en="For confirmed admissions, please visit the school office." data-hi="पुष्ट प्रवेश हेतु कृपया विद्यालय कार्यालय आएं।">
							<?php esc_html_e( 'For confirmed admissions, please visit the school office.', 'excellence-school' ); ?>
						</p>
					</form>
					<?php endif; ?>
				</div>

				<div class="apply-aside reveal">
					<?php if ( $desk_url ) : ?>
						<div style="height:260px; border-radius:var(--r-lg); overflow:hidden; margin-bottom:24px;">
							<img src="<?php echo esc_url( $desk_url ); ?>" alt="<?php esc_attr_e( 'Admissions desk help', 'excellence-school' ); ?>" style="object-fit:cover; width:100%; height:100%;" />
						</div>
					<?php else : ?>
						<div class="ph" data-label="admissions-desk.jpg — 640×420"></div>
					<?php endif; ?>
					<h3 data-en="Need Help Applying?" data-hi="आवेदन में सहायता चाहिए?"><?php esc_html_e( 'Need Help Applying?', 'excellence-school' ); ?></h3>
					<p data-en="Our admissions team is happy to guide you through eligibility, documents and the process. Walk in during office hours or call us directly."
					   data-hi="हमारी प्रवेश टीम मार्गदर्शन के लिए तत्पर है।">
						<?php esc_html_e( 'Our admissions team is happy to guide you through eligibility, documents and the process. Walk in during office hours or call us directly.', 'excellence-school' ); ?>
					</p>
					<div class="help-box">
						<h4 data-en="Admissions Office" data-hi="प्रवेश कार्यालय"><?php esc_html_e( 'Admissions Office', 'excellence-school' ); ?></h4>
						<p data-en="<?php echo esc_attr( $address ); ?>"><?php echo esc_html( $address ); ?></p>
						<p style="margin-top:12px">
							<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
						</p>
						<p><a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a></p>
						<p style="margin-top:12px" data-en="Mon – Sat · 8:00 AM – 4:00 PM" data-hi="सोम – शनि · प्रातः 8 – सायं 4">
							<?php esc_html_e( 'Mon – Sat · 8:00 AM – 4:00 PM', 'excellence-school' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- FAQ -->
	<?php if ( ! empty( $faqs ) ) : ?>
	<section class="section">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center" data-en="FAQ" data-hi="सामान्य प्रश्न"><?php esc_html_e( 'FAQ', 'excellence-school' ); ?></span>
				<h2 data-en="Questions, Answered" data-hi="प्रश्न, उत्तर सहित"><?php esc_html_e( 'Questions, Answered', 'excellence-school' ); ?></h2>
			</div>
			<div class="faq-grid reveal">
				<?php foreach ( $faqs as [ $q_en, $q_hi, $a_en, $a_hi ] ) : ?>
				<details class="faq">
					<summary data-en="<?php echo esc_attr( $q_en ); ?>" data-hi="<?php echo esc_attr( $q_hi ); ?>"><?php echo esc_html( $q_en ); ?></summary>
					<div class="faq-body" data-en="<?php echo esc_attr( $a_en ); ?>" data-hi="<?php echo esc_attr( $a_hi ); ?>"><?php echo esc_html( $a_en ); ?></div>
				</details>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<!-- Bottom CTA -->
	<section class="adm-cta">
		<div class="container reveal" style="text-align:center;padding:clamp(56px,7vw,90px) 28px">
			<span class="eyebrow center light" data-en="Limited Seats" data-hi="सीमित सीटें"><?php esc_html_e( 'Limited Seats', 'excellence-school' ); ?></span>
			<h2 style="color:#fff;font-size:clamp(36px,5vw,58px);margin:16px auto 0;max-width:18ch"
			    data-en="<?php echo esc_attr( $cta_h2 ); ?>" data-hi="<?php echo esc_attr( esb_pg_hi( 'adm_cta_h2', 'आज ही अपने बच्चे की सीट सुरक्षित करें' ) ); ?>">
				<?php echo esc_html( $cta_h2 ); ?>
			</h2>
			<div class="cta-row" style="display:flex;justify-content:center;gap:16px;flex-wrap:wrap;margin-top:32px">
				<a href="#apply" class="btn btn-gold btn-arrow" data-en="Start Application" data-hi="आवेदन शुरू करें">
					<?php esc_html_e( 'Start Application', 'excellence-school' ); ?>
				</a>
				<a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"
				   class="btn btn-ghost-light" data-en="Call Admissions" data-hi="प्रवेश हेतु कॉल करें">
					<?php esc_html_e( 'Call Admissions', 'excellence-school' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>

<?php
/**
 * Template Name: About
 * About page template
 *
 * @package excellence-school
 */
get_header();
$principal_name  = esb_opt( 'esb_principal_name', 'Mr. Sudhakar Parashar' );
$principal_role  = esb_opt( 'esb_principal_role', 'Principal, Govt. Subhash Excellence H.S. School, Bhopal' );
$portrait_id     = (int) get_theme_mod( 'esb_principal_image', 0 );
$portrait_url    = $portrait_id ? wp_get_attachment_image_url( $portrait_id, 'large' ) : '';
$heritage_id     = (int) get_theme_mod( 'esb_about_heritage_image', 0 );
$heritage_url    = $heritage_id ? wp_get_attachment_image_url( $heritage_id, 'large' ) : '';
$estd            = esb_opt( 'esb_estd', '1965' );
$students        = esb_opt( 'esb_stat_students', '2000' );
$faculty         = esb_opt( 'esb_stat_faculty', '70' );
$years           = (int) gmdate( 'Y' ) - (int) $estd;

/* Page content */
$hero_h1     = esb_pg( 'about_hero_h1',   'A Legacy of Public Excellence' );
$hero_sub    = esb_pg( 'about_hero_sub',  'A premier government institution under the Department of School Education, Madhya Pradesh — committed to world-class learning for every child.' );
$story_h2    = esb_pg( 'about_story_h2',  'A Six-Decade Legacy of Distinction' );
$story_lead  = esb_pg( 'about_story_lead', 'Established in ' . $estd . ', the Govt. Higher Secondary School for Excellence, Subhash Shivaji Nagar, was created with a singular vision — to deliver the standard of India\'s finest schools within the public system.' );
$story_body  = esb_pg( 'about_story_body', 'Affiliated with the MP Board of Secondary Education, we offer Science, Commerce and Humanities streams at the higher secondary level. With dedicated faculty, modern infrastructure and a focus on holistic growth, we nurture responsible citizens and future leaders from every section of society.' );
$vision_txt  = esb_pg( 'about_vision',    'To be a beacon of equitable, world-class education — where every learner, regardless of background, discovers their potential and rises to lead with knowledge and integrity.' );
$mission_txt = esb_pg( 'about_mission',   'To provide rigorous academics, modern facilities and value-based education that develops character, critical thinking and a lifelong love of learning in every student.' );
$pm_quote    = esb_pg( 'about_pm_quote',  "Education is the most powerful tool we can place in a child's hands. At the School for Excellence, our promise is that no dream is too large and no child is left behind." );
$pm_para     = esb_pg( 'about_pm_para',   'Over six decades, this institution has grown into a name that families across Bhopal trust. Our students walk out as confident, principled young people — toppers, athletes, innovators and, above all, good human beings.' );
$cta_h2      = esb_pg( 'about_cta_h2',   'Become Part of Our Story' );

$val_defaults = [
	1 => [ 'Excellence', 'Setting and meeting the highest standards in all we do.',                         '01' ],
	2 => [ 'Integrity',  'Honesty, discipline and fairness at the heart of our culture.',                   '02' ],
	3 => [ 'Equity',     'Quality education open and accessible to every child.',                           '03' ],
	4 => [ 'Innovation', 'Modern methods and a tinkering mindset for tomorrow.',                            '04' ],
];
$val_hi = [
	1 => [ 'उत्कृष्टता', 'हर कार्य में सर्वोच्च मानक तय करना व पूरा करना।' ],
	2 => [ 'सत्यनिष्ठा',  'ईमानदारी, अनुशासन व निष्पक्षता हमारी संस्कृति के केंद्र में।' ],
	3 => [ 'समता',        'गुणवत्तापूर्ण शिक्षा हर बच्चे के लिए सुलभ व खुली।' ],
	4 => [ 'नवाचार',      'कल के लिए आधुनिक पद्धतियाँ व नवाचार की मानसिकता।' ],
];
?>
<main id="main">

	<!-- Page Hero -->
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span data-en="About" data-hi="परिचय"><?php esc_html_e( 'About', 'excellence-school' ); ?></span>
			</div>
			<span class="eyebrow light" data-en="Since <?php echo esc_attr( $estd ); ?>" data-hi="<?php echo esc_attr( $estd ); ?> से">
				<?php echo esc_html( 'Since ' . $estd ); ?>
			</span>
			<h1 data-en="<?php echo esc_attr( $hero_h1 ); ?>" data-hi="सार्वजनिक उत्कृष्टता की विरासत">
				<?php echo esc_html( $hero_h1 ); ?>
			</h1>
			<p data-en="<?php echo esc_attr( $hero_sub ); ?>"
			   data-hi="स्कूल शिक्षा विभाग, मध्य प्रदेश के अंतर्गत एक प्रमुख शासकीय संस्थान — हर बच्चे के लिए विश्वस्तरीय शिक्षा हेतु प्रतिबद्ध।">
				<?php echo esc_html( $hero_sub ); ?>
			</p>
		</div>
	</section>

	<!-- Our Story -->
	<section class="section about-intro">
		<div class="container">
			<div class="grid2">
				<div class="reveal">
					<span class="eyebrow" data-en="Our Story" data-hi="हमारी कहानी"><?php esc_html_e( 'Our Story', 'excellence-school' ); ?></span>
					<h2 style="margin-top:16px" data-en="<?php echo esc_attr( $story_h2 ); ?>" data-hi="छह दशकों की प्रतिष्ठा">
						<?php echo esc_html( $story_h2 ); ?>
					</h2>
					<p class="lead"
					   data-en="<?php echo esc_attr( $story_lead ); ?>"
					   data-hi="<?php echo esc_attr( $estd ); ?> में स्थापित, शासकीय उच्चतर माध्यमिक उत्कृष्टता विद्यालय, सुभाष शिवाजी नगर की रचना एक ही दृष्टि से हुई।">
						<?php echo esc_html( $story_lead ); ?>
					</p>
					<p data-en="<?php echo esc_attr( $story_body ); ?>"
					   data-hi="माध्यमिक शिक्षा मंडल, म.प्र. से संबद्ध, हम उच्चतर माध्यमिक स्तर पर विज्ञान, वाणिज्य व मानविकी संकाय प्रदान करते हैं।">
						<?php echo esc_html( $story_body ); ?>
					</p>
				</div>
				<?php if ( $heritage_url ) : ?>
					<div class="reveal" style="height:460px; border-radius:var(--r-lg); overflow:hidden;">
						<img src="<?php echo esc_url( $heritage_url ); ?>" alt="<?php esc_attr_e( 'School campus entrance', 'excellence-school' ); ?>" style="object-fit:cover; width:100%; height:100%;" />
					</div>
				<?php else : ?>
					<div class="ph reveal" data-label="campus-heritage.jpg — 640×720"></div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- Vision & Mission -->
	<section class="section" style="padding-top:0">
		<div class="container">
			<div class="vm-grid">
				<div class="card vm-card reveal">
					<div class="ic"><span class="diamond"></span></div>
					<h3 data-en="Our Vision" data-hi="हमारी दृष्टि"><?php esc_html_e( 'Our Vision', 'excellence-school' ); ?></h3>
					<p data-en="<?php echo esc_attr( $vision_txt ); ?>"
					   data-hi="समतापूर्ण, विश्वस्तरीय शिक्षा का प्रकाश-स्तंभ बनना।">
						<?php echo esc_html( $vision_txt ); ?>
					</p>
				</div>
				<div class="card vm-card reveal">
					<div class="ic"><span class="diamond"></span></div>
					<h3 data-en="Our Mission" data-hi="हमारा ध्येय"><?php esc_html_e( 'Our Mission', 'excellence-school' ); ?></h3>
					<p data-en="<?php echo esc_attr( $mission_txt ); ?>"
					   data-hi="कठोर शिक्षा, आधुनिक सुविधाएं व मूल्य-आधारित शिक्षा प्रदान करना।">
						<?php echo esc_html( $mission_txt ); ?>
					</p>
				</div>
			</div>
		</div>
	</section>

	<!-- Values -->
	<section class="section" style="background:var(--cream);padding-top:clamp(56px,7vw,90px)">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center" data-en="Our Values" data-hi="हमारे मूल्य"><?php esc_html_e( 'Our Values', 'excellence-school' ); ?></span>
				<h2 data-en="The Pillars We Stand On" data-hi="जिन स्तंभों पर हम खड़े हैं"><?php esc_html_e( 'The Pillars We Stand On', 'excellence-school' ); ?></h2>
			</div>
			<div class="grid values-grid">
				<?php foreach ( $val_defaults as $i => [ $en_label, $en_desc, $num ] ) :
					$val_label = esb_pg( "about_val_{$i}_label", $en_label );
					$val_desc  = esb_pg( "about_val_{$i}_desc",  $en_desc );
					[ $hi_label, $hi_desc ] = $val_hi[ $i ];
				?>
				<div class="card value reveal">
					<div class="num"><?php echo esc_html( $num ); ?></div>
					<h4 data-en="<?php echo esc_attr( $val_label ); ?>" data-hi="<?php echo esc_attr( $hi_label ); ?>"><?php echo esc_html( $val_label ); ?></h4>
					<p data-en="<?php echo esc_attr( $val_desc ); ?>" data-hi="<?php echo esc_attr( $hi_desc ); ?>"><?php echo esc_html( $val_desc ); ?></p>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

	<!-- Principal's Message -->
	<section class="section message-block">
		<div class="container">
			<div class="grid2">
				<div class="portrait reveal">
					<?php if ( $portrait_url ) : ?>
						<img src="<?php echo esc_url( $portrait_url ); ?>" alt="<?php echo esc_attr( $principal_name ); ?>" />
					<?php else : ?>
						<div class="ph" data-label="principal.jpg — 560×680"></div>
					<?php endif; ?>
				</div>
				<div class="reveal">
					<span class="eyebrow" data-en="Principal's Message" data-hi="प्राचार्य का संदेश"><?php esc_html_e( "Principal's Message", 'excellence-school' ); ?></span>
					<blockquote style="margin-top:18px"
					            data-en="<?php echo esc_attr( $pm_quote ); ?>"
					            data-hi="शिक्षा वह सबसे शक्तिशाली साधन है जो हम किसी बच्चे के हाथ में दे सकते हैं।">
						<?php echo esc_html( $pm_quote ); ?>
					</blockquote>
					<p data-en="<?php echo esc_attr( $pm_para ); ?>"
					   data-hi="छह दशकों में यह संस्थान एक ऐसा नाम बन गया है।">
						<?php echo esc_html( $pm_para ); ?>
					</p>
					<div class="sign">
						<div class="nm" data-en="<?php echo esc_attr( $principal_name ); ?>"><?php echo esc_html( $principal_name ); ?></div>
						<div class="rl" data-en="<?php echo esc_attr( $principal_role ); ?>"><?php echo esc_html( $principal_role ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- School at a Glance -->
	<section class="glance">
		<div class="container" style="padding-top:0;padding-bottom:0">
			<div class="glance-grid reveal">
				<div>
					<div class="stat-num"><span data-count="<?php echo esc_attr( $years ); ?>">0</span></div>
					<div class="stat-label" data-en="Years of Service" data-hi="वर्षों की सेवा"><?php esc_html_e( 'Years of Service', 'excellence-school' ); ?></div>
				</div>
				<div>
					<div class="stat-num"><span data-count="<?php echo esc_attr( $students ); ?>">0</span><span class="suffix">+</span></div>
					<div class="stat-label" data-en="Students" data-hi="विद्यार्थी"><?php esc_html_e( 'Students', 'excellence-school' ); ?></div>
				</div>
				<div>
					<div class="stat-num"><span data-count="<?php echo esc_attr( $faculty ); ?>">0</span><span class="suffix">+</span></div>
					<div class="stat-label" data-en="Faculty" data-hi="शिक्षक"><?php esc_html_e( 'Faculty', 'excellence-school' ); ?></div>
				</div>
				<div>
					<div class="stat-num"><span data-count="3">0</span></div>
					<div class="stat-label" data-en="Streams Offered" data-hi="संकाय"><?php esc_html_e( 'Streams Offered', 'excellence-school' ); ?></div>
				</div>
			</div>
		</div>
	</section>

	<!-- CTA -->
	<section class="adm-cta">
		<div class="container reveal" style="text-align:center;padding:clamp(56px,7vw,90px) 28px">
			<span class="eyebrow center light" data-en="Join Us" data-hi="हमसे जुड़ें"><?php esc_html_e( 'Join Us', 'excellence-school' ); ?></span>
			<h2 style="color:#fff;font-size:clamp(36px,5vw,58px);margin:16px auto 0;max-width:18ch"
			    data-en="<?php echo esc_attr( $cta_h2 ); ?>" data-hi="हमारी कहानी का हिस्सा बनें">
				<?php echo esc_html( $cta_h2 ); ?>
			</h2>
			<div class="cta-row" style="display:flex;justify-content:center;gap:16px;flex-wrap:wrap;margin-top:32px">
				<a href="<?php echo esc_url( esb_page_url( 'admissions' ) ); ?>" class="btn btn-gold btn-arrow"
				   data-en="Apply for Admission" data-hi="प्रवेश हेतु आवेदन">
					<?php esc_html_e( 'Apply for Admission', 'excellence-school' ); ?>
				</a>
				<a href="<?php echo esc_url( esb_page_url( 'academics' ) ); ?>" class="btn btn-ghost-light"
				   data-en="Explore Academics" data-hi="शिक्षा देखें">
					<?php esc_html_e( 'Explore Academics', 'excellence-school' ); ?>
				</a>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>

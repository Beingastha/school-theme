<?php
/**
 * Principal's Desk page template — auto-selected by WordPress for the
 * page with slug "principals-desk" (template hierarchy: page-{slug}.php).
 *
 * @package excellence-school
 */
get_header();

$principal_name = esb_opt( 'esb_principal_name', 'Mr. Sudhakar Parashar' );
$principal_role = esb_opt( 'esb_principal_role', 'Principal, Govt. Subhash Excellence H.S. School, Bhopal' );

$commitments = [
	[ 'Quality Education',        'गुणवत्तापूर्ण शिक्षा' ],
	[ 'Safe Campus',               'सुरक्षित परिसर' ],
	[ 'Experienced Faculty',       'अनुभवी शिक्षक स्टाफ' ],
	[ 'Smart Classrooms',          'स्मार्ट कक्षाएं' ],
	[ 'Equal Opportunities',       'समान अवसर' ],
	[ 'Holistic Development',      'समग्र विकास' ],
];

$highlights = [
	[ 'Excellent MP Board Results',              'उत्कृष्ट एमपी बोर्ड परिणाम' ],
	[ 'State & National Sports Achievements',    'राज्य व राष्ट्रीय स्तरीय खेल उपलब्धियां' ],
	[ 'ATAL Tinkering Lab Activities',           'अटल टिंकरिंग लैब गतिविधियां' ],
	[ 'Science & Cultural Competitions',         'विज्ञान व सांस्कृतिक प्रतियोगिताएं' ],
	[ 'Student Selections in Top Institutions',  'शीर्ष संस्थानों में विद्यार्थियों का चयन' ],
];
?>
<main id="main">

	<!-- Page Hero -->
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-en="Home" data-hi="होम"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<a href="<?php echo esc_url( esb_page_url( 'about' ) ); ?>" data-en="About" data-hi="परिचय"><?php esc_html_e( 'About', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span data-en="Principal's Desk" data-hi="प्राचार्य कक्ष"><?php esc_html_e( "Principal's Desk", 'excellence-school' ); ?></span>
			</div>
			<span class="eyebrow light" data-en="Principal's Desk" data-hi="प्राचार्य कक्ष"><?php esc_html_e( "Principal's Desk", 'excellence-school' ); ?></span>
			<h1 data-en="A Message From Our Principal" data-hi="हमारे प्राचार्य का संदेश">
				<?php esc_html_e( 'A Message From Our Principal', 'excellence-school' ); ?>
			</h1>
		</div>
	</section>

	<!-- Principal photo + letter -->
	<?php while ( have_posts() ) : the_post(); ?>
	<section class="section message-block">
		<div class="container">
			<div class="grid2">
				<div class="portrait reveal">
					<?php if ( has_post_thumbnail() ) : ?>
						<?php the_post_thumbnail( 'large', [ 'alt' => esc_attr( $principal_name ) ] ); ?>
					<?php else : ?>
						<div class="ph" data-label="principal.jpg — 560×680"></div>
					<?php endif; ?>
				</div>
				<div class="reveal entry-content">
					<?php
					// The stored letter still contains its own "Our Commitment" heading + list —
					// this page now renders a styled version of that lower down, so strip the
					// original block here rather than editing the stored post content.
					$letter = apply_filters( 'the_content', get_the_content() );
					$letter = preg_replace( '#<h2[^>]*>\s*Our Commitment\s*</h2>\s*<ul[^>]*>.*?</ul>#is', '', $letter );
					echo $letter; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					?>
					<div class="sign">
						<div class="nm"><?php echo esc_html( $principal_name ); ?></div>
						<div class="rl"><?php echo esc_html( $principal_role ); ?></div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endwhile; ?>

	<!-- Our Commitment -->
	<section class="section" style="background:var(--cream)">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center" data-en="Our Commitment" data-hi="हमारी प्रतिबद्धता">
					<?php esc_html_e( 'Our Commitment', 'excellence-school' ); ?>
				</span>
				<h2 data-en="What We Promise Every Family" data-hi="हर परिवार से हमारा वादा">
					<?php esc_html_e( 'What We Promise Every Family', 'excellence-school' ); ?>
				</h2>
			</div>
			<ul class="doc-list" style="max-width:760px;margin:32px auto 0;grid-template-columns:1fr 1fr;display:grid;gap:16px 32px">
				<?php foreach ( $commitments as [ $en, $hi ] ) : ?>
				<li>
					<span class="diamond"></span>
					<span data-en="<?php echo esc_attr( $en ); ?>" data-hi="<?php echo esc_attr( $hi ); ?>"><?php echo esc_html( $en ); ?></span>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>

	<!-- Highlights -->
	<section class="section">
		<div class="container">
			<div class="section-head center reveal">
				<span class="eyebrow center" data-en="Under His Leadership" data-hi="उनके नेतृत्व में">
					<?php esc_html_e( 'Under His Leadership', 'excellence-school' ); ?>
				</span>
				<h2 data-en="Milestones We're Proud Of" data-hi="जिन उपलब्धियों पर हमें गर्व है">
					<?php esc_html_e( "Milestones We're Proud Of", 'excellence-school' ); ?>
				</h2>
			</div>
			<div class="grid why-grid stagger-grid">
				<?php foreach ( $highlights as [ $en, $hi ] ) : ?>
				<div class="card why-card reveal">
					<div class="ic"><span class="diamond"></span></div>
					<h3 data-en="<?php echo esc_attr( $en ); ?>" data-hi="<?php echo esc_attr( $hi ); ?>">
						<?php echo esc_html( $en ); ?>
					</h3>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>

</main>
<?php get_footer(); ?>

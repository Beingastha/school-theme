<?php
/**
 * Page Content Settings — admin options page for editing all on-page text.
 *
 * Registers a top-level "Page Content" menu item in wp-admin.
 * All content is stored as a single serialised option: esb_page_content.
 *
 * Helper: esb_pg( $key, $default ) reads a value from that option.
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

/* =========================================================================
   Helper
   ========================================================================= */

/**
 * Retrieve a page-content value.
 *
 * @param string $key     Dot-free key, e.g. 'wcu_card_1_title'.
 * @param string $default Fallback if key is not set.
 * @return string
 */
function esb_pg( string $key, string $default = '' ): string {
	static $data = null;
	if ( null === $data ) {
		$data = (array) get_option( 'esb_page_content', [] );
	}
	return isset( $data[ $key ] ) && '' !== $data[ $key ] ? (string) $data[ $key ] : $default;
}

/* =========================================================================
   Admin Menu
   ========================================================================= */

add_action( 'admin_menu', 'esb_pg_add_menu' );
function esb_pg_add_menu(): void {
	add_menu_page(
		esc_html__( 'Page Content', 'excellence-school' ),
		esc_html__( 'Page Content', 'excellence-school' ),
		'edit_theme_options',
		'esb-page-content',
		'esb_pg_settings_page',
		'dashicons-edit-page',
		61
	);
}

/* =========================================================================
   Settings Registration
   ========================================================================= */

add_action( 'admin_init', 'esb_pg_register_settings' );
function esb_pg_register_settings(): void {
	register_setting(
		'esb_page_content_group',
		'esb_page_content',
		[ 'sanitize_callback' => 'esb_pg_sanitize' ]
	);
}

function esb_pg_sanitize( $raw ): array {
	if ( ! is_array( $raw ) ) {
		return [];
	}
	$clean = [];
	foreach ( $raw as $key => $value ) {
		$key = sanitize_key( $key );
		// Percentage fields stay numeric; everything else is text.
		if ( str_ends_with( $key, '_pct' ) ) {
			$clean[ $key ] = (string) min( 100, max( 0, absint( $value ) ) );
		} else {
			$clean[ $key ] = sanitize_textarea_field( wp_unslash( (string) $value ) );
		}
	}
	return $clean;
}

/* =========================================================================
   Admin-page Styles (inline, minimal)
   ========================================================================= */

add_action( 'admin_head', 'esb_pg_admin_styles' );
function esb_pg_admin_styles(): void {
	$screen = get_current_screen();
	if ( ! $screen || 'toplevel_page_esb-page-content' !== $screen->id ) {
		return;
	}
	?>
	<style>
	.esb-pg-wrap { max-width: 900px; }
	.esb-pg-tabs { display: flex; gap: 0; margin-bottom: 0; border-bottom: 1px solid #ccd0d4; }
	.esb-pg-tabs a {
		display: inline-block; padding: 8px 18px; text-decoration: none;
		font-weight: 500; color: #50575e; border: 1px solid transparent;
		border-bottom: none; margin-bottom: -1px; background: #f0f0f1;
	}
	.esb-pg-tabs a.active {
		background: #fff; color: #1d2327;
		border-color: #ccd0d4; border-bottom-color: #fff;
	}
	.esb-pg-section { background: #fff; border: 1px solid #ccd0d4; border-top: none; padding: 20px 24px; }
	.esb-pg-group { margin-bottom: 28px; padding-bottom: 24px; border-bottom: 1px solid #f0f0f1; }
	.esb-pg-group:last-child { border-bottom: none; margin-bottom: 0; }
	.esb-pg-group-title { font-size: 14px; font-weight: 600; color: #1d2327; margin: 0 0 14px; text-transform: uppercase; letter-spacing: .04em; }
	.esb-pg-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px 20px; }
	.esb-pg-row.full { grid-template-columns: 1fr; }
	.esb-pg-field label { display: block; font-size: 12px; font-weight: 600; color: #50575e; margin-bottom: 4px; text-transform: uppercase; letter-spacing: .04em; }
	.esb-pg-field input[type=text],
	.esb-pg-field input[type=number],
	.esb-pg-field textarea { width: 100%; border-radius: 3px; }
	.esb-pg-field textarea { min-height: 70px; }
	.esb-pg-card-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
	.esb-pg-card { border: 1px solid #e2e4e7; border-radius: 4px; padding: 14px; background: #fafafa; }
	.esb-pg-card-num { font-size: 10px; font-weight: 700; text-transform: uppercase; color: #9ca2a7; margin-bottom: 8px; }
	</style>
	<?php
}

/* =========================================================================
   Settings Page Renderer
   ========================================================================= */

function esb_pg_settings_page(): void {
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_die( esc_html__( 'You do not have permission to access this page.', 'excellence-school' ) );
	}

	$tabs = [
		'home'       => __( '🏠 Home', 'excellence-school' ),
		'about'      => __( 'ℹ️ About', 'excellence-school' ),
		'academics'  => __( '📚 Academics', 'excellence-school' ),
		'admissions' => __( '📋 Admissions', 'excellence-school' ),
	];

	$active = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'home'; // phpcs:ignore WordPress.Security.NonceVerification
	if ( ! array_key_exists( $active, $tabs ) ) {
		$active = 'home';
	}
	?>
	<div class="wrap esb-pg-wrap">
		<h1><?php esc_html_e( 'Page Content', 'excellence-school' ); ?></h1>
		<p class="description" style="margin-bottom:16px">
			<?php esc_html_e( 'Edit the text shown on each page of the website. Changes save immediately and are reflected live.', 'excellence-school' ); ?>
		</p>

		<div class="esb-pg-tabs">
			<?php foreach ( $tabs as $slug => $label ) : ?>
			<a href="<?php echo esc_url( admin_url( 'admin.php?page=esb-page-content&tab=' . $slug ) ); ?>"
			   class="<?php echo $active === $slug ? 'active' : ''; ?>">
				<?php echo esc_html( $label ); ?>
			</a>
			<?php endforeach; ?>
		</div>

		<form method="post" action="options.php" class="esb-pg-section">
			<?php settings_fields( 'esb_page_content_group' ); ?>
			<input type="hidden" name="_esb_tab" value="<?php echo esc_attr( $active ); ?>" />

			<?php
			match ( $active ) {
				'home'       => esb_pg_tab_home(),
				'about'      => esb_pg_tab_about(),
				'academics'  => esb_pg_tab_academics(),
				'admissions' => esb_pg_tab_admissions(),
				default      => null,
			};
			?>

			<?php submit_button( __( 'Save Changes', 'excellence-school' ) ); ?>
		</form>
	</div>
	<?php
}

/* =========================================================================
   Field Helpers
   ========================================================================= */

function esb_pg_text( string $key, string $label, string $default = '', string $placeholder = '' ): void {
	$value = esb_pg( $key, $default );
	?>
	<div class="esb-pg-field">
		<label for="esb_pg_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
		<input type="text"
		       id="esb_pg_<?php echo esc_attr( $key ); ?>"
		       name="esb_page_content[<?php echo esc_attr( $key ); ?>]"
		       value="<?php echo esc_attr( $value ); ?>"
		       placeholder="<?php echo esc_attr( $placeholder ?: $default ); ?>" />
	</div>
	<?php
}

function esb_pg_textarea( string $key, string $label, string $default = '', string $placeholder = '' ): void {
	$value = esb_pg( $key, $default );
	?>
	<div class="esb-pg-field">
		<label for="esb_pg_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
		<textarea id="esb_pg_<?php echo esc_attr( $key ); ?>"
		          name="esb_page_content[<?php echo esc_attr( $key ); ?>]"
		          placeholder="<?php echo esc_attr( $placeholder ?: $default ); ?>"><?php echo esc_textarea( $value ); ?></textarea>
	</div>
	<?php
}

function esb_pg_number( string $key, string $label, string $default = '0', int $min = 0, int $max = 100 ): void {
	$value = esb_pg( $key, $default );
	?>
	<div class="esb-pg-field">
		<label for="esb_pg_<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $label ); ?></label>
		<input type="number"
		       id="esb_pg_<?php echo esc_attr( $key ); ?>"
		       name="esb_page_content[<?php echo esc_attr( $key ); ?>]"
		       value="<?php echo esc_attr( $value ); ?>"
		       min="<?php echo esc_attr( $min ); ?>"
		       max="<?php echo esc_attr( $max ); ?>" />
	</div>
	<?php
}

/* =========================================================================
   Tab: Home
   ========================================================================= */

function esb_pg_tab_home(): void {
	?>
	<!-- ---- Hero Content ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Hero 1 — Stately (full-bleed photo)', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px"><?php esc_html_e( 'Shown when Hero Layout is set to "Stately" in Appearance & Hero.', 'excellence-school' ); ?></p>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'hero1_h1', 'Main Headline (H1)', 'A Government School of Distinction.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'hero1_sub', 'Subtitle', "Nurturing tomorrow's leaders in Subhash Shivaji Nagar — where academic excellence, character, and opportunity meet under one roof." ); ?>
		</div>
	</div>

	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Hero 2 — Split (text left, image right)', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px"><?php esc_html_e( 'Shown when Hero Layout is set to "Split".', 'excellence-school' ); ?></p>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'hero2_h1', 'Main Headline (H1)', 'Where Excellence Becomes a Habit.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'hero2_sub', 'Subtitle', 'A premier government institution in Bhopal offering Science, Commerce and Humanities with modern labs, a tinkering lab, and championship sports.' ); ?>
		</div>
	</div>

	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Hero 3 — Crest (centred crest & stats)', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px"><?php esc_html_e( 'Shown when Hero Layout is set to "Crest". The H1 uses the Full School Name from School Identity.', 'excellence-school' ); ?></p>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'hero3_sub', 'Subtitle', "Nurturing tomorrow's leaders through quality education, modern facilities, and holistic development — open to every section of society." ); ?>
		</div>
	</div>

	<!-- ---- Why Choose Us ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Why Choose Us — Section Header', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'wcu_h2', 'Heading', 'A Foundation Built on Trust & Merit' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'wcu_sub', 'Subtext', "As a designated Government School of Excellence, we combine the reach of public education with the standards of India's leading private schools." ); ?>
		</div>
	</div>

	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Why Choose Us — 6 Cards', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$wcu_defaults = [
				1 => [ 'Academic Rigour', 'A merit-driven curriculum across Science, Commerce and Humanities, with focused coaching for board and competitive exams.' ],
				2 => [ 'Modern Infrastructure', 'Smart classrooms, science labs, a computer lab and an ATAL Tinkering Lab sanctioned by NITI Aayog for hands-on STEM learning.' ],
				3 => [ 'Championship Sports', 'Professional coaching in boxing, cricket and badminton has produced district and state-level champions year after year.' ],
				4 => [ 'Holistic Development', 'Beyond marks — debate, arts, NCC, scouts and community service shape confident, responsible citizens.' ],
				5 => [ 'Residential Facility', 'A safe, disciplined hostel offers students from across the region a focused environment to live and learn.' ],
				6 => [ 'Education for All', 'World-class learning, open to every section of society — upholding the promise of an equitable public education.' ],
			];
			foreach ( $wcu_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Card $i" ); ?></div>
				<?php esb_pg_text( "wcu_card_{$i}_title", 'Title', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "wcu_card_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Home CTA Banner ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Admissions CTA Banner (Home Page)', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'home_cta_h2', 'Headline', 'Give Your Child the Excellence They Deserve' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'home_cta_body', 'Body Text', 'Join the School for Excellence, Bhopal and open the door to quality education, modern facilities and a community that believes in every child. Limited seats available.' ); ?>
		</div>
	</div>
	<?php
}

/* =========================================================================
   Tab: About
   ========================================================================= */

function esb_pg_tab_about(): void {
	?>
	<!-- ---- About Hero ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Page Hero', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'about_hero_h1', 'Heading (H1)', 'A Legacy of Public Excellence' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_hero_sub', 'Subtitle', 'A premier government institution under the Department of School Education, Madhya Pradesh — committed to world-class learning for every child.' ); ?>
		</div>
	</div>

	<!-- ---- Our Story ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Our Story Section', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'about_story_h2', 'Heading', 'Two Decades of Distinction' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_story_lead', 'Lead Paragraph', 'Established in [year], the Govt. Higher Secondary School for Excellence, Subhash Shivaji Nagar, was created with a singular vision — to deliver the standard of India\'s finest schools within the public system.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_story_body', 'Body Paragraph', 'Affiliated with the MP Board of Secondary Education, we offer Science, Commerce and Humanities streams at the higher secondary level. With dedicated faculty, modern infrastructure and a focus on holistic growth, we nurture responsible citizens and future leaders from every section of society.' ); ?>
		</div>
	</div>

	<!-- ---- Vision & Mission ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Vision & Mission', 'excellence-school' ); ?></div>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'about_vision', 'Vision Text', 'To be a beacon of equitable, world-class education — where every learner, regardless of background, discovers their potential and rises to lead with knowledge and integrity.' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_mission', 'Mission Text', 'To provide rigorous academics, modern facilities and value-based education that develops character, critical thinking and a lifelong love of learning in every student.' ); ?>
		</div>
	</div>

	<!-- ---- Values ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Our Values — 4 Cards', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$val_defaults = [
				1 => [ 'Excellence', 'Setting and meeting the highest standards in all we do.' ],
				2 => [ 'Integrity',  'Honesty, discipline and fairness at the heart of our culture.' ],
				3 => [ 'Equity',     'Quality education open and accessible to every child.' ],
				4 => [ 'Innovation', 'Modern methods and a tinkering mindset for tomorrow.' ],
			];
			foreach ( $val_defaults as $i => [ $label, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Value $i" ); ?></div>
				<?php esb_pg_text( "about_val_{$i}_label", 'Label', $label ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "about_val_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Principal's Message (About page) ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( "Principal's Message (About Page)", 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:12px">
			<?php esc_html_e( 'Name, role and portrait are shared with the home-page message — edit those under Appearance → Customise → School Settings → Principal\'s Message.', 'excellence-school' ); ?>
		</p>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'about_pm_quote', 'Opening Quote', "Education is the most powerful tool we can place in a child's hands. At the School for Excellence, our promise is that no dream is too large and no child is left behind." ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'about_pm_para', 'Body Paragraph', 'Over two decades, this institution has grown into a name that families across Bhopal trust. Our students walk out as confident, principled young people — toppers, athletes, innovators and, above all, good human beings.' ); ?>
		</div>
	</div>

	<!-- ---- About CTA ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'about_cta_h2', 'Headline', 'Become Part of Our Story' ); ?>
		</div>
	</div>
	<?php
}

/* =========================================================================
   Tab: Academics
   ========================================================================= */

function esb_pg_tab_academics(): void {
	?>
	<!-- ---- Academics Hero ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Page Hero', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'acad_hero_h1', 'Heading (H1)', 'Learning Without Limits' ); ?>
		</div>
		<div class="esb-pg-row full" style="margin-top:10px">
			<?php esb_pg_textarea( 'acad_hero_sub', 'Subtitle', 'A rigorous, future-ready curriculum across Science, Commerce and Humanities — backed by modern labs and dedicated coaching for board and competitive exams.' ); ?>
		</div>
	</div>

	<!-- ---- Streams ---- -->
	<?php
	$stream_defaults = [
		'sci' => [
			'Science',
			[
				'Physics, Chemistry, Mathematics (PCM)',
				'Physics, Chemistry, Biology (PCB)',
				'NEET / JEE foundation coaching',
				'Practical-led lab learning',
			],
		],
		'com' => [
			'Commerce',
			[
				'Accountancy & Book-keeping',
				'Business Studies',
				'Economics & Mathematics',
				'Commerce career guidance',
			],
		],
		'hum' => [
			'Humanities',
			[
				'History & Political Science',
				'Geography & Economics',
				'Hindi & English literature',
				'Civil services orientation',
			],
		],
	];
	foreach ( $stream_defaults as $slug => [ $stream_name, $items ] ) :
	?>
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php echo esc_html( "Stream: $stream_name" ); ?></div>
		<?php esb_pg_text( "acad_{$slug}_name", 'Stream Name', $stream_name ); ?>
		<div class="esb-pg-card-grid" style="margin-top:10px">
			<?php foreach ( $items as $i => $item ) :
				$n = $i + 1;
				?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Item $n" ); ?></div>
				<?php esb_pg_text( "acad_{$slug}_item_{$n}", 'Subject / Module', $item ); ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php endforeach; ?>

	<!-- ---- Our Approach ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Our Approach — 3 Cards', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid" style="grid-template-columns:1fr 1fr 1fr">
			<?php
			$approach_defaults = [
				1 => [ 'Concept-First Teaching', 'Smart classrooms and visual aids build deep understanding before rote — so students reason, not just remember.' ],
				2 => [ 'Exam Mastery',            'Regular tests, remedial sessions and competitive-exam coaching ensure every learner is board-ready and beyond.' ],
				3 => [ 'Learning by Doing',       'Science labs and the ATAL Tinkering Lab turn theory into hands-on experiments, projects and real innovation.' ],
			];
			foreach ( $approach_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Card $i" ); ?></div>
				<?php esb_pg_text( "acad_app_{$i}_title", 'Title', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "acad_app_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Board Results ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Board Results', 'excellence-school' ); ?></div>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'acad_results_desc', 'Description Paragraph', 'In 2025, our Class XII Science cohort recorded a 99% pass rate, with several students placing in the district merit list and scoring above 95%. Our results reflect a culture of disciplined preparation, individual attention and high expectations held for every student.' ); ?>
		</div>
		<div class="esb-pg-card-grid" style="margin-top:14px">
			<?php
			$bar_defaults = [
				1 => [ 'Class XII · Science',    99 ],
				2 => [ 'Class XII · Commerce',   98 ],
				3 => [ 'Class XII · Humanities', 97 ],
				4 => [ 'Class X · All Streams',  96 ],
			];
			foreach ( $bar_defaults as $i => [ $label, $pct ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Result Bar $i" ); ?></div>
				<?php esb_pg_text( "acad_bar_{$i}_label", 'Label', $label ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_number( "acad_bar_{$i}_pct", 'Pass Rate (%)', (string) $pct, 0, 100 ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Academic Facilities ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Academic Facilities — 3 Items', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid" style="grid-template-columns:1fr 1fr 1fr">
			<?php
			$acfac_defaults = [
				1 => [ 'Science Laboratories', 'Physics, Chemistry and Biology labs with modern apparatus for regular practical sessions.' ],
				2 => [ 'ATAL Tinkering Lab',   'A NITI Aayog–sanctioned lab for robotics, electronics and 21st-century STEM skills.' ],
				3 => [ 'Library & Resources',  'Over 5,000 books, periodicals and digital resources for study, research and exam prep.' ],
			];
			foreach ( $acfac_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Item $i" ); ?></div>
				<?php esb_pg_text( "acad_fac_{$i}_title", 'Title', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "acad_fac_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Academics CTA ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'acad_cta_h2', 'Headline', 'Build Your Future With Us' ); ?>
		</div>
	</div>
	<?php
}

/* =========================================================================
   Tab: Admissions
   ========================================================================= */

function esb_pg_tab_admissions(): void {
	?>
	<!-- ---- Admissions Hero ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Page Hero', 'excellence-school' ); ?></div>
		<p class="description" style="margin-bottom:10px"><?php esc_html_e( 'The H1 heading automatically shows the current year. The subtitle is editable below.', 'excellence-school' ); ?></p>
		<div class="esb-pg-row full">
			<?php esb_pg_textarea( 'adm_hero_sub', 'Subtitle', 'Join a community where every child is challenged, supported and inspired to excel. Applications for Classes IX to XII are now open.' ); ?>
		</div>
	</div>

	<!-- ---- How to Apply Steps ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'How to Apply — 4 Steps', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$step_defaults = [
				1 => [ 'Enquire',           'Submit the enquiry form below or visit the school office to register your interest.' ],
				2 => [ 'Submit Documents',  'Provide the required documents and the completed admission form at the office.' ],
				3 => [ 'Interaction',       'A short interaction or entry assessment for the chosen class and stream.' ],
				4 => [ 'Confirmation',      'On selection, complete enrolment formalities and welcome to the family!' ],
			];
			foreach ( $step_defaults as $i => [ $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Step $i" ); ?></div>
				<?php esb_pg_text( "adm_step_{$i}_title", 'Step Name', $title ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "adm_step_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Eligibility ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Eligibility Table — 4 Rows', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$elig_defaults = [
				1 => [ 'Class IX – X',          'Passed previous class' ],
				2 => [ 'Class XI – Science',     'Class X with required %' ],
				3 => [ 'Class XI – Commerce',    'Class X passed' ],
				4 => [ 'Class XI – Humanities',  'Class X passed' ],
			];
			foreach ( $elig_defaults as $i => [ $class, $req ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Row $i" ); ?></div>
				<?php esb_pg_text( "adm_elig_{$i}_class", 'Class / Stream', $class ); ?>
				<div style="margin-top:8px">
					<?php esb_pg_text( "adm_elig_{$i}_req", 'Eligibility Requirement', $req ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Documents ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Documents Required — up to 6 items', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid">
			<?php
			$doc_defaults = [
				1 => "Previous year's marksheet / report card",
				2 => 'Transfer Certificate (TC) from previous school',
				3 => 'Aadhaar card of student',
				4 => 'Birth certificate (for Class IX)',
				5 => 'Caste / income certificate (if applicable)',
				6 => 'Passport-size photographs (4)',
			];
			foreach ( $doc_defaults as $i => $doc ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Document $i" ); ?></div>
				<?php esb_pg_text( "adm_doc_{$i}", 'Document', $doc ); ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- Important Dates ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Important Dates — 3 entries', 'excellence-school' ); ?></div>
		<div class="esb-pg-card-grid" style="grid-template-columns:1fr 1fr 1fr">
			<?php
			$date_defaults = [
				1 => [ 'Jun', '15', 'Applications Open',   'Enquiry & forms available at the office and online.' ],
				2 => [ 'Jul', '10', 'Last Date to Apply',  'Submit completed forms with all documents.' ],
				3 => [ 'Jul', '20', 'Session Begins',      'New academic session commences.' ],
			];
			foreach ( $date_defaults as $i => [ $month, $day, $title, $desc ] ) :
			?>
			<div class="esb-pg-card">
				<div class="esb-pg-card-num"><?php echo esc_html( "Date $i" ); ?></div>
				<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
					<?php esb_pg_text( "adm_date_{$i}_month", 'Month (3 letters)', $month ); ?>
					<?php esb_pg_text( "adm_date_{$i}_day",   'Day', $day ); ?>
				</div>
				<div style="margin-top:8px">
					<?php esb_pg_text( "adm_date_{$i}_title", 'Event Title', $title ); ?>
				</div>
				<div style="margin-top:8px">
					<?php esb_pg_textarea( "adm_date_{$i}_desc", 'Description', $desc ); ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>

	<!-- ---- FAQ ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'FAQ — up to 6 Q&As (leave blank to hide)', 'excellence-school' ); ?></div>
		<?php
		$faq_defaults = [
			1 => [ 'Is this a government school?', 'Yes. We are a designated Government School of Excellence under the Department of School Education, Madhya Pradesh, affiliated with the MP Board of Secondary Education.' ],
			2 => [ 'Which classes can I apply for?', 'Admissions are offered for Classes IX to XII, with Science, Commerce and Humanities streams at the higher secondary level (XI–XII).' ],
			3 => [ 'Is hostel accommodation available?', 'Yes, a safe and disciplined hostel facility is available for eligible students from outside Bhopal, subject to availability. Please enquire at the office for details.' ],
			4 => [ 'How will I be informed about selection?', 'Our admissions team will contact you by phone or email after the document verification and interaction stage.' ],
			5 => [ '', '' ],
			6 => [ '', '' ],
		];
		foreach ( $faq_defaults as $i => [ $q, $a ] ) :
		?>
		<div class="esb-pg-card" style="margin-bottom:12px;border-radius:4px;padding:14px;border:1px solid #e2e4e7;background:#fafafa">
			<div class="esb-pg-card-num"><?php echo esc_html( "Q&A $i" ); ?></div>
			<?php esb_pg_text( "adm_faq_{$i}_q", 'Question', $q ); ?>
			<div style="margin-top:8px">
				<?php esb_pg_textarea( "adm_faq_{$i}_a", 'Answer', $a ); ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>

	<!-- ---- Admissions Bottom CTA ---- -->
	<div class="esb-pg-group">
		<div class="esb-pg-group-title"><?php esc_html_e( 'Bottom CTA', 'excellence-school' ); ?></div>
		<div class="esb-pg-row">
			<?php esb_pg_text( 'adm_cta_h2', 'Headline', "Secure Your Child's Seat Today" ); ?>
		</div>
	</div>
	<?php
}

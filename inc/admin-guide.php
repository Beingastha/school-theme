<?php
/**
 * Website Guide — a full, plain-English handbook rendered inside wp-admin.
 *
 * Adds a top-level "Website Guide" menu so non-technical staff always have
 * the documentation one click away, with click-paths rendered as real links
 * that jump straight to the screen being described.
 *
 * @package excellence-school
 */

defined( 'ABSPATH' ) || exit;

add_action( 'admin_menu', 'esb_guide_add_menu' );
function esb_guide_add_menu(): void {
	add_menu_page(
		esc_html__( 'Website Guide', 'excellence-school' ),
		esc_html__( 'Website Guide', 'excellence-school' ),
		'edit_posts',
		'esb-website-guide',
		'esb_guide_render_page',
		'dashicons-book-alt',
		62
	);
}

/**
 * Renders a click-path as a link to the real admin screen.
 *
 * @param string $url   Destination admin URL.
 * @param string $label Human-readable path, e.g. "Appearance → Widgets".
 */
function esb_guide_path( string $url, string $label ): string {
	return '<a class="esb-g-path" href="' . esc_url( $url ) . '">' . esc_html( $label ) . '</a>';
}

function esb_guide_render_page(): void {
	if ( ! current_user_can( 'edit_posts' ) ) {
		wp_die( esc_html__( 'You do not have permission to view this page.', 'excellence-school' ) );
	}

	/* Real destinations, so every path in the guide is clickable. */
	$u = [
		'customize'   => admin_url( 'customize.php' ),
		'menus'       => admin_url( 'nav-menus.php' ),
		'widgets'     => admin_url( 'widgets.php' ),
		'media'       => admin_url( 'upload.php' ),
		'pages'       => admin_url( 'edit.php?post_type=page' ),
		'pc_home'     => admin_url( 'admin.php?page=esb-page-content&tab=home' ),
		'pc_about'    => admin_url( 'admin.php?page=esb-page-content&tab=about' ),
		'pc_acad'     => admin_url( 'admin.php?page=esb-page-content&tab=academics' ),
		'pc_adm'      => admin_url( 'admin.php?page=esb-page-content&tab=admissions' ),
		'facilities'  => admin_url( 'edit.php?post_type=esb_facility' ),
		'achieve'     => admin_url( 'edit.php?post_type=esb_achievement' ),
		'news'        => admin_url( 'edit.php?post_type=esb_news' ),
		'circulars'   => admin_url( 'edit.php?post_type=esb_circular' ),
		'testimonial' => admin_url( 'edit.php?post_type=esb_testimonial' ),
		'features'    => admin_url( 'edit.php?post_type=esb_feature' ),
		'staff'       => admin_url( 'edit.php?post_type=esb_staff' ),
		'events'      => admin_url( 'edit.php?post_type=tribe_events' ),
		'events_new'  => admin_url( 'post-new.php?post_type=tribe_events' ),
	];
	?>
	<style>
	.esb-g-wrap { max-width: 1220px; margin-right: 20px; }
	.esb-g-head {
		background: #07321f; color: #f4efe2; border-radius: 6px;
		padding: 26px 30px; margin: 16px 0 22px; border-bottom: 3px solid #c9a23a;
	}
	.esb-g-head h1 { color: #fff; font-size: 25px; margin: 0 0 8px; font-weight: 600; line-height: 1.2; }
	.esb-g-head p { color: rgba(244,239,226,.82); font-size: 14px; margin: 0; max-width: 70ch; line-height: 1.6; }
	.esb-g-kicker { font-size: 11px; letter-spacing: .16em; text-transform: uppercase; color: #dcc068; margin-bottom: 10px; font-weight: 600; }

	.esb-g-layout { display: grid; grid-template-columns: 218px minmax(0,1fr); gap: 30px; align-items: start; }
	@media (max-width: 960px) { .esb-g-layout { grid-template-columns: 1fr; gap: 10px; } }

	.esb-g-toc { position: sticky; top: 46px; background: #fff; border: 1px solid #dcdcde; border-radius: 6px; padding: 14px 8px 14px 14px; }
	@media (max-width: 960px) { .esb-g-toc { position: static; } }
	.esb-g-toc strong { display: block; font-size: 11px; letter-spacing: .12em; text-transform: uppercase; color: #646970; margin-bottom: 9px; }
	.esb-g-toc ol { margin: 0; padding: 0; list-style: none; counter-reset: g; }
	.esb-g-toc li { counter-increment: g; margin: 0; }
	.esb-g-toc a { display: block; padding: 4px 6px; font-size: 13px; color: #2c3338; text-decoration: none; border-radius: 3px; line-height: 1.35; }
	.esb-g-toc a::before { content: counter(g, decimal-leading-zero) "  "; color: #a37d1b; font-variant-numeric: tabular-nums; }
	.esb-g-toc a:hover { background: #f0f6f2; color: #11603c; }

	.esb-g-body { background: #fff; border: 1px solid #dcdcde; border-radius: 6px; padding: 8px 32px 30px; }
	.esb-g-sec { scroll-margin-top: 46px; padding: 26px 0 4px; }
	.esb-g-sec + .esb-g-sec { border-top: 1px solid #f0f0f1; }
	.esb-g-sec > h2 {
		font-size: 19px; font-weight: 600; color: #07321f; margin: 0 0 14px; padding: 0; line-height: 1.25;
	}
	.esb-g-sec > h2 span { color: #a37d1b; font-size: 13px; font-variant-numeric: tabular-nums; margin-right: 8px; }
	.esb-g-body h3 { font-size: 14px; font-weight: 700; color: #1d2327; margin: 22px 0 8px; }
	.esb-g-body p, .esb-g-body li { font-size: 13.8px; color: #3c434a; line-height: 1.65; }
	.esb-g-body p { margin: 0 0 12px; max-width: 78ch; }
	.esb-g-body ul, .esb-g-body ol { margin: 0 0 14px 20px; max-width: 78ch; }
	.esb-g-body li { margin-bottom: 5px; }
	.esb-g-lede { font-size: 14.5px !important; color: #50575e !important; }

	.esb-g-path {
		display: inline-block; background: #1d2327; color: #fff !important; font-size: 12px; font-weight: 600;
		border-radius: 3px; padding: 2px 8px; text-decoration: none; letter-spacing: .015em; line-height: 1.5;
	}
	.esb-g-path:hover { background: #11603c; color: #fff !important; }
	.esb-g-path:focus { box-shadow: 0 0 0 2px #c9a23a; outline: none; }
	.esb-g-kbd { background: #f6f7f7; border: 1px solid #c3c4c7; border-bottom-width: 2px; border-radius: 3px; padding: 1px 6px; font-size: 12px; font-family: Consolas, Menlo, monospace; white-space: nowrap; }

	.esb-g-note { background: #f0f6f2; border-left: 3px solid #11603c; padding: 12px 16px; border-radius: 0 4px 4px 0; margin: 0 0 14px; max-width: 78ch; }
	.esb-g-note.warn { background: #fff8e1; border-left-color: #c9a23a; }
	.esb-g-note.stop { background: #fcf0ef; border-left-color: #8c2f2a; }
	.esb-g-note p { margin: 0; font-size: 13.4px; }
	.esb-g-note p + p { margin-top: 8px; }
	.esb-g-note b { display: block; font-size: 10.5px; letter-spacing: .12em; text-transform: uppercase; margin-bottom: 5px; color: #11603c; }
	.esb-g-note.warn b { color: #8f6d14; }
	.esb-g-note.stop b { color: #8c2f2a; }

	.esb-g-body table { border-collapse: collapse; width: 100%; margin: 0 0 16px; font-size: 13.2px; }
	.esb-g-body table th { background: #f6f7f7; color: #50575e; padding: 8px 12px; text-align: left; font-weight: 600; font-size: 11px; letter-spacing: .08em; text-transform: uppercase; border-bottom: 1px solid #dcdcde; }
	.esb-g-body table td { padding: 9px 12px; border-bottom: 1px solid #f0f0f1; vertical-align: top; }
	.esb-g-body table tr:last-child td { border-bottom: none; }
	.esb-g-body table td:first-child { font-weight: 600; color: #2c3338; }
	.esb-g-scroll { overflow-x: auto; }

	@media print {
		#adminmenumain, #wpadminbar, #wpfooter, .esb-g-toc { display: none !important; }
		.esb-g-layout { grid-template-columns: 1fr; }
		#wpcontent { margin-left: 0 !important; padding-left: 0 !important; }
		.esb-g-body { border: none; }
		.esb-g-path { background: none !important; color: #07321f !important; font-weight: 700; padding: 0; }
	}
	</style>

	<div class="wrap esb-g-wrap">
		<div class="esb-g-head">
			<div class="esb-g-kicker"><?php esc_html_e( 'Website Handbook', 'excellence-school' ); ?></div>
			<h1><?php esc_html_e( 'Running the school website', 'excellence-school' ); ?></h1>
			<p><?php esc_html_e( 'A plain-English guide to updating your site — text, photos, events, admissions and more. No coding required. Every dark button below is a real link: click it to jump straight to that screen.', 'excellence-school' ); ?></p>
		</div>

		<div class="esb-g-layout">
			<nav class="esb-g-toc">
				<strong><?php esc_html_e( 'Contents', 'excellence-school' ); ?></strong>
				<ol>
					<li><a href="#g1"><?php esc_html_e( 'Golden rules', 'excellence-school' ); ?></a></li>
					<li><a href="#g2"><?php esc_html_e( 'Where to change things', 'excellence-school' ); ?></a></li>
					<li><a href="#g3"><?php esc_html_e( 'Page Content', 'excellence-school' ); ?></a></li>
					<li><a href="#g4"><?php esc_html_e( 'School Settings', 'excellence-school' ); ?></a></li>
					<li><a href="#g5"><?php esc_html_e( 'Hindi translations', 'excellence-school' ); ?></a></li>
					<li><a href="#g6"><?php esc_html_e( 'Show / hide sections', 'excellence-school' ); ?></a></li>
					<li><a href="#g7"><?php esc_html_e( 'Adding photos', 'excellence-school' ); ?></a></li>
					<li><a href="#g8"><?php esc_html_e( 'The card sections', 'excellence-school' ); ?></a></li>
					<li><a href="#g9"><?php esc_html_e( 'Events calendar', 'excellence-school' ); ?></a></li>
					<li><a href="#g10"><?php esc_html_e( 'Admissions form', 'excellence-school' ); ?></a></li>
					<li><a href="#g11"><?php esc_html_e( 'Ordinary pages', 'excellence-school' ); ?></a></li>
					<li><a href="#g12"><?php esc_html_e( 'Menus', 'excellence-school' ); ?></a></li>
					<li><a href="#g13"><?php esc_html_e( 'The footer', 'excellence-school' ); ?></a></li>
					<li><a href="#g14"><?php esc_html_e( 'Can\'t see your change?', 'excellence-school' ); ?></a></li>
					<li><a href="#g15"><?php esc_html_e( 'Quick answers', 'excellence-school' ); ?></a></li>
					<li><a href="#g16"><?php esc_html_e( 'What not to touch', 'excellence-school' ); ?></a></li>
				</ol>
			</nav>

			<div class="esb-g-body">

				<!-- 1 -->
				<section class="esb-g-sec" id="g1">
					<h2><span>01</span><?php esc_html_e( 'The golden rules', 'excellence-school' ); ?></h2>
					<p class="esb-g-lede"><?php esc_html_e( 'Four things that will save you a lot of confusion.', 'excellence-school' ); ?></p>
					<ol>
						<li><strong><?php esc_html_e( 'Nothing saves until you click the blue button.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'It is called Save Changes, Publish, or Update depending on the screen. Leave the page without clicking it and your work is lost.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'Text is edited in one place, photos in another.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'Words live in Page Content. Photos live in the item itself (Featured Image) or in Customize.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'If you cannot see your change, it is almost always your browser showing an old copy.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'Press Ctrl + Shift + R (Windows) or Cmd + Shift + R (Mac). See section 14.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'You cannot permanently break anything by typing.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'Changing text is always safe and always reversible. The only risky area is in section 16.', 'excellence-school' ); ?></li>
					</ol>
				</section>

				<!-- 2 -->
				<section class="esb-g-sec" id="g2">
					<h2><span>02</span><?php esc_html_e( 'Where do I change things?', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'Almost everything lives in one of these places. Click any dark button to go straight there.', 'excellence-school' ); ?></p>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'If you want to change…', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Go to', 'excellence-school' ); ?></th></tr>
						<tr><td><?php esc_html_e( 'Wording on Home, About, Academics or Admissions', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['pc_home'], 'Page Content' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Phone, email, address, logo, colours, principal, pass percentages', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['customize'], 'Appearance → Customize' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Facilities, Achievements, News, Circulars', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Their own menu in the left sidebar', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Events', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['events'], 'Events' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Menus at the top of the site', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['menus'], 'Appearance → Menus' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'The footer at the bottom', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['widgets'], 'Appearance → Widgets' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Curriculum, Fee Structure and similar simple pages', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['pages'], 'Pages' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
					</table>
					</div>
				</section>

				<!-- 3 -->
				<section class="esb-g-sec" id="g3">
					<h2><span>03</span><?php esc_html_e( 'Page Content — your main editing screen', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'This is where you will spend most of your time. It controls the words on your four biggest pages.', 'excellence-school' ); ?></p>
					<h3><?php esc_html_e( 'How to edit anything here', 'excellence-school' ); ?></h3>
					<ol>
						<li><?php esc_html_e( 'Click the tab for the page you want.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Scroll to the box you want to change — each one is clearly labelled.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Type your new text over the old.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Scroll to the bottom and click Save Changes.', 'excellence-school' ); ?></li>
					</ol>
					<h3><?php esc_html_e( 'The four tabs', 'excellence-school' ); ?></h3>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'Tab', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Contains', 'excellence-school' ); ?></th></tr>
						<tr><td><?php echo esb_guide_path( $u['pc_home'], 'Home' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Show/hide switches for every homepage section; the three banner designs; the Why Choose Us heading and its 6 cards; the mid-page admissions banner', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['pc_about'], 'About' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Page heading; Our Story paragraphs; Vision & Mission; the 4 Values cards; principal quote; bottom call-to-action', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['pc_acad'], 'Academics' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Page heading and intro; curriculum overview; examination pattern; the 3 Approach cards; Board Results bar labels; academic facilities', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['pc_adm'], 'Admissions' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Page subtitle; the 4 How to Apply steps; eligibility table; documents required; important dates; FAQs; the Admissions Office address box', 'excellence-school' ); ?></td></tr>
					</table>
					</div>
					<div class="esb-g-note">
						<b><?php esc_html_e( 'Handy', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'Anywhere a field says "leave blank to hide", clearing the box removes that item from the website. That is how you show only 4 documents instead of 6, or 3 FAQs instead of 6.', 'excellence-school' ); ?></p>
					</div>
				</section>

				<!-- 4 -->
				<section class="esb-g-sec" id="g4">
					<h2><span>04</span><?php esc_html_e( 'School Settings — phone, address, logo, colours', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'Anything that appears all over the site — like your phone number in both the header and footer — is changed in one place, so you only ever type it once.', 'excellence-school' ); ?></p>
					<p><?php echo esb_guide_path( $u['customize'], 'Appearance → Customize → School Settings' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
					<p><?php esc_html_e( 'You will see a live preview on the right that updates as you type. Click the blue Publish button at the top when you are done, or nothing saves.', 'excellence-school' ); ?></p>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'Section', 'excellence-school' ); ?></th><th><?php esc_html_e( 'What is in it', 'excellence-school' ); ?></th></tr>
						<tr><td><?php esc_html_e( 'School Identity', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Full legal name, short name, tagline, UDISE code', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Contact Information', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Phone, email, address, office hours, Google Maps embed', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Social Media Links', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Facebook, Instagram, LinkedIn, YouTube', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Key Statistics', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Pass rate, students, teachers, year established', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Principal\'s Message', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Name, job title, quote and portrait photo', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Board Results', 'excellence-school' ); ?></td><td><?php esc_html_e( 'The four bar-graph labels and their percentages', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Student Life Mosaic', 'excellence-school' ); ?></td><td><?php esc_html_e( 'The 6 photo tiles and their captions', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Appearance & Hero', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Which of the 3 banner designs is used, and the banner photo', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Colour Palette / Font Pairing', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Ready-made colour schemes and font combinations. Pick one, watch the preview, Publish.', 'excellence-school' ); ?></td></tr>
					</table>
					</div>
					<div class="esb-g-note warn">
						<b><?php esc_html_e( 'Watch out', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'Board Results percentages must be a plain number between 0 and 100. Typing "99%" will not work — just type 99.', 'excellence-school' ); ?></p>
					</div>
				</section>

				<!-- 5 -->
				<section class="esb-g-sec" id="g5">
					<h2><span>05</span><?php esc_html_e( 'Hindi translations — how the language button works', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'Your website has an EN / हिं button in the top corner. Visitors click it to switch the whole site to Hindi.', 'excellence-school' ); ?></p>
					<p><strong><?php esc_html_e( 'This does not translate automatically.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'Someone has to type the Hindi once — after that it is saved forever.', 'excellence-school' ); ?></p>
					<p><?php esc_html_e( 'In Page Content, underneath almost every English box there is a matching box with a small green HINDI tag. Type the translation there and click Save Changes.', 'excellence-school' ); ?></p>
					<ul>
						<li><?php esc_html_e( 'Leave a Hindi box empty and that bit simply stays in English. Nothing breaks.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'You can do this gradually — translate the most important pages first.', 'excellence-school' ); ?></li>
					</ul>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'Where', 'excellence-school' ); ?></th><th><?php esc_html_e( 'How to add Hindi', 'excellence-school' ); ?></th></tr>
						<tr><td><?php esc_html_e( 'Page Content boxes', 'excellence-school' ); ?></td><td><?php esc_html_e( 'The box with the green HINDI tag underneath', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Menu links', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Appearance → Menus → open the item → the Description field', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Simple pages', 'excellence-school' ); ?></td><td><?php esc_html_e( 'The Hindi Translation box below the main editor', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Facilities / Achievements / News', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Type Hindi directly in the title and description', 'excellence-school' ); ?></td></tr>
					</table>
					</div>
				</section>

				<!-- 6 -->
				<section class="esb-g-sec" id="g6">
					<h2><span>06</span><?php esc_html_e( 'Show or hide whole homepage sections', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'Want to temporarily remove the Testimonials block from your homepage? You do not need anyone technical.', 'excellence-school' ); ?></p>
					<ol>
						<li><?php echo esb_guide_path( $u['pc_home'], 'Page Content → Home' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
						<li><?php esc_html_e( 'At the very top is "Homepage Sections — Show / Hide".', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Flip the switch off for any section you want hidden.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Click Save Changes.', 'excellence-school' ); ?></li>
					</ol>
					<p><?php esc_html_e( 'You can switch off: Circulars & Notices · Key Statistics Band · Why Choose Us · Principal\'s Message · Academic Excellence · Achievements · Facilities · Student Life Mosaic · News & Events · Testimonials · Admissions CTA Banner · Contact Section.', 'excellence-school' ); ?></p>
					<div class="esb-g-note">
						<b><?php esc_html_e( 'Nothing is deleted', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'Switching a section off only hides it. Switch it back on any time and everything returns exactly as it was.', 'excellence-school' ); ?></p>
					</div>
				</section>

				<!-- 7 -->
				<section class="esb-g-sec" id="g7">
					<h2><span>07</span><?php esc_html_e( 'Adding photos', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'Upload photos at', 'excellence-school' ); ?> <?php echo esb_guide_path( $u['media'], 'Media' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>, <?php esc_html_e( 'or click Upload wherever a photo is being chosen.', 'excellence-school' ); ?></p>
					<h3><?php esc_html_e( 'Setting the main photo for an item', 'excellence-school' ); ?></h3>
					<p><?php esc_html_e( 'Most items — a Facility, an Achievement, a News post, the Principal\'s Desk page — use a Featured Image. This is the photo shown on its card and at the top of its own page.', 'excellence-school' ); ?></p>
					<ol>
						<li><?php esc_html_e( 'Open the item you are editing.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'On the right-hand side, find the Featured Image panel.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Click Set featured image, pick or upload your photo, confirm.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Click Update.', 'excellence-school' ); ?></li>
					</ol>
					<div class="esb-g-note">
						<b><?php esc_html_e( 'Cannot find that panel?', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'It is in the right sidebar. If the sidebar is hidden, click the gear icon in the top-right corner. Make sure the Post or Page tab is selected, not Block.', 'excellence-school' ); ?></p>
					</div>
					<h3><?php esc_html_e( 'Photo tips for a fast website', 'excellence-school' ); ?></h3>
					<ul>
						<li><strong><?php esc_html_e( 'Resize before uploading.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'Around 1600 pixels wide is plenty. Photos straight off a phone are far too large and will slow your site down.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'Use JPG', 'excellence-school' ); ?></strong> <?php esc_html_e( 'for photographs, and keep each under 500 KB.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'Name files sensibly', 'excellence-school' ); ?></strong> — <?php esc_html_e( 'science-lab.jpg, not IMG_20240817.jpg.', 'excellence-school' ); ?></li>
					</ul>
				</section>

				<!-- 8 -->
				<section class="esb-g-sec" id="g8">
					<h2><span>08</span><?php esc_html_e( 'The card sections', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'These sections show a grid of cards. Each card is its own entry that you add, edit or delete like a mini article.', 'excellence-school' ); ?></p>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'Menu', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Where it appears', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Own page?', 'excellence-school' ); ?></th></tr>
						<tr><td><?php echo esb_guide_path( $u['facilities'], 'Facilities' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Homepage Facilities', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Yes — cards are clickable', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['achieve'], 'Achievements' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Homepage Student Achievements', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Yes — cards are clickable', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['news'], 'News & Events' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Homepage News & Events', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Yes', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['circulars'], 'Circulars & Notices' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Homepage notices strip', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Yes', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['testimonial'], 'Testimonials' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Homepage testimonials', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Display only', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['features'], 'Why Choose Us' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Homepage feature cards', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Display only', 'excellence-school' ); ?></td></tr>
						<tr><td><?php echo esb_guide_path( $u['staff'], 'Staff' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td><td><?php esc_html_e( 'Staff page', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Display only', 'excellence-school' ); ?></td></tr>
					</table>
					</div>
					<h3><?php esc_html_e( 'Adding one — for example, a Facility', 'excellence-school' ); ?></h3>
					<ol>
						<li><?php esc_html_e( 'Click Facilities in the left menu, then Add New.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Title — the name, e.g. Physics Laboratory.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Main box — the full description, shown on its own page.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Excerpt — a one-line summary shown on the card. (No Excerpt box? Click the gear icon → Post → Excerpt.)', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Featured Image in the right sidebar — the photo.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Click Publish.', 'excellence-school' ); ?></li>
					</ol>
					<p><?php esc_html_e( 'To reorder, open the item and set Page Attributes → Order: 1 shows first, 2 second. To delete, hover over the item in the list and click Trash — it can be restored from the bin.', 'excellence-school' ); ?></p>
					<div class="esb-g-note warn">
						<b><?php esc_html_e( 'The "default cards" rule', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'Some sections ship with sample cards built in so the site never looks empty. The moment you publish your own first card, all the samples disappear and only your real entries show.', 'excellence-school' ); ?></p>
						<p><?php esc_html_e( 'This surprises people. If the samples vanish right after you add one item, that is normal and intended — not a bug.', 'excellence-school' ); ?></p>
					</div>
				</section>

				<!-- 9 -->
				<section class="esb-g-sec" id="g9">
					<h2><span>09</span><?php esc_html_e( 'The Events Calendar', 'excellence-school' ); ?></h2>
					<h3><?php esc_html_e( 'Adding an event', 'excellence-school' ); ?></h3>
					<ol>
						<li><?php echo esb_guide_path( $u['events_new'], 'Events → Add New' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></li>
						<li><?php esc_html_e( 'Enter the event name.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Fill in the date and time in the "Event Date & Time" section below the editor.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Optionally add a description, venue and photo, then Publish.', 'excellence-school' ); ?></li>
					</ol>
					<h3><?php esc_html_e( 'Where your events appear', 'excellence-school' ); ?></h3>
					<p><?php esc_html_e( 'On the full calendar page, and as a small month calendar in the footer of every page where dates with events are highlighted in gold. The footer calendar has arrows for future months and updates itself — you never edit it directly. Just add events and they appear automatically.', 'excellence-school' ); ?></p>
					<div class="esb-g-note warn">
						<b><?php esc_html_e( 'If the calendar ever looks blank', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'Calendar colours live under Appearance → Customize → The Events Calendar. The day numbers were once accidentally set to white, which made them invisible against the cream background. Keep text colours dark — this is the first place to check if the calendar becomes unreadable.', 'excellence-school' ); ?></p>
					</div>
				</section>

				<!-- 10 -->
				<section class="esb-g-sec" id="g10">
					<h2><span>10</span><?php esc_html_e( 'The Admissions form', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'The enquiry form on the Admissions page is run by a plugin called Forminator.', 'excellence-school' ); ?></p>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'Task', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Where', 'excellence-school' ); ?></th></tr>
						<tr><td><?php esc_html_e( 'Change the form\'s questions', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Forminator → Forms → Edit → drag fields → Update', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Read submitted enquiries', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Forminator → Submissions', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Change where enquiry emails go', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Edit the form → Email Notifications tab → Update', 'excellence-school' ); ?></td></tr>
					</table>
					</div>
					<div class="esb-g-note">
						<b><?php esc_html_e( 'Worth doing occasionally', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'Submit a test enquiry yourself now and then to confirm the emails still arrive — and check the spam folder. Email delivery can quietly stop working, and you would rather find out yourself than miss a parent\'s enquiry.', 'excellence-school' ); ?></p>
					</div>
				</section>

				<!-- 11 -->
				<section class="esb-g-sec" id="g11">
					<h2><span>11</span><?php esc_html_e( 'Ordinary pages', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'Simpler pages — Curriculum, Assessment Schedule, Fee Structure, Brief History, Scholarships, Student Cabinet — are edited with the normal page editor at', 'excellence-school' ); ?> <?php echo esb_guide_path( $u['pages'], 'Pages' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>.</p>
					<p><?php esc_html_e( 'Hover over the page, click Edit, type directly into it like a Word document, then click Update. Click the + button to add headings, bullet lists, tables (good for fee structures and timetables), images, document links and buttons.', 'excellence-school' ); ?></p>
					<h3><?php esc_html_e( 'Adding Hindi to these pages', 'excellence-school' ); ?></h3>
					<p><?php esc_html_e( 'Scroll below the main editing area to the Hindi Translation box. Fill in the Hindi Title and Hindi Content, then Update. Leave it blank and the page stays in English.', 'excellence-school' ); ?></p>
					<h3><?php esc_html_e( 'The Principal\'s Desk page', 'excellence-school' ); ?></h3>
					<p><?php esc_html_e( 'The photo on this page comes from the Featured Image panel on the right — not from inside the page text. There is a reminder note at the top of that screen.', 'excellence-school' ); ?></p>
				</section>

				<!-- 12 -->
				<section class="esb-g-sec" id="g12">
					<h2><span>12</span><?php esc_html_e( 'Menus — the links at the top', 'excellence-school' ); ?></h2>
					<p><?php echo esb_guide_path( $u['menus'], 'Appearance → Menus' ); // phpcs:ignore WordPress.Security.EscapeOutput ?> — <?php esc_html_e( 'your site has three: the Primary Menu across the top, the Mobile Drawer Menu inside the ☰ button on phones, and Footer Quick Links.', 'excellence-school' ); ?></p>
					<ol>
						<li><?php esc_html_e( 'Pick the menu from the dropdown at the top, click Select.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'On the left, tick the page you want and click Add to Menu.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Drag it into position. Drag it slightly to the right to make it a dropdown sub-item.', 'excellence-school' ); ?></li>
						<li><?php esc_html_e( 'Click Save Menu.', 'excellence-school' ); ?></li>
					</ol>
					<div class="esb-g-note">
						<b><?php esc_html_e( 'Adding Hindi to a menu link', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'Click the small arrow on the menu item to open it, type the Hindi into the Description field, and Save Menu. Cannot see that field? Click Screen Options at the very top-right and tick Description.', 'excellence-school' ); ?></p>
					</div>
				</section>

				<!-- 13 -->
				<section class="esb-g-sec" id="g13">
					<h2><span>13</span><?php esc_html_e( 'The footer', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'The footer is built from widgets — small blocks you can add, remove and drag around at', 'excellence-school' ); ?> <?php echo esb_guide_path( $u['widgets'], 'Appearance → Widgets' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>.</p>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'Area', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Currently holds', 'excellence-school' ); ?></th></tr>
						<tr><td><?php esc_html_e( 'Footer Column 1', 'excellence-school' ); ?></td><td><?php esc_html_e( 'School logo, name and social media links', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Footer Column 2', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Quick Links list', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Footer Column 3', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Explore links list', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Footer Column 4', 'excellence-school' ); ?></td><td><?php esc_html_e( 'The events mini calendar', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Footer Widgets', 'excellence-school' ); ?></td><td><?php esc_html_e( 'A full-width strip below the four columns', 'excellence-school' ); ?></td></tr>
					</table>
					</div>
					<p><?php esc_html_e( 'Drag any widget from one column to another and it moves on the live site. Drag within a column to reorder.', 'excellence-school' ); ?></p>
					<div class="esb-g-note">
						<b><?php esc_html_e( 'Why two widgets have no settings', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'ESB: School Brand and ESB: School Contact deliberately have no fields to fill in. They read your details live from School Settings, so your phone number can never end up different in the footer than everywhere else.', 'excellence-school' ); ?></p>
						<p><?php esc_html_e( 'If you empty a column completely, it falls back to its original built-in content — so you cannot accidentally end up with a broken, empty footer.', 'excellence-school' ); ?></p>
					</div>
				</section>

				<!-- 14 -->
				<section class="esb-g-sec" id="g14">
					<h2><span>14</span><?php esc_html_e( '"I changed it but I cannot see it!"', 'excellence-school' ); ?></h2>
					<p class="esb-g-lede"><?php esc_html_e( 'The most common worry, and almost never a real problem. Work down this list.', 'excellence-school' ); ?></p>
					<ol>
						<li><strong><?php esc_html_e( 'Did you click the blue save button?', 'excellence-school' ); ?></strong> <?php esc_html_e( 'This is the answer most of the time.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'Force a fresh copy.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'Your browser saves a copy of the site to load it faster, and often shows you that old copy.', 'excellence-school' ); ?> <span class="esb-g-kbd">Ctrl+Shift+R</span> <?php esc_html_e( 'on Windows,', 'excellence-school' ); ?> <span class="esb-g-kbd">Cmd+Shift+R</span> <?php esc_html_e( 'on Mac.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'Try a private / incognito window.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'If your change shows there, it was just your browser — the public already sees the new version.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'Wait 2–3 minutes and refresh again.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'The site keeps a short-term cache for speed.', 'excellence-school' ); ?></li>
						<li><strong><?php esc_html_e( 'Check you edited the right place.', 'excellence-school' ); ?></strong> <?php esc_html_e( 'The homepage banner text lives under Page Content → Home, but only for the banner design currently in use. Edit "Hero 1" while the site shows "Hero 2" and nothing will appear to change. The active one is set at Customize → Appearance & Hero → Hero Layout.', 'excellence-school' ); ?></li>
					</ol>
					<p><?php esc_html_e( 'Still wrong after all five? Note down exactly what you changed and where, and send that to your developer.', 'excellence-school' ); ?></p>
				</section>

				<!-- 15 -->
				<section class="esb-g-sec" id="g15">
					<h2><span>15</span><?php esc_html_e( 'Quick answers', 'excellence-school' ); ?></h2>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'I want to…', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Do this', 'excellence-school' ); ?></th></tr>
						<tr><td><?php esc_html_e( 'Change the phone number or address', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['customize'], 'Customize → Contact Information' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Change the pass percentages', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['customize'], 'Customize → Board Results' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Change the principal\'s name or photo', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['customize'], 'Customize → Principal\'s Message' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Change the homepage headline', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['pc_home'], 'Page Content → Home' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Hide a homepage section', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['pc_home'], 'Page Content → Home' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Add a school event', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['events_new'], 'Events → Add New' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Add a notice or circular', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['circulars'], 'Circulars & Notices' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Add a news item', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['news'], 'News & Events' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Add a facility or lab', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['facilities'], 'Facilities' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Add an award or achievement', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['achieve'], 'Achievements' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Change admission steps, documents or FAQs', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['pc_adm'], 'Page Content → Admissions' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Edit Curriculum or Fee Structure', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['pages'], 'Pages' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Add a link to the top menu', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['menus'], 'Appearance → Menus' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Rearrange the footer', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['widgets'], 'Appearance → Widgets' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
						<tr><td><?php esc_html_e( 'Change the site\'s colours or fonts', 'excellence-school' ); ?></td><td><?php echo esb_guide_path( $u['customize'], 'Customize → Colour Palette' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></td></tr>
					</table>
					</div>
				</section>

				<!-- 16 -->
				<section class="esb-g-sec" id="g16">
					<h2><span>16</span><?php esc_html_e( 'What not to touch', 'excellence-school' ); ?></h2>
					<p><?php esc_html_e( 'Everything else in this guide is safe. These few things are not — please leave them to your developer.', 'excellence-school' ); ?></p>
					<div class="esb-g-scroll">
					<table>
						<tr><th><?php esc_html_e( 'Avoid', 'excellence-school' ); ?></th><th><?php esc_html_e( 'Why', 'excellence-school' ); ?></th></tr>
						<tr><td><?php esc_html_e( 'Appearance → Theme File Editor', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Edits the website\'s actual code. One wrong character can take the whole site offline.', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Tools → Plugin File Editor', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Same reason.', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Deactivating or deleting plugins', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Removing The Events Calendar or Forminator would break your events and admission form.', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Switching to a different theme', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Your entire design would disappear.', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Deleting pages you did not create', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Some pages are wired into menus and links; deleting them causes "page not found" errors.', 'excellence-school' ); ?></td></tr>
						<tr><td><?php esc_html_e( 'Settings → Permalinks', 'excellence-school' ); ?></td><td><?php esc_html_e( 'Changes every web address on your site and breaks links other people have already shared.', 'excellence-school' ); ?></td></tr>
					</table>
					</div>
					<div class="esb-g-note stop">
						<b><?php esc_html_e( 'A safe habit', 'excellence-school' ); ?></b>
						<p><?php esc_html_e( 'If a screen is full of code, or you catch yourself thinking "I am not sure what this does" — stop and ask. It is much quicker to ask first than to repair afterwards.', 'excellence-school' ); ?></p>
						<p><?php esc_html_e( 'Also ask your host or developer about backups. Knowing you have a recent one turns a mistake into a five-minute fix rather than a crisis.', 'excellence-school' ); ?></p>
					</div>
					<h3><?php esc_html_e( 'Need help?', 'excellence-school' ); ?></h3>
					<p><?php esc_html_e( 'Three things get your problem solved much faster: the page address, what you expected versus what happened, and a screenshot.', 'excellence-school' ); ?></p>
				</section>

			</div>
		</div>
	</div>
	<?php
}

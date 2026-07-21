<?php
/**
 * Student Achievements section — pulls from esb_achievement CPT
 *
 * @package excellence-school
 */
$query = new WP_Query( [
	'post_type'      => 'esb_achievement',
	'posts_per_page' => 3,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
] );

/* Fallback static data shown before CPT is populated */
$static = [
	[
		'badge' => 'State Champion',
		'badge_hi' => 'राज्य चैंपियन',
		'title' => 'State-Level Boxing Gold',
		'title_hi' => 'राज्य स्तरीय बॉक्सिंग स्वर्ण',
		'desc_en' => 'Our boxers brought home multiple medals at the MP State School Games, continuing a proud tradition.',
		'desc_hi' => 'हमारे मुक्केबाजों ने एमपी राज्य स्कूल खेलों में कई पदक जीते, एक गौरवशाली परंपरा को जारी रखते हुए।',
		'label' => 'boxing-medal.jpg',
	],
	[
		'badge' => 'Academics',
		'badge_hi' => 'शिक्षा',
		'title' => 'District Merit Toppers',
		'title_hi' => 'जिला मेरिट टॉपर',
		'desc_en' => 'Several students featured in the district merit list with scores above 95% in the 2025 board exams.',
		'desc_hi' => '2025 बोर्ड परीक्षा में 95% से अधिक अंकों के साथ कई विद्यार्थी जिला मेरिट सूची में रहे।',
		'label' => 'merit-list.jpg',
	],
	[
		'badge' => 'Innovation',
		'badge_hi' => 'नवाचार',
		'title' => 'ATL Innovation Showcase',
		'title_hi' => 'एटीएल नवाचार प्रदर्शनी',
		'desc_en' => 'Tinkering Lab teams presented working robotics and IoT prototypes at the regional innovation fair.',
		'desc_hi' => 'टिंकरिंग लैब टीमों ने क्षेत्रीय नवाचार मेले में रोबोटिक्स व आईओटी प्रोटोटाइप प्रस्तुत किए।',
		'label' => 'atl-robotics.jpg',
	],
];
?>
<section class="section" id="achievements" style="background:var(--cream)">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow center" data-en="Student Achievements" data-hi="छात्र उपलब्धियां">
				<?php esc_html_e( 'Student Achievements', 'excellence-school' ); ?>
			</span>
			<h2 data-en="Champions in the Classroom &amp; Beyond" data-hi="कक्षा और उससे परे चैंपियन">
				<?php esc_html_e( 'Champions in the Classroom & Beyond', 'excellence-school' ); ?>
			</h2>
		</div>
		<div class="grid ach-grid stagger-grid">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$badge = get_post_meta( get_the_ID(), '_esb_badge_label', true );
				?>
				<a class="card ach-card reveal" href="<?php the_permalink(); ?>">
					<?php esb_thumb( get_the_ID(), 'medium_large', get_the_title() ); ?>
					<div class="body">
						<?php if ( $badge ) : ?>
						<span class="pill gold"><?php echo esc_html( $badge ); ?></span>
						<?php endif; ?>
						<h3><?php the_title(); ?></h3>
						<p><?php the_excerpt(); ?></p>
					</div>
				</a>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( $static as $item ) : ?>
				<div class="card ach-card reveal">
					<div class="ph" data-label="<?php echo esc_attr( $item['label'] ); ?>"></div>
					<div class="body">
						<span class="pill gold"
						      data-en="<?php echo esc_attr( $item['badge'] ); ?>"
						      data-hi="<?php echo esc_attr( $item['badge_hi'] ); ?>">
							<?php echo esc_html( $item['badge'] ); ?>
						</span>
						<h3 data-en="<?php echo esc_attr( $item['title'] ); ?>" data-hi="<?php echo esc_attr( $item['title_hi'] ); ?>">
							<?php echo esc_html( $item['title'] ); ?>
						</h3>
						<p data-en="<?php echo esc_attr( $item['desc_en'] ); ?>" data-hi="<?php echo esc_attr( $item['desc_hi'] ); ?>">
							<?php echo esc_html( $item['desc_en'] ); ?>
						</p>
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
/**
 * News & Events section — pulls from esb_news CPT
 *
 * @package excellence-school
 */
$query = new WP_Query( [
	'post_type'      => 'esb_news',
	'posts_per_page' => 3,
	'orderby'        => 'date',
	'order'          => 'DESC',
] );

$static = [
	[
		'date_en' => '15 June 2026', 'date_hi' => '15 जून 2026',
		'title_en' => 'Admissions Open for 2026–27', 'title_hi' => '2026–27 हेतु प्रवेश प्रारंभ',
		'desc_en' => 'Applications are now open for Classes IX to XII across all streams. Limited seats available.',
		'desc_hi' => 'कक्षा 9 से 12 तक सभी संकायों हेतु आवेदन प्रारंभ। सीमित सीटें उपलब्ध।',
		'link' => 'admissions',
		'label' => 'admission-notice.jpg',
	],
	[
		'date_en' => '28 May 2026', 'date_hi' => '28 मई 2026',
		'title_en' => 'Annual Sports Meet 2026', 'title_hi' => 'वार्षिक खेलकूद 2026',
		'desc_en' => 'Three days of athletics, boxing and cricket finals celebrated the spirit of sportsmanship.',
		'desc_hi' => 'तीन दिनों के एथलेटिक्स, बॉक्सिंग व क्रिकेट फाइनल ने खेल भावना का उत्सव मनाया।',
		'link' => '#news',
		'label' => 'sports-day.jpg',
	],
	[
		'date_en' => '10 May 2026', 'date_hi' => '10 मई 2026',
		'title_en' => 'ATL Innovation Expo', 'title_hi' => 'एटीएल नवाचार एक्सपो',
		'desc_en' => 'Students showcased robotics and sustainability projects to parents and district officials.',
		'desc_hi' => 'विद्यार्थियों ने अभिभावकों व जिला अधिकारियों के समक्ष रोबोटिक्स व स्थिरता परियोजनाएं प्रस्तुत कीं।',
		'link' => '#news',
		'label' => 'science-expo.jpg',
	],
];
?>
<section class="section" id="news" style="background:var(--cream)">
	<div class="container">
		<div class="section-head reveal" style="display:flex;justify-content:space-between;align-items:flex-end;max-width:none;gap:24px;flex-wrap:wrap">
			<div style="max-width:620px">
				<span class="eyebrow" data-en="News &amp; Events" data-hi="समाचार व आयोजन">
					<?php esc_html_e( 'News & Events', 'excellence-school' ); ?>
				</span>
				<h2 data-en="What's Happening on Campus" data-hi="परिसर में क्या हो रहा है">
					<?php esc_html_e( "What's Happening on Campus", 'excellence-school' ); ?>
				</h2>
			</div>
			<a href="<?php echo esc_url( home_url( '/news/' ) ); ?>" class="btn btn-outline"
			   data-en="View All News" data-hi="सभी समाचार">
				<?php esc_html_e( 'View All News', 'excellence-school' ); ?>
			</a>
		</div>
		<div class="grid news-grid">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<div class="card news-card reveal">
					<?php esb_thumb( get_the_ID(), 'medium_large', get_the_title() ); ?>
					<div class="body">
						<div class="date">
							<span class="diamond" style="width:7px;height:7px;background:var(--gold-500)"></span>
							<span><?php echo esc_html( get_the_date() ); ?></span>
						</div>
						<h3><?php the_title(); ?></h3>
						<p><?php the_excerpt(); ?></p>
						<a class="more" href="<?php the_permalink(); ?>"
						   data-en="Read more" data-hi="और पढ़ें">
							<?php esc_html_e( 'Read more', 'excellence-school' ); ?>
						</a>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( $static as $item ) : ?>
				<div class="card news-card reveal">
					<div class="ph" data-label="<?php echo esc_attr( $item['label'] ); ?>"></div>
					<div class="body">
						<div class="date">
							<span class="diamond" style="width:7px;height:7px;background:var(--gold-500)"></span>
							<span data-en="<?php echo esc_attr( $item['date_en'] ); ?>" data-hi="<?php echo esc_attr( $item['date_hi'] ); ?>">
								<?php echo esc_html( $item['date_en'] ); ?>
							</span>
						</div>
						<h3 data-en="<?php echo esc_attr( $item['title_en'] ); ?>" data-hi="<?php echo esc_attr( $item['title_hi'] ); ?>">
							<?php echo esc_html( $item['title_en'] ); ?>
						</h3>
						<p data-en="<?php echo esc_attr( $item['desc_en'] ); ?>" data-hi="<?php echo esc_attr( $item['desc_hi'] ); ?>">
							<?php echo esc_html( $item['desc_en'] ); ?>
						</p>
						<a class="more"
						   href="<?php echo esc_url( strpos( $item['link'], '#' ) === 0 ? home_url( '/' . $item['link'] ) : home_url( '/' . $item['link'] . '/' ) ); ?>"
						   data-en="Read more" data-hi="और पढ़ें">
							<?php esc_html_e( 'Read more', 'excellence-school' ); ?>
						</a>
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
/**
 * Facilities section — pulls from esb_facility CPT
 *
 * @package excellence-school
 */
$query = new WP_Query( [
	'post_type'      => 'esb_facility',
	'posts_per_page' => 6,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
] );

$static = [
	[ 'tag' => 'Learning',   'tag_hi' => 'अधिगम',   'title' => 'Smart Classrooms',   'title_hi' => 'स्मार्ट कक्षाएं',          'desc' => 'Digital boards and projectors bring interactive, visual learning into every lesson.',                          'desc_hi' => 'डिजिटल बोर्ड और प्रोजेक्टर हर पाठ में इंटरैक्टिव, दृश्य अधिगम लाते हैं।', 'label' => 'smart-classroom.jpg' ],
	[ 'tag' => 'STEM',       'tag_hi' => 'विज्ञान', 'title' => 'Science Labs',        'title_hi' => 'विज्ञान प्रयोगशालाएं',  'desc' => 'Dedicated Physics, Chemistry and Biology labs with modern apparatus for hands-on practicals.',                'desc_hi' => 'आधुनिक उपकरणों से युक्त भौतिकी, रसायन व जीव विज्ञान की प्रयोगशालाएं।', 'label' => 'science-lab.jpg' ],
	[ 'tag' => 'Innovation', 'tag_hi' => 'नवाचार', 'title' => 'ATAL Tinkering Lab', 'title_hi' => 'अटल टिंकरिंग लैब',       'desc' => 'A NITI Aayog–sanctioned lab for robotics, electronics and 21st-century STEM skills.',                          'desc_hi' => 'रोबोटिक्स, इलेक्ट्रॉनिक्स व 21वीं सदी के कौशल हेतु नीति आयोग द्वारा स्वीकृत लैब।', 'label' => 'atal-tinkering-lab.jpg' ],
	[ 'tag' => 'Reading',    'tag_hi' => 'अध्ययन', 'title' => 'Library',             'title_hi' => 'पुस्तकालय',              'desc' => 'Over 5,000 books, periodicals and digital resources in a calm space for study and research.',                 'desc_hi' => 'अध्ययन व शोध हेतु शांत स्थान में 5,000 से अधिक पुस्तकें, पत्रिकाएं व डिजिटल संसाधन।', 'label' => 'library.jpg' ],
	[ 'tag' => 'Digital',    'tag_hi' => 'डिजिटल', 'title' => 'Computer Lab',        'title_hi' => 'कंप्यूटर लैब',          'desc' => '25 modern systems with internet access for programming and digital literacy.',                                'desc_hi' => 'प्रोग्रामिंग व डिजिटल साक्षरता हेतु इंटरनेट सहित 25 आधुनिक सिस्टम।', 'label' => 'computer-lab.jpg' ],
	[ 'tag' => 'Sports',     'tag_hi' => 'खेल',    'title' => 'Sports Complex',      'title_hi' => 'खेल परिसर',              'desc' => 'A cricket ground, indoor badminton court and boxing ring with professional coaching.',                          'desc_hi' => 'पेशेवर कोचिंग के साथ क्रिकेट मैदान, इनडोर बैडमिंटन कोर्ट व बॉक्सिंग रिंग।', 'label' => 'sports-ground.jpg' ],
];
?>
<section class="section facilities" id="facilities">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow center light" data-en="Facilities Showcase" data-hi="सुविधाएं">
				<?php esc_html_e( 'Facilities Showcase', 'excellence-school' ); ?>
			</span>
			<h2 data-en="Built for the 21st-Century Learner" data-hi="21वीं सदी के विद्यार्थी के लिए निर्मित">
				<?php esc_html_e( 'Built for the 21st-Century Learner', 'excellence-school' ); ?>
			</h2>
		</div>
		<div class="grid fac-grid stagger-grid">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php $fac_tag = get_post_meta( get_the_ID(), '_esb_fac_tag', true ); ?>
				<div class="fac-card reveal">
					<?php esb_thumb( get_the_ID(), 'medium_large', get_the_title(), '', true ); ?>
					<div class="body">
						<?php if ( $fac_tag ) : ?>
						<span class="fac-tag"><?php echo esc_html( $fac_tag ); ?></span>
						<?php endif; ?>
						<h3><?php the_title(); ?></h3>
						<p><?php the_excerpt(); ?></p>
					</div>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( $static as $fac ) : ?>
				<div class="fac-card reveal">
					<div class="ph dark" data-label="<?php echo esc_attr( $fac['label'] ); ?>"></div>
					<div class="body">
						<span class="fac-tag"
						      data-en="<?php echo esc_attr( $fac['tag'] ); ?>"
						      data-hi="<?php echo esc_attr( $fac['tag_hi'] ); ?>">
							<?php echo esc_html( $fac['tag'] ); ?>
						</span>
						<h3 data-en="<?php echo esc_attr( $fac['title'] ); ?>" data-hi="<?php echo esc_attr( $fac['title_hi'] ); ?>">
							<?php echo esc_html( $fac['title'] ); ?>
						</h3>
						<p data-en="<?php echo esc_attr( $fac['desc'] ); ?>" data-hi="<?php echo esc_attr( $fac['desc_hi'] ); ?>">
							<?php echo esc_html( $fac['desc'] ); ?>
						</p>
					</div>
				</div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

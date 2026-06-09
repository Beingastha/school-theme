<?php
/**
 * Gallery grid section — pulls from esb_gallery CPT
 *
 * @package excellence-school
 */
$query = new WP_Query( [
	'post_type'      => 'esb_gallery',
	'posts_per_page' => 8,
	'orderby'        => 'menu_order date',
	'order'          => 'ASC',
] );

$placeholders = [
	[ 'label' => 'campus-1.jpg',  'tall' => true ],
	[ 'label' => 'classroom.jpg', 'tall' => false ],
	[ 'label' => 'lab.jpg',       'tall' => false ],
	[ 'label' => 'assembly.jpg',  'tall' => true ],
	[ 'label' => 'library.jpg',   'tall' => false ],
	[ 'label' => 'cricket.jpg',   'tall' => false ],
	[ 'label' => 'cultural.jpg',  'tall' => false ],
	[ 'label' => 'award.jpg',     'tall' => false ],
];
?>
<section class="section" id="gallery">
	<div class="container">
		<div class="section-head center reveal">
			<span class="eyebrow center" data-en="Gallery" data-hi="गैलरी">
				<?php esc_html_e( 'Gallery', 'excellence-school' ); ?>
			</span>
			<h2 data-en="Moments from Our Campus" data-hi="हमारे परिसर के क्षण">
				<?php esc_html_e( 'Moments from Our Campus', 'excellence-school' ); ?>
			</h2>
		</div>
		<div class="gal-grid reveal">
			<?php if ( $query->have_posts() ) : ?>
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php
				$span     = get_post_meta( get_the_ID(), '_esb_gallery_span', true );
				$img_url  = get_the_post_thumbnail_url( get_the_ID(), 'medium_large' );
				$classes  = 'gal-item' . ( 'tall' === $span ? ' tall' : '' );
				?>
				<div class="<?php echo esc_attr( $classes ); ?>">
					<?php if ( $img_url ) : ?>
						<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" loading="lazy" />
					<?php else : ?>
						<div class="ph" data-label="<?php the_title_attribute(); ?>"></div>
					<?php endif; ?>
				</div>
				<?php endwhile; wp_reset_postdata(); ?>
			<?php else : ?>
				<?php foreach ( $placeholders as $ph ) : ?>
				<div class="ph<?php echo $ph['tall'] ? ' tall' : ''; ?>" data-label="<?php echo esc_attr( $ph['label'] ); ?>"></div>
				<?php endforeach; ?>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php
/**
 * Single News item template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">
	<?php while ( have_posts() ) : the_post(); ?>
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<a href="<?php echo esc_url( home_url( '/news/' ) ); ?>"><?php esc_html_e( 'News', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span><?php the_title(); ?></span>
			</div>
			<span class="eyebrow light"><?php echo esc_html( get_the_date() ); ?></span>
			<h1><?php the_title(); ?></h1>
		</div>
	</section>
	<div class="container section">
		<?php if ( has_post_thumbnail() ) : ?>
		<div style="border-radius:var(--r-lg);overflow:hidden;max-height:480px;margin-bottom:40px">
			<?php the_post_thumbnail( 'large', [ 'style' => 'width:100%;object-fit:cover' ] ); ?>
		</div>
		<?php endif; ?>
		<div class="entry-content" style="max-width:720px">
			<?php the_content(); ?>
		</div>
	</div>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>

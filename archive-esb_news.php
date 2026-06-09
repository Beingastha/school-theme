<?php
/**
 * News archive template
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">
	<section class="pagehero">
		<div class="container">
			<div class="breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Home', 'excellence-school' ); ?></a>
				&nbsp;/&nbsp;
				<span><?php esc_html_e( 'News & Events', 'excellence-school' ); ?></span>
			</div>
			<span class="eyebrow light" data-en="News &amp; Events" data-hi="समाचार व आयोजन"><?php esc_html_e( 'News & Events', 'excellence-school' ); ?></span>
			<h1 data-en="What's Happening on Campus" data-hi="परिसर में क्या हो रहा है"><?php esc_html_e( "What's Happening on Campus", 'excellence-school' ); ?></h1>
		</div>
	</section>
	<section class="section">
		<div class="container">
			<div class="grid news-grid">
				<?php while ( have_posts() ) : the_post(); ?>
				<div class="card news-card reveal">
					<?php esb_thumb( get_the_ID(), 'medium_large', get_the_title() ); ?>
					<div class="body">
						<div class="date">
							<span class="diamond" style="width:7px;height:7px;background:var(--gold-500)"></span>
							<span><?php echo esc_html( get_the_date() ); ?></span>
						</div>
						<h3><?php the_title(); ?></h3>
						<p><?php the_excerpt(); ?></p>
						<a class="more" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'excellence-school' ); ?></a>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>

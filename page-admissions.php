<?php
/**
 * Admissions page template — thin shell only.
 *
 * All content for this page now lives in the Gutenberg editor (Pages ->
 * Admissions), so it can be edited/reordered from wp-admin without touching
 * code. This file just wraps whatever blocks are saved there.
 *
 * @package excellence-school
 */
get_header();
?>
<main id="main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>

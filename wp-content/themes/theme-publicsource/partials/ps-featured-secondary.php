<?php
/**
 * Template for secondary featured posts on the homepage and category header
 */
?>
<div <?php post_class( 'story' ); ?> >
	<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	<h5 class="byline"><?php largo_byline( true, true, get_the_ID() ); ?></h5>
</div>


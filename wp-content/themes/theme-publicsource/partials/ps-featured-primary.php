<?php
/**
 * Template for primary featured post, used on homepage and category headers
 */
?>
<a href="<?php the_permalink(); ?>">
	<?php the_post_thumbnail( 'large' ); ?>
</a>
<div class="has-thumbnail">
	<a href="<?php the_permalink(); ?>" class="clickable"></a>
	<div class="has-thumbnail-inner">
		<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<h5 class="byline"><?php largo_byline( true, true, get_the_ID() ); ?></h5>
	</div>
</div>

<?php
/**
 * Home Template: PublicSource
 * Description: Custom homepage template for publicsource.org
 */

global $largo, $shown_ids, $tags;
?>
<div id="homepage-featured" class="row-fluid clearfix">

	<div class="top-story span8">

	<?php
		$topstory = largo_get_featured_posts( array(
			'tax_query' => array(
				array(
					'taxonomy' 	=> 'prominence',
					'field' 	=> 'slug',
					'terms' 	=> 'top-story'
				)
			),
			'posts_per_page' => 1
		) );
		if ( $topstory->have_posts() ) :
			while ( $topstory->have_posts() ) : $topstory->the_post(); $shown_ids[] = get_the_ID();
				get_template_part( 'partials/ps-featured', 'primary' );
			endwhile;
		endif; // end top story ?>
	</div>

	<div class="sub-stories span4">
		<h5 class="top-tag">The Latest</h5>
		<?php
			$posts_per_page = 4;
			$posts_per_page = apply_filters( 'largo_homepage_topstories_post_count', $posts_per_page );
			$substories = largo_get_featured_posts( array(
				'tax_query' => array(
					array(
						'taxonomy' 	=> 'prominence',
						'field' 	=> 'slug',
						'terms' 	=> 'homepage-featured'
					)
				),
				'posts_per_page' => $posts_per_page,
				'post__not_in' 	 => $shown_ids
			) );
			if ( $substories->have_posts() ) :
				$count = 0;
				while ( $substories->have_posts() ) : $substories->the_post(); $shown_ids[] = get_the_ID();
					get_template_part( 'partials/ps-featured', 'secondary' );
					$count++;
				endwhile;
			endif; // end more featured posts 
	
			// If not enough featured posts, backfill with recent posts
			if ( $count < 4 ) :
				$args = array (
					'posts_per_page' => ( 4 - $count ),
					'post__not_in' 	 => $shown_ids
				);
				$recent_posts = new WP_Query( $args );
	
				if ( $recent_posts->have_posts() ) :
					while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); $shown_ids[] = get_the_ID();
						get_template_part( 'partials/ps-featured', 'secondary' );
						$count++; 
					endwhile; 
				endif; // end more featured posts 
			endif; // end if $count < 3
		?>
	</div>
</div>

<div id="home-interstitial-1" class="interstitial">
	<?php
		dynamic_sidebar( __( 'Homepage Interstitial 1', 'publicsource' ) );
	?>
</div>

<div class="row-fluid" id="home-recent-grid">
		<div class="span8">
			<?php
			$args = array (
				'posts_per_page' => 4,
				'post__not_in' 	 => $shown_ids
			);
			$recent_posts = new WP_Query( $args );
	
			if ( $recent_posts->have_posts() ) : ?>
				<div class="row-fluid">
					<?php while ( $recent_posts->have_posts() ) : $recent_posts->the_post(); $shown_ids[] = get_the_ID(); ?>
	
							<div class="span6">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'large' ); ?>
								</a>
								<h5 class="top-tag"><?php largo_top_term(); ?></h5>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							</div>
	
					<?php endwhile; ?>
				</div>
			<?php endif; // end more featured posts ?>
		</div>
		<div class="span4 sidebar">
		  <?php
		    dynamic_sidebar( __( 'Homepage Sidebar', 'publicsource' ) );
	      ?>
		</div>
</div>

<div id="home-interstitial-2" class="interstitial">
	<?php
		dynamic_sidebar( __( 'Homepage Interstitial 2', 'publicsource' ) );
	?>
</div>

<div id="home-middle-feature">
	<?php
	$args = array (
		'tax_query' => array (
			array (
				'taxonomy' 	=> 'prominence',
				'field' 	=> 'slug',
				'terms' 	=> 'home-middle-feature'
			)
		),
		'posts_per_page' => 1
	);
	$posts = new WP_Query( $args );

	if ( $posts->have_posts() ) :
		while ( $posts->have_posts() ) : $posts->the_post(); $shown_ids[] = get_the_ID(); 
		?>
			<div class="top-tag-wrap"><h5 class="top-tag"><?php _e( 'Featured Story', 'publicsource' ) ?></h5></div>
			<div class="span8">
				<a href="<?php the_permalink(); ?>">
					<?php the_post_thumbnail( 'large' ); ?>
				</a>
			</div>
			<div class="span4">
				<div class="post-lead">
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<h5 class="byline"><?php largo_byline( true, true ); ?></h5>
					<?php largo_excerpt(); ?>
				</div>
			</div>		
		<?php 
			$count++; 
		endwhile;
	endif; // end more featured posts 
	?>
</div>

<div id="home-interstitial-3" class="interstitial">
	<?php
		dynamic_sidebar( __( 'Homepage Interstitial 3', 'publicsource' ) );
	?>
</div>

<div id="home-category-grid">
	<div class="row-fluid">
		<?php if ( !dynamic_sidebar( 'Home Category Grid' ) ) { ?>
			<aside class="span4" style="display:block;margin-left: auto;margin-right: auto;background-color:#ddd;color:#bb0000; text-align: center;"> Add some widgets to the Home Category widget area.</aside>
		<?php } ?>
	</div>
</div>

<div id="home-interstitial-4" class="interstitial">
	<?php
		dynamic_sidebar( __( 'Homepage Interstitial 4', 'publicsource' ) );
	?>
</div>

<div id="home-bottom-feature">
	<div class="row-fluid">
		<?php if ( !dynamic_sidebar( 'Home Bottom Feature' ) ) { ?>
			<aside class="span4" style="display:block;margin-left: auto;margin-right: auto;background-color:#ddd;color:#bb0000; text-align: center;"> Add some widgets to the Home Bottom Feature widget area.</aside>
		<?php } ?>
	</div>
</div>

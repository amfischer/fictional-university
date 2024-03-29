<?php get_header(); ?>

<div class="page-banner">
  <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri( '/images/library-hero.jpg' ); ?>);"></div>
  <div class="page-banner__content container t-center c-white">
	<h1 class="headline headline--large">Welcome!</h1>
	<h2 class="headline headline--medium">We think you&rsquo;ll like it here.</h2>
	<h3 class="headline headline--small">Why don&rsquo;t you check out the <strong>major</strong> you&rsquo;re interested in?</h3>
	<a href="<?php echo get_post_type_archive_link( 'program' ); ?>" class="btn btn--large btn--blue">Find Your Major</a>
  </div>
</div>

<div class="full-width-split group">
  <div class="full-width-split__one">
	<div class="full-width-split__inner">
	  <h2 class="headline headline--small-plus t-center">Upcoming Events</h2>
		<?php
		$events = new WP_Query(
			array(
				'posts_per_page' => 2,
				'post_type'      => 'event',
				'meta_key'       => 'event_date',
				'orderby'        => 'meta_value_num',
				'order'          => 'ASC',
				'meta_query'     => array(
					array(
						'key'     => 'event_date',
						'compare' => '>=',
						'value'   => date( 'Ymd' ),
						'type'    => 'numeric',
					),
				),
			)
		);

		if ( $events->have_posts() ) {
			while ( $events->have_posts() ) {
				$events->the_post();
				$date = new DateTime( get_field( 'event_date' ) );
				get_template_part( 'template-parts/content', 'event', array( 'date' => $date ) );
			}
			wp_reset_postdata();
		} else {
			echo '<p>Sorry, no results found.</p>';
		}
		?>
	  <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link( 'event' ); ?>" class="btn btn--blue">View All Events</a></p>
	</div>
  </div>
  <div class="full-width-split__two">
	<div class="full-width-split__inner">
	  <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>

		<?php
		$args      = array(
			'posts_per_page' => 2,
			'author_name'    => 'blooh',
		);
		$args      = array( 'posts_per_page' => 2 );
		$blogPosts = new WP_Query( $args );
		if ( $blogPosts->have_posts() ) :
			while ( $blogPosts->have_posts() ) :
				$blogPosts->the_post();
				?>
		  <div class="event-summary">
			<a class="event-summary__date event-summary__date--beige t-center" href="<?php the_permalink(); ?>">
			  <span class="event-summary__month"><?php the_time( 'M' ); ?></span>
			  <span class="event-summary__day"><?php the_time( 'd' ); ?></span>
			</a>
			<div class="event-summary__content">
			  <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
			  <p><?php echo has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 18 ); ?><a href="<?php the_permalink(); ?>" class="nu gray">
				  Read more</a></p>
			</div>
		  </div>
					<?php
		endwhile;
			wp_reset_postdata();
			?>
		  <p class="t-center no-margin"><a href="<?php echo site_url( '/blog' ); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
		<?php else : ?>
		  <p class="t-center no-margin"><span class="btn btn--blue">Sorry, no posts to display :(</span></p>
		<?php endif; ?>
	</div>
  </div>
</div>

<?php

$fields = get_fields();
$args   = array();

for ( $i = 1; $i < 4; $i++ ) {
	if ( '' === $fields[ 'title_' . $i ] || '' === $fields[ 'description_' . $i ] || '' === $fields[ 'link_' . $i ] || empty( $fields[ 'image_' . $i ] ) ) {
		continue;
	}
	$args[] = array(
		'title'       => $fields[ 'title_' . $i ],
		'description' => $fields[ 'description_' . $i ],
		'link'        => $fields[ 'link_' . $i ],
		'image'       => $fields[ 'image_' . $i ]['url'],
	);
}

get_template_part( 'template-parts/home/slide-show', null, $args );

get_footer();

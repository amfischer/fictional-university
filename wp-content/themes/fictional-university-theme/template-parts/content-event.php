<div class="event-summary">
	<a class="event-summary__date t-center" href="#">
		<span class="event-summary__month"><?php echo esc_html( $args['date']->format( 'M' ) ); ?></span>
		<span class="event-summary__day"><?php echo esc_html( $args['date']->format( 'd' ) ); ?></span>
	</a>
	<div class="event-summary__content">
		<h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
		<p>
			<?php
			$text = has_excerpt() ? get_the_excerpt() : wp_trim_words( get_the_content(), 18 );
			echo esc_html( $text );
			?>
			<a href="<?php the_permalink(); ?>" class="nu gray"> Learn more</a>
		</p>
	</div>
</div>

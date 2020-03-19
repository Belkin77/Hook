<?php

add_shortcode('blog_posts', 'get_blog_posts');
function get_blog_posts() {

	switch_to_blog( 10 );

	$output = "<div class='blog_extract_post'><div class='owl-carousel owl-theme'>";
	$args = new WP_Query( array( 'category__in' => array( 11, 12, 8, 3 ), 'posts_per_page' => 3 ) );

	// Query
	if ( $args->have_posts() ) : while ( $args->have_posts() ) : $args->the_post();

		ob_start();

		// Iinitialisation des variables communes

		$categories = get_the_category();

		$term_meta = get_term_meta($categories[0]->term_id);

		// On récupère l'image associée à la catégorie

		$url_image_category_current = get_image_for_a_category($categories[0]->term_id);

		$output .= "<div class='first_post' class='item'>";

		$output .= the_title('<div class="title_bloc"><span id="title_first_post"><a href='. get_permalink() .'>','</a></span></div>');

		$output .= ob_get_clean(); // Permettre de rediger le tampon de sortie de façon relative

		$output .= "<div class='categories-first-post'><a href='".get_category_link(get_cat_ID($categories[0]->name))."'><img class='category_image_post' src=".$url_image_category_current.">".esc_html( $categories[0]->name )."</a></div>";

		$output .= "<div class='thumbnail_first_image'><a href='".get_permalink() ."'>". get_the_post_thumbnail( '', 'full', array( 'class' => 'aligncenter' ) ). "</a></div>";

		$output .= "<div class='excerpt_first_post'>". wp_trim_words( get_the_excerpt(), 15, '...' ) ."</div>";

		$output .= "<img class='border_read_more' src='wp-content/themes/elephant-maison-blog/img/border_read_more.png'/>";

		$output .= "<div class='excerpt_more'><a class='chevron_droite' href='".get_permalink() ."'>Lire la suite</a></div>";

		$output .= "</div>";

	endwhile;

	endif;

	$output .= "</div></div>";

	$output .= "<div class='owl-nav'><button type='button' role='presentation' class='owl-prev'><span aria-label='Previous'>‹</span></button><button type='button' role='presentation' class='owl-next'><span aria-label='Next'>›</span></button></div>";

	restore_current_blog();

	return $output;

}
<?php
class SLSW_Class_Testimonials extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname' => 'slsw_class_testimonials',
			'description' => 'Class Testimonials',
		);
		parent::__construct('slsw_class_testimonials', 'Class Testimonials', $widget_ops);
	}

	function form($instance) {
		// displays the widget form in the admin dashboard
	}

	function update ($new_instance, $old_instances) {
		// processes widget options to save
	}

	public function widget($args, $instance) {
		// displays the widget

		global $wp_query;
		$post = $wp_query->post;

		// Only show widget for class productions
		if ($post->post_type != 'product') {
			return;
		}
		if (get_field('product_type') != 'class') {
			return;
		}

		$post_id = $post->ID;
		$testimonial_posts = get_field('testimonials');

		// Are any teachers listed for this class?
		if (empty($testimonial_posts) || count($testimonial_posts) <= 0) {
			return;
		}

		// Display the content
		echo '<article class="widget">';
		echo "<h6>Testimonials$teacher_string</h6>";
		foreach ($testimonial_posts as $t) {
			$t_link = get_the_permalink($t->ID);

			if (get_the_post_thumbnail($t)) {
				echo get_the_post_thumbnail( $t );
			}
			echo '<blockquote>';
			echo $t->post_content;
			echo '<cite>'.get_field('testimonial_author', $t->ID).'</cite>';
			echo '</blockquote>';
		}
		echo '</article>';
	}
}

?>

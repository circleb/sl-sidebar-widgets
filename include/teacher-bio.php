<?php
class SLSW_Teacher_Bio extends WP_Widget {
	function __construct() {
		$widget_ops = array(
			'classname' => 'slsw_teacher_bio',
			'description' => 'Teacher Bio - for class pages',
		);
		parent::__construct('slsw_teacher_bio', 'Teacher Bio', $widget_ops);
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
		$teacher_posts = get_field('class_teachers');

		// Are any teachers listed for this class?
		if (empty($teacher_posts) || count($teacher_posts) <= 0) {
			return;
		}

		// Display the content
		echo '<article class="widget">';
		$teacher_string = "Teacher";
		if (count($teacher_posts) > 1) {
			$teacher_string = "Teachers"; // Pluralize
		}
		echo "<h6>$teacher_string</h6>";
		foreach ($teacher_posts as $t) {
			$t_link = get_the_permalink($t->ID);

			echo '<div class="slsw-teacher">';
			printf( '<a class="slsw-teacher-thumb" data-open="teacher%s">%s</a>', $t->ID, get_the_post_thumbnail( $t ) );
			printf( '<a class="slsw-teacher-title" data-open="teacher%s">%s</a>', $t->ID, $t->post_title );
			echo '</div>';
			printf( '<div class="reveal" id="teacher%s" data-reveal>', $t->ID );
			printf( '<h1>%s</h1>', $t->post_title );
			printf( '<p>%s</p>', $t->post_content );
			echo '<button class="close-button" data-close aria-label="Close modal" type="button"><span aria-hidden="true">&times;</span></button>
			</div>';
		}
		echo '</article>';
	}
}

?>

<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.example.com
 * @since      1.0.0
 *
 * @package    Zwivel_Related_Qa
 * @subpackage Zwivel_Related_Qa/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Zwivel_Related_Qa
 * @subpackage Zwivel_Related_Qa/public
 * @author     VivifyIdeas <aleksandar.s@vivifyideas.com>
 */
class Zwivel_Related_Qa_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zwivel_Related_Qa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zwivel_Related_Qa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/zwivel-related-qa-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Zwivel_Related_Qa_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Zwivel_Related_Qa_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/zwivel-related-qa-public.js', array( 'jquery' ), $this->version, false );

	}

	public function related_qa($attributes, $content = ''){

		$count = !empty($attributes['count']) ? $attributes['count'] : '';
		$id = get_the_ID();
		$tags = get_the_tags($id);

		$tagSlugs = [false];
		$cacheKeyForThreads = null;

		if (is_array($tags)) {
			$tagSlugs = array_map(create_function('$o', 'return $o->slug;'), $tags);
			$cacheKeyForThreads = "related_qa_post_tags_" . implode($tagSlugs, '_');
		}

		$cacheKeyForNoMatchingTags = "related_qa_no_matching_tags_post_id_{$id}";

		if ( false === ( $threads = get_transient( $cacheKeyForThreads ) ) || false === ( $noMatchingTags = get_transient( $cacheKeyForNoMatchingTags ) ) ) {
			$tagForQuery = http_build_query(['tags' => $tagSlugs, 'count' => $count]);
			$url = "https://www.zwivel.com/forum/api/threads/tagged-with-name?{$tagForQuery}";
			$response = wp_remote_get($url);

			if ( !empty($response) && is_array($response) ) {
				$threads = !empty(json_decode($response['body'])) ? json_decode($response['body'])->threads : null;

				foreach ($threads as $thread) {
                    $thread->top_level_posts = $this->array_remove_object($thread->top_level_posts, $thread->top_rated_post_by_doctor->author_id, 'author_id');

                    usort($thread->top_level_posts, function($a, $b) {
                        return strcmp($b->score, $a->score);
                    });
                }

				$noMatchingTags = !empty(json_decode($response['body'])) ? json_decode($response['body'])->no_matching_tags : null;
				if (!empty($cacheKeyForThreads)) {
					set_transient( $cacheKeyForThreads, $threads, DAY_IN_SECONDS );
				}
				set_transient( $cacheKeyForNoMatchingTags, $noMatchingTags, DAY_IN_SECONDS );
			}
		}


		ob_start();
		include 'partials/zwivel-related-qa-public-display.php';
		return ob_get_clean();
	}


    function array_remove_object(&$array, $value, $prop)
    {
        return array_filter($array, function($a) use($value, $prop) {
            return $a->$prop !== $value;
        });
    }

}

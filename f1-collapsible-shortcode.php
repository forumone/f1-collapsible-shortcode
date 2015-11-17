<?php
/*
 * Plugin Name: F1 Collapsible Shortcode
 * Description: Adds a [collapsible] shortcode for hiding and showing content. See * suggested.css for suggested styling.
 * Author: Forum One, Russell Heimlich
 * Version: 0.1
 * GitHub Plugin URI: https://github.com/forumone/f1-collapsible-shortcode
 */

if ( shortcode_exists( 'collapsible' ) ) {
	//If the shortcode [collapsible] already exists then bail. Our work here is done...
	return;
}

class F1_Collapsible_Shortcode {

	private $version = 0.1; // This should match the plugin version declared in the header ^^^
	public function __construct() {}

	/**
	 * Hooks in to various actions and filters we need to use.
	 */
	public function setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_shortcode( 'collapsible', array( $this, 'shortcode' ), 9 );
		add_filter( 'the_content', array( $this, 'shortcode_empty_paragraph_fix' ) );
	}

	/**
	 * Registers the JavaScript file that we'll need to enqueue when the shortcode is used.
	 */
	public function register_scripts() {
		wp_register_script( 'f1-collapsible-shortcode', plugin_dir_url( __FILE__ ) . 'js/f1-collapsible-shortcode.js', array('jquery'), $this->version, true );

	}

	/**
	 * Changes the HTML so the shortcode JavaScript file can work.
	 * @param  array $atts    An array of attributes
	 * @param  string $content HTML that should be collapsed
	 * @return string          The new content with the approriate markup to make the collapsible action work.
	 */
	public function shortcode( $atts, $content ) {
		// Check that $content contains atleast one heading. Otherwise bail!
		preg_match( '/<h\d/i', $content, $has_heading );
		if( empty( $has_heading ) ) {
			return do_shortcode( $content );
		}

		wp_enqueue_script( 'f1-collapsible-shortcode' );
		$collapsible_icon = apply_filters( 'f1_collapsible_icon', '<span aria-hidden="true" class="f1-collapsible-icon">&raquo;</span>' );

		$content = preg_replace('/<h([1-6])>/im', '<h$1>' . $collapsible_icon, $content, 1);
		$content = preg_replace('/<\/h([1-6])>/im', '</h$1><div>', $content, 1);
		$content .= '</div>';

		return '<div class="f1-collapsible">' . do_shortcode( $content ) . '</div>';
	}

	/**
	 * Fixes bad wpautop() markup from shortcodes. Via http://wordpress.org/plugins/shortcode-empty-paragraph-fix/
	 * @param  string $content HTML to be fixed.
	 * @return string          Modified HTML
	 */
	public function shortcode_empty_paragraph_fix( $content ) {
		$array = array (
			'<p>[' => '[',
			']</p>' => ']',
			']<br />' => ']'
		);
		$content = strtr( $content, $array );

		return $content;
	}
}

$f1_collapsible_shortcode = new F1_Collapsible_Shortcode();
$f1_collapsible_shortcode->setup();

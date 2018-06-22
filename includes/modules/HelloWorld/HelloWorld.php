<?php

class DGR_HelloWorld extends ET_Builder_Module {

	public $slug       = 'dgr_hello_world';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'mytherapistsite.com',
		'author'     => 'Jay Durnil',
		'author_uri' => 'mytherapistsite.com',
	);

	public function init() {
		$this->name = esc_html__( 'Divi Grid', 'dgr-divigrid' );
	}

	public function get_fields() {
		return array(
			'content' => array(
				'label'           => esc_html__( 'Content', 'dgr-divigrid' ),
				'type'            => 'tiny_mce',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Content entered here will appear inside the module.', 'dgr-divigrid' ),
				'toggle_slug'     => 'main_content',
			),
		);
	}

	public function render( $attrs, $content = null, $render_slug ) {
		return sprintf( '<h1>%1$s</h1>', $this->props['content'] );
	}
}

new DGR_HelloWorld;

<?php

class DGR_HelloWorld extends ET_Builder_Module {

	public $slug       = 'dgr_grid';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => 'mytherapistsite.com',
		'author'     => 'Jay Durnil',
		'author_uri' => 'mytherapistsite.com',
	);

	public function init() {
        $this->child_slug      = 'dgr_grid_item';
        $this->child_item_text = esc_html__( 'Grid Item', 'dgr-divigrid' );
		$this->name = esc_html__( 'Divi Grid', 'dgr-divigrid' );
        $this->settings_modal_toggles  = array(
            // Content tab's slug is "general"
            'general'  => array(
                'toggles' => array(
                    'main_content' => esc_html__( 'Defin Grid', 'dicm-divi-custom-modules' ),
                ),
            ),
            'Test'  => array(
                'toggles' => array(
                    'input' => esc_html__( 'Test', 'dicm-divi-custom-modules' ),
                    'color' => esc_html__( 'Color', 'dicm-divi-custom-modules' ),
                ),
            ),
        );
	}

	public function get_fields() {
		return array(
            'num_rows' => array(
                'default'         => '0',
                'label'           => esc_html__( 'Number of Rows', 'etl-divilocal' ),
                'type'            => 'range',
                'range_settings'  => array(
                    'min'         => '1',
                    'max'         => '6'

                ),
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter in desired number of rows.', 'etl-divilocal' ),
                'toggle_slug'     => 'main_content',
            ),
            'num_cols' => array(
                'default'         => '0',
                'label'           => esc_html__( 'Number of Columns', 'etl-grid' ),
                'type'            => 'range',
                'range_settings'  => array(
                    'min'         => '1',
                    'max'         => '6'

                ),
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter in desired number of columns', 'etl-divilocal' ),
                'toggle_slug'     => 'main_content',
            ),
            'height' => array(
                'label'           => esc_html__( 'Height', 'etl-divilocal' ),
                'type'            => 'text',

                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter height', 'etl-divilocal' ),
                'toggle_slug'     => 'main_content',
            ),
            'gap' => array(
                'label'           => esc_html__( 'Grid Gap', 'etl-divilocal' ),
                'type'            => 'text',

                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter Gap Width', 'etl-divilocal' ),
                'toggle_slug'     => 'main_content',
            ),
            'show_lb' => array(
                'default'         => 'off',
                'label'           => esc_html__( 'Show Lightbox', 'etl-grid' ),
                'type'            => 'yes_no_button',
                'option_category' => 'basic_option',
                'options'           => array(
                    'on'  => esc_html__( 'On', 'et_builder' ),
                    'off' => esc_html__( 'Off', 'et_builder' ),
                ),
                'description'     => esc_html__( 'Show Lightbox', 'etl-divilocal' ),
                'toggle_slug'     => 'main_content',
            ),

        );
	}

    public function get_advanced_fields_config() {
        return array(
            'fonts' => array(
                'header' => array(
                    'css'          => array(
                        'main'      => "%%order_class%% h2, %%order_class%% h1, %%order_class%% h3, %%order_class%% h4, %%order_class%% h5, %%order_class%% h6",
                        'important' => 'all',
                    ),
                    'header_level' => array(
                        'default' => 'h2',
                    ),
                    'label'        => esc_html__( 'Title', 'simp-simple' ),
                ),
            ),

        );
    }

    function get_row_string(){
        $row_string = '';
        $rows = intval($this->props['num_rows']);
        for($i=0; $i<$rows; $i++){
            $row_string .= 'auto ';
        }
        return $row_string;
    }
    function get_col_string(){
        $col_string = '';
        $cols = intval($this->props['num_cols']);
        for($i=0; $i<$cols; $i++){
            $col_string .= 'auto ';
        }
        return $col_string;
    }


    public function render( $attrs, $content = null, $render_slug ) {
        if ( '' !== $this->props['num_rows'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .main',
                'declaration' => sprintf(
                    'grid-template-rows: %1$s;',
                    $this->get_row_string()
                ),
            ) );
        }
        if ( '' !== $this->props['num_cols'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .main',
                'declaration' => sprintf(
                    'grid-template-columns: %1$s;',
                    $this->get_col_string()
                ),
            ) );
        }
        if ( '' !== $this->props['height'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%% .main',
                'declaration' => sprintf(
                    'height: %1$s;',
                    esc_attr($this->props['height'])
                ),
            ) );
        }

		return sprintf( '<div class="main">%1$s</div>', $this->content );
	}
}

new DGR_HelloWorld;

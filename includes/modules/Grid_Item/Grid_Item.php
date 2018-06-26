<?php
/**
 * Created by PhpStorm.
 * User: jdurn_000
 * Date: 6/23/2018
 * Time: 10:33 AM
 */
class ETL_Grid_Item extends ET_Builder_Module
{

    public $vb_support = 'on';

    public function init()
    {
        $this->slug = 'dgr_grid_item';
        $this->type = 'child';
        $this->name = esc_html__('Grid Item', 'dgr-divigrid');
        $this->advanced_setting_title_text = esc_html__('New Grid Item', 'dgr-divigrid');
        $this->settings_text = esc_html__('Grid Settings', 'dgr-divigrid');
    }

    public function get_settings_modal_toggles()
    {
        return array(
            'general' => array(
                'toggles' => array(
                    'main_content' => esc_html__('Define Item', 'et_builder'),
                    'content' => esc_html__('Define Content', 'et_builder'),
                    'button' => esc_html__('Button', 'et_builder')
                ),
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
            'body' => array(
                'css'          => array(
                    'main'      => "%%order_class%% .item-content",
                    'important' => 'all',
                ),
                'header_level' => array(
                    'default' => 'h2',
                ),
                'label'        => esc_html__( 'Body', 'simp-simple' ),
            ),
          ),
         'button' => array(
            'button' => array(
                'box_shadow'    => array(
                    'css' => array(
                        'main' => "%%order_class%% .et_pb_button",
                    ),
                ),
                'css'           => array(
                    'plugin_main' => "%%order_class .et_pb_button",
                    'alignment'   => "%%order_class%% .et_pb_button_wrapper",
                ),
                'label'         => esc_html__( 'Button', 'simp-simple' ),
                'use_alignment' => true,
            ),
        ),
        );
    }


    public function get_fields()
    {
        return array(
            'rows_span' => array(
                'default' => '0',
                'label' => esc_html__('Rows to Span', 'etl-divilocal'),
                'type' => 'range',
                'range_settings' => array(
                    'min' => '1',
                    'max' => '6'

                ),
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter in desired number of rows.', 'etl-divilocal'),
                'toggle_slug' => 'main_content',

            ),
            'cols_span' => array(
                'default' => '0',
                'label' => esc_html__('Columns to Span', 'etl-grid'),
                'type' => 'range',
                'range_settings' => array(
                    'min' => '1',
                    'max' => '6'

                ),
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter in desired number of columns', 'etl-divilocal'),
                'toggle_slug' => 'main_content',
            ),
            'title' => array(
                'label' => esc_html__('Title', 'etl-grid'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter in desired title', 'etl-divilocal'),
                'toggle_slug' => 'content',
            ),
            'content' => array(
                'label' => esc_html__('Content', 'etl-grid'),
                'type' => 'tiny_mce',
                'option_category' => 'basic_option',
                'description' => esc_html__('Enter in desired title', 'etl-divilocal'),
                'toggle_slug' => 'content',
            ),
            'button_text' => array(
                'label' => esc_html__('Button Text', 'dicm-divi-custom-modules'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Input your desired button text, or leave blank for no button.', 'dicm-divi-custom-modules'),
                'toggle_slug' => 'button',
            ),
            'button_url' => array(
                'label' => esc_html__('Button URL', 'dicm-divi-custom-modules'),
                'type' => 'text',
                'option_category' => 'basic_option',
                'description' => esc_html__('Input URL for your button.', 'dicm-divi-custom-modules'),
                'toggle_slug' => 'button',
            ),
            'button_url_new_window' => array(
                'default' => 'off',
                'default_on_front' => true,
                'label' => esc_html__('Url Opens', 'dicm-divi-custom-modules'),
                'type' => 'select',
                'option_category' => 'configuration',
                'options' => array(
                    'off' => esc_html__('In The Same Window', 'dicm-divi-custom-modules'),
                    'on' => esc_html__('In The New Tab', 'dicm-divi-custom-modules'),
                ),
                'toggle_slug' => 'button',
                'description' => esc_html__('Choose whether your link opens in a new window or not', 'dicm-divi-custom-modules'),
            ),
        );
    }

    function get_content_string(){
        if('' != $this->props['content']){
            $content_string = sprintf('<div class="item-content">%1$s</div>',$this->props['content']);
        } else {
            $content_string = '';
        }
        return $content_string;
    }

    function image_link(){
        $image_link = '';
        if($this->props['background_image']){
            $image_link = $this->props['background_image'];
        }
        else {
            $image_link = '#';
        }
        return $image_link;
    }

    public function render($attrs, $content = null, $render_slug)
    {
        $test = $this->props;
        $header_level = $this->props['header_level'] ? $this->props['header_level'] : 'h2';
        $title = $this->props['title'];
        $content= $this->props['content'];
        $button_text           = $this->props['button_text'];
        $button_url            = $this->props['button_url'];
        $button_url_new_window = $this->props['button_url_new_window'];

        $button_custom         = $this->props['custom_button'];
        $button_rel            = $this->props['button_rel'];
        $button_use_icon       = $this->props['button_use_icon'];

        $button = $this->render_button( array(
            'button_text'      => $button_text,
            'button_url'       => $button_url,
            'url_new_window'   => $button_url_new_window,
            'button_custom'    => $button_custom,
            'button_rel'       => $button_rel,
            'custom_icon'      => $button_use_icon,
        ) );

        if ( '' !== $this->props['rows_span'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%%',
                'declaration' => sprintf(
                    'grid-row-end: span %1$s;',
                    $this->props['rows_span']
                ),
            ) );
        }
        if ( '' !== $this->props['cols_span'] ) {
            ET_Builder_Element::set_style( $render_slug, array(
                'selector'    => '%%order_class%%',
                'declaration' => sprintf(
                    'grid-column-end: span %1$s;',
                    $this->props['cols_span']
                ),
            ) );
        }

        return sprintf( '<div class="item">
                                    <a href=%5$s data-lightbox="image-1">
                                    <div class="box">
                                    </div>
                                    </a>
                                    <div class="text-content">
                                    <%1$s class="grid-item-title">%2$s</%1$s>
                                    %3$s
                                    </div>
                                    %4$s
                                </div>', $header_level, $title, $this->get_content_string(), $button, $this->image_link());

    }
}

new ETL_Grid_Item;
<?php
/*
Plugin Name: Módulo personalizado de Divi
Description: Un módulo personalizado de Divi que permite cargar una imagen y marcar hotspots-woocommerce
Version: 1.0
Author: Pablo González
*/

if ( class_exists( 'ET_Builder_Module' ) ) {

    class ET_Builder_Module_Custom extends ET_Builder_Module {

        public $slug       = 'et_pb_custom_module';
        public $vb_support = 'on';

        protected $module_credits = array(
            'module_uri' => '',
            'author'     => 'Pablo González',
            'author_uri' => '',
        );

        public function init() {
            $this->name = esc_html__( 'HotSpot Domestico', 'et_builder' );
        }

        public function get_fields() {
            return array(
                'image' => array(
                    'label'              => esc_html__( 'Imagen', 'et_builder' ),
                    'type'               => 'upload',
                    'option_category'    => 'basic_option',
                    'upload_button_text' => esc_attr__( 'Subir una imagen', 'et_builder' ),
                    'choose_text'        => esc_attr__( 'Elegir una imagen', 'et_builder' ),
                    'update_text'        => esc_attr__( 'Establecer como imagen', 'et_builder' ),
                    'description'        => esc_html__( 'Carga una imagen para el módulo.', 'et_builder' ),
                ),
            );
        }

        public function render( $unprocessed_props, $content = null, $render_slug ) {
            $image = $this->props['image'];
            $output = sprintf( '<img src="%1$s" alt="%2$s" />', esc_url( $image ), esc_attr( get_the_title() ) );

            return $output;
        }
    }

    new ET_Builder_Module_Custom;

} else {

    add_action( 'et_builder_ready', function() {
        require plugin_dir_path( __FILE__ ) . '/divi-custom-module.php';
    } );

}

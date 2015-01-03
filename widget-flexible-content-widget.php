<?php
/*
Plugin Name: Flexible Content Widget
Plugin URI: http://kindleman.com.au/plugins/fcw
Description: provides an interface for flexible content in widgets
Version: 1.0
Author: WillBarker
Author URI: http://kindleman.com.au
License: MIT
*/


/**
 * Adds Yogi widget.
 */
class Fcw_Widget extends WP_Widget {

  /**
   * Register widget with WordPress.
   */
  function __construct() {
    parent::__construct(
      'flex_widget', // Base ID
      __('Flexible Content Widget', 'text_domain'),
      array( 'description' => __( 'Flexible Content Widget', 'text_domain' ), )
    );
  }

  /**
   * FCW
   *
   * @see WP_Widget::widget()
   *
   * @param array $args     Widget arguments.
   * @param array $instance Saved values from database.
   */
  public function widget( $args, $instance ) {
    extract( $args );
    $widget_id = $args['widget_id'];
    $context['widget_id'] =  $widget_id;
    $context['widget_title'] = $instance['title'];
    $context['fcw_content'] = get_field($widget_id.'_flexible_content', 'widget');
    // Timber::$locations =   array(
    //   ABSPATH . "wp-content/plugins/flexible-content-widget/", 
    // );    

    Timber::render(array('flexible_content_widget/flexible_content_widget_' . $widget_id . '.twig',
                          'flexible_content_widget/flexible_content_widget.twig'), $context);
  }

  /**
   * Back-end widget form.
   *
   * @see WP_Widget::form()
   *
   * @param array $instance Previously saved values from database.
   */
  public function form( $instance ) {
    if ( isset( $instance[ 'title' ] ) ) {
      $title = $instance[ 'title' ];
    }
    else {
      $title = __( 'New title', 'text_domain' );
    }
    ?>
    <p>
    <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
    <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
    </p>
    <?php
  }

  /**
   * Sanitize widget form values as they are saved.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance Values just sent to be saved.
   * @param array $old_instance Previously saved values from database.
   *
   * @return array Updated safe values to be saved.
   */
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

    return $instance;
  }

} // class FCW_Widget


function register_fcw_widget() {
    register_widget( 'FCW_Widget' );
}
add_action( 'widgets_init', 'register_fcw_widget' );


/* Fields ========================================== 
   Dev:   To add more comment out the php below and import from xml in fields dir
          Make sure you delete perm or it won't import.
*/

if( function_exists('register_field_group') ):

register_field_group(array (
  'key' => 'group_54a768b458c56',
  'title' => 'Flexible Content Widget',
  'fields' => array (
    array (
      'key' => 'field_54a768c3618e6',
      'label' => 'Flexible Content',
      'name' => 'flexible_content',
      'prefix' => '',
      'type' => 'flexible_content',
      'instructions' => '',
      'required' => 0,
      'conditional_logic' => 0,
      'button_label' => 'Add Row',
      'min' => '',
      'max' => '',
      'layouts' => array (
        array (
          'key' => '54a768f8d8a51',
          'name' => 'banner',
          'label' => 'Banner',
          'display' => 'row',
          'sub_fields' => array (
            array (
              'key' => 'field_54a7695b618e7',
              'label' => 'image',
              'name' => 'image',
              'prefix' => '',
              'type' => 'image',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'column_width' => '',
              'return_format' => 'array',
              'preview_size' => 'thumbnail',
              'library' => 'all',
            ),
            array (
              'key' => 'field_54a7697c618e8',
              'label' => 'Link',
              'name' => 'link',
              'prefix' => '',
              'type' => 'text',
              'instructions' => '',
              'required' => 0,
              'conditional_logic' => 0,
              'column_width' => '',
              'default_value' => '',
              'placeholder' => '',
              'prepend' => '',
              'append' => '',
              'maxlength' => '',
              'readonly' => 0,
              'disabled' => 0,
            ),
          ),
          'min' => '',
          'max' => '',
        ),
      ),
    ),
  ),
  'location' => array (
    array (
      array (
        'param' => 'widget',
        'operator' => '==',
        'value' => 'flex_widget',
      ),
    ),
  ),
  'menu_order' => 0,
  'position' => 'normal',
  'style' => 'default',
  'label_placement' => 'top',
  'instruction_placement' => 'label',
  'hide_on_screen' => '',
));

endif;
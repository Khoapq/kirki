<?php
/**
 * editor Customizer Control.
 *
 * Multiple checkbox customize control class.
 * Props @ Justin Tadlock: http://justintadlock.com/archives/2015/05/26/multiple-checkbox-customizer-control
 *
 * @package     Kirki
 * @subpackage  Controls
 * @copyright   Copyright (c) 2015, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Early exit if the class already exists
if ( class_exists( 'Kirki_Controls_MultiCheck_Control' ) ) {
	return;
}

class Kirki_Controls_MultiCheck_Control extends WP_Customize_Control {

	public $type = 'multicheck';

	public $help = '';

	public function enqueue() {
		Kirki_Styles_Customizer::enqueue_customizer_control_script( 'kirki-multicheck', 'controls/multicheck', array( 'jquery' ) );
	}

	public function render_content() {

		if ( empty( $this->choices ) ) {
			return;
		}
		?>

		<?php if ( '' != $this->help ) : ?>
			<a href="#" class="tooltip hint--left" data-hint="<?php echo esc_html( $this->help ); ?>"><span class='dashicons dashicons-info'></span></a>
		<?php endif; ?>


		<?php if ( ! empty( $this->label ) ) : ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php endif; ?>

		<?php if ( ! empty( $this->description ) ) : ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php endif; ?>

		<?php $multi_values = ( is_array( $this->value() ) ) ? $this->value() : explode( ',', $this->value() ); ?>

		<ul>
			<?php foreach ( $this->choices as $value => $label ) : ?>
				<li>
					<label>
						<input type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( in_array( $value, $multi_values ) ); ?> />
						<?php echo esc_html( $label ); ?>
					</label>
				</li>
			<?php endforeach; ?>
		</ul>

		<input type="hidden" <?php $this->link(); ?> value="<?php echo esc_attr( implode( ',', $multi_values ) ); ?>" />
	<?php }
}

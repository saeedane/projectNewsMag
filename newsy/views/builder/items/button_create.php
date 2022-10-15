<div class="ak-bar-item ak-header-button ak-header-button-create">
	<?php
	$buzzeditor_active = class_exists( 'BuzzEditor_Editor' );
	newsy_generate_button(
		'header_button_create', array(
			'text'          => 'Create',
			'link'          => $buzzeditor_active ? home_url( '/' . buzzeditor_get_editor_endpoint() ) : '/',
			'target'        => '_self',
			'style'         => 'rounded',
			'login'         => $buzzeditor_active ? '' : 'yes',
			'extra_classes' => 'ak-dropdown-button',
		)
	);
	if ( $buzzeditor_active ) {
		$content = BuzzEditor_Editor::get_instance()->get_dropdown_content();

		if ( $content ) {
			echo '<div class="ak-dropdown ak-header-create-dropdown-content" data-event="hover">' . $content . '</div>';
		}
	}
	?>
</div>

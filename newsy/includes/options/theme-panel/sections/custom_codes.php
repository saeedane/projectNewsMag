<?php

$fields[] = array(
	'id'              => '_custom_header_code',
	'heading'         => esc_html__( 'Custom Head Code ', 'newsy' ),
	'type'            => 'code',
	'container_class' => 'control-heading-full',
	'section'         => 'custom_codes',
);

$fields[] = array(
	'id'              => '_custom_footer_code',
	'heading'         => esc_html__( 'Custom Footer Code', 'newsy' ),
	'type'            => 'code',
	'container_class' => 'control-heading-full',
	'section'         => 'custom_codes',
);

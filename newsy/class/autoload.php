<?php
/**
 * Autoload Function.
 */
spl_autoload_register(
	function ( $class ) {
		$prefix = 'Newsy\\';

		$len = strlen( $prefix );

		if ( strncmp( $prefix, $class, $len ) !== 0 ) {
			return;
		}

		$relative_class = substr( $class, $len );

		$file = NEWSY_THEME_PATH . 'class/' . str_replace( '\\', '/', $relative_class ) . '.php';

		if ( is_file( $file ) ) {
			require $file;
		}
	}
);

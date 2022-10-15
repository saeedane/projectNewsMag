<?php
/**
 * Framework Autoload Function.
 */
spl_autoload_register(
	function ( $class ) {
		$prefix = 'Ak\\';

		$len = strlen( $prefix );

		if ( strncmp( $prefix, $class, $len ) !== 0 ) {
			return;
		}

		$relative_class = substr( $class, $len );

		$file = AK_CLASS_PATH . str_replace( '\\', '/', $relative_class ) . '.php';

		if ( is_file( $file ) ) {
			require $file;
		}
	}
);

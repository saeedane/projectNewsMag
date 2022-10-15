<?php
/**
 * @package : Newsy
 * @author : akbilisim (http://themeforest.net/user/akbilisim)
 */

defined( 'NEWSY_THEME_NAME' ) or define( 'NEWSY_THEME_NAME', 'Newsy' );
defined( 'NEWSY_THEME_VERSION' ) or define( 'NEWSY_THEME_VERSION', '2.0.0' );
defined( 'NEWSY_THEME_URI' ) or define( 'NEWSY_THEME_URI', get_parent_theme_file_uri() );
defined( 'NEWSY_THEME_PATH' ) or define( 'NEWSY_THEME_PATH', plugin_dir_path( __FILE__ ) );
defined( 'NEWSY_THEME_OPTIONS' ) or define( 'NEWSY_THEME_OPTIONS', 'newsy-theme-options' );

require NEWSY_THEME_PATH . 'class/autoload.php';

Newsy\Theme::get_instance();

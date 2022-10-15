<?php

$logo_type  = newsy_get_option( 'logo_type', 'image' );
$tag        = is_home() || is_front_page() ? 'h1' : 'div';
$logo_class = 'text' === $logo_type ? 'ak-logo-text' : 'ak-logo-image';
$home_url   = esc_url( home_url( '/' ) );
$logo       = newsy_generate_logo( '' );

echo "<div class=\"ak-bar-item ak-header-logo\">
        <{$tag} class=\"site-title ak-logo-wrap ak-logo-main {$logo_class}\">
            <a href=\"{$home_url}\">
                {$logo}
            </a>
        </{$tag}>
    </div>";

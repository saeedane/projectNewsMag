<?php
/* Global Color */
$amp_scheme   = newsy_amp_get_option( 'amp_scheme', '' );
$accent_color = newsy_amp_get_option( 'amp_highlight_color', newsy_get_option( 'site_highlight_color', '#0080ce' ) );

$mobile_bar_style      = newsy_get_option( 'header_mobile_bar_style' );
$builder_header_mobile = newsy_get_option( 'builder_header_mobile' );
$mobile_header_color   = 'dark' === $amp_scheme ? '#111111' : '#FFFFFF';
$mobile_header_color   = isset( $mobile_bar_style['background'] ) ? $mobile_bar_style['background'] : $mobile_header_color;
$mobile_header_scheme  = isset( $builder_header_mobile['mobile']['scheme'] ) ? $builder_header_mobile['mobile']['scheme'] : $amp_scheme;
$mobile_header_height  = newsy_get_option( 'header_mobile_height', 60 );

if ( 'dark' === $mobile_header_scheme ) {
	$mobile_logo        = newsy_get_option( 'mobile_logo_dark_image', newsy_get_option( 'logo_dark_image', get_template_directory_uri() . '/assets/images/logo-dark.png' ) );
	$mobile_logo_retina = newsy_get_option( 'mobile_logo2x_dark_image', newsy_get_option( 'logo2x_dark_image', get_template_directory_uri() . '/assets/images/logo-dark@2x.png' ) );
} else {
	$mobile_logo        = newsy_get_option( 'mobile_logo_image', newsy_get_option( 'logo_image', get_template_directory_uri() . '/assets/images/logo.png' ) );
	$mobile_logo_retina = newsy_get_option( 'mobile_logo2x_image', newsy_get_option( 'logo2x_image', get_template_directory_uri() . '/assets/images/logo@2x.png' ) );
}

if ( 'dark' === $amp_scheme ) {
	$body_color    = newsy_amp_get_option( 'amp_body_color', '#FFFFFF' );
	$body_bg_color = newsy_amp_get_option( 'amp_background_color', '#222222' );
} else {
	$body_color    = newsy_amp_get_option( 'amp_body_color', '#53585c' );
	$body_bg_color = newsy_amp_get_option( 'amp_background_color', '#FFFFFF' );
}

/* Font */
function newsy_amp_get_typo_settings( $setting, $selectors ) {
	$output = '';
	$option = newsy_get_option( $setting );

	if ( ! empty( $option['family'] ) ) {
		$output .= "\t" . 'font-family: ' . $option['family'] . ";\r\n";

		if ( ! empty( $option['variant'] ) ) {
			$value_variant = $option['variant'];
			if ( 'regular' === $value_variant ) {
				$value_variant = '400';
			} elseif ( 'italic' === $value_variant ) {
				$value_variant = '400italic';
			}

			if ( preg_match( '/\d{3}\w./i', $value_variant ) ) {
				$pretty_variant = preg_replace( '/(\d{3})/i', '${1} ', $value_variant );
				$pretty_variant = explode( ' ', $pretty_variant );
			} else {
				$pretty_variant = array( $value_variant );
			}

			if ( ! empty( $pretty_variant[0] ) ) {
				$output .= "\t" . 'font-weight: ' . $pretty_variant[0] . ";\r\n";
			}

			if ( ! empty( $pretty_variant[1] ) ) {
				$output .= "\t" . 'font-weight: ' . $pretty_variant[1] . ";\r\n";
			}
		}
	}

	if ( ! empty( $option['size'] ) ) {
		$output .= "\t" . 'font-size: ' . $option['size'] . ";\r\n";
	}
	if ( ! empty( $option['letter-spacing'] ) ) {
		$output .= "\t" . 'letter-spacing: ' . $option['letter-spacing'] . ";\r\n";
	}
	if ( ! empty( $option['transform'] ) ) {
		$output .= "\t" . 'text-transform: ' . $option['transform'] . ";\n";
	}
	if ( ! empty( $option['color'] ) ) {
		$output .= "\t" . 'color: ' . $option['color'] . ";\r\n";
	}

	if ( empty( $output ) ) {
		return '';
	}

	return PHP_EOL . $selectors . " {\r\n" . $output . "}\r\n";
}
?>

/*** Generic WP ***/
/*.alignright {
	float: right;
}
.alignleft {
	float: left;
}*/
.aligncenter {
	display: block;
	margin-left: auto;
	margin-right: auto;
}
.amp-wp-enforced-sizes {
	/** Our sizes fallback is 100vw, and we have a padding on the container; the max-width here prevents the element from overflowing. **/
	max-width: 100%;
	margin: 0 auto;
}
.amp-wp-unknown-size img {

	/** Worst case scenario when we can't figure out dimensions for an image. **/

	/** Force the image into a box of fixed dimensions and use object-fit to scale. **/
	object-fit: contain;
}

/* Clearfix */
.clearfix:before, .clearfix:after {
	content: " ";
	display: table;
}

.clearfix:after {
	clear: both;
}

/*** Theme Styles ***/
.amp-wp-content, .amp-wp-title-bar div {
	margin: 0 auto;
	max-width: 600px;
}
body, html {
	height: 100%;
	margin: 0;
}
body {
	background-color: <?php echo esc_attr( $body_bg_color ); ?>;
	color: <?php echo esc_attr( $body_color ); ?>;
	font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", "Roboto", "Oxygen-Sans", "Ubuntu", "Cantarell", "Helvetica Neue", sans-serif;
	font-size: 14px;
	line-height: 1.785em;
	text-rendering: optimizeLegibility;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
}
::-moz-selection {
	background: #fde69a;
	color: #212121;
	text-shadow: none;
}
::-webkit-selection {
	background: #fde69a;
	color: #212121;
	text-shadow: none;
}
::selection {
	background: #fde69a;
	color: #212121;
	text-shadow: none;
}
p, ol, ul, figure {
	margin: 0 0 1em;
	padding: 0;
}
a, a:visited {
	text-decoration: none;
}
a:hover, a:active, a:focus {
	color: #212121;
}

/*** Global Color ***/
a,
a:visited,
.amp-related-content h3 a:hover,
.amp-related-content h3 a:focus,
.ak-share-count .counts,
.amp-wp-author a
{
	color: <?php echo esc_attr( $accent_color ); ?>;
}

/*** Header ***/
.amp-wp-header {
	text-align: center;
	background-color: #fff;
	height: <?php echo esc_attr( $mobile_header_height ); ?>px;
	box-shadow: 0 2px 6px rgba(0, 0, 0,.1);
}
.amp-wp-header.dark {
	background-color: #212121;
}
.amp-wp-header .ak-amp-logo {
	background-image: url(<?php echo esc_url( $mobile_logo ); ?>);
	background-size: 120px;
}
@media
only screen and (-webkit-min-device-pixel-ratio: 2),
only screen and (     -o-min-device-pixel-ratio: 2/1),
only screen and (        min-device-pixel-ratio: 2),
only screen and (                min-resolution: 192dpi),
only screen and (                min-resolution: 2dppx) {
	.amp-wp-header .ak-amp-logo {
		background-image: url(<?php echo esc_url( $mobile_logo_retina ); ?>);
	}
}
<?php if ( ! empty( $mobile_header_color ) ) : ?>
.amp-wp-header,
.amp-wp-header.dark  {
	background-color: <?php echo esc_attr( $mobile_header_color ); ?>;
}
<?php endif; ?>

.amp-wp-header div {
	color: #fff;
	font-size: 1em;
	font-weight: 400;
	margin: 0 auto;
	position: relative;
	display: block;
	width: 100%;
	height: 100%;
	max-width: 830px;
}
.amp-wp-header a {
	text-align: center;
	width: 100%;
	height: 100%;
	display: block;
	background-position: center center;
	background-repeat: no-repeat;
}
.amp-wp-site-icon {
	vertical-align: middle;
}

/*** Article ***/
.amp-wp-article {
	font-size: 16px;
	line-height: 1.625em;
	margin: 22px auto 30px;
	padding: 0 15px;
	max-width: 800px;
	overflow-wrap: break-word;
	word-wrap: break-word;
}

/* Article Breadcrumb */
.amp-wp-breadcrumb {
	margin: -5px auto 10px;
	font-size: 11px;
	color: #a0a0a0;
}
.ak-breadcrumb{
	position: relative;
}
.ak-breadcrumb ul{
	padding: 0;
	margin: 0;
	list-style: none;
	white-space: nowrap;
	text-overflow: ellipsis;
	overflow: hidden;
	display: inherit;
}
.ak-breadcrumb li{
	display: inline-block;
}
.ak-breadcrumb li:after{
	display: inline-block;
	font-family: FontAwesome;
	font-style: normal;
	font-weight: normal;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	content: '\f105';
	margin-left: 9px;
	margin-right: 9px;
	opacity: 0.9;
	vertical-align: top;
}
.ak-breadcrumb li a{
	color: #53585c;
}
.ak-breadcrumb li.ak-breadcrumb-end:after{
	display: none;
}
.ak-breadcrumb li.ak-breadcrumb-end:after span {
	opacity: 0.9;
}

/* Article Header */
.amp-wp-article-header {
	margin-bottom: 15px;
}
.amp-wp-title {
	display: block;
	width: 100%;
	font-size: 32px;
	font-weight: bold;
	line-height: 1.15;
	margin: 0 0 .4em;
	letter-spacing: -0.04em;
	color: #000000;
}
.amp-wp-title a{
	color: inherit;
}

/* Article Meta */
.amp-wp-meta {
	color: #a0a0a0;
	list-style: none;
	font-size: 1em;
}
.amp-wp-meta li {
	display: inline-block;
	line-height: 1;
}
.amp-wp-byline amp-img, .amp-wp-byline .amp-wp-author {
	display: inline-block;
}
.amp-wp-author a {
	font-weight: bold;
}
.amp-wp-byline amp-img {
	border-radius: 100%;
	position: relative;
	margin-right: 6px;
	vertical-align: middle;
}
.amp-wp-posted-on,
.amp-wp-post-view,
.amp-wp-post-comment  {
	margin-left: 5px;
}
.amp-wp-posted-on:before,
.amp-wp-post-view:before,
.amp-wp-post-comment:before {
	content: '\2014';
	margin-right: 5px;
}

/* Featured image */
.amp-wp-article-featured-image amp-img {
	margin: 0 auto;
}
.amp-wp-article-featured-image.wp-caption .wp-caption-text {
	margin: 0 18px;
}

/* Article Terms */
.amp-wp-meta-terms {
	margin-bottom: 15px;
	line-height: 14px;
	display: block;
}
.amp-wp-meta-terms > div {
	margin: 0;
	display: inline-block;
}
.amp-wp-meta-terms > div.amp-wp-tax-reaction {
	float: right;
	margin-top: -4px;
}
.amp-wp-tax-category a {
	font-size: 11px;
	letter-spacing: 1px;
	line-height: 1;
	background-color: #e6e6e6;
	padding: 5px 9px;
	color: #616161;
	text-decoration: none;
	text-transform: uppercase;
}
.wp-block-cover{
	margin-bottom: 15px;
	line-height: 1.4;
	color: #fff;
}
.wp-block-cover.is-light .wp-block-cover__inner-container{
	color: #fff;
}
.be-questions .wp-block-cover{
	padding-top: 0;
	padding-bottom: 0;
	min-height: 0;
}
/* Badge Icons */
.ak-badge-icon {
	display: inline-block;
	width: 48px;
	height: 48px;
	line-height: 48px;
	margin: 0;
	padding: 0;
	position: relative;
	text-align: center;
	text-transform: uppercase;
	color: #000;
	line-height: 1;
	-webkit-border-radius: 50%;
	-moz-border-radius: 50%;
	-ms-border-radius: 50%;
	-o-border-radius: 50%;
	border-radius: 50%;
}
.ak-badge-icon.ak-badge-type-icon .ak-icon {
	width: 100% !important;
	height: 100% !important;
	margin: 0 !important;
	display: flex;
	align-items: center;
	justify-content: center;
	font-size: 26px;
	line-height: inherit;
}
.ak-badge-icon.ak-badge-type-icon {
	.ak-icon{
		font-size: 0;
		img{
			width: 100%;
			height: 100%;
		}
	}
}
.ak-badge-icon.ak-badge-type-text {
	-webkit-box-shadow: 0 1px 1px 0 hsla(0,0%,49%,.5);
	box-shadow: 0 1px 1px 0 hsla(0,0%,49%,.5);
}
.ak-badge-icon.ak-badge-type-text .ak-badge-icon-text {
	display: block;
	position: absolute;
	top: 50%;
	left: 0;
	right: 0;
	font-size: 12px;
	line-height: 1;
	font-family: Arial;
	font-weight: 900;
	letter-spacing: -0.05em;
	white-space: nowrap;
	-webkit-transform: translateY(-0.5em) rotate(-30deg);
	-moz-transform: translateY(-0.5em) rotate(-30deg);
	-ms-transform: translateY(-0.5em) rotate(-30deg);
	-o-transform: translateY(-0.5em) rotate(-30deg);
	transform: translateY(-0.5em) rotate(-30deg);
}

/* Social Colors */
.facebook,
.facebook:hover {
	background-color: #2d5f9a;
}
.twitter,
.twitter:hover{
	background-color: #53c7ff;
}
.google,
.google_plus,
.google:hover,
.google_plus:hover{
	background-color: #d93b2b;
}
.youtube,
.youtube:hover{
	background-color: #bb0000;
}
.instagram,
.instagram:hover {
	background-color: #417096;
}
.soundcloud,
.soundcloud:hover{
	background-color: #F50;
}
.pinterest,
.pinterest:hover{
	background-color: #a41719;
}
.linkedin,
.linkedin:hover{
	background-color: #005182;
}
.tumblr,
.tumblr:hover{
	background-color: #3e5a70;
}
.telegram,
.telegram:hover{
	background-color: #179cde;
}
.reddit,
.reddit:hover{
	background-color: #ff4500;
}
.stumbleupon,
.stumbleupon:hover{
	background-color: #ee4813;
}
.vk,
.vkontakte,
.vk:hover,
.vkontakte:hover{
	background-color: #4c75a3;
}
.digg,
.digg:hover{
	background-color: #000;
}
.whatsapp,
.whatsapp:hover{
	background-color: #00e676;
}
.line,
.line:hover{
	background-color: #00b900;
}
.viber,
.viber:hover{
	background-color: #5d54a4;
}
.bbm,
.bbm:hover{
	background-color: #1f1f1f;
}
.email,
.email:hover{
	background-color: #8bc34a;
}
.rss,
.rss:hover{
	background-color: #f97410;
}
// wsl
.WordPress,
.WordPress:hover{
	background-color: #1A638D;
}
.yahoo,
.yahoo:hover{
	background-color: #723e98;
}
.disqus,
.disqus:hover{
	background-color: #2e9fff;
}
.foursquare,
.foursquare:hover{
	background-color: #3492ce;
}
.lastfm,
.lastfm:hover{
	background-color: #e02529;
}
.tumblr,
.tumblr:hover{
	background-color: #354a60;
}
.goodreads,
.goodreads:hover{
	background-color: #7c460f;
}
.stackoverflow,
.stackoverflow:hover{
	background-color: #f36f21;
}
.github,
.github:hover{
	background-color: #1b1919;
}
.dribbble,
.dribbble:hover{
	background-color: #ea4c89;
}
.skyrock,
.skyrock:hover{
	background-color: #5597cd;
}
.mixi,
.mixi:hover{
	background-color: #e49100;
}
.steam,
.steam:hover{
	background-color: #303030;
}
.twitch,
.twitch:hover{
	background-color: #5a399c;
}
.mailru,
.mailru:hover{
	background-color: #3881c2;
}
.yandex,
.yandex:hover{
	background-color: #ed1c24;
}
.odnoklassniki,
.odnoklassniki:hover{
	background-color: #e87502;
}
.aol,
.aol:hover{
	background-color: #e69827;
}
.live,
.live:hover{
	background-color: #7fb0cc;
}
.pixelpin,
.pixelpin:hover{
	background-color: #000000;
}

/* Social Share */
.ak-share-container {
	margin: 0 0 15px;
}
.ak-share-total>div {
	float: left;
	text-align: center;
	line-height: 1;
	margin-right: 15px;
	position: relative;
}
.ak-share-count .counts {
	font-size: 26px;
	font-weight: 700;
}
.ak-share-count .shares-text {
	font-size: 12px;
	font-weight: 400;
}
.ak-share-list {
	float: none;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-flex-wrap: wrap;
	-ms-flex-wrap: wrap;
	flex-wrap: wrap;
	-webkit-align-items: flex-start;
	-ms-flex-align: start;
	align-items: flex-start;
}
a.ak-share-button {
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-flex: 1;
	-ms-flex: 1;
	flex: 1;
	-webkit-justify-content: center;
	-ms-flex-pack: center;
	justify-content: center;
	-webkit-backface-visibility: hidden;
	backface-visibility: hidden;
}
a.ak-share-button {
	float: left;
	width: auto;
	height: 32px;
	line-height: 32px;
	white-space: nowrap;
	padding: 0 10px;
	color: #fff;
	margin: 0 5px 5px 0;
	border-radius: 3px;
	text-align: center;
	-webkit-transition: .2s;
	-o-transition: .2s;
	transition: .2s;
}
a.ak-share-button:last-child {
	margin-right: 0
}
a.ak-share-button:hover {
	opacity: .75;
	color: #fff;
}
a.ak-share-button > span {
	display: none;
}
a.ak-share-button .fa {
	font-size: 16px;
	line-height: inherit;
}


/*** Article Content ***/
.amp-wp-article-content ul, .amp-wp-article-content ol {
	margin: 0 0 1.5em 1.5em;
}
.amp-wp-article-content li {
	margin-bottom: 0.5em;
}
.amp-wp-article-content ul {
	list-style: square;
}
.amp-wp-article-content ol {
	list-style: decimal;
}
.amp-wp-article-content ul.fa-ul {
	list-style: none;
	margin-left: inherit;
	padding-left: inherit;
}
.amp-wp-article-content amp-img {
	margin: 0 auto 15px;
}
.amp-wp-article-content .wp-caption amp-img {
	margin-bottom: 0px;
}
.amp-wp-article-content amp-img.alignright {
	margin: 5px -15px 15px 15px;
	max-width: 60%;
}
.amp-wp-article-content amp-img.alignleft {
	margin: 5px 15px 15px -15px;
	max-width: 60%;
}

dt {
	font-weight: 600;
}
dd {
	margin-bottom: 1.25em;
}
em, cite {
	font-style: italic;
}
ins {
	background: #fcf8e3;
}
sub, sup {
	font-size: 62.5%;
}
sub {
	vertical-align: sub;
	bottom: 0;
}
sup {
	vertical-align: super;
	top: 0.25em;
}

/* Table */
table {
	width: 100%;
	margin: 1em 0 30px;
	line-height: normal;
	color: #7b7b7b;
}
tr {
	border-bottom: 1px solid #eee;
}
tbody tr:hover {
	color: #53585c;
	background: #f7f7f7;
}
thead tr {
	border-bottom: 2px solid #eee;
}
th, td {
	font-size: 0.85em;
	padding: 8px 20px;
	text-align: left;
	border-left: 1px solid #eee;
	border-right: 1px solid #eee;
}
th {
	color: #53585c;
	font-weight: bold;
	vertical-align: middle;
}
tbody tr:last-child, th:first-child, td:first-child, th:last-child, td:last-child {
	border: 0;
}

/* Quotes */
blockquote {
	display: block;
	color: #7b7b7b;
	font-style: italic;
	padding-left: 1em;
	border-left: 4px solid #eee;
	margin: 0 0 15px 0;
}
blockquote p:last-child {
	margin-bottom: 0;
}

/* Captions */
.wp-caption {
	max-width: 100%;
	box-sizing: border-box;
}
.wp-caption.alignleft {
	margin: 5px 20px 20px 0;
}
.wp-caption.alignright {
	margin: 5px 0 20px 20px;
}
.wp-caption .wp-caption-text {
	margin: 3px 0 1em;
	font-size: 12px;
	color: #a0a0a0;
	text-align: center;
}
.wp-caption a {
	color: #a0a0a0;
	text-decoration: underline;
}

/* AMP Media */
.amp-wp-article-content amp-carousel amp-img {
	border: none;
}
amp-carousel > amp-img > img {
	object-fit: contain;
}
.amp-wp-iframe-placeholder {
	background-color: #212121;
	background-size: 48px 48px;
	min-height: 48px;
}

/* Shortcodes */
.intro-text {
	font-size: larger;
	line-height: 1.421em;
	letter-spacing: -0.01em;
}

.dropcap {
	display: block;
	float: left;
	margin: 0.04em 0.2em 0 0;
	color: #212121;
	font-size: 3em;
	line-height: 1;
	padding: 10px 15px;
}
.dropcap.rounded {
	border-radius: 10px;
}

/* Pull Quote */
.pullquote {
	font-size: larger;
	border: none;
	padding: 0 1em;
	position: relative;
	text-align: center;
}
.pullquote:before, .pullquote:after {
	content: '';
	display: block;
	width: 50px;
	height: 2px;
	background: #eee;
}
.pullquote:before {
	margin: 1em auto 0.65em;
}
.pullquote:after {
	margin: 0.75em auto 1em;
}

/* Article Footer Meta */
.amp-wp-meta-taxonomy {
	display: block;
	list-style: none;
	margin: 20px 0;
	border-bottom: 2px solid #eee;
}
.amp-wp-meta-taxonomy span {
	font-weight: bold;
}
.amp-wp-tax-category, .amp-wp-tax-tag {
	font-size: smaller;
	line-height: 1.4em;
	margin: 0 0 1em;
}
.amp-wp-tax-tag span {
	font-weight: bold;
	margin-right: 3px;
}
.amp-wp-tax-category a,
.amp-wp-tax-tag a {
	color: #616161;
	background: #f5f5f5;
	display: inline-block;
	line-height: normal;
	padding: 3px 8px;
	margin: 0 3px 5px 0;
	-webkit-transition: all 0.2s linear;
	-o-transition: all 0.2s linear;
	transition: all 0.2s linear;
}

.amp-wp-tax-category a:hover,
.amp-wp-tax-tag a:hover {
	color: #fff;
	background: <?php echo esc_attr( $accent_color ); ?>;
}

/* AMP Related */
.amp-related-wrapper h2 {
	font-size: 16px;
	font-weight: bold;
	margin-top: 30px;
	margin-bottom: 10px;
}
.amp-related-posts {
	width: auto;
	margin: 0 -15px;
	border: 0;
	display: -ms-flexbox;
	display: -webkit-box;
	display: flex;
	-ms-flex-wrap: wrap;
	flex-wrap: wrap;
	list-style: none;
}
.amp-related-posts:before,
.amp-related-posts:after {
	content: " ";
	display: table;
}
.amp-related-posts:after {
	clear: both;
}
.amp-related-content {
	float: left;
	padding-right: 15px;
	padding-left: 15px;
	margin-bottom: 30px;
	width: 50%;
	box-sizing: border-box;
}

.amp-related-content amp-img {
	margin-bottom: 15px;
}
.amp-related-text {

}
.amp-related-content h3 {
	font-size: 16px;
	font-weight: 500;
	line-height: 1.4em;
	margin: 0 0 5px;
}
.amp-related-content h3 a {
	color: #212121;
}

.amp-related-content .amp-related-meta {
	color: #a0a0a0;
	font-size: 10px;
	line-height: normal;
	text-transform: uppercase;
}
.amp-related-date {
	margin-left: 5px;
}
.amp-related-date:before {
	content: '\2014';
	margin-right: 5px;
}

/* AMP Comment */
.amp-wp-comments-link {
	text-align: center;
	margin-top: 30px;
	margin-bottom: 10px;
}
.amp-wp-comments-link a {
	display: inline-block;
	border-radius: 3px;
	cursor: pointer;
	padding: 0 30px;
	height: 45px;
	line-height: 45px;
	color: #fff;
	background: <?php echo esc_attr( $accent_color ); ?>;
}

/* AMP Footer */
.amp-wp-footer {
	background: #f5f5f5;
	color: #999;
	text-align: center;
}
.amp-wp-footer .amp-wp-footer-inner {
	margin: 0 auto;
	padding: 15px;
	position: relative;
}
.amp-wp-footer h2 {
	font-size: 1em;
	line-height: 1.375em;
	margin: 0 0 .5em;
}
.amp-wp-footer .back-to-top {
	font-size: 11px;
	text-transform: uppercase;
	letter-spacing: 1px;
}
.amp-wp-footer p {
	font-size: 12px;
	line-height: 1.5em;
	margin: 1em 2em 1em;
}
.amp-wp-footer a {
	text-decoration: none;
}
.amp-wp-social-footer a:not(:last-child) {
	margin-right: 0.8em;
}

.amp-wp-social-footer .ak-social-counter .social-item  {
	display: inline-block;
	margin: 0 0.5em;
}

.amp-wp-social-footer .ak-social-counter .social-item a {
	display: inline-block;
	color: #fff;
	width: 28px;
	height: 28px;
	line-height: 28px;
	text-align: center;
}

/* AMP Ads */
.amp_ad_wrapper {
	text-align: center;
}

/* AMP Sidebar */
.toggle_btn,
.amp-wp-header .ak-amp-search-icon {
	color: #212121;
	background: transparent;
	font-size: 24px;
	top: 0;
	left: 0;
	position: absolute;
	display: inline-block;
	width: 50px;
	height: <?php echo esc_attr( $mobile_header_height ); ?>px;
	line-height: <?php echo esc_attr( $mobile_header_height ); ?>px;
	text-align: center;
	border: none;
	padding: 0;
	outline: 0;
	cursor: pointer;
}
.amp-wp-header.dark .toggle_btn,
.amp-wp-header.dark .ak-amp-search-icon {
	color: #fff;
}

.amp-wp-header .ak-amp-search-icon {
	left: auto;
	right: 0;
}


/* Sidebar Drawer */
#sidebar {
	background-color: #fff;
	width: 100%;
	max-width: 320px;
}

.ak-off-nav-wrap {
	min-height: 100%;
	display: flex;
	flex-direction: column;
	position: relative;
}
.ak-off-nav-wrap .ak-off-nav-top-row {
	-webkit-box-pack: start;
	-ms-flex-pack: start;
	justify-content: flex-start;
}
.ak-off-nav-wrap .ak-off-nav-mid-row {
	flex: 1;
}
.ak-off-nav-wrap .ak-off-nav-bottom-row {
	-webkit-box-pack: end;
	-ms-flex-pack: end;
	justify-content: flex-end;
}
.ak-off-nav-wrap .ak-bar-item {
	display: block;
	padding: 20px;
	border-bottom: 1px solid #eee;
}
.ak-off-nav-wrap .ak-bar-item:last-child {
	border-bottom: 0;
}
.ak-off-nav-wrap .ak-bar-item:after {
	clear: both!important;
}
.ak-off-nav-wrap .ak-badge-menu > li {
	margin-bottom: 5px;
}
.ak-off-nav-wrap .ak-header-button .btn {
	display: block;
}

/* Mobile Menu */
.ak-mobile-menu li a {
	color: #212121;
	margin-bottom: 15px;
	display: block;
	font-size: 18px;
	line-height: 1.444em;
	font-weight: bold;
	position: relative;
}
.ak-mobile-menu li a:hover {
	color: #f70d28;
}
.ak-mobile-menu,
.ak-mobile-menu ul {
	list-style: none;
	margin: 0px;
}
.ak-mobile-menu ul {
	padding-bottom: 10px;
	padding-left: 20px;
}
.ak-mobile-menu ul li a {
	color: #757575;
	font-size: 15px;
	font-weight: normal;
	margin-bottom: 12px;
	padding-bottom: 5px;
	border-bottom: 1px solid #eee;
}

/* Mobile Copyright */
.ak-footer-copyright {
	font-size: 11px;
	color: #757575;
	letter-spacing: .5px;
}

/** Mobile Search Form **/
input:not([type="submit"]) {
	display: inline-block;
	background: #fff;
	border: 1px solid #e0e0e0;
	border-radius: 0;
	padding: 7px 14px;
	height: 40px;
	outline: none;
	font-size: 14px;
	font-weight: 300;
	margin: 0;
	width: 100%;
	max-width: 100%;
	-webkit-transition: all 0.2s ease;
	transition: .25s ease;
	box-shadow: none;
}
input[type="submit"], .btn {
	border: none;
	background: #f70d28;
	color: #fff;
	padding: 0 20px;
	line-height: 36px;
	height: 36px;
	display: inline-block;
	cursor: pointer;
	text-transform: uppercase;
	font-size: 13px;
	font-weight: bold;
	letter-spacing: 2px;
	outline: 0;
	-webkit-appearance: none;
	-webkit-transition: .3s ease;
	transition: .3s ease;
}
.ak-header-search-form .ak-search-form {
	display: block;
	position: relative;
	line-height: normal;
	overflow: hidden;
}
.ak-header-search-form .search-submit {
	color: #212121;
	background: transparent;
	border: 0;
	font-size: 14px;
	outline: none;
	cursor: pointer;
	position: absolute;
	height: auto;
	min-height: unset;
	top: 0;
	bottom: 0;
	right: 0;
	padding: 0 10px;
	transition: none;
}
.ak-header-search-form .search-field {
	width: 100%;
	vertical-align: middle;
	height: 36px;
	padding: 0.5em 30px 0.5em 14px;
	box-sizing: border-box;
}
.ak-header-search-form input::placeholder {
	color: #666;
}


/** Mobile Dark Scheme **/
.dark #sidebar,
#sidebar.dark,
.dark .amp-wp-footer {
	background-color: #212121;
	color: #f5f5f5;
}
.dark .ak-footer-copyright,
.dark .ak-mobile-menu li a {
	color: #f5f5f5;
}
.dark .ak-footer-copyright a {
	border-color: rgba(255, 255, 255, .8)
}
.ak-off-nav-wrap .ak-bar-item,
.dark .ak-mobile-menu ul li a,
.dark .ak-header-search-form .search-field {
	border-color: rgba(255, 255, 255, .15);
}
.dark .ak-mobile-menu ul li a {
	color: rgba(255, 255, 255, .5)
}
.dark .ak-header-search-form .search-field {
	background: rgba(255, 255, 255, 0.1);
	border: 0;
}
.dark .ak-header-search-form .search-submit,
.dark .ak-header-search-form .search-field {
	color: #fafafa;
}
.dark .ak-header-search-form input::-webkit-input-placeholder {
	color: rgba(255, 255, 255, 0.75);
}
.dark .ak-header-search-form input:-moz-placeholder {
	color: rgba(255, 255, 255, 0.75);
}
.dark .ak-header-search-form input::-moz-placeholder {
	color: rgba(255, 255, 255, 0.75);
}
.dark .ak-header-search-form input:-ms-input-placeholder {
	color: rgba(255, 255, 255, 0.75);
}
.dark .amp-wp-title,
.dark .ak-breadcrumb li a,
.dark .amp-related-content h3 a,
.dark .amp-related-content .amp-related-author {
	color: #fff;
}
.dark .amp-wp-tax-category a,
.dark .amp-wp-tax-tag a {
	background-color: #666666;
	color: #f5f5f5;
}

/* RTL */
.rtl .amp-wp-social-footer a:not(:last-child) {
	margin-left: 0.8em;
	margin-right: 0;
}
.rtl .ak-header-search-form .search-field {
	padding: 15px 2.5em 15px .5em;
}
.rtl .ak-share-button {
	margin: 0 0px 5px 5px;
}
.rtl .ak-share-button:last-child {
	margin-left: 0;
}
.rtl blockquote {
	padding-left: 0;
	padding-right: 1em;
	border-left: 0;
	border-right-width: 4px;
	border-right: 4px solid #eee;
}

/* Responsive */
@media screen and (max-width: 576px) {
	.amp-wp-title {
		font-size: 1.8em !important;
	}
	.amp-wp-meta {
		font-size: smaller
	}
	.amp-wp-byline amp-img {
		width: 24px !important;
		height: 24px !important;
	}
	.amp-related-content {
		width: 100%;
	}
}

@media only screen and (max-width: 320px) {
	#sidebar {
		max-width: 275px;
	}
}
<?php

$custom_fonts = get_transient( Ak\Asset\StyleManager::$font_css_key );

echo $custom_fonts ? $custom_fonts : '';

echo newsy_amp_get_typo_settings( 'typo_body_font', 'body, input, textarea, select, .btn, .button' );
echo newsy_amp_get_typo_settings( 'typo_heading', 'h1, h2, h3, h4, h5, h6' );
echo newsy_amp_get_typo_settings( 'typo_single_post_title', '.amp-wp-title' );
echo newsy_amp_get_typo_settings( 'typo_single_post_content', '.amp-wp-article-content' );
echo newsy_amp_get_typo_settings( 'typo_title', '.amp-related-content h3' );
echo newsy_amp_get_typo_settings( 'typo_meta', '.amp-related-content .amp-related-meta' );
echo newsy_amp_get_typo_settings( 'typo_meta_author', '.amp-related-content .amp-related-author' );
echo newsy_amp_get_typo_settings( 'typo_mobile_bar_menu', '.ak-mobile-menu li a' );
?>

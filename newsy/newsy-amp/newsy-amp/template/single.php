<!doctype html>
<html amp <?php echo AMP_HTML_Utils::build_attributes_string( $this->get( 'html_tag_attributes' ) ); ?>>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<?php do_action( 'amp_post_template_head', $this ); ?>
	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
	</style>
</head>

<body class="<?php echo esc_attr( $this->get( 'body_class' ) ); ?>">

<?php do_action( 'newsy_amp_before_header' ); ?>

<?php $this->load_parts( array( 'header-bar' ) ); ?>

<?php $this->load_parts( array( 'sidebar-menu' ) ); ?>

<?php do_action( 'newsy_amp_before_article' ); ?>

<article class="amp-wp-article hentry">
	<div class="amp-wp-breadcrumb">
		<?php echo ak_get_breadcrumb(); ?>
	</div>

	<?php do_action( 'newsy_amp_before_article_header' ); ?>

	<div class="amp-wp-meta-terms">
		<?php $this->load_parts( array( 'meta-category' ) ); ?>
	</div>

	<header class="amp-wp-article-header">
		<h1 class="amp-wp-title">
			<a href="<?php echo esc_url( get_permalink( get_the_ID() ) ); ?>" id="amp-wp-title-link">
				<?php echo wp_kses_data( $this->get( 'post_title' ) ); ?>
			</a>
		</h1>
		<ul class="amp-wp-meta">
			<?php $this->load_parts( apply_filters( 'amp_post_article_header_meta', array( 'meta-author', 'meta-time', 'meta-views', 'meta-comments' ) ) ); ?>
		</ul>
	</header>

	<?php $this->load_parts( array( 'featured-image' ) ); ?>

	<div class="amp-wp-share">
		<?php do_action( 'newsy_amp_share_top', get_the_ID() ); ?>
	</div>

	<?php do_action( 'newsy_amp_before_content' ); ?>

	<div class="amp-wp-article-content">
		<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
	</div>

	<ul class="amp-wp-meta-taxonomy"><?php $this->load_parts( array( 'meta-taxonomy' ) ); ?></ul>

	<div class="amp-wp-share">
		<?php do_action( 'newsy_amp_share_bottom', get_the_ID() ); ?>
	</div>

	<?php do_action( 'newsy_amp_after_content' ); ?>
	<?php $this->load_parts( array( 'meta-comments-link', 'related-posts' ) ); ?>

</article>

<?php do_action( 'newsy_amp_after_article' ); ?>

<?php $this->load_parts( array( 'footer' ) ); ?>

<?php do_action( 'amp_post_template_footer', $this ); ?>

</body>
</html>

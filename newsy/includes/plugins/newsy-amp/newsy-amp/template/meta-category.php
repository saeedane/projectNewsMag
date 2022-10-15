<?php $categories = get_the_category_list( ' ' ); ?>
<?php if ( $categories ) : ?>
	<div class="amp-wp-tax-category">
		<?php echo $categories; ?>
	</div>
<?php endif; ?>

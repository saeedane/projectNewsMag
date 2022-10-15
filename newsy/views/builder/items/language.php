<div class='ak-bar-item ak-lang-switcher'>
	<ul class='ak-menu ak-menu-wide ak-top-lang-switcher ak_lang_switcher'>
		<li>
		<?php
		if ( class_exists( 'Ak\Translation\MultiLang' ) ) {

			$multi_lang = Ak\Translation\MultiLang::get_instance();
			$language   = $multi_lang->get_current_language_data();

			echo '<a href="' . esc_url( $language['url'] ) . '">
						<img src="' . esc_url( $language['flag'] ) . "\" title=\"{$language['name']}\" alt=\"{$language['id']}\">
						<span>{$language['name']}</span>
					</a>";


			$languages = $multi_lang->get_all_languages();

			if ( ! empty( $languages ) ) {
				$output = '';

				foreach ( $languages as $language ) {
					$output .= '<li>
									<a href="' . esc_url( $language['url'] ) . '">
										<img src="' . esc_url( $language['flag'] ) . "\" title=\"{$language['name']}\" alt=\"{$language['id']}\">
										<span>{$language['name']}</span>
									</a>
								</li>";
				}

				echo "<ul class='sub-menu ak-anim ak-anim-slide-in-down'>{$output}</ul>";
			}
		}
		?>
		</li>
	</ul>
</div>

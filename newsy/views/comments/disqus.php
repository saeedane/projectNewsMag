<?php

// Disqus Comments
echo '<div class="comment-section" data-type="disqus" data-app-id="' . esc_attr( apply_filters( 'newsy_disqus_comment_shortname', newsy_get_option( 'disqus_comment_shortname', 'newsydemo' ) ) ) . '">';
echo '<div id="disqus_thread"><div class="ak-loading-circle"><div class="ak-loading-circle-inner"></div></div></div>';
echo '</div>';

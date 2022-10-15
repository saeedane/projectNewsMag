<?php

// Facebook Comments
echo '<div class="comment-section" data-type="facebook" data-app-id="' . esc_attr( apply_filters( 'newsy_facebook_comment_appid', newsy_get_option( 'facebook_comment_appid', '' ) ) ) . '">';
echo '<div class="fb-comments" data-href="' . esc_url( get_the_permalink() ) . '" data-num-posts="10" data-width="100%"></div>';
echo '</div>';

<?php
global $post;

$comments_instance = Newsy\Support\Comment::get_instance();
$comments_instance->render( $post->ID );

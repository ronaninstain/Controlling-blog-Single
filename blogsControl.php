<?php

// Customize blogsfor non-logged-in users by Shoive Start

function custom_content_filter($content)
{
    $post_type = get_post_type();
    if (is_singular('post') && $post_type == 'post') {
        if (!is_user_logged_in()) {
            $total_words = str_word_count($content);
            $excerpt_length = round(($total_words / 3));
           $excerpt = wp_trim_words($content, $excerpt_length, '... <a href="#login" rel="nofollow" class=" vbplogin">----read more---</a>');
            return $excerpt;
        }
        return $content;
    } else {
        return $content;
    }
}
add_filter('the_content', 'custom_content_filter',10);

// Customize blogsfor non-logged-in users by Shoive End

// Version: to render elementor style



function custom_content_filter($content)
{
    $post_type = get_post_type();
    if (is_singular('post') && $post_type == 'post') {
        if (!is_user_logged_in()) {
            global $post;
            $excerpt_length = 300; // Adjust the number of words in the excerpt as needed
            $raw_content = $post->post_content;
            $content_parts = get_extended($raw_content);
            $content = $content_parts['main'];
            $excerpt_more = '... <a href="#login" rel="nofollow" class="vbplogin">read more</a>';
            $words = preg_split("/[\n\r\t ]+/", $content, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
            if (count($words) > $excerpt_length) {
                array_pop($words);
                $content = implode(' ', $words);
                $content = $content . $excerpt_more;
            } else {
                $content = implode(' ', $words);
            }
            return $content;
        }
    }
    return $content;
}
add_filter('the_content', 'custom_content_filter', 10);
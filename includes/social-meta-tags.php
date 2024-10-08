<?php
function add_social_meta_tags() {
    if (is_singular(['post', 'page'])) {
        global $post;
        $seo_title = get_post_meta($post->ID, '_seo_title', true);
        $seo_description = get_post_meta($post->ID, '_seo_description', true);
        $seo_keywords = get_post_meta($post->ID, '_seo_keywords', true); // Added for keywords
        $post_thumbnail = get_the_post_thumbnail_url($post->ID);
        $site_favicon = get_site_icon_url();

        // Use the featured image if available, otherwise use the site favicon
        $image_url = $post_thumbnail ? $post_thumbnail : $site_favicon;

        // Open Graph tags
        if ($seo_title && $seo_description) {
            echo '<meta property="og:title" content="' . esc_html($seo_title) . '" />' . "\n";
            echo '<meta property="og:description" content="' . esc_html($seo_description) . '" />' . "\n";
            echo '<meta property="og:url" content="' . esc_url(get_permalink()) . '" />' . "\n";
            if ($image_url) {
                echo '<meta property="og:image" content="' . esc_url($image_url) . '" />' . "\n";
                echo '<meta property="og:image:width" content="1200" />' . "\n";
                echo '<meta property="og:image:height" content="630" />' . "\n";
            }

            // Twitter Card tags
            echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
            echo '<meta name="twitter:title" content="' . esc_html($seo_title) . '" />' . "\n";
            echo '<meta name="twitter:description" content="' . esc_html($seo_description) . '" />' . "\n";
            if ($image_url) {
                echo '<meta name="twitter:image" content="' . esc_url($image_url) . '" />' . "\n";
            }
        }

        // Add the meta description
        if ($seo_description) {
            echo '<meta name="description" content="' . esc_attr($seo_description) . '" />' . "\n";
        }

        // Add the meta tag for keywords
        if ($seo_keywords) {
            echo '<meta name="keywords" content="' . esc_attr($seo_keywords) . '" />' . "\n";
        }
    }
}
add_action('wp_head', 'add_social_meta_tags');
?>

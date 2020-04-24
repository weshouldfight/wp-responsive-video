<?php

/*
Plugin Name: Responsive Video
Description: Puts Container around eEmbed Videos. Replaces Youtube-Domain with Nocookie-Domain. 
Version:     1.0
Author:      Christoph Mandl
Author URI:  http://www.studioh8.de
*/


/* -------------------------------------------------------------------------------------------------
   VIDEO CONTAINER
------------------------------------------------------------------------------------------------- */

add_filter('embed_oembed_html', 'my_embed_oembed_html', 99, 4);
function my_embed_oembed_html($html, $url, $attr, $post_id) {
	return '<div class="video-container">' . $html . '</div>';
}


/* -------------------------------------------------------------------------------------------------
   INCLUDE CSS
------------------------------------------------------------------------------------------------- */

function responsive_video_css() {
  wp_register_style('responsive_video_css', plugins_url('responsive-video.css',__FILE__ ));
  wp_enqueue_style('responsive_video_css');
}
add_action( 'init','responsive_video_css');


/* -------------------------------------------------------------------------------------------------
   REPLACE YOUTUBE DOMAIN WITH NOCOOKIE DOMAIN (by Computec Media GmbH)
------------------------------------------------------------------------------------------------- */

function youtube_embed_no_cookies( $content = '' ) {
    return preg_replace(
        '#(<iframe([^>]+)src="https?://(www\.)?(youtube\.com|youtu\.be)/embed/([a-z0-9-_]+)([^"]+)?"([^>]+)?></iframe>)#si',
        '<iframe\\2src="https://www.youtube-nocookie.com/embed/\\5\\6"\\7></iframe>',
        $content
    );
}

add_filter( 'the_content', 'youtube_embed_no_cookies');


?>
<?php
/*
Plugin Name: wp-star-rating
Plugin URI: https://martinove.dk
Description: WordPress star rating plugin.
Version 0.0.1
Author: Martin Ove Christensen
Author URI: https://martinove.dk
*/

function wpsr_hello_world() {
  echo "Hello World.";
}

/*
Life-cycle hooks
*/

function wpsr_install() {
  //activation code
}

register_activation_hook(__FILE__, 'wpsr_install');
?>
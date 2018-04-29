<?php
/*
custom boxes
*/

function wpsr_add_meta_box() {
  add_meta_box(
    '1',
    'Recipe meta data',
    'recipe_meta_box_html',
    'wpsr_recipe'
  );
}

function recipe_meta_box_html($post) {
  $value = get_post_meta($post->ID, 'wpsr_cook_time', true);
  ?>
  <label for="wpsr_recipe_cook_time">Cook time</label>
  <input type="text" name="wpsr_recipe_cook_time", id="wpsr_recipe_cook_time" value="<?php echo $value; ?>" />
  <?php
}

function wpsr_save_meta_box_data($post_id) {
  if(array_key_exists('wpsr_recipe_cook_time', $_POST)) {
    update_post_meta(
      $post_id,
      'wpsr_cook_time',
      $_POST['wpsr_recipe_cook_time']
    );
  }
}

add_action('add_meta_boxes', 'wpsr_add_meta_box');
add_action('save_post', 'wpsr_save_meta_box_data');

?>

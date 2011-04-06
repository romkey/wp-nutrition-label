<?php
/*
Plugin Name: wp-nutrition-label
Plugin URI: http://romkey.com/code/wp-nutrition-label
Description:  Provides a Wordpress shortcode which generate an FDA-style nutrition label.
Author: John Romkey
Version: 0.1
Author URI: http://romkey.com/
*/

/* add_action('widgets_init', create_function('', 'return register_widget("NutriLabelWidget");')); */
add_shortcode('wp-nutr-label', 'nutr_label_shortcode');

/* attributes we look for:
 *    servingsize, servings, calories, totalfat, satfat, transfat, cholestrol, sodium, carbohydrates, fiber, sugars, protein
 * also,
 *    id, class
 */
function nutr_label_shortcode($atts) {
  extract( shortcode_atts( array(), $atts ) );
  return nutr_label_generate(array());
}

function nutr_label_generate($args) {
  return "<div ".($args{'id'} ? "id='".$args{'id'}."'" : "") . "class='wp-nutrition-label" . ( $args{'class'} ? " ".$args{'class'} : "") . "'>
  Nutrition Facts
  Serving Size XX
  Servings XX
  <hr class='heavy' />
  Amount Per Serving
   <hr>
   Calories XX
   Calories from Fat YY
   <hr />
   <strong>% Daily Value*</strong>
   Total Fat XX
   YY%
   <hr />
   Saturated Fat XX
   YY%
   <hr />
   Trans Fat
   <hr />
   Cholesterol XX
   YY%
   <hr />
   Sodium XX
   YY%
   <hr />
   <strong>Total Carbohydrate</strong> XX
   YY%
   <hr />
   Dietary Fiber XX
   YY%
   <hr />
   Sugars XX
   <hr />
   <strong>Protein</strong>XX
   <hr class='heavy' />
   Vitamin A XX% &circle; Vitamin C XX%
   <hr />
   Calcium XX% &circle; Iron XX%
   <hr />
   * Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.
</div>";
} ?>
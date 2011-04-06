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
add_shortcode('nutri-label', 'nutr_label_shortcode');
add_action('wp_head', 'nutr_style');

function nutr_style() {
?>
<style type='text/css'>
.wp-nutrition-label {
  border: 1px solid black;
  font-family: helvetica, arial, sans-serif;
  font-size: .75em;
  width: 22em;
  padding: 0em 1em 1em 1em;
  line-height: 1.4em;
 }

  .wp-nutrition-label hr {
  color: black;
  background-color: black;
    margin: 0px !important; 
  }
  .wp-nutrition-label hr.heavy {
  height: 8px;
  }
  .wp-nutrition-label h2 {
    font-size: 3em;
    font-weight: 900;
    margin: 0px !important;
  line-height: 1em !important;
    text-align: center;
  }
  .wp-nutrition-label span.indent {
    margin-left: 2em;
  }
  .wp-nutrition-label .small {
    font-size: 10px;
  }
</style>
<?php
    }

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
  <h2>Nutrition Facts</h2>
  <span class='alignleft'>Serving Size XX</span>
  <span class='alignright'>Servings XX</span>
  <hr class='heavy' />
  <strong>Amount Per Serving</strong>
   <hr />
   <span class='alignleft'>Calories XX</span>
   <span class='alignright'>Calories from Fat YY</span>
   <hr />
   <strong class='alignright'>% Daily Value*</strong><br />
   <strong>Total Fat XX</strong>
   YY%
   <hr />
   <span class='indent'>Saturated Fat XX</span>
   YY%
   <hr />
   <span class='indent'>Trans Fat</span>
   <hr />
   <strong>Cholesterol</strong> XX
   YY%
   <hr />
   <strong>Sodium</strong> XX
   YY%
   <hr />
   <strong>Total Carbohydrate</strong> XX
   YY%
   <hr />
   <span class='indent'>Dietary Fiber XX</span>
   YY%
   <hr />
    <span class='indent'>Sugars XX</span>
   <hr />
   <strong>Protein</strong>XX
   <hr class='heavy' />
   Vitamin A XX% &bullet; Vitamin C XX%
   <hr />
   Calcium XX% &bullet; Iron XX%
   <hr />
   <span class='small'>* Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.</span>
</div>";
} ?>
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
  $args = shortcode_atts( array(servingsize => 0,
				 servings => 0,
				 calories => 0,
				 totalfat => 0,
				 satfat => 0,
				 transfat => 0,
				 cholesterol => 0,
				 sodium => 0,
				 carbohydrates => 0,
				 fiber => 0,
				 sugars => 0,
				 protein => 0,
				vitamin_a => 0,
				viamin_c => 0,
				 id => '',
				cssclass => '' ), $atts );
  return nutr_label_generate($args);
}

function nutr_label_generate($args) {
  extract($args, EXTR_PREFIX_ALL, 'nutr');

  return "<div ".($nutri_id ? "id='".$nutri_id."'" : "") . "class='wp-nutrition-label" . ( $nutri_cssclass ? " ".$nutri_cssclass : "") . "'>
  <h2>Nutrition Facts</h2>
  <span class='alignleft'>Serving Size ".$nutr_servingsize."</span>
  <span class='alignright'>Servings ".$nutr_servings."</span>
  <hr class='heavy' />
  <strong>Amount Per Serving</strong>
   <hr />
   <span class='alignleft'>Calories ".$nutr_calories."</span>
   <span class='alignright'>Calories from Fat ".($nutr_totalfat * 9)."</span>
   <hr />
   <strong class='alignright'>% Daily Value*</strong><br />
   <span class='alignleft'><strong>Total Fat</strong> ".$nutr_totalfat."g</span>
   <span class='alignright'>YY%</span>
   <hr />
   <span class='alignleft indent'>Saturated Fat ".$nutr_satfat."g</span>
   <span class='alignright'>YY%</span>
   <hr />
   <span class='indent'>Trans Fat ".$nutr_transfat."g</span>
   <hr />
   <span class='alignleft'><strong>Cholesterol</strong> ".$nutr_cholesterol."mg</span>
   <span class='alignright'>YY%</span>
   <hr />
   <span class='alignleft'><strong>Sodium</strong> ".$nutr_sodium."mg</span>
   <span class='alignright'>YY%</span>
   <hr />
   <span class='alignleft'><strong>Total Carbohydrate</strong> ".$nutr_carbohydrates."g</span>
   <span class='alignright'>YY%</span>
   <hr />
   <span class='alignleft indent'>Dietary Fiber ".$nutr_fiber."g</span>
   <span class='alignright'>YY%</span>
   <hr />
    <span class='indent'>Sugars ".$nutr_sugars."g</span>
   <hr />
   <strong>Protein</strong> ".$nutr_protein."g
   <hr class='heavy' />
   Vitamin A XX% &bullet; Vitamin C XX%
   <hr />
   Calcium XX% &bullet; Iron XX%
   <hr />
   <span class='small'>* Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.</span>
   <span class='small alignright'><a href='http://www.romkey.com/code/wp-nutrition-label'>wp-nutrition-label</a>
</div>";
} ?>
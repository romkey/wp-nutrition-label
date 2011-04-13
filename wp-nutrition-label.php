<?php
/*
Plugin Name: wp-nutrition-label
Plugin URI: http://romkey.com/code/wp-nutrition-label
Description:  Provides a Wordpress shortcode which generate an FDA-style nutrition label.
Author: John Romkey
Version: 0.1
Author URI: http://romkey.com/
*/

// if(!load_plugin_textdomain('your-unique-name','/wp-content/languages/'))
//	load_plugin_textdomain('your-unique-name','/wp-content/plugins/plugin-name/location-of-mo-po-files/');

/* add_action('widgets_init', create_function('', 'return register_widget("NutriLabelWidget");')); */
add_shortcode('nutr-label', 'nutr_label_shortcode');
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
    height: .8em;
  }
  .wp-nutrition-label h3 {
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
    font-size: .8em;
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
				 width => 22,
				 id => '',
				 cssclass => '' ), $atts );
  return nutr_label_generate($args);
}

function nutr_percentage($contains, $reference) {
  return intval($contains/$reference*100);
}

function nutr_label_generate($args) {
  extract($args, EXTR_PREFIX_ALL, 'nutr');

  $rda = array( 'totalfat' => 65,
		   'satfat' => 20,
		   'cholesterol' => 300,
		   'sodium' => 2300,
		   'carbohydrates' => 300,
		   'fiber' => 25,
		   'protein' => 50,
		   'vitamin_a' => 5000,
		   'vitamin_c' => 60,
		   'calcium' => 1000,
		   'iron' => 18 );

  /* attempt to restyle the label */
  $style = '';
  if($nutr_width != 22) {
    $style = "style='width: ".$nutr_width."em; font-size: ".(($nutr_width/22)*.75)."em;'";
  }

  return "<div ".($nutri_id ? "id='".$nutri_id."'" : "") . ($style ? $style : "") . "class='wp-nutrition-label" . ( $nutri_cssclass ? " ".$nutri_cssclass : "") . "'>
  <h2>".__("Nutrition Facts")."</h2>
  <span class='alignleft'>".__("Serving Size")." ".$nutr_servingsize."</span>
  <span class='alignright'>".__("Servings")." ".$nutr_servings."</span>
  <hr class='heavy' />
  <strong>Amount Per Serving</strong>
   <hr />
   <span class='alignleft'>".__("Calories")." ".$nutr_calories."</span>
   <span class='alignright'>Calories from Fat ".($nutr_totalfat * 9)."</span>
   <hr />
   <div class='alignright'><strong>% ".__("Daily Value")."*</strong></div><div style='clear: both'></div>
   <span class='alignleft'><strong>".__("Total Fat")."</strong> ".$nutr_totalfat."g</span>
   <span class='alignright'>".nutr_percentage($nutr_totalfat, $rda['totalfat'])."%</span>
   <hr />
   <span class='alignleft indent'>".__("Saturated Fat")." ".$nutr_satfat."g</span>
   <span class='alignright'>".nutr_percentage($nutr_satfat, $rda['satfat'])."%</span>
   <hr />
   <span class='indent'>".__("Trans Fat")." ".$nutr_transfat."g</span>
   <hr />
   <span class='alignleft'><strong>".__("Cholesterol")."</strong> ".$nutr_cholesterol."mg</span>
   <span class='alignright'>".nutr_percentage($nutr_cholesterol, $rda['cholesterol'])."%</span>
   <hr />
   <span class='alignleft'><strong>".__("Sodium")."</strong> ".$nutr_sodium."mg</span>
   <span class='alignright'>".nutr_percentage($nutr_sodium, $rda['sodium'])."%</span>
   <hr />
   <span class='alignleft'><strong>".__("Total Carbohydrate")."</strong> ".$nutr_carbohydrates."g</span>
   <span class='alignright'>".nutr_percentage($nutr_carbohydrates, $rda['carbohydrates'])."%</span>
   <hr />
   <span class='alignleft indent'>".__("Dietary Fiber")." ".$nutr_fiber."g</span>
   <span class='alignright'>".nutr_percentage($nutr_fiber, $rda['fiber'])."%</span>
   <hr />
    <span class='indent'>".__("Sugars")." ".$nutr_sugars."g</span>
   <hr />
   <span class='alignleft'><strong>".__("Protein")."</strong> ".$nutr_protein."g</span>
   <span class='alignright'>".nutr_percentage($nutr_protein, $rda['protein'])."%</span>
   <hr />
   <span class='small'>* ".__("Percent Daily Values are based on a 2,000 calorie diet. Your daily values may be higher or lower depending on your calorie needs.")."</span>
   <span class='small alignright'><a href='http://www.romkey.com/code/wp-nutrition-label'>wp-nutrition-label</a>
</div>";
} ?>
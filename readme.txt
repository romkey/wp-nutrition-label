=== Plugin Name ===
Contributors: romkey
Tags: food, nutrition, nutrition label
<<<<<<< HEAD
Tested up to: 3.5.2
Requires at least: 3.0
Stable tag: 0.3.1
=======
Tested up to: 3.1.1
Requires at least: 3.0
Stable tag: 0.3
>>>>>>> e2a8ad62d0a8e377511069be9aec51a2c7e480f0

== Description ==

This plugin provides a Wordpress shortcode which generate an FDA-style nutrition label.

See http://en.wikipedia.org/wiki/Nutrition_facts_label for more information on nutrition labels.

Reference daily intake values come from http://en.wikipedia.org/wiki/Reference_Daily_Intake

You can visit the official page for wp-nutrition-label at http://romkey.com/code/wp-nutrition-label

== Installation ==

1. Upload /wp-nutrition-label to the /wp-content/plugins directory

2. Activate the plugin through the Plugins menu in WordPress

3. In any posts or pages where you wish to insert a nutrition label, use the shortcode [nutr-label]. The shortcode accepts the following attributes:
   servingsize, servings, calories, totalfat, satfat, transfat, cholesterol, sodium, carbohydrates, fiber, sugars, protein, id, class, width

== Frequently Asked Questions ==

= What units do the attributes use? =

* Grams: totalfat, satfat, transfat, carbohydrates, fiber, sugars, protein
* Milligrams (mg): cholesterol and sodium
* Unitless: servings and calories (units are implicit for calories)
* You should include the unit in the serving size attribute (ie: "4 oz")

= What about **Calories from Fat**? =

The **Calories from Fat** number is computed from the totalfat attribute.

= What about vitamins? =

Working on it.

= How do I style the nutrition label? =

You can control the width with the "width" attribute. The width attribute uses **ems** as its unit. It is styled to scale but it's likely that the "Nutrition Label" text won't scale well as the default font is Helvetica, which isn't fixed-width.

You can specify the DOM ID of the enclosing **div** by setting the **id** attribute in the shortcode. You can also specify a CSS class by setting the **class** attribute. Then you can provide your own styling to change the label as you see fit.

= How about calculating the nutrition values based on a recipe? =

This is **really** hard to do. To do it at all reliably requires human intervention to match ingredients names against their entries in a nutrition database. That's a level of difficulty I don't wan to try to tackle with this plugin. You may find the USDA's free online nutrition database useful for looking up nutrition information:

http://www.nal.usda.gov/fnic/foodcomp/search/

= How do I contribute translations to other languages? =

You're welcome to email the .po and .mo files to me at wordpress [at] romkey [dot] com

= Where can I find the development version of the plugin? =

Development work on this plugin is hosted on github at https://github.com/romkey/wp-nutrition-label

== Screenshots ==

1. Example using the shortcode

2. Example output

== Upgrade Notice ==

= 0.3 =
* Calculate calories from protein, carbohydrates and fat if no calories specified.

= 0.2 =
* Upgrade only needed to get info into plugin directory pages.

== Changelog ==

= 0.3 =
* Added code to help support internationalization, improved comments, calculate default total calories if not specified.

= 0.2 =
* Changed filename from README to readme.txt

= 0.1 =
* Initial release

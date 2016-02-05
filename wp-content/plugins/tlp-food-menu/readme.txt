=== TLP Food Menu ===
Contributors: techlabpro1
Donate link: 
Tags: food, food menu, menu, cafe, coffee, cuisine, dining, drink, restaurant, restaurant menu, tlp food menu.
Requires at least: 4
Tested up to: 4.4
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Fully responsive and mobile friendly WP food menu display plugin for restaurant, cafes, bars, coffee house, fast food.

== Description ==

[Plugin Demo](http://demo.radiustheme.com/wordpress/plugins/food-menu/) | [Documentation](https://radiustheme.com/how-to-setup-and-configure-tlp-food-menu-free-version-for-wordpress/)

TLP Food Menu is fully responsive and mobile friendly food menu display plugin for restaurant, cafes, bars, coffee house, fast food. you can call it in templates, posts, pages and widgets. From admin end you can easily create food item with name, description, Excerpt (used as short description), image and price.

It is fully HTML5 and CSS3. It has ShortCode and widget included. You can display all food item or multiple category or single category at a time.


= Features =
* Fully Responsive
* Display All Food item, Multiple or Single Category in a Page/ Post
* Currency select option
* Custom meta fields
* Custom CSS option
* ShortCode
* Custom Detail Page template

= Fully translatable =
* POT files included (/languages/)

= Available fields =

* Title (Menu item name)
* Description (Post Content)
* Category (WP default)
* Order (used for ordering in menu order)
* Price (Custom field)
* Excerpt (used as short description)
* Featured image (Main image)


= ShortCode settings =

* **All Food Items:**
<code>[foodmenu] or [foodmenu orderby="menu_order" order="ASC"]</code>
* **Display Multi Category:**
<code>[foodmenu cat="4,8" orderby="title" order="ASC"]</code>
* **Display Single Category:**
<code>[foodmenu cat="4" orderby="menu_order" order="ASC"]</code>
* **cat** = catgory id (only integer)
* **orderby** = Orderby (title , date, menu_order)
* **order** = ASC, DESC

= For Use Template PHP File :- =
<code><?php echo do_shortcode('[foodmenu cat="4" orderby="menu_order" order="ASC"]'); ?></code>


For any bug or suggestion please mail us: support@techlabpro.com

== Installation ==

1. Add plugin to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Create food menu.
4. Add shortCode to display the food item.

= Requirements =

* **WordPress version:** >= 4
* **PHP version:** >= 5.2.4

== Frequently Asked Questions ==


== Screenshots ==

01. All list view
02. Category list view
03. Specific list view
04. Widget view
05. Add New Food
06. Food Menu Settings

== Changelog ==

= 1.1 =
* Permalink
* Layout Grid style improvement
* Fix some bug

= 1.0 =
* Initial upload

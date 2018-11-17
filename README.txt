=== Plugin Name ===
Contributors: lucagrandicelli
Tags: facetwp, archive, year, yearly, facet
Requires at least: 3.0.1
Tested up to: 4.9.8
Stable tag: 1.0.0
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-3.0.html

This is a free add-on for the FacetWP plugin (https://facetwp.com/). It adds a new facet type called "Yearly Archive" which can display a list of years with an associated counter of published posts.

See how it works:

https://www.youtube.com/watch?v=7CeLAv-ZLjA

== Description ==

This is a free add-on for the FacetWP plugin (https://facetwp.com/). It adds a new facet type called "Yearly Archive" which can display a list of years with an associated counter of published posts.

== Installation ==

1. Download and extract the plugin;
2. Upload the `yearly-archive-facetwp` folder to the `/wp-content/plugins/` directory;
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= Counter is bigger than displayed posts =

This is because your FacetWP plugin is indexing both posts, pages or some other Custom Post Type. You should use the "facetwp_query_args" Wordpress filter to make it index only the post types you prefer.

== Screenshots ==

1. An example of how you can filter your posts by year, having a counter for the relative amount of published posts.

https://www.youtube.com/watch?v=7CeLAv-ZLjA

== Changelog ==

= 1.0.0 =
* Initial commit
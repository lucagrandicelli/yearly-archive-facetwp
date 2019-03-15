=== Plugin Name ===
Contributors: lucagrandicelli
Tags: facetwp, archive, year, yearly, facet
Requires at least: 3.0.1
Tested up to: 5.1.1
Stable tag: 2.1.1
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
= 2.1.1 =
* Added compatibility support for Wordpress 5.1.0

= 2.1.0 =
* Added support for the hooks library on FacetWP versions < 3.2.11

= 2.0.1 =
* Fix notices when trying to access undefined array keys
* Fix broken facet settings
* Added default class to allow for custom styling

= 2.0.0 =
* Updated hooks library reference to FWP.hooks as per new changes in WP 5.0 release.
* Fixed wrong array 'count' key reference when debug mode is enabled.
* Minor fixes.

= 1.0.2 =
* Fixed wrong filter registration.

= 1.0.0 =
* Initial commit
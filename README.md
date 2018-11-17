![Featured Image Cover](https://www.lucagrandicelli.it/projects/wordpress/plugins/yearly-archive-facetwp/assets/banner-772x250.jpg)
# Yearly Archive FacetWP

This Wordpress plugin is an add-on for the FacetWP plugin ([https://facetwp.com/](https://facetwp.com/)). It adds a new facet type called "Yearly Archive" which can display a list of years with an associated counter of published posts.

## How it works (Youtube video)
[![Youtube Video](http://img.youtube.com/vi/3Ddbagri8d0/1.jpg)](http://www.youtube.com/watch?v=3Ddbagri8d0)

## Frequently Asked Questions

**The counter marks a larger number than the number of posts actually published.**

This is because your FacetWP plugin is indexing both posts, pages or some other Custom Post Type. You should use the ```facetwp_query_args``` Wordpress filter to make it index only the post types you prefer.
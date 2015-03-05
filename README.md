## Dependencies

The theme’s CSS is pre-processed using [Sass](/sass/sass) and requires the [Bourbon](/thoughtbot/bourbon) and [Neat](/thoughtbot/neat) libraries. Bourbon and Neat are installed in the directory, you’ll only need to install their Ruby Gem if you want to upgrade them, but to compile, you’ll need to install Sass. Follow the instructions on [Sass’s website](http://sass-lang.com/install) and once you’re set-up, open up Terminal, change directories to the theme’s folder, and run the following command, then start editing the Sass file:

```bash
sass --watch _scss:css --style compressed
```

## Content

All of the tutorials are stored in a custom post type called Tutorials. Key meta data is stored in four custom taxonomies – Sections, Spotlight, Locale, and Audience and also in a custom field with the key ‘youtube’. All of this is defined in [functions.php](functions.php).

The ordering of a section is based on the section’s slugs, so to re-order them, change the leading numbers of the slugs. These slugs aren’t used for any publicly accessible urls so they can be changed without setting up redirects.

The ordering of tutorials inside a section can be changed by dragging and dropping inside the list of all tutorials in the admin (functionality provided by [Intuitive Custom Post Order](https://wordpress.org/plugins/intuitive-custom-post-order/)).

On a user’s first visit to the site, the `Segmentation` class looks to see if the user arrived from us.iearn.org OR has an American IP address (powered by [ipinfo.io](http://ipinfo.io)), if either of those are true, their locale dropdown will be set to iEARN-USA. Otherwise it will be set to iEARN. Both the locale and audience dropdown values are stored in cookies so this lookup doesn’t have to occur on subsequent page loads.

The resources section of the homepage can be edited by using the Links manager in the admin.

## License

©2014–2015 iEARN, Inc unless otherwise noted.

The source code for this theme is released under the [GNU GPL v3.0](https://gnu.org/licenses/old-licenses/gpl-2.0.txt). All rights to the iEARN Collaboration Centre name and logo are reserved.
=== Linkify Categories ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: categories, link, linkify, archives, list, widget, template tag, coffee2code
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 2.8
Tested up to: 5.1
Stable tag: 2.2.1

Turn a string, list, or array of category IDs and/or slugs into a list of links to those categories. Provides a widget and template tag.

== Description ==

The plugin provides a widget called "Linkify Catagories" as well as a template tag, `c2c_linkify_categories()`, which allow you to easily specify categories to list and how to list them. Categories are specified by either ID or slug. See other parts of the documentation for example usage and capabilities.

Links: [Plugin Homepage](http://coffee2code.com/wp-plugins/linkify-categories/) | [Plugin Directory Page](https://wordpress.org/plugins/linkify-categories/) | [GitHub](https://github.com/coffee2code/linkify-categories/) | [Author Homepage](http://coffee2code.com)


== Installation ==

1. Install via the built-in WordPress plugin installer. Or download and unzip `linkify-categories.zip` inside the plugins directory for your site (typically `wp-content/plugins/`)
2. Activate the plugin through the 'Plugins' admin menu in WordPress
3. Use provided widget or the `c2c_linkify_categories()` template tag in one of your templates (be sure to pass it at least the first argument indicating what category IDs and/or slugs to linkify -- the argument can be an array, a space-separate list, or a comma-separated list). Other optional arguments are available to customize the output.


== Screenshots ==

1. The plugin's widget configuration.


== Frequently Asked Questions ==

= What happens if I tell it to list something that I have mistyped, haven't created yet, or have deleted? =

If a given ID/slug doesn't match up with an existing category then that item is ignored without error.

= How do I get items to appear as a list (using HTML tags)? =

Whether you use the template tag or the widget, specify the following information for the appropriate fields/arguments:

Before text: `<ul><li>` (or `<ol><li>`)
After text: `</li></ul>` (or `</li></ol>`)
Between categories: `</li><li>`

= Does this plugin include unit tests? =

Yes.


== Template Tags ==

The plugin provides one template tag for use in your theme templates, functions.php, or plugins.

= Functions =

* `<?php c2c_linkify_categories( $categories, $before = '', $after = '', $between = ', ', $before_last = '', $none = '' ) ?>`
Displays links to each of any number of categories specified via category IDs/slugs

= Arguments =

* `$categories`
A single category ID/slug, or multiple category IDs/slugs defined via an array, or multiple categories IDs/slugs defined via a comma-separated and/or space-separated string

* `$before`
(optional) To appear before the entire category listing (if categories exist or if 'none' setting is specified)

* `$after`
(optional) To appear after the entire category listing (if categories exist or if 'none' setting is specified)

* `$between`
(optional) To appear between categories

* `$before_last`
(optional) To appear between the second-to-last and last element, if not specified, 'between' value is used

* `$none`
(optional) To appear when no categories have been found. If blank, then the entire function doesn't display anything

= Examples =

* These are all valid calls:

`<?php c2c_linkify_categories(43); ?>`
`<?php c2c_linkify_categories("43"); ?>`
`<?php c2c_linkify_categories("books"); ?>`
`<?php c2c_linkify_categories("43 92 102"); ?>`
`<?php c2c_linkify_categories("book movies programming-notes"); ?>`
`<?php c2c_linkify_categories("book 92 programming-notes"); ?>`
`<?php c2c_linkify_categories("43,92,102"); ?>`
`<?php c2c_linkify_categories("book,movies,programming-notes"); ?>`
`<?php c2c_linkify_categories("book,92,programming-notes"); ?>`
`<?php c2c_linkify_categories("43, 92, 102"); ?>`
`<?php c2c_linkify_categories("book, movies, programming-notes"); ?>`
`<?php c2c_linkify_categories("book, 92, programming-notes"); ?>`
`<?php c2c_linkify_categories(array(43,92,102)); ?>`
`<?php c2c_linkify_categories(array("43","92","102")); ?>`
`<?php c2c_linkify_categories(array("book","movies","programming-notes")); ?>`
`<?php c2c_linkify_categories(array("book",92,"programming-notes")); ?>`

* `<?php c2c_linkify_categories("43 92"); ?>`

Outputs something like:

 `<a href="http://yourblog.com/category/books">Books</a>, <a href="http://yourblog.com/category/movies">Movies</a>`

* `<ul><?php c2c_linkify_categories("43, 92", "<li>", "</li>", "</li><li>"); ?></ul>`

Outputs something like:

`<ul><li><a href="http://yourblog.com/category/books">Books</a></li><li><a href="http://yourblog.com/category/movies">Movies</a></li></ul>`

* `<?php c2c_linkify_categories(""); // Assume you passed an empty string as the first value ?>`

Displays nothing.

* `<?php c2c_linkify_categories("", "", "", "", "", "No related categories."); // Assume you passed an empty string as the first value ?>`

Outputs:

`No related categories.`


== Hooks ==

The plugin exposes one action for hooking.

**c2c_linkify_categories (action)**

The 'c2c_linkify_categories' hook allows you to use an alternative approach to safely invoke `c2c_linkify_categories()` in such a way that if the plugin were to be deactivated or deleted, then your calls to the function won't cause errors in your site.

Arguments:

* same as for `c2c_linkify_categories()`

Example:

Instead of:

`<?php c2c_linkify_categories( "43, 92", 'Categories: ' ); ?>`

Do:

`<?php do_action( 'c2c_linkify_categories', "43, 92", 'Categories: ' ); ?>`


== Changelog ==

= () =
* New: Add README.md
* Change: Escape text used in markup attributes (hardening)
* Change: Add GitHub link to readme
* Change: Unit tests: Minor whitespace tweaks to bootstrap
* Change: Rename readme.txt section from 'Filters' to 'Hooks'
* Change: Modify formatting of hook name in readme to prevent being uppercased when shown in the Plugin Directory
* Change: Note compatibility through WP 5.1+
* Change: Update copyright date (2019)
* Change: Update License URI to be HTTPS

= 2.2.1 (2017-02-25) =
* Fix: Fix unit tests by not declaring test class variable as static
* Change: Update unit test bootstrap
    * Default `WP_TESTS_DIR` to `/tmp/wordpress-tests-lib` rather than erroring out if not defined via environment variable
    * Enable more error output for unit tests
* Change: Note compatibility through WP 4.7+
* Change: Minor readme.txt content and formatting tweaks
* Change: Update copyright date (2017)

= 2.2 (2016-03-12) =
* Change: Update widget to 004:
    * Add `register_widget()` and change to calling it when hooking 'admin_init'.
    * Add `version()` to return the widget's version.
    * Reformat config array.
    * Discontinue use of old-style constructor.
    * Add inline docs for class variables.
    * Late-escape attribute values.
    * Reorder some conditional expressions.
* Change: Explicitly declare methods in unit tests as public or protected.
* Change: Fix and simplify unit tests. Add tests for widget.
* New: Add 'Text Domain' to plugin header.
* New: Add LICENSE file.
* New: Add empty index.php to prevent files from being listed if web server has enabled directory listings.
* Change: Use DIRECTORY_SEPARATOR in place of '/' when requiring widget file.
* Change: Note compatibility through WP 4.4+.
* Change: Update copyright date (2016).

= 2.1.3 (2015-08-12) =
* Update: Discontinue use of PHP4-style constructor invocation of WP_Widget to prevent PHP notices in PHP7
* Update: Minor widget header reformatting
* Update: Minor widget file code tweaks (spacing, bracing)
* Update: Minor inline document tweaks (spacing)
* Note compatibility through WP 4.3+

= 2.1.2 (2015-02-11) =
* Note compatibility through WP 4.1+
* Update copyright date (2015)

= 2.1.1 (2014-08-26) =
* Minor plugin header reformatting
* Change documentation links to wp.org to be https
* Note compatibility through WP 4.0+
* Add plugin icon

= 2.1 (2013-12-20) =
* Validate category is either int or string before handling
* Add unit tests
* Minor code tweaks (spacing, bracing)
* Minor documentation tweaks
* Note compatibility through WP 3.8+
* Update copyright date (2014)
* Change donate link
* Add banner

= 2.0.4 =
* Add check to prevent execution of code if file is directly accessed
* Note compatibility through WP 3.5+
* Update copyright date (2013)
* Create repo's WP.org assets directory
* Move screenshot into repo's assets directory

= 2.0.3 =
* Re-license as GPLv2 or later (from X11)
* Add 'License' and 'License URI' header tags to readme.txt and plugin file
* Remove ending PHP close tag
* Note compatibility through WP 3.4+

= 2.0.2 =
* Note compatibility through WP 3.3+
* Add link to plugin directory page to readme.txt
* Update copyright date (2012)

= 2.0.1 =
* Note compatibility through WP 3.2+
* Minor code formatting changes (spacing)
* Fix plugin homepage and author links in description in readme.txt

= 2.0 =
* Add Linkify Categories widget
* Rename `linkify_categories()` to `c2c_linkify_categories()` (but maintain a deprecated version for backwards compatibility)
* Rename 'linkify_categories' action to 'c2c_linkify_categories' (but maintain support for backwards compatibility)
* Add Template Tag, Screenshots, and Frequently Asked Questions sections to readme.txt
* Add screenshot of widget admin
* Note compatibility through WP 3.1+
* Update copyright date (2011)

= 1.2 =
* Add filter 'linkify_categories' to respond to the function of the same name so that users can use the do_action() notation for invoking template tags
* Wrap function in if(!function_exists()) check
* Reverse order of implode() arguments
* Fix to prevent PHP notice
* Remove docs from top of plugin file (all that and more are in readme.txt)
* Note compatibility with WP 3.0+
* Minor tweaks to code formatting (spacing)
* Add Filters and Upgrade Notice sections to readme.txt
* Remove trailing whitespace

= 1.1 =
* Add PHPDoc documentation
* Add title attribute to link for each category
* Minor formatting tweaks
* Note compatibility with WP 2.9+
* Drop compatibility with WP older than 2.8
* Update copyright date
* Update readme.txt (including adding Changelog)

= 1.0 =
* Initial release


== Upgrade Notice ==

= 2.2.1 =
Trivial update: fixed some unit tests, noted compatibility through WP 4.7+, updated copyright date

= 2.2 =
Minor update: minor updates to widget code and unit tests; verified compatibility through WP 4.4; updated copyright date (2016).

= 2.1.3 =
Bugfix update: Prevented PHP notice under PHP7+ for widget; noted compatibility through WP 4.3+

= 2.1.2 =
Trivial update: noted compatibility through WP 4.1+ and updated copyright date

= 2.1.1 =
Trivial update: noted compatibility through WP 4.0+; added plugin icon.

= 2.1 =
Moderate update: better validate data received; added unit tests; noted compatibility through WP 3.8+

= 2.0.4 =
Trivial update: noted compatibility through WP 3.5+

= 2.0.3 =
Trivial update: noted compatibility through WP 3.4+; explicitly stated license

= 2.0.2 =
Trivial update: noted compatibility through WP 3.3+ and minor readme.txt tweaks

= 2.0.1 =
Trivial update: noted compatibility through WP 3.2+ and minor code formatting changes (spacing)

= 2.0 =
Feature update: added widget, deprecated `linkify_categories()` in favor of `c2c_linkify_categories()`, renamed action from 'linkify_categories' to 'c2c_linkify_categories', added Template Tags, Screenshots, and FAQ sections to readme, noted compatibility with WP 3.1+, and updated copyright date (2011).

= 1.2 =
Minor update. Highlights: added filter to allow alternative safe invocation of function; verified WP 3.0 compatibility.

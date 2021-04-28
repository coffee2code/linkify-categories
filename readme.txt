=== Linkify Categories ===
Contributors: coffee2code
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=6ARCFJ9TX3522
Tags: categories, link, linkify, archives, list, widget, template tag, coffee2code
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Requires at least: 2.8
Tested up to: 5.7
Stable tag: 2.2.5

Turn a string, list, or array of category IDs and/or slugs into a list of links to those categories. Provides a widget and template tag.

== Description ==

The plugin provides a widget called "Linkify Catagories" as well as a template tag, `c2c_linkify_categories()`, which allow you to easily specify categories to list and how to list them. Categories are specified by either ID or slug. See other parts of the documentation for example usage and capabilities.

Links: [Plugin Homepage](https://coffee2code.com/wp-plugins/linkify-categories/) | [Plugin Directory Page](https://wordpress.org/plugins/linkify-categories/) | [GitHub](https://github.com/coffee2code/linkify-categories/) | [Author Homepage](https://coffee2code.com)


== Installation ==

1. Install via the built-in WordPress plugin installer. Or download and unzip `linkify-categories.zip` inside the plugins directory for your site (typically `wp-content/plugins/`)
2. Activate the plugin through the 'Plugins' admin menu in WordPress
3. Use provided widget or the `c2c_linkify_categories()` template tag in one of your templates (be sure to pass it at least the first argument indicating what category IDs and/or slugs to linkify -- the argument can be an array, a space-separate list, or a comma-separated list). Other optional arguments are available to customize the output.
4. Optional: Use the "Linkify Categories" widget in one of the sidebars provided by your theme.


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

 `<a href="https://example.com/category/books">Books</a>, <a href="https://example.com/category/movies">Movies</a>`

* `<ul><?php c2c_linkify_categories("43, 92", "<li>", "</li>", "</li><li>"); ?></ul>`

Outputs something like:

`<ul><li><a href="https://example.com/category/books">Books</a></li><li><a href="https://example.com/category/movies">Movies</a></li></ul>`

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

= 2.2.5 (2020-08-16) =
* New: Add TODO.md for newly added potential TODO items
* Change: Restructure unit test file structure
    * New: Create new subdirectory `phpunit/` to house all files related to unit testing
    * Change: Move `bin/` to `phpunit/bin/`
    * Change: Move `tests/bootstrap.php` to `phpunit/`
    * Change: Move `tests/` to `phpunit/tests/`
    * Change: Rename `phpunit.xml` to `phpunit.xml.dist` per best practices
* Change: Note compatibility through WP 5.5+

= 2.2.4 (2020-05-06) =
* Change: Use HTTPS for link to WP SVN repository in bin script for configuring unit tests
* Change: Note compatibility through WP 5.4+
* Change: Update links to coffee2code.com to be HTTPS
* Change: Update examples in documentation to use a proper example URL

= 2.2.3 (2019-11-26) =
* New: Add CHANGELOG.md and move all but most recent changelog entries into it
* New: Add optional step to installation instructions to note availability of the widget
* Change: Update unit test install script and bootstrap to use latest WP unit test repo
* Change: Note compatibility through WP 5.3+
* Change: Add link to plugin's page in Plugin Directory to README.md
* Change: Update copyright date (2020)
* Change: Split paragraph in README.md's "Support" section into two

= 2.2.2 (2019-02-02) =
* New: Add README.md
* Change: Escape text used in markup attributes (hardening)
* Change: Add GitHub link to readme
* Change: Unit tests: Minor whitespace tweaks to bootstrap
* Change: Rename readme.txt section from 'Filters' to 'Hooks'
* Change: Modify formatting of hook name in readme to prevent being uppercased when shown in the Plugin Directory
* Change: Note compatibility through WP 5.1+
* Change: Update copyright date (2019)
* Change: Update License URI to be HTTPS

_Full changelog is available in [CHANGELOG.md](https://github.com/coffee2code/linkify-categories/blob/master/CHANGELOG.md)._


== Upgrade Notice ==

= 2.2.5 =
Trivial update: Restructured unit test file structure, added a TODO.md file, and noted compatibility through WP 5.5+.

= 2.2.4 =
Trivial update: Updated a few URLs to be HTTPS and noted compatibility through WP 5.4+.

= 2.2.3 =
Trivial update: modernized unit tests, created CHANGELOG.md to store historical changelog outside of readme.txt, noted compatibility through WP 5.3+, and updated copyright date (2020)

= 2.2.2 =
Trivial update: minor hardening, noted compatibility through WP 5.1+, and updated copyright date (2019)

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

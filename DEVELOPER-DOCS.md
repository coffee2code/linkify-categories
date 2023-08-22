# Developer Documentation

This plugin provides a [hook](#hook) and a [template tag](#template-tag).

## Template Tag

The plugin provides one template tag for use in your theme templates, functions.php, or plugins.

### Functions

* `<?php c2c_linkify_categories( $categories, $before = '', $after = '', $between = ', ', $before_last = '', $none = '' ) ?>`
Displays links to each of any number of categories specified via category IDs/slugs

### Arguments

* `$categories` _(string|int|array)_
A single category ID/slug, or multiple category IDs/slugs defined via an array, or multiple category IDs/slugs defined via a comma-separated and/or space-separated string

* `$before` _(string)_
Optional. Text to appear before the entire category listing (if categories exist or if 'none' setting is specified). Default is an empty string.

* `$after` _(string)_
Optional. Text to appear after the entire category listing (if categories exist or if 'none' setting is specified). Default is an empty string.

* `$between` _(string)_
Optional. Text to appear between categories. Default is ", ".

* `$before_last` _(string)_
Optional. Text to appear between the second-to-last and last element, if not specified, 'between' value is used. Default is an empty string.

* `$none` _(string)_
Optional. Text to appear when no categories have been found. If blank, then the entire function doesn't display anything. Default is an empty string.

### Examples

These are all valid calls:

```php
<?php c2c_linkify_categories(43); ?>
<?php c2c_linkify_categories("43"); ?>
<?php c2c_linkify_categories("books"); ?>
<?php c2c_linkify_categories("43 92 102"); ?>
<?php c2c_linkify_categories("book movies programming-notes"); ?>
<?php c2c_linkify_categories("book 92 programming-notes"); ?>
<?php c2c_linkify_categories("43,92,102"); ?>
<?php c2c_linkify_categories("book,movies,programming-notes"); ?>
<?php c2c_linkify_categories("book,92,programming-notes"); ?>
<?php c2c_linkify_categories("43, 92, 102"); ?>
<?php c2c_linkify_categories("book, movies, programming-notes"); ?>
<?php c2c_linkify_categories("book, 92, programming-notes"); ?>
<?php c2c_linkify_categories(array(43,92,102)); ?>
<?php c2c_linkify_categories(array("43","92","102")); ?>
<?php c2c_linkify_categories(array("book","movies","programming-notes")); ?>
<?php c2c_linkify_categories(array("book",92,"programming-notes")); ?>
```

Though, for consistency, you'd be better off not using a mix of IDs and slugs.

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


## Hook

The plugin exposes one action for hooking.

### `c2c_linkify_categories` _(action)_

The `c2c_linkify_categories` hook allows you to use an alternative approach to safely invoke `c2c_linkify_categories()` in such a way that if the plugin were to be deactivated or deleted, then your calls to the function won't cause errors in your site.

#### Arguments:

* same as for `c2c_linkify_categories()`

#### Example:

Instead of:

`<?php c2c_linkify_categories( "43, 92", 'Categories: ' ); ?>`

Do:

`<?php do_action( 'c2c_linkify_categories', "43, 92", 'Categories: ' ); ?>`

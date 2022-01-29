#WordPress Breakdown

TODO: separate into folders, e.g. 'css', 'blocks', 'hooks' etc.

## Blocks General

WordPress Main Blocks Functions [Link](https://github.com/WordPress/WordPress/blob/master/wp-includes/blocks.php)

How Gutenberg overrides blocks from core & loads blocks: [lib/blocks.php](https://github.com/WordPress/gutenberg/blob/trunk/lib/blocks.php)

### Block Template
Blocks API: WP_Block_Template class - added in 5.8

Mostly empty class except to define public variables that set things like id, title, content, description, source of template (user, theme, core)

[Source Link](https://github.com/WordPress/WordPress/blob/master/wp-includes/class-wp-block-template.php)

### Block Template Loader

The block template loader functions that add filters to use 'wp_template' posts instead of theme template files.

Adds the following tags to head: 
 - Adds viewport meta tag via ```add_action( 'wp_head', _block_template_viewport_meta_tag', 0 )``` 
 - Renders the ```<title>``` tag from post title (happens whether or not theme_support is enabled for title-tag).

Renders ```'<div class="wp-site-blocks">' . $content . '</div>'``` via ```get_the_block_template_html()```

[Source Link](https://github.com/WordPress/WordPress/blob/master/wp-includes/block-template.php)

### Block Template Part Areas

```php
// Define constants for supported wp_template_part_area taxonomy.
if ( ! defined( 'WP_TEMPLATE_PART_AREA_HEADER' ) ) {
	define( 'WP_TEMPLATE_PART_AREA_HEADER', 'header' );
}
if ( ! defined( 'WP_TEMPLATE_PART_AREA_FOOTER' ) ) {
	define( 'WP_TEMPLATE_PART_AREA_FOOTER', 'footer' );
}
if ( ! defined( 'WP_TEMPLATE_PART_AREA_SIDEBAR' ) ) {
	define( 'WP_TEMPLATE_PART_AREA_SIDEBAR', 'sidebar' );
}
if ( ! defined( 'WP_TEMPLATE_PART_AREA_UNCATEGORIZED' ) ) {
	define( 'WP_TEMPLATE_PART_AREA_UNCATEGORIZED', 'uncategorized' );
}
```

Default directories for templates and template parts in block themes are now: ```templates``` and ```parts``` although
```get_block_theme_folders()``` adds backwards compatibility to render the old ```block-templates``` and ```block-template-parts``` folders as
template directories.

The Default templates loaded - these add a class of 'index', 'home', etc to the ```<body>``` tag.

```php 
$default_template_types = array(
		'index'          => array(
			'title'       => _x( 'Index', 'Template name' ),
			'description' => __( 'Displays posts.' ),
		),
		'home'           => array(
			'title'       => _x( 'Home', 'Template name' ),
			'description' => __( 'Displays as the site\'s home page, or as the Posts page when a static home page isn\'t set.' ),
		),
		'front-page'     => array(
			'title'       => _x( 'Front Page', 'Template name' ),
			'description' => __( 'Displays as the site\'s home page.' ),
		),
		'singular'       => array(
			'title'       => _x( 'Singular', 'Template name' ),
			'description' => __( 'Displays a single post or page.' ),
		),
		'single'         => array(
			'title'       => _x( 'Single Post', 'Template name' ),
			'description' => __( 'Displays a single post.' ),
		),
		'page'           => array(
			'title'       => _x( 'Page', 'Template name' ),
			'description' => __( 'Displays a single page.' ),
		),
		'archive'        => array(
			'title'       => _x( 'Archive', 'Template name' ),
			'description' => __( 'Displays post categories, tags, and other archives.' ),
		),
		'author'         => array(
			'title'       => _x( 'Author', 'Template name' ),
			'description' => __( 'Displays latest posts written by a single author.' ),
		),
		'category'       => array(
			'title'       => _x( 'Category', 'Template name' ),
			'description' => __( 'Displays latest posts in single post category.' ),
		),
		'taxonomy'       => array(
			'title'       => _x( 'Taxonomy', 'Template name' ),
			'description' => __( 'Displays latest posts from a single post taxonomy.' ),
		),
		'date'           => array(
			'title'       => _x( 'Date', 'Template name' ),
			'description' => __( 'Displays posts from a specific date.' ),
		),
		'tag'            => array(
			'title'       => _x( 'Tag', 'Template name' ),
			'description' => __( 'Displays latest posts with single post tag.' ),
		),
		'attachment'     => array(
			'title'       => __( 'Media' ),
			'description' => __( 'Displays individual media items or attachments.' ),
		),
		'search'         => array(
			'title'       => _x( 'Search', 'Template name' ),
			'description' => __( 'Template used to display search results.' ),
		),
		'privacy-policy' => array(
			'title'       => __( 'Privacy Policy' ),
			'description' => __( 'Displays the privacy policy page.' ),
		),
		'404'            => array(
			'title'       => _x( '404', 'Template name' ),
			'description' => __( 'Displays when no content is found.' ),
		),
	);
```

[Source Link](https://github.com/WordPress/WordPress/blob/master/wp-includes/block-template-utils.php)

### Block Register & unregister for styles, etc.

class: WP_Block_Styles_Registry.

[Source Link](https://github.com/WordPress/WordPress/blob/master/wp-includes/class-wp-block-styles-registry.php)

## Block Hooks
[Block Filters](https://developer.wordpress.org/block-editor/reference-guides/filters/block-filters/)

## Theme.json Reference
[Theme Json](https://developer.wordpress.org/block-editor/reference-guides/theme-json-reference/theme-json-living/)

## Base Styles

[Files Directory](https://github.com/WordPress/gutenberg/tree/trunk/packages/base-styles)

### Most Used Breakpoints
```scss
$break-huge: 1440px;
$break-wide: 1280px;
$break-xlarge: 1080px;
$break-large: 960px;	// admin sidebar auto folds
$break-medium: 782px;	// adminbar goes big
$break-small: 600px;
$break-mobile: 480px;
$break-zoomed-in: 280px;
```
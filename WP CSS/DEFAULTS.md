# Why / Where WordPress Loads Default Styles

Hurray for inline, programmatically generated CSS...

## Stand Alone Body {} for margin.
Appears after CSS Custom Props
```css
body {
 margin: 0;
}
```

```php 
/*
 * Reset default browser margin on the root body element.
 * This is set on the root selector **before** generating the ruleset
 * from the `theme.json`. This is to ensure that if the `theme.json` declares
 * `margin` in its `spacing` declaration for the `body` element then these
 * user-generated values take precedence in the CSS cascade.
 * @link https://github.com/WordPress/gutenberg/issues/36147.
 */
if ( self::ROOT_BLOCK_SELECTOR === $selector ) {
	$block_rules .= 'body { margin: 0; }';
}

```
From [WP_Theme_JSON](https://github.com/WordPress/WordPress/blob/99bac7e17cfb5d534b33ffc3a70bff9d9b86875d/wp-includes/class-wp-theme-json.php#L809) class.
Part of the ```private function get_block_classes( $style_nodes ) {}```

## .wp-site-blocks

```css
.wp-site-blocks > .alignleft {
 float: left;
 margin-right: 2em;
}
.wp-site-blocks > .alignright {
 float: right;
 margin-left: 2em;
}
.wp-site-blocks > .aligncenter {
 justify-content: center;
 margin-left: auto;
 margin-right: auto;
}
.wp-site-blocks > * {
 margin-top: 0;
 margin-bottom: 0;
}
.wp-site-blocks > * + * {
 margin-top: var( --wp--style--block-gap );
}
```

Appears after more body {} coming from ```theme.json``` e.g. font-family, font-size, margin.

Code that generates it in WP_Theme_JSON:

```css
if ( self::ROOT_BLOCK_SELECTOR === $selector ) {
    $block_rules .= '.wp-site-blocks > .alignleft { float: left; margin-right: 2em; }';
	$block_rules .= '.wp-site-blocks > .alignright { float: right; margin-left: 2em; }';
	$block_rules .= '.wp-site-blocks > .aligncenter { justify-content: center; margin-left: auto; margin-right: auto; }';

	$has_block_gap_support = _wp_array_get( $this->theme_json, array( 'settings', 'spacing', 'blockGap' ) ) !== null;
	if ( $has_block_gap_support ) {
            $block_rules .= '.wp-site-blocks > * { margin-top: 0; margin-bottom: 0; }';  
            $block_rules .= '.wp-site-blocks > * + * { margin-top: var( --wp--style--block-gap ); }';
	}  
}
```

[Source Link](https://github.com/WordPress/WordPress/blob/99bac7e17cfb5d534b33ffc3a70bff9d9b86875d/wp-includes/class-wp-theme-json.php#L822)



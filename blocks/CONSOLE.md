# Console Command Cheatsheet

## Get Block Attributes

With the block selected in the block-editor, enter:

```js
wp.data.select( 'core/block-editor' ).getSelectedBlock().attributes;
```
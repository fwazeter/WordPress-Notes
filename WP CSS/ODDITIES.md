# Weird and Bizarre Things

## wp-block-template-part

If you set ```alignwide``` it defaults to full width anyway. Tested specifically when first element is ```wp-block-group```.

To fix this, you have to do a group within a group with the second group, and have the first group 'inherit site default layout'.

```
<!-- Group1 --> Set to inherit site default layout
    <!-- Group2 --> Set Width to wide/full/none <!-- /group2 -->
<!-- /Group1 -->
```


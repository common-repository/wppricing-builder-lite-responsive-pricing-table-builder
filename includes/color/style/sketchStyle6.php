<?php if(!defined('ABSPATH')) die('Direct access of plugin file not allowed'); ?>
<?php
  if( !empty( $getDefault ) ) {
    $default = array_replace_recursive(  $default, array (
      '$block-background-color' => '#fff',
      '$block-border-color' => '#d1d1d1',
      '$button-border-color' => '$theme-color',
      '$button-background-color' => '$block-background-color',
      '$button-color' => '$button-border-color',
      '$hover-button-border-color' => 'highlight-color($button-border-color, 7)',
      '$hover-button-background-color' => '$button-background-color',
      '$hover-button-color' => 'highlight-color($button-color, 7)',
      '$title-color' => '$button-color',
      '$title-background-color' => '$button-background-color',
      '$title-border-color' => '$button-border-color',
      '$price-color' => '$button-border-color',
      '$list-color' => '$button-color',
      '$list-background-color' => '$button-background-color',
      '$list-border-color' => '$button-border-color',
      '$tooltip-background-color' => 'lightness($theme-color, 10)',
      '$active-block-background-color' => '$block-background-color',
      '$active-block-border-color' => 'lighten($theme-color, 15)',
      '$active-button-border-color' => '$button-border-color',
      '$active-button-background-color' => '$active-button-border-color',
      '$active-button-color' => '#fff',
      '$active-hover-button-border-color' => 'highlight-color($active-button-border-color, 7)',
      '$active-hover-button-background-color' => 'highlight-color($active-button-background-color, 7)',
      '$active-hover-button-color' => '$active-button-color',
      '$active-title-color' => '$active-button-color',
      '$active-title-background-color' => '$active-button-background-color',
      '$active-title-border-color' => '$active-button-border-color',
      '$active-price-color' => '$active-block-border-color',
      '$active-list-color' => '$active-button-color',
      '$active-list-background-color' => '$active-button-background-color',
      '$active-list-border-color' => '$active-button-border-color',
    ) );
  }
?>

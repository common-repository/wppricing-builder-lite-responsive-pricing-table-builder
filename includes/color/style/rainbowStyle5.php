<?php if(!defined('ABSPATH')) die('Direct access of plugin file not allowed'); ?>
<?php
  if( !empty( $getDefault ) ) {
    $default = array_replace_recursive(  $default, array (
      '$block-background-gradient-middle-color' => '$theme-color',
      '$block-background-gradient-start-color' => 'lighten($block-background-gradient-middle-color, 20)',
      '$block-background-gradient-end-color' => 'darken($block-background-gradient-middle-color, 10)',
      '$block-background-pattern-color' => '#fff',
      '$block-box-shadow-color' => '$block-background-gradient-middle-color',
      '$title-color' => '#fff',
      '$price-color' => '#fff',
      '$list-color' => '#fff',
      '$button-color' => '$block-background-gradient-middle-color',
      '$button-background-color' => '#fff',
      '$hover-button-color' => 'highlight-color($button-color, 15)',
      '$hover-button-background-color' => '$button-background-color',
      '$tooltip-background-color' => 'lightness($theme-color, 10)',
      '$active-block-background-gradient-middle-color' => '$block-background-gradient-start-color',
      '$active-block-background-gradient-start-color' => '$block-background-gradient-start-color',
      '$active-block-background-gradient-end-color' => '$block-background-gradient-middle-color',
      '$active-block-background-pattern-color' => '$block-background-pattern-color',
      '$active-block-box-shadow-color' => '$active-block-background-gradient-middle-color',
      '$active-title-color' => '$title-color',
      '$active-price-color' => '$price-color',
      '$active-list-color' => '$list-color',
      '$active-button-color' => '$button-color',
      '$active-button-background-color' => '$button-background-color',
      '$active-hover-button-color' => 'highlight-color($active-button-color, 15)',
      '$active-hover-button-background-color' => '$active-button-background-color',
    ) );
  }
?>

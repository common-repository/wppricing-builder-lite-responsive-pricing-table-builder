<?php if(!defined('ABSPATH')) die('Direct access of plugin file not allowed'); ?>
<?php
  if( !empty( $getDefault ) ) {
    $default = array_replace_recursive(  $default, array (
      '$block-background-color' => '#233039',
      '$title-color' => '#fff',
      '$title-background-color' => 'darken($theme-color, 10)',
      '$price-color' => '#fff',
      '$list-color' => '#fff',
      '$list-background-color' => '$title-background-color',
      '$button-color' => '#fff',
      '$button-background-color' => '$title-background-color',
      '$hover-button-background-color' => 'highlight-color($button-background-color, 7)',
      '$tooltip-background-color' => 'lightness($theme-color, 10)',
      '$active-block-background-color' => '$theme-color',
      '$active-title-color' => '$title-color',
      '$active-title-background-color' => '$title-background-color',
      '$active-price-color' => '$price-color',
      '$active-list-color' => '$list-color',
      '$active-list-background-color' => '$list-background-color',
      '$active-button-color' => '$button-color',
      '$active-button-background-color' => '$button-background-color',
      '$active-hover-button-background-color' => 'highlight-color($active-button-background-color, 7)',
    ) );
  }
?>

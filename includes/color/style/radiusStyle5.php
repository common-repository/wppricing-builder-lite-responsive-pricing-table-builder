<?php if(!defined('ABSPATH')) die('Direct access of plugin file not allowed'); ?>
<?php
  if( !empty( $getDefault ) ) {
    $default = array_replace_recursive(  $default, array (
      '$block-background-color' => '#233039',
      '$button-color' => '#fff',
      '$button-background-color' => 'darken($theme-color, 10)',
      '$hover-button-background-color' => 'highlight-color($button-background-color, 7)',
      '$title-color' => '#fff',
      '$title-background-color' => '$button-background-color',
      '$price-color' => '$button-background-color',
      '$list-color' => '#dcdcdc',
      '$tooltip-background-color' => 'lightness($theme-color, 10)',
      '$active-block-background-color' => '$theme-color',
      '$active-button-color' => '$button-color',
      '$active-button-background-color' => '$button-background-color',
      '$active-hover-button-background-color' => 'highlight-color($active-button-background-color, 7)',
      '$active-title-color' => '$title-color',
      '$active-title-background-color' => '$title-background-color',
      '$active-price-color' => '#fff',
      '$active-list-color' => '#fff',
    ) );
  }
?>

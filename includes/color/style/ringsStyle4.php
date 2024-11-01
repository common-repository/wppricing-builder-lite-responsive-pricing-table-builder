<?php if(!defined('ABSPATH')) die('Direct access of plugin file not allowed'); ?>
<?php
  if( !empty( $getDefault ) ) {
    $default = array_replace_recursive(  $default, array (
      '$block-background-color' => '#fff',
      '$block-box-shadow-color' => '#666',
      '$title-color' => 'lightness($theme-color, 30)',
      '$list-color' => '$theme-color',
      '$price-color' => '$theme-color',
      '$button-color' => '#fff',
      '$button-background-color' => '$theme-color',
      '$hover-button-color' => '$button-color',
      '$hover-button-background-color' => 'highlight-color($button-background-color, 7)',
      '$tooltip-background-color' => 'lightness($theme-color, 10)',
      '$active-block-background-color' => '$block-background-color',
      '$active-block-background-gradient-color' => '$theme-color',
      '$active-block-box-shadow-color' => '$block-box-shadow-color',
      '$active-title-color' => '$title-color',
      '$active-list-color' => '$list-color',
      '$active-price-color' => '$price-color',
      '$active-button-color' => '$button-color',
      '$active-button-background-color' => '$button-background-color',
      '$active-hover-button-color' => '$active-button-color',
      '$active-hover-button-background-color' => 'highlight-color($active-button-background-color, 7)',
    ) );
  }
?>

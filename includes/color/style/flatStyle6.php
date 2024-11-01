<?php if(!defined('ABSPATH')) die('Direct access of plugin file not allowed'); ?>
<?php
  if( !empty( $getDefault ) ) {
    $default = array_replace_recursive(  $default, array (
      '$block-background-color' => '#233039',
      '$block-box-shadow-color' => '#666',
      '$title-color' => '#fff',
      '$content-background-color' => 'lighten($block-background-color, 5)',
      '$price-color' => '#fff',
      '$list-color' => '#fff',
      '$button-color' => '#fff',
      '$button-background-color' => 'darken($theme-color, 25)',
      '$hover-button-background-color' => 'highlight-color($button-background-color, 7)',
      '$tooltip-background-color' => 'lightness($theme-color, 10)',
      '$active-block-background-color' => '$theme-color',
      '$active-title-color' => '$title-color',
      '$active-content-background-color' => 'lightness($active-block-background-color, 92)',
      '$active-price-color' => '$theme-color',
      '$active-list-color' => '#787878',
      '$active-button-color' => '$button-color',
      '$active-button-background-color' => '$button-background-color',
      '$active-hover-button-background-color' => 'highlight-color($active-button-background-color, 7)',
    ) );
  }
?>

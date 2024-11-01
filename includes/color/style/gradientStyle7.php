<?php if(!defined('ABSPATH')) die('Direct access of plugin file not allowed'); ?>
<?php
  if( !empty( $getDefault ) ) {
    $default = array_replace_recursive(  $default, array (
      '$active-block-background-gradient-start-color' => '$theme-color',
      '$active-block-background-gradient-end-color' => 'lighten($active-block-background-gradient-start-color, 25)',
      '$block-background-color' => '#233039',
      '$button-color' => '#fff',
      '$button-background-color' => '$active-block-background-gradient-start-color',
      '$hover-button-color' => 'highlight-color($button-color, 7)',
      '$hover-button-background-color' => 'highlight-color($button-background-color, 7)',
      '$title-color' => '#fff',
      '$price-color' => '$button-background-color',
      '$list-color' => '#fff',
      '$tooltip-background-color' => 'lightness($theme-color, 10)',
      '$active-block-box-shadow-color' => '#666',
      '$active-button-color' => '$button-color',
      '$active-button-background-color' => '$button-background-color',
      '$active-hover-button-color' => 'highlight-color($active-button-color, 7)',
      '$active-hover-button-background-color' => 'highlight-color($active-button-background-color, 7)',
      '$active-title-color' => '$title-color',
      '$active-price-color' => '#fff',
      '$active-list-color' => '$list-color',
    ) );
  }
?>

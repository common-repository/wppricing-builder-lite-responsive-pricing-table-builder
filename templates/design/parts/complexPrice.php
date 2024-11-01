<?php if(!defined('ABSPATH')) die(); ?>
<?php 
$priceString = $ptPlansFeaturesMeta['PlanPrice'][$planID];
$priceArray = array_reverse( explode( '.', strrev( $priceString ), 2 ) );
if( count( $priceArray ) == 2 ) {
    array_walk( $priceArray, function(&$item, $key){ $item = strrev( $item ); } );
    $priceMain = $priceArray[0];
    $priceRest = $priceArray[1];
} else {
    $priceMain = $priceString;
    $priceRest = false;
}
?><span class="pt-currency"><?php echo $ptPlansFeaturesMeta['PlanCurrencySymbol'][$planID]; ?></span><span class="pt-price-main"><?php echo $priceMain; ?></span><?php if( $priceRest !== false ) { ?><span class="pt-price-rest"><?php echo $priceRest; ?></span><?php } ?>
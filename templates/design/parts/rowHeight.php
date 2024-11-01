<?php if(!defined('ABSPATH')) die(); ?>
<?php
$rowHeightPrependHTML = '';
$rowHeightAppendHTML = '';
if( isset( $ptPlansFeaturesMeta['FeatureRowHeight'][$featureID] ) && $ptPlansFeaturesMeta['FeatureRowHeight'][$featureID] >= 2 && $ptPlansFeaturesMeta['FeatureRowHeight'][$featureID] <= 3 ) {
    $rowHeightPrependHTML = '<span class="pt-lines-' . $ptPlansFeaturesMeta['FeatureRowHeight'][$featureID] . '"><span class="pt-line-middle">';
    $rowHeightAppendHTML = '</span></span>';
}
?>
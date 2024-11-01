<?php if(!defined('ABSPATH')) die(); ?>
<div class="<?php echo implode( ' ', $baseCSSClassList ); ?>">
    <div class="pt-cols pt-cols-<?php echo count($ptPlansFeaturesMeta['PlanName']); ?>">
        <?php foreach( $ptPlansFeaturesMeta['PlanName'] as $planID => $planName ) { ?>
            <div class="pt-col">
                <div class="pt-block<?php echo ( $ptPlansFeaturesMeta['PlanHighlight'][$planID] ) ? ' pt-selected' : ( ( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) ? ' pt-not-available' : '' ); ?>">
                    <?php if( $planName != '' || $ptPlansFeaturesMeta['PlanPrice'][$planID] != '' ) { ?>
                        <div class="pt-head">
                            <?php if( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] || $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) { ?>
                                <div class="pt-badge<?php echo ( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] ) ? ' pt-discount' : ( $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] ? ' pt-popular' : '' ); ?>">
                                    <span><?php echo ( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] ) ? $ptPlansFeaturesMeta['PlanDiscountSignText'][$planID] : ( $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] ? $ptPlansFeaturesMeta['PlanMostPopularSignText'][$planID] : ( $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ? $ptPlansFeaturesMeta['PlanNotAvailableSignText'][$planID] : '' ) ); ?></span>
                                </div>
                            <?php } ?>
                            <div class="pt-titles">
                                <?php if( $ptPlansFeaturesMeta['PlanShowCaption'][$planID] ) { ?>
                                    <div class="pt-sub-title"><?php echo $ptPlansFeaturesMeta['PlanCaptionText'][$planID]; ?></div>
                                <?php } ?>
                                <div class="pt-title"><?php echo $planName; ?></div>
                            </div>
                            <?php if( $ptPlansFeaturesMeta['PlanPrice'][$planID] != '' ) { ?>
                                <div class="pt-price-block">
                                    <?php include(dirname(__FILE__).'/parts/complexPrice.php'); ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                    <ul class="pt-list">
                        <?php foreach( $ptPlansFeaturesMeta['FeatureName'] as $featureID => $featureName ) { ?>
                            <li>
                                <?php include(dirname(__FILE__).'/parts/tooltipFeature.php'); ?>
                                <div><?php include(dirname(__FILE__).'/parts/tooltipValue.php'); ?></div>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>
                        <a <?php if( !( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) ) { ?>href="<?php echo esc_url($ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID]); ?>" <?php } ?>class="pt-btn"><?php echo $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID]; ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
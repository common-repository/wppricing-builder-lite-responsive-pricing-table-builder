<?php if(!defined('ABSPATH')) die(); ?>
<div class="<?php echo implode( ' ', $baseCSSClassList ); ?>">
    <div class="pt-cols pt-cols-<?php echo count($ptPlansFeaturesMeta['PlanName']); ?>">
        <?php
            $showPlanCaptionBlock = count( array_intersect_key( array_filter( $ptPlansFeaturesMeta['PlanShowCaption'], 'strlen' ), array_filter( $ptPlansFeaturesMeta['PlanCaptionText'], 'strlen' ) ) );
            $showPriceCaptionBlock = count( array_intersect_key( array_filter( $ptPlansFeaturesMeta['PlanShowPriceCaption'], 'strlen' ), array_filter( $ptPlansFeaturesMeta['PlanPriceCaptionText'], 'strlen' ) ) );
        ?>
        <?php foreach( $ptPlansFeaturesMeta['PlanName'] as $planID => $planName ) { ?>
            <div class="pt-col">
                <a <?php if( !( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) ) { ?><?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID] != '' ) { ?>href="<?php echo esc_url($ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID]); ?>"<?php } ?> <?php } ?>class="pt-block<?php echo ( $ptPlansFeaturesMeta['PlanHighlight'][$planID] ) ? ' pt-selected' : ( ( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) ? ' pt-not-available' : '' ); ?>">
                    <?php if( $planName != '' ) { ?>
                        <span class="pt-head">
                            <?php if( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] || $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] || $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ) { ?>
                                <span class="pt-badge<?php echo ( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] ) ? ' pt-discount' : ( $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] ? ' pt-popular' : '' ); ?>">
                                    <?php echo ( $ptPlansFeaturesMeta['PlanShowDiscountSign'][$planID] ) ? $ptPlansFeaturesMeta['PlanDiscountSignText'][$planID] : ( $ptPlansFeaturesMeta['PlanShowMostPopularSign'][$planID] ? $ptPlansFeaturesMeta['PlanMostPopularSignText'][$planID] : ( $ptPlansFeaturesMeta['PlanShowNotAvailableSign'][$planID] ? $ptPlansFeaturesMeta['PlanNotAvailableSignText'][$planID] : '' ) ); ?>
                                </span>
                            <?php } ?>
                            <span class="pt-title"><?php echo $planName; ?></span>
                            <?php if( $showPlanCaptionBlock ) { ?>
                                <span class="pt-sub-title"><?php echo ( $ptPlansFeaturesMeta['PlanShowCaption'][$planID] && $ptPlansFeaturesMeta['PlanCaptionText'][$planID] != '' ) ? $ptPlansFeaturesMeta['PlanCaptionText'][$planID] : '&nbsp;'; ?></span>
                            <?php } ?>
                        </span>
                    <?php } ?>
                    <?php if( $ptPlansFeaturesMeta['PlanPrice'][$planID] != '' ) { ?>
                        <span class="pt-price-container">
                            <span class="pt-price-block">
                                <?php include(dirname(__FILE__).'/parts/complexPrice.php'); ?>
                            </span>
                            <?php if( $showPriceCaptionBlock ) { ?>
                                <span class="pt-sub-text"><?php echo ( $ptPlansFeaturesMeta['PlanShowPriceCaption'][$planID] && $ptPlansFeaturesMeta['PlanPriceCaptionText'][$planID] != '' ) ? $ptPlansFeaturesMeta['PlanPriceCaptionText'][$planID] : '&nbsp;'; ?></span>
                            <?php } ?>
                        </span>
                    <?php } ?>
                    <span class="pt-list-container">
                        <span class="pt-list">
                            <?php foreach( $ptPlansFeaturesMeta['FeatureName'] as $featureID => $featureName ) { ?>
                                <span class="pt-list-item"><?php echo $featureName; ?> <?php include(dirname(__FILE__).'/parts/tooltipValue.php'); ?></span>
                            <?php } ?>
                        </span>
                        <?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>
                            <span class="pt-text"><?php echo $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID]; ?></span>
                        <?php } ?>
                    </span>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
<?php if(!defined('ABSPATH')) die(); ?>
<div class="<?php echo implode( ' ', $baseCSSClassList ); ?>">
    <div class="pt-cols pt-cols-<?php echo count($ptPlansFeaturesMeta['PlanName']); ?>">
        <?php
            $showPlanCaptionBlock = count( array_intersect_key( array_filter( $ptPlansFeaturesMeta['PlanShowCaption'], 'strlen' ), array_filter( $ptPlansFeaturesMeta['PlanCaptionText'], 'strlen' ) ) );
        ?>
        <?php foreach( $ptPlansFeaturesMeta['PlanName'] as $planID => $planName ) { ?>
            <div class="pt-col">
                <div class="pt-block<?php echo ( $ptPlansFeaturesMeta['PlanHighlight'][$planID] ) ? ' pt-selected' : ( ( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] ) ? ' pt-not-available' : '' ); ?>">
                    <div class="pt-back"></div>
                    <div class="pt-head">
                        <?php if( !empty( $ptPlansFeaturesMeta['PlanImageURL'][$planID] ) ) { ?>
                            <div class="pt-image">
                                <img src="<?php echo esc_url($ptPlansFeaturesMeta['PlanImageURL'][$planID]); ?>" alt="">
                            </div>
                        <?php } ?>
                    </div>
                    <div class="pt-content">
                        <?php if( $planName != '' ) { ?>
                            <div class="pt-title"><?php echo $planName; ?></div>
                        <?php } ?>
                        <?php if( $showPlanCaptionBlock ) { ?>
                            <div class="pt-sub-text-fixed">
                                <div class="pt-sub-text"><?php echo ( $ptPlansFeaturesMeta['PlanShowCaption'][$planID] && $ptPlansFeaturesMeta['PlanCaptionText'][$planID] != '' ) ? $ptPlansFeaturesMeta['PlanCaptionText'][$planID] : '&nbsp;'; ?></div>
                            </div>
                        <?php } ?>
                        <ul class="pt-list">
                            <?php foreach( $ptPlansFeaturesMeta['FeatureName'] as $featureID => $featureName ) { ?>
                                <li>
                                    <span class="pt-list-text"><?php include(dirname(__FILE__).'/parts/tooltipValue.php'); ?></span>
                                    <span class="pt-list-sub-text"><?php echo $ptPlansFeaturesMeta['FeatureValueCurrencySymbol'][$planID][$featureID]; ?><?php echo $ptPlansFeaturesMeta['FeatureValuePrice'][$planID][$featureID]; ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                        <?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>
                            <a <?php if( !$ptPlansFeaturesMeta['PlanMakeInactive'][$planID] ) { ?>href="<?php echo esc_url($ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID]); ?>" <?php } ?>class="pt-btn"><?php echo $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID]; ?></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
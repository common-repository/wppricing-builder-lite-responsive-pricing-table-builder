<?php if(!defined('ABSPATH')) die(); ?>
<div class="<?php echo implode( ' ', $baseCSSClassList ); ?>">
    <div class="pt-cols pt-cols-<?php echo count($ptPlansFeaturesMeta['PlanName']); ?>">
        <?php foreach( $ptPlansFeaturesMeta['PlanName'] as $planID => $planName ) { ?>
            <div class="pt-col">
                <div class="pt-block<?php echo ( $ptPlansFeaturesMeta['PlanHighlight'][$planID] ) ? ' pt-selected' : ( ( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] ) ? ' pt-not-available' : '' ); ?>">
                    <div class="pt-back"></div>
                    <?php if( $planName != '' ) { ?>
                        <div class="pt-title"><?php echo $planName; ?></div>
                    <?php } ?>
                    <ul class="pt-list">
                        <?php foreach( $ptPlansFeaturesMeta['FeatureName'] as $featureID => $featureName ) { ?>
                            <li>
                                <?php include(dirname(__FILE__).'/parts/tooltipValue.php'); ?>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php if( $ptPlansFeaturesMeta['PlanPrice'][$planID] != '' ) { ?>
                        <div class="pt-price">
                            <?php echo $ptPlansFeaturesMeta['PlanCurrencySymbol'][$planID]; ?><?php echo $ptPlansFeaturesMeta['PlanPrice'][$planID]; ?>
                        </div>
                    <?php } ?>
                    <?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>
                        <a <?php if( !$ptPlansFeaturesMeta['PlanMakeInactive'][$planID] ) { ?>href="<?php echo esc_url($ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID]); ?>" <?php } ?>class="pt-btn"><?php echo $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID]; ?></a>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
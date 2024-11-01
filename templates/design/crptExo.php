<?php if(!defined('ABSPATH')) die(); ?>
<?php
    if( count( array_filter( $ptPlansFeaturesMeta['PlanPurchaseButtonName'], 'strlen' ) ) == 0 ) {
        $baseCSSClassList[] = 'pt-no-footer';
    }
?>
<div class="<?php echo implode( ' ', $baseCSSClassList ); ?>">
    <div class="pt-cols pt-cols-<?php echo count($ptPlansFeaturesMeta['PlanName']); ?>">
        <div class="pt-cols-side">
            <div class="pt-list-block">
                <?php foreach( $ptPlansFeaturesMeta['FeatureName'] as $featureID => $featureName ) { ?>
                    <div class="pt-list-item">
                        <?php
                            include(dirname(__FILE__).'/parts/rowHeight.php');
                            echo $rowHeightPrependHTML;
                            include(dirname(__FILE__).'/parts/tooltipFeature.php');
                            echo $rowHeightAppendHTML;
                        ?>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div class="pt-cols-main">
            <?php foreach( $ptPlansFeaturesMeta['PlanName'] as $planID => $planName ) { ?>
                <div class="pt-col">
                    <div class="pt-block<?php echo ( $ptPlansFeaturesMeta['PlanHighlight'][$planID] ) ? ' pt-selected' : ( ( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] ) ? ' pt-not-available' : '' ); ?>">
                        <div class="pt-content">
                            <?php
                                $showPriceCaptionBlock = ( $ptPlansFeaturesMeta['PlanShowPriceCaption'][$planID] && $ptPlansFeaturesMeta['PlanPriceCaptionText'][$planID] != '' );
                                $showPriceBlock = ( $ptPlansFeaturesMeta['PlanPrice'][$planID] != '' || $ptPlansFeaturesMeta['PlanCurrencySymbol'][$planID] != '' );
                            ?>
                            <?php if( $planName != '' || $showPriceBlock || $showPriceCaptionBlock || $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>
                                <a <?php if( $ptPlansFeaturesMeta['PlanMakeInactive'][$planID] ) { ?>disabled="disabled" <?php } else { ?><?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID] != '' || $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>href="<?php echo esc_url($ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID]); ?>"<?php } ?> <?php } ?>class="pt-header">
                                    <?php if( $planName != '' ) { ?>
                                        <span class="pt-title"><?php echo $planName; ?></span>
                                    <?php } ?>
                                    <?php if( $showPriceBlock || $showPriceCaptionBlock ) { ?>
                                        <span class="pt-price-container<?php echo $showPriceCaptionBlock ? ' pt-has-sub' : ''; ?>">
                                            <?php if( $showPriceCaptionBlock ) { ?>
                                                <span class="pt-sub"><?php echo $ptPlansFeaturesMeta['PlanPriceCaptionText'][$planID]; ?></span>
                                            <?php } ?>
                                            <?php if( $showPriceBlock ) { ?>
                                                <span class="pt-price-block">
                                                    <span class="pt-currency"><?php echo $ptPlansFeaturesMeta['PlanCurrencySymbol'][$planID]; ?></span>
                                                    <span class="pt-price-main"><?php echo $ptPlansFeaturesMeta['PlanPrice'][$planID]; ?></span>
                                                </span>
                                            <?php } ?>
                                        </span>
                                    <?php } ?>
                                    <?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>
                                        <span class="pt-btn-text"><?php echo $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID]; ?></span>
                                    <?php } ?>
                                    <span class="pt-back"></span>
                                </a>
                            <?php } ?>
                            <div class="pt-list">
                                <?php foreach( $ptPlansFeaturesMeta['FeatureName'] as $featureID => $featureName ) { ?>
                                    <div class="pt-list-item">
                                        <div class="pt-text">
                                            <?php include(dirname(__FILE__).'/parts/tooltipFeature.php'); ?>
                                        </div>
                                        <div class="pt-value">
                                            <?php
                                                include(dirname(__FILE__).'/parts/rowHeight.php');
                                                echo $rowHeightPrependHTML;
                                                include(dirname(__FILE__).'/parts/tooltipValue.php');
                                                echo $rowHeightAppendHTML;
                                            ?>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="pt-footer">
                                <?php if( $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID] != '' ) { ?>
                                    <a <?php if( !$ptPlansFeaturesMeta['PlanMakeInactive'][$planID] ) { ?>href="<?php echo esc_url($ptPlansFeaturesMeta['PlanPurchaseButtonLink'][$planID]); ?>" <?php } ?>class="pt-btn"><span><?php echo $ptPlansFeaturesMeta['PlanPurchaseButtonName'][$planID]; ?></span></a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
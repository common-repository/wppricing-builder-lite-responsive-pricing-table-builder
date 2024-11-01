<?php if(!defined('ABSPATH')) die(); ?>
<div class="wbrpt-design-attribute">
    <?php if( $post->post_status == 'draft' || $post->post_status == 'auto-draft' ) { ?>
        <label for="wbrpt-design-selector"><?php echo __('Design'); ?>:</label>
        <select id="wbrpt-design-selector" name="wbrptDesign" autocomplete="off">
            <?php foreach( $wbrptGeneralSettings[ 'designGroupList' ] as $designGroup ) { ?>
                <optgroup label="<?php echo $designGroup['name']; ?>">
                    <?php foreach( $designGroup[ 'designList' ] as $designID ) { ?>
                        <option <?php if( $value[ 'design' ] == $designID ) echo 'selected '; ?>value="<?php echo $designID; ?>"<?php if( isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'previewURL' ] ) ) echo ' data-preview-url="' . $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'previewURL' ] . '#current-design-settings"'; ?>><?php echo $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'name' ]; ?><?php if( isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'previewURL' ] ) ) echo ' ' . __('(in full version)'); ?></option>
                    <?php } ?>
                </optgroup>
            <?php } ?>
        </select>
        <a id="wbrpt-load-demo-data" class="button"><?php echo __('Load Demo Data'); ?></a>
        <div class="wbrpt-design-preview"><?php foreach( $wbrptGeneralSettings[ 'designGroupList' ] as $designGroup ) { ?><?php foreach( $designGroup[ 'designList' ] as $designID ) { ?><input type="radio" id="<?php echo "wbrpt-design-preview-$designID"; ?>" name="wbrptDesignPreview" value="<?php echo $designID; ?>"<?php if( $value[ 'design' ] == $designID ) echo ' checked'; ?><?php if( !isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'controlList' ] ) ) echo ' class="disabled"'; ?> autocomplete="off"><<?php if( isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'previewURL' ] ) ) { ?>a href="<?php echo esc_url( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'previewURL' ] . '#current-design-settings"' ); ?>" target="_blank"<?php } else { ?>label for="<?php echo "wbrpt-design-preview-$designID"; ?>"<?php } ?> class="item" title="<?php echo esc_attr( $designGroup['name'] . ': ' . $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'name' ] ); ?>"><img src="<?php echo( plugins_url( "/assets/admin/images/design-preview/$designID.png", $pluginFile )); ?>"></<?php echo isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'previewURL' ] ) ? 'a' : 'label'; ?>><?php } ?><?php } ?></div>
    <?php } else { ?>
        <label><?php echo __( 'Design can only be changed in <a id="wbrpt-post-status" href="#">draft mode</a>.', 'my-text-domain' ); ?></label>
        <input id="wbrpt-design-selector" type="hidden" name="wbrptDesign" value="<?php echo $value[ 'design' ]; ?>">
    <?php } ?>
    <a id="wbrpt-preview-changes" class="button hidden"><?php echo __('Preview Changes'); ?></a>
</div>
<div class="wbrpt-animation-attribute">
    <label for="wbrpt-animation-selector"><?php echo __('Animation type'); ?>:</label>
    <select id="wbrpt-animation-selector" name="wbrptAnimation">
        <option <?php if( $value[ 'animation' ] == 0 ) echo 'selected '; ?>value="0"><?php echo __('Default'); ?></option>
        <option <?php if( $value[ 'animation' ] == 1 ) echo 'selected '; ?>value="1"><?php echo __('Style 1'); ?></option>
        <option <?php if( $value[ 'animation' ] == 2 ) echo 'selected '; ?>value="2"><?php echo __('Style 2'); ?></option>
        <option <?php if( $value[ 'animation' ] == -1 ) echo 'selected '; ?>value="-1"><?php echo __('None'); ?></option>
    </select>
</div>
<div class="wbrpt-color-attribute">
    <label><?php echo __('Color theme'); ?>:</label>
    <div class="wbrpt-color-picker" id="wbrpt-color-selector">
        <?php include( 'parts/colorList.php' ); ?>
    </div>
</div>
<div class="wbrpt-custom-color-attribute hidden">
    <div id="wbrpt-custom-color-variable-list" class="wbrpt-color-variable-list">
        <?php include( 'parts/colorVariableList.php' ); ?>
    </div>
    <div>
        <a id="wbrpt-custom-color-generate" class="button" title="<?php echo __('Generate New Color'); ?>"><?php echo __('Generate New'); ?></a>
        <a id="wbrpt-custom-color-remove" class="button" title="<?php echo __('Remove Selected Color'); ?>"><?php echo __('Remove Selected'); ?></a>
        <a id="wbrpt-custom-color-preview" class="button" title="<?php echo __('Preview Color'); ?>"><?php echo __('Preview'); ?></a>
        <a id="wbrpt-custom-color-load-all" class="button" title="<?php echo __('Load All Default Colors'); ?>"><?php echo __('Load All Colors'); ?></a> 
        <a id="wbrpt-custom-color-cancel" class="button" title="<?php echo __('Hide Color Settings'); ?>"><?php echo __('Hide Settings'); ?></a>
    </div>
    <input id="wbrpt-custom-color-variable-data" type="hidden" name="wbrptColorVariableList" value="">
    <hr>
</div>
<div class="wbrpt-custom-styles-attribute">
    <div id="wbrpt-custom-styles-block" class="hidden">
        <label for="wbrpt-custom-styles-content"><?php echo __('Custom Styles'); ?> (<a class="wbrpt-full-version-banner" href="<?php echo esc_url( $wbrptGeneralSettings[ 'fullVersion' ][ 'livepreviewLink' ] ); ?>" target="_blank"><?php echo __('in full version'); ?></a>):</label>
        <textarea class="full-width" id="wbrpt-custom-styles-content" rows="10" disabled>/* styles example
.crpt-exo .pt-title {
    font-size: 13px;
}
*/</textarea>
    </div>
    <a id="wbrpt-custom-styles-show" class="button"><?php echo __('Custom Styles'); ?></a>
    <a id="wbrpt-custom-styles-hide" class="button hidden"><?php echo __('Hide Custom Styles'); ?></a>
</div>
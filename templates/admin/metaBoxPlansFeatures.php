<?php if(!defined('ABSPATH')) die(); ?>
<div class="wbrpt-editor-scroll-bar">
    <?php $activeInstance = 1; ?>
    <div class="wbrpt-editor-attribute">
        <a id="wbrpt-editor-instance-add" class="button<?php echo ( isset( $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'navigationItemNumber' ] ) && $wbrptGeneralSettings[ 'designList' ][ $designID ][ 'navigationItemNumber' ] > count( $value ) ) ? '' : ' hidden'; ?>"><?php echo __('Add Version'); ?></a>
        <a id="wbrpt-editor-instance-remove" class="button hidden"><?php echo __('Remove Version'); ?></a>
        <select id="wbrpt-editor-instance-selector" class="hidden" name="wbrptActiveInstance"></select>
    </div>
    <div class="wbrpt-editor">
        <?php include( 'parts/plansFeaturesEditor.php' ); ?>
    </div>
    <input id="wbrpt-editor-instance-active" type="hidden" value="<?php echo $activeInstance; ?>">
    <div id="wbrpt-editor-column-color-box" class="wbrpt-editor-color-box hidden">
        <div class="wbrpt-color-picker">
            <?php include( 'parts/columnColorList.php' ); ?>
        </div>
    </div>
</div>
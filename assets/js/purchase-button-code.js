jQuery( document ).ready(function() {
    jQuery( "a[href^='#wbrpt-purchase-button-']" ).click( function( event ) {
        event.preventDefault();
        var purchaseButtonBlockID = jQuery( this ).attr( 'href' );
        var purchaseButtonBlockTargetEl = false;
        purchaseButtonBlockTargetEl = jQuery( purchaseButtonBlockID + ' [type=submit], ' + purchaseButtonBlockID + ' [type=image]' );
        if( purchaseButtonBlockTargetEl.length ) {
            purchaseButtonBlockTargetEl.first().trigger( 'click' );
            return;
        }
        purchaseButtonBlockTargetEl = jQuery( purchaseButtonBlockID + ' form' );
        if( purchaseButtonBlockTargetEl.length ) {
            purchaseButtonBlockTargetEl.first()[0].submit();
            return;
        }
        purchaseButtonBlockTargetEl = jQuery( purchaseButtonBlockID + ' a' );
        if( purchaseButtonBlockTargetEl.length ) {
            purchaseButtonBlockTargetEl.first()[0].click();
            return;
        }
    });
});
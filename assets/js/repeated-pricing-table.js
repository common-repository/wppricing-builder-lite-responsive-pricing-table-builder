jQuery( document ).ready(function() {
    var pricingTableIDList = {};
    jQuery.each( jQuery( '[data-wbrpt-id]' ), function( index, item ) {
        var pricingTableID = jQuery( item ).data( 'wbrptId' );
        pricingTableIDList[ pricingTableID ] = ( pricingTableIDList[ pricingTableID ] !== undefined ) ? ( pricingTableIDList[ pricingTableID ] + 1 ) : 1;
        var number = pricingTableIDList[ pricingTableID ];
        if( number <= 1 ) return true;
        jQuery.each( jQuery( item ).find( 'input[name=wbrpt' + pricingTableID + 'Instance]' ), function( subIndex, subItem ) {
            jQuery( this ).attr( 'id', jQuery( this ).attr( 'id' ) + '-' + number );
        });
        jQuery.each( jQuery( item ).find( 'label[for^=wbrpt-' + pricingTableID + '-instance]' ), function( subIndex, subItem ) {
            jQuery( this ).attr( 'for', jQuery( this ).attr( 'for' ) + '-' + number );
        });
    });
});
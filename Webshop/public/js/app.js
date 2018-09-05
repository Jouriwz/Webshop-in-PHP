$( document ).ready( function() {
	bucket();
} );

function bucket() {
    $( '.add-to-cart, .remove-from-cart' ).unbind( 'click' ).click( function( event ) {
        event.preventDefault();

        // alert( $( this ).data( 'url' ));

        jQuery.ajax( $( this ).data( 'url' ), {
            method: 'post',
            cache: false,
            // dataType: 'json',
        } ).done( function( data ) {
            if( data ) {
                $( '#bucket' ).html( data );
                bucket();
            }
        } ).fail( function() {
            alert( 'error' );
            bucket();
        } );
    } );
}

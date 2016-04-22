/**
 * This file adds some LIVE to the Theme Customizer live preview. To leverage
 * this, set your custom settings to 'postMessage' and then add your handling
 * here. Your javascript should grab settings from customizer controls, and
 * then make any necessary changes to the page using jQuery.
 */
( function( $ ) {

	wp.customize( 'estella_mod[theme_font]', function( value ) {
	    value.bind( function( newval ) {

	        switch( newval.toString().toLowerCase() ) {

	            case 'open-sans':
	                sFont = 'Open Sans';
	                break;

	            case 'pt-sans':
	                sFont = 'PT Sans';
	                break;

	            case 'oxygen':
	                sFont = 'Oxygen';
	                break;

	            case 'lato':
	                sFont = 'Lato';
	                break;

	            default:
	                sFont = 'Open Sans';
	                break;

	        }

	        $( 'body' ).css({
	            fontFamily: sFont
	        });

	    });

	});

	// Update the site title in real time...
	wp.customize( 'blogname', function( value ) {
		value.bind( function( newval ) {
			$( '.site-title a' ).html( newval );
		} );
	} );

	//Update the site description in real time...
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( newval ) {
			$( '.site-description' ).html( newval );
		} );
	} );


} )( jQuery );

// As you can see from the example above, a single basic handler looks like this:


wp.customize( 'YOUR_SETTING_ID', function( value ) {
	value.bind( function( newval ) {
		//Do stuff (newval variable contains your "new" setting data)
	} );
} );

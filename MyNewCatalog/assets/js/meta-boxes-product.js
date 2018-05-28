

/*Мета бокс доп для цены*/

jQuery( function( $ ) {

	
	$( function() {
		$( '[id$="-all"] > ul.categorychecklist' ).each( function() {
			var $list = $( this );
			var $firstChecked = $list.find( ':checked' ).first();

			if ( ! $firstChecked.length ) {
				return;
			}

			var pos_first   = $list.find( 'input' ).position().top;
			var pos_checked = $firstChecked.position().top;

			$list.closest( '.tabs-panel' ).scrollTop( pos_checked - pos_first + 5 );
		});
	});

	// Prevent enter submitting post form.
	$( '#upsell_product_data' ).bind( 'keypress', function( e ) {
		if ( e.keyCode === 13 ) {
			return false;
		}
	});

	// Тип бокса
	$( '.type_box' ).appendTo( '#product-data .hndle span' );

	$( function() {
		// открыть закртыь мета бокс
		$( '#product-data' ).find( '.hndle' ).unbind( 'click.postboxes' );

		$( '#product-data' ).on( 'click', '.hndle', function( event ) {

			
			if ( $( event.target ).filter( 'input, option, label, select' ).length ) {
				return;
			}

			$( '#product-data' ).toggleClass( 'closed' );
		});
	});

	


	// Установить цену
	$( '.price_dates_fields' ).each( function() {
		var $these_sale_dates = $( this );
		var sale_schedule_set = false;
		var $wrap = $these_sale_dates.closest( 'div, table' );

		$these_sale_dates.find( 'input' ).each( function() {
			if ( '' !== $( this ).val() ) {
				sale_schedule_set = true;
			}
		});

		if ( sale_schedule_set ) {
			$wrap.find( '.sale_schedule' ).hide();
			$wrap.find( '.sale_price_dates_fields' ).show();
		} else {
			$wrap.find( '.sale_schedule' ).show();
			$wrap.find( '.sale_price_dates_fields' ).hide();
		}
	});

	$( '#product-data' ).on( 'click', '.sale_schedule', function() {
		var $wrap = $( this ).closest( 'div, table' );

		$( this ).hide();
		$wrap.find( '.cancel_sale_schedule' ).show();
		$wrap.find( '.sale_price_dates_fields' ).show();

		return false;
	});
	$( '#product-data' ).on( 'click', '.cancel_sale_schedule', function() {
		var $wrap = $( this ).closest( 'div, table' );

		$( this ).hide();
		$wrap.find( '.sale_schedule' ).show();
		$wrap.find( '.sale_price_dates_fields' ).hide();
		$wrap.find( '.sale_price_dates_fields' ).find( 'input' ).val('');

		return false;
	});

	

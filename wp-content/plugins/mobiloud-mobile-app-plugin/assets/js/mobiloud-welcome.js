var ml_class_ok     = 'button button-hero button-primary';
var ml_class_cancel = 'button button-hero button-primary button-grey';

function ml_alert(message, icon) {
	if ( ! icon) {
		icon = '';
	}
	swal(
		{
			title: message,
			icon: icon,
			buttons: {
				ok: {
					className: ml_class_ok
				},
			}
		}
	);
}

jQuery( document ).ready(
	function ($) {
		$.validator.addMethod(
			'subscription_id',
			function (value) {
				return /^cus.+$/.test( value );
			},
			'Please enter a valid Subscription ID'
		);


		// New First step
		if ($( '.welcome-step-0' ).length) {
			var ladda = Ladda.create( document.querySelector( '.ladda-button' ) );
			$( '.contact-form' ).submit(
				function (e) {
					e.preventDefault();
					if ($( '#submit' ).prop( 'disabled' )) {
						return;
					}
					if ($( this ).valid()) {
						var data = {
							action: "ml_welcome_first",
							code: jQuery( '#ml_first_code' ).val(),
							ml_nonce: jQuery( '#ml_nonce' ).val(),
						};
						$( '#submit' ).prop( 'disabled', true );
						ladda.start();
						jQuery.ajax({
							url: ajaxurl,
							data: data,
							method: 'post',
							success: function (response) {
								if (response && response.success && response.data && response.data.url ) {
									window.location = response.data.url;
								} else if (response && response.success && response.data && response.data.message ) {
									ladda.stop();
									$( '#submit' ).removeProp( 'disabled' )
									swal({
										text: response.data.message,
										buttons: {
											ok: {
												text: 'Ok',
												className: ml_class_ok,
											},
										}
									});
								} else {
									ladda.stop();
									$( '#submit' ).removeProp( 'disabled' )
									ml_alert( 'Error. Please try again later.', 'error' );
								}
							},
							error: function (response) {
								ladda.stop();
								$( '#submit' ).removeProp( 'disabled' )
								ml_alert( 'Error. Please try again later.', 'error' );
							}
						});
						return true;
					};
				}
			);

		}
		// First step
		if ($( '#ml-initial-details' ).length) {
			// Form Validation
			$( '.contact-form' ).validate(
				{
					rules: {
						website: {
							url: true
						},
						message: {
							maxlength: 100
						}
					},
					messages: {
						name: {
							required: 'Please enter your name'
						},
						email: {
							required: 'Please enter your email'
						},
						website: {
							required: 'Please enter your website\'s address'
						},
						company_name: {
							required: 'Please enter your company or site name'
						},
						phone: {
							required: 'Please enter your phone'
						}
					},
					errorPlacement: function (error, element) {
						var elParent = element.parent();
						if (elParent.hasClass( 'checkbox_lbl' )) {
							elParent.append( error );
						} else {
							error.insertAfter( element );
						}
					}
				}
			);

			var ladda = Ladda.create( document.querySelector( '.ladda-button' ) );

			$( '.contact-form' ).submit(
				function (e) {
					e.preventDefault();
					if ($( '#submit' ).prop( 'disabled' )) {
						return;
					}
					if ($( this ).valid()) {
						var ml_name       = jQuery( "#pname" ).val();
						var ml_email      = jQuery( "#pemail" ).val();
						var ml_site       = jQuery( "#psite" ).val();
						var ml_company    = jQuery( "#pcompany_name" ).val();
						var ml_phone      = jQuery( "#pphone" ).val();
						var ml_message    = jQuery( "#pmessage" ).val();
						var ml_sitetype    = jQuery( 'input[name="type"]:checked' ).val();
						var ml_pricing    = jQuery( '#pricing' ).is( ':checked' ) ? 1 : 0;
						var ml_plan       = jQuery( '#plan' ).val();
						var ml_accept     = jQuery( '#accept' ).is( ':checked' ) ? 1 : 0;
						var ml_newsletter = jQuery( '#newsletter' ).is( ':checked' ) ? 1 : 0;

						if (ml_name.length <= 0 || ml_email.length <= 0 || ml_site.length <= 0 || ml_company.length <= 0 || ml_phone.length <= 0 || ! ml_accept) {
							ml_alert( 'Please complete all details' );
							return false;
						} else {
							var data = {
								action: "ml_welcome",
								ml_name: ml_name,
								ml_email: ml_email,
								ml_site: ml_site,
								ml_sitetype: ml_sitetype,
								ml_company: ml_company,
								ml_phone: ml_phone,
								ml_message: ml_message,
								ml_plan: ml_plan,
								ml_pricing: ml_pricing,
								ml_newsletter: ml_newsletter,
								ml_agree: ml_accept,
								ml_intercom: (typeof(window.intercomSettings) != 'undefined' ? 1 : 0),
								ml_nonce: jQuery( '#ml_nonce' ).val(),
							};
							$( '#submit' ).prop( 'disabled', true );
							ladda.start();
							jQuery.post(
								ajaxurl,
								data,
								function (response) {
									if (response && response.success && response.data && response.data.url ) {
										window.location = response.data.url;
									} else {
										ladda.stop();
										$( '#submit' ).removeProp( 'disabled' )
										ml_alert( 'Error. Please try again later.', 'error' );
									}
								}
							);
						}
						return true;
					};
				}
			);
		}
		// Second step
		if ($( '.welcome-step-2' ).length) {
			var allow_submit = false;
			$( '.contact-form' ).submit(
				function (e) {
					var choice = $('input[name="ml_sitetype"]:checked').val();
					if ( ! allow_submit && 'content' !== choice ) {
						e.preventDefault();
						allow_submit = true;
						swal({
							text: 'Our Canvas platform would be a better fit for your app. Request a demo to learn all about Canvas and talk to one of our experts.',
							buttons: {
								ok: {
									text: 'Request a demo',
									className: ml_class_ok,
								},
								no: {
									text: 'Cancel',
									className: ml_class_cancel,
								},
							},
						}).then((value) => {
							if ( 'ok' === value ) {
								var cat = $('input[name="ml_sitetype"]:checked').parent().find('label').text();
								window.open( $( '.contact-form' ).data('url').replace('_cat_', encodeURIComponent(cat)), '_blank' );
							} else {
								$( '#submit' ).trigger('click');
							}
						});
					}
			} )
		}

		// Welcome question
		if ($( 'div#ml_question' ).length) {
			$( '.welcome_question_demo' ).on(
				'click',
				function() {
					swal(
						{
							title: '',
							text: $( this ).data( 'text' ),
							buttons: {
								cancel2: {
									text: "Cancel",
									value: "cancel",
									className: ml_class_cancel,
								},
								yes: {
									text: "Yes",
									value: "yes",
									className: ml_class_ok,
								},
							},
						}
					)
					.then(
						(value) => {
							if ('yes' == value) {
								window.location = $( '.welcome_question_demo' ).first().data( 'href' );
							}
						}
					);
					return false;
				}
			)
		}

		// Step 3.
		$( '.welcome_question_start' ).on(
			'click',
			function() {
				window.location = $( this ).data( 'href' );
				return false;
			}
		)

		// Step 4.
		// show all categories, order by category name and push by columns.
		$( '.cat-load-more' ).on( 'click', function() {
			$( '.categories-choice .hidden-cat' ).removeClass('hidden-cat');
			var $cats = $( '.categories-choice .ml-choice-cat' ).toArray();
			var mapped = $cats.map(function(el, i) {
				return { index: i, value: $(el).data('name').toLowerCase() };
			});
			mapped.sort(function(a, b) {
				if (a.value > b.value) {
					return 1; }
				if (a.value < b.value) {
					return -1; }
				return 0;
			});
			var data = mapped.map(function(el) {
				return $cats[el.index];
			});
			// split to 4 columns.
			var columns_count = 4;
			if ( data.length ) {
				var count = Math.ceil( data.length / columns_count );
				for (var i = 0; i < columns_count; i++) {
					var current_items = data.splice(0, count);
					current_items.map(function(item) {
						$('#column_'+i).append(
							$(item).detach()
						);
					})
				}
			}

			$( this ).closest('.outer').remove();
			return false;
		} )

	}
);

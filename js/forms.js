if($("#delivery-charge-form").length>0) {
			$("#delivery-charge-form").validate({
				submitHandler: function(form) {
					$.ajax({
						type: "POST",
						url: "fetch.php",
						data: {
							"cmd": "da",
							"option": $("#delivery_options").val(),
							"amount": $("#delivery_price").val(),
							"cod": $("#cod").prop("checked")
						
						},
						success: function (data) { 
						   $('#delivery_options').val('');
						  $('#delivery_price').val('');
						 $('#cod').attr('checked', false);
							$('.output').html(data);   
						}
					});
					

				},					
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					delivery_options: {
						required: true,
						minlength: 4
					},
					delivery_price: {
						required: true,
						minlength: 1
					}
			
				
				},
				messages: {
					delivery_options: {
						required: "Delivery Info Required",
						minlength: "At least 1 chars required"
					},
					delivery_price: {
						required: "Enter Amount",
						minlength: "At least 2 chars required"
					}
										
				},
				errorElement: "span",
				highlight: function (element) {
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};

if($("#checkout-form").length>0) {
			$("#checkout-form").validate({
				submitHandler: function(form) {
					return true; exit;
					
				},				
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					fname: {
						required: true,
						minlength: 2
					},
					lname: {
						required: true,
						minlength: 2
					},
					email: {
						required: true,
						email: true
					},
					address1: {
						required: true
					},
					city: {
						required: true,
					},
					
					postcode: {
						required: true
					}
			
				
				},
				messages: {
					fname: {
						required: "First Name required",
						minlength: "At least 2 chars required"
					},
					lname: {
						required: "Last Name required",
						minlength: "At least 2 chars required"
					},
					email: {
						required: "Email required",
						email: "Email not valid"
					},
					address1: {
						required: "Please enter Address"
					},
					city: {
						required: "City Required"
					},
					
					postcode: {
						required: "Postcode/Zip required",
						minlength: "Too short"
					},
					delivery: {
						required: "Select delivery"
					}
										
				},
				errorElement: "span",
				highlight: function (element) {
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};

if($("#add-new-form").length>0) {
			$("#add-new-form").validate({
				submitHandler: function(form) {
					return true; exit;
					
				},				
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					catselect: {
						required: true,
					
					},
					pname: {
						required: true,
						minlength: 2
					},
					price: {
						required: true,
						number: true
					}
			
				
				},
				messages: {
					catselect: {
						required: "Select Category",
						minlength: "At least 2 chars required"
					},
					pname: {
						required: "Enter Product Name",
						minlength: "At least 2 chars required"
					},
					price: {
						required: "Enter Price",
						number: "Price in decimals"
					}					
				},
				errorElement: "span",
				highlight: function (element) {
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};

if($("#contact-us-form").length>0) {
			$("#contact-us-form").validate({
				submitHandler: function(form) {
		return true; exit;
					
				},				
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					name: {
						required: true,
						minlength: 3
					
					},
					email: {
						required: true,
						email: true
					},
					subject: {
						required: true,
						minlength: 4
					},
					msg: {
						required: true,
						minlength: 10
					}
			
				
				},
				messages: {
					name: {
						required: "Enter your name",
						minlength: "At least 2 chars required"
					},
					email: {
						required: "Enter your email",
						minlength: "At least 2 chars required"
					},
					subject: {
						required: "Enter Subject",
						minlength: "Less character entered"
					},
					msg: {
						required: "Enter your message",
						minlength: "Less character entered"
					}					
				},
				errorElement: "span",
				highlight: function (element) {
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};

if($("#send-friend").length>0) { 
			$("#send-friend").validate({ 
				submitHandler: function(form) {
					var submitButton = $('#sendit span');
					     submitButton.text('Sending..').button("refresh");
					$.ajax({
						type: "POST",
						url: "../../send2friend.php",
						data: {
							"yn": $("#yname").val(),
							"ye": $("#yemail").val(),
							"fn": $("#fname").val(),
							"fe": $("#femail").val(),
							"tn": $("#tname").val(),
							"url": $("#url").val(),
							"title": $("#title").val(),
							"img": $("#img").val()						
						},
						success: function (data) { 
						        $('#fname').val(''); 
							 $('#femail').val('');
							$("span#msg").show("slow").delay(6000).fadeOut("slow");
							if(data=='err') alert('Problem sending your message')
						},
						complete: function () {
						      submitButton.text('Send').button("refresh");
						}
					});
					

				},				
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					yname: {
						required: true,
						minlength: 4
					
					},
					yemail: {
						required: true,
						email: true
					},
					fname: {
						required: true,
						minlength: 4
					},
					femail: {
						required: true,
						email: true
					}
			
				
				},
				messages: {
					yname: {
						required: "Enter your name",
						minlength: "At least 2 chars required"
					},
					yemail: {
						required: "Enter your email",
						minlength: "At least 2 chars required"
					},
					fname: {
						required: "Enter friend name",
						minlength: "Less character entered"
					},
					femail: {
						required: "Enter friend email",
						minlength: "At least 2 chars required"
					}					
				},
				errorElement: "span",
				highlight: function (element) { 
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};
		
if($("#update-account-form").length>0) { 
			$("#update-account-form").validate({
			submitHandler: function(form) {
					$.ajax({
						type: "POST",
						url: "fetch.php",
						data: {
							"cmd": "ua",
							"op": $("#opasswd").val(),
							"np": $("#npasswd").val()
						
						},
						success: function (data) { 
						 $('#update-account-form').trigger("reset");
						 alert(data)
							
						}
					});
					

				},				
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					opasswd: {
						required: true,
						 minlength: 5
					
					},
					npasswd: {
						required: true,
					     minlength: 5
						
					},
					cpasswd: {
                                   required: true,
					minlength: 5,
					equalTo: "#npasswd"
                                    }
			
				
				},
				messages: {
				opasswd: {
					required: "Enter current password",
					minlength: "Your password must be at least 5 characters long"
				},
				npasswd: {
					required: "Enter new password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				cpasswd: {
					required: "Confirm your password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Password does not match"
				}
			},
				   
				errorElement: "span",
				highlight: function (element) {
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};	
if($("#update-email-form").length>0) { 
			$("#update-email-form").validate({
			submitHandler: function(form) {
					$.ajax({
						type: "POST",
						url: "fetch.php",
						data: {
							"cmd": "ue",
							"cp": $("#passwd").val(),
							"em": $("#email").val()
						},
						success: function (data) { 
						 $('#passwd').trigger("reset");
						 alert(data)
							
						}
					});
					

				},				
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					passwd: {
						required: true,
						 minlength: 5
					
					},
					email: {
						required: true,
						email: true
					},
			
				
				},
				messages: {
				passwd: {
					required: "Enter current password",
					minlength: "Invalid password"
				},
				email: {
						required: "Email required",
						email: "Email not valid"
					},
			},
				   
				errorElement: "span",
				highlight: function (element) {
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};	



if($("#new-account-form").length>0) { 
			$("#new-account-form").validate({
			submitHandler: function(form) {
		          return true; exit;
					
				},				
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					userid: {
						required: true,
						 minlength: 5
					
					},
					passwd: {
						required: true,
						 minlength: 6
					
					},
					
					cpasswd: {
                                              required: true,
					          minlength: 6,
					          equalTo: "#passwd"
                                    },
					email: {
						required: true,
						email: true
					},
			
				
				},
				messages: {
					userid: {
					required: "Enter username",
					minlength: "Username should be 4 or more chars"
				},
				passwd: {
					required: "Enter new password",
					minlength: "Invalid password"
				},
				
				cpasswd: {
					required: "Confirm your password",
					minlength: "Password should be 6 or more chars",
					equalTo: "Password does not match"
				},
				email: {
						required: "Email required",
						email: "Email not valid"
					},
			},
				   
				errorElement: "span",
				highlight: function (element) {
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};
if($("#reset-password-form").length>0) { 
			$("#reset-password-form").validate({
			submitHandler: function(form) {
					
					return true; exit;

				},				
				// debug: true,
				errorPlacement: function(error, element) {
					error.insertBefore( element );
				},
				onkeyup: false,
				onclick: false,
				rules: {
					opasswd: {
						required: true,
						 minlength: 5
					
					},
					npasswd: {
						required: true,
					     minlength: 5
						
					},
					cpasswd: {
                                   required: true,
					minlength: 5,
					equalTo: "#npasswd"
                                    }
			
				
				},
				messages: {
				opasswd: {
					required: "Enter current password",
					minlength: "Your password must be at least 5 characters long"
				},
				npasswd: {
					required: "Enter new password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Please enter the same password as above"
				},
				cpasswd: {
					required: "Confirm your password",
					minlength: "Your password must be at least 5 characters long",
					equalTo: "Password does not match"
				}
			},
				   
				errorElement: "span",
				highlight: function (element) {
					$(element).parent().removeClass("has-success").addClass("has-error");
					$(element).siblings("label").addClass("hide"); 
				},
				success: function (element) {
					$(element).parent().removeClass("has-error").addClass("has-success");
					$(element).siblings("label").removeClass("hide"); 
				}
			});
		};		
		
	
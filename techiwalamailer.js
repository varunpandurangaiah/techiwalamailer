	/* ============================================================
	 * Plugin Techiwala Mailer
	 * ============================================================ */
		$("#form_techiwala").submit(function(e) {
		e.preventDefault();
		var name = $("#name").val();
		var last_name = $("#last_name").val();
		var email = $("#email").val();
		var message = $("#message").val();
		if(name == "" || last_name == "" || message == "" || email == "") {
			$("#error_message").show().html("All Fields are Required");
		} else {
			$("#error_message").html("").hide();
			$.ajax({
				type: "POST",
				url: "mail.php",
				data: "name="+name+"&last_name="+last_name+"&message="+message+"&email="+email,
				success: function(data){
					msg = 'Message Sent OK Check Spams';
					$("#form_techiwala")[0].reset();
					$('#success_message').fadeIn().html(msg);
					setTimeout(function() {
						$('#success_message').fadeOut("slow");
					}, 2000 );

				}
			});
		}
	})

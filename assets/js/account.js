$("#form_account").submit(function (e) {
	e.preventDefault();
	loading_animation();

	$.ajax({
		url: $(this).attr("action"),
		data: $(this).serialize(),
		type: "POST",
		dataType: "JSON",
		error: function (xhr, status, error) {
			setTimeout(() => {
				Swal.close();
				Swal.fire({
					icon: "error",
					title: "Error",
					text: error,
				}).then((res) => {
					window.location.reload();
				});
			}, 200);
		},
		success: function (d) {
			setTimeout(() => {
				Swal.close();
				regenerate_token(d.token);
				if (d.status == false) {
					Swal.fire({
						icon: "error",
						title: "Error",
						text: d.msg,
					});
				} else {
					Swal.fire({
						icon: "success",
						title: "Success",
						text: d.msg,
					});
				}
			}, 200);
		},
	});
});

function edit_password() {
	$("#staticBackdrop").modal("show");
	$("#old_pass").val("");
	$("#new_pass").val("");
	$("#renew_pass").val("");

	$("#err_old_pass").html("");
	$("#err_new_pass").html("");
	$("#err_renew_pass").html("");
}

$("#form_password").submit(function (e) {
	e.preventDefault();
	loading_animation();

	$.ajax({
		url: $(this).attr("action"),
		data: $(this).serialize(),
		type: "POST",
		dataType: "JSON",
		error: function (xhr, status, error) {
			setTimeout(() => {
				Swal.close();
				Swal.fire({
					icon: "error",
					title: "Error",
					text: error,
				}).then((res) => {
					window.location.reload();
				});
			}, 200);
		},
		success: function (d) {
			setTimeout(() => {
				Swal.close();
				regenerate_token(d.token);

				if (d.type == "validation") {
					if (d.err_old_pass) {
						$("#err_old_pass").html(d.err_old_pass);
					} else {
						$("#err_old_pass").html("");
					}

					if (d.err_new_pass) {
						$("#err_new_pass").html(d.err_new_pass);
					} else {
						$("#err_new_pass").html("");
					}

					if (d.err_renew_pass) {
						$("#err_renew_pass").html(d.err_renew_pass);
					} else {
						$("#err_renew_pass").html("");
					}
				} else if (d.type == "result") {
					$("#err_old_pass").html("");
					$("#err_new_pass").html("");
					$("#err_renew_pass").html("");

					if (d.status == false) {
						Swal.fire({
							icon: "error",
							title: "Error",
							text: d.msg,
						});
					} else {
						Swal.fire({
							icon: "success",
							title: "Success",
							text: d.msg,
						}).then((res) => {
							$("#staticBackdrop").modal("hide");
						});
					}
				}
			}, 200);
		},
	});
});

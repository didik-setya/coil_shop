$(".form_settings").submit(function (e) {
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
					}).then((res) => {
						window.location.reload();
					});
				}
			}, 200);
		},
	});
});

function add_form_contact() {
	const form_contact =
		'<tr><td><input type="text" name="name_contact[]" required class="form-control"></td><td><input type="text" name="value_contact[]" required class="form-control"></td><td><button class="btn btn-sm btn-danger remove_row_contact" type="button"><i class="far fa-times-circle"></i></button></td></tr>';
	console.log(form_contact);

	$("#table_form tbody").append(form_contact);
}

$(document).on("click", ".remove_row_contact", function () {
	$(this).parents("td").parents("tr").remove();
});

function add_form_payment() {
	let html = $("#form_payment table tbody").html();
	$("#tbody_payment").append(html);
}

$(document).on("click", ".remove_form_payment", function () {
	$(this).parents("td").parents("tr").remove();
});

function add_form_courir() {
	let html = $("#form_courir table tbody").html();
	$("#tbody_courir").append(html);
}

$(document).on("click", ".remove_form_courir", function () {
	$(this).parents("td").parents("tr").remove();
});

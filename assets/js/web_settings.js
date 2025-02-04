const endpoint_url = "https://alamat.thecloudalert.com/api/";

$(document).ready(function () {
	load_province();
});

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

function edit_shipping_point() {
	$("#modalPoint").modal("show");
}

function load_province() {
	$.ajax({
		url: endpoint_url + "provinsi/get/",
		type: "GET",
		dataType: "JSON",
		error: function (xhr, status, error) {
			alert(error);
		},
		success: function (d) {
			const data = d.result;
			let html = '<option value="">--pilih--</option>';
			let i;
			for (i = 0; i < data.length; i++) {
				html +=
					'<option data-id="' +
					data[i].id +
					'" value="' +
					data[i].text +
					'">' +
					data[i].text +
					"</option>";
			}
			$("#province").html(html);
		},
	});
}

$("#province").change(function () {
	let selectedOption = $(this).find("option:selected");
	const id = selectedOption.data("id");

	$("#city").html("");
	$("#distric").html("");
	$("#subdistric").html("");
	$("#zipcode").html("");

	$.ajax({
		url: endpoint_url + "kabkota/get/?d_provinsi_id=" + id,
		type: "GET",
		dataType: "JSON",
		error: function (xhr, status, error) {
			alert(error);
		},
		success: function (d) {
			const data = d.result;
			let html = '<option value="">--pilih--</option>';
			let i;
			for (i = 0; i < data.length; i++) {
				html +=
					'<option data-id="' +
					data[i].id +
					'" value="' +
					data[i].text +
					'">' +
					data[i].text +
					"</option>";
			}
			$("#city").html(html);
		},
	});
});

$("#city").change(function () {
	let selectedOption = $(this).find("option:selected");
	const id = selectedOption.data("id");

	$("#distric").html("");
	$("#subdistric").html("");
	$("#zipcode").html("");

	$("#hidden_city").val(id);
	$.ajax({
		url: endpoint_url + "kecamatan/get/?d_kabkota_id=" + id,
		type: "GET",
		dataType: "JSON",
		error: function (xhr, status, error) {
			alert(error);
		},
		success: function (d) {
			const data = d.result;
			let html = '<option value="">--pilih--</option>';
			let i;
			for (i = 0; i < data.length; i++) {
				html +=
					'<option data-id="' +
					data[i].id +
					'" value="' +
					data[i].text +
					'">' +
					data[i].text +
					"</option>";
			}
			$("#distric").html(html);
		},
	});
});

$("#distric").change(function () {
	let selectedOption = $(this).find("option:selected");
	const id = selectedOption.data("id");

	$("#subdistric").html("");
	$("#zipcode").html("");

	$("#hidden_distric").val(id);
	$.ajax({
		url: endpoint_url + "kelurahan/get/?d_kecamatan_id=" + id,
		type: "GET",
		dataType: "JSON",
		error: function (xhr, status, error) {
			alert(error);
		},
		success: function (d) {
			const data = d.result;
			let html = '<option value="">--pilih--</option>';
			let i;
			for (i = 0; i < data.length; i++) {
				html +=
					'<option data-id="' +
					data[i].id +
					'" value="' +
					data[i].text +
					'">' +
					data[i].text +
					"</option>";
			}
			$("#subdistric").html(html);
		},
	});
});

$("#subdistric").change(function () {
	get_zipcode();
	$("#zipcode").html("");
});

function get_zipcode() {
	let city = $("#hidden_city").val();
	let distric = $("#hidden_distric").val();
	$.ajax({
		url:
			endpoint_url +
			"kodepos/get/?d_kabkota_id=" +
			city +
			"&d_kecamatan_id=" +
			distric,
		type: "GET",
		dataType: "JSON",
		error: function (xhr, status, error) {
			alert(error);
		},
		success: function (d) {
			const data = d.result;
			let html = '<option value="">--pilih--</option>';
			let i;
			for (i = 0; i < data.length; i++) {
				html +=
					'<option value="' + data[i].text + '">' + data[i].text + "</option>";
			}
			$("#zipcode").html(html);
		},
	});
}

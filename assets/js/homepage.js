const loading =
	'<div class="d-flex justify-content-center" id="loading_animation"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
const endpoint_url = "https://alamat.thecloudalert.com/api/";

$(document).ready(function () {
	load_province();
});

function load_cart() {}

function view_product(id = null) {
	if (id) {
		loading_animation();
		get_detail_product(id);
	} else {
		window.location.reload();
	}
}

function get_detail_product(id) {
	$.ajax({
		url: base_url + "show_detail_product",
		data: { id: id },
		type: "POST",
		dataType: "JSON",
		error: function (xhr, status, error) {
			setTimeout(() => {
				Swal.close();
				Swal.fire({
					icon: "error",
					title: "Error",
					text: error,
				});
				$("#modalShowProduct .modal-body").html("");
			}, 200);
		},
		success: function (d) {
			Swal.close();
			setTimeout(() => {
				const data = d.data;
				if (d.status == true) {
					$("#modalShowProduct").modal("show");
					let price;

					if (data.discount > 0) {
						price =
							'<del class="text-danger">Rp. ' +
							data.price +
							"</del> Rp. " +
							data.real_price +
							"</div>";
					} else {
						price = "Rp. " + data.price + "</div>";
					}

					const html =
						'<div class="row align-items-center justify-content-center"><div class="col-sm-7 col-7 col-xl-6 col-lg-6 col-md-6"><div class="grid__quick__img"><img src="' +
						data.img +
						'" alt="img_product"></div></div><div class="col-xl-6 col-lg-6 col-md-6 col-12"><div class="grid__quick__content"><h3>' +
						data.name +
						'</h3><div class="quick__price">' +
						price +
						"<p>" +
						data.desc +
						"</p></div></div></div>";
					$("#modalShowProduct .modal-body").html(html);
				} else {
				}
			}, 200);
		},
	});
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
	$("#courir").html("");
	$("#sub_courir").html("");

	if (id) {
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
	} else {
		$("#city").html("");
	}
});

$("#city").change(function () {
	let selectedOption = $(this).find("option:selected");
	const id = selectedOption.data("id");

	$("#distric").html("");
	$("#subdistric").html("");
	$("#zipcode").html("");
	$("#courir").html("");
	$("#sub_courir").html("");

	$("#hidden_city").val(id);
	if (id) {
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
	} else {
		$("#distric").html("");
	}
});

$("#distric").change(function () {
	let selectedOption = $(this).find("option:selected");
	const id = selectedOption.data("id");

	$("#subdistric").html("");
	$("#zipcode").html("");
	$("#courir").html("");
	$("#sub_courir").html("");

	$("#hidden_distric").val(id);
	if (id) {
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
	} else {
		$("#subdistric").html("");
	}
});

$("#subdistric").change(function () {
	get_zipcode();
	$("#zipcode").html("");
	$("#courir").html("");
	$("#sub_courir").html("");
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

$("#zipcode").change(function () {
	const html = $("#select_courier").html();
	const thisval = $(this).val();
	if (thisval) {
		$("#courir").html(html);
	} else {
		$("#courir").html("");
		$("#sub_courir").html("");
	}
});

$("#courir").change(function () {
	let courir = $(this).val();

	const zipcode = $("#zipcode").val();
	const weight = $("#weight").val();

	if (courir) {
		$.ajax({
			url: base_url + "calculate_courir_cost",
			data: {
				courir: courir,
				zipcode: zipcode,
				weight: weight,
			},
			type: "POST",
			dataType: "JSON",
			error: function (xhr, status, error) {
				setTimeout(() => {
					alert(error);
				}, 200);
			},
			success: function (d) {
				if (d.status == false) {
					Swal.fire({
						title: "Error",
						icon: "error",
						text: d.msg,
					});
					$("#sub_code").html("");
				} else {
					const data = d.data;
					let html = '<option value="">--pilih--</option>';
					let i;
					for (i = 0; i < data.length; i++) {
						let etd = "";
						if (data[i].etd != "") {
							etd = " (" + data[i].etd + ") ";
						}

						let number = data[i].cost;
						const formattedNumber = number.toLocaleString("en-US", {
							minimumFractionDigits: 2,
							maximumFractionDigits: 2,
						});

						html +=
							'<option data-service="' +
							data[i].service +
							'" data-cost="' +
							data[i].cost +
							'" value="' +
							data[i].service +
							" (" +
							data[i].description +
							')">' +
							data[i].service +
							" (" +
							data[i].description +
							") " +
							etd +
							" (Rp. " +
							formattedNumber +
							")</option>";
					}

					$("#sub_courir").html(html);
				}
			},
		});
	} else {
		$("#sub_courir").html("");
	}
});

$("#sub_courir").change(function () {
	let selectedOption = $(this).find("option:selected");
	const cost = selectedOption.data("cost");
	const service = selectedOption.data("service");

	let formattedNumber = cost.toLocaleString("en-US", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2,
	});
	let new_cost = removeLastTwoDigits(formattedNumber);

	const total_product = $("#total_product").val();

	let c_total_all = cost + stringToInteger(total_product);
	let f_total_all = c_total_all.toLocaleString("en-US", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2,
	});
	let total_all = removeLastTwoDigits(f_total_all);

	if (cost) {
		$("#cost_courier").val(cost);
		$("#show_ongkir").html("Rp. " + new_cost);
		$("#show_total_all").html("Rp. " + total_all);
		$("#service_courier").val(service);
	} else {
		$("#cost_courier").val("");
		$("#show_ongkir").html("");
		$("#show_total_all").html("");
		$("#service_courier").val("");
	}
});

function removeLastTwoDigits(num) {
	return num.replace(/\.00$/, "");
}
function stringToInteger(str) {
	// Remove commas from the string
	let cleanString = str.replace(/,/g, "");

	// Convert to integer
	return parseInt(cleanString, 10); // or use Number(cleanString)
}

$("#form_checkout").submit(function (e) {
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
				});
			}, 200);
		},
		success: function (d) {
			setTimeout(() => {
				Swal.close();
				regenerate_token(d.token);

				if (d.type == "validation") {
					if (d.err_name) {
						$("#err_name").html(d.err_name);
					} else {
						$("#err_name").html("");
					}

					if (d.err_mail) {
						$("#err_mail").html(d.err_mail);
					} else {
						$("#err_mail").html("");
					}

					if (d.err_telp) {
						$("#err_telp").html(d.err_telp);
					} else {
						$("#err_telp").html("");
					}
				} else if (d.type == "result") {
					$("#err_name").html("");
					$("#err_mail").html("");
					$("#err_telp").html("");

					if (d.status == false) {
						if (d.redirect) {
							Swal.fire({
								icon: "error",
								title: "Error",
								text: d.msg,
							}).then((res) => {
								window.location.href = d.redirect;
							});
						} else {
							Swal.fire({
								icon: "error",
								title: "Error",
								text: d.msg,
							});
						}
					} else {
						if (d.redirect) {
							Swal.fire({
								icon: "success",
								title: "Success",
								text: d.msg,
							}).then((res) => {
								window.location.href = d.redirect;
							});
						} else {
							Swal.fire({
								icon: "success",
								title: "Success",
								text: d.msg,
							});
						}
					}
				}
			}, 200);
		},
	});
});

const loading =
	'<div class="d-flex justify-content-center" id="loading_animation"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';
const endpoint_url = "https://alamat.thecloudalert.com/api/";

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
					$("#product_cart").val(data.id);
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
						"<pre>" +
						data.desc +
						"</pre></div></div></div>";
					$("#modalShowProduct .modal-body #content").html(html);
				} else {
					Swal.fire({
						icon: "error",
						title: "Error",
						text: d.msg,
					});
				}
			}, 200);
		},
	});
}

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

$(".form_payment").submit(function (e) {
	e.preventDefault();
	loading_animation();
	$.ajax({
		url: $(this).attr("action"),
		data: new FormData(this),
		type: "POST",
		dataType: "JSON",
		contentType: false,
		processData: false,
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
				regenerate_token(d.token);
				Swal.close();

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

$(".qty_product").on("keyup mouseup", function () {
	const order = $(this).data("ord");
	const va = $(this).val();

	const price = $("#product_price_" + order).data("price");
	const sub_weight = $("#hidden_weight_" + order).val();
	const zipcode = $("#zipcode").val();

	let calculate_price = va * price;
	let formattedNumber = calculate_price.toLocaleString("en-US", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2,
	});
	let new_price = removeLastTwoDigits(formattedNumber);

	let count_new_weight = sub_weight * va;
	$("#hidden_weight_subtotal_" + order).val(count_new_weight);
	setTimeout(() => {
		let inputs_subweight = document.getElementsByClassName(
			"hidden_weight_subtotal"
		);

		let new_total_weight = 0;
		for (let tw = 0; tw < inputs_subweight.length; tw++) {
			new_total_weight += parseFloat(inputs_subweight[tw].value) || 0;
		}
		$("#weight").val(new_total_weight);
	}, 200);

	setTimeout(() => {
		let inputs_subtotal = document.getElementsByClassName("hidden_subtotal");
		let get_ongkir = $("#cost_courier").val() || 0;
		let count_total_product = 0;
		for (let i = 0; i < inputs_subtotal.length; i++) {
			count_total_product += parseFloat(inputs_subtotal[i].value) || 0;
		}
		let formated_total_product = count_total_product.toLocaleString("en-US", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2,
		});
		let new_total_product = removeLastTwoDigits(formated_total_product);
		let total_all = count_total_product + parseFloat(get_ongkir);

		let formated_total_all = total_all.toLocaleString("en-US", {
			minimumFractionDigits: 2,
			maximumFractionDigits: 2,
		});
		let new_total_all = removeLastTwoDigits(formated_total_all);

		$("#total_all_product").val(count_total_product);
		$("#show_total_product").html("Rp. " + new_total_product);
		$("#show_total_all").html("Rp. " + new_total_all);

		$("#show_ongkir").html("Rp. 0");
	}, 100);

	if (zipcode) {
		let html_btn_courier =
			'<div class="text-center"><button type="button" class="btn btn-sm btn-primary my-3" onclick="select_courier()">Pilih Kurir</button></div>';
		$("#frame_selected_courier").html(html_btn_courier);
	}

	$("#product_subtotal_" + order).html("Rp. " + new_price);
	$("#hidden_subtotal_" + order).val(calculate_price);

	$("#cost_courier").val("");
	$("#service_courier").val("");
	$("#hidden_courier").val("");
});

function view_payment(data = null) {
	let html = '<img src="' + data + '" alt="payment" class="w-100">';
	$("#modalTransaction .modal-body").html(html);
	$("#modalTransaction").modal("show");
}

function search_address() {
	$("#modalSearchAddress").modal("show");
}

$("#form_search_address").submit(function (e) {
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
				alert(error);
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
					const data = d.data;
					let html = "";
					for (let i = 0; i < data.length; i++) {
						html +=
							'<div data-prov="' +
							data[i].province_name +
							'" data-city="' +
							data[i].city_name +
							'" data-distric="' +
							data[i].district_name +
							'" data-subdistric="' +
							data[i].subdistrict_name +
							'" data-zipcode="' +
							data[i].zip_code +
							'" class="p-2 my-2 select-address"><span>' +
							data[i].label +
							"</span></div>";
					}
					$("#search_result").html(html);
				}
			}, 200);
		},
	});
});

$(document).on("click", ".select-address", function () {
	const prov = $(this).data("prov");
	const city = $(this).data("city");
	const distric = $(this).data("distric");
	const subdistric = $(this).data("subdistric");
	const zipcode = $(this).data("zipcode");

	$("#cost_courier").val("");
	$("#service_courier").val("");
	$("#hidden_courier").val("");

	if (prov && city && distric && subdistric && zipcode) {
		$("#province").val(prov);
		$("#city").val(city);
		$("#distric").val(distric);
		$("#subdistric").val(subdistric);
		$("#zipcode").val(zipcode);

		let html =
			'<div class="text-center"><div id="selected_address" class="py-3 px-2" onclick="search_address()"><span>' +
			subdistric +
			", " +
			distric +
			", " +
			city +
			", " +
			prov +
			", " +
			zipcode +
			"</span></div> </div>";
		let html_btn_courier =
			'<div class="text-center"><button type="button" class="btn btn-sm btn-primary my-3" onclick="select_courier()">Pilih Kurir</button></div>';

		$("#frame_selected_address").html(html);
		$("#frame_selected_courier").html(html_btn_courier);
	} else {
		Swal.fire({
			icon: "error",
			title: "Error",
			text: "Data ini tidak valid",
		});

		$("#province").val("");
		$("#city").val("");
		$("#distric").val("");
		$("#subdistric").val("");
		$("#zipcode").val("");
	}

	$("#modalSearchAddress").modal("hide");
});

$("#select_courier").change(function () {
	let courier = $(this).val();
	const zipcode = $("#zipcode").val();
	const weight = $("#weight").val();

	if (courier) {
		if (zipcode && weight) {
			loading_animation();
			$.ajax({
				url: base_url + "calculate_courir_cost",
				data: {
					courier: courier,
					zipcode: zipcode,
					weight: weight,
				},
				type: "POST",
				dataType: "JSON",
				error: function (xhr, status, error) {
					setTimeout(() => {
						Swal.close();
						alert(error);
					}, 200);

					$("#frame_select_service_courier").html("");
				},
				success: function (d) {
					Swal.close();

					if (d.status == false) {
						Swal.fire({
							title: "Error",
							icon: "error",
							text: d.msg,
						});
						$("#frame_select_service_courier").html("");
					} else {
						let data = d.data;
						let html = "";
						for (let i = 0; i < data.length; i++) {
							let cost = data[i].cost;
							let formattedNumber = cost.toLocaleString("en-US", {
								minimumFractionDigits: 2,
								maximumFractionDigits: 2,
							});
							let new_price = removeLastTwoDigits(formattedNumber);
							let etd = "";
							if (data[i].etd) {
								etd = " (" + data[i].etd + ")";
							}

							html +=
								'<div data-name="' +
								data[i].name +
								'" data-etd="' +
								data[i].etd +
								'" data-cost="' +
								data[i].cost +
								'" data-code="' +
								data[i].code +
								'" data-service="' +
								data[i].service +
								'" id="selected_service_courier" class="row align-items-center my-2 mx-1 select_service_courier">' +
								'<div class="col-3 col-sm-3 col-md-2">' +
								'<img src="' +
								d.logo +
								'" alt="courier_image"class="w-100">' +
								"</div>" +
								'<div class="col-9 col-sm-9 col-md-10">' +
								"<span>" +
								data[i].name +
								"</span> <br>" +
								'<span style="font-size: 13px;">' +
								data[i].service +
								etd +
								"</span> <br>" +
								'<small style="font-size: 11px;">Rp. ' +
								new_price +
								"</small>" +
								"</div>" +
								"</div>";
						}
						$("#frame_select_service_courier").html(html);
					}
				},
			});
		} else {
			Swal.fire({
				icon: "error",
				title: "Error",
				text: "Invalid data",
			}).then((res) => {
				window.location.reload();
			});
		}
	} else {
		$("#frame_select_service_courier").html("");
	}
});

$(document).on("click", ".select_service_courier", function () {
	const courier = $(this).data("code");
	const service = $(this).data("service");
	const cost = $(this).data("cost");
	const image = $(this).find("img").attr("src");
	const etd = $(this).data("etd");
	const name = $(this).data("name");

	let show_etd = "";
	if (etd) {
		show_etd = " (" + etd + ")";
	}
	let formattedNumber = cost.toLocaleString("en-US", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2,
	});
	let new_price = removeLastTwoDigits(formattedNumber);

	let html =
		'<div onclick="select_courier()" class="row align-items-center mx-1 py-1" id="selected_courier">' +
		'<div class="col-3 col-sm-3 col-md-2">' +
		'<img src="' +
		image +
		'" class="w-100" alt="logo_courier">' +
		"</div>" +
		'<div class="col-9 col-sm-9 col-md-10">' +
		"<span>" +
		name +
		"</span> <br>" +
		'<span style="font-size: 13px;">' +
		service +
		show_etd +
		"</span> <br>" +
		'<small style="font-size: 11px;">Rp. ' +
		new_price +
		"</small>" +
		"</div>" +
		"</div>";

	$("#cost_courier").val(cost);
	$("#service_courier").val(service);
	$("#hidden_courier").val(courier);

	$("#modalSelectCourier").modal("hide");
	$("#frame_selected_courier").html(html);

	const total_all_product = $("#total_all_product").val();
	let total_all = cost + parseFloat(total_all_product);
	let formated_total_all = total_all.toLocaleString("en-US", {
		minimumFractionDigits: 2,
		maximumFractionDigits: 2,
	});
	let new_total_all = removeLastTwoDigits(formated_total_all);
	$("#show_total_all").html("Rp. " + new_total_all);
	$("#show_ongkir").html("Rp. " + new_price);
});

function select_courier() {
	$("#modalSelectCourier").modal("show");
	$("#frame_select_service_courier").html("");
	$("#select_courier").val("");
}

const loading =
	'<div class="d-flex justify-content-center" id="loading_animation"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';

$(document).ready(function () {
	// get_prov();
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

function get_prov() {
	$.ajax({
		url: base_url + "get_prov",
		type: "POST",
		dataType: "JSON",
		error: function (xhr, status, error) {
			alert(error);
		},
		success: function (d) {},
	});
}
$("#prov").change(function () {
	const id = $(this).val();
});

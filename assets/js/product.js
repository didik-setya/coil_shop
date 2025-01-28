$(document).ready(function () {
	$("#table_produk").dataTable();
});

$("#form_product").submit(function (e) {
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
				Swal.close();
				regenerate_token(d.token);

				if (d.type == "validation") {
					if (d.err_name) {
						$("#err_name").html(d.err_name);
					} else {
						$("#err_name").html("");
					}

					if (d.err_price) {
						$("#err_price").html(d.err_price);
					} else {
						$("#err_price").html("");
					}

					if (d.err_stock) {
						$("#err_stock").html(d.err_stock);
					} else {
						$("#err_stock").html("");
					}

					if (d.err_discount) {
						$("#err_discount").html(d.err_discount);
					} else {
						$("#err_discount").html("");
					}

					if (d.err_berat) {
						$("#err_berat").html(d.err_berat);
					} else {
						$("#err_berat").html("");
					}
				} else if (d.type == "result") {
					$("#err_discount").html("");
					$("#err_price").html("");
					$("#err_stock").html("");
					$("#err_name").html("");
					$("#err_berat").html("");

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
				}
			}, 200);
		},
	});
});

$(".form_action").submit(function (e) {
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

				if (d.status == false) {
					Swal.fire({
						icon: "error",
						title: "Error",
						text: d.msg,
					});
				} else {
					if (d.from == "get_data_edit") {
						const data = d.data;

						$("#id_product").val(data.id);
						$("#name").val(data.name);
						$("#price").val(data.price);
						$("#stock").val(data.stock);
						$("#discount").val(data.discount);
						$("#desc").val(data.desc);
						$("#berat").val(data.weight);

						$("#err_discount").html("");
						$("#err_price").html("");
						$("#err_stock").html("");
						$("#err_name").html("");
						$("#err_berat").html("");

						$("#modalProduct").modal("show");
						$("#modalProduct .modal-title").html("Edit Produk");
						$("#act").val("edit");
						$("#images").removeAttr("required");
					} else if (d.from == "delete") {
						Swal.fire({
							icon: "success",
							title: "Success",
							text: d.msg,
						}).then((res) => {
							window.location.reload();
						});
					}
				}
			}, 200);
		},
	});
});

function add_product() {
	$("#modalProduct").modal("show");
	$("#modalProduct .modal-title").html("Tambah Produk");
	$("#act").val("add");
	$("#images").attr("required", true);

	$("#id_product").val("");
	$("#name").val("");
	$("#price").val("");
	$("#stock").val("");
	$("#discount").val("0");
	$("#desc").val("");

	$("#err_discount").html("");
	$("#err_price").html("");
	$("#err_stock").html("");
	$("#err_name").html("");
}

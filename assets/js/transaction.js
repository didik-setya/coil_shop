$(document).ready(function () {
	load_data();
});

function load_data() {
	$("#table_main").DataTable().destroy();
	$("#table_main").dataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "load_data_transaction",
			type: "POST",
		},

		scrollX: false,
		searching: true,
		ordering: false,
		autoWidth: false,
		columnDefs: [
			{
				defaultContent: "-",
				targets: "_all",
			},
		],
	});
}

function edit_status(id, status) {
	$("#modalEdit").modal("show");
	$("#status").val(status);
	$("#resi").val("");
	$("#id_status").val(id);
}

function detail_data(id) {
	loading_animation();
	$.ajax({
		url: base_url + "detail_checkout",
		data: { id: id },
		type: "POST",
		dataType: "HTML",
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
				$("#modalDetail .modal-body").html(d);
				$("#modalDetail").modal("show");
			}, 200);
		},
	});
}

$("#status").change(function () {
	const stat_val = $(this).val();
	if (stat_val == 5) {
		$("#form-resi").removeClass("d-none");
		$("#resi").attr("required", true);
	} else {
		$("#form-resi").addClass("d-none");
		$("#resi").removeAttr("required");
	}
});

$("#form_status").submit(function (e) {
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
						$("#modalEdit").modal("hide");
						window.location.reload();
					});
				}
			}, 200);
		},
	});
});

$(document).on("click", ".img_transaction", function () {
	const src = $(this).attr("src");
	const img = '<img src="' + src + '" class="w-100">';
	$("#modalPayment").modal("show");
	$("#modalPayment .modal-body").html(img);
});

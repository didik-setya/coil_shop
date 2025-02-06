$(document).ready(function () {
	load_data();
});

function load_data() {
	$("#main_table").DataTable().destroy();
	$("#main_table").dataTable({
		processing: true,
		serverSide: true,
		order: [],

		ajax: {
			url: base_url + "load_data_users",
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

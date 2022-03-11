$(document).ready( function () {
	$('#table_ticket').DataTable({
		"aButtons": [
		{
			"sExtends": "xls",
			"sFileName": "Action List.xls",
			"sButtonText": "Download All To Excel"
		}],
		"searching": true,
		"ordering": true,
		"info": false,
		"responsive": false,
		"autoWidth": false,
		"pageLength": 10,
		"iDisplayLength": 50,
		"ajax": {
		"url": "data.php",
		"type": "POST"
		},
		"aLengthMenu": 
		[[10, 25, 50, 100, -1],
		[10, 25, 50, 100, "All"]],
		"columns": [
		{ "data": "urutan" },
		{ "data": "NAME" },
		{ "data": "ITEM" },
		{ "data": "PRICE" },
		{ "data": "del" },
		],
	});
});

$(document).on( "click",".btnhapus", function() {
	var id = $(this).attr("id");
	swal({   
		title: "Delete Customer?",   
		text: "Delete Customer for By Name: "+$(this).attr("LINK_NAME")+" ?",   
		type: "warning",   
		showCancelButton: true,   
		confirmButtonColor: "#DD6B55",   
		confirmButtonText: "Delete",   
		closeOnConfirm: true 
	}, 
	function(){   
		var value = {
			id: id
		};
		$.ajax(
		{
			url : "delete.php",
			type: "POST",
			data : value,
			success: function(data, textStatus, jqXHR){
				var data = jQuery.parseJSON(data);
				if(data.result ==1){
					$.notify('Successfully Delete Customer');
					var table = $('#table_ticket').DataTable(); 
					table.ajax.reload( null, false );
				}else{
					swal("Error","Can't delete Ticket data, error : "+data.error,"error");
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				swal("Error!", textStatus, "error");
			}
		});
	});
});

$.notifyDefaults({
	type: 'success',
	delay: 2000
});

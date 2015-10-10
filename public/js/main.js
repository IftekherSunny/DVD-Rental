$(document).ready(function() {		
		$('#dataTables-example').DataTable({		   
			aoColumnDefs: [
			  { bSortable: false, aTargets: [ 0 ] },
			  { bSortable: true, aTargets: [ '_all' ] },
			  { "width": "3%", "targets": 0 },
			  { "width": "5%", "targets": 1 },
			  { "width": "12%", "targets": '_all' },
			],
			order: [[ 0, '' ]],	
			"scrollX": true,
		}); 
		
});	

	
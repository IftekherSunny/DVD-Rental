/*********************************************************
		******* Start JQuery For Check All Option
		*********************************************************/

    $(function () {
        $("#checkedAll1").click(function () {
            if(this.checked == true){
				document.getElementById("btnDetails1").disabled = true;
				/* document.getElementById("btnPrint").disabled = true; */
            }				
            $("input[name='checked1[]']").attr("checked", this.checked);				
					

        });

        $("input[name='checked1[]']").click(function () {
            if ($("input[name='checked1[]']").length == $("input[name='checked1[]']:checked").length) {
                $("#checkedAll1").attr("checked", "checked");
            }
            else {
                $("#checkedAll1").removeAttr("checked");
            }
        });

		
			
        $("input[name='checked1[]']").click(function () {
            var count = $("input[name='checked1[]']:checked").length;
            if (count == 0) {
				document.getElementById("btnDetails1").disabled = true;
            }
            else if (count == 1){
				document.getElementById("btnDetails1").disabled = false;
            }
            else {
				document.getElementById("btnDetails1").disabled = true;
            }
        });		

    });

/*********************************************************
******* End JQuery For Check All Option
*********************************************************/

$('#returnDate').DataTable({		   
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

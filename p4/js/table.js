$(document).ready(function(){
//function to toggle data table
	$("#table-reveal").click(function(){
		$(this).html("click to hide");
		$('#poptable').toggle();
	});
	
	//styles table and makes it sortable
	//$("table.tablesorter").tablesorter({widgets: ['zebra']});
});
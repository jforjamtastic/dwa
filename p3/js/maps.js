$(document).ready(function() {
	var val = 2010;
	var n = 2;
	console.log((val - 1790)/10);
	
	var obj = {};
   	$('#poptable').find('tbody tr').each(function(){ 	
	   		$td = $(this).find('td'),
	   		key = $td.eq(0).text(),
	   		val = parseInt($td.eq(n).text()); 	
	   		obj[key] = val;
	   		
	});
	//console.log(obj);   	
	   


	
	$('#map').vectorMap({
		map: 'us_aea_en',										//renders us aea map
		zoomStep: "1.2",										//sets the amount zoomed
		regionsSelectable: 'true',
		regionsSelectableOne: 'true',
		onRegionSelected: function(event, code){
			var stateCode = $('#map').vectorMap('get', 'mapObject').getSelectedRegions(code);
			$('#map').vectorMap("set", "focus", String(stateCode));
			
			console.log(stateCode);
		},
		series:{
			regions: [{
				values: obj,			
				scale: ['#FFFFFF', '#08519C'],
				attribute: 'fill'
				
			}]
		}
		
		
	});	
	
	var map = $('#map').vectorMap('get', 'mapObject');


	$('#clear-button').click(function(){
		map.clearSelectedRegions();
		map.reset();
		
	});		
	
	
	$("#slider").slider({
		value: val,
		min: 1790,
		max: 2010,
		step: 10,
		slide: function (event, ui) {
			$('#year-output').html(ui.value);
			n = (ui.value-1790)/10;
			console.log(n);
		}
	});
	
	
});														//ends the ready function

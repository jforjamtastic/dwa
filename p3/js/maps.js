$(document).ready(function() {
	var year = 1790;										//sets initial year
	var n = 1;												//sets initial column number to pull from	
	var population = {};									//creates object for population totals
	var minPop;
	var maxPop;
	var col = [];

	
   function test(x){
   	$('#poptable').find('tbody tr').each(function(){ 		//function pulls data from html table to 
	   		$td = $(this).find('td'),						//create an object in the correct format for 
	   		key = $td.eq(0).text(),							//jvectormap
	   		val = parseInt($td.eq(x).text());
	   		col.push(val); 	
	   		population[key] = val;
	   		
	});
	console.log(population);  							//test code to see population contents
	};
	test(n);
	
	
	
	
	Array.max = function (array){
		return Math.max.apply(Math, array);
	}
	console.log(Array.max(col));
	 
	$('#map').vectorMap({
		map: 'us_aea_en',										//renders us aea map
		zoomStep: "1.2",										//sets the amount zoomed
		regionsSelectable: 'true',								//allows states to be clickable
		regionsSelectableOne: 'true',							//limites to only one state
		onRegionSelected: function(event, code){				//function to zoom in on clicked state
			var stateCode = $('#map').vectorMap('get', 'mapObject').getSelectedRegions(code);
			$('#map').vectorMap("set", "focus", String(stateCode));
			
			//console.log(stateCode);
		},
		series:{
			regions: [{
				scale: ['#DEEBF7', '#08519C'],
				attribute: 'fill',				
				values: population,
				min: 0,		
				max: Array.max(col), 

				
			}]
		}
		
		
	});	
	
	var map = $('#map').vectorMap('get', 'mapObject');


	$('#clear-button').click(function(){
		map.clearSelectedRegions();								//deselects state
		map.reset();											//resets zoom and removes year
		$('#year-output').html('');								//deletes year indicator
		
	});		
	
	$("#slider").slider({
		value: year,
		min: 1790,
		max: 2010,
		step: 10,
		slide: function (event, ui) {
			$('#year-output').html(ui.value);
			n = (ui.value-1780)/10;
			col = [];
			test(n);
			map.series.regions[0].setValues(population);

			console.log(population);
			console.log(Array.max(col));
		}
	});

	
	
});														//ends the ready function

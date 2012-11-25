$(document).ready(function() {
	var year = 2010;									//sets initial year
	var n = 23;											//sets initial column number to pull from	
	var population = {};								//creates object for population totals	
	var column = [];									//used to find min and max

	
   function objCreate(n){
   		$('#poptable').find('tbody tr').each(function(){//function pulls data from html table to 
	   		$td = $(this).find('td'),					//create an object in the correct format for 
	   		key = $td.eq(0).text(),						//jvectormap
	   		val = parseInt($td.eq(n).text());
	   		column.push(val); 	
	   		population[key] = val;
	   		});
	//console.log(population);  						//test code to see population contents
	};
	
	objCreate(n);										//calls function and feeds it initial column
	
	
	
	Array.max = function (array){						//function returns max value
		return Math.max.apply(Math, array);
	}
	Array.min = function(array){						//function returns min value
		return Math.min.apply(Math, array);
	}
	
	
	console.log(Array.max(column));
	console.log(Array.min(column));

	 
	$('#map').vectorMap({
		map: 'us_aea_en',									//renders us aea map
		zoomStep: "1.2",									//sets the amount zoomed
		regionsSelectable: 'true',							//allows states to be clickable
		regionsSelectableOne: 'true',						//limites to only one state
		onRegionSelected: function(event, code){			//function to zoom in on clicked state
			var stateCode = $('#map').vectorMap('get', 'mapObject').getSelectedRegions(code);
			$('#map').vectorMap("set", "focus", String(stateCode));
			
			//console.log(stateCode);
		},
		series:{
			regions: [{
				scale: ['#DEEBF7', '#08519C'],				//sets the color range
				attribute: 'fill',							
				values: population,							//setss data to population
				min: Array.min(column),						//sets min number 
				max: Array.max(column) 						//sets max number
			}]
		}
		
		
	});	
	
	var map = $('#map').vectorMap('get', 'mapObject');


	$('#clear-button').click(function(){
		map.clearSelectedRegions();							//deselects state
		map.reset();										//resets zoom and removes year
		$('#year-output').html('');							//deletes year indicator
		
	});		
	
	$("#slider").slider({									//generates a slider widget
		value: year,										//sets value to year 
		min: 1790,											
		max: 2010,
		step: 10,											//sets step to every decade
		slide: function (event, ui) {						//function to control when slid
			$('#year-output').html(ui.value);				//updates visual counter
			n = (ui.value-1780)/10;							//sets N relative to decade change
			column = [];									//resets column to empty
			objCreate(n);									//creates obj for column n
			map.series.regions[0].setValues(population);	//sets the map to have updated data


			//need to somehow update the min and max values in maps.series.regions
			

		}
	});

});														//ends the ready function

$(document).ready(function() {
	var year = 2010;									//sets initial year
	var n = 23;											//sets initial column number to pull from	
	var population = {};								//creates object for population totals	
	var column = [];									//used to find min and max
	var min;
	var max;
	
	
   function objCreate(n){
   		$('#poptable').find('tbody tr').each(function(){//function pulls data from html table to 
	   		$td = $(this).find('td'),					//create an object in the correct format for 
	   		key = $td.eq(0).text(),						//jvectormap
	   		val = parseInt($td.eq(n).text());
	   		population[key] = val;
	   		});
	};
	
	objCreate(n);										//calls function and feeds it initial column
		
	Array.max = function (array){						//function returns max value
		return Math.max.apply(Math, array);
	}
	Array.min = function(array){						//function returns min value
		return Math.min.apply(Math, array);
	}
		
		
	function minmaxCreate(n){
   		$('#poptable').find('tbody tr').each(function(){//function pulls data from html table to 
	   		$td = $(this).find('td'),					//create an object in the correct format for 
	   		val = parseInt($td.eq(n).text());
	   		column.push(val); 
	   		
	   		});   
	   	min = Array.min(column);
	  	max = Array.max(column);
	   	console.log("actual:"+min);
	   	console.log("actual:"+max);
	};	
	
	minmaxCreate(n);
	

	 
	map = new jvm.WorldMap({
		map: 'us_aea_en',									//renders us aea map
		container: $('#map'),
		zoomStep: "1.2",									//sets the amount zoomed
		regionsSelectable: 'true',							//allows states to be clickable
		regionsSelectableOne: 'true',						//limites to only one state
		onRegionSelected: function(event, code){			//function to zoom in on clicked state
			var stateCode = $('#map').vectorMap('get', 'mapObject').getSelectedRegions(code);
			$('#map').vectorMap("set", "focus", String(stateCode));
			$('#statefactsbox').css("display","block")
			var name = $('#map').vectorMap('get', 'mapObject').getRegionName(code);
			$('#statefactsbox').find('h2').html(name);		//reveals statefacts box
			

			
		},
		series:{
			regions: [{
				scale: ['#DEEBF7', '#08519C'],				//sets the color range
				attribute: 'fill',							
				values: population,						//setss data to population
				min: min,						//sets min number 
				max: max						//sets max number
			}]
		},
		onRegionLabelShow: function(event, label, code){
			label.html(
				''+label.html()+''+
				'<br/> Population: '+population[code]
			);
		}
		
		
	});	
	//console.log(population);
	//var map = $('#map').vectorMap('get', 'mapObject');


	$('#clear-button').click(function(){
		map.clearSelectedRegions();							//deselects state
		map.reset();										//resets zoom and removes year
		$('#year-output').html('');							//deletes year indicator
		$('#statefactsbox').css("display","none");			//hides statefacts box

		
	});		
	
	
	$("#slider").slider({									//generates a slider widget
		value: year,										//sets value to year 
		min: 1790,											
		max: 2010,
		step: 10,											//sets step to every decade
		slide: function (event, ui) {						//function to control when slid
			$('#year-output').html(ui.value);				//updates visual counter
			n = (ui.value-1780)/10;							//sets N relative to decade change
			console.log(n);
			
			column = [];									//resets column to empty
			objCreate(n);									//creates obj for column n
			minmaxCreate(n);

			map.series.regions[0].setValues(population);	//sets the map to have updated data
			
			map.series.regions[0].params.min = min;
			map.series.regions[0].params.max = max;
			//map.series.regions[0].scale.minVale = min;
			map.series.regions[0].scale.maxValue = max;

			//console.log("params-min: "+map.series.regions[0].params.min);
			//console.log("params-max: "+map.series.regions[0].params.max);
			//console.log("scale-min: "+map.series.regions[0].scale.minValue);
			//console.log("scale=max: "+map.series.regions[0].scale.maxValue);
			

		}
	});
	$("#table-reveal").click(function(){
		$(this).html("click to hide");
		$('#poptable').toggle();
	});

});														//ends the ready function

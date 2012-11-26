$(document).ready(function() {
	var year = 2010;									//sets initial decade
	var n = 23;											//sets initial column number to data	
	var population = {};								//creates object for population totals	
	var column = [];									//used to find min and max in a column
	var min;
	var max;
	
	
	//function parses data from an html table and creates a usable format for jvectormap
	function objCreate(n){
   		$('#poptable').find('tbody tr').each(function(){
	   		$td = $(this).find('td'),					 
	   		key = $td.eq(0).text(),						
	   		val = parseInt($td.eq(n).text());
	   		population[key] = val;
	   		});
	};
	
	objCreate(n);										//calls function and feeds it initial column
		
	Array.max = function (array){						//function returns max value in the array
		return Math.max.apply(Math, array);
	}
	Array.min = function(array){						//function returns min value in the array
		return Math.min.apply(Math, array);
	}
		
	//function pulls data from a column in the table and makes an array out of it. It then calls
	//the min/max functions. 
	function minmaxCreate(n){
   		$('#poptable').find('tbody tr').each(function(){//function pulls data from html table to 
	   		$td = $(this).find('td'),					//create an object in the correct format for 
	   		val = parseInt($td.eq(n).text());
	   		column.push(val); 
	   		
	   		});   
	   	min = Array.min(column);
	  	max = Array.max(column);
	};	
	
	minmaxCreate(n);									//initialized the initial min/max values
	

	//this function creates a map of the united states using jvectormap 
	map = new jvm.WorldMap({
		map: 'us_aea_en',									//renders us aea map
		container: $('#map'),								//identifies the container
		zoomStep: "1.2",									//sets the zoom step
		regionsSelectable: 'true',							//allows states to be clickable
		regionsSelectableOne: 'true',  						//limites to only one state
		
		//This function handles what occurs when a state is selected/clicked
		onRegionSelected: function(event, code){	
			//this zooms in on the selected state		
			var stateCode = $('#map').vectorMap('get', 'mapObject').getSelectedRegions(code);
			$('#map').vectorMap("set", "focus", String(stateCode));
			
			//this unhides a statefactbox, was lacking data for this part of the project
			$('#statefactsbox').css("display","block")
			
			//this ensures that the h2 in the statefactbox includes the correct state name
			var name = $('#map').vectorMap('get', 'mapObject').getRegionName(code);
			$('#statefactsbox').find('h2').html(name);		
			

			
		},
		//for data visualization
		series:{
			regions: [{
				scale: ['#DEEBF7', '#08519C'],				//sets the color range
				attribute: 'fill',							//sets the style
				values: population,							//sets data to population
				min: min,									//sets min number 
				max: max									//sets max number
			}]
		},
		
		//controls labels that appear on hover
		onRegionLabelShow: function(event, label, code){
			label.html(										
				''+label.html()+''+							//prints statename
				'<br/> Population: '+population[code]		//prints population total
			);
		}
		
		
	});	

	//this function creates a clear button that removes all selections
	$('#clear-button').click(function(){
		map.clearSelectedRegions();							//deselects state
		map.reset();										//resets zoom and removes year
		$('#year-output').html('');							//deletes year indicator
		$('#statefactsbox').css("display","none");			//hides statefacts box

		
	});		
	
	//this governs the slider widget that controls which years data is being viewed
	$("#slider").slider({									//generates a slider widget
		value: year,										//sets value to year 
		min: 1790,											//earliest Decade for data
		max: 2010,											//latest Decade
		step: 10,											//sets step to every decade
		
		//controls when the slider is moved.
		slide: function (event, ui) {						
			$('#year-output').html(ui.value);				//updates visual counter
			n = (ui.value-1780)/10;							//sets N relative to decade change
			//console.log(n);								//test code
			
			column = [];									//resets column to empty array
			objCreate(n);									//sets the data to the selected decade
			minmaxCreate(n);								//finds the min/max for that decade

			map.series.regions[0].setValues(population);	//updates the map to have updated data
			
			map.series.regions[0].params.min = min;			//updates min/max to have updated data
			map.series.regions[0].params.max = max;
			//map.series.regions[0].scale.minVale = min;
			map.series.regions[0].scale.maxValue = max;


			//excessive test code
			//console.log("params-min: "+map.series.regions[0].params.min);
			//console.log("params-max: "+map.series.regions[0].params.max);
			//console.log("scale-min: "+map.series.regions[0].scale.minValue);
			//console.log("scale=max: "+map.series.regions[0].scale.maxValue);
			

		}
	});
	
	//function to toggle data table
	$("#table-reveal").click(function(){
		$(this).html("click to hide");
		$('#poptable').toggle();
	});
	
	//styles table and makes it sortable
	$("table.tablesorter").tablesorter({widgets: ['zebra']});

});															//ends the ready function

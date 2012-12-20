$(document).ready(function () {
	//sets the initial variables
    var year = 2009;    
    var val = 2009;
    var dataFileName = 'vetPercent';							//initial dataset
        
    init = function (year) {
    	//this updates the year indicator everytime the map is redrawn
    	$('#year-output').html(year);
    	
    	//grabs the server-generated json files
        $.getJSON('/json/'+ dataFileName + '.json', function(data){
            
            //initiatilizing values
            val = year,
                statesValues = jvm.values.apply({}, jvm.values(data.states));
            
            
            //creates the map
            map = new jvm.WorldMap({
                map: 'us_aea_en',									//us map
                container: $('#map'),								//identifies the container
                zoomOnScroll: 'false',								//this setting doesn't appear to work, may be a bug with framework
                regionsSelectable: 'true',							//allows states to be clickable
				regionsSelectableOne: 'true', 						//limits it to one
                
                //for data visualization
                series: {
                    regions: [{
                        scale: ['#DEEBF7', '#08519C'],
                        values: data.states[val],
                        min: jvm.min(statesValues),
                        max: jvm.max(statesValues)
                    }]
                },
                
                //function that controls what happens when a region is clicked
                onRegionSelected: function (event, code) {
                	//this zooms in on the selected state		
					var stateCode = $('#map').vectorMap('get', 'mapObject').getSelectedRegions(code);
					$('#map').vectorMap("set", "focus", String(stateCode));
					
					//this unhides a statefactbox, was lacking data for this part of the project
					$('#statefactsbox').css("display","block")
					
					//this ensures that the h2 in the statefactbox includes the correct state name
					var name = $('#map').vectorMap('get', 'mapObject').getRegionName(code);
					$('#statefactsbox').find('h2').html(name);	
					
					
					//ajax call occurs to fetch facts that will appear in the sidebar below the map.
					$.ajax({
						type: 'POST',
						url: "/maps/p_fetchfacts/",
						beforeSubmit: function() {
						},
			
						success: function(response) {
							//console.log(response);
							var resp = $.parseJSON(response);
							console.log(resp['capital']);
							
							//injects parsed json into the div and formats it.
							$('#statefactcontent').html(
								"Statehood - "+resp['statehood']+"<br/>"+ 
								"Capital - "+resp['capital']+"<br/>"+
								"Capital Since - "+ resp['capitalyear']+"<br/>"+
								"Area of "+resp['capital']+" - "+resp['area']+" miles<br/>"+
								"<p>Random Notes - " +resp['notes']+"</p>"		
							);
						},
						data: {
							state: code,
						}
					});

				},
				
				//equivalent to on hover, will display a label that shows the percent being displayed
				onRegionLabelShow: function(event, label, code){
					console.log(code);
				
						label.html(
							''+label.html()+''+
							'<br/> Percent: '+data.states[val][code]+'%'
						);
																		
				}
				
			});
			
			//nuclear bomb option, not perfected still, but still effective to reset everything.
			$('#clear-button').click(function(){
				map.clearSelectedRegions();							//deselects state
				map.reset();										//resets zoom and removes year
				$('#year-output').html('');							//deletes year indicator
				$('#statefactsbox').css("display","none");			//hides statefacts box

		
			});

		});
	};
	//call to generate initial map
    init(year);
    
   
    	
	//allows slider to load different years data in the same set.
	$("#slider").slider({
		value: val,								
		min: 2006,											//years of data available, limited for now.
		max: 2009,
		step: 1,											//how much val is changed when slider is moved
		
		//function handles actually changing the values when slider is slide.
		slide: function( event, ui ) {
			val = ui.value;
			year = ui.value;
			$('#year-output').html(ui.value);				//updates visual counter

			//console.log (val);								
			$('#map').off().empty();						//removes existing map and labels
			$('.jvectormap-label').remove();
			

			init(val);										//initiates a new map with new data
		},
		
	});


	//controls the drop down data-set changer
	var options = {
		type: 'POST',
		url: '/maps/p_data',
		beforeSubmit: function() {
			$('#caption').toggle();
		},
		
		//on success of changing data sets refresh the map.
		success: function(response) {
			dataFileName = response;	
			$('#map').off().empty();
			$('.jvectormap-label').remove();			

			init(2009);
			$('#caption').toggle();
			
			

		}
	};
	$('form[name=datachooser]').ajaxForm(options);
	

	//this loads saved searchs when they are selected.
	$("#saves").change(function() {
			var temp = $(this).val();						//the value in html stores both the filename and the year
			var array = temp.split(',')
			dataFileName = array[0];
			val = parseInt(array[1]);
			
			$('#map').off().empty();
			$('.jvectormap-label').remove();
			
			init(val);

	});

	$('form[name=saved]').ajaxForm(options);
	
	
	//controls the save button.
	$('#save-btn').click(function(){
		
		$.ajax({
			type: 'POST',
			url: "/maps/p_save/",
			beforeSubmit: function() {
			},
			
			//on success add the new option to the end of the saved dropdown list
			success: function(response) {
				if( response == "saved"){
					$('#saves').append(
						"<option value="+dataFileName+","+year+">"+dataFileName+" - "+year+"</option>");
					}
			},
			
			data: {
				tablename:""+dataFileName,
				year: year
			}

		});	
	});
	
	//this is unfinished code that would allow a user to send their own data to p_custom and have it 
	//output a json file to eventually have their own personalized view.
	/*var custoptions = {
		type: 'POST',
		url: '/maps/p_custom',
		
		success: function(response) {
			dataFileName = response;	
			$('#map').off().empty();
			$('.jvectormap-label').remove();			

			init(1000);
			
			

		}
	};
	$('form[name=custom]').ajaxForm(custoptions);*/
	
		


});
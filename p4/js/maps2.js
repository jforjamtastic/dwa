$(document).ready(function () {

    var year = 2008;
    
    var val = 2008;

    var dataFileName = 'json/test';
    
        
    init = function (year) {

        $.getJSON(dataFileName + '.json', function(data){
            
            val = year,
                statesValues = jvm.values.apply({}, jvm.values(data.states));

            map = new jvm.WorldMap({
                map: 'us_aea_en',
                container: $('#map'),								//identifies the container

                regionsSelectable: 'true',							//allows states to be clickable
				regionsSelectableOne: 'true', 
                series: {
                    regions: [{
                        scale: ['#DEEBF7', '#08519C'],
                        values: data.states[val],
                        min: jvm.min(statesValues),
                        max: jvm.max(statesValues)
                    }]
                },

                onRegionSelected: function (event, code) {
                	//this zooms in on the selected state		
					var stateCode = $('#map').vectorMap('get', 'mapObject').getSelectedRegions(code);
					$('#map').vectorMap("set", "focus", String(stateCode));
					
					//this unhides a statefactbox, was lacking data for this part of the project
					$('#statefactsbox').css("display","block")
					
					//this ensures that the h2 in the statefactbox includes the correct state name
					var name = $('#map').vectorMap('get', 'mapObject').getRegionName(code);
					$('#statefactsbox').find('h2').html(name);	

				}
			});
			$('#clear-button').click(function(){
				map.clearSelectedRegions();							//deselects state
				map.reset();										//resets zoom and removes year
				$('#year-output').html('');							//deletes year indicator
				$('#statefactsbox').css("display","none");			//hides statefacts box

		
	});

		});
	};

    init(year);
    
    
    	
	
	$("#slider").slider({
		value: val,
		min: 2006,
		max: 2009,
		step: 1,
		slide: function( event, ui ) {
			val = ui.value;
			$('#year-output').html(ui.value);				//updates visual counter

			console.log (val);
			$('#map').off().empty();
			$('.jvectormap-label').remove();
			

			init(val);
			

			
		}
	});


    $('#reloadRight').on('click', function () {

        if (dataFileName == 'data1') {

            dataFileName = 'data2';

        } else {

            dataFileName = 'data1';

        }

        $('#map').off().empty();
        $('.jvectormap-label').remove();


        console.log('Load ' + dataFileName + '.json');

        $('#console').append('Loading data the right way<br>');

        init();
    });


		var options = {
			type: 'POST',
			url: '/maps/p_data/',
			beforeSubmit: function() {
				$('#caption').toggle();
			},
			success: function(response) {
				dataFileName = "json/"+response;				
	
				init(year);
				$('#caption').toggle();
				
				

			}
		};
		$('form[name=datachooser]').ajaxForm(options);
		


});
$(document).ready(function () {

    var year = 2008;
    
    var val = 2008;

    var dataFileName = 'veterans';
    var temp = 0;
        
    init = function (year) {

        $.getJSON('/json/'+ dataFileName + '.json', function(data){
            
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

				},
				onRegionLabelShow: function(event, label, code){
					console.log(code);

					/*
					$.ajax({
						type: 'POST',
						url: '/maps/p_statepop',
						success: function(response) {
							saveThisVar(response);	
			
						},
						data: {
							table: "veterans",
							state: code,
							year: val
						},
						
					});	*/
				
					if( dataFileName == 'veterans'){
						label.html(
							''+label.html()+''+
							'<br/> Precent of Veterans: '+data.states[val][code]+'%'
						);
					};
													
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
    
    saveThisVar = function (response){
	    temp = response;
    };
    	
	
	$("#slider").slider({
		value: val,
		min: 2006,
		max: 2009,
		step: 1,
		slide: function( event, ui ) {
			val = ui.value;
			year = ui.value;
			$('#year-output').html(ui.value);				//updates visual counter

			console.log (val);
			$('#map').off().empty();
			$('.jvectormap-label').remove();
			

			init(val);
			

			
		}
	});


	//controls the drop down data-set changer
	var options = {
		type: 'POST',
		url: '/maps/p_data',
		beforeSubmit: function() {
			$('#caption').toggle();
		},
		success: function(response) {
			dataFileName = response;	
			$('#map').off().empty();
			$('.jvectormap-label').remove();			

			init(2009);
			$('#caption').toggle();
			
			

		}
	};
	$('form[name=datachooser]').ajaxForm(options);
	

	$("#saves").change(function() {
			var temp = $(this).val();
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
				$('#caption').toggle();
			},
			
			success: function(response) {
				$('#caption').toggle();
			},
			data: {
				tablename:""+dataFileName,
				year: year
			}

		});	
	});
		


});
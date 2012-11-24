$(document).ready(function() {
	$('#map').vectorMap({
		map: 'us_aea_en',										//renders us aea map
		//zoomStep: "1.2",										//sets the amount zoomed
		regionsSelectable: 'true',
		regionsSelectableOne: 'true',
		onRegionSelected: function(event, code){
			var stateCode = $('#map').vectorMap('get', 'mapObject').getSelectedRegions(code);
			$('#map').vectorMap("set", "focus", String(stateCode));
			
			console.log(stateCode);

		}
		
	});	
	$('#clear-button').click(function(){
		var map = $('#map').vectorMap('get', 'mapObject');
		map.clearSelectedRegions();
		map.reset();
			
	});		
	
	var val = 2010;
	
	$("#slider").slider({
		value: val,
		min: 1790,
		max: 2010,
		step: 10,
		slide: function (event, ui) {
			var year = ui.value;
			$('#year-output').html(ui.value);
		}
	});
	
	var mapData = <?php echo $mapData ?>;
	console.log(mapData);
	
});														//ends the ready function

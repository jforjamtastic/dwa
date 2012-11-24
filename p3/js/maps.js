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
});														//ends the ready function

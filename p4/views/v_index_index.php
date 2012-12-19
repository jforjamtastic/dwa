
 <div id="content">  
 		
 		<div id="map" style="width: 708px; height: 400px" class="jvectormap jvectormap-aea" data-projection="aea" data-name="us_aea_en"></div>
	  
	  <div id="clear-button">
	  		<span>x</span>
	  		
	  </div>
	  <span id='caption'>CHANGING...</span>
	  
	  <form name="datachooser">
	  		<select name="data">
	  		<option name='type' value="total_population">US Population by Decade </option>
	  		<option name='type' value="veterans">Percentage of Veterans</option>
	  		</select>
	  		
	  		<input type="submit" value="select">
	  </form>
	  
<!--	  <script type='text/javascript'>

		var options = {
			type: 'POST',
			url: '/maps/p_data/',
			beforeSubmit: function() {
				$('#caption').toggle();
			},
			success: function(response) {
				console.log(response);
				//var temp = $.parseJSON(response);
				//console.log(temp);
				$('#results').html(function(){
			  
					$.getJSON('/json/veterans.json', function(data){
			    		var val = 2009;
				        statesValues = jvm.values.apply({}, jvm.values(data)),
				        console.log(statesValues);
				
				   
					    $('#map').vectorMap({
					      	map: 'us_aea_en',
					      	series: {
					        	regions: [{
						        	scale: ['#DEEBF7', '#08519C'],
						        	attribute: 'fill',
						        	min: jvm.min(statesValues),
						        	max: jvm.max(statesValues)
						        }]
						    },
					     });
				   
				   
					     var mapObject = $('#map').vectorMap('get', 'mapObject');
				
					     $("#slider").slider({
						     value: val,
						     min: 2005,
						     max: 2009,
						     step: 1,
						     slide: function( event, ui ) {
							     val = ui.value;
							     mapObject.series.regions[0].setValues(data[ui.value]);
							 }
						 });
				     });
				});
				
				
				$('#caption').toggle();
				
				

			}
		}
		$('form[name=datachooser]').ajaxForm(options);
		
		</script> -->
		
	  <div id="results">
	  </div>
	  
	  <div id="slider-box">
	  		
	  	  	<div id="slider"></div><br />
	  		<h3 id="year-output"></h3>

	  </div>
	  <div id="description">
	  		<p> 
	  		Welcome to the early implementation of this interactive map.
	  		The goal is to eventually provide many diverse sources of 
	  		demographic and social information about the United States.
	  		Currently there's only a little bit of seed data available.
	  		So enjoy what's here and maybe there will be more shortly. 
	  		</p>
	  		
	  		<p>
	  		All of the underlying data has been obtained from the <a href="census.gov">U.S. Census 
	  		Bureau</a>, and this site is powered by <a href="jquery.com">jquery</a>, 
	  		<a href="jqueryui.com"> jquery ui</a>, and <a href="jvectormap.com">jvectormap</a> 
	  		and handcrafted pixels. Special thanks to everyone who has committed to those projects
	  		</p>
	  		
	 </div>
	  	  <a href="#" id="table-reveal">Click here to see the underlying table behind the map!</a>

	 <div>
	  		<table id="poptable" class="tablesorter">
		  		<caption>Population by Year</caption>
		  		<thead>
		  			<th>State</th>		  			
		  			<th id='1790'>1790</th>
		  			<th id='1800'>1800</th>
		  			<th id='1810'>1810</th>
		  			<th id='1820'>1820</th>
		  			<th id='1830'>1830</th>
		  			<th id='1840'>1840</th>
		  			<th id='1850'>1850</th>
		  			<th id='1860'>1860</th>
		  			<th id='1870'>1870</th>
		  			<th id='1880'>1880</th>
		  			<th id='1890'>1890</th>
		  			<th id='1900'>1900</th>
		  			<th id='1910'>1910</th>
		  			<th id='1920'>1920</th>
		  			<th id='1930'>1930</th>
		  			<th id='1940'>1940</th>
		  			<th id='1950'>1950</th>
		  			<th id='1960'>1960</th>
		  			<th id='1970'>1970</th>
		  			<th id='1980'>1980</th>
		  			<th id='1990'>1990</th>
		  			<th id='2000'>2000</th>
		  			<th id='2010'>2010</th>
		  		</thead>
		  		<tbody>
			  		<? foreach($mapData as $key => $mapData): ?>
			  		<tr>
			  			<td><?=$mapData['regioncode']?></td>			  			
			  			<td><?=$mapData['1790']?></td>			  		
			  			<td><?=$mapData['1800']?></td>
			  			<td><?=$mapData['1810']?> </td>
			  			<td><?=$mapData['1820']?> </td>
			  			<td><?=$mapData['1830']?> </td>
			  			<td><?=$mapData['1840']?> </td>
			  			<td><?=$mapData['1850']?> </td>
			  			<td><?=$mapData['1860']?> </td>
			  			<td><?=$mapData['1870']?> </td>
			  			<td><?=$mapData['1880']?> </td>
			  			<td><?=$mapData['1890']?> </td>
			  			<td><?=$mapData['1900']?> </td>
			  			<td><?=$mapData['1910']?> </td>
			  			<td><?=$mapData['1920']?> </td>
			  			<td><?=$mapData['1930']?> </td>
			  			<td><?=$mapData['1940']?> </td>
			  			<td><?=$mapData['1950']?> </td>
			  			<td><?=$mapData['1960']?> </td>
			  			<td><?=$mapData['1970']?> </td>
			  			<td><?=$mapData['1980']?> </td>
			  			<td><?=$mapData['1990']?> </td>
			  			<td><?=$mapData['2000']?> </td>
			  			<td><?=$mapData['2010']?> </td>

			  		</tr>
			  		<? endforeach; ?>
		  		</tbody>
	  		</table>
	  </div>
	  	  
 </div>
 
 <div id="sidebar">
 	 <div id="statefactsbox">
 	 	<h2></h2>
	 	 <p>fighting with the american fact finder left me little time to obtain enough 
		 	 data, but in the future I hope to fill this out with factoids about each state.
	 	 </p>
	 	 <ul>
	 	 	<li>capitals</li>
	 	 	<li>founding</li>
	 	 	<li>state mottos/animals/etc</li>
	 	 	<li>and anything else that might fit</li>
	 	 <ul>
 	 </div>
 	 
 </div>
 <div id="footer">
 	<footer>this page is powered by mamp, jquery, and jvectormap. Copyright 2012</footer>
 </div>
 <div id="content">    
      <div id="map" style="width: 708px; height: 400px" class="jvectormap jvectormap-aea" data-projection="aea" data-name="us_aea_en"></div>
	  
	  <div id="clear-button">
	  		<span>x</span>
	  </div>
	  
	  
	  <div id="slider-box">
	  	  	<div id="slider"></div><br />
	  		<h3 id="year-output">2010</h3>

	  </div>
	  
	  <div>
	  		<table id="poptable">
		  		<caption>Population by Year</caption>
		  		<thead>
		  			<th id='state'>State</th>		  			
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
			  			<td><?=$mapData['y1790']?></td>			  		
			  			<td><?=$mapData['y1800']?></td>
			  			<td><?=$mapData['y1810']?> </td>
			  			<td><?=$mapData['y1820']?> </td>
			  			<td><?=$mapData['y1830']?> </td>
			  			<td><?=$mapData['y1840']?> </td>
			  			<td><?=$mapData['y1850']?> </td>
			  			<td><?=$mapData['y1860']?> </td>
			  			<td><?=$mapData['y1870']?> </td>
			  			<td><?=$mapData['y1880']?> </td>
			  			<td><?=$mapData['y1890']?> </td>
			  			<td><?=$mapData['y1900']?> </td>
			  			<td><?=$mapData['y1910']?> </td>
			  			<td><?=$mapData['y1920']?> </td>
			  			<td><?=$mapData['y1930']?> </td>
			  			<td><?=$mapData['y1940']?> </td>
			  			<td><?=$mapData['y1950']?> </td>
			  			<td><?=$mapData['y1960']?> </td>
			  			<td><?=$mapData['y1970']?> </td>
			  			<td><?=$mapData['y1980']?> </td>
			  			<td><?=$mapData['y1990']?> </td>
			  			<td><?=$mapData['y2000']?> </td>
			  			<td><?=$mapData['y2010']?> </td>

			  		</tr>
			  		<? endforeach; ?>
		  		</tbody>
	  		</table>
	  		
	  </div>
 </div>
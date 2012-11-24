 <div id="content">    
      <div id="map" style="width: 708px; height: 400px" class="jvectormap jvectormap-aea" data-projection="aea" data-name="us_aea_en"></div>
	  
	  <div id="clear-button">
	  		<span>x</span>
	  </div>
	  
	  
	  <div id="slider-box">
	  		<h3 id="year-output">2010</h3>

	  		<div id="slider"></div><br />
	  </div>
	  <p>Population by Year</p>

	  <? foreach($mapData as $key => $mapData): ?>
	  	<p><?=$mapData['regioncode']?> <?=$mapData['y2000']?> </p>
	  		<? endforeach; ?>
 </div>
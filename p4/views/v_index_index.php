
 <div id="content">  
 		
 		<div id="map" style="width: 708px; height: 400px" class="jvectormap jvectormap-aea" data-projection="aea" data-name="us_aea_en"></div>
	  
	  <div id="clear-button">
	  		<span>x</span>
	  		
	  </div>
	  <span id='caption'>CHANGING...</span>
	  <div id="dropdowns">
	  <form name="datachooser" id="datachooser">
	  		<select name="data">
	  		<option value="total_population">US Population by Decade </option>
	  		<option value="veterans">Percentage of Veterans</option>
	  		</select>
	  		
	  		<input type="submit" value="select">
	  </form>
	  
	  <?
	  	if ($user) { ?>
	  		<button id="save-btn" class="rightdrop">save</button>

		  	<? if ($saved) { ?>
		  	<form name ="saved" class="rightdrop">
		  		<select name ="saves" id="saves">
		  		<? foreach($saved as $key => $saved): ?>
		  		<option value='<?=$saved['tablename']?>,<?=$saved['year']?>'> <?=$saved['tablename']?> - <?=$saved['year']?></option>
		  		<? endforeach?>
		  		</select>
		  	</form>
		  <? }?>
		  
	  <? }?>
	  </div>	
	  
	  <div id="slider-box">
	  		
	  	  	<div id="slider"></div><br />
	  		<h3 id="year-output">2008</h3>

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
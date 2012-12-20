<div id="map-wrapper">
	<div id="map" style="width: 100%; height: 400px" class="jvectormap jvectormap-aea" data-projection="aea" data-name="us_aea_en"></div>
	  
	<div id="clear-button">
	  		<span>x</span>
	</div>
		<span id='caption'>CHANGING...</span>
		<h3 id="year-output">2006</h3>		
		<div id="slider"></div>
</div>

 <div id="content">  
 		
	  <div id="dropdowns">
		  <form name="datachooser" id="datachooser">
		  		<legend>Datasets</legend>
		  		<select name="data">
		  		<option value="vetPercent">Percentage of Veterans</option>
		  		<optgroup label="Highest Educational Attainment" id="educationattainment">
		  			<option value="lessthannine">Students who drop out before 9th Grade</option>
		  			<option value="ninetotwelve">Students who drop out between 9th-12th</option>
		  			<option value="highschoolgrad">High School Graduates</option>
		  			<option value="somecollege">Some College</option>
		  			<option value="associates">Associates Degree</option>
		  			<option value="bachelors">Bachelor's Degree</option>
		  			<option value="graduate">Graduate or Higher</option>
		  			<option value="atleasthigh">Graduated at least High School</option>
		  			<option value="atleastbachelor">Graduated with at least a Bachelors</option>	  		
		  		</optgroup>
		  		</select>
		  		
		  		<input type="submit" value="select">
		  </form>
	  
		  <div class="rightdrop">
		  <? if ($user) { ?>
	
		  		<form name ="saved" id="saved">
			  		<legend>Saved</legend>
			  	<? if ($saved) { ?>
			  	
			  		<select name ="saves" id="saves" > 
			  		<? foreach($saved as $key => $saved): ?>
			  			<option value='<?=$saved['tablename']?>,<?=$saved['year']?>'> <?=$saved['tablename']?> - <?=$saved['year']?></option>
			  		<? endforeach?>
			  		</select>
			  	<? }?>
			  	</form>
			  	<button id="save-btn" class="rightdrop">save</button>
	
	
		  <? }?>
		  </div>
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
	 	 <div id="statefactcontent">
	 	 </div>
 	 </div>
 	 
 </div>
 <div id="footer">
 	<footer>this page is powered by mamp, jquery, and jvectormap. Copyright 2012</footer>
 </div>
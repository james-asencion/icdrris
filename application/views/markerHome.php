<?php $this->load->view('includes/header'); ?>
<?php $this->load->view('login_form'); ?>
		
		</div>
	</div>
        
	
	<div class = "container-fluid">
		<div class = "row-fluid">
			<div class = "span12">
				<div class="panel">
		<!--			<h3>INCIDENTS</h3>
					<p>Here's our sliding panel/drawer made using jQuery with the toggle function and some CSS3 for the rounded corners</p>

					<p>This panel could also be placed on the right. This could be particularly useful if, <a href="http://spyrestudios.com" title="SpyreStudios">like me</a>, you have a left-aligned website layout.</p>

					<h3>A Little Something About Me</h3>
						<img class="right" src="images/jon_image.jpg" alt="Jon Phillips" />
					<p>My name's Jon, I'm a freelance designer, blogger, musician. I run SpyreStudios and I specialize in WordPress blogs, CSS, XHTML and PHP</p>
					<div style="clear:both;"></div>

				<div class="columns">
					<div class="colleft">
					<h3>Navigation</h3>
						<ul>
							<li><a href="http://spyrestudios.com/" title="home">Home</a></li>
							<li><a href="http://spyrestudios.com/about/" title="about">About</a></li>
							<li><a href="http://spyrestudios.com/portfolio/" title="portfolio">Portfolio</a></li>
							<li><a href="http://spyrestudios.com/contact/" title="contact">Contact</a></li>
							<li><a href="http://spyrestudios.com" title="blog">Blog</a></li>
						</ul>
					</div>
			
					<div class="colright">
						<h3>Social Stuff</h3>
						<ul>
							<li><a href="http://twitter.com/jophillips" title="Twitter">Twitter</a></li>
							<li><a href="http://designbump.com/user/147" title="DesignBump">DesignBump</a></li>
							<li><a href="http://digg.com/users/jophillips" title="Digg">Digg</a></li>
							<li><a href="http://delicious.com/jon.phillips" title="Del.Icio.Us">Del.Icio.Us</a></li>
							<li><a href="http://designmoo.com/users/jonphillips" title="DesignMoo">DesignMoo</a></li>
						</ul>
					</div>
					
				</div>
			
			<!--
						<div class= "row">
				<div class= "four columns">
				<h4> List of Items </h4>
				</div>
			</div>
			<div class = "row">
				<div class = "six columns" >
					<form id= "searchitem" action = "#simple1">
						<input type= "text" id="searchinci" placeholder="Type keyword..."/>		
				</div >
						<label class = "left inline">	
						<i class= "icon-white icon-search" type = "submit" />
						</label>
					</form>
			</div>
				<br/>
				<table class="gridtable">
					<tr>
						<th>Item Category</th><th>Item Description</th><th>Quantity</th>
					</tr>
					<tr>
						<td>Text 1A</td><td>Text 1B</td><td>Text 1C</td>
					</tr>
					<tr>
						<td>Text 2A</td><td>Text 2B</td><td>Text 2C</td>
					</tr>
				</table>
		-->
			<div class = "span12" id="incidentList">
			</div>
			<div style="clear:both;"></div>

		</div>
			<a class="trigger" href="#">
					<button class="btn btn-mini" id="field" type="button" onclick="displayList()"/>Show All Incidents</button>
				
			</a>
	
	<div id="map_canvas" style="width:100%; height:600px;"></div>   
			<div id="directionsPanel"></div>
	</div>
	</div>
	</div>
<?php $this->load->view('includes/footer'); ?>

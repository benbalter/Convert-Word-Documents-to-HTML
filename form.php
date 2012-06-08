<?php
/**
 * Bare-bones form to prompt the user to select a file
 */
?>
<?php include( 'templates/header.html' ); ?>
<div class="row">
	<div class="span8 offset2">
  		<h1>Convert Microsoft Word to HTML</h1>
  		<p><em>To use:</em></p>
  		<ol>
  			<li>Open the target file in Microsoft Word</li>
  			<li>Go to "<code>File</code>" -> "<code>Save As Web Page</code>"</li>
  			<li>Save the file someplace convenient</li>
  			<li>Select the file below</li>
  			<li>This script will return the clean up file as a download</li>
  		</ol>
	</div>
</div>
<div class="row">
	<div class="span3 offset2">
	  	<form class="well" enctype="multipart/form-data" method="post">
	
  			<label class="checkbox">
  				<input type="checkbox" name="bootstrap" /> Include bootstrap?
  			</label>
  			
  			<input type="file" name="file" id="file"/>
  			  		
  		</form>
	</div>
</div>
<?php include( 'templates/footer.html' ); ?>
<script>
	$('#file').change( function(){ $('form').submit() });
</script>
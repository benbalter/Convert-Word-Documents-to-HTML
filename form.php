<?php
/**
 * Bare-bones form to prompt the user to select a file
 */
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
  </head>
  <body>
  	<h1>Convert Microsoft Word to HTML</h1>
  	<p><em>To use:</em></p>
  	<ol>
  		<li>Open the target file in Microsoft Word</li>
  		<li>Go to "<code>File</code>" -> "<code>Save As Web Page</code>"</li>
  		<li>Save the file someplace convenient</li>
  		<li>Select the file below</li>
  		<li>This script will return the clean up file as a download</li>
  	</ol>
  	<form enctype="multipart/form-data" method="post">
  		<input type="file" name="file" id="file" />
  	</form>
  	<script>
  		$('#file').change( function(){ $('form').submit() });
  	</script>
  </body>
</html>
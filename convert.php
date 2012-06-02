<?php
/**
 * Clean up a Microsoft Word Document exported as HTML via file->save as.
 * Relies heavily on WordPress's texturize engine and internal encoding functions to do the heavy lifting
 * Also converts footnotes into a format compatible with Bootstrap's tooltips
 * 
 * @author Benjamin J. Balter ( ben@balter.com | http://ben.balter.com )
 * @license GPLv3 or Later
 * @copyright 2012 Benjamin J. Balter
 */

//bootstrap a few things we're gonna need...
include 'tags.php'; //custom KSES file
include '../trunk/wp-load.php'; //WordPress (path to WordPress install's wp-load file)
include 'parse-footnotes.php'; //grab custom footnote parsing function

//path to the HTML input file, generated via file->save as in Microsoft Word
$data = file_get_contents( 'input.html' ); 

//Use WordPress's native filter API since we're already bootstrapped... 
//You can add or remove any filters you want here
add_filter( 'convert_word', 'wp_kses_post'         ); //strip extraneous tags and attributes
add_filter( 'convert_word', 'convert_chars'        ); //clean up encoding, HTML entities, etc.
add_filter( 'convert_word', 'wptexturize'          ); //Typset all the things
add_filter( 'convert_word', 'force_balance_tags'   ); //Ensure we get Clean, valid HTML back
add_filter( 'convert_word', 'bb_parse_footnotes'   ); //Convert footnotes into someting usable

//Note, we need to output semi-valid HTML, especially with the encoding info, otherwise things get CRAZY
?>
<html>
<header>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
</header>
<body>
<textarea style="width:100%; height:100%;"> <?php echo apply_filters( 'convert_word', $data ); ?></textarea>
</body>
</html>
<?php
/**
 * Parses Word-Style footnotes (via save-as HTML) into a cleaner, bootstrap-compatible format
 *
 * Adapted from https://github.com/benbalter/Convert-Microsoft-Word-Footnotes-to-WordPress-Simple-Footnotes/blob/master/parse-footnotes.php which parsed into WordPress's Simple Footnotes format
 *
 * NOTE: This version assumes the document has already been cleaned up via kses,
 * otherwise, the regex won't work due to the extra attributes
 *
 * @param string the ugly-footnoted HTML
 * @return string the pretty HTML
 */ 
function bb_parse_footnotes( $content ) {

	$content = stripslashes( $content );

	//grab all the Word-style footnote references into an array
	$pattern = '#\<a name\="_ftnref([0-9]+)" title\=""\>\[([0-9]+)\]\</a\>#';
	preg_match_all( $pattern, $content, $refs, PREG_SET_ORDER);
	
	//grab all the Word-style footnote into an array
	$pattern = '#\<p\>\<a name\="_ftn([0-9]+)" title\=""\>\[([0-9]+)\]\</a\>[ ]?(.*?)\</p\>#is';
	preg_match_all( $pattern, $content, $footnotes, PREG_SET_ORDER);

	//build find and replace arrays
	foreach ($refs as $ID => $ref) {
		$find[] = '#\<a name\="_ftnref'. $ref[2] .'" title\=""\>\['. $ref[2] .'\]\</a\>#';
		$replace[] = '<sup><a class="footnote" id="fnref' . $ref[2] . '" href="#fn' . $ref[2] . '" title="' . strip_tags( $footnotes[$ID][3] ) .'">'. $ref[2] .'</a></sup>';
	}

	foreach ( $footnotes as $footnote ) {
		$find[] = '#\<p\>\<a name\="_ftn' . $footnote[2] .'" title\=""\>\[' . $footnote[2] .']\</a\>[ ]?(.*?)\</p\>#is';
		$replace[] = '<li id="fn'  . $footnote[2] . '"><p>'  . $footnote[3] . ' <a href="#fnref' . $footnote[2] . '">&#8617;</a></p></li>';
	}
		
	//make the switch
	$content = preg_replace( $find, $replace, $content );

	return $content;
}
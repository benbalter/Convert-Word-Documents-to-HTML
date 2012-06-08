<?php
/**
 * Main function file which provides many of the transformations to clean up the word Export
 * @author Benjamin J. Balter
 * @package word-to-html
 */
 
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

/**
 * Sometimes Word likes to hide its CSS within comment tags depending on what options you choose on export, remove 'em
 */
function bb_strip_comments( $content ) {
	return preg_replace("/<!--.*-->/Uis", "", $content);  
}

/**
 * After cleanup, we're left with extra P tags with noting in them... yeah, not going to need those
 */
function bb_remove_empty_ps( $content ) {
	
	$content = str_replace( "<p></p>\n", '', $content );
	return str_replace( "<p>&nbsp;</p>\n", '', $content );
	
}

/**
 * This isn't 1999. Change all <b> tags to <strong> tags
 */
function bb_b_to_strong( $content ) {
	
	$content = str_replace( '<b>', '<strong>', $content );
	return str_replace( '</b>', '</strong>', $content );
	
}

/**
 * Change all <i> to <em> tags... semantic markup is fun!
 */
function bb_i_to_em( $content ) {
	
	$content = str_replace( '<i>', '<em>', $content );
	return str_replace( '</i>', '</em>', $content );
	
}

/** 
 * Normalize line endings by converting all to UNIX format
 */
function bb_normalize_line_endings( $content ) {

    $content = str_replace("\r\n", "\n", $content);
    $content = str_replace("\r", "\n", $content);
    $content = preg_replace("/\n{2,}/", "\n\n", $content);
    return $content;

}

/**
 * Why or why would you hard wrap the text? 
 * Remove the hard line wrap, trying our best to preserve line breaks when appropriate
 * @TODO is there a better way to do this?
 */
function bb_remove_hard_word_wrap( $content ) {

	$replacement = "{{ DOUBLE LINE BREAK }}";
	$content = preg_replace( "#\n\n#", $replacement, $content );
	$content = preg_replace( "#\n#", ' ', $content );
	$content = preg_replace( "#{$replacement}#", "\n\n", $content );
	
	return $content;
}

/**
 * Ensures that text encoding is UTF-8
 */
function bb_normalize_encoding( $content ) {
	return mb_convert_encoding( $content, 'utf-8', mb_detect_encoding( $content ) );
}

/**
 * Remove all consequetive spaces so that all spaces are single spaces, and actual spaces, not html entity spaces
 */
function bb_remove_extra_spaces( $content ) {
	
	while( strpos( $content, '&nbsp;&nbsp;' ) !== false )
		$content = str_replace( '&nbsp;&nbsp;', '&nbsp;', $content );
		
	$content = str_replace( '&nbsp; ', ' ', $content );
	
	return $content;
	
}

/**
 * Converts table of contents to navbar
 * @todo make this work better
 * @todo heirarchical support
 */
function bb_convert_toc( $content ) {
	
	//parse TOC
	$find = array(); $replace = array();
	preg_match_all( '#<p><a>([A-Z]{1,3})\. ([^<]+)?\. [0-9]+</a></p>#', $content, $matches );
	foreach ( $matches[2] as $ID => $match ) {
		$find[] = '#<h[0-9]>' . $matches[1][$ID] . '.&nbsp; ' . $match . '</h[0-9]>#'; 
		$replace[] = '<h2 id="' . sanitize_title( $match ) . '">' . $matches[1][$ID] . '. ' . $match . '</h2>';
	}

	//clean bad toc links
	$content = preg_replace( '#<a name="_Toc[0-9]+">([^<]*)?</a>#', '$1', $content );
	$content = preg_replace( '#<p><a>([A-Z]{1,3})\. ([^<]+)?\. [0-9]+</a></p>#', '', $content );
	
	//swap our headings
	$content = preg_replace( $find, $replace, $content );
	
	//build TOC
	ob_start(); ?>
</div><!-- end container opened in header -->
<div class="navbar navbar-fixed-top" id="navbar">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#top">TITLE</a>
			<div class="nav-collapse">
				<ul class="nav">
					<?php foreach ( $matches[2] as $match ) { ?>
					<li><a href="#<?php echo sanitize_title( $match ); ?>"><?php echo $match; ?></a></li>
					<?php } ?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>
<div class="container">
<?php
	return ob_get_clean() . $content;
}
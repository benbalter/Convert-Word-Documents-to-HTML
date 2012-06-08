<?php
/**
 * Array whitelisting the only allowed tags and attributes. 
 * Everything else that Microsoft throws in there will be discarded
 * This file can be freely edited to suit your particular needs.
 */
 
define( 'CUSTOM_TAGS', true );

global $allowedposttags;

$allowedposttags = array(
		'address' => array(),
		'a' => array(
			//'href' => true,
			'title' => true,
			'rel' => true,
			'rev' => true,
			'name' => true,
			'target' => true,
		),
		'abbr' => array(
			'class' => true,
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'article' => array(
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'aside' => array(
			'dir' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'b' => array(),
		'big' => array(),
		'blockquote' => array(
			'id' => true,
			'cite' => true,
			'lang' => true,
			'xml:lang' => true,
		),
		'br' => array (
		),
		'button' => array(
			'disabled' => true,
			'name' => true,
			'type' => true,
			'value' => true,
		),
		'caption' => array(
		),
		'cite' => array (
			'lang' => true,
			'title' => true,
		),
		'code' => array (
		),
		'col' => array(
			'char' => true,
			'charoff' => true,
			'span' => true,
			'dir' => true,
		),
		'del' => array(
			'datetime' => true,
		),
		'dd' => array(),
		'details' => array(
			'lang' => true,
			'open' => true,
			'xml:lang' => true,
		),
		'dl' => array(),
		'dt' => array(),
		'em' => array(),
		'fieldset' => array(),
		'figure' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'figcaption' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'footer' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'form' => array(
			'action' => true,
			'accept' => true,
			'accept-charset' => true,
			'enctype' => true,
			'method' => true,
			'name' => true,
			'target' => true,
		),
		'h1' => array(
		),
		'h2' => array (
		),
		'h3' => array (
		),
		'h4' => array (
		),
		'h5' => array (
		),
		'h6' => array (
		),
		'header' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'hgroup' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'hr' => array (
		),
		'i' => array(),
		'img' => array(
			'alt' => true,
			'border' => true,
			'hspace' => true,
			'longdesc' => true,
			'vspace' => true,
			'src' => true,
		),
		'ins' => array(
			'datetime' => true,
			'cite' => true,
		),
		'kbd' => array(),
		'label' => array(
			'for' => true,
		),
		'legend' => array(
		),
		'li' => array (
		),
		'menu' => array (
			'type' => true,
		),
		'nav' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'p' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'pre' => array(
		),
		'q' => array(
			'cite' => true,
		),
		's' => array(),
		'section' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'strike' => array(),
		'strong' => array(),
		'sub' => array(),
		'summary' => array(
			'lang' => true,
			'xml:lang' => true,
		),
		'sup' => array(),
		'table' => array(
		),
		'tbody' => array(
			'char' => true,
			'charoff' => true,
		),
		'td' => array(
			'abbr' => true,
			'axis' => true,
			'char' => true,
			'charoff' => true,
			'colspan' => true,
			'headers' => true,
			'scope' => true,
		),
		'textarea' => array(
			'disabled' => true,
			'name' => true,
			'readonly' => true,
		),
		'tfoot' => array(
			'char' => true,
			'charoff' => true,
		),
		'th' => array(
			'abbr' => true,
			'axis' => true,
			'char' => true,
			'charoff' => true,
			'headers' => true,
			'scope' => true,
		),
		'thead' => array(
			'char' => true,
			'charoff' => true,
		),
		'tr' => array(
			'char' => true,
			'charoff' => true,
		),
		'tt' => array(),
		'u' => array(),
		'ul' => array (
			'type' => true,
		),
		'ol' => array (
			'start' => true,
			'type' => true,
		),
		'var' => array(),
	);

	/**
	 * Kses allowed HTML elements.
	 *
	 * @global array $allowedtags
	 * @since 1.0.0
	 */
	$allowedtags = array(
		'a' => array(
			'href' => true,
			'title' => true,
		),
		'abbr' => array(
			'title' => true,
		),
		'acronym' => array(
			'title' => true,
		),
		'b' => array(),
		'blockquote' => array(
			'cite' => true,
		),
		//	'br' => array(),
		'cite' => array(),
		'code' => array(),
		'del' => array(
			'datetime' => true,
		),
		//	'dd' => array(),
		//	'dl' => array(),
		//	'dt' => array(),
		'em' => array (), 'i' => array (),
		//	'ins' => array('datetime' => array(), 'cite' => array()),
		//	'li' => array(),
		//	'ol' => array(),
		//	'p' => array(),
		'q' => array(
			'cite' => true,
		),
		'strike' => array(),
		'strong' => array(),
		//	'sub' => array(),
		//	'sup' => array(),
		//	'u' => array(),
		//	'ul' => array(),
	);

$allowedentitynames = array(
		'nbsp',    'iexcl',  'cent',    'pound',  'curren', 'yen',
		'brvbar',  'sect',   'uml',     'copy',   'ordf',   'laquo',
		'not',     'shy',    'reg',     'macr',   'deg',    'plusmn',
		'acute',   'micro',  'para',    'middot', 'cedil',  'ordm',
		'raquo',   'iquest', 'Agrave',  'Aacute', 'Acirc',  'Atilde',
		'Auml',    'Aring',  'AElig',   'Ccedil', 'Egrave', 'Eacute',
		'Ecirc',   'Euml',   'Igrave',  'Iacute', 'Icirc',  'Iuml',
		'ETH',     'Ntilde', 'Ograve',  'Oacute', 'Ocirc',  'Otilde',
		'Ouml',    'times',  'Oslash',  'Ugrave', 'Uacute', 'Ucirc',
		'Uuml',    'Yacute', 'THORN',   'szlig',  'agrave', 'aacute',
		'acirc',   'atilde', 'auml',    'aring',  'aelig',  'ccedil',
		'egrave',  'eacute', 'ecirc',   'euml',   'igrave', 'iacute',
		'icirc',   'iuml',   'eth',     'ntilde', 'ograve', 'oacute',
		'ocirc',   'otilde', 'ouml',    'divide', 'oslash', 'ugrave',
		'uacute',  'ucirc',  'uuml',    'yacute', 'thorn',  'yuml',
		'quot',    'amp',    'lt',      'gt',     'apos',   'OElig',
		'oelig',   'Scaron', 'scaron',  'Yuml',   'circ',   'tilde',
		'ensp',    'emsp',   'thinsp',  'zwnj',   'zwj',    'lrm',
		'rlm',     'ndash',  'mdash',   'lsquo',  'rsquo',  'sbquo',
		'ldquo',   'rdquo',  'bdquo',   'dagger', 'Dagger', 'permil',
		'lsaquo',  'rsaquo', 'euro',    'fnof',   'Alpha',  'Beta',
		'Gamma',   'Delta',  'Epsilon', 'Zeta',   'Eta',    'Theta',
		'Iota',    'Kappa',  'Lambda',  'Mu',     'Nu',     'Xi',
		'Omicron', 'Pi',     'Rho',     'Sigma',  'Tau',    'Upsilon',
		'Phi',     'Chi',    'Psi',     'Omega',  'alpha',  'beta',
		'gamma',   'delta',  'epsilon', 'zeta',   'eta',    'theta',
		'iota',    'kappa',  'lambda',  'mu',     'nu',     'xi',
		'omicron', 'pi',     'rho',     'sigmaf', 'sigma',  'tau',
		'upsilon', 'phi',    'chi',     'psi',    'omega',  'thetasym',
		'upsih',   'piv',    'bull',    'hellip', 'prime',  'Prime',
		'oline',   'frasl',  'weierp',  'image',  'real',   'trade',
		'alefsym', 'larr',   'uarr',    'rarr',   'darr',   'harr',
		'crarr',   'lArr',   'uArr',    'rArr',   'dArr',   'hArr',
		'forall',  'part',   'exist',   'empty',  'nabla',  'isin',
		'notin',   'ni',     'prod',    'sum',    'minus',  'lowast',
		'radic',   'prop',   'infin',   'ang',    'and',    'or',
		'cap',     'cup',    'int',     'sim',    'cong',   'asymp',
		'ne',      'equiv',  'le',      'ge',     'sub',    'sup',
		'nsub',    'sube',   'supe',    'oplus',  'otimes', 'perp',
		'sdot',    'lceil',  'rceil',   'lfloor', 'rfloor', 'lang',
		'rang',    'loz',    'spades',  'clubs',  'hearts', 'diams',
	);

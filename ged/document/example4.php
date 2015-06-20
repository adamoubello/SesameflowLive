<?php
/**
 * TagCloud_example4.php
 *
 * Generate a more customized Tag Cloud.
 * This example shows how the timeline information and number of occurrences of
 * tag are visualized. Additionally it shows how to set up own css styles.
 * The second part of this example shows how to disable timeline processing.
 *
 * PHP version 5
 *
 * LICENSE: This source file is subject to version 3.01 of the PHP license
 * that is available through the world-wide-web at the following URI:
 * http://www.php.net/license/3_01.txt.  If you did not receive a copy of
 * the PHP License and are unable to obtain it through the web, please
 * send a note to license@php.net so we can mail you a copy immediately.
 *
 * @category  HTML
 * @package   HTML_TagCloud
 * @author    Bastian Onken <bastian.onken@gmx.net>
 * @copyright 2008 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   CVS: $Id: TagCloud_example4.php,v 1.7 2008/11/07 09:36:43 bastianonken Exp $
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     File available since Release 0.1.0
 */
ini_set('include_path', 'E:\www\\tag_cloud\pear');	//charger les packages de PEAR::MDB2	
include_once("E:\www\\tag_cloud\pear\Image\Color.php");
require_once 'HTML/TagCloud.php';

// To get the date function working properly we have to set the time zone
date_default_timezone_set('UTC');

/**
 * MyTagsCustomCss extends HTML_TagCloud
 *
 * Showing how to override the protected class vars
 *
 * @category  HTML
 * @package   HTML_TagCloud
 * @author    Bastian Onken <bastian.onken@gmx.net>
 * @copyright 2008 Bastian Onken
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: 0.2.3
 * @link      http://pear.php.net/package/HTML_TagCloud
 * @since     Class available since Release 0.1.3
 */
class MyTagsCustomCss extends HTML_TagCloud
{
    protected $sizeSuffix = '%';
}

// Set up new font sizes, now we use percentual values
$baseFontSize  = 140;
$fontSizeRange = 50;

// Create an instance of our customized HTML_TagCloud we defined above with
//  non-default font sizes and non-default font colors, also increase the number
//  of colors used
$tags = new MyTagsCustomCss($baseFontSize, $fontSizeRange, '000090', 'FFFFFF', 6);

// Add some elements
$dummyURL = 'http://example.org';
// Following elements have a high count
$tags->addElement('oneYearOld(38)', $dummyURL, 38, strtotime('-1 year'));
$tags->addElement('halfAYearOld(34)', $dummyURL, 34, strtotime('-6 month'));
$tags->addElement('threeMonthOld(33)', $dummyURL, 33, strtotime('-3 month'));
$tags->addElement('oneMonthOld(36)', $dummyURL, 36, strtotime('-1 month'));
$tags->addElement('oneWeekOld(37)', $dummyURL, 37, strtotime('-1 week'));
$tags->addElement('now(35)', $dummyURL, 35, strtotime('now'));
// Following elements are the same as above, but they have a medium count
$tags->addElement('oneYearOld(18)', $dummyURL, 18, strtotime('-1 year'));
$tags->addElement('halfAYearOld(14)', $dummyURL, 14, strtotime('-6 month'));
$tags->addElement('threeMonthOld(13)', $dummyURL, 13, strtotime('-3 month'));
$tags->addElement('oneMonthOld(16)', $dummyURL, 16, strtotime('-1 month'));
$tags->addElement('oneWeekOld(17)', $dummyURL, 17, strtotime('-1 week'));
$tags->addElement('now(15)', $dummyURL, 15, strtotime('now'));
// Following elements are tje same as above, but they have a low count
$tags->addElement('oneYearOld(6)', $dummyURL, 6, strtotime('-1 year'));
$tags->addElement('halfAYearOld(2)', $dummyURL, 2, strtotime('-6 month'));
$tags->addElement('threeMonthOld(1)', $dummyURL, 1, strtotime('-3 month'));
$tags->addElement('oneMonthOld(4)', $dummyURL, 4, strtotime('-1 month'));
$tags->addElement('oneWeekOld(5)', $dummyURL, 5, strtotime('-1 week'));
$tags->addElement('now(3)', $dummyURL, 3, strtotime('now'));

// Create an instance of our customized TagCloud we defined above and disable
//  the mumber of used colors by setting the 5th parameter to 1
$tags2 = new MyTagsCustomCss($baseFontSize, $fontSizeRange, 'FF0000', 'FFFB00', 1);

// Set up some tags
$tagFixtures = array(
    'blogs',
    'folksonomy',
    'wikis',
    'rss',
    'widgets',
    'ajax',
    'podcasting',
    'semantic',
    'xhtml',
    'design',
    'mobility'
);

// Set up some time occurrences
$timeFixtures = array(
    '-1 year',
    '-6 month',
    '-3 month',
    '-1 month',
    '-1 week',
    '-1 day'
);

// Build and add randomized tags to the TagCloud
foreach ($tagFixtures as $tag) {
    // Set up how many occurrences this tag has
    $numberOfOccurrences = rand(1, 50);
    // Randomize through the time fixtures and set up the age of this tag
    $time = $timeFixtures[rand(0, count($timeFixtures)-1)];
    // Finally add it to the cloud, to see how the time and count values are
    //  interpreted we add them to the tagname to see their current value
    //$tag = $tag.'('.$numberOfOccurrences.','.str_replace(' ', '', $time).')';
    $tags2->addElement($tag, $dummyURL, $numberOfOccurrences, strtotime($time));
}

// Now return a HTML page that contains additional TagCloud style definitions
//  and display both TagClouds we created above
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>My customized Tag Cloud</title>
<style type="text/css">
.tagcloud {
    font-family: 'lucida grande',trebuchet,'trebuchet ms',verdana,arial,
                  helvetica,sans-serif;
    line-height: 1.8em;
    word-spacing: 0ex;
    letter-spacing: normal;
    text-decoration: none;
    text-transform: none;
    text-align: justify;
    text-indent: 0ex;
    margin: 1em 0em 0em 0em;
    border: 2px dotted #ddd;
    padding: 1em;
}
.tagcloud a:link {
    border-width: 0;
}
.tagcloud a:visited {
    border-width: 0;
}
.tagcloud a:hover {
    border-width: 1px;
    color:white !important;
    background-color: #000097;
}
.tagcloud a:active {
    border-width: 1px;
    color:white !important;
    background-color: #C2D7E7;
}
.tagcloudElement {
    padding: 2px 5px;
    position: relative;
    vertical-align: middle;
}
<?php

// Print out CSS
print $tags->buildCSS();
print $tags2->buildCSS();

?>
</style>
</head>
<body>
<p>First box shows how the timeline information is expressed in detail. There is
a static tag cloud of which tags have been named according to their time value:
</p>
<?php

// Print out HTML
print $tags->buildHTML();

?>
<p>Second box shows a randomized tag cloud, hit reload to mix them up. Note: At
this tag cloud there is no timeline information displayed (allthough there is
timeline information set up). Here's how you deactivate it: Set the number of
epocLevels at your own extended class to one or set the threshold of the
to-be-generated epocLevel to '1' at constructor time:</p>
<?php

// Print out HTML
print $tags2->buildHTML();

// Show source, you don't need this line in your code, it's just for showing off
show_source(__FILE__);

?>
</body>
</html>
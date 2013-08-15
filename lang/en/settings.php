<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author Myron Turner <turnermm02@shaw.ca> 
 * @author Aleksandr Selivanov <alexgearbox@gmail.com>
 */
 
$lang['nstart']                = 'The number at which you want to start your count';
$lang['padding']              = 'Character to pad the number with, if the number is smaller than the minimum number of digits desired for the number';
$lang['pad_length']         = 'The minimum number of digits in the number string.  This does not control the size of the number itself, which can outgrow the padded size';
$lang['set_date']             = 'If set to true the date will be printed with the number';
$lang['datestyle']            = 'This sets the date format for strftime, which can include Dokuwiki format specifiers for bold, italic, etc. The default uses italics.';
$lang['format']                = 'This is a string which is used to format the returned value, where %d represents the date and %n the number and %i&lt;n&gt; image number n.   Like the date style this can also take format specifiers. For instance: <b>** Date: %d Number: %n **</b>';
$lang['imgs']                   = 'Comma separated list of images located in data/media, e.g <b>:image.png,:wiki:other_image.png, . . .</b> These will be inserted into the format string in  the order in which they are listed at positions %i1. . . %i&lt;n&gt;';
$lang['use_imgs']            = 'If set to true, the plugin will attempt to insert images into the format string';

<?php
/*
 *  plugin: numbering
 *  clicking on numbering toolbar icon prints next number to editor
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author   Myron Turner <turnemm02@shaw.ca>
 */
 
define('DOKU_INC', realpath(dirname(__FILE__)) . '/../../../../');
require_once(DOKU_INC.'inc/init.php');
require_once(DOKU_INC.'inc/io.php');

numberingProcessNum();
exit;

function numberingProcessNum() 
{
    $db = numberingDB();
    $helper = plugin_load('helper', 'numbering');

    $start = urldecode($helper->getConfValue('nstart'));
    $number = getNumberingNextNumber($db, $start);

    $padding =  urldecode($helper->getConfValue('padding'));
    $len = (int)  urldecode($helper->getConfValue('pad_length'));
    $set_date =  $helper->getConfValue('set_date');
    $format  =   urldecode($helper->getConfValue('format'));
    
    if($helper->getConfValue('use_imgs') ){
        $imagestr=urldecode($helper->getConfValue('imgs'));            
        $images = explode(',',$imagestr);                
        $i_no = 0;
         foreach($images as $img) {        
            $nxt =  '%i' . ++$i_no;        
            $format =  str_replace($nxt , '{{' . $img . '}}' ,$format);
         }
    }
    
    if($set_date) {
       $dformat  =  urldecode($helper->getConfValue('datestyle'));
       $time = strftime($dformat);   
       $format = str_replace('%d', $time, $format);
    }

    $n =  str_pad((string)$number, (int)$len, $padding, STR_PAD_LEFT);
    $format = str_replace('%n', $n, $format);
    echo "$format\n\n";
}


function getNumberingNextNumber($db, $start) {

    io_lock($db);
    $ar = unserialize(io_readFile($db,false));
    if(!$ar) {   
        $ar['saved'] = $start;
        $ar['start'] = $start;        
    }
    else {       
        $number = $ar['saved'];  
        if($ar['start'] != $start) { 
             $ar['start'] = $start;
             $number = $start;
        }
        else $number = $ar['saved'];          
    }
    if($number < $start) $number = $start-1;
    $ar['saved'] =  ++$number;
    
    file_put_contents($db,serialize($ar));
    io_unlock($db);
    return "$number";
}

function numberingDB() {
$db  = metaFN("numbering:seqnum",'.ser');
if(!file_exists($db)) {
    io_saveFile($db,"", array());
}
return $db;
}


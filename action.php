<?php
/**
 *@author    Myron Turner <turnermm02@shaw.ca> 
 DOKU_BASE + 'lib/plugins/numbering/scripts/getnum.php',
 */
 
if(!defined('DOKU_INC')) define('DOKU_INC',realpath(dirname(__FILE__).'/../../../').'/');
if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
define ('NUMBERING_GETNUM', DOKU_PLUGIN . 'numbering/scripts/getnum.php');
require_once(DOKU_PLUGIN.'action.php');
class action_plugin_numbering extends DokuWiki_Action_Plugin {  
   var $helper;
        public function __construct()   {
              $this->helper = plugin_load('helper', 'numbering');
        }
        public function register(Doku_Event_Handler $controller) {     
          $controller->register_hook('COMMON_WIKIPAGE_SAVE', 'BEFORE', $this, 'handle_save',array('before'));
          $controller->register_hook('TPL_CONTENT_DISPLAY', 'BEFORE', $this, 'handle_read',array('before')); 		  
 	      $controller->register_hook('AJAX_CALL_UNKNOWN', 'BEFORE', $this,'_ajax_call'); 
        }
        
        function handle_save(Doku_Event $event, $param) {  
         if ($event->data['revertFrom']) return;
          if(!$event->data['contentChanged'] ) return;
          if(strpos($event->data['newContent'], '~~GetNextNumber~~') === false) return;
          $event->data['newContent'] = str_replace('~~GetNextNumber~~', $this->format_number(),$event->data['newContent']);
        }
		
        function handle_read(Doku_Event $event, $param){
            if(strpos($event->data,'bureaucracy') == false) return;
            $numfield = str_replace(',','|',$this->getConf('bureaucracy')); 
            $numfield = preg_replace("/\s+/","",$numfield );
		  $event->data = preg_replace_callback(
			'#<label>\s*<span>('. $numfield .')</span>\s*<input.*?\>#',
			function ($matches) {		
                  if(strpos($matches[0],'bureaucracy') == false) return $matches[0];
                $matches[0] =  preg_replace('#class=\"edit\"#', 'value = "" id="' .'bureau_num' .'"',$matches[0]);
                $matches[0] .="<br /><span>Click textbox to insert number</span>";
                return  $matches[0];                
			},
			$event->data
		);		  

		}
	
	function _ajax_call(Doku_Event $event, $param) {      
    $this->write_debug('ajax');
      $this->write_debug($event->data);
       if ($event->data != 'numbr_bureau') return;       
       $this->write_debug($event->data);
       $event->stopPropagation();
      $event->preventDefault();	  
	   $num = $this->format_number() ;
        $this->write_debug($num);
	  echo "$num";
	}	 
        function format_number(){
          $padding =  $this->helper->getConfValue('padding');
		  $len = (int)  $this->helper->getConfValue('pad_length');
          $number = $this->getNextNumber();     
		  return  str_pad((string)$number, (int)$len, $padding, STR_PAD_LEFT);	
        }
        
        function numberingDB() {
        $db  = metaFN("numbering:seqnum",'.ser');
        if(!file_exists($db)) {
            io_saveFile($db,"", array());
        }
        return $db;
      }
      
        function getNextNumber() {
            $db = $this->numberingDB();
            $start = $this->helper->getConfValue('nstart');            
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
		
function write_debug($data) {
  return;
  if (!$handle = fopen(DOKU_INC .'ajax.txt', 'a')) {
    return;
    }
 
    // Write $somecontent to our opened file.
    fwrite($handle, "$data\n");
    fclose($handle);

}
}  
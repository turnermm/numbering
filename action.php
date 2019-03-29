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
        }
        
        function handle_save(Doku_Event $event, $param) {   
         if ($event->data['revertFrom']) return;
          if(!$event->data['contentChanged'] ) return;
          if(strpos($event->data['newContent'], '~~GetNextNumber~~') === false) return;
          $padding =  $this->helper->getConfValue('padding');
		  $len = (int)  $this->helper->getConfValue('pad_length');
          $number = $this->getNextNumber();     
		  $number =  str_pad((string)$number, (int)$len, $padding, STR_PAD_LEFT);
  		  
          $event->data['newContent'] = str_replace('~~GetNextNumber~~', $number,$event->data['newContent']);
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
}  
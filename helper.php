<?php
/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
 * @author     Myron Turner <turnermm03@shaw.ca>
 */
 
// must be run within Dokuwiki
if (!defined('DOKU_INC')) die();


class helper_plugin_numbering extends DokuWiki_Plugin {
   private  $debug = 0;  
   
   function getMethods(){
    $result = array();
    $result[] = array(
      'name'   => 'getConfValue',
      'desc'   => 'return configuration value',
      'params' => array('name' => 'string'),
      'return' => array('value' => 'string'),
    );
    return $result;
  }

   function getConfValue($name) {
       if($this->debug) debug($name);
       return urlencode(trim($this->getConf($name)));
   }   
   
   function debug($name) {
      $val = $this->getConf($name);
      echo "$name = $val\n";
   }
}
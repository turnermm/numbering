<?php

/**
 * @license    GPL 2 (http://www.gnu.org/licenses/gpl.html)
   *
   * @author     Myron Turner <turnermm02@shaw.ca>
*/
        
// must be run within Dokuwiki
if(!defined('DOKU_INC')) die();

if(!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
define ('NUMBERING_ICON',  DOKU_REL . 'lib/plugins/numbering/sernum_2.png');
require_once(DOKU_PLUGIN.'syntax.php');
//if(!defined('DOKU_LF')) define ('DOKU_LF',"\n");
//if(!defined('DOKU_TAB')) define ('DOKU_TAB',"\t");

/**
 * All DokuWiki plugins to extend the parser/rendering mechanism
 * need to inherit from this class
 */
class syntax_plugin_numbering extends DokuWiki_Syntax_Plugin {


    /**
     * What kind of syntax are we?
     */
    function getType(){
        return 'substition';
    }
   
    /**
     * What about paragraphs?
     */

    function getPType(){
       //  return 'stack';
       return 'normal';
    }

    /**
     * Where to sort in?
     */ 
    function getSort(){
        return 155;
    }


    /**
     * Connect pattern to lexer
     */
    function connectTo($mode) {        
             
          $this->Lexer->addSpecialPattern('~nbox>[\w\-]+;[\w\-]+~',$mode,'plugin_numbering'); //label-name;id
           
    }
  

    /**
     * Handle the match
     */
    function handle($match, $state, $pos, Doku_Handler $handler){
        
        $class = "";  
        $id ="";   
 
        $match =  substr($match, 6, -1);
        list($name, $id) = explode(';', $match);
            
        switch($state) {       
            case DOKU_LEXER_SPECIAL:       
               return array($state, "<label><span class='nbox'>Name:&nbsp;</span><input type='text' size='8'  id='". $id ."'>\n" .
               '<img src="' . NUMBERING_ICON  . '" id = "' . $id .'" class = "numbering_clk"></label>');                   
        }
         return array($state, "" );
       
    }

    /**
     * Create output
     */
    function render($mode, Doku_Renderer $renderer, $data) {
        if($mode == 'xhtml'){
            list($state, $xhtml) = $data;
            switch ($state) {
                case DOKU_LEXER_SPECIAL:        
               $renderer->doc .=   $xhtml;
                
            }       
             return true;
        }
        return false;
    }
    
  function write_debug($what) {
     $handle = fopen("numbering_syntax.txt", "a");
     fwrite($handle,"$what\n");
     fclose($handle);
  }
}



/* DOKUWIKI:include title.js */

function addBtnActionNumberingNext($btn, props, edid) {
    $btn.click(function() {
    numberingNextNumber(edid) ;
        return false;
    });
 
    return true;
}


if (window.toolbar != undefined) {
    window.toolbar[window.toolbar.length] = {
        "type":"NumberingNext", 
        "title":  window.NumberingToolBarTtitle ||  "Insert next number",
        "icon":"../../plugins/numbering/sernum_2.png"
    };
}

jQuery( document ).ready(function() {
    jQuery("[id^=bureau_num_]").on('click',function(e) {	
           var id = this.id.replace(/num/,'nmbr');           
            var _ret = jQuery('#' + id);
            var params = "";
            params = 'call=numbr_bureau';
            if(JSINFO['nmbring_multi_db']) {
              params += '&data-db=' +   _ret.attr("data-db");            
            }
            jQuery.ajax({     
               url:  DOKU_BASE + 'lib/exe/ajax.php',
               async: true,
               data: params,    
               type: 'POST',
               dataType: 'html',         
               success: function(data){ 	
                       if(data) _ret.val(data);
                }
              });
        }); 
});


function numberingNextNumber(edid) {
        var debug = false;
        var params = "";
        jQuery.ajax({
           url: DOKU_BASE + 'lib/plugins/numbering/scripts/getnum.php',
           async: true,
           data: params,    
           type: 'POST',
           dataType: 'html',         
           success: function(data){                 
               if(debug) {            
                  alert(data);                   
               }
              
              if(DWgetSelection) {
                 numberInsertAtCarret(edid,data);    
              } 
              else window.insertAtCarret(edid,data);             
    }
    });

}
 
    var numberInsertAtCarret = function (textAreaID, text)
    {
        var txtarea = jQuery('#' + textAreaID)[0];
        var selection =  DWgetSelection(txtarea);
        add = selection.getText();
        if(add) {
            add  = add.replace(/^\s+/);
            add  = add.replace(/\s+$/);
            text = text.replace(/%R/,add);
        }
        pasteText(selection,text);
    };


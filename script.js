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

function numberingNextNumber(edid) {
        var debug = false;
        var params = "";
        jQuery.ajax({
           url: DOKU_BASE + 'lib/plugins/numbering/scripts/getnum.php',
           async: false,
           data: params,    
           type: 'POST',
           dataType: 'html',         
           success: function(data){                 
               if(debug) {            
                  alert(data);                   
               }
              insertAtCarret(edid,data);
    }
    });

}

if(!window.insertAtCarret) {
    var insertAtCarret = function (textAreaID, text)
    {
        var txtarea = jQuery('#' + textAreaID)[0];
        var selection = getSelection(txtarea);
        pasteText(selection,text,{nosel: true});
    };

}

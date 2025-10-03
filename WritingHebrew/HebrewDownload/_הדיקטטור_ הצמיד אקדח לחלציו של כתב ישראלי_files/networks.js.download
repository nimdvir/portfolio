var currentMousePos = { x: -1, y: -1 };
var iSelectionMinLength = 3;
var doc_type = 35;
var iCurrentCursorX = 0;
var iCurrentCursorY = 0;
var iCurrentCursorX2 = 0;
var iCurrentCursorY2 = 0;
var iResIDForSharing = 0;
var iSendITDid = 0;
var iSendITFid = 0;
 
yq(document).ready(function () {
    yq(document).mousemove(function (event) {
        currentMousePos.x = event.pageX;
        currentMousePos.y = event.pageY;
    });
    var hash = location.search.replace(/^\?/,'&').match(/&hash=[^&]+/)
    if (hash != null) {

	    var sResIDFromQuery = location.search.replace(/^\?/, '&').match(/&resid=\d+/) 
        if (sResIDFromQuery != null) {
            setTimeout("selectResponseText(" + sResIDFromQuery.substring(7) + ")", 1000);
        }
        else {
            selectPhrase('article');
        }
    }
    yq(".art_body_width_3,.art_body_width_4,.art_header_sub_title,.gspp_sub_title,.text14").mousedown(function (e) {
    //yq("#F_Content").mousedown(function (e) {
    iCurrentCursorX = currentMousePos.x;
        iCurrentCursorY = currentMousePos.y;
    });
	
	yq(".text14").mousedown(function (e) {
    //yq("#F_Content").mousedown(function (e) {
    iCurrentCursorX = currentMousePos.x;
        iCurrentCursorY = currentMousePos.y;
    });
	
	
    yq('span[id ^= "ResTD_"]').mousedown(function (e) {
        iCurrentCursorX = currentMousePos.x;
        iCurrentCursorY = currentMousePos.y;

    });
   
    yq(".art_body_width_3,.art_body_width_4,.art_header_sub_title,.gspp_sub_title,.text14").mouseup(function (e) {
        iCurrentCursorX2 = currentMousePos.x;
        iCurrentCursorY2 = currentMousePos.y;
        setTimeout("showSharingPopup()", 10);
    });
	
	yq(".text14").mouseup(function (e) {
        iCurrentCursorX2 = currentMousePos.x;
        iCurrentCursorY2 = currentMousePos.y;
        setTimeout("showSharingPopup()", 10);
    });

    yq('span[id^="ResTD_"]').mouseup(function (e) {
        iCurrentCursorX2 = currentMousePos.x;
        iCurrentCursorY2 = currentMousePos.y;
        var sResSpanName = yq(this).attr("name");
        if (sResSpanName != "") {
            var arrResID = sResSpanName.split('_');
            if (arrResID.length == 2) {
                iResIDForSharing = arrResID[1];
            }
        }
        setTimeout("showSharingPopup()", 10);
    });

});

function closePopupSharing() {
    yq('#spnPopupSharing').hide();
}

function sendItemByEmail(did, fid) {
    iSendITDid = did;
    iSendITFid = fid;
    showSharingOptions("sendit");
}

function selectResponseText(res_id) {
    var resp = yq('a[name="resp_' + res_id + '"]');
    var click_attr = yq(resp).attr("onclick");
    if (click_attr != "") {
        try {
            eval(click_attr);
            setTimeout("selectPhrase('response')", 2000);
        }
        catch (e) { }
    }
}

function showSharingPopup() {
	    var selectedText = getSelectionText();
		if (selectedText != "") {
            iCurrentCursorY = (iCurrentCursorY <= iCurrentCursorY2) ? iCurrentCursorY : iCurrentCursorY2;

            yq("#spnPopupSharing").css("left", currentMousePos.x - 130);
            yq("#spnPopupSharing").css("top", iCurrentCursorY - 50);
            yq("#spnPopupSharing").show();
        }
        else {
            yq('#spnPopupSharing').hide();
        }   
}


function showSharingOptions_new(type) {
	var current_url = window.location.href
     
    var selectedText = getSelectionText();
    var iTempResID = 0;
     
    if (selectedText != "") {
       
	    if (selectedText.length < iSelectionMinLength) {
            alert("לא ניתן לשתף פחות מ-" + iSelectionMinLength + " תווים");
            return;
        }

        if (parseInt(iResIDForSharing) > 0) {
            iTempResID = iResIDForSharing;
            iResIDForSharing = 0;
        }

            var urlForEncoding = current_url;
            var urlEncoded = encodeURIComponent(urlForEncoding);

            switch (type.toLowerCase()) {
                case "facebook":
                    window.open("http://www.facebook.com/sharer/sharer.php?&u=" + urlEncoded + encodeURIComponent("?qtext=" + selectedText), "", "width=500, height=500");
                    closePopupSharing();
					break;       
                case "twitter":
                    window.open("https://twitter.com/intent/tweet?original_referer=" + urlEncoded + "&text=" + encodeURIComponent(selectedText) + "&url=" + urlEncoded, "", "width=500, height=500");
                    closePopupSharing();
					break;
                case "gplus":
                    window.open("https://plus.google.com/share?url=" + urlEncoded, "", "width=500, height=500");
                    closePopupSharing();
					break;
                case "linkedin":
                    window.open("http://www.linkedin.com/shareArticle?mini=true&url=" + urlEncoded + "&title=" + selectedText, "", "width=500, height=500");
                    closePopupSharing();
					break;
            }
    }
}

 
function selectPhrase(type) {
    var sPhrase = yq('meta[property="og:title"]').attr('content');
    sPhrase = sPhrase.trim();

    if (sPhrase.length > 255) {
        sPhrase = sPhrase.substring(0, 255);
    }
    
    sPhrase = sPhrase.replace(/[\n|\r\n]/g, ' ');
    
    if (sPhrase != "") {
        //var objSearchIn = yq("#F_Content,#coteret_SubCoteretText"); 
        var objSearchIn = yq(".art_body_width_3,.art_body_width_4,.art_header_sub_title,.gspp_sub_title,.text14"); 
        
		if (type.toLowerCase() == 'response') {
            objSearchIn = yq('span[id^="ResTD_"]');
        }

        try {
            //sPhrase = sPhrase.replace(/[`~!@#$%^&*()_|+=?;:'"<>\{\}\[\]\\\/]/gi, '');
            yq(objSearchIn).highlight(sPhrase);

            if (!yq(".highlight").length) {
                str = sPhrase;
                var arrWords = (str + " ").split(" ");
               
                if (arrWords.length < 50) {                                                   
                    for (var i = 0; i < arrWords.length; i++) {
                        try {
                            if (yq(".highlight").length) { break; }

                            var lastIndexOfBlankSpace = str.replace(/[\n|\r\n]/g, ' ').lastIndexOf(" ");                       
                            str = str.substring(0, lastIndexOfBlankSpace);
                            str = str.trim();                      
                            //str = str.replace(/[^\w\s]/gi, '');
                            //str = str.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
                            str = str.replace(/[`~!@#$%^&*_|+=;:'"<>\{\}\[\]\\\/]/gi, '');
                            if (str.length > 2) {
                                yq(objSearchIn).highlight(str);
                            }
                        }
                        catch (ee) { /*alert(ee);*/ }
                    }
                }
                else {
                    var sFirstWord = arrWords[0];
                    if (sFirstWord.length == 1) { sFirstWord += " " + arrWords[0]; }                    
                    yq(objSearchIn).highlight(sFirstWord);
                }
            }

            if (yq(".highlight").length) {
                yq('html, body').animate({ scrollTop: yq(".highlight").offset().top - 150 }, 500);
            }
        }
        catch (e) { }
    }
}

function removehl() {
    yq("body").removeHighlight();
}

function getSelectionText() {
    var text = "";
    if (window.getSelection) {
        text = window.getSelection().toString();
    } else if (document.selection && document.selection.type != "Control") {
        text = document.selection.createRange().text;
    }
    return text.trim();
}

function getSelectionParentElement() {
    //var arrEnabledItemsForSelection = ["coteret_subcoterettext", "f_content"];
    var arrEnabledItemsForSelection = ["art_body_width_3", "art_body_width_4","gspp_sub_title","text14"];
    var bRes = false;
    var parentID = "";
    var parentEl = null, sel;

    try {
        if (window.getSelection) {
            sel = window.getSelection();
            if (sel.rangeCount) {
                parentEl = sel.getRangeAt(0).commonAncestorContainer;
                if (parentEl.nodeType != 1) {
                    parentEl = parentEl.parentNode;
                }
            }
        } else if ((sel = document.selection) && sel.type != "Control") {
            parentEl = sel.createRange().parentElement();
        }

        if (typeof (parentEl) != "undefined" && parentEl.id != "") {
            parentID = parentEl.id.trim().toLowerCase();
        }
        else if (typeof (parentEl.parentNode) != "undefined" && parentEl.parentNode.id != "") {
            parentID = parentEl.parentNode.id.trim().toLowerCase();
        }
        else {
            if (typeof (parentEl.parentNode.parentNode) != "undefined" && parentEl.parentNode.parentNode.id != "") {
                parentID = parentEl.parentNode.parentNode.id.toLowerCase();
            }
            else if (typeof (parentEl.parentNode.parentNode.parentNode) != "undefined" && parentEl.parentNode.parentNode.parentNode.id != "") {
                parentID = parentEl.parentNode.parentNode.parentNode.id.toLowerCase();
            }
        }

        if (parentID != "") {
            yq(arrEnabledItemsForSelection).each(function () {
                if (parentID.indexOf(this) >= 0) { bRes = true; }
            });
        }
    }
    catch (ex) { }
    return bRes;
}


function clearSelection() { var selection = null; if (window.getSelection) { selection = window.getSelection(); } else if (document.selection) { selection = document.selection; } if (selection) { if (selection.empty) { selection.empty(); } if (selection.removeAllRanges) { selection.removeAllRanges(); } } }

jQuery.fn.highlight = function (pattern) {
    if (pattern == "") { return; }
    var regex = typeof (pattern) === "string" ? new RegExp(pattern, "i") : pattern;

    function innerHighlight(node, pattern) {
        try {
            var skip = 0;
            if (node.nodeType === 3) {
                var pos = node.data.search(regex);

                if (pos >= 0 && node.data.length > 0) {
                    var match = node.data.match(regex);
                    var spanNode = document.createElement('span');
                    spanNode.className = 'highlight';
                    var middleBit = node.splitText(pos);
                    var endBit = middleBit.splitText(match[0].length);
                    var middleClone = middleBit.cloneNode(true);
                    spanNode.appendChild(middleClone);
                    middleBit.parentNode.replaceChild(spanNode, middleBit);
                    skip = 1;
                }
            }
            else if (node.nodeType === 1 && node.childNodes && !/(script|style)/i.test(node.tagName)) {
                for (var i = 0; i < node.childNodes.length; i++) {
                    i += innerHighlight(node.childNodes[i], pattern);
                }
            }
            return skip;
        }
        catch (ex) { return 0; }
    }

    return this.each(function () { innerHighlight(this, pattern); });
};

jQuery.fn.removeHighlight = function () {
    return this.find("span.highlight").each(function () {
        this.parentNode.firstChild.nodeName;
        with (this.parentNode) {
            replaceChild(this.firstChild, this);
            normalize();
        }
    }).end();
};

function querystring(key) {
    var b = location.href.replace(/\?/, "&").toLowerCase().indexOf("&" + key + "=")
    if (b < 0) { return '' }
    b += key.length + 2
    var e = location.href.indexOf("&", b)
    return location.href.substring(b, (e < b) ? location.href.length : e)
}

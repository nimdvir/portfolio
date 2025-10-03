var com_adswizz_synchro_register_VERSION = '2.0.16';
var com_adswizz_synchro_debug = false;
var com_adswizz_synchro_utils = (function () {
    return {
        /**
         * @description
         * Utility function.
         * @param {Object} source
         * @param {Object=} properties
         * @returns {Object}
         */
        extendObject: function extendObject(source, properties) {
            var defaultSource = source || {};
            for (var property in properties) {
                if (properties.hasOwnProperty(property)) {
                    defaultSource[property] = properties[property];
                }
            }

            return defaultSource;
        },
        /**
         * @description
         * Utility function.
         * @param {Object} obj
         * @returns {String}
         */
        toQueryParam: function toQueryParam(obj) {
            var str = [];

            for (var k in obj) {
                if (obj.hasOwnProperty(k)) {
                    str.push(
                        encodeURIComponent(k) + '=' + encodeURIComponent(obj[k])
                    );
                }
            }

            return str.join('&');
        },
        /**
         * @description
         * Utility function.
         * @param {Object} obj
         * @returns {String}
         */
        toDOMAttributes: function toDOMAttributes(obj) {
            var str = [];

            for (var k in obj) {
                if (obj.hasOwnProperty(k)) {
                    str.push(k + '=' + obj[k]);
                }
            }

            return str.join(' ');
        }
    };
})();

if (typeof com_adswizz_synchro_listenerid === 'undefined') {
    var com_adswizz_synchro_listenerid; // exposes listenerID as a global variable
}

if (typeof com_adswizz_synchro_listnerid === 'undefined') {
    var com_adswizz_synchro_listnerid = com_adswizz_synchro_listenerid;
}

function internal_com_adswizz_synchro_decorateUrl(url, useCompanion) {
    var adChar;
    var obj = window.com_adswizz_synchro_tags || {};
    var _url = url.replace('http://', '');

    obj.companionAds = useCompanion && true;

    if (_url.indexOf("/") === -1) {
        adChar = '/;?';
    } else if (_url.lastIndexOf("/") === _url.length - 1) {
        adChar = ';?';
    } else if (_url.indexOf("?") !== -1) {
        adChar = '&';
    } else {
        adChar = '?';
    }

    url += adChar + 'listenerid=' + com_adswizz_synchro_getListenerId();

    if (com_adswizz_synchro_getTags(obj) !== '') {
        var first = true;
        var awParamValue = '';

        for (var k in obj) {
            if (obj.hasOwnProperty(k)) {
                awParamValue += (!first ? ';' : '') + k + ":" + obj[k];
                first = false;
            }
        }

        url += '&awparams=' + encodeURIComponent(awParamValue);
    }

    return url;
}

function com_adswizz_synchro_decorateUrl(url) {
    return internal_com_adswizz_synchro_decorateUrl(url, true);
}

function com_adswizz_synchro_decoratePlaylistUrl(url) {
    return internal_com_adswizz_synchro_decorateUrl(url, false);
}

function com_adswizz_synchro_decoratePlaylists(name) {
    if (name.length = 0) return;

    var links = document.getElementsByName(name);

    for (var i = 0; i < links.length; i++) {
        var anchor = links.item(i);

        try {
            anchor.href = com_adswizz_synchro_decoratePlaylistUrl(anchor.href);
        } catch (error) {
            console.error('com_adswizz_synchro#decoratePlaylists', error);
        }
    }
}

function com_adswizz_synchro_readCookie(name) {
    var nameEQ = name + '=';
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1, c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }

    return null;
}

function com_adswizz_synchro_getCookie() {
    // this is the adswizz cookie on the client domain, used in the URL decoration
    var cookie = com_adswizz_synchro_readCookie('adswizz_oaid');

    if (cookie !== undefined && cookie !== '') {
        com_adswizz_synchro_listenerid = new Date().getTime() + "_" + Math.random();
        document.cookie = 'adswizz_oaid=' + com_adswizz_synchro_listenerid;
    } else {
        com_adswizz_synchro_listenerid = cookie;
    }

    return com_adswizz_synchro_listenerid;
}

/**
 * For backwards compatibility reasons. Use #com_adswizz_synchro_getListenerId() instead.
 */
function com_adswizz_synchro_getListnerId() {
    return com_adswizz_synchro_getListenerId();
}

/**
 * Get the Adswizz ListenerID.
 */
function com_adswizz_synchro_getListenerId() {
    if (com_adswizz_synchro_listenerid !== undefined && com_adswizz_synchro_listenerid !== '') {
        return com_adswizz_synchro_listenerid;
    }

    return com_adswizz_synchro_getCookie();
}

function com_adswizz_synchro_getTags(obj) {
    var value = '';
    var separator = '';

    for (var k in obj) {
        if (obj.hasOwnProperty(k)) {
            value += separator + k + "=" + obj[k];
            separator = "&";
        }
    }

    return encodeURIComponent(value);
}

function com_adswizz_synchro_write_iframeAd(obj) {
    var iframeName = 'adswizz_synchro_iframe';
    var cacheBuster = iframeName + Math.random();
    var iframeAttributes = com_adswizz_synchro_utils.toDOMAttributes({
        name: iframeName,
        width: obj.width,
        height: obj.height,
        framespacing: 0,
        frameborder: 0,
        allowtransparency: true,
        frameborder: 'yes',
        scrolling: 'no',
        src: '//synchrobox.adswizz.com/synchroIframe.php?' + com_adswizz_synchro_utils.toQueryParam(
            com_adswizz_synchro_utils.extendObject(obj, {
                cb: cacheBuster,
                debug: com_adswizz_synchro_debug,
                listenerId: com_adswizz_synchro_getListenerId(),
                tags: com_adswizz_synchro_getTags(this['com_adswizz_synchro_tags']),
                'aw_0_req.gdpr': (typeof aw_0_req_gdpr !== 'undefined' && aw_0_req_gdpr === true),
                isStagingTest: (typeof com_adswizz_synchro_isStagingTest !== 'undefined' && com_adswizz_synchro_isStagingTest === true)
            })
        )
    });

    return document.write("<iframe " + iframeAttributes + "></iframe>");
}

/**
 * @description
 * Injects an iframe which connects to our synchroscript delivery engine.
 */
function com_adswizz_synchro_sync_iframe() {
    var awIframe;
    var documentBodyRef = document.body;

    if (documentBodyRef) {
        awIframe = document.createElement('iframe');
        awIframe.style.display = 'none';
        awIframe.width = '0px';
        awIframe.height = '0px';
        awIframe.src = '//synchroscript.deliveryengine.adswizz.com/www/delivery/afr.php?' + com_adswizz_synchro_utils.toQueryParam({
            zoneid: 9,
            'aw_0_req.gdpr': (typeof aw_0_req_gdpr !== 'undefined' && aw_0_req_gdpr === true)
        });

        documentBodyRef.appendChild(awIframe);
        document.dispatchEvent(new Event('AwFrameRendered'));
    }
}

/**
 * @private
 * @description
 * Utility fn. Waits for DOM to be ready and then calls the arg `fn`.
 * @param {Function} synchroSyncIframe
 */
(function _domContentLoaded(synchroSyncIframe) {
    // check if document is already loaded
    if (document.readyState === 'complete') {
        setTimeout(DOMContentLoaded, 1);
    } else {
        // Works for modern browsers and >=IE9
        if (typeof document.addEventListener === 'function') {
            document.addEventListener('DOMContentLoaded', DOMContentLoaded);
        } else {
            // fallback for  IE <= 8
            document.attachEvent('onreadystatechange', onReadyStateChangeHandler);
        }

        _addWindowLoadEvent(DOMContentLoaded);
    }

    /**
     * @description
     * - Fallback to window load event for older browsers.
     * - For new browsers load event will be called last (callback was already executed) will not have any impact.
     * @private
     * @param {Function} eventHandlerFn
     */
    function _addWindowLoadEvent(eventHandlerFn) {
        var oldonload = window.onload;

        if (typeof window.onload !== 'function') {
            window.onload = eventHandlerFn;
        } else {
            window.onload = function () {
                if (oldonload) {
                    oldonload();
                }

                if (typeof eventHandlerFn === 'function') {
                    eventHandlerFn();
                }
            }
        }
    }

    //Make sure that the provided `synchroSyncIframe` is called only once
    function DOMContentLoaded() {
        if (!DOMContentLoaded.wasCalled) {
            DOMContentLoaded.wasCalled = true;

            if (typeof synchroSyncIframe === 'function') {
                synchroSyncIframe();
            }
        }
    }

    function onReadyStateChangeHandler() {
        if (document.readyState === 'interactive') {
            document.detachEvent('onreadystatechange', onReadyStateChangeHandler);
            DOMContentLoaded();
        }
    }
}(com_adswizz_synchro_sync_iframe));

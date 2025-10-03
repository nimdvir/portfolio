window['OBPixelFrame'] =
  window['OBPixelFrame'] ||
  (function () {
    'use strict';
    var pub = {};

    pub.getQueryParam = function (key, defaultVal) {
      key = key.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
      var regexS, regex, results;
      try {
        regexS = '[\\?#&]' + key + '=([^&#]*)';
        regex = new RegExp(regexS, 'i');
        results = regex.exec(window.location.href);
        if (results === null) {
          return defaultVal;
        }
        return results[1];
      } catch (ex) {
        return defaultVal;
      }
    };

    pub.isHttps = function () {
      return location.protocol === 'https:';
    };

    pub.sendPixels = function () {
      var p = pub.getQueryParam('p', ''),
        advId = pub.getQueryParam('ai', ''),
        numberOfPixels = pub.getQueryParam('nop', ''),
        isHttps = pub.isHttps(),
        pixelSrc,
        pixels;
      if (p.length === 0) {
        return;
      }
      pixels = p.split('|');
      for (var i = 0; i < pixels.length; i += 1) {
        pixels[i] = decodeURIComponent(pixels[i]);
        if (pixels[i].indexOf('http://') >= 0 && isHttps) {
          pixelSrc = pixels[i].replace('http://', 'https://');
        } else if (pixels[i].indexOf('//') === 0) {
          pixelSrc = (isHttps ? 'https:' : 'http:') + pixels[i];
        } else if (pixels[i].indexOf('http') === -1) {
          pixelSrc = (isHttps ? 'https://' : 'http://') + pixels[i];
        } else {
          pixelSrc = pixels[i];
        }
        pub.sendSinglePixel(pixelSrc, advId, numberOfPixels);
      }
    };

    pub.sendSinglePixel = function (pixelSrc, advId, numberOfPixels) {
      var d = document;
      var inject = function () {
        var pixel = document.createElement('img');
        pixel.setAttribute('src', pixelSrc);
        pixel.setAttribute('height', '1');
        pixel.setAttribute('width', '1');
        pixel.setAttribute('display', 'none');
        if (pub.getQueryParam('attributionSrc')) {
          pixel.setAttribute('attributionsrc', '');
        }
        pixel.onerror = function () {
          pub.sendError(pixelSrc, advId, numberOfPixels);
        };
        d.body.appendChild(pixel);
      };
      if (d.body) {
        inject();
      } else {
        setTimeout(function () {
          d.body || inject();
        }, 10000);
      }
    };

    pub.sendError = function (pixel, advId, numberOfPixels) {
      var i,
        d = document;
      if (d.getElementById('obMntor')) {
        return;
      }
      var inject = function () {
        i = d.createElement('iframe');
        i.setAttribute('id', 'obMntor');
        i.style.display = 'none';
        d.body.appendChild(i);
      };
      if (d.body) {
        inject();
      } else {
        setTimeout(function () {
          d.body || inject();
        }, 10000);
      }

      var message = {
        url: encodeURIComponent(pixel),
        advId: advId,
        numberOfPixels: numberOfPixels,
      };

      i.src =
        'https://widgets.outbrain.com/widgetMonitor/monitor.html?name=' +
        encodeURIComponent('obm-PixelLoadingError') +
        '&message=' +
        JSON.stringify(message) +
        '&referrer=' +
        encodeURIComponent(document.referrer);
    };

    return pub;
  })();

window['OBPixelFrame'].sendPixels();

require('./bootstrap');

var Turbolinks = require("turbolinks");
Turbolinks.start();

jQuery(document.links).filter(function() {
    return this.hostname != window.location.hostname;
}).attr('target', '_blank').attr('rel','nofollow');
require('./bootstrap');

var Turbolinks = require("turbolinks");
Turbolinks.start();

jQuery(document.links).filter(function() {
    return this.hostname != window.location.hostname;
}).attr('target', '_blank').attr('rel','nofollow');

$(document).ready(function(){
    if(window.innerWidth < 768){
        $('.fullPage').removeClass('container');
    }
});
  
  $(window).resize(function(){
    if(window.innerWidth < 768){
        $('.fullPage').removeClass('container');
    }else{
        $('.fullPage').addClass('container');
    }
  });
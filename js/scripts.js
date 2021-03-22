/*!
    * Start Bootstrap - SB Admin v6.0.2 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
    $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
        if (this.href === path) {
            //$(this).addClass("active");
        }
    });
    $("#layoutSidenav_nav .sb-sidenav a.active").each(function() {
        nivel(this);
    });
    function nivel(a){
        var n = $(a.parentNode.parentNode).attr('data-parent').substr(-1);
        $(a.parentNode.parentNode).prev('a').click();
        if(n!=1){
            nivel(a.parentNode.parentNode);
        }
    }
    

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
    $("#btnmenu").on('click',function(e){
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);


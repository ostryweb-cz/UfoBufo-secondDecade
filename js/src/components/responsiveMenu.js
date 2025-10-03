import $ from "jquery";


export function responsiveMenu() {
    let body = $("body");
    let hamburgerMenu = $(".topHeaderMenuToggle");
    let menu = $(".topHeaderMenu");
    let menuItem = $(".menu-item");

    hamburgerMenu.on('click', function() {
        menu.toggleClass("topHeaderMenu--open");
        $(this).toggleClass("topHeaderMenuToggle--open");

        if(hamburgerMenu.hasClass("topHeaderMenuToggle--open")){
            body.addClass( "bodyfixed" );
        } else {
            body.removeClass( "bodyfixed" );

        }
    });


    menuItem.on('click', function() {
        menu.removeClass("topHeaderMenu--open");
        hamburgerMenu.removeClass("topHeaderMenuToggle--open");
        body.removeClass("bodyfixed");
    });

}

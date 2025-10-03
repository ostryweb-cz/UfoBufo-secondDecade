import $ from "jquery";



export function trimItems() {

    $(window).load(function() {

         $('.lineupItem p').each(function() {
            let text = $(this).text();
            $(this).text(text.substr(10).slice(0, -3));

        });

        $('.playAt span').each(function() {
            let text = $(this).text();
            $(this).text(text.slice(0, -3));

        });


    });
}

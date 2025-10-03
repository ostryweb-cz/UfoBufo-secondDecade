import $ from "jquery";



export function moveItems() {

    $(window).load(function() {



         $('.main-stage > .lineupItem').each(function(){
            let date = $('p', this).text().slice(0 , -9);


            if (date === "2019-06-20") {
               $(".main-stage > .ct").append($(this)[0]);
            } else if (date === "2019-06-21") {
                $(".main-stage > .pa").append($(this)[0]);
            }else if (date === "2019-06-22") {
                $(".main-stage > .so").append($(this)[0]);
            }else {
                $(".main-stage > .ne").append($(this)[0]);
            }
        });

        $('.chillout-stage .lineupItem').each(function(){
            let date = $('p', this).text().slice(0 , -9);


            if (date === "2019-06-20") {
                $(".chillout-stage .ct").append($(this)[0]);
            } else if (date === "2019-06-21") {
                $(".chillout-stage .pa").append($(this)[0]);
            }else if (date === "2019-06-22") {
                $(".chillout-stage .so").append($(this)[0]);
            }else {
                $(".chillout-stage .ne").append($(this)[0]);
            }
         });

        $('.tribal-stage .lineupItem').each(function(){
            let date = $('p', this).text().slice(0 , -9);


            if (date === "2019-06-20") {
                $(".tribal-stage .ct").append($(this)[0]);
            } else if (date === "2019-06-21") {
                $(".tribal-stage .pa").append($(this)[0]);
            }else if (date === "2019-06-22") {
                $(".tribal-stage .so").append($(this)[0]);
            }else {
                $(".tribal-stage .ne").append($(this)[0]);
            }
        });






    });
}

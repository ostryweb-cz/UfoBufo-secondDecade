import $ from "jquery";

export function toggleLineUp() {
    let lineUpToggle = $(".toggleLineUp");
    let lineUpToggleSpan = $(".toggleLineUp span");

    let list = $(".list-view");
    let lineUp = $(".lineUp-view");

    lineUpToggle.on('click', function() {

        // list.toggleClass("list-view--hidden");
        // lineUp.toggleClass("lineUp-view--hidden");

        $(this).parent().prev().prev().toggleClass("list-view--hidden");
        $(this).parent().prev().toggleClass("lineUp-view--hidden");
        $(this).children().toggleClass("hidden");


    });



    $(function(){
        let number = [];

        $('.main-stage > .lineupItem').each(function(){

            let numArr = [];
            //
            numArr.push($('p', this).text().slice(0, -3));
            numArr.push($(this));
            number.push(numArr);
            number.sort();
        });


        $( document ).ready(function() {
            for(let i=0; i<number.length; i++){
                $('.lineUp-view.main-stage').append(number[i][1]);
            }
        });



    });

    $(function(){
        let number = [];

        $('.chillout-stage .lineupItem').each(function(){

            let numArr = [];
            //
            numArr.push($('p', this).text().slice(0, -3));
            numArr.push($(this));
            number.push(numArr);
            number.sort();
        });


        $( document ).ready(function() {
            for(let i=0; i<number.length; i++){
                $('.lineUp-view.chillout-stage').append(number[i][1]);
            }
        });



    });


    $(function(){
        let number = [];

        $('.tribal-stage .lineupItem').each(function(){

            let numArr = [];
            //
            numArr.push($('p', this).text().slice(0, -3));
            numArr.push($(this));
            number.push(numArr);
            number.sort();
        });


        $( document ).ready(function() {
            for(let i=0; i<number.length; i++){
                $('.lineUp-view.tribal-stage').append(number[i][1]);
            }
        });



    });
}

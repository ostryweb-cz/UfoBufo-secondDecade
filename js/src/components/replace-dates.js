import $ from "jquery";


export function replaceDates() {

    let dateContainer = $('.playAt');

        $(document).ready(function () {
            if(window.location.href.indexOf("/en/") > -1) {
                dateContainer.each(function() {
                    let date = $(this).text();

                    if(date.indexOf("2019-06-20")) {
                        let dateNew = $(this).text().replace('2019-06-20', 'Thursday');
                        $(this).text(dateNew);
                    }
                    if(date.indexOf("2019-06-21")) {
                        let dateNew = $(this).text().replace('2019-06-21', 'Friday');
                        $(this).text(dateNew);
                    }
                    if(date.indexOf("2019-06-22")) {
                        let dateNew = $(this).text().replace('2019-06-22', 'Saturday');
                        $(this).text(dateNew);
                    }
                    if(date.indexOf("2019-06-23")) {
                        let dateNew = $(this).text().replace('2019-06-23', 'Sunday');
                        $(this).text(dateNew);
                    }

                });
            } else {
                dateContainer.each(function() {
                    let date = $(this).text();

                    if(date.indexOf("2019-06-20")) {
                        let dateNew = $(this).text().replace('2019-06-20', 'Čtvrtek');
                        $(this).text(dateNew);
                    }
                    if(date.indexOf("2019-06-21")) {
                        let dateNew = $(this).text().replace('2019-06-21', 'Pátek');
                        $(this).text(dateNew);
                    }
                    if(date.indexOf("2019-06-22")) {
                        let dateNew = $(this).text().replace('2019-06-22', 'Sobota');
                        $(this).text(dateNew);
                    }
                    if(date.indexOf("2019-06-23")) {
                        let dateNew = $(this).text().replace('2019-06-23', 'Neděle');
                        $(this).text(dateNew);
                    }

                });
            }
        });










    dateContainer.each(function() {
        let text = $(this).text();
        $(this).text(text.slice(0, -3));

    });

}

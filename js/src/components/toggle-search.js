import $ from "jquery";

export function toggleSearch() {
    let body = $(".site");
    let searchButton = $(".header-search");
    let menu = $(".topHeaderMenu");
    let menuHidden = $("topHeaderMenu--hidden");
    let searchForm = $(".topHeaderSearch");
    let searchInput = $(".s");

    $("input").keydown(function(){
        $("button.button").addClass('button--active');
    });


    searchButton.on('click', function(event) {
        menu.addClass("topHeaderMenu--hidden");
        searchForm.removeClass("topHeaderSearch--hidden");
        searchInput.focus();
        $(this).addClass("hidden");
        event.preventDefault();
    });


    body.on("click", (event) => {
        if ($(event.target).closest(menuHidden).length === 0) {
            menu.removeClass("topHeaderMenu--hidden");
            searchForm.addClass("topHeaderSearch--hidden");
            searchButton.removeClass("hidden");
        }
    });
}


var elements = document.querySelectorAll('.wp-block-gallery .wp-block-image a');

elements.forEach(function(element) {
    element.classList.add('fancybox');
});

const mapButton = document.querySelector('.map');
if (mapButton) {
    mapButton.addEventListener('click', function() {
        gtag('event', 'find_location', {
            'method': 'google_maps'
        });
    });
}

document.addEventListener('click', function(event) {
    var langLink = event.target.closest('.lang-item a');
    if (langLink) {
        var selectedLang = langLink.innerText.trim() || langLink.getAttribute('hreflang');
        gtag('event', 'change_language', {
            'language_name': selectedLang,
            'method': 'header_switcher'
        });
    }
}, true);

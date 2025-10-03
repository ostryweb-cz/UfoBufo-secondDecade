var elements = document.querySelectorAll('.wp-block-gallery .wp-block-image a');

elements.forEach(function(element) {
    element.classList.add('fancybox');
});
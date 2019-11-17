console.log('main page js loaded');
$(document).ready(function () {

    var document_height = document.documentElement.clientHeight;
    var section_1 = document.getElementById('section_1');
    // section_1.height = document_height;
    section_1.style.height = document_height + 'px';

    window.addEventListener('resize',function () {
        document_height = document.documentElement.clientHeight;
        section_1 = document.getElementById('section_1');
        // section_1.height = document_height;
        section_1.style.height = document_height + 'px';
        console.log('dd')
    })

});

function mp_scroll() {
    $('html, body').animate({
        scrollTop: $(".mp_collections_block").offset().top
    }, 1500);
}


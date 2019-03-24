var popUp = new function () {


};

popUp.width = '';
popUp.height = '';

popUp.show = function (html) {

    if (html == '' || html == 'undefined') return;

    var bg = document.createElement('div');
    bg.className = 'popup_bg';

    var container = document.createElement('div');
    container.className = 'popup_container';
    container.innerHTML = html;

    bg.appendChild(container);

    $('body').append(bg);


};

popUp.close = function () {
    $('.popup_bg').remove();
    $('body').removeAttr('style');
};

popUp.stopPropagation = function (e) {
    e.stopPropagation();
};

popUp.timerLimit = false;

popUp.zoomTrigger = function () {

    var zoom_status = Number($('.popup_zoom').attr('data-zoom'));
    if (zoom_status) {

        $('.popup_container').removeClass('zoom_in').addClass('zoom_out');
        $('.popup_zoom').attr('data-zoom', 0).text('');

    } else {
        $('.popup_container').removeClass('zoom_out').addClass('zoom_in');
        $('.popup_zoom').attr('data-zoom', 1).text('');
    }

};

popUp.portfolioFull = function (obj) {

    var img_id = Number($(obj).attr('data-id'));
    if (img_id == null || isNaN(img_id)) {
        return
    }
    var min_img_id = Number($('img[data-type=gallery]:first-child').attr('data-id'));
    var max_img_id = Number($('img[data-type=gallery]:last').attr('data-id'));
    var img_path = $('img[data-id=' + img_id + ']').attr('data-src');
    if (img_path == '' || img_path == undefined) {
        img_path = $('img[data-id=' + img_id + ']').attr('src');
    }

    this.prev_img = function () {
        img_id -= 1;
        if (img_id < min_img_id) img_id = max_img_id;
        $('#popUpimg').attr('src', $('img[data-id="' + img_id + '"][data-type=gallery]').attr('data-src'));
    };

    this.next_img = function () {
        img_id += 1;
        if (img_id > max_img_id) img_id = min_img_id;
        $('#popUpimg').attr('src', $('img[data-id="' + img_id + '"][data-type=gallery]').attr('data-src'));
    };


    var bg = document.createElement('div');
    bg.className = 'popup_bg noselect';
    bg.onclick = function () {
        popUp.close()
    };

    var container = document.createElement('div');
    container.className = 'popup_container zoom_out';

    container.innerHTML = "<img id=popUpimg src='" + img_path + "' onclick='popUp.stopPropagation(event);popUp.next_img()'>";

    var arrow_left = document.createElement('div');
    arrow_left.className = 'popu_nav_btn popu_nav_left';
    arrow_left.setAttribute('onclick', 'popUp.prev_img()');
    arrow_left.innerHTML = '';

    var arrow_right = document.createElement('div');
    arrow_right.className = 'popu_nav_btn popu_nav_right';
    arrow_right.setAttribute('onclick', 'popUp.next_img()');
    arrow_right.innerHTML = '';

    var resize = document.createElement('div');
    resize.className = 'popup_zoom';
    resize.setAttribute('data-zoom', 0);
    resize.setAttribute('onclick', 'popUp.zoomTrigger()');
    resize.innerHTML = '';

    var nav_bar = document.createElement('div');
    nav_bar.className = 'nav_bar';
    nav_bar.setAttribute('onclick', 'popUp.stopPropagation(event)');

    var popup_nav_bar_inner = document.createElement('div');
    popup_nav_bar_inner.className = 'popup_nav_bar_inner';

    var close_btn = document.createElement('span');
    close_btn.setAttribute('onclick', 'popUp.close()');
    close_btn.innerHTML = '';

    popup_nav_bar_inner.appendChild(arrow_left);
    popup_nav_bar_inner.appendChild(resize);
    popup_nav_bar_inner.appendChild(close_btn);
    popup_nav_bar_inner.appendChild(arrow_right);

    nav_bar.appendChild(popup_nav_bar_inner);


    container.appendChild(nav_bar);
    bg.appendChild(container);

    $('body').append(bg).css('overflow', 'hidden');
    $('.popup_close_inner').css({
        'max-width': $('.popup_container').width() + 'px',
        'width': '100%'
    });

    this.event_listner = document.addEventListener('keydown', function (e) {
        if (e.keyCode == 37) {

            popUp.prev_img();

        } else if (e.keyCode == 39) {

            popUp.next_img();

        } else if (e.keyCode == 27) {
            popUp.close();
        }
    });

};



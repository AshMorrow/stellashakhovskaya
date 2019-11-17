console.log('all.js loaded');

window.onload = function () {
    $('#preloader').fadeOut('normal', function () {
        $('#preloader').remove();
    });
}

$(document).ready(function () {


    // window.setTimeout(function () {
    //
    // }, 300);

    if ($('#mm_top_container').attr('on-main') == 1) {
        $('#mm_top_container').css('display', 'none')
    }

    // $(document).on('scroll', function () {
    //
    //     if ($(document).scrollTop() > 150 && $('.main_menu_scrolled').length == 0) {
    //         $('#mm_top_container').addClass('main_menu_scrolled').css('display', 'none')
    //             .stop().slideDown('normal', function () {
    //         })
    //     } else if ($(document).scrollTop() < 150 && $('#mm_top_container').hasClass('main_menu_scrolled')) {
    //         $('#mm_top_container').stop().slideUp('fast', function () {
    //                 $(this).removeClass('main_menu_scrolled');
    //                 if ($(this).attr('on-main') == 1) {
    //                     $(this).css('display', 'none')
    //                 } else {
    //                     $(this).removeAttr('style')
    //                 }
    //             }
    //         );
    //
    //     }
    // });

    if ($('#mm_top_container').attr('on-main') == 1) {
        $(document).on('scroll', function () {

            if ($(document).scrollTop() > 150 && $('.main_menu_scrolled').length == 0 && $('.mp_nav_container').is(':visible')) {

                $('#mm_top_container').addClass('main_menu_scrolled').css('display', 'none')
                    .stop().slideDown('normal', function () {
                })


            } else if ($(document).scrollTop() < 150 && $('#mm_top_container').hasClass('main_menu_scrolled')) {
                $('#mm_top_container').stop().slideUp('fast', function () {
                        $(this).removeClass('main_menu_scrolled');
                        $(this).css('display', 'none')
                    }
                );

            }
        });
    }

});

function select_dress(obj) {
    $('#dress_photo_list').find('.active').removeClass('active');
    $(obj).addClass('active');
    $(obj).find('.active:after').animate({
        opacity: 0.25,
        left: "+=50",
        height: "toggle"
    }, 5000, function () {
        // Animation complete.
    });
    var img_src = $(obj).find('img').attr('src');
    var img_id = $(obj).find('img').attr('data-id');
    $('#main_dress_photo').find('img').attr('src', img_src).attr('onclick', 'popUp.portfolioFull(this)').attr('data-src', img_src).attr('data-id', img_id);
}

/*** Cookies ***/

function getCookie(name) {
    var matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function setCookie(name, value, options) {
    options = options || {};

    var expires = options.expires;

    if (typeof expires == "number" && expires) {
        var d = new Date();
        d.setTime(d.getTime() + expires * 1000);
        expires = options.expires = d;
    }
    if (expires && expires.toUTCString) {
        options.expires = expires.toUTCString();
    }

    value = encodeURIComponent(value);

    var updatedCookie = name + "=" + value;

    for (var propName in options) {
        updatedCookie += "; " + propName;
        var propValue = options[propName];
        if (propValue !== true) {
            updatedCookie += "=" + propValue;
        }
    }

    document.cookie = updatedCookie;
}

function deleteCookie(name) {
    setCookie(name, "", {
        expires: -1,
        path: '/'
    })
}

/*** End Cookies ***/

function toFavorite() {
    var cookie_period = 3600 * 24 * 365 * 10;
    var favorite_dress = getCookie('favorite_dress');
    var dress_id = Number($('#add_to_favorite').attr('dress-id'));

    if ($('#add_to_favorite').attr('in-favorite') == 0) {
        if (favorite_dress) {
            favorite_dress = JSON.parse(favorite_dress);
            favorite_dress.dress.push(dress_id);
            setCookie('favorite_dress', JSON.stringify(favorite_dress), {
                expires: cookie_period,
                path: '/'
            });
            $('.mm_favorite').find('span').text(Number($('.mm_favorite').find('span').text()) + 1);
        } else {
            setCookie('favorite_dress', JSON.stringify({"dress": [dress_id]}), {
                expires: cookie_period,
                path: '/'
            });
            $('.mm_favorite div').append('<span>1</span>').find('a').addClass('active')
        }

        $('#add_to_favorite').attr('in-favorite', 1).addClass('dress_in_favorite')
            .find('.icon_heart_text').text('Удалить из избранного')

    } else {
        if (favorite_dress) {
            favorite_dress = JSON.parse(favorite_dress);
            for (var i = 0; i < favorite_dress.dress.length; i++) {
                if (favorite_dress.dress[i] == dress_id) {
                    favorite_dress.dress.splice(i, 1);
                    break;
                }
            }
            if (favorite_dress.dress.length) {
                setCookie('favorite_dress', JSON.stringify(favorite_dress), {
                    expires: cookie_period,
                    path: '/'
                });
                $('.mm_favorite').find('span').text(Number($('.mm_favorite').find('span').text()) - 1);
            } else {
                deleteCookie('favorite_dress');
                $('.mm_favorite').find('span').remove();
                $('.mm_favorite').find('a').removeClass('active');
            }

            $('#add_to_favorite').attr('in-favorite', 0).removeClass('dress_in_favorite')
                .find('.icon_heart_text').text('Добавить в избранное')
        }

    }
}

function removeFromFavorite(obj, drop) {

    var cookie_period = 3600 * 24 * 365 * 10;
    var favorite_dress = getCookie('favorite_dress');
    var dress_id = Number($(obj).attr('dress-id'));

    if (favorite_dress) {
        favorite_dress = JSON.parse(favorite_dress);
        for (var i = 0; i < favorite_dress.dress.length; i++) {
            if (favorite_dress.dress[i] == dress_id) {
                favorite_dress.dress.splice(i, 1);
                break;
            }
        }
        if (favorite_dress.dress.length) {
            setCookie('favorite_dress', JSON.stringify(favorite_dress), {
                expires: cookie_period,
                path: '/'
            });
            $('.mm_favorite').find('span').text(Number($('.mm_favorite').find('span').text()) - 1);
        } else {
            deleteCookie('favorite_dress');
            $('.mm_favorite').find('span').remove();
            $('.mm_favorite').find('a').removeClass('active');
        }
    }
    if (drop) {
        $(obj).parent().remove();
    } else {
        $(obj).attr('in-favorite', 0);
        $(obj).removeClass('delete_from_favorite').addClass('add_favorite')
            .attr('onclick', 'addToFavorite(this,false)').find('span:first-child').text('Добавить в избранное');
        $(obj).find('.icon').text('')
    }

}

function addToFavorite(obj) {
    var cookie_period = 3600 * 24 * 365 * 10;
    var favorite_dress = getCookie('favorite_dress');
    var dress_id = Number($(obj).attr('dress-id'));
    if (favorite_dress) {
        if ($(obj).attr('in-favorite') == 0) {
            favorite_dress = JSON.parse(favorite_dress);
            favorite_dress.dress.push(dress_id);
            setCookie('favorite_dress', JSON.stringify(favorite_dress), {
                expires: cookie_period,
                path: '/'
            });
            $('.mm_favorite').find('span').text(Number($('.mm_favorite').find('span').text()) + 1);
        }
    } else {
        setCookie('favorite_dress', JSON.stringify({"dress": [dress_id]}), {
            expires: cookie_period,
            path: '/'
        });
        $('.mm_favorite div').append('<span>1</span>').find('a').addClass('active')
        $(obj).attr('in-favorite', 0);
    }
    $(obj).attr('in-favorite', '1');
    $(obj).removeClass('add_favorite').addClass('delete_from_favorite')
        .attr('onclick', 'removeFromFavorite(this)').find('span:first-child').text('Удалить из избранного');

    console.log($(obj).attr('in-favorite'));
    $(obj).find('.icon').text('')
}


function showNotification(text, type) {

    var nt = $('#notifications_holder').append('<div class="nt_' + type + '">' + text + '</div>').find('div:last-child');

    if ($('#notifications_holder div').length > 4) {
        $('#notifications_holder div:first-child').remove();
    }
    window.setTimeout(function () {
        $(nt).fadeOut(function () {
            nt.remove();
        })
    }, 5000)
}


function sendMassage() {

    $('#massage_form').find('.msg_error').removeClass('msg_error');

    var name = $('#massage_form').find('input[name=name]').val().trim();
    var email = $('#massage_form').find('input[name=email]').val().trim();
    var phone = $('#massage_form').find('input[name=phone]').val().trim();
    var msg = $('#massage_form').find('textarea[name=msg]').val().trim();
    var error = 0;

    if (name == '') {
        $('#massage_form').find('input[name=name]').focus().addClass('msg_error');
        error += 1;
    }

    if (!(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email))) {
        $('#massage_form').find('input[name=email]').addClass('msg_error');
        error += 1;
    }

    if (msg == '') {
        $('#massage_form').find('textarea[name=msg]').addClass('msg_error');
        error += 1;
    }

    // console.log('name: ' + name);
    // console.log('email: ' + email);
    // console.log('phone: ' + phone);
    // console.log('msg: ' + msg);

    if (error > 0) {
        showNotification('Заполните все поля', 'error')
        return;
    }

    $('#massage_form').find('.msg_error').removeClass('msg_error');

    $.ajax({
        type: 'POST',
        url: "/send-massage",
        data: {
            "_token": $('#massage_form input').attr('value'),
            "name": name,
            "email": email,
            "phone": phone,
            "msg": msg
        },
        success: function (msg) {
            if (msg == 0) {
                showNotification('Сообщение отправленно', 'success');
                $('#massage_form input').val('');
                $('#massage_form textarea').val('');
            } else {
                showNotification('Упс, что-то пошло не так', 'error');
            }
        }
    })

}

function testMsg() {
    $('#massage_form').find('.msg_error').removeClass('msg_error');

    var name = $('#massage_form').find('input[name=name]').val().trim();
    var email = $('#massage_form').find('input[name=email]').val().trim();
    var phone = $('#massage_form').find('input[name=phone]').val().trim();
    var msg = $('#massage_form').find('textarea[name=msg]').val().trim();
    var error = 0;

    // if (name == '') {
    //     $('#massage_form').find('input[name=name]').focus().addClass('msg_error');
    //     error += 1;
    // }
    //
    // if (!(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email))) {
    //     $('#massage_form').find('input[name=email]').addClass('msg_error');
    //     error += 1;
    // }
    //
    // if (msg == '') {
    //     $('#massage_form').find('textarea[name=msg]').addClass('msg_error');
    //     error += 1;
    // }

    console.log('name: ' + name);
    console.log('email: ' + email);
    console.log('phone: ' + phone);
    console.log('msg: ' + msg);

    if (error > 0) {
        showNotification('Заполните все поля', 'error')
        return;
    }

    $('#massage_form').find('.msg_error').removeClass('msg_error');

    $.ajax({
        type: 'GET',
        url: "/send-massage",
        data: {
            "_token": $('#massage_form input').attr('value'),
            "name": "Lolita",
            "email": "lolita71@bk.ru",
            "phone": '',
            "msg": "Говорят, невозможно найти две абсолютно одинаковые жемчужины, доверим это проверять ювелирам. Но мы точно знаем, что каждая невеста в нашем свадебном платье – самая прекрасная, очаровательная и желанная. Мы дорожим нашим добрым именем, но прежде всего мы рады дарить вам уверенность в вашей красоте и неотразимости. Пусть с ощущения магии своей красоты, которое вы обретете в нaших cвадебных салoнах, начнется ваша счастливая семейная жизнь."
        },
        success: function (msg) {
            if (msg == 0) {
                showNotification('Сообщение отправленно', 'success');
                $('#massage_form input').val('');
                $('#massage_form textarea').val('');
            } else {
                showNotification('Упс, что-то пошло не так', 'error');
            }
        }
    })
}
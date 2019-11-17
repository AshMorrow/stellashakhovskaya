var mobile_menu = new function () {


    this.show = function () {

        if ($('#m_menu_container').length == 0) {

            var m_menu_event_container = document.createElement('div');
            m_menu_event_container.id = 'm_menu_event_container';
            m_menu_event_container.onclick = mobile_menu.close();
            m_menu_event_container.addEventListener('click',function () {
                mobile_menu.close();
            });


            var m_menu_container = document.createElement('div');
            m_menu_container.id = 'm_menu_container';
            m_menu_container.onclick = function (e) {
                e.stopPropagation();
            };
            m_menu_container.setAttribute('style', "left: -300px");

            var m_menu_inner = document.createElement('div');
            m_menu_inner.id = 'm_menu_inner';
            m_menu_inner.innerHTML = $('#mm_top_container .main_menu').html();

            var m_menu_logo = document.createElement('div');
            m_menu_logo.id = 'm_menu_logo';
            m_menu_logo.innerHTML = $('#mm_top_container .logo').html();

            var m_menu_favorite = document.createElement('div');
            m_menu_favorite.id = 'm_menu_favorite';
            m_menu_favorite.className = 'mm_favorite';
            m_menu_favorite.innerHTML = $('#mm_top_container .mm_favorite').html();

            var m_menu_social = document.createElement('div');
            m_menu_social.id = 'm_menu_social';
            m_menu_social.innerHTML = $('#mm_top_container .mm_social_buttons').html();

            m_menu_container.appendChild(m_menu_logo);
            m_menu_container.appendChild(m_menu_inner);
            m_menu_container.appendChild(m_menu_favorite);
            m_menu_container.appendChild(m_menu_social);


            $('body').append(m_menu_event_container).append(m_menu_container);

            $('#m_menu_container').animate({
                left: 0
            },500);

            var body = document.getElementsByTagName('body');


        }else{
           this.close();
        }
    };

    this.close = function () {
        $('#m_menu_container').animate({
            left: '-=300'
        },500,function () {
            $('#m_menu_event_container').remove();
            $('#m_menu_container').remove();
        });

    }

};



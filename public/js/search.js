var searchEvents = new function() {

    var eventHolder;

    this.startEvent = function () {
        searchEvents.eventHolder = document.addEventListener('keypress',function (e) {
            if(e.keyCode == 13){
                startSearch()
            }
        })
    };

    this.stopEvent = function () {
        document.removeEventListener('keypress',searchEvents.eventHolder);
    }
};

function startSearch() {

    var searchText = document.getElementById('search_dress_input').value.trim().split(' '),
        searchLength,
        searchJSHON = {};

    searchText = searchText.filter(function ( lement ) {
        return Boolean(lement);
    });

    searchLength = searchText.length;

    if(searchLength == 0){
        showNotification('Введите данные для поиска','error');
        return;
    }else if(searchLength > 2){
        showNotification('Можно передать только 2 параметра','error');
        return;
    }else if(searchLength == 2){

        if(!Boolean(Number(searchText[1]))){
            showNotification('Вторым параметром должем вытупать номер платья','error');
            return;
        }

        searchJSHON.searchType = 2;
    }else{
        searchJSHON.searchType = 1;
    }

    searchJSHON.data = searchText;

    $.ajax({
        type: 'GET',
        url: "/search_get_dress",
        data: searchJSHON,
        success: function (data) {

            // console.log(data);
            showSearchResult(JSON.parse(data));

        }
    })
}

function showSearchResult(searchResults) {

    var container = document.getElementById('search_results'),
        dressTile,
        dressLink,
        dressImage,
        dressName;

    container.innerHTML = '';
    
    searchResults.map(function (dress) {

        if(dress.name == null) dress.name = '';

        dressTile = document.createElement('div');
        dressTile.className = 'collection_tile';

        dressLink = document.createElement('a');
        dressLink.setAttribute('href', `/collections/${dress.cm_url}/${dress.c_url}/${dress.dress_code}`);

        dressImage = document.createElement('img');
        dressImage.setAttribute('src', `/storage/collections_img/${dress.cm_id}/${dress.c_id}/thumb/${dress.dress_code}/front.jpg`);

        dressName = document.createElement('div');
        dressName.className = 'collection_tile_label';
        dressName.textContent = `${dress.name} ${dress.dress_code}`;

        dressLink.appendChild(dressImage);
        dressLink.appendChild(dressName);

        dressTile.appendChild(dressLink);

        container.appendChild(dressTile);


    });

    for (var i = 0; i < 4; i++){
        dressTile = document.createElement('div');
        dressTile.className = 'empty_collection_tile';

        container.appendChild(dressTile);
    }
    

}
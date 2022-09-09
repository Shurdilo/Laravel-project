$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function loadMoreData(page)
{
    $.ajax({
        url:'?page=' + page,
        type:'get',
        beforeSend: function()
        {
            $(".ajax-load").show();
        }
    })
    .done(function(data){
        if(data.html == " "){
            $('.ajax-load').html("Нема више вијести");
            return;
        }
        $('.ajax-load').hide();
        $("#news").append(data.html);
    })
    .fail(function(jqXHR,ajaxOptions,thrownError){
        alert("Сервер не реагује");
    });
}

var page = 1;
$(window).scroll(function(){
    if($(window).scrollTop() + $(window).height() >= $(document).height()){
        page++;
        loadMoreData(page);
    }
});
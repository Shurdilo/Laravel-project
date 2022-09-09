$(document).ready(function(){
    // Delete hero Image
    $(".confirmDeleteHero").click(function(){
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Да ли сте сигурни?',
            text: "Нећете бити у могућности да вратите ову фотографију!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8f7655',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Да, обриши!',
            cancelButtonText: 'Одустани'
          }).then((result) => {
            if (result.value) {
                window.location.href="/admin/settings/delete-hero/"+recordid;
            }
        });
    });
});

$(document).ready(function(){
    // Set hero Image
    $(".selectHero").click(function(){
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Да ли сте сигурни?',
            text: "Ова слика ће бити постављена за насловну фотографију!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8f7655',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Да, постави!',
            cancelButtonText: 'Одустани'
          }).then((result) => {
            if (result.value) {
                window.location.href="/admin/settings/set-hero/"+recordid;
            }
        });
    });
});

$(document).ready(function(){
    // Skip add Images
    $(".skip").click(function(){
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Да ли сте сигурни да желите да прескочите?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8f7655',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Да, прескочи!',
            cancelButtonText: 'Одустани'
          }).then((result) => {
            if (result.value) {
                window.location.href="/admin/news/skip-news/"+recordid;
            }
        });
    });
});

$(document).ready(function(){
    // Update News Status
    $(".updateNewsStatus").click(function(){
        var status = $(this).text();
        var news_id = $(this).attr("news_id");
        $.ajax({
            type:'post',
            url:'/admin/news/update-news-status',
            data:{status:status,news_id:news_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#news-"+news_id).html("Нективан");
                    $("#news-"+news_id).css("color", "var(--red)");
                }else if(resp['status']==1){
                    $("#news-"+news_id).html("Активан");
                    $("#news-"+news_id).css("color", "var(--green)");
                }
            },error:function(){
                alert("Сервер не реагује");
            }
        });
    });
});

$(document).ready(function(){
    // Delete hero Image
    $(".confirmDeleteNews").click(function(){
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Да ли сте сигурни?',
            text: "Нећете бити у могућности да вратите ову вијест!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8f7655',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Да, обриши!',
            cancelButtonText: 'Одустани'
          }).then((result) => {
            if (result.value) {
                window.location.href="/admin/news/delete-news/"+recordid;
            }
        });
    });
});

$(document).ready(function(){
    // Delete hero Image
    $(".confirmDeleteNewsTitleImage").click(function(){
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Да ли сте сигурни?',
            text: "Нећете бити у могућности да вратите ову фотографију!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8f7655',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Да, обриши!',
            cancelButtonText: 'Одустани'
          }).then((result) => {
            if (result.value) {
                window.location.href="/admin/news/delete-news-title-image/"+recordid;
            }
        });
    });
});

$(document).ready(function(){
    // Delete hero Image
    $(".confirmDeleteNewsImage").click(function(){
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Да ли сте сигурни?',
            text: "Нећете бити у могућности да вратите ову фотографију!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8f7655',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Да, обриши!',
            cancelButtonText: 'Одустани'
          }).then((result) => {
            if (result.value) {
                window.location.href="/admin/news/delete-news-image/"+recordid;
            }
        });
    });
});

$(document).ready(function(){
    // Update Image Status
    $(".updateNewsImageStatus").click(function(){
        var status = $(this).text();
        var image_id = $(this).attr("image_id");
        $.ajax({
            type:'post',
            url:'/admin/news/update-news-image-status',
            data:{status:status,image_id:image_id},
            success:function(resp){
                if(resp['status']==0){
                    $("#image-"+image_id).html("Нективна");
                    $("#image-"+image_id).css("color", "var(--red)");
                }else if(resp['status']==1){
                    $("#image-"+image_id).html("Активна");
                    $("#image-"+image_id).css("color", "var(--green)");
                }
            },error:function(){
                alert("Сервер не реагује");
            }
        });
    });
});

$(document).ready(function(){
    $(".message-card").click(function(){
        var message_id = $(this).attr("message_id");
        var status = $(this).attr("status");
        $.ajax({
            type:'post',
            url:'/admin/messages/update-message-status',
            data:{status:status,message_id:message_id},
            success:function(){
                window.location.href="/admin/messages/message/"+message_id;
            },error:function(){
                alert("Сервер не реагује");
            }
        });     
    });
});

$(document).ready(function(){
    // Delete hero Image
    $(".confirmDeleteMessage").click(function(){
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Да ли сте сигурни?',
            text: "Нећете бити у могућности да вратите ову поруку!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8f7655',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Да, обриши!',
            cancelButtonText: 'Одустани'
          }).then((result) => {
            if (result.value) {
                window.location.href="/admin/messages/delete-message/"+recordid;
            }
        });
    });
});

$(document).ready(function(){
    // Delete hero Image
    $(".confirmDeleteAdmin").click(function(){
        var recordid = $(this).attr("recordid");
        Swal.fire({
            title: 'Да ли сте сигурни?',
            text: "Нећете бити у могућности да вратите овог админа!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#8f7655',
            cancelButtonColor: 'transparent',
            confirmButtonText: 'Да, обриши!',
            cancelButtonText: 'Одустани'
          }).then((result) => {
            if (result.value) {
                window.location.href="/admin/admins/delete-admin/"+recordid;
            }
        });
    });
});
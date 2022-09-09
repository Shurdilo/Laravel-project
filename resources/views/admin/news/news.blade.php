@extends('admin.layout.layout')
@section('content')


<div class="tableContainer">
    <div class="headTab">
        <h3>Новости</h3>
        <a id="add" href="news/add-news"><i class="fas fa-plus"></i><p>Додај вијест</p></a>
    </div>
    <table id="myTable" class="hover stripe cell-border">
        <thead>
            <tr>
                <th>ID</th>
                <th>Наслов</th>
                <th>Насловна фотографија</th>
                <th>Опције</th>
                <th>Статус</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($news as $new)
            <tr>
                <td>{{$new->id}}</td>
                <td class="title">{{$new->title}}</td>
                <td><img onclick="myModal(this)" class="myImg" src="{{ asset('front/images/news/cover/'.$new->titleimage) }}" alt="Слика није пронађена" dataDesc="{{$new->title}}"></td>
                <td>
                    <div class="options">
                        <a href="news/edit-news/{{$new->id}}" title="Ажурирај вијест"><i class="fas fa-edit"></i></a>
                        <a href="javascript:void(0)" class="confirmDeleteNews" recordid="{{ $new->id }}" title="Избриши вијест"><i class="fas fa-trash-alt"></i></a>
                    </div>
                </td>
                <td>
                    @if($new['status']==1) <a class="updateNewsStatus" id="news-{{ $new->id }}" news_id="{{ $new->id }}" href="javascript:void(0)" style="color: var(--green)">Активан</a>
                    @else <a class="updateNewsStatus" id="news-{{ $new->id }}" news_id="{{ $new->id }}" href="javascript:void(0)" style="color: var(--red)">Нективан</a>
                    @endif
                </td>
            </tr>
            @endforeach 
        </tbody>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Наслов</th>
                <th>Насловна фотографија</th>
                <th>Опције</th>
                <th>Статус</th>
            </tr>
        </tfoot>
    </table>
</div> 

<div id="myModal" class="modal">
    <div class="close-outside"></div>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

@endsection

@section('scripts')

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the image and insert it inside the modal - use its "alt" text as a caption
    var img = document.getElementById("myImg");
    var modalImg = document.getElementById("img01");
    var captionText = document.getElementById("caption");
    function myModal(elmnt){
        modal.style.display = "flex";
        modalImg.src = elmnt.src;
        captionText.innerHTML = elmnt.getAttribute('dataDesc');
    }

    // Get the <span> element that closes the modal
    var close = document.getElementsByClassName("close-outside")[0];

    // When the user clicks on <span> (x), close the modal
    close.onclick = function() { 
        modal.style.display = "none";
    }
</script>

@endsection
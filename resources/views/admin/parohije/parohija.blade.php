@extends('admin.layout.layout')
@section('content')

<div id="myModal" class="modal">
    <div class="close-outside"></div>
    <img class="modal-content" id="img01">
    <div id="caption"></div>
</div>

<div class="edit-parohija">
    <h3>Ажурирање парохије</h3>
    <form action="{{ url('admin/parohije/parohija/'.$parohije->id) }}" method="post" enctype="multipart/form-data">@csrf
        <div class="form-group">
            <input type="file" id="custom-file-input" name="paroh_image" accept="image/*" hidden>
            <button type="button" id="custom-button">Изаберите фотографију</button>
            <span id="custom-text">Нисте одабрали фотографију.</span>
            <input type="hidden" name="current_paroh_image" value="{{ $parohije->paroh_image }}">
        </div>
        <div class="image-preview" id="imagePreview">
            <img src="" alt="Преглед слике" class="image-preview-image">
            <span class="image-preview-default-text">Преглед слике</span>
        </div>
        @if($parohije->paroh_image != "")
            <div class="form-group parohimage">
                <img onclick="myModal(this)" class="myImg" src="{{ asset('front/images/parohije/'.$parohije->paroh_image) }}" alt="Слика није пронађена" style="cursor: pointer; object-fit: cover; width: 63.73px; height: 63.73px; border-radius:50%">
                <a href="javascript:void(0)" class="confirmDeleteParohImage" recordid="{{ $parohije->id }}" title="Обриши слику"><i class="fas fa-times"></i></a>
            </div>
        @endif
        <div class="form-group">
            <label>Име парохије</label>
            <input id="name" name="name" type="text" placeholder="I парохија мокрањска" class="form-control" value="{{ $parohije->name }}">
        </div>
        <div class="form-group">
            <label>Име пароха</label>
            <input id="paroh" name="paroh" type="text" placeholder="Протојереј Марко Марковић" class="form-control" value="{{ $parohije->paroh }}">
        </div>
        <div class="form-group">
            <label>Борј пароха</label>
            <input id="paroh_phone" name="paroh_phone" type="text" placeholder="+38766000000" class="form-control" value="{{ $parohije->paroh_phone }}">
        </div>
        <div class="form-group">
            <label>Е-маил пароха</label>
            <input id="paroh_email" name="paroh_email" type="email" placeholder="markomarkovic@crkvamokro.org" class="form-control" value="{{ $parohije->paroh_email }}">
        </div>
        <div class="ck-group">
            <label>О пароху</label>
            <textarea name="about" id="abouttext" cols="30">{!! $parohije->about !!}</textarea>
        </div>
        <button id="submit" class="submit button">Ажурирај</button>
    </form>
</div>

<script>
    const realFileBtn = document.getElementById("custom-file-input");
    const customTxt = document.getElementById("custom-text");
    const customBtn = document.getElementById("custom-button");
    
    const previewContainer = document.getElementById("imagePreview");
    const previewImage = previewContainer.querySelector(".image-preview-image");
    const previewDefaultText = previewContainer.querySelector(".image-preview-default-text");

    customBtn.addEventListener("click", function(){
        realFileBtn.click();
    });

    customTxt.addEventListener("click", function(){
        realFileBtn.click();
    });

    realFileBtn.addEventListener("change", function(){
        if(realFileBtn.value){
            customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
        }else{
            customTxt.innerHTML = "Нисте одабрали фотографију.";
        }
    });

    realFileBtn.addEventListener("change", function(){
        const file = this.files[0];

        if(file){
            const reader = new FileReader();

            previewDefaultText.style.display = "none";
            previewImage.style.display = "block";
            previewContainer.style.width = "fit-content";
            previewContainer.style.justifyContent = "unset";

            reader.addEventListener("load", function(){
                previewImage.setAttribute("src", this.result);
            });

            reader.readAsDataURL(file);
        }else{
            previewDefaultText.style.display = null;
            previewImage.style.display = null;
            previewContainer.style.width = null;
            previewContainer.style.justifyContent = null;
            previewImage.setAttribute("src", "");
        }
    });
</script>
@endsection
@section('scripts')
<script>
    let editor;
    
    ClassicEditor
        .create( document.querySelector( '#abouttext' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'blockQuote', '|', 'undo', 'redo', ]
        } )
        .then( newEditor => {
            editor = newEditor;
        } )
        .catch( error => {
            console.error( error );
        } );
</script>

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
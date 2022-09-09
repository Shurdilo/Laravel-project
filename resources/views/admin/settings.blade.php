@extends('admin.layout.layout')
@section('content')

    <div id="myModal" class="modal">
        <div class="close-outside"></div>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <div class="hero-images">
        <h3>Насловна фотографија</h3>
        <div class="add-hero-image">
            <form action="{{ url('admin/settings') }}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <input type="file" id="custom-file-input" name="heroimage" accept="image/*" hidden>
                    <button type="button" id="custom-button">Изаберите фотографију</button>
                    <span id="custom-text">Нисте одабрали фотографију.</span>
                </div>
                <button class="submit">Отпреми</button>
            </form>
        </div>
        <div class="show-hero-images">
            @foreach ($heroes as $hero)
            <div class="hero-image @if($hero['status']=="1")active @endif">
                @if($hero['status']!="1")<a href="javascript:void(0)" class="confirmDeleteHero" recordid="{{ $hero->id }}" title="Избриши слику"><i class="fas fa-trash-alt"></i></a> @endif
                <a href="javascript:void(0)" class="selectHero" recordid="{{ $hero->id }}"><img src="{{ asset('front/images/hero/'.$hero->image) }}" alt="Слика није пронађена"></a>
            </div>
            @endforeach
        </div>
    </div>

    <div class="mitropolit">
        <h3>Митрополит</h3>
        @if ($errors->any())
            <div class="validationerror">
                <i class="fas fa-times slideUp"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('admin/settings/mitropolit/1') }}" method="post" enctype="multipart/form-data">@csrf
            <div class="form-group">
                <input type="file" id="custom-file-input1" name="mitroimage" accept="image/*" hidden>
                <button type="button" id="custom-button1">Изаберите фотографију</button>
                <span id="custom-text1">Нисте одабрали фотографију.</span>
                <input type="hidden" name="current_mitro_mitroimage" value="{{ $mitro->mitroimage }}">
            </div>
            <div class="image-preview" id="imagePreview">
                <img src="" alt="Преглед слике" class="image-preview-image">
                <span class="image-preview-default-text">Преглед слике</span>
            </div>
            @if($mitro->mitroimage != "")
                <div class="form-group mitroimage">
                    <img onclick="myModal(this)" class="myImg" src="{{ asset('front/images/'.$mitro->mitroimage) }}" alt="Слика није пронађена" style="cursor: pointer; object-fit: cover; width: 63.73px; height: 63.73px; border-radius:50%">
                    <a href="javascript:void(0)" class="confirmDeleteMitroImage" recordid="{{ $mitro->id }}" title="Обриши слику"><i class="fas fa-times"></i></a>
                </div>
            @endif
            <div class="form-group">
                <label>Име / Титула</label>
                <input id="name" name="name" type="text" placeholder="Име / Титула..." class="form-control" value="{{ $mitro->name }}">
            </div>
            <div class="ck-group">
                <label>Текст</label>
                <textarea name="mitrotext" id="mitrotext" cols="30">{!! $mitro->mitrotext !!}</textarea>
            </div>
            <button id="submit" class="submit button">Ажурирај</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        const realFileBtn = document.getElementById("custom-file-input");
        const customTxt = document.getElementById("custom-text");
        const customBtn = document.getElementById("custom-button");

        const realFileBtn1 = document.getElementById("custom-file-input1");
        const customTxt1 = document.getElementById("custom-text1");
        const customBtn1 = document.getElementById("custom-button1");

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

        customBtn1.addEventListener("click", function(){
            realFileBtn1.click();
        });

        customTxt1.addEventListener("click", function(){
            realFileBtn1.click();
        });

        realFileBtn1.addEventListener("change", function(){
            if(realFileBtn1.value){
                customTxt1.innerHTML = realFileBtn1.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
            }else{
                customTxt1.innerHTML = "Нисте одабрали фотографију.";
            }
        });

        previewContainer.addEventListener("click", function(){
            realFileBtn1.click();
        });

        realFileBtn1.addEventListener("change", function(){
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

        $(".slideUp").click(function() {
            $(".validationerror").slideUp();
        });
    </script>

    <script>
        let editor;
        
        ClassicEditor
            .create( document.querySelector( '#mitrotext' ), {
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
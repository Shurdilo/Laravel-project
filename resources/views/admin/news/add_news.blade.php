@extends('admin.layout.layout')
@section('content')

    <div class="add-news">
        <h3>Нова вијест</h3>
        @if ($errors->any())
            <div class="validationerror">
                <i class="fas fa-times"></i>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ url('admin/news/add-news') }}" method="post" enctype="multipart/form-data">@csrf
            <div class="form-group">
                <input type="file" id="custom-file-input" name="titleimage" accept="image/*" hidden>
                <button type="button" id="custom-button">Изаберите насловну фотографију</button>
                <span id="custom-text">Нисте одабрали фотографију.</span>
            </div>
            <div class="image-preview" id="imagePreview">
                <img src="" alt="Преглед слике" class="image-preview-image">
                <span class="image-preview-default-text">Преглед слике</span>
            </div>
            <div class="form-group">
                <label>Наслов вијести</label>
                <input id="title" name="title" type="text" placeholder="Наслов..." data-msg="Молимо вас унесите наслов вијести" class="form-control">
            </div>
            <div class="ck-group">
                <label>Текст</label>
                <textarea name="newstext" id="newstext" cols="30"></textarea>
            </div>
            <button id="submit" class="submit button">Даље</button>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        let editor;
        
        ClassicEditor
            .create( document.querySelector( '#newstext' ), {
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

        
        $(".fa-times").click(function() {
            $(".validationerror").slideUp();
        });
    </script>
@endsection
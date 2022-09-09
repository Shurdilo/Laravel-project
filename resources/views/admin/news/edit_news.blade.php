@extends('admin.layout.layout')
@section('content')

    <div id="myModal" class="modal">
        <div class="close-outside"></div>
        <img class="modal-content" id="img01">
        <div id="caption"></div>
    </div>

    <div class="edit-news">
        <div class="add-news">
            <h3>Ажурирање вијести</h3>
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
            <form action="{{ url('admin/news/edit-news/'.$news->id) }}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <input type="file" id="custom-file-input" name="titleimage" accept="image/*" hidden>
                    <button type="button" id="custom-button">Изаберите насловну фотографију</button>
                    <span id="custom-text">Нисте одабрали фотографију.</span>
                    <input type="hidden" name="current_news_titleimage" value="{{ $news->titleimage }}">
                </div>
                <div class="image-preview" id="imagePreview">
                    <img src="" alt="Преглед слике" class="image-preview-image">
                    <span class="image-preview-default-text">Преглед слике</span>
                </div>
                @if($news->titleimage != "")
                    <div class="form-group newstitleimage">
                        <img onclick="myModal(this)" class="myImg" src="{{ asset('front/images/news/cover/'.$news->titleimage) }}" alt="Слика није пронађена" style="cursor: pointer; object-fit: cover; width: 63.73px; height: 63.73px; border-radius:50%">
                        <a href="javascript:void(0)" class="confirmDeleteNewsTitleImage" recordid="{{ $news->id }}" title="Обриши слику"><i class="fas fa-times"></i></a>
                    </div>
                @endif
                <div class="form-group">
                    <label>Наслов вијести</label>
                    <input id="title" name="title" type="text" placeholder="Наслов..." data-msg="Молимо вас унесите е-маил" class="form-control" value="{{ $news->title }}">
                </div>
                <div class="ck-group">
                    <label>Текст</label>
                    <textarea name="newstext" id="newstext" cols="30">{!! $news->newstext !!}</textarea>
                </div>
                <button id="submit" class="submit button">Ажурирај</button>
            </form>
        </div>

        <div class="add-news">
            <h3>Алтернативне слике</h3>
            <form action="{{ url('admin/news/edit-news-images/'.$news->id) }}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <input type="file" id="custom-file-input1" name="newsimage[]" accept="image/*" hidden multiple="multiple">
                    <button type="button" id="custom-button1">Изаберите фотографије</button>
                    <span id="custom-text1">Нисте одабрали фотографије.</span>
                </div>
                <div class="form-group">
                    <input id="news_id" name="news_id" type="text" value="{{ Session::get('news_id') }}" hidden>
                </div>
                <div class="buttons">
                    <button class="submit1 button">Додај</button>
                </div>
            </form>
            <div class="show-alternative-images">
                <table id="myTable" class="hover stripe cell-border">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Фотографија</th>
                            <th>Опције</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($images as $image)
                        <tr>
                            <td>{{ $image->id }}</td>
                            <td><img onclick="myModal(this)" class="myImg" src="{{ asset('front/images/news/images/'.$image->newsimage) }}" alt="Слика није пронађена" dataDesc="{{$news->title}}"></td>
                            <td>
                                <a href="javascript:void(0)" class="confirmDeleteNewsImage" recordid="{{ $image->id }}" title="Избриши слику"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td>
                                @if($image['status']==1) <a class="updateNewsImageStatus" id="image-{{ $image->id }}" image_id="{{ $image->id }}" href="javascript:void(0)" style="color: var(--green)">Активна</a>
                                @else <a class="updateNewsImageStatus" id="image-{{ $image->id }}" image_id="{{ $image->id }}" href="javascript:void(0)" style="color: var(--red)">Нективна</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Фотографија</th>
                            <th>Опције</th>
                            <th>Статус</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
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

        previewContainer.addEventListener("click", function(){
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
                customTxt1.innerHTML = "Нисте одабрали фотографије.";
            }
        });

        
        $(".fa-times").click(function() {
            $(".validationerror").slideUp();
        });
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
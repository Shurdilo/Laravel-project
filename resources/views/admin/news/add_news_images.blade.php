@extends('admin.layout.layout')
@section('content')

    <div class="add-news">
        <h3>Алтернативне слике за нову вијест</h3>
        <form action="{{ url('admin/news/add-news-images') }}" method="post" enctype="multipart/form-data">@csrf
            <div class="form-group">
                <input type="file" id="custom-file-input" name="newsimage[]" accept="image/*" hidden multiple="multiple">
                <button type="button" id="custom-button">Изаберите фотографије</button>
                <span id="custom-text">Нисте одабрали фотографије.</span>
            </div>
            <div class="form-group">
                <input id="news_id" name="news_id" type="text" value="{{ Session::get('news_id') }}" hidden>
            </div>
            <div class="buttons">
                <button class="submit button">Даље</button>
                <a href="javascript:void(0)" class="skip button" recordid="{{ Session::get('news_id') }}">Прескочи</a>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    <script>
        const realFileBtn = document.getElementById("custom-file-input");
        const customTxt = document.getElementById("custom-text");
        const customBtn = document.getElementById("custom-button");

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
    </script>
@endsection
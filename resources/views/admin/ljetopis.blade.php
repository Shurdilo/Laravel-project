@extends('admin.layout.layout')
@section('content')
    
<div class="ljetopis">
    <h3>Љетопис</h3>
    <div class="ljetopis-card">
        <form action="{{ url('admin/ljetopis') }}" method="post">@csrf
            <div class="ck-group">
                <label>Текст</label>
                <textarea name="ljetopistext" id="ljetopistext">{{ $ljetopis->ljetopistext }}</textarea>
            </div>
            <button id="submit" class="submit button">Ажурирај</button>
        </form>
    </div>
</div>

@endsection

@section('scripts')

<script>
    ClassicEditor
        .create( document.querySelector( '#ljetopistext' ), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'blockQuote', '|', 'uploadImage', '|', 'undo', 'redo', ],
            ckfinder:{
                uploadUrl: '{{ route('ckeditor.upload').'?_token='.csrf_token()}}'
            }
        } )
        .then( newEditor => {
            console.log( editor );
        } )
        .catch( error => {
            console.error( error );
        } );
</script>

@endsection
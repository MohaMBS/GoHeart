@extends('layouts.master')
@section('css')
<style>
  @media (max-width: 991px) {
  .col-12{
      padding-left: 0.45rem;
      padding-right:0;
  }
}
</style>
@endsection
@section('content')

<div class="col-12">
    <form action="{{ route ('store.post') }}" method="POST">
    <div class="row col-12">
        @csrf
        <div class="form-group col-lg-6 col-12">
            <label for="title"> <h2> Titulo: </h2></label> 
            <input id="titulo" type="text" class="form-control" name="title" id="title" maxlength="150" placeholder="Escriba un titulo para la entrada maximo 150 caracteres." required>
        </div>

        <div class="form-group col-lg-6 col-12">
            <label for="category"> <h2> Categoria: </h2></label>
            <select class="custom-select" name="Category" required>
                <option selected disabled>Escoja una categoria...</option>
                <option value="1">Ejercico.</option>
                <option value="2">Dieta.</option>
                <option value="3">Blog.</option>
            </select>
        </div>
        <div class="col-12">
          <textarea name="body" class="form-control my-editor"></textarea>
        </div>
        <div class="form-group col-12 col-md-10 mt-4 ">
            <div class="col-12">
                <h3 class="">Imagen destacada.</h3>
            </div>
            <div class="input-group col-12 ">
                <span class="input-group-btn">
                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                    <i class="fa fa-picture-o"></i> Seleccionar
                </a>
                </span>
                <input id="thumbnail" class="form-control " type="text" name="filepath">
            </div>
        </div>
        <div class="col-12 col-md-2 mt-sm-5 mt-2 text-center align-middle">
            <input type="submit" id="send" class="btn btn-primary" value="Publicar">
            </form>
        </div>
    </div>    
</div>
<script>
  $(document).ready(()=>{
    //Script para poder añadir imgaen en el editor de texto.
    var editor_config = {
      path_absolute : "{{URL::to('/')}}/",
      selector: 'textarea.my-editor',
      relative_urls: false,
      height : $( window ).height()*0.5,
      plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen",
        "insertdatetime media nonbreaking save table directionality",
        "emoticons template paste textpattern"
      ],
      toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
      file_picker_callback : function(callback, value, meta) {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

        var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
        if (meta.filetype == 'image') {
          cmsURL = cmsURL + "&type=Images";
        } else {
          cmsURL = cmsURL + "&type=Files";
        }

        tinyMCE.activeEditor.windowManager.openUrl({
          url : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no",
          onMessage: (api, message) => {
            callback(message.content);
          }
        });
      }
    };
    tinymce.init(editor_config);
    /*===============================================================================*/
    //Para lara subida de la imagen destacada
    var lfm = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
        var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
        var cmsURL ="{{route ('unisharp.lfm.show')}}?editor=image&type=Images";
        tinyMCE.activeEditor.windowManager.openUrl({
          url : cmsURL,
          title : 'Filemanager',
          width : x * 0.8,
          height : y * 0.8,
          resizable : "yes",
          close_previous : "no",
          onMessage: (api, message) => {
            $('#thumbnail').val(message.content);
          }
        });
      });
    };
    var route_prefix = "../filemanager";
    lfm('lfm', 'image', {prefix: route_prefix});
})
</script>
@endsection
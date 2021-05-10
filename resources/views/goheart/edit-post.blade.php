@extends('layouts.master')
@section('title', '- Editando: '.$data[0]->title)
@section('content')
<div class="col-12">
  <form action="{{ route ('store.post') }}" method="POST">
  <input type="text" name="id" value="{{$data[0]->id}}" hidden>
  <input type="text" name="token_post" value="{{ $data[0]->security_token }}" hidden>
  <div class="row col-12">
      @csrf
      <div class="form-group col-lg-6 col-12">
          <label for="title"> <h2> Titulo: </h2></label> 
          <input id="titulo" type="text" class="form-control" name="title" id="title" maxlength="150" value="{{$data[0]->title}}" placeholder="Escriba un titulo para la entrada maximo 150 caracteres." required>
      </div>

      <div class="form-group col-lg-6 col-12">
        <label for="category"> <h2> Categoria: </h2></label>
          <select class="custom-select" name="Category" required>
            <option value="1" 
            @if ($data[0]->	typepost_id  == 1)
              selected
            @endif
            >Ejercico.</option>
            <option value="2"
            @if ($data[0]->	typepost_id  == 2)
              selected
            @endif
            >Dieta.</option>
            <option value="3"
            @if ($data[0]->	typepost_id  == 3)
              selected
            @endif
            >Blog.</option>
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
              <a id="lfm" data-input="front_page" data-preview="holder" class="btn btn-primary text-white">
                  <i class="fa fa-picture-o"></i> Seleccionar
              </a>
              </span>
              <input id="front_page" class="form-control " type="text" name="filepath" value="{{$data[0]->front_page}}" placeholder="Pueses escribir una url externa para tu imagen o subir una.">
          </div>
      </div>
      <div class="col-12 col-md-2 mt-sm-5 mt-2 text-center align-middle">
          <a class="btn btn-danger" href="{{ route('my-posts') }}"> Cancelar </a>
          <input type="submit" id="send" class="btn btn-primary" value="Guardar cambios.">
          </form>
      </div>
  </div>    
</div>

<script>
    var editor_config = {
      path_absolute : "{{url('/')}}/",
      selector: 'textarea.my-editor',
      height : 400,
      setup: function(editor) {
        editor.on('init', function(e) {
          tinyMCE.activeEditor.setContent('<?php echo preg_replace("/[\n\r|\r\n|\r|\n]/m", "", $data[0]->body); ?>', {format : 'html'})
        });
      },
      relative_urls: false,
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
        console.log(cmsURL ,)
        tinyMCE.activeEditor.windowManager.openUrl({
          url : cmsURL,
          title : 'Filemanager',
          frameguard: false,
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
            $('#front_page').val(message.content);
          }
        });
      });
    };
    var route_prefix = "../filemanager";
    lfm('lfm', 'image', {prefix: route_prefix});


    $("#send").click(()=>{
      $("form").submit();
    })
  </script>
@endsection
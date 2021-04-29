<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.tiny.cloud/1/d2c5k3zmkiqgn6brkffsa1cysyvuntzc13rcuhggwzofs50u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src='https://cdn.tiny.cloud/1/d2c5k3zmkiqgn6brkffsa1cysyvuntzc13rcuhggwzofs50u/tinymce/5/tinymce.min.js' referrerpolicy="origin">
    </script>
    <script>
      tinymce.init({
        selector: '#mytextarea'
      });
    </script>
    
</head>
<body>
<script src="https://cdn.tiny.cloud/1/d2c5k3zmkiqgn6brkffsa1cysyvuntzc13rcuhggwzofs50u/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<form action="{{ route ('store.post') }}" method="POST">
@csrf
   <label for="title">Titulo:</label> <input type="text" name="title" id="title" maxlength="150" required>
   <label for="Category">Categoria:</label><select name="Category" id="cat"  required>
      <option selected disabled>Choose Tagging</option>
      <option value="1">Ejercico.</option>
      <option value="2">Dieta.</option>
      <option value="3">Blog.</option>
   </select>
  <textarea name="body" class="form-control my-editor" required></textarea>
  <br>
  <input type="submit" id="send" value="Enviar.">
</form>
</body>

<script>
  var editor_config = {
    path_absolute : "/",
    selector: 'textarea.my-editor',
    setup: function(editor) {
      editor.on('init', function(e) {
        tinyMCE.activeEditor.setContent('<span>some</span> html', {format : 'raw'})
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

  </script>

<script>
  $(document).ready(()=>{
    $("#send").click(()=>{
      console.log("click");
      $("form").submit();
    })
  })
</script>
</html>
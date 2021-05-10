@extends('layouts/master')
@section('title', '-  Cuenta.')
@section('content')


<div class="modal fade" id="deleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Confirmación de borrado de cuenta.</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">
            Quieres eliminar tu cuenta de forma permanente, todos tus datos seran borrados, tanto mensajes como entradas.
            <p class="text-danger"> Estas esguro de que quieres borrar tu cuenta?</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            <button type="button" class="btn btn-danger" id="deletteAcount">Eliminar cuenta</button>
        </div>
        </div>
    </div>
</div>

<div class="container rounded bg-white mt-5">
    <div class="row">
        <div id="msgok" class="col-12 alert alert-success" role="alert" style="display: none">
            Se han guardado los cambios.
        </div>
        <div id="messagenotok" class="col-12 alert alert-danger" role="alert" style="display: none">
            No ha sido posible guardar los cambios.
        </div>
        <div class="col-md-4 border-right">
            <h1 class="text-center mt-1">Mi perfil</h1>
            <div class="d-flex flex-column align-items-center text-center p-3">
                <span style="font-size: 5rem;">
                    @if(auth()->user()->url_avatar != null)
                        <a href="#" class="text-dark" id="changeAvatar"><img class="rounded-circle mt-2" src="{{auth()->user()->url_avatar}}" width="90"></a>
                    @else
                        <a href="#" class="text-dark" id="changeAvatar"><i class="fas fa-user-circle" aria-hidden="true"></i></a> 
                    @endif
                </span>
                <!--<img class="rounded-circle mt-2" src="https://i.imgur.com/0eg0aG0.jpg" width="90">-->
                <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                <span class="text-black-50">{{ Auth::user()->email }}</span>
                <span>Un <span class="special-font">heart</span> </span>
                <span>más en nuestra comunidad.</span>
                <span class="mt-5"> <a href="{{ route('my-posts') }}"> <i class="fas fa-edit">Editar mis entradas.</i></a> </span>
                <span class="mt-5"> <a id="deletteAcount" href="#"><i data-toggle="modal" data-target="#deleteUser" class="fas fa-user-alt-slash text-danger">Eliminar mi cuenta.</i></a></span>
            </div>
        </div>
        <div class="col-md-8">
            <form id="dataUser" action="{{ route('update-profile') }}" method="POST">
                @csrf
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="row d-flex flex-row align-items-center back">
                        <a class="col-12" href="{{ url()->previous() }}"><h6><i class="fa fa-long-arrow-left mr-1 mb-1"></i>Ir atras</h6></a>
                        <a class="col-12" href="{{route('home')}}"><h6><i class="fa fa-long-arrow-left mr-1 mb-1"></i>Volver al inicio</h6></a>
                        </div>
                        <h6 class="text-right">Editor de perfil <span class="special-font"> GoHeart </span></h6>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2 "> <label for="name">Nombare:</label> </div>
                        <div class="col-md-10"><input id="name" name="name" type="text" class="form-control" placeholder="name" value="{{Auth::user()->name}}"></div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-2 "> <label for="email">Email:</label> </div>
                        <div class="col-md-10">
                            <input id="email" name="email" type="text" class="form-control" placeholder="Email" value="{{Auth::user()->email}}"> 
                            @error('email')
                                <div class="col-12 error-user-data rounded">{{ $message }}</div>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 "> <label for="oldPass">Contraseña actual:</label> </div>
                        <div class="col-md-8"><input id="oldPass" name="oldPass" type="password" class="form-control" placeholder="Contaseña actual" value="">
                            @error('oldPass')
                                <div class="col-12 error-user-data rounded">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 "> <label for="email">Nueva contraseña:</label> </div>
                        <div class="col-md-8"><input id="newPass1" name="newPass1" type="password" class="form-control" placeholder="Nueva contrasñea" value="">
                            @error('newPass1')
                                <div class="col-12 error-user-data rounded">{{ $message }}</div>
                            @enderror
                    </div>       
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-4 "> <label for="email">Repita la nueva contraseña: </label> </div>
                        <div class="col-md-8"><input id="newPass2" name="newPass2" type="password" class="form-control" placeholder="Repita la nueva contraseña" value="">
                            @error('newPass2')
                                <div class="col-12 error-user-data rounded">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 text-right"><input class="btn btn-primary profile-button" id="update" type="submit" value="Guardar"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<textarea name="" id="profile" cols="30" rows="10" hidden></textarea>
<script>
    $(document).ready(()=>{
        $('#deletteAcount').click((e)=>{
            e.preventDefault();
            $.post("{{ route('delet-user',Auth::user()->id) }}",{"_token":"{{ csrf_token() }}", function (data,status){
                let url = "{{ route('home')}}"
                $(location).attr('href',url)
            }})
        })
    })
</script>
<script>
    $(document).ready(()=>{
        
        @if (Session::get('msg') == true ) 
            $("#msgok").slideToggle(750).delay(1500).slideToggle(1500);
        @endif
        @if (Session::get('msg') == false && Session::get('msg') != null)
            $("#messagenotok").slideToggle(750).delay(1500).slideToggle(1500);
        @endif
        const orginalData = {
            name:"{{ Auth::user()->name}}",
            email:"{{ Auth::user()->email}}"
        }

        let newDataUpdate = {
            _token: "{{ csrf_token() }}",
            name:"",
            email:"",
            currentPass:"",
            newPass:""
        }

        $("#update").click((evet)=>{
            if(orginalData.name != $("#name").val()){
                orginalData.name= $("#name").val()
                newDataUpdate.name= $("#name").val()
                
            }
            if(orginalData.email != $("#email").val() ){
                orginalData.email =$("#email").val()
                newDataUpdate.email =$("#email").val()
            }
            if($("#oldPass").val() != "" | $("#newPass1").val() != "" | $("#newPass2").val() != ""){
                validatePass();
            }
        })
        function validatePass(){
            $("#dataUser").validate({
                rules: {
                    oldPass:{
                        required: true,
                        minlength: 8
                    },
                    newPass1: {
                        required: true,
                        equalTo: "#newPass2",
                        minlength: 8,
                    },
                    newPass2: {
                        required: true,
                        equalTo: "#newPass1",
                        minlength: 8,
                    }
                },
                messages: {
                    oldPass:"Porfavro debe introducir la contrasñea actual.",
                    newPass1: {
                        required: "Debe introducir una contraseña.",
                        equalTo: "La nueva contraseña deben coincidir.",
                        minlength: "Longitud minima es 8."
                    },
                    newPass2: {
                        required: "Debe introducir una contraseña.",
                        equalTo: "La nueva contraseña deben coincidir.",
                        minlength: "Longitud minima es 8."
                    }
                },
                submitHandler: function(form) {
                    orginalData.newPass= $("#newPass1").val();
                    newDataUpdate.currentPass= $("#oldPass").val()
                    newDataUpdate.newPass=$("#newPass1").val();
                    $(form)[0].submit()
                }
            });
        }

    })
</script>
<script>
    $(document).ready(()=>{
        var editor_config = {
            selector: '#profile',
            width : 0,
            height : 0,
        };
        tinymce.init(editor_config);
        var lfm = function(id, type, options) {
        let button = document.getElementById(id);
            button.addEventListener('click', function (evt) {
                evt.preventDefault();
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                var cmsURL ="{{route ('unisharp.lfm.show')}}?editor=image&type=Images";
                tinyMCE.activeEditor.windowManager.openUrl({
                url : cmsURL,
                title : 'Filemanager',
                selector: '#profile',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no",
                onMessage: (api, message) => {
                    data = {
                        '_token':"{{ csrf_token() }}",
                        'url_avatar':message.content
                    }
                    $('#thumbnail').val(message.content);
                    $.post('{{route ("change-avatar")}}',data,function(data,status){
                        $("#msgok").slideToggle(750).delay(1500).slideToggle(1500);
                        $('#changeAvatar').children().first().remove()
                        $('#changeAvatar').append('<img class="rounded-circle mt-2" src="'+message.content+'" width="90">')
                        console.log(data)
                        console.log(status)
                    })
                }
                });
            });
        };
        var route_prefix = "../filemanager";
        lfm('changeAvatar', 'image', {prefix: route_prefix});
    })

</script>
@endsection
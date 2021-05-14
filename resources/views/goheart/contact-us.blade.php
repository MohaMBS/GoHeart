@extends('layouts.master')
@section('title', '- Contacta con nosotros.')
@section('content')
@section('css')
<style>
    .info-wrap .dbox .icon {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.2);
    }
    .info-wrap .dbox .icon span {
        font-size: 20px;
        color: #fff;
    }
</style>
@endsection
<section class="ftco-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-2">
                <h2 class="heading-section">Formulario de contacto.</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="wrapper">
                    <div class="row no-gutters">
                        <div class="bg-white col-lg-8 col-md-7 order-md-last d-flex align-items-stretch">
                            <div class="contact-wrap w-100 p-md-5 p-4">
                                <h3 class="mb-4">Danos un toque</h3>
                                <div class="alert alert-danger" style="display: none" id="form-message-warning" class="mb-4">
                                    
                                </div> 
                                <div id="form-message-success" class="alert alert-success" style="display: none">
                                    Se ha enviado tu mensaje de forma correcta.
                                </div>
                                <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="label" for="name">Nombre</label>
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Escriba aquí su nombre">
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label class="label" for="email">Direccion de email</label>
                                                <input type="email" class="form-control" name="email" id="email" placeholder="Escriba aquí su direccion de correo">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="subject">Sujeto</label>
                                                <input type="text" class="form-control" name="subject" id="subject" placeholder="Escriba aquií el sujeto">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="label" for="#">Mensaje</label>
                                                <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Escriba aquí su mensaje"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Enviar mensaje" class="btn btn-primary">
                                                <div class="submitting"></div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-5 d-flex align-items-stretch">
                            <div class="info-wrap pri w-100 p-md-5 p-4">
                                <h3>Tambien puedes contactar con nosotros.</h3>
                                <p class="mb-4">Nuestros horarios de atencion es de Lunes a Viernes, de 10h a 18h.</p>
                        <div class="mb-4 dbox w-100 d-flex align-items-start">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span style="width: 75px;margin-left:1rem" class="fa fa-map-marker"></span>
                            </div>
                            <div class="text pl-3">
                            <small> Av. de Vilafranca del Penedès, 08800 Vilanova i la Geltrú, Barcelona</small>
                          </div>
                      </div>
                        <div class="mb-4 dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-phone"></span>
                            </div>
                            <div class="text pl-3">
                            <p><span>Telefono:</span> <em><a href="tel://+34632548320">632 548 320</a></em></p>
                          </div>
                      </div>
                        <div class="mb-4 dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-paper-plane"></span>
                            </div>
                            <div class="text pl-3">
                            <p><span>Email:</span> <em><a style="color: white" href="mailto:info@goheart.es">info@goheart.es</a></em></p>
                          </div>
                      </div>
                        <div class="dbox w-100 d-flex align-items-center">
                            <div class="icon d-flex align-items-center justify-content-center">
                                <span class="fa fa-globe"></span>
                            </div>
                            <div class="text pl-3">
                            <p><span>Pagina principal</span> <em><a style="color:white;" href="{{ route('home') }}">GoHeart</a></em></p>
                          </div>
                      </div>
                  </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(()=>{
            var contactForm = function() {
                if ($('#contactForm').length > 0 ) {
                    $( "#contactForm" ).validate( {
                        rules: {
                            name: "required",
                            subject: "required",
                            email: {
                                required: true,
                                email: true
                            },
                            message: {
                                required: true,
                                minlength: 5
                            }
                        },
                        messages: {
                            name: "Debe de introducior un nombre.",
                            subject: "Es necesario que escriba el sujeto del mensaje.",
                            email: "Debes de introducir un email valido.",
                            message: "Debes de escribir el mensaje."
                        },
                        /* submit via ajax */
                        
                        submitHandler: function(form) {		
                            var $submit = $('.submitting'),
                                waitText = 'Submitting...';

                            $.ajax({   	
                            type: "POST",
                            url: "{{ route('send-contact') }}",
                            data: $(form).serialize(),

                            beforeSend: function() { 
                                $submit.css('display', 'block').text(waitText);
                            },
                            success: function(msg) {
                            console.log(msg)
                            if (msg == true) {
                                $('#form-message-warning').hide();
                                    setTimeout(function(){
                                    $('#contactForm').fadeIn();
                                }, 1000);
                                    setTimeout(function(){
                                    $('#form-message-success').fadeIn();   
                                }, 1400);

                                setTimeout(function(){
                                    $('#form-message-success').fadeOut();   
                                }, 8000);

                                setTimeout(function(){
                                    $submit.css('display', 'none').text(waitText);  
                                }, 1400);

                                setTimeout(function(){
                                    $( '#contactForm' ).each(function(){
                                                        this.reset();
                                                    });
                                }, 1400);

                                } else {
                                $('#form-message-warning').fadeOut().fadeIn(3500)
                                }
                            },
                            error: function() {
                                $('#form-message-warning').html("Algo fallo.");
                                $('#form-message-warning').fadeIn();
                                $submit.css('display', 'none');
                            }
                        });    		
                        } // end submitHandler

                    });
                }
	        };
        contactForm();
    })
    </script>
</section>
@endsection
@extends('layouts.app')

@section('title', 'Contact Us')
    
@show

@section('content')


<script>
    function detail(color, title, res){
        iziToast.show({
            icon: 'fa fa-info-circle',
            iconText: '',
            iconColor: color,
            iconUrl: null,
            drag: true,
            balloon: true,
            position: 'topCenter',
            color: color,
            title: title,
            message: res
        });
     }
</script>

<div class="container" style="margin: 30px;">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">Login</div> --}}

                <div class="panel-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4 col-lg-4"><img src="https://pngimage.net/wp-content/uploads/2018/05/contact-center-png-2.png" alt="" class="img img-responsive"></div>
                            <div class="col-md-8 col-lg-8">
                               <form id="contact-form" method="POST" action="{{ url('contact') }}" role="form">

                                    <div class="messages"></div>

                                    <div class="controls">

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_name">Firstname *</label>
                                                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your firstname *" required="required" data-error="Firstname is required.">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_lastname">Lastname *</label>
                                                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your lastname *" required="required" data-error="Lastname is required.">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_email">Email *</label>
                                                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email *" required="required" data-error="Valid email is required.">
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="form_need">Please specify your need *</label>
                                                    <select id="form_need" name="need" class="form-control" required="required" data-error="Please specify your need.">
                                                        <option value=""></option>
                                                        <option value="Request quotation">Request quotation</option>
                                                        <option value="Request order status">Request order status</option>
                                                        <option value="Request copy of an invoice">Request copy of an invoice</option>
                                                        <option value="Other">Other</option>
                                                    </select>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="form_message">Message *</label>
                                                    <textarea id="form_message" name="message" class="form-control" placeholder="Message for me *" rows="4" required="required" data-error="Please, leave us a message."></textarea>
                                                    <div class="help-block with-errors"></div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <input type="submit" onclick="sendMessage(event)" class="btn btn-success btn-send" value="Send message">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12" style="display: none;">
                                                <p class="text-muted text-danger text-right" id="error">
                                                    <strong>*</strong> These fields are required.</p>
                                            </div>
                                        </div>
                                    </div>

                                </form>

                                    {{-- CONTACT DETAIL - AJAX VALIDATION --}}

                                    <script>
                                        function sendMessage(event){
                                            event.preventDefault();
                                            // $(document).ready(function(){
                                                var form = document.getElementById('contact-form');
                                                var name = $('#form_name').val();
                                                var surname = $('#form_lastname').val();
                                                var email = $('#form_email').val();
                                                var need = $('#form_need').val();
                                                var message = $('#form_message').val();
                                                var empty = "";
                                                
                                                // console.log(name, surname, email, need, message);

                                                jQuery.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                                    }
                                                });

                                                jQuery.ajax({
                                                    url: "{{ url('contact') }}",
                                                    method: "POST",
                                                    data: {
                                                        name: name,
                                                        surname: surname,
                                                        email: email,
                                                        need: need,
                                                        message: message,
                                                    },
                                                    success: function(result){
                                                        console.log(result.res);
                                                        form.reset();
                                                        detail(result.color, result.title, result.res);
                                                    }
                                                });
                                            // });
                                        }
                                    </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
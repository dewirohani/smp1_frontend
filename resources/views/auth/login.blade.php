@extends('auth.main')
@section('content')
    <!-- Login Content -->
    <div class="container-login">
        <div class="row justify-content-center mt-5">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-8 text-center">
                <div class="card shadow-sm my-4 border-bottom-primary">
                    <div class="card-header">
                        <img src="{{ asset('assets-login/img/logo/logosmp1.png') }}" class="card-img-bottom mt-2"
                            style="max-width: 250px" alt="Photo">
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                {{-- <h1 class="h4 text-gra y-900 font-weight-bold mt-2">Login</h1> --}}
                                <div class="login-form">
                                    <small class="text-danger" id="message-error"></small>
                                    <form class="user" id="login">
                                        @csrf
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control" id="email"
                                                aria-describedby="emailHelp" placeholder="Email">
                                            <small class="text-danger" id="email-error"></small>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control" id="password"
                                                placeholder="Password">
                                            <small class="text-danger" id="password-error"></small>
                                        </div>
                                        <divd class="form-group">
                                            <button type="submit" id="submit"
                                                class="btn btn-primary btn-block">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content -->
    <script type="text/javascript">
        $("#login").on('submit', function(event) {
            event.preventDefault();
            $(".preloader").fadeIn();
            let formData = new FormData(this);
            $('#email-error').text('');
            $('#password-error').text('');
            $('#message-error').text('');

            $.ajax({
                url: "http://127.0.0.1:8000/api/login",
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(response) {
                    $(".preloader").fadeOut();
                    if (response.success) {
                        document.cookie = "token=" + response.token;
                        sessionStorage.setItem('success', response.message);
                        window.location.href = "{{ route('home') }}";
                    }
                },
                // error: function(response) {
                //     $(".preloader").fadeOut();
                //     $('#email-error').text(response.responseJSON.email);
                //     $('#password-error').text(response.responseJSON.password);
                //     $('#message-error').text(response.responseJSON.message);
                // },
            });
        });
    </script>
@endsection

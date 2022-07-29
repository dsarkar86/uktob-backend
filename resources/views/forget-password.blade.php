@extends('layout.main')

@section('main-container')
<style type="text/css">
    .alert.alert-warning.icons-alert {
    text-align: left;
    }
    .alert.alert-success.icons-alert {
    text-align: left;
    }
    .alert.alert-danger.icons-alert {
    text-align: left;
    }
</style>
    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <!-- Container-fluid starts -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
	
                    <!-- Authentication card start -->
                    <div class="login-card card-block auth-body">

                            <div class="text-center">
                                <!-- img src="assets/images/yadi-ci-logo.png" alt="logo.png" -->
								<h2> Copy AI Admin | Forget Password</h2>
                            </div>
                              	
                            <div class="auth-box">
                                <div class="row m-b-20">
                                    <div class="col-md-12">
                                        <h3 class="text-left txt-primary">Forget password</h3>
                                    </div>
                                </div>
                                <hr/>
                                <form method="POST" action="{{url('/forgot-password')}}">
                                    @csrf
                                <div class="input-group">
                                    <input type="email" name="email" class="form-control" placeholder="Your email">
                                    <span class="md-line"></span>
                                </div>
                               
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-7 col-xs-12">
                                        <div class="checkbox-fade fade-in-primary">
                                        </div>
                                    </div>
                                    <div class="col-sm-5 col-xs-12 forgot-phone text-right">
                                        <a href="{{url('/')}}" class="text-right f-w-600 text-inverse"> Login?</a>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Submit</button>
                                    </div>
                                </div>
                                <!-- <hr/>
                                <div class="row">
                                    <div class="col-md-10">
                                        <p class="text-inverse text-left m-b-0">Welcome to Visitevisa Admin.</p>
                                        <p class="text-inverse text-left"><b>Your Autentification Team</b></p>
                                    </div>
                                    <div class="col-md-2">
                                        <img src="admintemplate/assets/images/auth/Logo-small-bottom.png" alt="small-logo.png">
                                    </div>
                                </div> -->
                            </form>
                            </div>
                       
                        <!-- end of form -->
                    </div>
                    <!-- Authentication card end -->
                </div>
                <!-- end of col-sm-12 -->
            </div>
            <!-- end of row -->
        
        <!-- end of container-fluid -->
    </section>    
@endsection    
   
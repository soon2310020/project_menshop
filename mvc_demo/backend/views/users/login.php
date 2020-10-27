<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" method="post" action="">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user"  placeholder="Enter User Name..." name="username" value="">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" value="" placeholder="Password">
                                    </div>
                                    <button href="index.html" class="btn btn-primary btn-user btn-block" type="submit" value="submit" name="submit">
                                        Login
                                    </button>


                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="index.php?controller=login&action=forgot">Forgot Password?</a>
                                </div>
                                <div class="text-center" style="padding-bottom: 200px;">
                                    <a class="small" href="index.php?controller=login&action=register">Create an Account!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
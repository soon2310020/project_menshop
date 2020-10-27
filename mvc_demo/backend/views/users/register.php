<body class="bg-gradient-primary">

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <form class="user" action="" method="post" id="form">
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control form-control-user" id="FirstName"
                                                   value="<?php echo isset($_POST['firstname']) ? $_POST['firstname'] :'' ?>"
                                                   placeholder="First Name" name="firstname">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="text" class="form-control form-control-user" id="LastName"
                                                   value="<?php echo isset($_POST['lastname']) ? $_POST['lastname'] :'' ?>"
                                                   placeholder="Last Name" name="lastname">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="username"
                                               value="<?php echo isset($_POST['username']) ? $_POST['username'] :'' ?>"
                                               placeholder="username" name="username">
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user" id="Password"
                                                   placeholder="Password" name="password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                   id="cf_Password" placeholder="Repeat Password" name="cf_password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="email"
                                               value="<?php echo isset($_POST['email']) ? $_POST['email'] :'' ?>"
                                               placeholder="email" name="email">
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block" type="submit" value="submit"
                                            name="submit" id="submit">
                                        Register Account
                                    </button>

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="index.php?controller=login&action=forgot">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="index.php?controller=login&action=login">Already have an
                                        account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
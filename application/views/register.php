                <section class="container" >
                    <div class="block">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3" style="background-color: white;">
                                <header>
                                    <h1 class="page-title">Register</h1>
                                </header>
                                <hr>
                                <form role="form" id="form-register" method="post" action="">
                                    <div class="form-group">
                                        <label for="form-register-full-name">Full Name:</label>
                                        <input type="text" class="form-control" name="fullname"  id="form-register-full-name" name="form-register-full-name" required>
                                    </div><!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="form-register-email">Email:</label>
                                        <input type="email" class="form-control"  name="email" id="form-register-email" name="form-register-email" required>
                                    </div><!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="form-register-password">Password:</label>
                                        <input type="password" class="form-control" name="password"  id="form-register-password" name="form-register-password" required>
                                    </div><!-- /.form-group -->
                                    <div class="form-group">
                                        <label for="form-register-confirm-password">Confirm Password:</label>
                                        <input type="password" class="form-control" name="password2"  id="form-register-confirm-password" name="form-register-confirm-password" required>
                                    </div><!-- /.form-group -->
                                    <div class="checkbox pull-left">
                                        <label>
                                            <input type="checkbox" name="optin"  checked name="newsletter">Yes! I want to Opt-In for coupons, deals, newsletter
                                        </label>
                                    </div>
                                    <div class="form-group clearfix">
                                        <div class="g-recaptcha" data-sitekey="6Lc9jCcTAAAAABHgxi_WTPsP0UkHAdd0MM5QpBgG"></div>
                                    </div><!-- /.form-group -->
                                    <br><br>
                                    <div class="form-group clearfix">
                                        <button type="submit" class="btn pull-right btn-default" id="account-submit">Create an Account</button>
                                    </div><!-- /.form-group -->
                                </form>
                                <hr>
                                <div class="center">
                                    <figure class="note">By clicking the “Create an Account” button you agree with our <a href="terms-conditions.html" class="link">Terms and conditions</a></figure>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <script src='https://www.google.com/recaptcha/api.js'></script>
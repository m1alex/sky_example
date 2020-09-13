<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center login-title">Login form</h1>
        </div>
                
        <div class="panel-body">
            <form id="add-item-form" action="/auth/login" method="POST" class="form-horizontal">
                <input type="hidden" name="csrf-token" id="item-csrf-token" value="<?php echo $csrfToken; ?>">
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <img class="text-center profile-img" src="https://p.w3layouts.com/demos/entrar_shadow/web/images/user.png" alt="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="item-email" class="col-sm-3 control-label">Your email:</label>
                    <div class="col-sm-6">
                        <input type="text" name="email" id="item-email" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="item-password" class="col-sm-3 control-label">Your password:</label>
                    <div class="col-sm-6">
                        <input type="password" name="password" id="item-password" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <a href="/auth/forgot-password-form">Forgot password?</a>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="item-remember-me" class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <input type="checkbox" value="remember-me" name="remember-me" id="item-remember-me" class="custom-control-input">
                        <label for="item-remember-me" class="custom-control-label text-sm">Remember me</label>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button id="login-button" type="submit" class="btn btn-primary">
                            Log in to dashboard
                        </button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <a href="/auth/register-form">Create an account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                
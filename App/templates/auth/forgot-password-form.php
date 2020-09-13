<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center login-title">Forgot password form</h1>
        </div>
                
        <div class="panel-body">
            <form id="add-item-form" action="/auth/send-reset-password-email" method="POST" class="form-horizontal">
                <input type="hidden" name="csrf-token" id="item-csrf-token" value="<?php echo $csrfToken; ?>">
                
                <div class="form-group">
                    <label for="task" class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <img class="text-center profile-img" src="https://p.w3layouts.com/demos/entrar_shadow/web/images/user.png" alt="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="task" class="col-sm-3 control-label">Your email:</label>
                    <div class="col-sm-6">
                        <input type="text" name="email" id="item-email" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button id="send-reset-password-email-button" type="submit" class="btn btn-primary">
                            Send reset password email
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
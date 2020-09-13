<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center login-title">Your profile</h1>
        </div>
                
        <div class="panel-body">
            <form id="add-item-form" action="/admin/profile-update" method="POST" class="form-horizontal">
                <input type="hidden" name="csrf-token" id="item-csrf-token" value="<?php echo $csrfToken; ?>">
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <img class="text-center profile-img" src="https://p.w3layouts.com/demos/entrar_shadow/web/images/user.png" alt="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="item-username" class="col-sm-3 control-label">Your name:</label>
                    <div class="col-sm-6">
                        <input type="text" name="username" id="item-username" class="form-control" value="<?php echo $username; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="item-email" class="col-sm-3 control-label">Your email:</label>
                    <div class="col-sm-6">
                        <input type="text" name="email" id="item-email" class="form-control" value="<?php echo $email; ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button id="profile-update-button" type="submit" class="btn btn-primary">
                            Update profile
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                
<div class="col-sm-offset-2 col-sm-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1 class="text-center login-title">Reset password form</h1>
        </div>
                
        <div class="panel-body">
            <form id="add-item-form" action="/auth/reset-password" method="POST" class="form-horizontal">
                <input type="hidden" name="csrf-token" id="item-csrf-token" value="<?php echo $csrfToken; ?>">
                <input type="hidden" name="hash" id="item-hash" value="<?php echo $hash; ?>">
                
                <div class="form-group">
                    <label class="col-sm-3 control-label"></label>
                    <div class="col-sm-6">
                        <img class="text-center profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"alt="">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="item-old-password" class="col-sm-3 control-label">Old password:</label>
                    <div class="col-sm-6">
                        <input type="password" name="old-password" id="item-old-password" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="item-new-password" class="col-sm-3 control-label">New password:</label>
                    <div class="col-sm-6">
                        <input type="password" name="new-password" id="item-new-password" class="form-control">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="item-repeat-new-password" class="col-sm-3 control-label">Repeat new password:</label>
                    <div class="col-sm-6">
                        <input type="password" name="repeat-new-password" id="item-repeat-new-password" class="form-control">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-3 col-sm-6">
                        <button id="reset-password-button" type="submit" class="btn btn-primary">
                            Reset password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
                
<div class="container">
    <div class="row">

        <div class="col-sm-3">

        </div>

        <div class="col-sm-6">
            <form action="/account/register" method="POST" type="ajax" class="" style="margin-top: 50px">

                <div class="control-group form-group">
                    <input class="form-control" name="first_name" placeholder="<?=$text['first_name']?>">
                </div>

                <div class="control-group form-group">
                    <input class="form-control" name="last_name" placeholder="<?=$text['last_name']?>">
                </div>

                <div class="control-group form-group">
                    <input class="form-control" name="login" placeholder="<?=$text['placeholder_login']?>">
                </div>

                <div class="control-group form-group">
                    <input class="form-control" name="email" placeholder="<?=$text['placeholder_email']?>">
                </div>

                <div class="control-group form-group">
                    <input class="form-control" name="password" placeholder="<?=$text['password']?>">
                </div>

                <div class="control-group form-group">
                    <input class="form-control" name="avatar" placeholder="<?=$text['avatar']?>">
                </div>


                <div>
                    <button type="submit" class="form-control btn-primary"><?=$text['registration_btn']?></button>
                </div>

            </form>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">

        <div class="col-sm-3">

        </div>

        <div class="col-sm-6">
            <form action="/account/login" method="POST" type="ajax" class="" style="margin-top: 50px">
                <div class="control-group form-group">
                    <input class="form-control" name="login" placeholder="login">
                </div>
                <div class="control-group form-group">
                    <input class="form-control" name="password" placeholder="password">
                </div>

                <div>
                    <button type="submit" class="form-control btn-primary"><?=$text['login']?></button>
                </div>

            </form>
        </div>
    </div>
</div>
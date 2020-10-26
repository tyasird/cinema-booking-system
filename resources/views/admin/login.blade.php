@include('admin.header')




<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login">
                <h4>Yönetim Paneli</h4>



                <form action="" method="post">
                    {{ csrf_field() }}

                    <input name="username" type="text" id="username" class="form-control input-sm chat-input" placeholder="username"/>
                    </br>
                    <input name="password" type="password" id="password" class="form-control input-sm chat-input"
                           placeholder="password"/>
                    </br>
                    <div class="form-login-button">
                        <span class="group-btn">
                            <button class="btn btn-primary btn-md">giriş yap <i class="fa fa-sign-in"></i></button>
                        </span>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<style>

    .form-login {
        background-color: #EDEDED;
        padding-top: 10px;
        padding-bottom: 20px;
        padding-left: 20px;
        padding-right: 20px;
        border-radius: 15px;
        border-color: #d2d2d2;
        border-width: 5px;
        box-shadow: 0 1px 0 #cfcfcf;
    }

    h4 {
        border: 0 solid #fff;
        border-bottom-width: 1px;
        padding-bottom: 10px;
        text-align: center;
    }

    .form-control {
        border-radius: 10px;
    }

    .form-login-button {
        text-align: center;
    }

</style>


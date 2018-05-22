<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-menu" data-col="1-column">
<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    <span>iNSTINCT | SECURING TRANSIT</span>
                                </h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php echo form_open('auth/dologin',' id="login" class="form-horizontal" novalidate'); ?>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" name="username" id="user-name" placeholder="Your Username"
                                                   required>
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control" name="password" id="user-password" placeholder="Enter Password"
                                                   required>
                                            <div class="form-control-position">
                                                <i class="fa fa-key"></i>
                                            </div>
                                        </fieldset>



                                    </form>
                                    <button id="submit" onclick="login();" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i> Login</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>


<script type="text/javascript">
    function login()
    {
        var data = $("#login").serialize();

        $.ajax({
            type : 'POST',
            url : '<?=site_url("auth/dologin");?>',
            data : data,

            beforeSend : function(){
                $("#submit").html('<span type="disabled" class="fa fa-cog spinner font-large-2"></span>');
            },
            success : function(response)
            {
                var callback = $.parseJSON(response);
                if(callback.status == "error")
                {
                    swal("Darn!", callback.message , "error");
                    setTimeout("location.reload(true);", 3000);
                }
                else
                {
                    swal("Yippie!", callback.message , "success");
                    setTimeout("location.reload(true);", 2000);
                }
            },

            error : function()
            {
                swal("Darn!", "We are having issues connecting to the server please try again after reloading this page", "error");
                setTimeout("location.reload(true);", 3000);
            }
        });
    }
</script>
<body class="vertical-layout vertical-menu 2-columns bg-full-screen-image  menu-expanded fixed-navbar"
      data-open="click" data-menu="vertical-menu" data-col="2-columns">
<!-- fixed-top-->
<nav class="header-navbar navbar-expand-md navbar navbar-with-menu fixed-top navbar-semi-light bg-gradient-x-grey-blue">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item">
                    <a class="navbar-brand" href="<?php echo site_url('/') ?>">
                        <h2 class="brand-text">iNSTINCT</h2>
                    </a>
                </li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>

        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu"></i></a></li>
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon ft-maximize"></i></a></li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="user-name"><?php echo $this->encrypt->decode($admin[0]->name) .' '. $this->encrypt->decode($admin[0]->surname); ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="<?php echo site_url('auth/logout') ?>"><i class="ft-power"></i> Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>



<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" navigation-header">
                <span>General</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="General"></i>
            </li>
            <li class=" nav-item"><a href="<?php echo site_url('user/panel'); ?>"><i class="ft-home"></i><span class="menu-title" data-i18n="">Dashboard</span></a>
            </li>

            <li class=" navigation-header">
                <span>Apps</span><i class=" ft-minus" data-toggle="tooltip" data-placement="right"
                                    data-original-title="Apps"></i>
            </li>
            <li class=" nav-item"><a href="#"><i class="ft-globe"></i><span class="menu-title" data-i18n="">Dispatch</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#">Vehicle</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo site_url('dispatch/schedule'); ?>">Schedule Job</a>
                            </li>
                            <li><a class="menu-item" href="<?php echo site_url('dispatch/statistics'); ?>">View jobs</a>
                            </li>
                        </ul>
                    </li>
                    <li><a class="menu-item" href="#">Bounty</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo site_url('bounty/deploy'); ?>">Deploy Route Bounty</a>
                            </li>
                            <li><a class="menu-item" href="<?php echo site_url('bounty/statistics'); ?>">View Stats</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class=" nav-item"><a href="#"><i class="icon-shield"></i><span class="menu-title" data-i18n="">Bounty Hunters</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#">Personel</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo site_url('personel/register'); ?>">Register Personel</a>
                            </li>
                            <li><a class="menu-item" href="<?php echo site_url('personel/view/all'); ?>">View Personel</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>


            <li class=" nav-item"><a href="#"><i class="icon-graduation"></i><span class="menu-title" data-i18n="">Brainy Stuff</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#">Routing</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo site_url('ai/optimize'); ?>">Optimize Route</a>
                            </li>
                        </ul>
                    </li>

                    <li><a class="menu-item" href="#">Scope</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="<?php echo site_url('ai/scope'); ?>">Search incidents</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
</div>


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
                                    <span>Schedule Delivery</span>
                                </h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <?php echo form_open('dispatch/doschedule',' id="delivery" class="form-horizontal" novalidate'); ?>

                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" name="level" id="level" placeholder="Delivery class"
                                               required>
                                    </fieldset>

                                    <fieldset class="form-group position-relative">
                                        <select class="form-control" id="basicSelect">
                                            <option name="vehicle">Select Vehicle</option>
                                            <?php
                                            foreach($vehicles as $vehicle)
                                            {
                                            ?>
                                            <option value="<?php echo $vehicle->token; ?>"><?php echo $vehicle->name; ?></option>
                                            <?php } ?>
                                        </select>
                                    </fieldset>

                                    <fieldset class="form-group position-relative">
                                        <select class="form-control" id="basicSelect">
                                            <option name="bounty">Select Bounty</option>
                                            <?php
                                            foreach($bounties as $bounty)
                                            {
                                                ?>
                                                <option value="<?php echo $bounty->token; ?>"><?php echo $bounty->amount; ?></option>
                                            <?php } ?>
                                        </select>
                                    </fieldset>

                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" name="amount" id="amount" placeholder="Amount"
                                               required>
                                    </fieldset>


                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" name="latitude" id="latitude" placeholder="latitude"
                                               required>
                                    </fieldset>

                                    <fieldset class="form-group position-relative has-icon-left">
                                        <input type="text" class="form-control" name="longitude" id="longitude" placeholder="longitude"
                                               required>
                                    </fieldset>


                                    </form>
                                    <button id="submit" onclick="register_delivery();" class="btn btn-outline-primary btn-block">Schedule Delivery</button>
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
    function register_delivery()
    {
        var data = $("#delivery").serialize();

        $.ajax({
            type : 'POST',
            url : '<?=site_url("dispatch/doschedule");?>',
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
                    $("#submit").html('<span>Schedule Delivery</span>');
                }
                else
                {
                    swal("Yippie!", callback.message , "success");
                    $("#submit").html('<span>Schedule Delivery</span>');
                }
            },

            error : function()
            {
                swal("Darn!", "We are having issues connecting to the server please try again after reloading this page", "error");
                $("#submit").html('<span>Schedule Delivery</span>');
                setTimeout("location.reload(true);", 3000);
            }
        });
    }
</script>
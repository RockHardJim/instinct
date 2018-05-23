<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar"
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                    <div class="my-1 text-center">
                                        <div class="card-header mb-2 pt-0">
                                            <h5 class="primary">Bounty Hunters</h5>
                                            <h3 class="font-large-2 text-bold-200"><?php echo count($bounty_hunters); ?></h3>
                                        </div>
                                        <div class="card-content">
                                            <input type="text" value="<?php echo count($bounty_hunters); ?>" class="knob hide-value responsive angle-offset" data-angleOffset="40"
                                                   data-thickness=".15" data-linecap="round" data-width="130"
                                                   data-height="130" data-inputColor="#BABFC7" data-readOnly="true"
                                                   data-fgColor="#00B5B8" data-knob-icon="icon-user">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                    <div class="my-1 text-center">
                                        <div class="card-header mb-2 pt-0">
                                            <h5 class="danger">Distance Covered</h5>
                                            <h3 class="font-large-2 text-bold-200">0
                                                <span class="font-medium-1 grey darken-1 text-bold-400">Km</span>
                                            </h3>
                                        </div>
                                        <div class="card-content">
                                            <input type="text" value="0" class="knob hide-value responsive angle-offset" data-angleOffset="0"
                                                   data-thickness=".15" data-linecap="round" data-width="130"
                                                   data-height="130" data-inputColor="#BABFC7" data-readOnly="true"
                                                   data-fgColor="#FF7588" data-knob-icon="icon-pointer">
                                        </div>
                                    </div>
                                </div>


                                <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                                    <div class="my-1 text-center">
                                        <div class="card-header mb-2 pt-0">
                                            <h5 class="warning">Vehicles Registered</h5>
                                            <h3 class="font-large-2 text-bold-200"><?php echo count($vehicles); ?>
                                            </h3>
                                        </div>
                                        <div class="card-content">
                                            <input type="text" value="<?php echo count($vehicles); ?>" class="knob hide-value responsive angle-offset" data-angleOffset="20"
                                                   data-thickness=".15" data-linecap="round" data-width="130"
                                                   data-height="130" data-inputColor="#BABFC7" data-readOnly="true"
                                                   data-fgColor="#FFA87D" data-knob-icon="icon-speedometer">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-3 col-lg-6 col-md-12">
                                    <div class="my-1 text-center">
                                        <div class="card-header mb-2 pt-0">
                                            <h5 class="success">Deliveries</h5>
                                            <h3 class="font-large-2 text-bold-200"><?php echo count($deliveries[0]); ?>
                                            </h3>
                                        </div>
                                        <div class="card-content">
                                            <input type="text" value="<?php echo count($deliveries[0]); ?>" class="knob hide-value responsive angle-offset" data-angleOffset="20"
                                                   data-thickness=".15" data-linecap="round" data-width="130"
                                                   data-height="130" data-inputColor="#BABFC7" data-readOnly="true"
                                                   data-fgColor="#16D39A" data-knob-icon="icon-emoticon-smile">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <?php
                                if(!empty($deliveries))
                                {
                                    //die(var_dump($deliveries[0]->vehicle_token));
                                    $vehicle = $this->Vehicle_model->lookup_vehicle($deliveries[0]->vehicle_token);
                                    $van_location = $this->Vehicle_model->deliveries_profile_location($deliveries[0]->token);



                                ?>
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5 clearfix">
                                        <div class="media">
                                            <div class="media-body">
                                                <h6 class="text-bold-500 pt-1 mb-0">Truck ID</h6>
                                                <p><?php echo $vehicle[0]->vehicle_code; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5 clearfix">
                                        <p>Distance
                                        </p>
                                        <div class="progress progress-sm mt-1 mb-0">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 45%" aria-valuenow="<?php echo Hub::geo_distance($van_location[0]->latitude,$van_location[0]->longitude,$deliveries[0]->destination_latitude,$deliveries[0]->destination_longitude,'k', 0); ?>"
                                                 aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <h6 class="text-bold-500 mt-1 mb-0"><?php echo Hub::geo_distance($van_location[0]->latitude,$van_location[0]->longitude,$deliveries[0]->destination_latitude,$deliveries[0]->destination_longitude,'k', 0); ?></h6>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5 clearfix py-2 text-center">
                                        <div id="fitness-stats"></div>
                                    </div>
                                    <div class="col-xl-3 col-lg-6 col-md-12 text-center clearfix">
                                        <h6 class="pt-1">
                                            <a href="<?php echo site_url('delivery/overview/'.$deliveries[0]->token); ?>"><button id="submit" class="btn btn-outline-primary btn-block"><i class="ft-unlock"></i>View Dashboard</button></a>
                                        <p>Track Delivery</p>
                                    </div>
                                </div>
                                <?php }
                                else
                                {
                                ?>
                                There are currently no dispatched jobs running
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-4 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Bounty Hunters</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                            </div>
                        </div>
                        <div class="card-content">
                            <?php
                            if(!empty($bounty_hunters[0]))
                            {
                                $bounty_hunter_profile = $this->User_model->bounty_profile($bountyhunters[0]->token);

                            ?>
                            <div id="friends-activity" class="media-list height-400 position-relative">
                                <a href="<?php site_url('hunter/profile/'.$bountyhunters[0]->token) ?>" class="media border-0">
                                    <div class="media-body w-100">
                                        <h5 class="list-group-item-heading"><?php echo $this->encrypt->decode($bountyhunters[0]->name) . ' ' .  $this->encrypt->decode($bountyhunters[0]->surname);?>
                                            <span class="font-medium-4 float-right">Rank: <?php echo $bounty_hunter_profile[0]->rank; ?></span>
                                        </h5>
                                        <p class="list-group-item-text mb-0">
                                            <span class="badge badge-success">Bounty Collected</span>
                                            <span class="badge badge-warning ml-1"><?php echo $bounty_hunter_profile[0]->points; ?></span>
                                        </p>
                                    </div>
                                </a>

                            </div>
                            <?php }
                            else
                            {?>
                                <h5 class="list-group-item-heading">There are currently no bounty hunters registered on the platform</h5>
                            <?php } ?>
                        </div>
                    </div>
                </div>



                <div class="col-xl-8 col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Vehicles</h4>
                            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                            </div>
                        </div>
                        <div class="card-content">
                                    <div id="friends-activity" class="media-list height-400 position-relative">
                                        <?php
                                        if(!empty($vehicles)) {
                                        $vehicle_deliveries = $this->Vehicle_model->vehicle_deliveries($vehicles[0]->token);
                                        foreach ($vehicles as $vehicle) {
                                        ?>
                                        <a href="" class="media border-0">
                                            <div class="media-body w-100">
                                                <h5 class="list-group-item-heading"><?php echo $vehicle->license_plate; ?>
                                                    <span class="font-medium-4 float-right">Type: <?php echo $vehicle->name; ?></span>
                                                </h5>
                                                <p class="list-group-item-text mb-0">
                                                    <span class="badge badge-success">Deliveries Assigned</span>
                                                    <span class="badge badge-warning ml-1"><?php echo count($vehicle_deliveries[0]); ?></span>
                                                </p>
                                            </div>
                                        </a>
                                            <?php
                                        }
                                        }
                                        else
                                        {
                                            ?>
                                            <h5 class="list-group-item-heading">There are currently no vehicles registered on the platform</h5>
                                        <?php } ?>

                                    </div>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
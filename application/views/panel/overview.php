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

            <div id="map-canvas" style="width:800px; height:560px;"></div>
            <div class="hr vpad"></div>


            <div>
                <div class="col-xl-3 col-lg-6 col-md-12 border-right-blue-grey border-right-lighten-5">
                <table>
                    <tr>
                        <td colspan="2"><b>Configuration</b></td>
                    </tr>
                    <tr>
                        <td>Travel Mode: </td>
                        <td>
                            <fieldset class="form-group position-relative">
                                <select name="bounty" class="form-control" id="travel-type">
                                    <option value="DRIVING">Car</option>
                                    <option value="BICYCLING">Bicycle</option>
                                    <option value="WALKING">Walking</option>
                                </select>
                            </fieldset>

                        </td>
                    </tr>
                    <tr>
                        <td>Avoid Highways: </td>
                        <td>
                            <fieldset class="form-group position-relative">
                                <select name="bounty" class="form-control" id="avoid-highways">
                                    <option value="1">Enabled</option>
                                    <option value="0" selected="selected">Disabled</option>
                                </select>
                            </fieldset>

                        </td>
                    </tr>
                    <tr>
                        <td>Population Size: </td>
                        <td>

                            <fieldset class="form-group position-relative">
                                <select name="bounty" class="form-control" id="population-size">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="20">20</option>
                                    <option value="50" selected="selected">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                </select>
                            </fieldset>

                        </td>
                    </tr>
                    <tr>
                        <td>Mutation Rate: </td>
                        <td>

                            <fieldset class="form-group position-relative">
                                <select name="bounty" class="form-control" id="mutation-rate">
                                    <option value="0.00">0.00</option>
                                    <option value="0.05">0.01</option>
                                    <option value="0.05">0.05</option>
                                    <option value="0.1" selected="selected">0.1</option>
                                    <option value="0.2">0.2</option>
                                    <option value="0.4">0.4</option>
                                    <option value="0.7">0.7</option>
                                    <option value="1">1.0</option>
                                </select>
                            </fieldset>

                        </td>
                    </tr>
                    <tr>
                        <td>Crossover Rate: </td>
                        <td>
                            <select id="crossover-rate">
                                <option value="0.0">0.0</option>
                                <option value="0.1">0.1</option>
                                <option value="0.2">0.2</option>
                                <option value="0.3">0.3</option>
                                <option value="0.4">0.4</option>
                                <option value="0.5" selected="selected">0.5</option>
                                <option value="0.6">0.6</option>
                                <option value="0.7">0.7</option>
                                <option value="0.8">0.8</option>
                                <option value="0.9">0.9</option>
                                <option value="1">1.0</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Elitism: </td>
                        <td>
                            <select id="elitism">
                                <option value="1" selected="selected">Enabled</option>
                                <option value="0">Disabled</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Max Generations: </td>
                        <td>
                            <select id="generations">
                                <option value="20">20</option>
                                <option value="50" selected="selected">50</option>
                                <option value="100">100</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Debug Info</b></td>
                    </tr>
                    <tr>
                        <td>Destinations Count: </td>
                        <td id="destinations-count">0</td>
                    </tr>
                    <tr class="ga-info" style="display:none;">
                        <td>Generations Computed: </td><td id="generations-passed">0</td>
                    </tr>
                    <tr class="ga-info" style="display:none;">
                        <td>Best Time: </td><td id="best-time">?</td>
                    </tr>
                    <tr id="ga-buttons">
                        <td colspan="2"><button id="find-route">Start</button> <button id="clear-map">Clear</button></td>
                    </tr>
                </table>
                </div>
            </div>



        </div>

    </div>
</div>



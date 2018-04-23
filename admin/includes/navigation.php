<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">RoadSimba Admin</a>
            </div>
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li><a href="../index.php">Home</a></li>

                <!-- message dropdown menu -->
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu message-dropdown">
                        <li class="message-preview">
                            <a href="#">
                                <div class="media">
                                    <span class="pull-left">
                                        <img class="media-object" src="http://placehold.it/50x50" alt="">
                                    </span>
                                    <div class="media-body">
                                        <h5 class="media-heading">
                                            <strong>John Smith</strong>
                                        </h5>
                                        <p class="small text-muted"><i class="fa fa-clock-o"></i> Yesterday at 4:32 PM</p>
                                        <p>Lorem ipsum dolor sit amet, consectetur...</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="message-footer">
                            <a href="#">Read All New Messages</a>
                        </li>
                    </ul>
                </li> -->

                <!-- notification dropdown menu -->
                <!-- <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                        <li>
                            <a href="#">Alert Name <span class="label label-default">Alert Badge</span></a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">View All</a>
                        </li>
                    </ul>
                </li> -->

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="./profile.php"><i class="fa fa-fw fa-user"></i> Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="../includes/logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li>
                        <a href="index.php"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#loads-dropdown"><i class="fa fa-fw fa-arrows-v"></i> Loads<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="loads-dropdown" class="collapse">
                            <li>
                                <a href="./loads.php">View All Loads</a>
                            </li>
                            <!-- ONly a broker/shipper can add loads -->
                            <?php if ($_SESSION['role'] == 2 || $_SESSION['role'] == 3) { ?>
                            <li>
                                <a href="loads.php?source=add_load">Add Load</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>

                    <!-- Only show following menu to Dispatchers (role == 1)-->
                    <?php if($_SESSION['role'] == 1) { ?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#fleet-dropdown"><i class="fa fa-fw fa-arrows-v"></i> Fleets<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="fleet-dropdown" class="collapse">
                            <li>
                                <a href="./fleets.php">View All Fleets</a>
                            </li>
                            <li>
                                <a href="fleets.php?source=add_fleet">Add Fleet</a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>
                    
                    <!-- Only show following menu to Carriers (role == 0)-->
                    <?php if ($_SESSION['role'] == 0) {?>
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#dispatcher-dropdown"><i class="fa fa-fw fa-arrows-v"></i> Dispatchers<i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="dispatcher-dropdown" class="collapse">
                            <li>
                                <a href="./dispatchers.php">View All Dispatchers</a>
                            </li>
                            <li>
                                <a href="dispatchers.php?source=add_dispatcher">Add Dispatcher</a>
                            </li>
                        </ul>
                    </li>
                    <li class="active">
                        <a href="./profile.php"><i class="fa fa-fw fa-file"></i> Profile</a>
                    </li>
                    <?php } ?>

                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>
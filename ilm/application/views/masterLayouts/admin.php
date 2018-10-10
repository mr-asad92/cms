<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from avant.redteamux.com/form-layout.php by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 11 Jan 2017 07:32:11 GMT -->
<head>
    <meta charset="utf-8">
    <title><?php echo $title;?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ILM College GRW">
    <meta name="author" content="ILM College GRW">

    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/styles.minc726.css?=140">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>


    <link href='<?php echo base_url();?>assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='styleswitcher'>

    <link href='<?php echo base_url();?>assets/demo/variations/default.css' rel='stylesheet' type='text/css' media='all' id='headerswitcher'>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries. Placeholdr.js enables the placeholder attribute -->
    <!--[if lt IE 9]>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/ie8.css">
    <script type="text/javascript" src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/respond.js/1.1.0/respond.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/charts-flot/excanvas.min.js"></script>
    <![endif]-->

    <!-- The following CSS are included as plugins and can be removed if unused-->

    <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>assets/plugins/codeprettifier/prettify.css' />
    <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>assets/plugins/form-toggle/toggles.css' />
</head>

<body class="">
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','../www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-44426473-2', 'auto');
    ga('send', 'pageview');

</script>
<div id="headerbar">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-sm-2">
                <a href="#" class="shortcut-tiles tiles-brown">
                    <div class="tiles-body">
                        <div class="pull-left"><i class="fa fa-pencil"></i></div>
                    </div>
                    <div class="tiles-footer">
                        Create Post
                    </div>
                </a>
            </div>
            <div class="col-xs-6 col-sm-2">
                <a href="#" class="shortcut-tiles tiles-grape">
                    <div class="tiles-body">
                        <div class="pull-left"><i class="fa fa-group"></i></div>
                        <div class="pull-right"><span class="badge">2</span></div>
                    </div>
                    <div class="tiles-footer">
                        Contacts
                    </div>
                </a>
            </div>
            <div class="col-xs-6 col-sm-2">
                <a href="#" class="shortcut-tiles tiles-primary">
                    <div class="tiles-body">
                        <div class="pull-left"><i class="fa fa-envelope-o"></i></div>
                        <div class="pull-right"><span class="badge">10</span></div>
                    </div>
                    <div class="tiles-footer">
                        Messages
                    </div>
                </a>
            </div>
            <div class="col-xs-6 col-sm-2">
                <a href="#" class="shortcut-tiles tiles-inverse">
                    <div class="tiles-body">
                        <div class="pull-left"><i class="fa fa-camera"></i></div>
                        <div class="pull-right"><span class="badge">3</span></div>
                    </div>
                    <div class="tiles-footer">
                        Gallery
                    </div>
                </a>
            </div>

            <div class="col-xs-6 col-sm-2">
                <a href="#" class="shortcut-tiles tiles-midnightblue">
                    <div class="tiles-body">
                        <div class="pull-left"><i class="fa fa-cog"></i></div>
                    </div>
                    <div class="tiles-footer">
                        Settings
                    </div>
                </a>
            </div>
            <div class="col-xs-6 col-sm-2">
                <a href="#" class="shortcut-tiles tiles-orange">
                    <div class="tiles-body">
                        <div class="pull-left"><i class="fa fa-wrench"></i></div>
                    </div>
                    <div class="tiles-footer">
                        Plugins
                    </div>
                </a>
            </div>

        </div>
    </div>
</div>

<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title="Toggle Sidebar"></a>
    <a id="rightmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="left" title="Toggle Infobar"></a>

    <div class="navbar-header pull-left">
        <a class="navbar-brand" href="index.html">Avant</a>
    </div>

    <ul class="nav navbar-nav pull-right toolbar">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span class="hidden-xs">John McCartney <i class="fa fa-caret-down"></i></span><img src="<?php echo base_url();?>assets/demo/avatar/dangerfield.png" alt="Dangerfield" /></a>
            <ul class="dropdown-menu userinfo arrow">
                <li class="username">
                    <a href="#">
                        <div class="pull-left"><img src="<?php echo base_url();?>assets/demo/avatar/dangerfield.png" alt="Jeff Dangerfield"/></div>
                        <div class="pull-right"><h5>Howdy, John!</h5><small>Logged in as <span>john275</span></small></div>
                    </a>
                </li>
                <li class="userlinks">
                    <ul class="dropdown-menu">
                        <?php if($this->session->userdata('user_id')):?>
                            <?php $user_id = $this->session->userdata('user_id');?>
                        <?php endif;?>
                        <li><a href="<?php echo base_url().'users/edit_profile/'.$user_id ;?>">Edit Profile <i
                                        class="pull-right fa
                        fa-pencil"></i></a></li>
                        <li><a href="<?php echo base_url().'authentication/change_password';?>">Change Password <i class="pull-right fa fa-lock"></i></a></li>
                        <li><a href="#">Account <i class="pull-right fa fa-cog"></i></a></li>
                        <li><a href="#">Help <i class="pull-right fa fa-question-circle"></i></a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url().'authentication/logout'?>" class="text-right">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li class="dropdown">
            <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><i class="fa fa-bell"></i><span class="badge">3</span></a>
            <ul class="dropdown-menu notifications arrow">
                <li class="dd-header">
                    <span>You have 3 new notification(s)</span>
                    <span><a href="#">Mark all Seen</a></span>
                </li>
                <div class="scrollthis">
                    <li>
                        <a href="#" class="notification-user active">
                            <span class="time">4 mins</span>
                            <i class="fa fa-user"></i>
                            <span class="msg">New user Registered. </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="notification-danger active">
                            <span class="time">20 mins</span>
                            <i class="fa fa-bolt"></i>
                            <span class="msg">CPU at 92% on server#3! </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="notification-success active">
                            <span class="time">1 hr</span>
                            <i class="fa fa-check"></i>
                            <span class="msg">Server#1 is live. </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="notification-warning">
                            <span class="time">2 hrs</span>
                            <i class="fa fa-exclamation-triangle"></i>
                            <span class="msg">Database overloaded. </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="notification-order">
                            <span class="time">10 hrs</span>
                            <i class="fa fa-shopping-cart"></i>
                            <span class="msg">New order received. </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="notification-failure">
                            <span class="time">12 hrs</span>
                            <i class="fa fa-times-circle"></i>
                            <span class="msg">Application error!</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="notification-fix">
                            <span class="time">12 hrs</span>
                            <i class="fa fa-wrench"></i>
                            <span class="msg">Installation Succeeded.</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="notification-success">
                            <span class="time">18 hrs</span>
                            <i class="fa fa-check"></i>
                            <span class="msg">Account Created. </span>
                        </a>
                    </li>
                </div>
                <li class="dd-footer"><a href="#">View All Notifications</a></li>
            </ul>
        </li>
    </ul>
</header>

<div id="page-container">
    <!-- BEGIN SIDEBAR -->
    <!-- BEGIN SIDEBAR -->
    <nav id="page-leftbar" role="navigation">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="acc-menu" id="sidebar">

            <li class="divider"></li>


            <li><a href="<?php echo base_url()."admin";?>"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>


            <li class="open hasChild">
                <a href="javascript:;"><i class="fa fa-user"></i> <span>Admin</span> </a>
                <ul class="acc-menu" style="display: block;">
                    <li><a href="<?php echo base_url();?>users"><span>Employee List</span></a></li>
                    <li><a href="<?php echo base_url() ; ?>programs"><span>Programs</span></a></li>
                    <li><a href="<?php echo base_url() ; ?>classes"><span>Classes</span></a></li>
                </ul>
            </li>

            <li class="open hasChild">
                <a href="javascript:;"><i class="fa fa-graduation-cap"></i> <span>Admission Office</span> </a>
                <ul class="acc-menu" style="display: block;">
                    <li class="active"><a href="<?php echo base_url()."admin/index";?>"><span>Registration</span></a></li>
                    <li><a href="<?php echo base_url();?>admin/studentsList"><span>Students List</span></a></li>
                </ul>
            </li>


            <li class="open hasChild">
                <a href="javascript:;"><i class="fa fa-print"></i> <span>Fee Collection</span> </a>
                <ul class="acc-menu" style="display: block;">
                    <li><a href="<?php echo base_url() ; ?>Vouchers"><span>Fee Vouchers</span></a></li>
                    <li><a href="<?php echo base_url() ; ?>admin/fee_payments"><span>Fee payments</span></a></li>
                </ul>
            </li>
            <li class="open hasChild">
                <a href="javascript:;"><i class="fa fa-pencil-square-o"></i> <span>Accounts Office</span> </a>
                <ul class="acc-menu" style="display: block;">
                    <li><a href="<?php echo base_url() ; ?>accounts"><span>Charts of Account</span></a></li>
                    <li><a href="<?php echo base_url() ; ?>accounts"><span>Transactions</span></a></li>
                    <li><a href="<?php echo base_url() ; ?>accounts"><span>Journal</span></a></li>
                    <li><a href="<?php echo base_url() ; ?>accounts"><span>Ledger</span></a></li>
                    <li><a href="<?php echo base_url() ; ?>accounts"><span>Trial Balance</span></a></li>
                    <li><a href="<?php echo base_url() ; ?>accounts"><span>Profit & Loss</span></a></li>
                </ul>
            </li>
            <li class="open hasChild">
                <a href="javascript:;"><i class="fa fa-cog"></i> <span>Settings</span> </a>
                <ul class="acc-menu" style="display: block;">
                    <li><a href="<?php echo base_url();?>users"><span>Build Profile</span></a></li>
                    <li><a href="<?php echo base_url();?>users"><span>Change Password</span></a></li>
                    <li><a href="<?php echo base_url();?>users"><span>Forgot Password</span></a></li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </nav>

    <!-- BEGIN RIGHTBAR -->
    <div id="page-rightbar">

        <div id="chatarea">
            <div class="chatuser">
                <span class="pull-right">Jane Smith</span>
                <a id="hidechatbtn" class="btn btn-default btn-sm"><i class="fa fa-arrow-left"></i> Back</a>
            </div>
            <div class="chathistory">
                <div class="chatmsg">
                    <p>Hey! How's it going?</p>
                    <span class="timestamp">1:20:42 PM</span>
                </div>
                <div class="chatmsg sent">
                    <p>Not bad... i guess. What about you? Haven't gotten any updates from you in a long time.</p>
                    <span class="timestamp">1:20:46 PM</span>
                </div>
                <div class="chatmsg">
                    <p>Yeah! I've been a bit busy lately. I'll get back to you soon enough.</p>
                    <span class="timestamp">1:20:54 PM</span>
                </div>
                <div class="chatmsg sent">
                    <p>Alright, take care then.</p>
                    <span class="timestamp">1:21:01 PM</span>
                </div>
            </div>
            <div class="chatinput">
                <textarea name="" rows="2"></textarea>
            </div>
        </div>

        <div id="widgetarea">
            <div class="widget">
                <div class="widget-heading">
                    <a href="javascript:;" data-toggle="collapse" data-target="#accsummary"><h4>Account Summary</h4></a>
                </div>
                <div class="widget-body collapse in" id="accsummary">
                    <div class="widget-block" style="background: #7ccc2e; margin-top:10px;">
                        <div class="pull-left">
                            <small>Current Balance</small>
                            <h5>$71,182</h5>
                        </div>
                        <div class="pull-right"><div id="currentbalance"></div></div>
                    </div>
                    <div class="widget-block" style="background: #595f69;">
                        <div class="pull-left">
                            <small>Account Type</small>
                            <h5>Business Plan A</h5>
                        </div>
                        <div class="pull-right">
                            <small class="text-right">Monthly</small>
                            <h5>$19<small>.99</small></h5>
                        </div>
                    </div>
                    <span class="more"><a href="#">Upgrade Account</a></span>
                </div>
            </div>


            <div id="chatbar" class="widget">
                <div class="widget-heading">
                    <a href="javascript:;" data-toggle="collapse" data-target="#chatbody"><h4>Online Contacts <small>(5)</small></h4></a>
                </div>
                <div class="widget-body collapse in" id="chatbody">
                    <ul class="chat-users">
                        <li data-stats="online"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/potter.png" alt=""><span>Jeremy Potter</span></a></li>
                        <li data-stats="online"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/tennant.png" alt=""><span>David Tennant</span></a></li>
                        <li data-stats="online"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/johansson.png" alt=""><span>Anna Johansson</span></a></li>
                        <li data-stats="busy"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/jackson.png" alt=""><span>Eric Jackson</span></a></li>
                        <li data-stats="away"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/jobs.png" alt=""><span>Howard Jobs</span></a></li>
                        <!--li data-stats="offline"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/watson.png" alt=""><span>Annie Watson</span></a></li>
                        <li data-stats="offline"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/doyle.png" alt=""><span>Alan Doyle</span></a></li>
                        <li data-stats="offline"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/corbett.png" alt=""><span>Simon Corbett</span></a></li>
                        <li data-stats="offline"><a href="javascript:;"><img src="<?php echo base_url();?>assets/demo/avatar/paton.png" alt=""><span>Polly Paton</span></a></li-->
                    </ul>
                    <span class="more"><a href="#">See all</a></span>
                </div>
            </div>

            <div class="widget">
                <div class="widget-heading">
                    <a href="javascript:;" data-toggle="collapse" data-target="#taskbody"><h4>Pending Tasks <small>(5)</small></h4></a>
                </div>
                <div class="widget-body collapse in" id="taskbody">
                    <div class="contextual-progress" style="margin-top:10px;">
                        <div class="clearfix">
                            <div class="progress-title">Backend Development</div>
                            <div class="progress-percentage"><span class="label label-info">Today</span> 25%</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-info" style="width: 25%"></div>
                        </div>
                    </div>
                    <div class="contextual-progress">
                        <div class="clearfix">
                            <div class="progress-title">Bug Fix</div>
                            <div class="progress-percentage"><span class="label label-primary">Tomorrow</span> 17%</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-primary" style="width: 17%"></div>
                        </div>
                    </div>
                    <div class="contextual-progress">
                        <div class="clearfix">
                            <div class="progress-title">Javascript Code</div>
                            <div class="progress-percentage">70%</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" style="width: 70%"></div>
                        </div>
                    </div>
                    <div class="contextual-progress">
                        <div class="clearfix">
                            <div class="progress-title">Preparing Documentation</div>
                            <div class="progress-percentage">6%</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-danger" style="width: 6%"></div>
                        </div>
                    </div>
                    <div class="contextual-progress">
                        <div class="clearfix">
                            <div class="progress-title">App Development</div>
                            <div class="progress-percentage">20%</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar progress-bar-orange" style="width: 20%"></div>
                        </div>
                    </div>

                    <span class="more"><a href="ui-progressbars.html">View all Pending</a></span>
                </div>
            </div>



            <div class="widget">
                <div class="widget-heading">
                    <a href="javascript:;" data-toggle="collapse" data-target="#storagespace"><h4>Storage Space</h4></a>
                </div>
                <div class="widget-body collapse in" id="storagespace">
                    <div class="clearfix" style="margin-bottom: 5px;margin-top:10px;">
                        <div class="progress-title pull-left">1.31 GB of 1.50 GB used</div>
                        <div class="progress-percentage pull-right">87.3%</div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success" style="width: 50%"></div>
                        <div class="progress-bar progress-bar-warning" style="width: 25%"></div>
                        <div class="progress-bar progress-bar-danger" style="width: 12.3%"></div>
                    </div>
                </div>
            </div>

            <div class="widget">
                <div class="widget-heading">
                    <a href="javascript:;" data-toggle="collapse" data-target="#serverstatus"><h4>Server Status</h4></a>
                </div>
                <div class="widget-body collapse in" id="serverstatus">
                    <div class="clearfix" style="padding: 10px 24px;">
                        <div class="pull-left">
                            <div class="easypiechart" id="serverload" data-percent="67">
                                <span class="percent"></span>
                            </div>
                            <label for="serverload">Load</label>
                        </div>
                        <div class="pull-right">
                            <div class="easypiechart" id="ramusage" data-percent="20.6">
                                <span class="percent"></span>
                            </div>
                            <label for="ramusage">RAM: 422MB</label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    <div id="feePayModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Pay Fee</h4>
                </div>
                <div class="modal-body" id="payFeeModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>



    <!-- END RIGHTBAR -->
    <div id="page-content">
        <div id="wrap">
            <div class="container">

                <?php
                $this->load->view($view);
                ?>

                <div class="container">
                    <?php
                    if ($this->session->flashdata('errors')) {
                        echo $this->session->flashdata('errors');
                    }
                    if ($this->session->flashdata('msg')) {
                        echo $this->session->flashdata('msg');
                    }

                    ?>
                </div>

            </div>
        </div> <!-- container -->
    </div> <!-- wrap -->
</div> <!-- page-content -->

<footer role="contentinfo">
    <div class="clearfix">
        <ul class="list-unstyled list-inline pull-left">
            <li>VNext &copy; 2018</li>
        </ul>
        <button class="pull-right btn btn-inverse-alt btn-xs hidden-print" id="back-to-top"><i class="fa fa-arrow-up"></i></button>
    </div>
</footer>

</div> <!-- page-container -->

<!--
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

<script>!window.jQuery && document.write(unescape('%3Cscript src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"%3E%3C/script%3E'))</script>
<script type="text/javascript">!window.jQuery.ui && document.write(unescape('%3Cscript src="<?php echo base_url();?>assets/js/jqueryui-1.10.3.min.js'))</script>
-->

<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery-1.10.2.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jqueryui-1.10.3.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/bootstrap.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/enquire.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.cookie.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/jquery.nicescroll.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/plugins/form-jasnyupload/fileinput.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/plugins/codeprettifier/prettify.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/plugins/easypiechart/jquery.easypiechart.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/plugins/sparklines/jquery.sparklines.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/plugins/form-toggle/toggle.min.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/placeholdr.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/application.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/demo/demo.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/js/registration.js'></script>
<script type='text/javascript' src='<?php echo base_url();?>assets/plugins/form-datepicker/js/bootstrap-datepicker.js'></script>

<script type='text/javascript' src='<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js'></script>
<script>
    $(document).ready( function () {
        $('#studentsList').DataTable();
    } );

    $(document).ready( function () {
        $('#vouchersList').DataTable();
    } );

    $(document).ready( function () {
        $('#accountsList').DataTable(
            {
                "bSort": false
            }
        );


        $('#addAccountsModal').on('hidden.bs.modal', function () {
            window.location.reload();
        })

        $("#saveAccountBtn").click(function () {

            var form = $("#addAccountForm")[0];

            $.ajax({
                url:'<?php echo base_url()."accounts/addAccount";?>',
                type: 'post',
                data: new FormData(form),
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    var src = '<?php echo base_url();?>assets/img/ajax-loader.gif';
                    $("#messageLoader").html("<img src='"+src+"' alt=''>&nbsp;<b>Saving .. </b>");
                },
                success: function (response) {
                    $("#messageLoader").html("Saved!");
                },
                error: function (err) {
                    console.log(JSON.stringify(err, null, 4));
                    $("#messageLoader").html("Error!");
                }

            });
        });
    });

    $('#checkAll').click(function () {
        $('input:checkbox').prop('checked', this.checked);
    });


    $("#btnPrintsel").on('click', function(){

        $('input:checkbox.chkbulk').each(function () {
            var printId = (this.checked ? $(this).val() : "");

            if(printId != ''){
                console.log(printId);

                $("#"+printId)[0].click();
            }

        });


    });

    function deleteAccount(id) {
        $.ajax({
            url:'<?php echo base_url()."accounts/deleteAccount/";?>'+id,
            type: 'post',
            data: {id: id},
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                if(response == "deleted"){
                    $("#"+id).remove();
                    alert("Account Deleted!");
                }
            },
            error: function (err) {
                console.log(JSON.stringify(err, null, 4));
            }

        });
    }

</script>
</body>


</html>
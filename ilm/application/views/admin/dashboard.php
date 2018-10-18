
<h1>Dashboard</h1>
<div class="options">
    <div class="btn-toolbar">
        <button class="btn btn-default" id="daterangepicker2">
            <i class="fa fa-calendar-o"></i>
            <span class="hidden-xs hidden-sm">December 12, 2016 - January 11, 2017</span> <b class="caret"></b>
        </button>
        <div class="btn-group hidden-xs">
            <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cloud-download"></i><span class="hidden-xs hidden-sm hidden-md"> Export as</span> <span class="caret"></span></a>
            <ul class="dropdown-menu">
                <li><a href="#">Text File (*.txt)</a></li>
                <li><a href="#">Excel File (*.xlsx)</a></li>
                <li><a href="#">PDF File (*.pdf)</a></li>
            </ul>
        </div>
        <style>
            .btn-default.btn-on-1.active{background-color: #428bca;color: white;}
            .btn-default.btn-off-1.active{background-color: #DA4F49;color: white;}
        </style>
        <div class="btn-group" id="status" data-toggle="buttons">
            <label class="btn btn-default btn-on-1 btn-sm active">
                <input type="radio" value="1" name="multifeatured_module[module_id][status]" checked="checked">ON</label>
            <label class="btn btn-default btn-off-1 btn-sm ">
                <input type="radio" value="0" name="multifeatured_module[module_id][status]">OFF</label>
        </div>
        <br>
        <br>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-toyo" href="<?php echo base_url() ; ?>accounts/cash_book">
                        <div class="tiles-heading" style="font-size: 12px;"><b>Cash In hand</b></div>
                        <div class="tiles-body-alt">
                            <!--i class="fa fa-bar-chart-o"></i-->
                            <div class="text-center"><span class="text-top">Rs</span><?php echo $grand_total;?></div>
<!--                            <small>+8.7% from last period</small>-->
                        </div>
                        <div class="tiles-footer">more info</div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-success" href="#">
                        <div class="tiles-heading" style="font-size: 12px;"><b>Income of Current Month</b></div>
                        <div class="tiles-body-alt">
                            <!--i class="fa fa-money"></i-->
                            <div class="text-center"><span class="text-top">Rs</span><?php echo number_shorten($current_month_income);?></div>
<!--                            <small>-13.5% from last week</small>-->
                        </div>
                        <div class="tiles-footer">go to accounts</div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-orange" href="#">
                        <div class="tiles-heading" style="font-size: 12px;"><b>Expense of Current Month</b></div>
                        <div class="tiles-body-alt">
                            <i class="fa fa-group"></i>
                            <div class="text-center"><?php echo number_shorten($current_month_expense);?></div>
<!--                            <small>new users registered</small>-->
                        </div>
                        <div class="tiles-footer">manage members</div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-alizarin" href="#">
                        <div class="tiles-heading" style="font-size: 12px;"><b>Expected Fee</b></div>
                        <div class="tiles-body-alt">
                            <i class="fa fa-shopping-cart"></i>
                            <div class="text-center"><?php echo number_shorten($current_month_expected_fee);?></div>
<!--                            <small>new orders received</small>-->
                        </div>
                        <div class="tiles-footer">manage orders</div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-success" href="#">
                        <div class="tiles-heading" style="font-size: 12px;"><b>Total Fee Received</b></div>
                        <div class="tiles-body-alt">
                            <!--i class="fa fa-bar-chart-o"></i-->
                            <div class="text-center"><span class="text-top">Rs</span><?php echo number_shorten($total_fee_received);?></div>
<!--                            <small>+8.7% from last period</small>-->
                        </div>
                        <div class="tiles-footer">more info</div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-alizarin" href="#">
                        <div class="tiles-heading" style="font-size: 12px;"><b>Total Receiveable</b></div>
                        <div class="tiles-body-alt">
                            <!--i class="fa fa-money"></i-->
                            <div class="text-center"><span class="text-top">Rs</span><?php echo number_shorten($total_fee_receiveable);?></div>
<!--                            <small>-13.5% from last week</small>-->
                        </div>
                        <div class="tiles-footer">go to accounts</div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-success" href="#">
                        <div class="tiles-heading " style="font-size: 12px;"><b>Total Active Students</b></div>
                        <div class="tiles-body-alt">
                            <i class="fa fa-group"></i>
                            <div class="text-center"><?php echo $total_active_students;?></div>
<!--                            <small>new users registered</small>-->
                        </div>
                        <div class="tiles-footer">manage members</div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-alizarin" href="#">
                        <div class="tiles-heading" style="font-size: 12px;"><b>Total suspend & Leave Student</b></div>
                        <div class="tiles-body-alt">
                            <i class="fa fa-shopping-cart"></i>
                            <div class="text-center"><?php echo $total_inactive_students;?></div>
<!--                            <small>new orders received</small>-->
                        </div>
                        <div class="tiles-footer">manage orders</div>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4><i class="icon-highlight fa fa-calendar"></i> Calendar</h4>
                    <div class="options">
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body" id="calendardemo">
                    <div id="calendar-drag" class="fc fc-ltr"><table class="fc-header" style="width:100%"><tbody><tr><td class="fc-header-left"><span class="fc-header-title"><h2>October 2018</h2></span></td><td class="fc-header-center"></td><td class="fc-header-right"><span class="fc-button fc-button-prev fc-state-default fc-corner-left" unselectable="on"><i class="fa fa-angle-left"></i></span><span class="fc-button fc-button-next fc-state-default fc-corner-right" unselectable="on"><i class="fa fa-angle-right"></i></span></td></tr></tbody></table><div class="fc-content" style="position: relative;"><div class="fc-view fc-view-month fc-grid" style="position:relative" unselectable="on"><div class="fc-event-container" style="position:absolute;z-index:8;top:0;left:0"><div class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end" style="position: absolute; left: 71px; background-color: rgb(239, 161, 49); width: 63px; top: 103px;"><div class="fc-event-inner"><span class="fc-event-title">All Day Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-hori fc-event-draggable fc-event-end" style="position: absolute; left: 1px; background-color: rgb(122, 134, 156); width: 65px; top: 45px;"><div class="fc-event-inner"><span class="fc-event-title">Long Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end" style="position: absolute; left: 411px; background-color: rgb(231, 76, 60); width: 68px; top: 45px;"><div class="fc-event-inner"><span class="fc-event-time">4p</span><span class="fc-event-title">Repeating Event</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end" style="position: absolute; left: 139px; background-color: rgb(118, 196, 237); width: 63px; top: 45px;"><div class="fc-event-inner"><span class="fc-event-time">10:30a</span><span class="fc-event-title">Meeting</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end" style="position: absolute; left: 139px; background-color: rgb(52, 73, 94); width: 63px; top: 62px;"><div class="fc-event-inner"><span class="fc-event-time">12p</span><span class="fc-event-title">Lunch</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><div class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end" style="position: absolute; left: 207px; background-color: rgb(43, 188, 224); width: 63px; top: 45px;"><div class="fc-event-inner"><span class="fc-event-time">7p</span><span class="fc-event-title">Birthday Party</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></div><a href="http://google.com/" class="fc-event fc-event-hori fc-event-draggable fc-event-start fc-event-end" style="position: absolute; left: 3px; background-color: rgb(241, 196, 15); width: 131px; top: 268px;"><div class="fc-event-inner"><span class="fc-event-title">Click for Google</span></div><div class="ui-resizable-handle ui-resizable-e">&nbsp;&nbsp;&nbsp;</div></a></div><table class="fc-border-separate" style="width:100%" cellspacing="0"><thead><tr class="fc-first fc-last"><th class="fc-day-header fc-sun fc-widget-header fc-first" style="width: 68px;">Sun</th><th class="fc-day-header fc-mon fc-widget-header" style="width: 68px;">Mon</th><th class="fc-day-header fc-tue fc-widget-header" style="width: 68px;">Tue</th><th class="fc-day-header fc-wed fc-widget-header" style="width: 68px;">Wed</th><th class="fc-day-header fc-thu fc-widget-header" style="width: 68px;">Thu</th><th class="fc-day-header fc-fri fc-widget-header" style="width: 68px;">Fri</th><th class="fc-day-header fc-sat fc-widget-header fc-last">Sat</th></tr></thead><tbody><tr class="fc-week fc-first"><td class="fc-day fc-sun fc-widget-content fc-other-month fc-past fc-first" data-date="2018-09-30"><div style="min-height: 53px;"><div class="fc-day-number">30</div><div class="fc-day-content"><div style="position: relative; height: 34px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content fc-past" data-date="2018-10-01"><div><div class="fc-day-number">1</div><div class="fc-day-content"><div style="position: relative; height: 34px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-today fc-state-highlight" data-date="2018-10-02"><div><div class="fc-day-number">2</div><div class="fc-day-content"><div style="position: relative; height: 34px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content fc-future" data-date="2018-10-03"><div><div class="fc-day-number">3</div><div class="fc-day-content"><div style="position: relative; height: 34px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content fc-future" data-date="2018-10-04"><div><div class="fc-day-number">4</div><div class="fc-day-content"><div style="position: relative; height: 34px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content fc-future" data-date="2018-10-05"><div><div class="fc-day-number">5</div><div class="fc-day-content"><div style="position: relative; height: 34px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-future fc-last" data-date="2018-10-06"><div><div class="fc-day-number">6</div><div class="fc-day-content"><div style="position: relative; height: 34px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td class="fc-day fc-sun fc-widget-content fc-future fc-first" data-date="2018-10-07"><div style="min-height: 53px;"><div class="fc-day-number">7</div><div class="fc-day-content"><div style="position: relative; height: 33px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content fc-future" data-date="2018-10-08"><div><div class="fc-day-number">8</div><div class="fc-day-content"><div style="position: relative; height: 33px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-future" data-date="2018-10-09"><div><div class="fc-day-number">9</div><div class="fc-day-content"><div style="position: relative; height: 33px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content fc-future" data-date="2018-10-10"><div><div class="fc-day-number">10</div><div class="fc-day-content"><div style="position: relative; height: 33px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content fc-future" data-date="2018-10-11"><div><div class="fc-day-number">11</div><div class="fc-day-content"><div style="position: relative; height: 33px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content fc-future" data-date="2018-10-12"><div><div class="fc-day-number">12</div><div class="fc-day-content"><div style="position: relative; height: 33px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-future fc-last" data-date="2018-10-13"><div><div class="fc-day-number">13</div><div class="fc-day-content"><div style="position: relative; height: 33px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td class="fc-day fc-sun fc-widget-content fc-future fc-first" data-date="2018-10-14"><div style="min-height: 53px;"><div class="fc-day-number">14</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content fc-future" data-date="2018-10-15"><div><div class="fc-day-number">15</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-future" data-date="2018-10-16"><div><div class="fc-day-number">16</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content fc-future" data-date="2018-10-17"><div><div class="fc-day-number">17</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content fc-future" data-date="2018-10-18"><div><div class="fc-day-number">18</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content fc-future" data-date="2018-10-19"><div><div class="fc-day-number">19</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-future fc-last" data-date="2018-10-20"><div><div class="fc-day-number">20</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td class="fc-day fc-sun fc-widget-content fc-future fc-first" data-date="2018-10-21"><div style="min-height: 53px;"><div class="fc-day-number">21</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content fc-future" data-date="2018-10-22"><div><div class="fc-day-number">22</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-future" data-date="2018-10-23"><div><div class="fc-day-number">23</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content fc-future" data-date="2018-10-24"><div><div class="fc-day-number">24</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content fc-future" data-date="2018-10-25"><div><div class="fc-day-number">25</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content fc-future" data-date="2018-10-26"><div><div class="fc-day-number">26</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-future fc-last" data-date="2018-10-27"><div><div class="fc-day-number">27</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td></tr><tr class="fc-week"><td class="fc-day fc-sun fc-widget-content fc-future fc-first" data-date="2018-10-28"><div style="min-height: 53px;"><div class="fc-day-number">28</div><div class="fc-day-content"><div style="position: relative; height: 17px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content fc-future" data-date="2018-10-29"><div><div class="fc-day-number">29</div><div class="fc-day-content"><div style="position: relative; height: 17px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-future" data-date="2018-10-30"><div><div class="fc-day-number">30</div><div class="fc-day-content"><div style="position: relative; height: 17px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content fc-future" data-date="2018-10-31"><div><div class="fc-day-number">31</div><div class="fc-day-content"><div style="position: relative; height: 17px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content fc-other-month fc-future" data-date="2018-11-01"><div><div class="fc-day-number">1</div><div class="fc-day-content"><div style="position: relative; height: 17px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content fc-other-month fc-future" data-date="2018-11-02"><div><div class="fc-day-number">2</div><div class="fc-day-content"><div style="position: relative; height: 17px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-other-month fc-future fc-last" data-date="2018-11-03"><div><div class="fc-day-number">3</div><div class="fc-day-content"><div style="position: relative; height: 17px;">&nbsp;</div></div></div></td></tr><tr class="fc-week fc-last"><td class="fc-day fc-sun fc-widget-content fc-other-month fc-future fc-first" data-date="2018-11-04"><div style="min-height: 58px;"><div class="fc-day-number">4</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-mon fc-widget-content fc-other-month fc-future" data-date="2018-11-05"><div><div class="fc-day-number">5</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-tue fc-widget-content fc-other-month fc-future" data-date="2018-11-06"><div><div class="fc-day-number">6</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-wed fc-widget-content fc-other-month fc-future" data-date="2018-11-07"><div><div class="fc-day-number">7</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-thu fc-widget-content fc-other-month fc-future" data-date="2018-11-08"><div><div class="fc-day-number">8</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-fri fc-widget-content fc-other-month fc-future" data-date="2018-11-09"><div><div class="fc-day-number">9</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td><td class="fc-day fc-sat fc-widget-content fc-other-month fc-future fc-last" data-date="2018-11-10"><div><div class="fc-day-number">10</div><div class="fc-day-content"><div style="position: relative; height: 0px;">&nbsp;</div></div></div></td></tr></tbody></table></div></div></div>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-indigo">
                <div class="panel-heading">
                    <h4>Events</h4>
                    <div class="options">
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>List item</li>
                        <li>List item</li>
                        <li>List item</li>
                        <li>List item</li>
                        <li>List item</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-grape">
                <div class="panel-heading">
                    <h4>Events</h4>
                    <div class="options">
                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <ul>
                        <li>List item</li>
                        <li>List item</li>
                        <li>List item</li>
                        <li>List item</li>
                        <li>List item</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <h4>Quick Links</h4>
                    <div class="options">

                        <a href="javascript:;" class="panel-collapse"><i class="fa fa-chevron-down"></i></a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-xs-12 col-md-3 col-sm-6 col-lg-4">
                            <a class="info-tiles tiles-alizarin" href="#">
                                <div class="tiles-heading">
                                    <div class="pull-left">Reports</div>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="fa fa-list" aria-hidden="true" "=""></i></div>
                                    <div class="pull-right">Exam Reports</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-md-3 col-sm-6 col-lg-4">
                            <a class="info-tiles tiles-orange" href="#">
                                <div class="tiles-heading">
                                    <div class="pull-left">Attendence</div>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="fa fa-eye" aria-hidden="true"></i></div>
                                    <div class="pull-right">Employee Atte</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-md-3 col-sm-6 col-lg-4">
                            <a class="info-tiles tiles-success" href="#">
                                <div class="tiles-heading">
                                    <div class="pull-left">Admissions</div>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="fa fa-user"></i></div>
                                    <div class="pull-right">New Admissions</div>
                                </div>
                            </a>
                        </div>
                        <div class="col-xs-12 col-md-3 col-sm-6 col-lg-4">
                            <a class="info-tiles tiles-toyo" href="#">
                                <div class="tiles-heading">
                                    <div class="pull-left">Income</div>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="fa fa-usd"></i></div>
                                    <div class="pull-right">Total income</div>
                                </div>
                            </a>
                        </div>

                        <div class="col-xs-12 col-md-3 col-sm-6 col-lg-4">
                            <a class="info-tiles tiles-success" href="#">
                                <div class="tiles-heading">
                                    <div class="pull-left">Expenses</div>
                                    <div class="pull-right"></div>
                                </div>
                                <div class="tiles-body">
                                    <div class="pull-left"><i class="fa fa-eur"></i></div>
                                    <div class="pull-right">Expenses</div>
                                </div>
                            </a>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 col-md-3 col-sm-6 col-lg-4">
                                <a class="info-tiles tiles-alizarin" href="#">
                                    <div class="tiles-heading">
                                        <div class="pull-left">Applicants</div>
                                        <div class="pull-right"></div>
                                    </div>
                                    <div class="tiles-body">
                                        <div class="pull-left"><i class="fa fa-users" aria-hidden="true"></i></div>
                                        <div class="pull-right">Applicants</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div> <!-- container -->
                </div>
            </div>
        </div>
    </div>
</div> <!--wrap -->
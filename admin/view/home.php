<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="media" style="padding: 15px 25px">
                <div class="media-left">
                    <img src="../assets/images/Al-Irsyad-Satya-Ilamic-School.png" height="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Welcome to <?= apps_name ?></h4>
                    Dashboard admin panel
                </div>
            </div>            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-bg-color-icon card-box fadeInDown animated">
                <div class="bg-icon bg-icon-info pull-left">
                    <i class="fa fa-users text-info"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark" id="voters"><b class="counter"></b></h3>
                    <p class="text-muted">Total Voters</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-pink pull-left">
                    <i class="md md-add-shopping-cart text-pink"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b class="counter"></b></h3>
                    <p class="text-muted"></p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-purple pull-left">
                    <i class="md md-equalizer text-purple"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b class="counter">0.16</b>%</h3>
                    <p class="text-muted">Conversion</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="widget-bg-color-icon card-box">
                <div class="bg-icon bg-icon-success pull-left">
                    <i class="md md-remove-red-eye text-success"></i>
                </div>
                <div class="text-right">
                    <h3 class="text-dark"><b class="counter">64,570</b></h3>
                    <p class="text-muted">Today's Visits</p>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">
            <div class="card-box">
                <h4 class="text-dark header-title m-t-0 m-b-30">Total Voters</h4>

                <div class="widget-chart text-center" style="height: 281px">
                    <input class="knob" data-width="150" data-height="150" data-linecap=round data-fgColor="#fb6d9d" value="100%" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".15"/>
                    <ul class="list-inline m-t-15">
                        <li>
                            <h5 class="text-muted m-t-20">Target</h5>
                            <h4 class="m-b-0">100%</h4>
                        </li>                        
                        <li>
                            <h5 class="text-muted m-t-20">Last Year</h5>
                            <h4 class="m-b-0" id="ly">40.15%</h4>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card-box">
                <h4 class="text-dark header-title m-t-0">Class Analytics</h4>
                
                <div id="morris-bar-stacked" style="height: 303px;"></div>
            </div>
        </div>

    </div>
    <!-- end row -->
</div>
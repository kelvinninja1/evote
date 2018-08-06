<!DOCTYPE html>
<html>
    <?= $main->get_head() ?>    
    <body class="fixed-left">
        <!-- Begin page -->
        <div id="wrapper">
            <!-- Top Bar Start -->
            <?= $main->get_topbar() ?>
            
            <!-- Top Bar End -->	
            <!-- ========== Left Sidebar Start ========== -->
            <?= $main->get_menu() ?>
            
            <!-- Left Sidebar End -->
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <?= $main->get_page() ?>
                </div> <!-- content -->

                <footer class="footer text-right">
                    <div class="pull-left"><?=apps_name?> - <?=company_name?></div>                    
                    <div class="text-right">Copyright © <?= date('Y') ?>.</div>
                </footer>
            </div>
        </div>
        <!-- END wrapper -->
        <script>
            var resizefunc = [];
        </script>
        
        <!-- jQuery  -->
        <script src="../assets/js/jquery.min.js"></script>
        <script src="../assets/js/bootstrap.min.js"></script>
        <script src="../assets/js/detect.js"></script>
        <script src="../assets/js/fastclick.js"></script>
        <script src="../assets/js/jquery.slimscroll.js"></script>
        <script src="../assets/js/jquery.blockUI.js"></script>
        <script src="../assets/js/waves.js"></script>
        <script src="../assets/js/wow.min.js"></script>
        <script src="../assets/js/jquery.nicescroll.js"></script>
        <script src="../assets/js/jquery.scrollTo.min.js"></script>
        
        <script src="../assets/plugins/notifyjs/js/notify.js"></script>
        <script src="../assets/plugins/notifications/notify-metro.js"></script>                
        
        <script src="../assets/plugins/moment/moment.js"></script>
     	<script src="../assets/plugins/timepicker/bootstrap-timepicker.js"></script>
     	<script src="../assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
     	<script src="../assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
     	<script src="../assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js"></script>
     	<script src="../assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
        
        <!-- jQuery  -->        
        <script src="../assets/plugins/peity/jquery.peity.min.js"></script>       
        <script src="../assets/plugins/waypoints/lib/jquery.waypoints.js"></script>
        <script src="../assets/plugins/counterup/jquery.counterup.min.js"></script>
        
        <script src="../assets/plugins/jquery-knob/jquery.knob.js"></script>                
        
        <script src="../assets/js/jquery.validate.min.js"></script>
        <script src="../assets/js/jquery.core.js"></script>
        <script src="../assets/js/jquery.app.js"></script>
        
        <!-- jQuery dataTables -->
        <script src="../assets/plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.bootstrap.js"></script>

        <script src="../assets/plugins/datatables/dataTables.buttons.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.bootstrap.min.js"></script>
        <script src="../assets/plugins/datatables/jszip.min.js"></script>
        <script src="../assets/plugins/datatables/pdfmake.min.js"></script>
        <script src="../assets/plugins/datatables/vfs_fonts.js"></script>
        <script src="../assets/plugins/datatables/buttons.html5.min.js"></script>
        <script src="../assets/plugins/datatables/buttons.print.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.keyTable.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.responsive.min.js"></script>
        <script src="../assets/plugins/datatables/responsive.bootstrap.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.scroller.min.js"></script>
        <script src="../assets/plugins/datatables/dataTables.colVis.js"></script>
        <script src="../assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

        <script src="../assets/pages/datatables.init.js"></script>
        
        <!-- -->
        <script src="../assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/switchery/js/switchery.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/multiselect/js/jquery.multi-select.js" type="text/javascript"></script>
        <script src="../assets/plugins/jquery-quicksearch/jquery.quicksearch.js" type="text/javascript"></script>
        <script src="../assets/plugins/select2/js/select2.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-select/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="../assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>


        <!-- get Jquery -->
        <?= $main->getActScript() ?>
        
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                $('.counter').counterUp({
                    delay: 100,
                    time: 1200
                });

                $(".knob").knob();
            });           
        </script>
    </body>
</html>
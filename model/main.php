<!DOCTYPE html>
<html>
    <?= $main->get_head() ?>    
    <body>
        <!-- Begin page -->
        <div id="wrapper">           
            <div class="">
                <!-- Start content -->
                <div class="content">
                    <?= $main->get_page() ?>
                </div> 
                <!-- end content -->

                <footer class="footer-user text-right">
                    <div class="pull-left"><?= apps_name ?> - <?= company_name ?></div>                    
                    <div class="text-right">Copyright © <?= date('Y') ?>.</div>
                </footer>
            </div>
        </div>
        <!-- END wrapper -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>

        <script src="assets/plugins/owl.carousel/dist/owl.carousel.min.js"></script>
        
        <script src="assets/js/jquery.validate.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                var validator = $('#form_checkin').validate({
                    rules: {
                        noreg: {
                            required: true
                        }
                    },
                    messages: {
                        noreg: {
                            required: '*) field is required'
                        }
                    },
                    submitHandler: function(form) {
                        $('#form_checkin').trigger('reset');
                    }
                });
            });            
        </script>
    </body>
</html>
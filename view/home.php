
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="media" style="padding: 15px 25px">
                <div class="media-left">
                    <img src="assets/images/Al-Irsyad-Satya-Ilamic-School.png" height="50px">
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Welcome to <?= apps_name ?></h4>
                    Voter : <span id="uservote"></span>
                </div>
            </div>            
        </div>
    </div>

    <?php if (!isset($_SESSION['sesi_pilih'])) { ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-8">
                            <?php include 'model/carousel.php'; ?>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-8">
                            <?php include 'model/login.php'; ?>
                        </div>
                    </div>
                </div>            
            </div>
        </div>
    <?php } else { 
        include 'view/voting.php';
    } ?>
</div>

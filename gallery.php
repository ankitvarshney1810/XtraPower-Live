<?php include "header.php";  ?>
<section class="hero-area">
    <div class="ioc-container">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-6 wow fadeInDown" data-wow-delay="0.1s">
                <h1 class="head-title">View our Gallery </h1>
                <p class="sub-title">Seeing is believing. Isn’t it ?</p>
                <div class="section-btns">
                    <a href="#gallery" class="btn btn-border">View Gallery</i></a>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                <img src="assets/img/img_cover_gallery.svg" loading="lazy" class="p-3">
            </div>
        </div>
    </div>
</section>
<section id="gallery">
    <div class="ioc-container">
        <div class="tabs">
            <span class="tab-heading">Choose a Category</span>
            <div class="items">
                <a id="All" class="tab-item active">All</a>
                <a id="Swagat Retail Outlets" class="tab-item">Swagat Retail Outlets</a>
                <a id="RFID" class="tab-item">RFID</a>
                <!--a id="Driver Facilities" class="tab-item">Driver Facilities</a>
                <a id="Driver Health Check Ups" class="tab-item">Driver Health Check Ups</a>
                <a id="RFID Fuelling" class="tab-item">RFID Fuelling</a>
                <a id="Telematics Devices" class="tab-item">Telematics Devices</a>
                <a id="Fuel@Call" class="tab-item">Fuel@Call</a>
                <a id="Awards & Recognitions" class="tab-item">Awards & Recognitions</a-->
            </div>
        </div>
        <div class="panels">
            <h2 class="section-header mt-3">All</h2>
            <ul class="row">
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/1.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/2.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/3.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/4.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/5.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/6.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/7.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/8.jpeg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/9.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/10.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/11.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/12.jpg" loading="lazy" class="panel active" data-panel="Swagat Retail Outlets">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/RFID/1.png" loading="lazy" class="panel active" data-panel="RFID">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/RFID/2.png" loading="lazy" class="panel active" data-panel="RFID">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/RFID/3.png" loading="lazy" class="panel active" data-panel="RFID">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/RFID/4.png" loading="lazy" class="panel active" data-panel="RFID">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/RFID/5.png" loading="lazy" class="panel active" data-panel="RFID">
                </li>
                <li class="col-sm-6 col-md-4 col-lg-3">
                    <img src="assets/img/gallery/RFID/6.png" loading="lazy" class="panel active" data-panel="RFID">
                </li>
            </ul>
        </div>
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body"></div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
</section>

<section class="primary-bg">
    <div class="continer text-center">
        <h1 class="font-weight-light wow fadeInDown" data-wow-delay="0.1s">Do you still have any questions? <br> Contact Us</h1>
        <div class="section-btns mt-3 wow fadeInUp" data-wow-delay="0.2s">
            <a href="<?=WEB_URL?>#contact" class="btn btn-border">Contact Us</a>
        </div>
    </div>
</section>

<?php include "footer.php";  ?>
<?php include "header.php";  ?>
<section class="hero-area" id="HelpCenter">
    <div class="ioc-container">
        <div class="row align-items-center flex-row-reverse">
            <div class="col-sm-12 col-md-12 col-lg-6">
                <img src="assets/img/help_center_cover.svg" class="d-block img-fluid p-5" loading="lazy">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-6">
                <h2 class="head-title wow fadeInDown" data-wow-delay="0.1s">We're here to help you</h2>
                <div class="search-box">
                    <input type="search" placeholder="Start typing your question, keywords, topics here" class="search-input">
                    <button class="btnSearch"></button>
                    <ul class="suggest-result">                        
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</section>
<section class="supportArticle">
        <div class="container">
            <div class="owl-carousel" id="supportArticles">
                
            </div>
        </div>
    </section>
    <section class="">
        <div class="container">
            <h2 class="section-header title-center">
                Frequently Asked Questions
            </h2>
            <div class="faq-list" id="accordionExample">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </section>
    <section class="support-articles" id="support-articles">
        <div class="container">
            <h2 class="section-header title-center">Browse Support Articles</h2>
            <div class="articles owl-carousel">
                <a href="<?=WEB_URL?>support-article.php?article=TransactionMode" class="item-box item-center">
                    <div class="icon">
                        <img src="assets/img/ic_single_recharge.svg" loading="lazy">
                    </div>
                    <span class="title">Transaction mode</span>
                    <p class="text text-justify d-block">Card, RFID or Mobile? Read this Support Article to get an overview of various transaction modes available to you and when you should use them.<i class="lni lni-chevron-right"></i> </p>

                </a>
                <a href="<?=WEB_URL?>support-article.php?article=RFIDTransaction" class="item-box item-center">
                    <div class="icon">
                        <img src="assets/img/ic_rfid_transaction.svg" loading="lazy">
                    </div>
                    <span class="title d-block">RFID Transactions</span>
                    <p class="text text-justify d-block">Monitor how much fuel is actually delivered inside your vehicle’s fuel tank. This support article on RFID Transactions guides you how. <i class="lni lni-chevron-right"></i> </p>
                </a>
                <a href="<?=WEB_URL?>support-article.php?article=LimitManagement" class="item-box item-center">
                    <div class="icon">
                        <img src="assets/img/ic_limit.svg" loading="lazy">
                    </div>
                    <span class="title d-block">Limit Management</span>
                    <p class="text text-justify d-block">For controlling your fuel spends, XTRAPOWER offers you a flexible and versatile limit management. <i class="lni lni-chevron-right"></i> </p>
                </a>
                
            </div>

        </div>
    </section>
    <section id="contact">
        <div class="container">
            <h2 class="section-header title-center">
                Couldn't find your answers? 
            </h2>
            <div class="row contact-form-area wow fadeInUp" data-wow-delay="0.3s">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="item-box item-center wow fadeInRight" data-wow-delay="0.3s">
                                <div class="icon">
                                    <img src="assets/img/call.png" loading="lazy">
                                </div>
                                <span class="title">24x7 Help Desk</span>
                                <span class="text">1800-200-1214, 1800-220-724</span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="item-box item-center wow fadeInRight" data-wow-delay="0.3s">
                                <div class="icon">
                                    <img src="assets/img/email.png" loading="lazy">
                                </div>
                                <span class="title">Email</span>
                                <span class="text">help@iocxtrapower.com</span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="item-box item-center wow fadeInRight cursor-pointer" data-toggle="modal" data-target="#SMSModal" data-wow-delay="0.3s">
                                <div class="icon">
                                    <img src="assets/img/sms.png" loading="lazy">
                                </div>
                                <span class="title d-flex justify-content-center  align-items-center">SMS
                                    <svg  style="width: 16px; height: 16px; margin-left: 8px;"  class="i-icon"   version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 23.625 23.625" xml:space="preserve"><g><path d="M11.812,0C5.289,0,0,5.289,0,11.812s5.289,11.813,11.812,11.813s11.813-5.29,11.813-11.813S18.335,0,11.812,0z M14.271,18.307c-0.608,0.24-1.092,0.422-1.455,0.548c-0.362,0.126-0.783,0.189-1.262,0.189c-0.736,0-1.309-0.18-1.717-0.539s-0.611-0.814-0.611-1.367c0-0.215,0.015-0.435,0.045-0.659c0.031-0.224,0.08-0.476,0.147-0.759l0.761-2.688c0.067-0.258,0.125-0.503,0.171-0.731c0.046-0.23,0.068-0.441,0.068-0.633c0-0.342-0.071-0.582-0.212-0.717c-0.143-0.135-0.412-0.201-0.813-0.201c-0.196,0-0.398,0.029-0.605,0.09c-0.205,0.063-0.383,0.12-0.529,0.176l0.201-0.828c0.498-0.203,0.975-0.377,1.43-0.521c0.455-0.146,0.885-0.218,1.29-0.218c0.731,0,1.295,0.178,1.692,0.53c0.395,0.353,0.594,0.812,0.594,1.376c0,0.117-0.014,0.323-0.041,0.617c-0.027,0.295-0.078,0.564-0.152,0.811l-0.757,2.68c-0.062,0.215-0.117,0.461-0.167,0.736c-0.049,0.275-0.073,0.485-0.073,0.626c0,0.356,0.079,0.599,0.239,0.728c0.158,0.129,0.435,0.194,0.827,0.194c0.185,0,0.392-0.033,0.626-0.097c0.232-0.064,0.4-0.121,0.506-0.17L14.271,18.307zM14.137,7.429c-0.353,0.328-0.778,0.492-1.275,0.492c-0.496,0-0.924-0.164-1.28-0.492c-0.354-0.328-0.533-0.727-0.533-1.193c0-0.465,0.18-0.865,0.533-1.196c0.356-0.332,0.784-0.497,1.28-0.497c0.497,0,0.923,0.165,1.275,0.497c0.353,0.331,0.53,0.731,0.53,1.196C14.667,6.703,14.49,7.101,14.137,7.429z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                                </span>
                                <span class="text">922 301 1099</span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="item-box item-center wow fadeInRight" data-wow-delay="0.3s">
                                <div class="icon">
                                    <img src="assets/img/whatsapp.png" loading="lazy">
                                </div>
                                <span class="title">WhatsApp</span>
                                <span class="text">922 301 1099</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-xs-12">
                    <div class="contact-block">
                        <form id="contactForm">
                            <h4 class="d-block mb-4">Drop us your query and we'll get back to you shortly.</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" placeholder="Email" id="email" class="form-control" name="email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" placeholder="Subject" id="msg_subject" class="form-control" required data-error="Please enter your subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" id="message" placeholder="Your Message" rows="7" data-error="Write your message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="section-btns mt-2">
                                        <button class="btn btn-common" id="form-submit" type="submit">Send Message</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?=WEB_URL?>assets/js/support-article.js?filever=<?=filesize('assets/js/support-article.js')?>"></script>
<script>
    $(document).ready(function(){
        generate_faq_sliders();
        create_generic_faqs();
    });
</script>  
<?php include "footer.php";  ?>
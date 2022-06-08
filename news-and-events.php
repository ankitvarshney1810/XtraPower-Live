<?php include "header.php"; ?>
<section class="hero-area pb-0">
    <div class="ioc-container">
        <div class="row align-items center">
            <div class="col-sm-12 col-md-12 wow fadeInDown" data-wow-delay="0.1s">
                <h1 class="head-title">News & Events</h1>
                <p class="sub-title">
                    Stay updated with latest news and events. 
                </p>
            </div>
        </div>
        <ul class="list-group">
                <li class="list-group-item">
        <span>IndianOil enables the option to deposit cash at select petrol pumps and Recharge XTRAPOWER, FASTag and withdraw Cash</span>
        <a href="https://bit.ly/2XEUvuL" target="_blank">Click here for details</a>                    </li>
                <li class="list-group-item">
        We are now available on Social Media 
        <a href="https://fb.me/IOCXTRAPOWER" target="_blank">Click here to follow >></a>                    </li>
                <li class="list-group-item">
        Redeem your XTRA Points at Amazon. 
        <a href="https://login.iocxtrapower.com/Userlogin.aspx" target="_blank">Login to redeem now >></a>                    </li>
                <li class="list-group-item">
        Redeem XTRA Points by SMS. Send SMS REDEEM  <CustomerID> <Points> to 9223011099. 
                        </li>
                <li class="list-group-item">
        Click to view Networked Retail Outlets. 
        <a href="/network.php" target="_blank">Know More &gt;&gt;</a>                    </li>
                <li class="list-group-item">
        IndianOil wins most trusted brand award for petrol stations 
        <a href="/xtrapower-awards.php" target="_blank">Know More >></a>                    </li>
                <li class="list-group-item">
        Register your mobile number for SMS Alerts. 
        <a href="/#contact" target="_blank">Contact Fleet Marketing Manager>></a>                    </li>
                <li class="list-group-item">
        IOCL's XtraPower Ujala eye check-up camps much lauded by fleet owners and drivers 
        <a href="https://www.iocxtrapower.com/news-events-free-eye-checkup-ujala.aspx" target="_blank">Know More >></a>                    </li>
                <li class="list-group-item">
        IndianOil organizes Free Eye Check Ups exclusively for AMLF Logistics Pvt Ltd 
        <a href="https://www.iocxtrapower.com/news-events-free-eye-checkup.aspx" target="_blank">Know More >></a>                    </li>
                <li class="list-group-item">
        IndianOil organizes Health Check Up Camp for Arunachala Logistics 
        <a href="https://www.iocxtrapower.com/news-events-free-eye-checkup-arunachal.aspx" target="_blank">Know More >></a>                    </li>
            </ul>
                <ul class="list-group">
                <?php
                $news = fetchAllNewsEvents();
                foreach ($news as $item) {
                    if($item->status == 1) {
                ?>
                    <li class="list-group-item">
                        <span><?=htmlspecialchars_decode($item->headline) ?></span>
                        
                        <?php if(!empty($item->linkUrl)) { ?><a href="<?=$item->linkUrl ?>" target="_blank"><?=htmlspecialchars_decode($item->linkText) ?></a><?php } ?>
                    </li>
                <?php } } ?>
                </ul>
    </div>
</section>
    <section>
        <div class="container">
            <div class="section-header text-center m-0">
                <h1 class="section-title wow fadeInDown" data-wow-delay="0.3s">News and Events</h1>
                <div class="shape wow fadeInDown" data-wow-delay="0.3s"></div>
            </div>
            
        </div>
    </section>
<?php include "footer.php";  ?>
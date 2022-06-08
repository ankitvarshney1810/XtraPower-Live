<?php include "header.php";  ?>
<section class="hero-area">
        <div class="ioc-container">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-sm-12 col-md-12 col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <img src="assets/img/img_cover_enroll.svg" loading="lazy" class="d-block w-100 p-0">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 wow fadeInDown" data-wow-delay="0.2s">
                    <h1 class="head-title">Take the right step, join the best Fuel and Fleet management program in India</h1>
                    <p class="sub-title">Our cutting-edge technology helps you to cut costs, remain agile and boost fleet productivity.</p>
                    <div class="section-btns">
                        <a href="#Enroll" class="btn btn-common">Enroll Now</i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="primary-bg" id="Enroll">
        <div class="container">
            <h2 class="section-header title-center">Become a Member</h2>
            <div class="wizards">
                <!--Mobile Verification-->
                <div class="panel active" id="MobileVerification">
                    <h4 class="title">Mobile Verification</h4>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="input-field">
                                <input type="text" placeholder="Enter your Mobile No/Email ID">
                                <span class="error"></span>
                            </div>
                            <div class="captcha">
                                Captcha
                            </div>
                            <div class="input-field">
                                <input type="text" placeholder="Enter OTP">
                                <span class="error"></span>
                            </div>
                            <div class="section-btns btn-center">
                                <button class="btn btn-common">Continue</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Options-->
                <div class="panel active" id="Options">
                    <h4 class="title">I want to enroll for</h4>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <input type="radio" name="option" id="op1">
                            <label class="item-box item-center" for="op1">
                                <div class="icon"><img src="assets/img/img_fleet_icon.svg" loading="lazy"></div>
                                <span class="text">Fleet</span>
                            </label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <input type="radio" name="option" id="op2">
                            <label for="op2" class="item-box item-center">
                                <div class="icon"><img src="assets/img/img_dg_set.svg" loading="lazy"></div>
                                <span class="text">DG Set / Stationary Equipment</span>
                            </label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <input type="radio" name="option" id="op3">
                            <label for="op3" class="item-box item-center">
                                <div class="icon"><img src="assets/img/img_gift_fuel.svg" loading="lazy"></div>
                                <span class="text">Gift Fuel Card</span>
                            </label>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <input type="radio" name="option" id="op4">
                            <label for="op4" class="item-box item-center">
                                <div class="icon"><img src="assets/img/img_gift_fuel.svg" loading="lazy"></div>
                                <span class="text">Employee Fuel Reimbursement</span>
                            </label>
                        </div>
                    </div>
                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel active" id="FleetSize">
                    <h4 class="title">My fleet size</h4>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-4">
                            <div class="input-field">
                                <input type="text" placeholder="Enter numbero of Fleet/DG Set">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel active" id="OperationArea">
                    <h4 class="title">My area of operation</h4>
                    <div class="row">
                        <div class="col-sm-6 col-md-4">
                            <div>
                                <input type="checkbox" name="aop" id="aop1">
                                <label class="item-box item-center" for="aop1">
                                    <span class="text">Inter State</span>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="aop" id="aop2">
                                <label for="aop2" class="item-box item-center">
                                    <span class="text">Intra State</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <div>
                                <input type="checkbox" name="aop" id="aop3">
                                <label for="aop3" class="item-box item-center">
                                    <span class="text">Inter City</span>
                                </label>
                            </div>
                            <div>
                                <input type="checkbox" name="aop" id="aop4">
                                <label for="aop4" class="item-box item-center">
                                    <span class="text">Intra City</span>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4">
                            <input type="checkbox" name="aop" id="aop5">
                            <label for="aop5" class="item-box item-center">
                                <span class="text">Both</span>
                            </label>
                        </div>
                    </div>
                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel active" id="UseCase">
                    <h4 class="title">My use case</h4>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-3">
                            <input type="radio" name="use_case" id="use_case1">
                            <label class="item-box item-center" for="use_case1">
                                    <span class="text">Single Recharge</span>
                                </label>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <input type="radio" name="use_case" id="use_case2">
                            <label class="item-box item-center" for="use_case2">
                                    <span class="text">Multi Recharge</span>
                                </label>
                        </div>
                    </div>
                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel active" id="BusinessInfo">
                    <h4 class="title">My Business info</h4>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-2">
                            <div class="input-field">
                                <select name="title" id="">
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                </select>
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="input-field">
                                <input type="text" placeholder="Key Official Name">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-2">

                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="input-field">
                                <input type="text" placeholder="Company Name">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="virtual_card">

                    </div>
                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel active" id="BusinessEntity">
                    <h4 class="title">My Business Entity Name</h4>

                    <div class="row justify-content-center">

                        <div class="col-sm-6 col-md-4">
                            <div class="input-field">
                                <input type="text" placeholder="Entity Name">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="virtual_card">

                    </div>
                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel" id="PANDetail">
                    <h4 class="title">My PAN/GST Details</h4>
                    <small class="mb-3 text-center d-block">Choose your business type</small>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-2">
                            <input type="radio" name="pan" id="pan1">
                            <label class="item-box item-center" for="pan1">
                                    <span class="text">Proprietorship</span>
                                </label>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <input type="radio" name="pan" id="pan2">
                            <label class="item-box item-center" for="pan2">
                                    <span class="text">Partnership</span>
                                </label>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <input type="radio" name="pan" id="pan3">
                            <label class="item-box item-center" for="pan3">
                                    <span class="text">Public Ltd</span>
                                </label>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <input type="radio" name="pan" id="pan4">
                            <label class="item-box item-center" for="pan4">
                                    <span class="text">Private Ltd</span>
                                </label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-6 col-md-2">
                            <input type="radio" name="pan" id="pan5">
                            <label class="item-box item-center" for="pan5">
                                    <span class="text">Society</span>
                                </label>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <input type="radio" name="pan" id="pan6">
                            <label class="item-box item-center" for="pan6">
                                    <span class="text">Trust</span>
                                </label>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <input type="radio" name="pan" id="pan7">
                            <label class="item-box item-center" for="pan7">
                                    <span class="text">Government</span>
                                </label>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <input type="radio" name="pan" id="pan8">
                            <label class="item-box item-center" for="pan8">
                                    <span class="text">Others</span>
                                </label>
                        </div>
                    </div>
                    <small class="mb-3 mt-4 text-center d-block">PAN/GST Detail</small>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <div class="input-field">
                                <input type="text" placeholder="PAN Number">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <div class="input-field">
                                <input type="text" placeholder="GST Number">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>


                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel" id="PostalCode">
                    <h4 class="title">My Postal Code</h4>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <div class="input-field">
                                <input type="text" placeholder="Enter Postal Code">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-12 col-lg-2">
                            <div class="input-field">
                                <input type="text" placeholder="City">
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2">
                            <div class="input-field">
                                <input type="text" placeholder="District">
                                <span class="error"></span>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-2">
                            <div class="input-field">
                                <input type="text" placeholder="State">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel" id="CommAddress">
                    <h4 class="title">My Communication Address</h4>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <div class="input-field">
                                <input type="text" placeholder="Door Number / Building Name">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <div class="input-field">
                                <input type="text" placeholder="Street Name, Area">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <div class="input-field">
                                <input type="text" placeholder="Landmark">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <div class="input-field">
                                <input type="text" placeholder="Location">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
                <div class="panel" id="Upload">
                    <h4 class="title">Upload Document</h4>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <small class="d-block mb-3 font-weight-bold">Upload PAN Card</small>
                            <div class="input-field">
                                <input type="file" placeholder="Upload Pan">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-sm-12 col-md-6">
                            <small class="d-block mb-3 font-weight-bold">Upload Address Proof</small>
                            <div class="input-field">
                                <input type="file" placeholder="Upload Pan">
                                <span class="error"></span>
                            </div>
                        </div>
                    </div>

                    <div class="section-btns btn-center">
                        <button class="btn btn-common">Continue</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?=WEB_URL?>assets/js/member-1.js?filever=<?=filesize('assets/js/member-1.js')?>"></script>
<?php include "footer.php";  ?>
<?php include "header.php";  ?>
    <section class="download">
        <div class="container">
            <h3 class="mb-4">Become a Member</h3>
            <!--Section 1 - Mobile Verification-->
            <div class="form-section open" id="s1">
                <div class="header">
                    <div class="title">Mobile Verification</div>
                    <div class="icon">
                        <i class="lni lni-pencil"></i>
                    </div>
                </div>
                <div class="body">
                    <div class="row align-items-end">
                        <div class="col-sm-12 col-md-12 col-lg-6" id="mobileDiv">
                            <div class="inputGroup">
                                <label for="mobie_no">Enter your mobile number</label>
                                <input type="text" id="mobile_no" placeholder="10 Digit Only">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6"  id="mobileButton">
                            <div class="inputGroup">
                                <input type="submit" class="getOTP" value="Get OTP">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12" id="otpMessage1" style="display:none">
                            <div class="alert-msg"></div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6" id="verifyOtp" style="display:none">
                            <div class="inputGroup">
                                <label for="otp">Enter OTP</label>
                                <input type="text" id="otp" class="otp_text" placeholder="●●●●" maxlength="4">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-6"  id="verifyOtpBtn" style="display:none">
                            <div class="inputGroup">
                                <input type="submit" class="verifyOTP" value="Verify OTP">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-lg-12" id="otpMessage" style="display:none">
                            <div class="alert-msg"><span>An OTP has been sent to the given number. Please wait.</span> <b>00:30</b> <button class="btnResend">Resend</button> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Section 2 - Customer Details-->
            <div class="form-section" id="s2">
                <div class="header">
                    <div class="title">Customer Details</div>
                    <div class="icon">
                        <i class="lni lni-pencil"></i>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="inputGroup">
                                <label>Form Number</label>
                                <input type="text"  id="formnumber" value="aGbXU9" disabled>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6">
                            <div class="inputGroup" id="appdate">
                                <label>Application Date</label>
                                <input type="date" id="appdate1" value="2021-03-19" disabled>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="inputGroup" id="cardid">
                                <label>Let us know your requirement. Choose any one from the following.</label>
                                <div class="radioBtn">
                                    <input type="radio" name="card" value="Fleet" id="card1">
                                    <label for="card1">Fleet</label>
                                </div>
                                <div class="radioBtn">
                                    <input type="radio" name="card" value="DG Set/Stationary Equipment" id="card2">
                                    <label for="card2">DG Set/Stationary Equipment</label>
                                </div>
                                <div class="col-sm-12 col-md-12 col-lg-12" id="customerMessage">
                                    <div class="alert-msg"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="inputGroup">
                        <input type="submit" class="submit" id ="form2submit" value="Submit and Continue">
                    </div>
                </div>

            </div>
            <!--Section 3 - Customer Card Details-->
            <div class="form-section" id="s3">
                <div class="header">
                    <div class="title">Customer Card Details</div>
                    <div class="icon">
                        <i class="lni lni-pencil"></i>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="inputGroup" >
                                <label for="entityName">Entity Name</label>
                                <input type="text" id="entityName" value="" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup">
                                <label for="nameOnCard">Name on card</label>
                                <input type="text"  id="nameOnCard" placeholder="">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup autoComplete">
                                <label for="constitution">Constitution</label>
                                <select id="constitution">
                                    <option value="-1">Choose Constitution</option>
                                       
                                </select>
                            </div>
                        </div>

                    </div>
                    <div class="row align-items-end">
                        <div class="col-sm-12 col-md-6">
                        
                            <div class="inputGroup" >
                                <label for="panNumber">PAN Number</label>
                                <input type="text" id="panNumber" placeholder="Enter PAN Number">
                            </div>
                        </div>
                        <div class="col-sm-11 col-md-5">
                            <div class="inputGroup" >
                                <input type="file" id="panNumberImg" name="uploadPAN" id="uploadPAN">
                            </div>
                        </div>
                        <div class="col-sm-1 col-md-1" style="display:none" id="panNumberAnchor">
                            <div class="inputGroup" >
                                <a href="" target="_blank">View</a>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup" >
                                <label for="gstNumber">GST Number</label>
                                <input type="text" id="gstNumber" placeholder="Enter GST Number">
                            </div>
                        </div>
                        <div class="col-sm-11 col-md-5">
                            <div class="inputGroup"  >
                                <input type="file" id="gstNumberImg" name="uploadGST" id="uploadGST">
                            </div>
                        </div>
                        <div class="col-sm-1 col-md-1" style="display:none" id="gstNumberAnchor">
                            <div class="inputGroup" >
                                <a href="" target="_blank">View</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="inputGroup">
                        <input type="submit" class="submit" id="customerCardSubmit" value="Submit and Continue">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12" id="customerCardMessage">
                            <div class="alert-msg"></div>
                    </div>
                </div>
            </div>
            <!--Section 4 - Customer Address-->
            <div class="form-section"  id="s4">
                <div class="header">
                    <div class="title">Customer Address</div>
                    <div class="icon">
                        <i class="lni lni-pencil"></i>
                    </div>
                </div>
                <div class="body">
                    <p class="mb-2 d-block">Permanent Address</p>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup autoComplete">
                                <label for="permanent_pincode">Enter your PIN Code</label>
                                <input type="number" id="permanent_pincode">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup autoComplete">
                                <label for="permanent_location">Location</label>
                                <input type="text" id="permanent_location">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="inputGroup autoComplete">
                                <label for="add">Address</label>
                                <input type="text" id="permanent_add" placeholder="Door No, Street, Area">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="inputGroup autoComplete">
                                <label for="city">City</label>
                                <input type="text" id="permanent_city" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="inputGroup autoComplete">
                                <label for="district">District</label>
                                <input type="text" id="permanent_district" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 autoComplete">
                            <div class="inputGroup">
                                <label for="state">State</label>
                                <input type="text" id="permanent_state" readonly>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex align-items-center mb-2">
                        <p>Communication Address</p>
                        <div class="inline-checkbox ml-2">
                            <input type="checkbox" name="chkSameAdd" id="chkSameAdd">
                            <label for="chkSameAdd">Check if Address is same as permanent</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup autoComplete">
                                <label for="pin">Enter your PIN Code</label>
                                <input type="number" id="comm_pincode">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup autoComplete">
                                <label for="location">Location</label>
                                <input type="text" id="comm_location">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="inputGroup autoComplete">
                                <label for="add">Address</label>
                                <input type="text" id="comm_add" placeholder="Door No, Street, Area">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="inputGroup autoComplete">
                                <label for="city">City</label>
                                <input type="text" id="comm_city" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4">
                            <div class="inputGroup autoComplete">
                                <label for="district">District</label>
                                <input type="text" id="comm_district" readonly>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-4 autoComplete">
                            <div class="inputGroup">
                                <label for="state">State</label>
                                <input type="text" id="comm_state" readonly>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="footer">
                    <div class="inputGroup">
                        <input type="submit" class="submit" id="customerAddresSubmit" value="Submit and Continue">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12" id="customerAddressMessage" style="display:none">
                            <div class="alert-msg"></div>
                    </div>
                </div>
            </div>
            <!--Section 5 - Key Official Contact Details-->
            <div class="form-section" id="s5">
                <div class="header">
                    <div class="title">Key Official Contact Details</div>
                    <div class="icon">
                        <i class="lni lni-pencil"></i>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup">
                                <label for="title">Salutation</label>
                                <select name="title" id="title">
                                    <option value="-1">Choose</option>
                                    <option value="Mr.">Mr.</option>
                                    <option value="Ms.">Ms.</option>
                                    <option value="Mrs.">Mrs.</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup">
                                <label for="name">Name</label>
                                <input type="text" id="name">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup">
                                <label for="mobile">Mobile Number</label>
                                <input type="text" id="mobile">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup">
                                <label for="email_add">Email Address</label>
                                <input type="email" id="email_add">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup">
                                <label for="fleet_size">Total Fleet Size</label>
                                <input type="number" id="fleet_size">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup">
                                <label for="area">Area of Operation</label>
                                <input type="text" id="area" placeholder="State, District, City">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                            <div class="inputGroup">
                                <label for="nominee">Nominee for Insurance</label>
                                <input type="text" id="nominee">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer">
                    <div class="inputGroup">
                        <input type="submit" class="submit"  id="customerContactDetials" value="Submit and Continue">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12" id="customerContactMessage" style="display:none">
                            <div class="alert-msg"></div>
                    </div>
                </div>
            </div>
            <!--Section 6 - Application form-->
            <div class="form-section" id="s6">
                <div class="header">
                    <div class="title">Application Form</div>
                    <div class="icon">
                        <i class="lni lni-pencil"></i>
                    </div>
                </div>
                <div class="body">
                    <div class="row align-items-center">
                        <div class="col-sm-12 col-md-9 mb-3">
                            <p>Generate Application Form</p>
                        </div>
                        <div class="col-sm-12 col-md-3 mb-3">
                            <input type="button" class="form-btn" value="Generate">
                        </div>
                        <div class="col-sm-12 col-md-9 mb-3">
                            <p>Download Application Form</p>
                        </div>
                        <div class="col-sm-12 col-md-3 mb-3">
                            <input type="button" class="form-btn" value="Download">
                        </div>
                        <div class="col-sm-12 col-md-9">
                            <p>Upload Signed Application Form</p>
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <input type="button" class="form-btn" value="Upload">
                        </div>

                    </div>
                </div>
                <div class="footer">
                    <div class="inputGroup">
                        <input type="submit" class="submit" value="Continue" id="applicationFormSubmit">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12" id="applicationFormMessage" style="display:none">
                        <div class="alert-msg"></div>
                    </div>
                </div>
            </div>
            <!--Section 7 - Card Creation -->
            <div class="form-section" id="s7">
                <div class="header">
                    <div class="title">Card Creation</div>
                    <div class="icon">
                        <i class="lni lni-pencil"></i>
                    </div>
                </div>
                <div class="body">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            <div class="inputGroup mb-0">
                                <label for="no_card">Number of Cards</label>
                                <input type="number" id="no_card">
                            </div>
                        </div>
                    </div>
                    <div class="card-details">
                        <hr>
                        
                    </div>
                </div>
                <div class="footer">
                    <div class="inputGroup">
                        <input type="submit" class="submit" value="Submit and Continue" id="cardSubmit">
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12" id="cardSubmitMessage">
                        <div class="alert-msg"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="<?=WEB_URL?>assets/js/member.js?filever=<?=filesize('assets/js/member.js')?>"></script>
    <?php include "footer.php";  ?>    
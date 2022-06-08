<?php include "header.php";  ?>

<section class="">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-8">
                    <h2 class="section-header">See a demo</h2>
                    <p class="section-text">See for yourself why organizations in over 80 countries use Fleetio to automate essential operations, control costs and reduce downtime.</p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4">
                    <form id="contactForm" novalidate="true">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" required="" data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="cname" name="cname" placeholder="Your Company Name" required="" data-error="Please enter your company name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Email Address" id="email" class="form-control" name="email" required="" data-error="Please enter  work email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select name="fleet_size" id="fleet_size" class="form-control" required data-error="Select your Fleet size">
                                        <option value="Select your fleet size">Select your fleet size</option>
                                        <option value="Select your fleet size">Less than 15 </option>
                                        <option value="Select your fleet size">15-99</option>
                                        <option value="Select your fleet size">100-499</option>
                                        <option value="Select your fleet size">500-999</option>
                                        <option value="Select your fleet size">more than 1,000</option>
                                    </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <select class="form-control" id="Industry" name="Industry" required="required" data-error="Select your industry"> 
                                        <option value=""> Select your industry… </option> 
                                        <option value="Transportation &amp; Logistics">Transportation &amp; Logistics</option> 
                                        <option value="Rental &amp; Leasing">Rental &amp; Leasing</option> 
                                        <option value="Consumer/Business Services">Consumer/Business Services</option> 
                                        <option value="Construction Contractors &amp; Services">Construction Contractors &amp; Services</option> 
                                        <option value="Government">Government</option> 
                                        <option value="Energy, Utilities &amp; Mining">Energy, Utilities &amp; Mining</option> 
                                        <option value="Retail, Wholesale &amp; Manufacturing">Retail, Wholesale &amp; Manufacturing</option> 
                                        <option value="Information &amp; Telecommunications">Information &amp; Telecommunications</option> <option value="Education">Education</option> <option value="Arts, Entertainment &amp; Recreation">Arts, Entertainment &amp; Recreation</option> <option value="Non-Profit/Religious Organizations">Non-Profit/Religious Organizations</option> <option value="Other">Other</option> </select>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

<?php include "footer.php";  ?>
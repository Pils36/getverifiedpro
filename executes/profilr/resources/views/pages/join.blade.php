@extends('layouts.app')

@section('title', 'Get Started')
    
@show
<style type="text/css">
    .bold{font-weight: bold}
    .underline{text-decoration: underline;}
    .br-10{border-radius: 10px;}
    .shadow{box-shadow: 1px 1px 5px 3px #7cb8b86b; padding: 10px;}
    .top{font-size:25px; padding: 30px;}
    h4.mb-50{background: #000; color: #FFF; padding: 10px;}
</style>
@section('content')
<div class="container" style="margin-top: 50px;">
            <div class="row">
                <!-- Single Contact Area -->
                <div class="col-lg-4 col-md-4">
                    <img src="http://childrensfishingclinic.com/wp-content/uploads/2013/03/REGISTER-PNG.png" alt="" class="img img-responsive static">
                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="single-contact-area mb-100 stage1 animated fadeIn corporate-top" id="corporate-top">

                        <div class="contact-form-area contact-page">
                                <div class="corporate-top_myloader">
                                    <div class="corporate-top_checkmark draw"></div>
                                </div>
                 
                            <div class="contact-form-area contact-page bg-ash">
                                <h4 class="mb-50">Stage 1/4: Corporate Information</h4>

                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-6 col-xs-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control br-0 default" name="exec_id" id="corporate-top_id" placeholder="ID" required="" readonly="" value="PRO_COLAB1546448237">
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-6 col-xs-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control br-0" name="first_name" id="corporate-top_first_name" placeholder="First Name" required="" autofocus="">
                                            </div>
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control br-0" name="last_name" id="corporate-top_last_name" placeholder="Last Name" required="">
                                            </div>
                                        </div>                                        
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control br-0" name="profession" id="corporate-top_profession" placeholder="Profession" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control br-0" name="email" id="corporate-top_email" placeholder="Email" required="">
                                            </div>
                                        </div>                                                                        
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control br-0" name="city" id="corporate-top_city" placeholder="City" required="">
                                            </div>
                                        </div>                                                   

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <select class="form-control br-0" name="industry" id="corporate-top_industry" required="">
                                                    <option value="">--Select Industry</option>
                                                    <option value="Accounting">Accounting</option>
                                                    <option value="Airlines/Aviation">Airlines/Aviation</option>
                                                    <option value="Alternative Dispute Resolution">Alternative Dispute Resolution</option>
                                                    <option value="Alternative Medicine">Alternative Medicine</option>
                                                    <option value="Animation">Animation</option>
                                                    <option value="Apparel &amp;Fashion">Apparel &amp;Fashion</option>
                                                    <option value="Architecture &amp; Planning">Architecture &amp; Planning</option>
                                                    <option value="Arts and Crafts">Arts and Crafts</option>
                                                    <option value="Automotive">Automotive</option>
                                                    <option value="Aviation &amp; Aerospace">Aviation &amp; Aerospace</option>
                                                    <option value="Banking">Banking</option>
                                                    <option value="Biotechnology">Biotechnology</option>
                                                    <option value="Broadcast Media">Broadcast Media</option>
                                                    <option value="Building Materials">Building Materials</option>
                                                    <option value="Business Supplies and Equipment">Business Supplies and Equipment</option>
                                                    <option value="Capital Markets">Capital Markets</option>
                                                    <option value="Chemicals">Chemicals</option>
                                                    <option value="Civic &amp;  Social Organization">Civic &amp; Social Organization</option>
                                                    <option value="Civil Engineering">Civil Engineering</option>
                                                    <option value="Commercial Real Estate">Commercial Real Estate</option>
                                                    <option value="Computer &amp; Network Security">Computer &amp; Network Security</option>
                                                    <option value="Computer Games">Computer Games</option>
                                                    <option value="Computer Hardware">Computer Hardware</option>
                                                    <option value="Computer Networking">Computer Networking</option>
                                                    <option value="Computer Software">Computer Software</option>
                                                    <option value="Construction">Construction</option>
                                                    <option value="Consumer Electronics">Consumer Electronics</option>
                                                    <option value="Consumer Goods">Consumer Goods</option>
                                                    <option value="Consumer Services">Consumer Services</option>
                                                    <option value="Cosmetics">Cosmetics</option>
                                                    <option value="Dairy">Dairy</option>
                                                    <option value="Defense &amp; Space">Defense &amp; Space</option>
                                                    <option value="Design">Design</option>
                                                    <option value="Education Management">Education Management</option>
                                                    <option value="E-Learning">E-Learning</option>
                                                    <option value="Electrical/Electronic Manufacturing">Electrical/Electronic Manufacturing</option>
                                                    <option value="Entertainment">Entertainment</option>
                                                    <option value="Environmental Services">Environmental Services</option>
                                                    <option value="Events Services">Events Services</option>
                                                    <option value="Executive Office">Executive Office</option>
                                                    <option value="Facilities Services">Facilities Services</option>
                                                    <option value="Farming">Farming</option>
                                                    <option value="Financial Services">Financial Services</option>
                                                    <option value="Fine Art">Fine Art</option>
                                                    <option value="Fishery">Fishery</option>
                                                    <option value="Food &amp; Beverages">Food &amp; Beverages</option>
                                                    <option value="Food Production">Food Production</option>
                                                    <option value="Fund-Raising">Fund-Raising</option>
                                                    <option value="Furniture">Furniture</option>
                                                    <option value="Gambling &amp; Casinos">Gambling &amp; Casinos</option>
                                                    <option value="Glass, Ceramics &amp; Concrete">Glass, Ceramics &amp; Concrete</option>
                                                    <option value="Government Administration">Government Administration</option>
                                                    <option value="Government Relations">Government Relations</option>
                                                    <option value="Graphic Design">Graphic Design</option>
                                                    <option value="Health, Wellness and Fitness">Health, Wellness and Fitness</option>
                                                    <option value="Higher Education">Higher Education</option>
                                                    <option value="Hospital &amp; Health Care">Hospital &amp; Health Care</option>
                                                    <option value="Hospitality">Hospitality</option>
                                                    <option value="Human Resources">Human Resources</option>
                                                    <option value="Import and Export">Import and Export</option>
                                                    <option value="Individual &amp; Family Services">Individual &amp; Family Services</option>
                                                    <option value="Industrial Automation">Industrial Automation</option>
                                                    <option value="Information Services">Information Services</option>
                                                    <option value="Information Technology and Services">Information Technology and Services</option>
                                                    <option value="Insurance">Insurance</option>
                                                    <option value="International Affairs">International Affairs</option>
                                                    <option value="International Trade and Development">International Trade and Development</option>
                                                    <option value="Internet">Internet</option>
                                                    <option value="Investment Banking">Investment Banking</option>
                                                    <option value="Investment Management">Investment Management</option>
                                                    <option value="Judiciary">Judiciary</option>
                                                    <option value="Law Enforcement">Law Enforcement</option>
                                                    <option value="Law Practice">Law Practice</option>
                                                    <option value="Legal Services">Legal Services</option>
                                                    <option value="Legislative Office">Legislative Office</option>
                                                    <option value="Leisure, Travel &amp; Tourism">Leisure, Travel &amp; Tourism</option>
                                                    <option value="Libraries">Libraries</option>
                                                    <option value="Logistics and Supply Chain">Logistics and Supply Chain</option>
                                                    <option value="Luxury Goods &amp; Jewelry">Luxury Goods &amp; Jewelry</option>
                                                    <option value="Machinery">Machinery</option>
                                                    <option value="Management Consulting">Management Consulting</option>
                                                    <option value="Maritime">Maritime</option>
                                                    <option value="Marketing and Advertising">Marketing and Advertising</option>
                                                    <option value="Market Research">Market Research</option>
                                                    <option value="Mechanical or Industrial Engineering">Mechanical or Industrial Engineering</option>
                                                    <option value="Media Production">Media Production</option>
                                                    <option value="Medical Devices">Medical Devices</option>
                                                    <option value="Medical Practice">Medical Practice</option>
                                                    <option value="Mental Health Care">Mental Health Care</option>
                                                    <option value="Military">Military</option>
                                                    <option value="Mining &amp; Metals">Mining &amp; Metals</option>
                                                    <option value="Motion Pictures and Film">Motion Pictures and Film</option>
                                                    <option value="Museums and Institutions">Museums and Institutions</option>
                                                    <option value="Music">Music</option>
                                                    <option value="Nanotechnology">Nanotechnology</option>
                                                    <option value="Newspapers">Newspapers</option>
                                                    <option value="Nonprofit Organization Management">Nonprofit Organization Management</option>
                                                    <option value="Oil &amp; Energy">Oil &amp; Energy</option>
                                                    <option value="Online Media">Online Media</option>
                                                    <option value="Outsourcing/Offshoring">Outsourcing/Offshoring</option>
                                                    <option value="Package/Freight Delivery">Package/Freight Delivery</option>
                                                    <option value="Packaging and Containers">Packaging and Containers</option>
                                                    <option value="Paper &amp; Forest Products">Paper &amp; Forest Products</option>
                                                    <option value="Performing Arts">Performing Arts</option>
                                                    <option value="Pharmaceuticals">Pharmaceuticals</option>
                                                    <option value="Philanthropy">Philanthropy</option>
                                                    <option value="Photography">Photography</option>
                                                    <option value="Plastics">Plastics</option>
                                                    <option value="Political Organization">Political Organization</option>
                                                    <option value="Primary/Secondary Education">Primary/Secondary Education</option>
                                                    <option value="Printing">Printing</option>
                                                    <option value="Professional Training &amp; Coaching">Professional Training &amp; Coaching</option>
                                                    <option value="Program Development/Software Engineering ">Program Development/Software Engineering</option>
                                                    <option value="Public Policy">Public Policy</option>
                                                    <option value="Public Relations and Communications">Public Relations and Communications</option>
                                                    <option value="Public Safety">Public Safety</option>
                                                    <option value="Publishing">Publishing</option>
                                                    <option value="Railroad Manufacture">Railroad Manufacture</option>
                                                    <option value="Ranching">Ranching</option>
                                                    <option value="Real Estate">Real Estate</option>
                                                    <option value="Recreational Facilities and Services">Recreational Facilities and Services</option>
                                                    <option value="Religious Institutions">Religious Institutions</option>
                                                    <option value="Renewables &amp; Environment">Renewables &amp; Environment</option>
                                                    <option value="Research">Research</option>
                                                    <option value="Restaurants">Restaurants</option>
                                                    <option value="Retail">Retail</option>
                                                    <option value="Security and Investigations">Security and Investigations</option>
                                                    <option value="Semiconductors">Semiconductors</option>
                                                    <option value="Shipbuilding">Shipbuilding</option>
                                                    <option value="Sporting Goods">Sporting Goods</option>
                                                    <option value="Sports">Sports</option>
                                                    <option value="Staffing and Recruiting">Staffing and Recruiting</option>
                                                    <option value="Supermarkets">Supermarkets</option>
                                                    <option value="Telecommunications">Telecommunications</option>
                                                    <option value="Textiles">Textiles</option>
                                                    <option value="Think Tanks">Think Tanks</option>
                                                    <option value="Tobacco">Tobacco</option>
                                                    <option value="Translation and Localization">Translation and Localization</option>
                                                    <option value="Transportation/Trucking/Railroad">Transportation/Trucking/Railroad</option>
                                                    <option value="Utilities">Utilities</option>
                                                    <option value="Venture Capital &amp; Private Equity">Venture Capital &amp; Private Equity</option>
                                                    <option value="Veterinary">Veterinary</option>
                                                    <option value="Warehousing">Warehousing</option>
                                                    <option value="Wholesale">Wholesale</option>
                                                    <option value="Wine and Spirits">Wine and Spirits</option>
                                                    <option value="Wireless">Wireless</option>
                                                    <option value="Writing and Editing">Writing and Editing</option>
                                                </select>
                                            </div>
                                        </div> 

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <select class="form-control br-0" id="corporate-top_country" name="country" required="">
                                                    <option value="">--Select Country</option>
                                                    <option value="Afghanistan">Afghanistan</option>
                                                    <option value="Albania">Albania</option>
                                                    <option value="Algeria">Algeria</option>
                                                    <option value="Andorra">Andorra</option>
                                                    <option value="Angola">Angola</option>
                                                    <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                    <option value="Argentina">Argentina</option>
                                                    <option value="Armenia">Armenia</option>
                                                    <option value="Aruba">Aruba</option>
                                                    <option value="Australia">Australia</option>
                                                    <option value="Austria">Austria</option>
                                                    <option value="Azerbaijan">Azerbaijan</option>
                                                    <option value="Bahamas, The">Bahamas, The</option>
                                                    <option value="Bahrain">Bahrain</option>
                                                    <option value="Bangladesh">Bangladesh</option>
                                                    <option value="Barbados">Barbados</option>
                                                    <option value="Belarus">Belarus</option>
                                                    <option value="Belgium">Belgium</option>
                                                    <option value="Belize">Belize</option>
                                                    <option value="Benin">Benin</option>
                                                    <option value="Bhutan">Bhutan</option>
                                                    <option value="Bolivia">Bolivia</option>
                                                    <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                    <option value="Botswana">Botswana</option>
                                                    <option value="Brazil">Brazil</option>
                                                    <option value="Brunei">Brunei</option>
                                                    <option value="Bulgaria">Bulgaria</option>
                                                    <option value="Burkina Faso">Burkina Faso</option>
                                                    <option value="Burma">Burma</option>
                                                    <option value="Burundi">Burundi</option>
                                                    <option value="Cabo Verde">Cabo Verde</option>
                                                    <option value="Cambodia">Cambodia</option>
                                                    <option value="Cameroon">Cameroon</option>
                                                    <option value="Canada">Canada</option>
                                                    <option value="Central African Republic">Central African Republic</option>
                                                    <option value="Chad">Chad</option>
                                                    <option value="Chile">Chile</option>
                                                    <option value="China">China</option>
                                                    <option value="Colombia">Colombia</option>
                                                    <option value="Comoros">Comoros</option>
                                                    <option value="Congo, Democratic Republic of the">Congo, Democratic Republic of the</option>
                                                    <option value="Congo, Republic of the">Congo, Republic of the</option>
                                                    <option value="Costa Rica">Costa Rica</option>
                                                    <option value="Cote d" ivoire="" '="">Cote d'Ivoire</option>
                                                    <option value="Croatia">Croatia</option>
                                                    <option value="Cuba">Cuba</option>
                                                    <option value="Curacao">Curacao</option>
                                                    <option value="Cyprus">Cyprus</option>
                                                    <option value="Czechia">Czechia</option>
                                                    <option value="Denmark">Denmark</option>
                                                    <option value="Djibouti">Djibouti</option>
                                                    <option value="Dominica">Dominica</option>
                                                    <option value="Dominican Republic">Dominican Republic</option>
                                                    <option value="East Timor (see&nbsp;Timor-Leste)">East Timor (see&nbsp;Timor-Leste)</option>
                                                    <option value="Ecuador">Ecuador</option>
                                                    <option value="Egypt">Egypt</option>
                                                    <option value="El Salvador">El Salvador</option>
                                                    <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option value="Eritrea">Eritrea</option>
                                                    <option value="Estonia">Estonia</option>
                                                    <option value="Ethiopia">Ethiopia</option>
                                                    <option value="Fiji">Fiji</option>
                                                    <option value="Finland">Finland</option>
                                                    <option value="France">France</option>
                                                    <option value="Gabon">Gabon</option>
                                                    <option value="Gambia, The">Gambia, The</option>
                                                    <option value="Georgia">Georgia</option>
                                                    <option value="Germany">Germany</option>
                                                    <option value="Ghana">Ghana</option>
                                                    <option value="Greece">Greece</option>
                                                    <option value="Grenada">Grenada</option>
                                                    <option value="Guatemala">Guatemala</option>
                                                    <option value="Guinea">Guinea</option>
                                                    <option value="Guinea-Bissau">Guinea-Bissau</option>
                                                    <option value="Guyana">Guyana</option>
                                                    <option value="Haiti">Haiti</option>
                                                    <option value="Holy See">Holy See</option>
                                                    <option value="Honduras">Honduras</option>
                                                    <option value="Hong Kong">Hong Kong</option>
                                                    <option value="Hungary">Hungary</option>
                                                    <option value="Iceland">Iceland</option>
                                                    <option value="India">India</option>
                                                    <option value="Indonesia">Indonesia</option>
                                                    <option value="Iran">Iran</option>
                                                    <option value="Iraq">Iraq</option>
                                                    <option value="Ireland">Ireland</option>
                                                    <option value="Israel">Israel</option>
                                                    <option value="Italy">Italy</option>
                                                    <option value="Jamaica">Jamaica</option>
                                                    <option value="Japan">Japan</option>
                                                    <option value="Jordan">Jordan</option>
                                                    <option value="Kazakhstan">Kazakhstan</option>
                                                    <option value="Kenya">Kenya</option>
                                                    <option value="Kiribati">Kiribati</option>
                                                    <option value="Korea, North">Korea, North</option>
                                                    <option value="Korea, South">Korea, South</option>
                                                    <option value="Kosovo">Kosovo</option>
                                                    <option value="Kuwait">Kuwait</option>
                                                    <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option value="Laos">Laos</option>
                                                    <option value="Latvia">Latvia</option>
                                                    <option value="Lebanon">Lebanon</option>
                                                    <option value="Lesotho">Lesotho</option>
                                                    <option value="Liberia">Liberia</option>
                                                    <option value="Libya">Libya</option>
                                                    <option value="Liechtenstein">Liechtenstein</option>
                                                    <option value="Lithuania">Lithuania</option>
                                                    <option value="Luxembourg">Luxembourg</option>
                                                    <option value="Macau">Macau</option>
                                                    <option value="Macedonia">Macedonia</option>
                                                    <option value="Madagascar">Madagascar</option>
                                                    <option value="Malawi">Malawi</option>
                                                    <option value="Malaysia">Malaysia</option>
                                                    <option value="Maldives">Maldives</option>
                                                    <option value="Mali">Mali</option>
                                                    <option value="Malta">Malta</option>
                                                    <option value="Marshall Islands">Marshall Islands</option>
                                                    <option value="Mauritania">Mauritania</option>
                                                    <option value="Mauritius">Mauritius</option>
                                                    <option value="Mexico">Mexico</option>
                                                    <option value="Micronesia">Micronesia</option>
                                                    <option value="Moldova">Moldova</option>
                                                    <option value="Monaco">Monaco</option>
                                                    <option value="Mongolia">Mongolia</option>
                                                    <option value="Montenegro">Montenegro</option>
                                                    <option value="Morocco">Morocco</option>
                                                    <option value="Mozambique">Mozambique</option>
                                                    <option value="Namibia">Namibia</option>
                                                    <option value="Nauru">Nauru</option>
                                                    <option value="Nepal">Nepal</option>
                                                    <option value="Netherlands">Netherlands</option>
                                                    <option value="New Zealand">New Zealand</option>
                                                    <option value="Nicaragua">Nicaragua</option>
                                                    <option value="Niger">Niger</option>
                                                    <option value="Nigeria">Nigeria</option>
                                                    <option value="North Korea">North Korea</option>
                                                    <option value="Norway">Norway</option>
                                                    <option value="Oman">Oman</option>
                                                    <option value="Pakistan">Pakistan</option>
                                                    <option value="Palau">Palau</option>
                                                    <option value="Palestinian Territories">Palestinian Territories</option>
                                                    <option value="Panama">Panama</option>
                                                    <option value="Papua New Guinea">Papua New Guinea</option>
                                                    <option value="Paraguay">Paraguay</option>
                                                    <option value="Peru">Peru</option>
                                                    <option value="Philippines">Philippines</option>
                                                    <option value="Poland">Poland</option>
                                                    <option value="Portugal">Portugal</option>
                                                    <option value="Qatar">Qatar</option>
                                                    <option value="Romania">Romania</option>
                                                    <option value="Russia">Russia</option>
                                                    <option value="Rwanda">Rwanda</option>
                                                    <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                    <option value="Saint Lucia">Saint Lucia</option>
                                                    <option value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                    <option value="Samoa">Samoa</option>
                                                    <option value="San Marino">San Marino</option>
                                                    <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                    <option value="Saudi Arabia">Saudi Arabia</option>
                                                    <option value="Senegal">Senegal</option>
                                                    <option value="Serbia">Serbia</option>
                                                    <option value="Seychelles">Seychelles</option>
                                                    <option value="Sierra Leone">Sierra Leone</option>
                                                    <option value="Singapore">Singapore</option>
                                                    <option value="Sint Maarten">Sint Maarten</option>
                                                    <option value="Slovakia">Slovakia</option>
                                                    <option value="Slovenia">Slovenia</option>
                                                    <option value="Solomon Islands">Solomon Islands</option>
                                                    <option value="Somalia">Somalia</option>
                                                    <option value="South Africa">South Africa</option>
                                                    <option value="South Korea">South Korea</option>
                                                    <option value="South Sudan">South Sudan</option>
                                                    <option value="Spain">Spain</option>
                                                    <option value="Sri Lanka">Sri Lanka</option>
                                                    <option value="Sudan">Sudan</option>
                                                    <option value="Suriname">Suriname</option>
                                                    <option value="Swaziland">Swaziland</option>
                                                    <option value="Sweden">Sweden</option>
                                                    <option value="Switzerland">Switzerland</option>
                                                    <option value="Syria">Syria</option>
                                                    <option value="Taiwan">Taiwan</option>
                                                    <option value="Tajikistan">Tajikistan</option>
                                                    <option value="Tanzania">Tanzania</option>
                                                    <option value="Thailand">Thailand</option>
                                                    <option value="Timor-Leste">Timor-Leste</option>
                                                    <option value="Togo">Togo</option>
                                                    <option value="Tonga">Tonga</option>
                                                    <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                    <option value="Tunisia">Tunisia</option>
                                                    <option value="Turkey">Turkey</option>
                                                    <option value="Turkmenistan">Turkmenistan</option>
                                                    <option value="Tuvalu">Tuvalu</option>
                                                    <option value="Uganda">Uganda</option>
                                                    <option value="Ukraine">Ukraine</option>
                                                    <option value="United Arab Emirates">United Arab Emirates</option>
                                                    <option value="United Kingdom">United Kingdom</option>
                                                    <option value="Uruguay">Uruguay</option>
                                                    <option value="Uzbekistan">Uzbekistan</option>
                                                    <option value="Vanuatu">Vanuatu</option>
                                                    <option value="Venezuela">Venezuela</option>
                                                    <option value="Vietnam">Vietnam</option>
                                                    <option value="Yemen">Yemen</option>
                                                    <option value="Zambia">Zambia</option>
                                                    <option value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div> 

                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                                            <div class="form-group">
                                                <input id="corporate-top_terms" type="checkbox" name="corporate-top_terms" required="">
                                                <label for="corporate-top_terms" style="cursor: pointer;">I agree to the <a href="{{ url('render/terms') }}"  target="_BLANK">Terms and Conditions</a></label>
                                            </div>
                                        </div>                                        

                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <button class="btn credit-btn mt-30 pull-right" type="button" id="corporate" onclick="goscroll('agreement-top', 'corporate-top')">Next &gt;&gt;</button>
                                            </div>
                                        </div> 

                                        <br />
                                    </div>
                                </form>
                            </div>



                    </div>


                    <div class="single-contact-area mb-100 stage2 animated fadeIn agreement-top_def" id="agreement-top">
                 
                            <div class="contact-form-area contact-page bg-ash">
                                <div class="agreement-top_myloader myloader">
                                    <div class="agreement-top_checkmark draw"></div>
                                </div>

                                <h4 class="mb-50">Stage 2/4: Agreement</h4>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 text-center top">RECIPROCAL NONDISCLOSURE AND CONFIDENTIALITY AGREEMENT</div>
    </div>
</div>
                                                                
<span class="bold">THIS RECIPROCAL NONDISCLOSURE AND CONFIDENTIALITY AGREEMENT</span> (this “Agreement”) is made and entered into effective this <span class="bold underline text-danger"> {{ date('dS')." of ".date('M Y') }} ,</span> by and between 
<br /><br />
<span class="bold text-danger"><span id="company"></span> of <span id="address"></span>,</span> <span class="bold">refers to as Associate</span> and any and all of his associates and affiliated companies and ventures and <span class="bold">PRO-FILR EXECUTES.</span> (Pro-EXECUTES) and the companies and interests represented by <span class="bold">PRO-FILR EXECUTES.</span> (the Parties).
<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold">WHEREAS,</span> the parties have requested information from each other in connection with the consideration of a possible transaction or relationship related to the buying and selling of commodities, various development projects, corporate and capital financing or investment strategies to execute the business objectives (the “Matter”) between the Parties, and 
<br /><br />
&nbsp;&nbsp;&nbsp;<span class="bold">WHEREAS,</span> in the course of consideration of the Matter, the Parties may disclose to each other confidential, important and / or proprietary trade secret information concerning their activities.
<br /><br />
&nbsp;&nbsp;&nbsp;<span class="bold">NOW, THEREFORE,</span> the parties agree to enter into a mutual and reciprocal confidential, non-circumvention and non-competition relationship with respect to the disclosure to each other of certain information.
<br /><br />
1.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline">Definitions. </span>
For purposes of this Agreement, “Confidential Information” shall include all information that PRO- EXECUTES discloses to the ASSOCIATE and the ASSOCIATE discloses to PRO- EXECUTES and that has or could have commercial value or other utility in the business or prospective business of the disclosing Parties or its subsidiaries or affiliates whether or not such information is identified as Confidential Information by the disclosing Party. By example and without limitation, Confidential Information includes but is not limited to any and all information of the following or similar nature, whether or not reduced to writing: copyright, service mark and trademark registrations and applications, patents and patent applications, licenses, agreements, unique and special methods, techniques, procedures, processes, routines, formulas, know-how, trade secrets, innovations, inventions, discoveries, improvements, research or development and test results, research papers, specifications, technical data and/or information, software, quality control and manufacturing procedures, formats, plans, sketches, drawings, models, customer lists, customer and supplier identities and financial information that includes but is not limited to: financing strategies, financial projections, documents and models, budgets, business plans and objectives, concepts, ideas, and any other information or procedures that are 
<br /><br />
treated as, expressed or implied, or designated secret or confidential by the disclosing Party.
 
<br /><br />
2.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline">Covenant of Confidentiality. </span>
The Parties shall not disclose any Confidential information or any information derived therefrom to any third person (except its agents and consultants subject to the conditions stated below) and shall hold and maintain the Confidential Information in strictest confidence and take all reasonable precautions to protect such Confidential Information (including without limitation, all precautions that each Party employs with respect to its confidential materials), except information that each Party can demonstrate by clear and convincing evidence:   (a) Was rightfully obtained by its possession prior to disclosure by
the other party;   (b) Was rightfully obtained by the Party from a third party who lawfully developed the information independently of the other party or obtained such information under conditions which did not require that it by held in confidence;   (c) Was independently developed by the other Party without use of or reference to the Confidential Information; or   (d) Was, at the time of disclosure or thereafter becomes, through no act or failure to act on the part of the Party, generally available to the public. Any officer, employee, agent or consultant of either Party given access to any Confidential Information must have a bona fide need to know such information.
<br /><br />
3.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline ">Covenant to Refrain From Use. </span>
Parties shall use the Confidential Information solely for the purpose of evaluating the Matter and agree that they shall not use whatsoever at any time any Confidential Information to the detriment of the other Party or copy or reverse engineer any such Confidential Information. Nothing in this Agreement shall be construed as granting any rights to either Party by license or otherwise, to any Confidential Information.
<br /><br />
4.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline ">Return of Confidential Information.</span> 
Each Party shall return to each other party at any time upon request of other Party for any reason all Confidential Information and all records, notes, documents, drawings, prototypes, specifications, programs, data, devices and all other materials containing or pertaining to the Confidential Information.
<br /><br />
5.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline ">No Additional Agreements. </span>
Neither the holding of discussions nor the exchange of material or information shall be construed as an obligation of either Party to enter into any other agreement with the other Party or prohibit either Party from providing the same or similar information to other parties and entering into agreements with third parties. Each Party reserves the right, in each ones sole discretion, to reject any and all proposals made by the other Party with regard to a transaction between the Parties and to terminate discussions and negotiations with the other party at any time. Additional agreements of the parties, if any, shall be in writing signed by both parties.
<br /><br />
6.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline ">Enforcement. </span>
The Parties understands and acknowledges that any disclosure or misappropriation of any of the Confidential Information in violation of this Agreement may cause either Party irreparable harm, the amount of which may be difficult to ascertain, and therefore agrees that the Party who is aggrieved by a violation of this agreement shall have the right to apply to a court of competent jurisdiction for specific performance and/or an order restraining and enjoining any such further disclosure or breach and for such other relief as that Party shall deem appropriate. Such right is to be in addition to the remedies otherwise available at law or in equity. Both Parties expressly waive the defense that a remedy in damages will be adequate and any requirement for the posting of a bond by the plaintiff in an action for specific performance or injunction. The Parties hereby agrees to indemnify the other Party against any and all losses, damages, claims, expenses and solicitor’s fees and costs incurred or suffered by the Plaintiff as a result of any breach of this Agreement by plaintiff or in connection with the enforcement of plaintiff’s obligations hereunder.
<br /><br />

7.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline ">Survivability. </span>
The Parties obligations hereunder shall continue beyond the termination of any relationship between the parties and beyond the return of the Confidential Information documentation hereunder for a period of 5 (five) years from the date hereof except for financial information that will extend to 10 years.
<br /><br />
8.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline">Solicitor’s Fees.</span>
If any action at law or in equity is brought to enforce or interpret the provisions of the Agreement, the prevailing party in such action shall be awarded its solicitors’ fees and costs incurred, which shall be payable whether or not such action is prosecuted to judgment.
<br /><br />
9.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline">Miscellaneous. </span>
This Agreement contains the entire agreement between the parties regarding its subject matter and supersedes all prior or contemporaneous proposals, agreements, representations and understandings, whether written or oral, between the parties regarding such subject matter. This Agreement is not, however, to limit any rights that either party may have under trade secret, copyright, patent or other laws. This Agreement may not be amended or modified except in writing signed by each of the parties hereto. This Agreement shall be binding on and shall inure to the benefit of the parties hereto and their respective successors and assigns; provided, however, that the rights and obligations of each Party hereunder are not assignable. In the event that any of the provisions of this Agreement shall be held by a court or other tribunal of competent jurisdiction to be illegal, invalid or unenforceable, such provisions shall be limited or eliminated to the minimum extent necessary so that this Agreement shall otherwise remain in full force and effect. This Agreement shall be construed as to its fair meaning and not strictly for or against either party. The headings hereof are descriptive only and not to be construed in interpreting the provisions hereof. This Agreement may be executed in any number of counterparts, each of which may be executed by less than all of the parties, each of which shall be enforceable against the party actually executing such counterpart, and all of which together shall constitute on instrument. The parties shall be entitled to rely upon and enforce a facsimile of any authorized signatures as if it were the original.
<br /><br />
10.&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline">Financial Consideration.</span>
Financial arrangements for all deals / projects / transactions between the parties herein, concerning their Fees and Commissions, will be agreed separately by a Memorandum of Understanding for each and every deal / project / transaction.
<br /><br />
11.&nbsp;&nbsp;&nbsp;&nbsp;<span class="bold underline">Signing.</span>
Electronic Signatures are legal and binding upon both parties herein.
<br /><br />

<span class="bold">IN WITNESS WHEREOF,</span> the parties have executed this Agreement as of the date first written above.
<br /><br />
<span class="bold">PRO-FILR EXECUTES.          &nbsp;&nbsp;&nbsp;        <span class="text-danger"><span id="company"></span></span></span>
<br /><br />                          

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 text-center">
             By: Shalom Adebiyi 
             <br/>
             Director of Operations
        </div>        
        <div class="col-md-6 text-center">
             By: <span style="text-decoration: underline;" class="text-danger"> <span id="companyname"></span></span> 
             <br/>
             Director       
        </div>                 
    </div>
</div>
 <br /><br />    
    <div class="row noprint">
        <div class="col-md-12 text-center text-danger">
            <hr />
             Kindly download this non disclosure form to upload in the next stage 
             <hr>
             <button type="button" class="btn btn-sm btn-success" onclick="download('agreement-top')">GENERATE & DOWNLOAD NOW | <i class="fa fa-print"></i> </button>    
        </div>
    </div>

    





                            </div>
                    </div>



                    <div class="single-contact-area mb-100 stage1 animated fadeIn account-top_def" id="account-top">
                 
                            <div class="contact-form-area contact-page bg-ash">
                                <div class="account-top_myloader myloader">
                                    <div class="account-top_checkmark draw"></div>
                                </div>

                                <h4 class="mb-50">Stage 3/4: User Account Set Up</h4>

                                <form action="#" method="post">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                                            <center>
                                                <img src="https://i0.wp.com/www.winhelponline.com/blog/wp-content/uploads/2017/12/user.png?fit=256%2C256&quality=100&ssl=1" alt="" class="img img-responsive" style="float: none;" />
                                            </center>
                                        </div>                                        
                                        <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control br-0" name="first_name" id="account-top_first_name" placeholder="First Name" required="" autofocus="">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control br-0" name="last_name" id="account-top_last_name" placeholder="Last Name" required="">
                                            </div>
                                        </div>   
                                        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="email" class="form-control br-0" name="email" id="account-top_email" placeholder="Email" required="">
                                            </div>
                                        </div>                                       
                                        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control br-0" name="username" id="account-top_username" placeholder="username" required="">
                                            </div>
                                        </div>                                      
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <input type="password" class="form-control br-0" name="password" id="account-top_password" placeholder="Password" required="">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <button class="btn credit-btn mt-30 pull-right" type="button" id="account" onclick="goscroll('payment-top', 'account-top')">Next &gt;&gt;</button>
                                            </div>
                                        </div> 
                                    </div>    
                                </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                    </div>

                    <div class="single-contact-area mb-100 stage1 animated fadeIn payment-top_def" id="payment-top">
                 
                            <div class=" contact-page bg-ash">
                                <div class="payment-top_myloader myloader">
                                    <div class="payment-top_checkmark draw"></div>
                                </div>

                                <h4 class="mb-50">Stage 4/4: Payment</h4>
                                <center>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick" />
<input type="hidden" name="hosted_button_id" value="C82P7AHK7QEQ6" />
<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
<img alt="" border="0" src="https://www.paypal.com/en_CA/i/scr/pixel.gif" width="1" height="1" class="img img-responsive" />
</form>
                                </center>
                            </div>
                    </div>
                    <br />
                    <br />
                    </div>
                </div>


                </div>
<span id="siteseal"><script async="" type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=KC9Mv6uQImv8NTQp4qOq1puQOKyYyaqrLrDPHPsQnZzhHOJm7kEXfSxk5GSy"></script></span>
    </div></div>
@endsection
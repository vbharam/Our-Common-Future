<?php 
ob_start();
session_start();
include 'includes/Bluehost_connect.php'; 
?>

<?php
	// Get info asociated with the user	
	$uid = $_SESSION["uid"];
	if ($uid !="" || $uid !=null) {
		$userQuery = "SELECT * FROM `USER_INFO` WHERE `ID` = '".$_SESSION["uid"]."'";
		$userInfoResult = mysql_query($userQuery,$connection);
		if (!$userInfoResult) {
	    $message  = 'Invalid query: ' . mysql_error() . "\n";
	    $message .= 'Whole query: ' . $userQuery;
	    die($message);
		}
		while ($subject = mysql_fetch_assoc($userInfoResult)) { 
			$name = ($subject['NAME']);
			$country = ($subject['COUNTRY']);
			$uwc = ($subject['UWC']);
			$uwcYear=($subject['UWC_YEAR']);
			$association = ($subject['ASSOCIATION_DESCRIPTION']); 
			$languages = ($subject['LANGUAGES']);
			$skills = ($subject['SKILLS']);
			$bio = ($subject['BIO']);
			$phone = ($subject['PHONE']);
			$email = ($subject['EMAIL']);
			$profilePic = ($subject['PROFILE_PIC']);
			if ($profilePic == "" || $profilePic == null || $profilePic == undefined) { 
				$profilePic = uploads . '/' . 'user.jpg'; 
			} else if (strpos($profilePic, "http") !== false) { 
				$profilePic = $profilePic; 
			} else { 
				$profilePic = uploads . '/' . $profilePic; 
			}
	  }
	}
mysql_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/responsive.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/touchTouch.css" type="text/css" media="screen">
	<link rel="stylesheet" href="css/kwicks-slider.css" type="text/css" media="screen">
  <link href="css/tm_docs.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:205,300' rel='stylesheet' type='text/css'>
	<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">

  <script id="metamorph-1-start" type="text/x-placeholder"></script><script id="metamorph-21-start" type="text/x-placeholder"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/superfish.js"></script>
	<script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
	<script type="text/javascript" src="js/jquery.kwicks-1.5.1.js"></script>
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.js"></script>
	<script type="text/javascript" src="js/touchTouch.jquery.js"></script>
	<script type="text/javascript">if($(window).width()>1024){document.write("<"+"script src='js/jquery.preloader.js'></"+"script>");} </script>

	<script>
		jQuery(window).load(function() {
			$x = $(window).width();
			if($x > 1024)
			{jQuery("#content .row").preloader();}
		  jQuery('.magnifier').touchTouch();
		  jQuery('.spinner').animate({'opacity':0},1000,'easeOutCubic',function (){jQuery(this).css('display','none')});
  	});
	</script>
</head>

<body>
	<div class="spinner"></div>
	<header>
	  <?php include 'includes/header.php'; ?> 
	</header>

  <div class="bg-content"> <!-- content -->      
    <div id="content"><div class="ic"></div>
	    <div class="row-1">
	    	<div class="container">
	      	<div class="row">
	      		<article class="span9" style="float:center; text-align:center"><h4>EDIT PROFILE</h4></article>
	      		<form id="updateForm" class="form-horizontal" role="form" style="padding:15px;">
			      	<ul class="span9" style="list-style-type:none">
			      		<li class="span4">
			      			<label style="margin-top:10px"> Full Name </label>
		              <input style="width:100%" class="form-control" type="text" name="name" aria-required="true" id="name" placeholder="Full Name" value="<?php echo $name; ?>">
			      		</li>
			      		<li class="span4">
			      			<label style="margin-top:10px"> Country</label>
		              <select name="country" id="country" class="form-control" style="width:100%;"> 
										<option value="" selected="selected">Select Country</option> 															
										<option value="Afghanistan">Afghanistan</option> 
										<option value="Albania">Albania</option> 
										<option value="Algeria">Algeria</option> 
										<option value="American Samoa">American Samoa</option> 
										<option value="Andorra">Andorra</option> 
										<option value="Angola">Angola</option> 
										<option value="Anguilla">Anguilla</option> 
										<option value="Antarctica">Antarctica</option> 
										<option value="Antigua and Barbuda">Antigua and Barbuda</option> 
										<option value="Argentina">Argentina</option> 
										<option value="Armenia">Armenia</option> 
										<option value="Aruba">Aruba</option> 
										<option value="Australia">Australia</option> 
										<option value="Austria">Austria</option> 
										<option value="Azerbaijan">Azerbaijan</option> 
										<option value="Bahamas">Bahamas</option> 
										<option value="Bahrain">Bahrain</option> 
										<option value="Bangladesh">Bangladesh</option> 
										<option value="Barbados">Barbados</option> 
										<option value="Belarus">Belarus</option> 
										<option value="Belgium">Belgium</option> 
										<option value="Belize">Belize</option> 
										<option value="Benin">Benin</option> 
										<option value="Bermuda">Bermuda</option> 
										<option value="Bhutan">Bhutan</option> 
										<option value="Bolivia">Bolivia</option> 
										<option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option> 
										<option value="Botswana">Botswana</option> 
										<option value="Bouvet Island">Bouvet Island</option> 
										<option value="Brazil">Brazil</option> 
										<option value="British Indian Ocean Territory">British Indian Ocean Territory</option> 
										<option value="Brunei Darussalam">Brunei Darussalam</option> 
										<option value="Bulgaria">Bulgaria</option> 
										<option value="Burkina Faso">Burkina Faso</option> 
										<option value="Burundi">Burundi</option> 
										<option value="Cambodia">Cambodia</option> 
										<option value="Cameroon">Cameroon</option> 
										<option value="Canada">Canada</option> 
										<option value="Cape Verde">Cape Verde</option> 
										<option value="Cayman Islands">Cayman Islands</option> 
										<option value="Central African Republic">Central African Republic</option> 
										<option value="Chad">Chad</option> 
										<option value="Chile">Chile</option> 
										<option value="China">China</option> 
										<option value="Christmas Island">Christmas Island</option> 
										<option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option> 
										<option value="Colombia">Colombia</option> 
										<option value="Comoros">Comoros</option> 
										<option value="Congo">Congo</option> 
										<option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option> 
										<option value="Cook Islands">Cook Islands</option> 
										<option value="Costa Rica">Costa Rica</option> 
										<option value="Cote D'ivoire">Cote D'ivoire</option> 
										<option value="Croatia">Croatia</option> 
										<option value="Cuba">Cuba</option> 
										<option value="Cyprus">Cyprus</option> 
										<option value="Czech Republic">Czech Republic</option> 
										<option value="Denmark">Denmark</option> 
										<option value="Djibouti">Djibouti</option> 
										<option value="Dominica">Dominica</option> 
										<option value="Dominican Republic">Dominican Republic</option> 
										<option value="Ecuador">Ecuador</option> 
										<option value="Egypt">Egypt</option> 
										<option value="El Salvador">El Salvador</option> 
										<option value="Equatorial Guinea">Equatorial Guinea</option> 
										<option value="Eritrea">Eritrea</option> 
										<option value="Estonia">Estonia</option> 
										<option value="Ethiopia">Ethiopia</option> 
										<option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option> 
										<option value="Faroe Islands">Faroe Islands</option> 
										<option value="Fiji">Fiji</option> 
										<option value="Finland">Finland</option> 
										<option value="France">France</option> 
										<option value="French Guiana">French Guiana</option> 
										<option value="French Polynesia">French Polynesia</option> 
										<option value="French Southern Territories">French Southern Territories</option> 
										<option value="Gabon">Gabon</option> 
										<option value="Gambia">Gambia</option> 
										<option value="Georgia">Georgia</option> 
										<option value="Germany">Germany</option> 
										<option value="Ghana">Ghana</option> 
										<option value="Gibraltar">Gibraltar</option> 
										<option value="Greece">Greece</option> 
										<option value="Greenland">Greenland</option> 
										<option value="Grenada">Grenada</option> 
										<option value="Guadeloupe">Guadeloupe</option> 
										<option value="Guam">Guam</option> 
										<option value="Guatemala">Guatemala</option> 
										<option value="Guinea">Guinea</option> 
										<option value="Guinea-bissau">Guinea-bissau</option> 
										<option value="Guyana">Guyana</option> 
										<option value="Haiti">Haiti</option> 
										<option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option> 
										<option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option> 
										<option value="Honduras">Honduras</option> 
										<option value="Hong Kong">Hong Kong</option> 
										<option value="Hungary">Hungary</option> 
										<option value="Iceland">Iceland</option> 
										<option value="India">India</option> 
										<option value="Indonesia">Indonesia</option> 
										<option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option> 
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
										<option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option> 
										<option value="Korea, Republic of">Korea, Republic of</option> 
										<option value="Kuwait">Kuwait</option> 
										<option value="Kyrgyzstan">Kyrgyzstan</option> 
										<option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option> 
										<option value="Latvia">Latvia</option> 
										<option value="Lebanon">Lebanon</option> 
										<option value="Lesotho">Lesotho</option> 
										<option value="Liberia">Liberia</option> 
										<option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option> 
										<option value="Liechtenstein">Liechtenstein</option> 
										<option value="Lithuania">Lithuania</option> 
										<option value="Luxembourg">Luxembourg</option> 
										<option value="Macao">Macao</option> 
										<option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option> 
										<option value="Madagascar">Madagascar</option> 
										<option value="Malawi">Malawi</option> 
										<option value="Malaysia">Malaysia</option> 
										<option value="Maldives">Maldives</option> 
										<option value="Mali">Mali</option> 
										<option value="Malta">Malta</option> 
										<option value="Marshall Islands">Marshall Islands</option> 
										<option value="Martinique">Martinique</option> 
										<option value="Mauritania">Mauritania</option> 
										<option value="Mauritius">Mauritius</option> 
										<option value="Mayotte">Mayotte</option> 
										<option value="Mexico">Mexico</option> 
										<option value="Micronesia, Federated States of">Micronesia, Federated States of</option> 
										<option value="Moldova, Republic of">Moldova, Republic of</option> 
										<option value="Monaco">Monaco</option> 
										<option value="Mongolia">Mongolia</option> 
										<option value="Montserrat">Montserrat</option> 
										<option value="Morocco">Morocco</option> 
										<option value="Mozambique">Mozambique</option> 
										<option value="Myanmar">Myanmar</option> 
										<option value="Namibia">Namibia</option> 
										<option value="Nauru">Nauru</option> 
										<option value="Nepal">Nepal</option> 
										<option value="Netherlands">Netherlands</option> 
										<option value="Netherlands Antilles">Netherlands Antilles</option> 
										<option value="New Caledonia">New Caledonia</option> 
										<option value="New Zealand">New Zealand</option> 
										<option value="Nicaragua">Nicaragua</option> 
										<option value="Niger">Niger</option> 
										<option value="Nigeria">Nigeria</option> 
										<option value="Niue">Niue</option> 
										<option value="Norfolk Island">Norfolk Island</option> 
										<option value="Northern Mariana Islands">Northern Mariana Islands</option> 
										<option value="Norway">Norway</option> 
										<option value="Oman">Oman</option> 
										<option value="Pakistan">Pakistan</option> 
										<option value="Palau">Palau</option> 
										<option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option> 
										<option value="Panama">Panama</option> 
										<option value="Papua New Guinea">Papua New Guinea</option> 
										<option value="Paraguay">Paraguay</option> 
										<option value="Peru">Peru</option> 
										<option value="Philippines">Philippines</option> 
										<option value="Pitcairn">Pitcairn</option> 
										<option value="Poland">Poland</option> 
										<option value="Portugal">Portugal</option> 
										<option value="Puerto Rico">Puerto Rico</option> 
										<option value="Qatar">Qatar</option> 
										<option value="Reunion">Reunion</option> 
										<option value="Romania">Romania</option> 
										<option value="Russian Federation">Russian Federation</option> 
										<option value="Rwanda">Rwanda</option> 
										<option value="Saint Helena">Saint Helena</option> 
										<option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option> 
										<option value="Saint Lucia">Saint Lucia</option> 
										<option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option> 
										<option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option> 
										<option value="Samoa">Samoa</option> 
										<option value="San Marino">San Marino</option> 
										<option value="Sao Tome and Principe">Sao Tome and Principe</option> 
										<option value="Saudi Arabia">Saudi Arabia</option> 
										<option value="Senegal">Senegal</option> 
										<option value="Serbia and Montenegro">Serbia and Montenegro</option> 
										<option value="Seychelles">Seychelles</option> 
										<option value="Sierra Leone">Sierra Leone</option> 
										<option value="Singapore">Singapore</option> 
										<option value="Slovakia">Slovakia</option> 
										<option value="Slovenia">Slovenia</option> 
										<option value="Solomon Islands">Solomon Islands</option> 
										<option value="Somalia">Somalia</option> 
										<option value="South Africa">South Africa</option> 
										<option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option> 
										<option value="Spain">Spain</option> 
										<option value="Sri Lanka">Sri Lanka</option> 
										<option value="Sudan">Sudan</option> 
										<option value="Suriname">Suriname</option> 
										<option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option> 
										<option value="Swaziland">Swaziland</option> 
										<option value="Sweden">Sweden</option> 
										<option value="Switzerland">Switzerland</option> 
										<option value="Syrian Arab Republic">Syrian Arab Republic</option> 
										<option value="Taiwan, Province of China">Taiwan, Province of China</option> 
										<option value="Tajikistan">Tajikistan</option> 
										<option value="Tanzania, United Republic of">Tanzania, United Republic of</option> 
										<option value="Thailand">Thailand</option> 
										<option value="Timor-leste">Timor-leste</option> 
										<option value="Togo">Togo</option> 
										<option value="Tokelau">Tokelau</option> 
										<option value="Tonga">Tonga</option> 
										<option value="Trinidad and Tobago">Trinidad and Tobago</option> 
										<option value="Tunisia">Tunisia</option> 
										<option value="Turkey">Turkey</option> 
										<option value="Turkmenistan">Turkmenistan</option> 
										<option value="Turks and Caicos Islands">Turks and Caicos Islands</option> 
										<option value="Tuvalu">Tuvalu</option> 
										<option value="Uganda">Uganda</option> 
										<option value="Ukraine">Ukraine</option> 
										<option value="United Arab Emirates">United Arab Emirates</option> 
										<option value="United Kingdom">United Kingdom</option> 
										<option value="United States">United States</option> 
										<option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option> 
										<option value="Uruguay">Uruguay</option> 
										<option value="Uzbekistan">Uzbekistan</option> 
										<option value="Vanuatu">Vanuatu</option> 
										<option value="Venezuela">Venezuela</option> 
										<option value="Viet Nam">Viet Nam</option> 
										<option value="Virgin Islands, British">Virgin Islands, British</option> 
										<option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option> 
										<option value="Wallis and Futuna">Wallis and Futuna</option> 
										<option value="Western Sahara">Western Sahara</option> 
										<option value="Yemen">Yemen</option> 
										<option value="Zambia">Zambia</option> 
										<option value="Zimbabwe">Zimbabwe</option>
									</select>
			      		</li>
			      		<li class="span4">
			      			<label style="margin-top:10px"> Relations to UWC and Year</label>
		              <!-- <input style="width:100%" class="form-control" type="text" name="UWC" id="UWC" placeholder="" value="<?php echo $uwc; ?>"> -->
			      			<select id="selectUWC" name="selectUWC" class="form-control" onChange ='addAssociationDescription()'>
			      				<optgroup><option value="" selected="selected">Select UWC Affiliation </option></optgroup>
			      				<optgroup label="------------------------------">
              <option value="Online UWC">Online UWC</option>
             </optgroup>
             <optgroup label="------------------------------">
								      <option value="Waterford Kamhlaba UWC ">Waterford Kamhlaba UWC </option>
								      <option value="Li Po Chun UWC">Li Po Chun UWC</option>
								      <option value="UWC Mahindra College">UWC Mahindra College</option>
								      <option value="UWC South East Asia">UWC South East Asia</option>
								      <option value="UWC Adriatic">UWC Adriatic</option>
								      <option value="UWC Atlantic College">UWC Atlantic College</option>
								      <option value="UWC Dilijan">UWC Dilijan</option>
								      <option value="UWC Maastricht">UWC Maastricht</option>
								      <option value="UWC in Mostar">UWC in Mostar</option>
								      <option value="UWC Red Cross Nordic ">UWC Red Cross Nordic </option>
								      <option value="UWC Robert Bosch College">UWC Robert Bosch College</option>
								      <option value="Pearson College UWC">Pearson College UWC</option>
								      <option value="UWC-USA">UWC-USA</option>
								      <option value="UWC Costa Rica">UWC Costa Rica</option>
								     </optgroup>
							      <optgroup label="------------------------------">
	                    <option value="Short Programs">UWC Short Programs</option>
                    </optgroup>
                    <optgroup label="------------------------------">
	                    <option value="UWC Associate">UWC Associate</option>
                    </optgroup>
                    <optgroup label="------------------------------">
	                    <option value="UWC Faculty">UWC Faculty</option>
                    </optgroup>
                    <optgroup label="------------------------------">
	                    <option value="UWC Staff">UWC Staff</option>
                    </optgroup>
                    <optgroup label="------------------------------">
	                    <option value="Others">Other</option>
                    </optgroup>
							    </select>
			      		
									<select id="selectYear" name="selectYear" style="width:auto">
										<option value="" selected="selected">Select Year</option>
										<option value="2014">2014</option>
										<option value="2013">2013</option>
										<option value="2012">2012</option>
										<option value="2011">2011</option>
										<option value="2010">2010</option>
										<option value="2009">2009</option>
										<option value="2008">2008</option>
										<option value="2007">2007</option>
										<option value="2006">2006</option>
										<option value="2005">2005</option>
										<option value="2004">2004</option>
										<option value="2003">2003</option>
										<option value="2002">2002</option>
										<option value="2001">2001</option>
										<option value="2000">2000</option>
										<option value="1999">1999</option>
										<option value="1998">1998</option>
										<option value="1997">1997</option>
										<option value="1996">1996</option>
										<option value="1995">1995</option>
										<option value="1994">1994</option>
										<option value="1993">1993</option>
										<option value="1992">1992</option>
										<option value="1991">1991</option>
										<option value="1990">1990</option>
										<option value="1989">1989</option>
										<option value="1988">1988</option>
										<option value="1987">1987</option>
										<option value="1986">1986</option>
										<option value="1985">1985</option>
										<option value="1984">1984</option>
										<option value="1983">1983</option>
										<option value="1982">1982</option>
										<option value="1981">1981</option>
										<option value="1980">1980</option>
										<option value="1979">1979</option>
										<option value="1978">1978</option>
										<option value="1977">1977</option>
										<option value="1976">1976</option>
										<option value="1975">1975</option>
										<option value="1974">1974</option>
										<option value="1973">1973</option>
										<option value="1972">1972</option>
										<option value="1971">1971</option>
										<option value="1970">1970</option>
										<option value="1969">1969</option>
										<option value="1968">1968</option>
										<option value="1967">1967</option>
										<option value="1966">1966</option>
										<option value="1965">1965</option>
										<option value="1964">1964</option>
										<option value="1963">1963</option>
										<option value="1962">1962</option>
									</select>
			
		 		         	<div id ="memberAssociation" style= "margin-top:-10px; display:none"> 
		 	            	<div class="form-group"> 
		 	            		<label style="margin-top:20px" for="association">Add Association Description</label> 
		 	              	<textarea class="form-control" name="association_description" id="association_description" placeholder="eg. Art Teacher, Global Leadership Forum (GLF)" style="width:100%; height:100px; resize:none"></textarea> 
		 		             </div>
	 		            </div>
								</li>
			      		<li class="span4">
			      			<label style="margin-top:10px"> Phone Number</label>
		              <input style="width:100%" class="form-control" type="text" name="phone" id="phone" placeholder="With country code (no spaces)" value="<?php echo $phone; ?>">
			      		</li>
			      		<li class="span4">
			      			<label style="margin-top:10px"> Languages</label>
		              <textarea class="form-control" name="languages" id="languages" placeholder="" style="width:100%; height:100px; resize:none"><?php echo trim($languages); ?></textarea>
			      		</li>
			      		<li class="span4">
			      			<label style="margin-top:10px"> Skills</label>
		              <textarea class="form-control" name="skills" id="skills" placeholder="Describe your skills in 150 characters or less" style="width:100%; height:100px; resize:none"><?php echo trim($skills); ?></textarea>
			      		</li>
			      		<li class="span4">
			      			<label style="margin-top:10px"> Mini Biography</label>
		              <textarea class="form-control" name="biography" id="biography" placeholder="Describe yourself in 150 characters or less" style="width:100%; height:100px; resize:none"><?php echo trim($bio); ?></textarea>
			      		</li>
			      		<li class="span4">
			      			<label style="margin-top:10px"> Profile Picture</label>
		              <input id="userPic" type="file" name="userPic[]" accept="image/*" style="margin:0 0 4px">
			      		</li>
			      		<li class="span4" style="margin-top:40px">
			      			<button id="updateButton" class="btn btn-success tm_style_3 pull-right" type="button" onclick='updateProfile()'> Save </button>
			      		</li>
			      	</ul>
			      	<div class="pp" style="width:200px; float:right;">
			      	<ul class="col-sm-6 col-md-4">
			      		<img class="img-circle" src=<?php echo $profilePic ?>>
			      	</ul>
			      	</div>
			      </form>
      		</div>
		    </div>
		  </div>
<!-- ABOUT US -->
<?php include 'includes/aboutUs.php'; ?> 
</div>
</div>

<!-- footer -->
<?php include 'includes/footer.php'; ?> 

	<script type="text/javascript" src="uwcnext.js"></script> <!-- Link to javscript file -->
	<script type="text/javascript" src="script.js"></script> <!-- Link to javscript file -->
	<script type="text/javascript"> 
  	window.uid = <?php echo json_encode($_SESSION['uid']);?>;
  	window.userEmail = <?php echo json_encode($_SESSION["email"]);?>;
  	$(document).ready(function(){
  		var UWC = <?php echo json_encode($uwc);?>;
  		var uwcYear = <?php echo json_encode($uwcYear);?>;
  		var country = <?php echo json_encode($country);?>;		
			$("#selectUWC").val(UWC);	
			$("#selectYear").val(uwcYear);	
			$("#country").val(country);	
  	})
  </script>
</body>

</html>
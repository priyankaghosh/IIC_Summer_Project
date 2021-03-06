
<!DOCTYPE html>
<html class="no-js">
    <head>
	<title>Connect Health Indicators and Water Quality</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="description" content="">
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.min.css">
	<link rel="stylesheet" href="themes/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="themes/css/main.css">
	<link rel="stylesheet" href="themes/css/prettyPhoto.css">
	<link rel="stylesheet" href="themes/css/style.css">
	<link rel="stylesheet" href="themes/css/custom-responsive.css">
		
    </head>
    <body data-spy="scroll" data-target=".navbar">
        <header>
            <div class="container">
                <div class="navbar">
                    <div class="navbar-inner">
                        <div class="container">
                            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                         <!--  <a class="brand" href="#home"><i class="icon-ourwater"></i> &nbsp; Connect Health Indicators and Water Quality </a> -->
                            <div class="nav-collapse pull-right in collapse" style="height: auto;">
                                <ul class="nav">
                                    <li class="active">
                                        <a href="#home">Home</a>
                                    </li>
                                    <li class="">
                                        <a href="#explore">Explore</a>
                                    </li>
                                    <li class="">
                                        <a href="#feedback">Feedback</a>
                                    </li>
                                    <li class="">
                                        <a href="#ourwater">Our Water Our Condition</a>
                                    </li>
                                    <li class="">
                                        <a href="#follow">Follow Us</a>
                    </div>
                </div>
            </div>
        </header>
       
        
    <section id="home" class="fill">
	<div class="container">
	    <h1>Connect Health Indicators and Water Quality</h1>
        	<div class="wrapper">
                    <h2>BE AWARE!<br>
			Know the Water around you<br>
			BE HEALTHY!</h2>
                    <p>Welcome to the whole new world of awareness. For the first time health and water quality are mapped together.
			The health department is not much aware about symptoms related to chemical contamination which means that there are high incidents of misdiagnosis for water borne diseases.
			For instance in areas like West Bengal where arsenic contamination are high. The health department does not know.
			So when people come to the doctor with arsenic symptoms like skin lesions, they are not diagnosed properly and are then treated for skin problems not the water contamination and the true cause is never understood.
			So, we have pulled out specific symptoms and mapped water quality around those symptoms to make you aware about major health issues related to water.</p>
                    <a class="btn btn-large btn-chunkfive" href="#explore" id="connect-now"><i class="icon-explore"></i>EXPLORE</a>
                </div>
	</div>
    </section>
    <section id="explore" class="fill">
	<div class="container">
	    <div class="wrapper">
		<h1 class="the-head">Explore</h1>
		<?php
		    try {
			$objDb = new PDO('mysql:host=localhost;dbname=health', 'root', 'jaimatadi.');
			$objDb->exec('SET CHARACTER SET utf8');
			$sql = "SELECT DISTINCT State FROM `DATA09`";
			$statement = $objDb->query($sql);
			$list = $statement->fetchAll(PDO::FETCH_ASSOC);
			} catch(PDOException $e) {
			    echo 'There was a problem';
			    }
		?>

		<div class="span12">
		    <div class="span3" align="left">
			<form action="result.php" method="post">
			    <select name="state" id="state" class="update">
			        <option value="">Select State</option>
				    <?php if (!empty($list)) { ?>
				    <?php foreach($list as $row) { ?>
				    <option value="<?php echo $row['State']; ?>">
				    <?php echo $row['State']; ?>
				    </option>
				    <?php } ?>
				    <?php } ?>
			    </select>
			    <select name="district" id="district" class="update">
				<option value="">Select District</option>
			    </select>
			    <button type="submit">Submit</button>
			</form>
			<script src="http://code.jquery.com/jquery-1.9.1.js"></script>	
			<script src="ajax.js" type="text/javascript"></script>
		    </div>
		    <div>
			<style>
			    #map-canvas {
			    margin: 0;
			    padding: 0;
			    height: 90%;
			    }
			</style>
			<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyBABGScJQIfCPdEHscp_YPmr79uAtdYU-k&sensor=false&region=IN"></script>
			<script>
			    var map;
			    function initialize() {
			    var mapOptions = {
			    zoom: 5,
			    center: new google.maps.LatLng(27, 75),
			    mapTypeId: google.maps.MapTypeId.ROADMAP
			    };
			    map = new google.maps.Map(document.getElementById('map-canvas'),
			    mapOptions);
			    }
			    function get_marker(lat,lon) {
			    var myLatlng = new google.maps.LatLng(lat,lon);
			    var marker = new google.maps.Marker({
			    position: myLatlng,
			    map: map,
			    title: 'Hello World!'
			    });
			    var infowindow = new google.maps.InfoWindow({
			    content: 'My lat is ' + lat + 'My lon is ' + lon
			    });
			    google.maps.event.addListener(marker, 'click', function() {
    			    infowindow.open(map,marker);
			    });
			    }

			    function codeAddress(address) {
				var geocoder;
				geocoder = new google.maps.Geocoder();
				geocoder.geocode( { 'address': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
				map: map,
				position: results[0].geometry.location,
				title: address
				});
				var infowindow = new google.maps.InfoWindow({
				content: address
 				});
				google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map,marker);
				});
				} else {
				    alert('Geocode was not successful for the following reason: ' + status);
				}
				});
			    }

			    google.maps.event.addDomListener(window, 'load', initialize);
			    codeAddress('RAJASTHAN');
			    get_marker(28.00, 80.00);
			</script>
  
		    <?php
			$host = mysqli_connect("localhost", "root", "jaimatadi.", "health");
			if(mysqli_connect_errno($host)) {
			echo "Not connected to database";
			} else {
			    echo "Connected";
			}
			$result = mysqli_query($host, "SELECT DISTINCT State FROM `DATA09` LIMIT 0,10");
	 		while($row = mysqli_fetch_array($result))
			    {
		    ?>
		<script>
		    codeAddress('<?php echo $row["State"]; ?>');
		</script>
		<?php
		    }
		?>
			<div id="map-canvas"></div> 

		    </div>
		</div>
		<div class="row-fluid">
                       
                </div>
            </div>
        </section>
        

        <section id="feedback" class="fill">
            <div class="container">
                <div class="wrapper">
                    <h1 class="the-head">Feedback</h1>
						<div class="row-fluid">
                        <div class="span6 offset3">
                            <form class="contact-form" action="">

                                <fieldset>
                                    <div class="control-group">
                                        <label for="name">Your Name</label>
                                        <input type="text" class="input-xlarge" name="name" id="name">
                                    </div>
                                    <div class="control-group">
                                            <label for="phone">Phone</label>
                                            <input type="text" class="input-xlarge" name="phone" id="phone">
                                    </div>
                                    <div class="control-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" class="input-xlarge" name="email" id="email">
                                    </div>
                                    <div class="control-group">
                                            <label for="message">Your Message</label>
                                            <textarea class="input-xlarge" name="message" id="message" rows="3"></textarea>
                                    </div>
                                    <div class="control-group">
                                        <button type="submit" class="btn btn-large btn-chunkfive">Send Message</button>
                                    </div>
                                </fieldset>
                            </form>
						</div>
						</div>

            


                </div>
            </div>
        </section>
        

        <section id="ourwater" class="fill">
            <div class="container">
                <div class="wrapper">
                    <h1 class="the-head">OUR WATER OUR CONDITION</h1>
                    
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="scrollbar">
                                <div class="handle">
                                    <div class="mousearea"></div>
                                </div>
                            </div>

                            <div class="frame effects" id="the-portfolio">
                                <ul class="clearfix">
                                    <li><img src="themes/images/food1.png" alt=""></li>
                                    <li><img src="themes/images/food2.png" alt=""></li>
                                    <li><img src="themes/images/food3.png" alt=""></li>
                                    <li><img src="themes/images/food4.png" alt=""></li>
                                    <li><img src="themes/images/food5.png" alt=""></li>
                                    <li><img src="themes/images/food6.png" alt=""></li>
                                    <li><img src="themes/images/food7.png" alt=""></li>
                                    <li><img src="themes/images/food8.png" alt=""></li>
                                </ul>
                            </div>

                            <div class="controls center">
                                <button class="prev"><i class="icon-double-angle-left"></i></button>
                                <button class="next"><i class="icon-double-angle-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section id="follow" class="fill">
            <div class="container">
               
                                   
                    <h3 align="center"><strong>Follow us on</strong></h3>
                            
                            <div class="social-links">
                                <ul>
                                    <li><a href="#"><i class="icon-facebook-sign"></i></a></li>
                                    <li><a href="#"><i class="icon-twitter-sign"></i></a></li>
                                    <li><a href="#"><i class="icon-pinterest"></i></a></li>
                                    <li><a href="#"><i class="icon-google-plus-sign"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       


        <a href="#" class="go-top" style="display: none;"><i class="icon-double-angle-up"></i></a>
        
        <script src="themes/js/jquery-1.9.1.min.js"></script>
        <script src="themes/js/bootstrap.min.js"></script>
        <script src="themes/js/bootstrap-scrollspy.js"></script>
        <script src="themes/js/jquery.easing-1.3.min.js"></script>
        <script src="themes/js/jquery.scrollTo-1.4.3.1-min.js"></script>
        <script src="themes/js/jquery.vegas.js"></script>
        <script src="themes/js/sly.min.js"></script>
        <script src="themes/js/jquery.prettyPhoto.js"></script>

        <script src="themes/js/main.js"></script>
        
    

</body></html>

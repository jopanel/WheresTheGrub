<?php


error_reporting(E_ALL);
set_time_limit(0);
ignore_user_abort(true);

require_once('Factual.php');

$key = "qhJk2hd0zYMJI45CZ3jH8r6NJFmcatWuIu3verS5";
$secret = "ZqF56cSPoeUkmp2muWlLowKBZG9agcmg6BJbkOsz";
	
//Run tests	
$factual = new Factual($key,$secret);	
$query = new FactualQuery;
$query->limit(50);
$query->sortAsc("region");
$query->sortAsc("locality");
$query->sortDesc("name");
$res = $factual->fetch("restaurants-us", $query);
$res = $res->getData();
foreach ($res as $entity){
echo $entity["email"]."<br>";

    }

    function dataScrape() {
    	$key = "qhJk2hd0zYMJI45CZ3jH8r6NJFmcatWuIu3verS5";
		$secret = "ZqF56cSPoeUkmp2muWlLowKBZG9agcmg6BJbkOsz";
		$factual = new Factual($key,$secret);	
		$query = new FactualQuery;
		$query->limit(50);
		$data = "";
		$haskid = 0;
		$hasexclusions = 0;
		$excludeIDs = [];
		$getExlusions = "SELECT `factual_id` FROM `leads`";
		$getExResults = mysql_query($getExlusions) or die(mysql_error());
		while ($exclude = mysql_fetch_array($getExResults)) {
			$hasexclusions = 1;
			$excludeIDs[] = $exclude['factual_id'];
		}
		$duplicatesarr = [];
		$getaddy = "SELECT * FROM `leads`";
		$resultaddy = mysql_query($getaddy) or die(mysql_error());
		while ($addy = mysql_fetch_array($resultaddy)) {
			$duplicatesarr[] = $addy['address']." ".$addy['name'];
		}
		$sql10 = "SELECT * FROM `zip_code`";
		$result10 = mysql_query($sql10) or die(mysql_error());
		while($row0 = mysql_fetch_array($result10)){
			$lon = $row0['longitude'];
			$lat = $row0['latitude'];
			if ($hasexclusions == 0) {
			$query->within(new FactualCircle($lat, $lon, 5000));
  			//$content = @file_get_contents_curl('http://api.v3.factual.com/t/restaurants-us?geo={"$circle":{"$center":['.$lat.','.$lon.'],"$meters":'.$mile.'}}&KEY='.$OAuthKey.'&limit='.$max);
  			} else {
  			$query->field("factual_id")->excludesAny($excludeIDs);
  			$query->within(new FactualCircle($lat, $lon, 5000));
  			//$content = @file_get_contents_curl('http://api.v3.factual.com/t/restaurants-us?geo={"$circle":{"$center":['.$lat.','.$lon.'],"$meters":'.$mile.'}}&KEY='.$OAuthKey.'&limit='.$max.'&filters={"factual_id":{"$excludes_any":['.$exclusion.']}}');
  			}

  		$res = $factual->fetch("restaurants-us", $query);
		$res = $res->getData();
		foreach ($res as $entity){
			
			if (!isset($res["name"]) || empty($res["name"])) {$name="NULL";} else {$name="'".$res["name"]."'";}
			if (!isset($res["address"]) || empty($res["address"])) {$address="NULL";} else {$address="'".$res["address"]."'";}
			
			
			$isshopthere = 0;
    		if (in_array($address." ".$name, $duplicatesarr)){
      			$isshopthere = 1;
    		}
    		if ($isshopthere == 0) {
    			if (!isset($res["accessible_wheelchair"]) || empty($res["accessible_wheelchair"])) {$accessible_wheelchair="NULL";} else {$accessible_wheelchair="'".$res["accessible_wheelchair"]."'";}
	    		if (!isset($res["meal_takeout"]) || empty($res["meal_takeout"])) {$meal_takeout="NULL";} else {$meal_takeout="'".$res["meal_takeout"]."'";}
				if (!isset($res["meal_lunch"]) || empty($res["meal_lunch"])) {$meal_lunch="NULL";} else {$meal_lunch="'".$res["meal_lunch"]."'";}
				if (!isset($res["meal_dinner"]) || empty($res["meal_dinner"])) {$meal_dinner="NULL";} else {$meal_dinner="'".$res["meal_dinner"]."'";}
				if (!isset($res["meal_deliver"]) || empty($res["meal_deliver"])) {$meal_deliver="NULL";} else {$meal_deliver="'".$res["meal_deliver"]."'";}
				if (!isset($res["meal_cater"]) || empty($res["meal_cater"])) {$meal_cater="NULL";} else {$meal_cater="'".$res["meal_cater"]."'";}
				if (!isset($res["meal_breakfast"]) || empty($res["meal_breakfast"])) {$meal_breakfast="NULL";} else {$meal_breakfast="'".$res["meal_breakfast"]."'";}
				if (!isset($res["longitude"]) || empty($res["longitude"])) {$longitude="NULL";} else {$longitude="'".$res["longitude"]."'";}
				if (!isset($res["latitude"]) || empty($res["latitude"])) {$latitude="NULL";} else {$latitude="'".$res["latitude"]."'";}
				if (!isset($res["kids_goodfor"]) || empty($res["kids_goodfor"])) {$kids_goodfor="NULL";} else {$kids_goodfor="'".$res["kids_goodfor"]."'";}
				if (!isset($res["hours_display"]) || empty($res["hours_display"])) {$hours_display="NULL";} else {$hours_display="'".$res["hours_display"]."'";}
				if (!isset($res["hours"]) || empty($res["hours"])) {$hours="NULL";} else {$hours="'".$res["hours"]."'";}
				if (!isset($res["fax"]) || empty($res["fax"])) {$fax="NULL";} else {$fax="'".$res["fax"]."'";}
				if (!isset($res["factual_id"]) || empty($res["factual_id"])) {$factual_id="NULL";} else {$factual_id="'".$res["factual_id"]."'";}
				if (!isset($res["email"]) || empty($res["email"])) {$email="NULL";} else {$email="'".$res["email"]."'";}
				if (!isset($res["cuisine"]) || empty($res["cuisine"])) {$cuisine="NULL";} else {$cuisine="'".$res["cuisine"]."'";}
				if (!isset($res["country"]) || empty($res["country"])) {$country="NULL";} else {$country="'".$res["country"]."'";}
				if (!isset($res["category_labels"]) || empty($res["category_labels"])) {$category_labels="NULL";} else {$category_labels="'".$res["category_labels"]."'";}
				if (!isset($res["category_ids"]) || empty($res["category_ids"])) {$category_ids="NULL";} else {$category_ids="'".$res["category_ids"]."'";}
				if (!isset($res["attire"]) || empty($res["attire"])) {$attire="NULL";} else {$attire="'".$res["attire"]."'";}
				if (!isset($res["alcohol_beer_wine"]) || empty($res["alcohol_beer_wine"])) {$alcohol_beer_wine="NULL";} else {$alcohol_beer_wine="'".$res["alcohol_beer_wine"]."'";}
				if (!isset($res["alcohol_beer"]) || empty($res["alcohol_beer"])) {$alcohol_beer="NULL";} else {$alcohol_beer="'".$res["alcohol_beer"]."'";}
				if (!isset($res["alcohol"]) || empty($res["alcohol"])) {$alcohol="NULL";} else {$alcohol="'".$res["alcohol"]."'";}	
				if (!isset($res["wifi"]) || empty($res["wifi"])) {$wifi="NULL";} else {$wifi="'".$res["wifi"]."'";}
				if (!isset($res["website"]) || empty($res["website"])) {$website="NULL";} else {$website="'".$res["website"]."'";}
				if (!isset($res["tel"]) || empty($res["tel"])) {$tel="NULL";} else {$tel="'".$res["tel"]."'";}
				if (!isset($res["smoking"]) || empty($res["smoking"])) {$smoking="NULL";} else {$smoking="'".$res["smoking"]."'";}
				if (!isset($res["seating_outdoor"]) || empty($res["seating_outdoor"])) {$seating_outdoor="NULL";} else {$seating_outdoor="'".$res["seating_outdoor"]."'";}
				if (!isset($res["reservations"]) || empty($res["reservations"])) {$reservations="NULL";} else {$reservations="'".$res["reservations"]."'";}
				if (!isset($res["region"]) || empty($res["region"])) {$region="NULL";} else {$region="'".$res["region"]."'";}
				if (!isset($res["rating"]) || empty($res["rating"])) {$rating="NULL";} else {$rating="'".$res["rating"]."'";}
				if (!isset($res["price"]) || empty($res["price"])) {$price="NULL";} else {$price="'".$res["price"]."'";}
				if (!isset($res["postcode"]) || empty($res["postcode"])) {$postcode="NULL";} else {$postcode="'".$res["postcode"]."'";}
				if (!isset($res["payment_cashonly"]) || empty($res["payment_cashonly"])) {$payment_cashonly="NULL";} else {$payment_cashonly="'".$res["payment_cashonly"]."'";}
				if (!isset($res["parking_street"]) || empty($res["parking_street"])) {$parking_street="NULL";} else {$parking_street="'".$res["parking_street"]."'";}
				if (!isset($res["parking_lot"]) || empty($res["parking_lot"])) {$parking_lot="NULL";} else {$parking_lot="'".$res["parking_lot"]."'";}
				if (!isset($res["parking"]) || empty($res["parking"])) {$parking="NULL";} else {$parking="'".$res["parking"]."'";}
				if (!isset($res["options_vegetarian"]) || empty($res["options_vegetarian"])) {$options_vegetarian="NULL";} else {$options_vegetarian="'".$res["options_vegetarian"]."'";}
				if (!isset($res["options_healthy"]) || empty($res["options_healthy"])) {$options_healthy="NULL";} else {$options_healthy="'".$res["options_healthy"]."'";}
				if (!isset($res["open_24hrs"]) || empty($res["open_24hrs"])) {$open_24hrs="NULL";} else {$open_24hrs="'".$res["open_24hrs"]."'";}
				if (!isset($res["neighborhood"]) || empty($res["neighborhood"])) {$neighborhood="NULL";} else {$neighborhood="'".$res["neighborhood"]."'";}



    			$sql = "INSERT INTO leads () VALUES ()";
    			mysql_query($sql);
    		}

    		}
  		} // end of zip search
    }

    /*
Order Of Operations:
	1. Consumer Creates Search
		-> Must Limit consumer search by IP/machine/mac address/tbd for only 30 searches PER day
	2. All filters pass through local database
		-> Must also check for total number of requests made for current month to not exceed API limit
	3. All results from local database not included in API search by factual ID
	4. API search cross-checks local database for new data & saves
	5. Both datasets are merged and displayed

Rules:
	Limited to 10,000 calls per day and 500 calls per minute
	(Daily/Burst) 10,000/500
	(Page/Rows) 50/500

Dataset Scheme:
	 "accessible_wheelchair":true,
	 "address":"1517 Lincoln Blvd”,
	 "alcohol":true,
	 "alcohol_bar":true,
	 "alcohol_beer_wine":true,
	 "attire":"casual”,
	 "category_ids":[353,358,363],
	 "category_labels":[["Social","Food and Dining","Restaurants","Delis”],["Social","Food and Dining","Restaurants","Italian”],["Social","Food and Dining","Restaurants","Pizza"]],
	 "country":"us”,
	 "cuisine":["Italian","Deli","Bakery","Sandwiches","Vegetarian”],
	 "email":"delirenie@aol.com”,
	 "factual_id":"133b597e-c0de-4465-97ed-5e88453e4bd9”,
	 "fax":"(310) 395-1575”,
	 "hours":{"tuesday":[["9:00","19:00"]],
	 "wednesday":[["9:00","19:00"]],
	 "thursday":[["9:00","19:00"]],
	 "friday":[["9:00","19:00"]],
	 "saturday":[["9:00","19:00"]],
	 "sunday":[["9:00","18:00"]]},
	 "hours_display":"Tue-Sat 9:00 AM-7:00 PM; Sun 9:00 AM-6:00 PM”,
	 "kids_goodfor":true,
	 "latitude":34.017865,
	 "locality":"Santa Monica”,
	 "longitude":-118.489238,
	 "meal_breakfast":true,
	 "meal_cater":true,
	 "meal_deliver":true,
	 "meal_dinner":true,
	 "meal_lunch":true,
	 "meal_takeout":true,
	 "name":"Bay Cities Italian Deli & Bakery”,
	 "neighborhood":["Montana","Westgate”],
	 "open_24hrs":false,
	 "options_healthy":true,
	 "options_vegetarian":true,
	 "parking":true,
	 "parking_lot":true,
	 "parking_street":true,
	 "payment_cashonly":false,
	 "postcode":"90401”,
	 "price":1,
	 "rating":4.5,
	 "region":"CA”,
	 "reservations":false,
	 "seating_outdoor":true,
	 "smoking":false,
	 "tel":"(424) 268-8242”,
	 "website":"http://www.baycitiesitaliandeli.com/“,
	 "wifi":false
    */

function searchAPI($criteria) {

//set global standard:
$factual = new Factual($key,$secret);	
$query = new FactualQuery;
$query->limit(50);


// execute
$res = $factual->fetch("restaurants-us", $query);
}




?>

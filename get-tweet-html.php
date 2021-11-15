<?php

// example of how to use the rapidapi static embedded tweet API with PHP

/*
	getTweetHtml($id, $rapidApiKey, $twitterBearerToken)
	uses the static embedded tweet API to convert a 
	tweet id into an html snippet (fast loading embedded tweet)
	
	input parameters
	$id - the tweet id
	$rapidApiKey - your rapidApiKey provided when you subscribe to an API plan
	$twitterBearerToken - your free twitter bearer token that you can aquire from twitter
	
	return values
	returns an html snippet (string) on success.  throws an exception on error
*/
function getTweetHtml($id, $rapidApiKey, $twitterBearerToken) {
	$curl = curl_init();
	curl_setopt_array($curl, [
		CURLOPT_URL => "https://static-embedded-tweets.p.rapidapi.com/1.0/get-tweet.php?id=".$id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => [
			"x-rapidapi-host: static-embedded-tweets.p.rapidapi.com",
			"x-rapidapi-key: ".$rapidApiKey,
			"x-twitter-bearer-token: ".$twitterBearerToken
		],
	]);
	$response = curl_exec($curl);
	$err = curl_error($curl);
	$httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
	curl_close($curl);
	if ($response === false) {
		throw new \Exception("cURL Error:".$err.", http response code:".$httpcode);
	} else {
		$responseDecoded = json_decode($response,true);
		if (is_null($responseDecoded)) {
			throw new \Exception("the static embedded tweets api returned null for tweetId:".$id.", http response code:".$httpcode);
		}
		if (array_key_exists("message", $responseDecoded) &&
			!array_key_exists("success", $responseDecoded)) {
			// rapidapi specific error occurred
			throw new \Exception("rapidapi error: ".$responseDecoded["message"]);
		}
		if (!array_key_exists("success", $responseDecoded) ||
			!array_key_exists("message", $responseDecoded) ||
			!array_key_exists("html", $responseDecoded)) {
			throw new \Exception("the static embedded tweets api returned an object that is missing a required name-value pair");
		}
		if ($responseDecoded["success"]) {
			// success
			return $responseDecoded["html"];
		} else {
			// static embedded tweets API error occurred (not rapidapi specific)
			throw new \Exception($responseDecoded["message"]);
		}
	}
}

/*
// example useage of the getTweetHtml function (currently commented out because it is only an example)
// remember to use your real values for the getTweetHtml function parameters
// the getTweetHtml function parameters shown in this example are just placeholder example values
try {
	// get the tweet html for the fast loading embedded tweet
	// insert the resulting $tweetHtml html snippet into your webpage html
	// or add an echo or print_r for the $tweetHtml if you just want to view the results when executing in a terminal
	$tweetHtml = getTweetHtml('440322224407314432',
							  '449a95d297c67xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx',
							  'AAAAAAAAAAAAAAAAAAAAAFnz2wAAAAAACOwLSPtVT5gxxxxxxxxxxxx');
} catch(\Exception $e) {
	// getTweetHtml() returned an exception because an error occurred
	// retrieve the error message.  Add your own code to display or log the error.
	$errorString = $e->getMessage(); // the error message
}
*/

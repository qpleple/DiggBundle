<?php
namespace Acme\DiggBundle\Utils;

class Fetcher
{
	public function facebookScoreCheck($url) 
	{
		// example : http://graph.facebook.com/?ids=http://google.fr/
		// we can retrieve multiple results, see http://graph.facebook.com/?ids=http://google.fr/,http://google.com
		// could be cool to update lots of links at the same time
	
		$facebookUrlAsk = "http://graph.facebook.com/?ids=" . $url->getAddress();

	    $jsonData = file_get_contents($facebookUrlAsk, 0, null, null);
	    $jsonAsArray = json_decode($jsonData, true);
	    $lastCounts = (integer) $jsonAsArray[$address]['shares']; 
		// surprisingly, here it's called 'shares' and not 'likes' 
		// although it's the number of likes
		
		if ($lastCounts != $url->getFacebookScore()) {
			$url->setFacebookScore($lastCounts);
			$url->updateTotalScore();
		}
	}
	
	public function twitterScoreCheck($url) 
	{
		// example : http://otter.topsy.com/stats.js?url=http://qpleple.com
		$twitterUrlAsk = "http://otter.topsy.com/stats.js?url=" . $url->getAddress();
		
		$jsonData = file_get_contents($twitterUrlAsk, 0, null, null);
		$jsonAsArray = json_decode($jsonData, true);
		$lastCounts = (integer) $jsonAsArray['response']['all'];
		
		if ($lastCounts != $url->getTwitterScore()) {
			$url->setTwitterScore($lastCounts);
			$url->updateTotalScore();
		}
	}

	public function googleScoreCheck($url) 
	{
		// see for ex http://www.tomanthony.co.uk/blog/google_plus_one_button_seo_count_api/comment-page-1/ for the method
		
		$ch = curl_init();   
	 	curl_setopt($ch, CURLOPT_URL, "https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ"); 
	 	curl_setopt($ch, CURLOPT_POST, 1);
	 	curl_setopt($ch, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url->getAddress() . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]');
	 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));

	 	$jsonData = curl_exec ($ch);
	 	curl_close ($ch);
	 	$jsonAsArray = json_decode($curl_results, true);

	 	$lastCounts = (integer) $jsonAsArray[0]['result']['metadata']['globalCounts']['count'];

		if($lastCounts != $url->getTwitterScore()) {
			$url->setGoogleScore($lastCounts);
			$url->updateTotalScore();
		}
	}
}
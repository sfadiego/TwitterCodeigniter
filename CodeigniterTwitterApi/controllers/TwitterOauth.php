<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//require_once('TwitterAPIExchange.php');
require(APPPATH.'libraries/TwitterAPIExchange.php');

class TwitterOauth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
	}
	public function index(){}

	public function getTweets()
	{	
		$settings = array('oauth_access_token' => "3232097156-DYy5e1AFL8lP4qSFsh1imauhIxKrvToquNNcxoA",
		    			  'oauth_access_token_secret' => "9Y6YAhdCOIBxsifFZdkGAq8nD86brmDjVCyjIueiJflNw",
		    			  'consumer_key' => "KNmfOg0SUWHrxe38KaF4VzNut",
		    			  'consumer_secret' => "IvepjQ3alMML2RMRSMrFZbXG4Pmnu1JL1DScnepLIG7tMGWK5I");

		$url='https://api.twitter.com/1.1/statuses/user_timeline.json';
		$getfield='?count=50';
		$requestMethod ="GET";
		$twitter = new TwitterAPIExchange($settings);
		$json = json_decode($twitter->setGetfield($getfield)->buildOauth($url,$requestMethod)->performRequest(),$assoc = TRUE);
		
		if(isset($json["errors"][0]["message"])) {
			echo "<h3>Error, Ha ocurrido un problema.</h3>
					<p>Twitter regresa el siguiente mensaje de error:</p>
					<p><em>".$json['errors'][0]["message"]."</em></p>";
			
		}else{
			foreach ($json as $items) {
				$this->output->set_content_type('application/json')->set_output(json_encode(array('data'=>$items)));
				//echo "<img src=".$items['user']['profile_image_url']."></img></a>";
				//echo "Time and Date of Tweet: ".$items['created_at']."<br />";
		        //echo "Tweeted by: ". $items['user']['name']."<br />";
		        //echo "Tweet: ". $items['text']."<br />";
		        //echo "Screen name: ". $items['user']['screen_name']."<br />";
		        
			}
		}
	}
}
/* End of file TwitterOauth.php */
/* Location: ./application/controllers/TwitterOauth.php */
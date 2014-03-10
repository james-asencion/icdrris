<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Codeigniter-Twitter-Search-Library
 *
 * Search for tweets using search/streaming api
 *
 * by Elliott Landsborough - github.com/ElliottLandsborough
 */
class Twitterlib {

	var $terms;

	public function __construct()
	{
		ini_set('precision', 20); // http://stackoverflow.com/a/8106127/908257
		$this->CI = & get_instance();
		//$this->terms = $this->searchterms();
		$this->terms = "TeamDasig";
	}

	/**
	* Get all of the search terms from the db and return them in an array
	* output: array or false
    */
public function searchterms($result=false)
	{
		$this->CI->db->select('term');
		$query = $this->CI->db->get('search_terms');
		if ( $query->num_rows() > 0 )
		{
			$result = $query->result_array();
			foreach ($result as $row=>$data)
			{
				$result[$row]=$data['term'];
			}
		}
		return $result;
	}

	/**
	* Stream the tweets via streaming api (can be run at the same time as search)
	*
	* Designed to be run via cron, this function does not automatically
	* restart after a tweet has been found. I would recommend doing it
	* once a minute but I've got away with anything up to once every
	* two seceonds without being rate limited before.
	*
	*/
	public function stream()
	{
		// get user/pass from config/twitter.php
		$this->CI->config->load('twitter');
		$user = $this->CI->config->item('user');
		$pass = $this->CI->config->item('pass');
		// check if user and pass are set
		if( !isset($user) || !isset($pass) || !$user || !$pass )
		{
			echo 'ERROR: Username or password not found.'.PHP_EOL;
		}
		else
		{
			// start an infinite loop for reconnection attempts
			while(1)
			{
				$fp = fsockopen("ssl://stream.twitter.com", 443, $errno, $errstr, 100); // has to be ssl
				if(!$fp)
				{
					echo $errstr.'('.$errno.')'.PHP_EOL;
				}
				else
				{
					// build request
					$trackstring=implode(',',$this->terms);
					$query_data = array('track' => $trackstring,'include_entities' => 'true');
					$request = "GET /1/statuses/filter.json?" . http_build_query($query_data) . " HTTP/1.1\r\n";
					$request .= "Host: stream.twitter.com\r\n";
					$request .= "Authorization: Basic " . base64_encode($user . ':' . $pass) . "\r\n\r\n";
					// write request
					fwrite($fp, $request);
					// set stream to non-blocking - research if this is really needed.
					// stream_set_blocking($fp, 0);
					while(!feof($fp))
					{

						$read   = array($fp);
						$write  = null;
						$except = null;

						// Select, wait up to 10 minutes for a tweet.
						// If no tweet, reconnect by retsarting loop.
						$res = stream_select($read, $write, $except, 600, 0);
						if ( ($res == false) || ($res == 0) )
						{
							break;
						}

						$json = fgets($fp);
						$data = json_decode($json, true);
						if($data)
						{
							$this->process($data);
						}
					}
					fclose($fp);
					// sleep for ten seconds before reconnecting
					sleep(10);
				}
			}
		}
	}
	/**
	* Search the tweets via search feed (can be run at the same time as stream).
	*
	* Designed to be run though something like nohup, this function loops
	* continuously and only dies when ma nually closed. A better solution would
	* be to use something like node to parse the streaming api and save it into
	* mySQL but this was made for people who absolutely have to use PHP.
	*
	*/
/**	public function search($cachetime=null)
	{
		// if the number of minutes to cache has been set
		if($cachetime != null)
		{
			// load the memcache adapter
			$this->CI->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));
		}
		// if we are not caching or if our cache has run out
		if( $cachetime == null || ! $content = $this->CI->cache->get('twitter-api-search') )
		{
			$query=implode('+OR+',$this->terms);
			$query_data = array('q' => $query, 'result_type' => 'recent', 'include_entities' => 'true','rpp' => 100,'result_type'=>'mixed');
			$url = 'http://search.twitter.com/search.json?'.http_build_query($query_data);
			$ch = curl_init();
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			$content = curl_exec($ch);
			curl_close($ch);
			$content = json_decode($content,true);
			// if we want to cache for an amount of time
			if($cachetime != null)
			{
				// cache the results
				$this->CI->cache->save('twitter-api-search', $content, $cachetime*60);
			}
		}
		// if we have new results
		if(isset($content))
		{
			if(empty($content))
			{
				echo 'ERROR: No data was returned'.PHP_EOL;
			}
			else if(isset($content['error']))
			{
				echo 'ERROR: '.$content['error'].PHP_EOL;
			}
			else if(isset($content['results']))
			{ // and if there were no errors
				if(count($content['results'])>0)
				{
					foreach ($content['results'] as $result)
					{
						// process each tweet one at a time
						$this->process($result);
					}
				}
			}
		}
	}
*/
	/**
	* Search the tweets via search feed on 1.1 api (can be run at the same time as stream).
	*
	* Designed to be run though something like nohup, this function loops
	* continuously and only dies when ma nually closed. A better solution would
	* be to use something like node to parse the streaming api and save it into
	* mySQL but this was made for people who absolutely have to use PHP.
	*
	*/
	public function searchone($cachetime=null)
	{
		// do oauth
		$this->CI->load->library('twitteroauth');
		// get user/pass from config/twitter.php
		$this->CI->config->load('twitter');
		$consumer_token = $this->CI->config->item('consumer_token');
		$consumer_secret = $this->CI->config->item('consumer_secret');
		$access_token = $this->CI->config->item('access_token');
		$access_secret = $this->CI->config->item('access_secret');
		$connection = $this->CI->twitteroauth->create($consumer_token, $consumer_secret, $access_token, $access_secret);
		$content = $connection->get('account/verify_credentials');
		if(isset($content->errors))
		{
			foreach ($content->errors as $error)
			{
				echo $error->code.' '.$error->message.PHP_EOL;
			}
			die;
		}
		else
		{
			// if the number of minutes to cache has been set
			if($cachetime != null)
			{
				// load the memcache adapter
				$this->CI->load->driver('cache', array('adapter' => 'memcached', 'backup' => 'file'));
			}
			// if we are not caching or if our cache has run out
			if( $cachetime == null || ! $content = $this->CI->cache->get('twitter-api-search') )
			{
				//$query=implode('+OR+',$this->terms);
				$query= "TeamDasig";
				$query_data = array('q' => $query, 'result_type' => 'recent', 'include_entities' => 'true','rpp' => 1,'result_type'=>'mixed');
				$url = 'https://api.twitter.com/1.1/search/tweets.json';
				$content=$connection->get($url,$query_data);
				// if we want to cache for an amount of time
				if($cachetime != null)
				{
					// cache the results
					$this->CI->cache->save('twitter-api-search', $content, $cachetime*60);
				}
			}
			// if we have new results
			if(isset($content))
			{
				if(isset($content->errors))
				{
					foreach ($content->errors as $error)
					{
						echo $error->code.' '.$error->message.PHP_EOL;
					}
					die;
				}
				if (isset($content->statuses))
				{
					foreach ($content->statuses as $tweet)
					{
						// process each tweet one at a time
						$this->process($tweet);
					}
				}
			}
		}
	}

	/**
	* Process the tweet data and record it in mysql.
	* Input: $data (array - output from api)
	*/
	public function process($data=null)
	{
		// if the tweet has an id, if the tweet does not already exist in db, if there is at least one hashtag
		if( ( ( is_array($data) && isset($data['id_str']) ) || ( is_object($data) && isset($data->id_str) ) ) && !$this->exists($data) )
		{
			if($this->save($data))
			{
			
				echo 'Created at: '.$data->created_at.', ID Str: '.$data->id_str.', Tweet: '.$data->text.', Source: '.$data->source.', userid: '.$data->user->id_str.', username: '.$data->user->name.', geo-enabled: '.$data->user->geo_enabled.'<br />'.PHP_EOL;
				if($data->geo != null){
					echo ' Geo-type: '.$data->geo->type.', Geo-lat: '.$data->geo->coordinates[0].', Geo-lng: '.$data->geo->coordinates[1].'';
					if($data->place != null){
						echo ', Place Name: '.$data->place->full_name;
					}
					echo '<br />';
				}
				echo '<br />';
			}
		}
	}

	/**
	* Find out if the tweet has already been inserted into the db
	* input: $data (array) - array from api - needs to contain $data['id_str']
	* output: true/false
	*/
	function exists($data=null,$result=false)
	{
		if( ( is_array($data) && isset($data['id_str']) ) || ( is_object($data) && isset($data->id_str) ) )
		{
			$this->CI->db->select('tweet_id');
			if(is_array($data))
			{
				$tweet_id=$data['id_str'];
			}
			else
			{
				$tweet_id=$data->id_str;
			}
			$this->CI->db->where('tweet_id',$tweet_id);
			$query=$this->CI->db->get('item_requests',1,0);
			if($query->num_rows()>0)
			{
				$result=true;
			}
		}
		return $result;
	}

	/** NEEDED
	* Save the tweet in MySQL.
	* input: $data - array of a tweet returned from the twitter api
	* input: $data['id_str'], $data['user']['id_str'] OR data['id_str'], $data['from_user_id_str']
	* output: true/false
	*/
	function save($data=null,$result=false)
	{
		// if we have a tweet with an ID
		if ( (is_array($data) && isset($data['id_str']) ) || ( is_object($data) && isset($data->id_str) ) )
		{
			if( is_array($data) && isset($data['user']['id_str']) )
			{ // if we are dealing with streaming api
				$user_id=$data['user']['id_str'];
				$tweet_id=$data['id_str'];
			}
			else if ( is_array($data) && isset($data['from_user_id_str']) )
			{ // if we are dealing with search api
				$user_id=$data['from_user_id_str'];
				$tweet_id=$data['id_str'];
			}
			else if ( is_object($data) && isset($data->user->id_str) )
			{
				$user_id=$data->user->id_str;
				$user_screen_name=$data->user->screen_name;
				$tweet_id=$data->id_str;
				$tweet_created_at=date('Y-m-d', strtotime($data->created_at));
				$tweet_text=$data->text;
				$tweet_url= "https://twitter.com/".$user_screen_name."/status/".$tweet_id."";
				$geo_lat= null;
				$geo_lng= null;
				$geo_place_name= null;
				if($data->geo != null && $data->geo->type == "Point"){
					$geo_lat=$data->geo->coordinates[0];
					$geo_lng=$data->geo->coordinates[1];
					if($data->place !=null){
						$geo_place_name=$data->place->full_name;
					}
				}

			}
			// if we have detected a user id in the tweet array
			if( isset($user_id) )
			{
				// set input
				$input=array('geo_lat'=> $geo_lat, 'geo_lng'=>$geo_lng, 'geo_place_name'=> $geo_place_name, 'request_url' => $tweet_url, 'tweet_id' =>  $tweet_id, 'request_date	' => $tweet_created_at,'tweet_user_id' => $user_id, 'request_info_source' => $user_screen_name, 'request_comments' => $tweet_text);
				// save tweet in db
				$result=$this->CI->db->insert('item_requests',$input);
			}
		}
		return $result;
	}

}

/* End of file twitterlib.php */
<?php
class modinstagramPhp{

    /*
     * Attributes
     */
    private $username, //Instagram username
            $access_token, //Your access token
            $userid; //Instagram userid

    /*
     * Constructor
     */
    function __construct($username='',$access_token='') {
        if(empty($username) || empty($access_token)){
            $this->error('empty username or access token');
        } else {
            $this->username=$username;
            $this->access_token = $access_token;
        }
    }

    /*
     * The api works mostly with user ids, but it's easier for users to use their username.
     * This function gets the userid corresponding to the username
     */
    public function getUserIDFromUserName(){
        if(strlen($this->username)>0 && strlen($this->access_token)>0){
            //Search for the username
            $useridquery = $this->queryInstagram('https://api.instagram.com/v1/users/search?q='.$this->username.'&access_token='.$this->access_token);
            if(!empty($useridquery) && $useridquery->meta->code=='200' && @$useridquery->data[0]->id>0){
                //Found
                $this->userid=$useridquery->data[0]->id;
            } else {
                //Not found
//                $this->error('getUserIDFromUserName');
            }
        } else {
//             $this->error('empty username or access token');
        }
    }

    /*
     * Get the most recent media published by a user.
     * you can use the $args array to pass the attributes that are used by the GET/users/user-id/media/recent method
     */
    public function getUserMedia($args=array()){
        if($this->userid<=0){
            //If no user id, get user id
            $this->getUserIDFromUserName();
        }
        if($this->userid>0 && strlen($this->access_token)>0){
            $qs='';
            if(!empty($args)){ $qs = '&'.http_build_query($args); } //Adds query string if any args are specified
            $shots = $this->queryInstagram('https://api.instagram.com/v1/users/'.(int)$this->userid.'/media/recent?access_token='.$this->access_token.$qs); //Get shots
            if($shots->meta->code=='200'){
                return $shots;
            } else {
                $this->error('getUserMedia');
            }
        } else {
//            $this->error('empty username or access token');
        }
    }

    /*
     * Method that simply displays the shots in a ul.
     * Used for simplicity and demo purposes
     * You should probably move the markup out of this class to use it directly in your page markup
     */
    public function simpleDisplay($shots){
	global $instagram_master_size;
	global $instagram_master_pad;
	global $instagram_master_color;
        $simpleDisplay = '';
        if(!empty($shots->data)){
            $simpleDisplay.='';
                foreach($shots->data as $istg){
                    //The image
                    @$istg_thumbnail = $istg->{'images'}->{'thumbnail'}->{'url'}; //Thumbnail
                    //If you want to display another size, you can use 'low_resolution', or 'standard_resolution' in place of 'thumbnail'

                    //The link
                    @$istg_link = $istg->{'link'}; //Link to the picture's instagram page, to link to the picture image only, use $istg->{'images'}->{'standard_resolution'}->{'url'}

                    //The caption
                    @$istg_caption = $istg->{'caption'}->{'text'};

                    //The markup
                    @$simpleDisplay.='<div style="padding:'.$instagram_master_pad.'px; background-color:#'.$instagram_master_color.'; float: left;"><a class="instalink" href="'.$istg_link.'" target="_blank"><img src="'.$istg_thumbnail.'" alt="'.$istg_caption.'" title="'.$istg_caption.'" width="'.$instagram_master_size.'" height="'.$instagram_master_size.'" /></a></div>';
                }
            $simpleDisplay.='';
        } else {
            $this->error('simpleDisplay');
        }
        return $simpleDisplay;
    }

    /*
     * Common mechanism to query the instagram api
     */
	public function queryInstagram($url){
	//prepare caching
	$cachekey = md5($url);

	//MultiSite
	if(is_multisite()){
	if(!get_site_transient('instagram_' . $cachekey)){
	//Request
	$request='error';
	if(!extension_loaded('openssl')){
		$request = 'This class requires the php extension open_ssl to work as the instagram api works with httpS.';
		}
	else {
		$request_link = set_site_transient('instagram_link_'.$cachekey, $url, 60*1);
		$curl = curl_init(get_site_transient('instagram_link_'.$cachekey, $url));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$request = curl_exec($curl);
		curl_close($curl);
		}

		set_site_transient( 'instagram_' . $cachekey, $request, 60*1);
	}
	//Execute and return query
	$query = json_decode(get_site_transient('instagram_' . $cachekey));
	return $query;
	}
	else{
	//SingleSite
	if(!get_transient('instagram_' . $cachekey)){
	//Request
	$request='error';
	if(!extension_loaded('openssl')){
		$request = 'This class requires the php extension open_ssl to work as the instagram api works with httpS.';
		}
	else {
		$request_link = set_transient('instagram_link_'.$cachekey, $url, 60*1);
		$curl = curl_init(get_transient('instagram_link_'.$cachekey, $url));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		$request = curl_exec($curl);
		curl_close($curl);
		}

		set_transient( 'instagram_' . $cachekey, $request, 60*1);
	}
	//Execute and return query
	$query = json_decode(get_transient('instagram_' . $cachekey));
	return $query;
	}
	}

/*
* Error
*/
	public function error($src=''){
	echo '/!\ error '.$src.'. ';
	}

}
?>
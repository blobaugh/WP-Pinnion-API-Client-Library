<?php
/**
 * This object talkes to the Pinnion  API. Results are all JSON
 *
 * @author Ben Lobaugh <ben@lobaugh.net>
 * @license Nothing yet
 * @uses PinnionApiResponse
 */
class PinnionApiRequest {
    
    /**
     * Username for HTTP Basic auth for API
     * @var String 
     */
    private $mApiUser;
    
    /**
     * Password for HTTP Basic auth for API
     * @var type 
     */
    private $mApiPass;

    /**
     * Sets up the Pinnion API Request object authentication parameters
     * 
     * @param String $ApiUser
     * @param String $ApiPass 
     */
    public function __construct($ApiUser, $ApiPass) {
        $this->mApiUser = $ApiUser;
        $this->mApiPass = $ApiPass;
    }

    /**
     * Performs the GET query against the specified endpoint
     *
     * @throws PinnionBadRequestException
     * @throws PinnionUnauthorizedRequestException
     * @throws PinnionInternalServerErrorException
     * @param String $Url - Endpoint with URL paramters (for now)
     * @return PinnionApiResponse
     */
    public function get( $Url ) {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,     // return web page
         //   CURLOPT_HEADER         => true,    // don't return headers
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_USERAGENT      => "Pinnion API client for PHP", // who am i
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
            CURLOPT_SSL_VERIFYHOST => '0',
            CURLOPT_SSL_VERIFYHOST => '0',
        );

        $ch      = curl_init( $Url );
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_USERPWD, $this->mApiUser . ":" . $this->mApiPass);
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
	$header = array();
        $header['http_code']  = curl_getinfo( $ch, CURLINFO_HTTP_CODE );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        //die(print_r($header));
        
        $response = new PinnionApiResponse();
        $response->setHttpCode( $header['http_code'] );
        $response->setResponse( $header['content'] );
        
        if( $response->getHttpCode() == '400' ) {
            // 400 Bad request when there was a problem with the request
            throw new PinnionBadRequestException($Url, $response);
        } else if ( $response->getHttpCode() == '401' ) {
            // 401 Unauthorized when you don't provide a valid key
            throw new PinnionUnauthorizedRequestException();
        } else if ( $response->getHttpCode() == '500' ) {
            // 500 Internal Server Error
            throw new PinnionInternalServerErrorException();
        }
        return $response;
    }
    
    public function post() {        
        throw new Exception( 'POST method not yet implemented' );
    }
    public function put() {        
        throw new Exception( 'PUT method not yet implemented' );
    }
    public function head() {        
        throw new Exception( 'HEAD method not yet implemented' );
    }
    public function delete() {        
        throw new Exception( 'DELETE method not yet implemented' );
    }

} // end class

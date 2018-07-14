<?php
namespace Core\Libraries\Services\Curl;

use Core\Kernel\ServiceAbstract;

class CurlPhp extends ServiceAbstract
{
    /** @var resource cURL handle */
    private $ch;
    /** @var mixed The response */
    private $response = false;
   
    
    /**
     * Get the response
     * @return string
     * @throws \RuntimeException On cURL error
     */
   
     /**
     * @param string $url
     * @param array  $options
     */
    
    public function post($url, array $fields = array())
    {
        $logger = $this->getService('logger');
        
        $this->ch = curl_init($url);
        $headers = $this->_getHeaders();
        
        // $fields_string = '';
        // foreach ($fields as $key => $value) {$fields_string .= $key . '=' . $value . '&';}
        // rtrim($fields_string, '&');
        
        $fields_string = http_build_query( $fields );
        
        $logger->info("CurlPhp::post", [$url,$fields_string]);

        // var_dump($fields_string);die;
        curl_setopt($this->ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->ch, CURLOPT_POST,count($fields));
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_POSTFIELDS, $fields_string);
        $response = curl_exec($this->ch);
        $logger->info("CurlPhp::response", [$response]);
        
        $error = curl_error($this->ch);
        $errno = curl_errno($this->ch);
        if (is_resource($this->ch)) {
            curl_close($this->ch);
        }
        if (0 !== $errno) {
        $logger->info("CurlPhp::error", [$response]);

            throw new \RuntimeException($error, $errno);
        }
        return json_decode($response,1);
    }
    /**
     * Let echo out the response
     * @return string
     */
    public function __toString()
    {
        return $this->getResponse();
    }
    function _getHeaders(){
        $User_Agent = 'Mozilla/3.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31';
        $request_headers = array();
        $request_headers[] = 'User-Agent: ' . $User_Agent;
        return $request_headers;
    }
}
// // usage
// $curl = new \MyApp\Http\Curl('http://testphp.local', array(
//     CURLOPT_POSTFIELDS => array('username' => 'user1'),
// ));
// try {
//     echo $curl;
// } catch (\RuntimeException $ex) {
//     die(sprintf('Http error %s with code %d', $ex->getMessage(), $ex->getCode()));
// }
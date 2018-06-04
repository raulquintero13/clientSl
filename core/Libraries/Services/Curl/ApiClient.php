<?php
namespace Core\Libraries\Services\Curl;

class ApiClient
{


    public function post($fields){


        //extract data from the post
        //set POST variables
        $url = 'http://domain.com/get-post.php';
        $fields = array(
            'username' => urlencode($fields['username']),
            'password' => urlencode($_POST['password']),
        );

        //url-ify the data for the POST
        foreach ($fields as $key => $value) {$fields_string .= $key . '=' . $value . '&';}
        rtrim($fields_string, '&');

        // var_dump( $fields_string);

        // echo $this->_send($fields, $fields_string);
        
        die;
    }
    
    private function _send($fields, $field_string){
        
        $url = "http://clientsl.local/api/auth";
        //open connection
        $ch = curl_init();
        $headers = $this->_getHeaders();
        
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // Disable SSL verification
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // Will return the response, if false it print the response
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        //execute post
        echo $result = curl_exec($ch);

        //close connection
        curl_close($ch);

        // echo "hola";die;
        return $result;

    }

    function _getHeaders(){
        $User_Agent = 'Mozilla/3.0 (X11; Linux i686) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31';

        $request_headers = array();
        $request_headers[] = 'User-Agent: ' . $User_Agent;

        return $request_headers;
    }


}
<?php
namespace Core\Libraries\Servcices\Encryption;


class Mcrypt
{
    var $skey = "S2=YUYdtyo5^$5rJs?>x889%t!R/X1<o"; // change this size 16,24,32
    private $encryptEnabled = null;

    public function __construct($settings)
    {
        $this->encryptEnabled = $settings['encryptEnabled']; 
    }
    public function safe_b64encode($string)
    {
        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }
    public function safe_b64decode($string)
    {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }
    public function encode($value)
    {   
        
        if (!$this->encryptionEnabled) {
            return json_encode($value);
        }
        if (!$value) {
            return false;
        }
        $text = json_encode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext));
    }
    public function decode($value)
    {
        if (!$this->encryptionEnabled) {
            return json_decode($value,1);
        }
        if (!$value) {
            return false;
        }
        $crypttext = $this->safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return json_decode(trim($decrypttext),1);
    }
}

// // Sample Call:
// $str = "myPassword";
// $converter = new Mcrypt;
// $encoded = $converter->encode($str );
// $decoded = $converter->decode($encoded);    
// echo "$str<p>$encoded<p>$decoded";

?>
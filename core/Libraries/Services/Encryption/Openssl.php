<?php
namespace Core\Libraries\Services\Encryption;

class Openssl
{
    private $passphrase = null;
    private $privateKey = null;
    private $publicKey = null;

    public function __construct($keys)
    {
        $this->privateKey = $keys['openssl']['private'];
        $this->publicKey = $keys['openssl']['public'];
        $this->set_private_key(file_get_contents($this->privateKey));
        $this->set_public_key(file_get_contents($this->publicKey));
        
        
        $this->set_passphrase('random');
    }

    public function encode($unencrypted_data)
    {
        

        if (empty($this->public_key)) {
            throw new \Exception('Please set the public key before attempting encryption.');
        }

        $unencrypted_data = (json_encode($unencrypted_data));
        $public_key = openssl_pkey_get_public($this->public_key);
        if (!$public_key) {
            throw new \Exception('Please set a valid public key before attempting encryption.');
        }
        // $unencrypted_data = 'los camarone se mueven de nuevo';
        $keyData = openssl_pkey_get_details($public_key);
        // var_dump($keyData);
        return $this->ssl_encrypt($unencrypted_data, 'public', $keyData['key']);
        // openssl_public_encrypt($unencrypted_data, $encrypted_data, $keyData);
        // return ($encrypted_data);
    }

    public function decode($encrypted_data)
    {
        

        $encrypted_data = base64_decode(str_replace(array('*'), array('+'), $encrypted_data));

        if (empty($this->private_key)) {
            throw new \Exception('Please set the private key before attempting decryption.');
        }

        $private_key = openssl_pkey_get_private($this->private_key, $this->passphrase);
        if (!$private_key) {
            throw new \Exception('Please set a valid private key before attempting decryption.');
        }

        return ($this->ssl_decrypt($encrypted_data, 'private', $private_key));
    }


    function ssl_encrypt($source, $type, $key)
    {
    //Assumes 1024 bit key and encrypts in chunks.

        $maxlength = 117;
        $output = '';
        while ($source) {
            $input = substr($source, 0, $maxlength);
            $source = substr($source, $maxlength);
            if ($type == 'private') {
                $ok = openssl_private_encrypt($input, $encrypted, $key);
            } else {
                $ok = openssl_public_encrypt($input, $encrypted, $key);
            }

            $output .= $encrypted;
        }
        return str_replace(array('+'), array('*'), base64_encode($output));
    }

    function ssl_decrypt($source, $type, $key)
    {
        // The raw PHP decryption functions appear to work
        // on 128 Byte chunks. So this decrypts long text
        // encrypted with ssl_encrypt().

        $maxlength = 128;
        $output = '';
        while ($source) {
            $input = substr($source, 0, $maxlength);
            $source = substr($source, $maxlength);
            if ($type == 'private') {
                $ok = openssl_private_decrypt($input, $out, $key);
            } else {
                $ok = openssl_public_decrypt($input, $out, $key);
            }
            
            $output .= $out;
        }
        return json_decode($out,1);

    }

    
    public function set_passphrase($passphrase)
    {
        $this->passphrase = trim($passphrase);
        return ($this);
    }
    public function set_private_key($private_key)
    {
        $this->private_key = trim($private_key);
        return ($this);
    }
    public function set_public_key($public_key)
    {
        $this->public_key = trim($public_key);
        return ($this);
    }
    public function get_private_key()
    {
        return ($this->private_key);
    }
    public function get_public_key()
    {
        return ($this->public_key);
    }


    public function generateKeys() {
        echo "<pre>";
        // Create the keypair
        $res = openssl_pkey_new();

        // Get private key
        openssl_pkey_export($res, $privkey, "PassPhrase number 1");

        // Get public key
        $pubkey = openssl_pkey_get_details($res);
        $pubkey = $pubkey["key"];
        // var_dump($privkey);
        // var_dump($pubkey);

        // Create the keypair
        $res2 = openssl_pkey_new();

        // Get private key
        openssl_pkey_export($res2, $privkey2, "This is a passPhrase *µà");

        // Get public key
        $pubkey2 = openssl_pkey_get_details($res2);
        $pubkey2 = $pubkey2["key"];
        var_dump($privkey2);
        var_dump($pubkey2);

        $data = "Only I know the purple fox. Trala la !";

        openssl_seal($data, $sealed, $ekeys, array($pubkey, $pubkey2));

        var_dump("sealed");
        var_dump(base64_encode($sealed));
        var_dump(base64_encode($ekeys[0]));
        var_dump(base64_encode($ekeys[1]));

        // decrypt the data and store it in $open
        if (openssl_open($sealed, $open, $ekeys[1], openssl_pkey_get_private($privkey2, "This is a passPhrase *µà"))) {
            echo "here is the opened data: ", $open;
        } else {
            echo "failed to open data";
        }


    }




}



// But the process I followed for all this was :
//     Generate private key :
//     openssl genrsa - des3 - out id_dsa 1024

//     Generate public key :
//     openssl rsa - in id_dsa - out id_dsa.pub - outform PEM - pubout
<?php

return [
    'encryptionEnabled' => false,
    'method' => 'openssl',      //  'openssl' or 'mcrypt'
    'openssl' => [
        'private' => 'http://clientsl.local/private.rsa',
        'public' => 'http://clientsl.local/public.rsa'
    ],
    'mcrypt' => [
    ],


];

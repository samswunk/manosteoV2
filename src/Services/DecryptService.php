<?php 

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Nzo\UrlEncryptorBundle\Encryptor\Encryptor;

class DecryptService extends AbstractController
{
    protected $encryptor;
    public function __construct(Encryptor $encryptor)
    {
        $this->encryptor = $encryptor;
    }

    public function newKey()
    {
        $key_size = 16; // 256 bits
        $encryption_key = hex2bin(openssl_random_pseudo_bytes($key_size, $strong));
        dd($encryption_key);
    }

    public function decrypt($data)
    {
        $enc_name = $this->encryptor->decrypt($data);
        return $enc_name;
    }

    public function encrypt($data)
    {
        $enc_name = $this->encryptor->encrypt($data);
        return $enc_name;
    }
}
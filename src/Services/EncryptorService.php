<?php 

namespace App\Services;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EncryptorService extends AbstractController
{

    /**
     * Holds the Encryptor instance
     * @var Encryptor
     */
    private static $instance;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $key;

    /**
     * @var string
     */
    private $separator;

    /**
     * Encryptor constructor.
     */
    private function __construct()
    {
        $this->method = $this->getParameter('nzo_encryptor.cipher_algorithm');
        $this->key = $this->getParameter('nzo_encryptor.secret_key');
        $this->separator = ':';
    }

    private function __clone()
    {
    }

    /**
     * Generates the initialization vector
     * @return string
     */
    private function getIv()
    {
        return openssl_random_pseudo_bytes(openssl_cipher_iv_length($this->method));
    }

    /**
     * @param string $data
     * @return string
     */
    public function encrypt($data)
    {
        $iv = $this->getIv();
        return base64_encode(openssl_encrypt($data, $this->method, $this->key, 0, $iv) . $this->separator . base64_encode($iv));
    }

    /**
     * @param string $dataAndVector
     * @return string
     */
    public function decrypt($dataAndVector)
    {
        $parts = explode($this->separator, base64_decode($dataAndVector));
        // $parts[0] = encrypted data
        // $parts[1] = initialization vector
        return openssl_decrypt($parts[0], $this->method, $this->key, 0, base64_decode($parts[1]));
    }

    public function autre_method()
    {
            // Set the method
            $method = 'AES-128-CBC';

            // Set the encryption key
            $encryption_key = 'myencryptionkey';

            // Generet a random initialisation vector
            $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));

            // Define the date to be encrypted
            $data = "Encrypt me, please!";

            var_dump("Before encryption: $data");

            // Encrypt the data
            $encrypted = openssl_encrypt($data, $method, $encryption_key, 0, $iv);

            var_dump("Encrypted: ${encrypted}");

            // Append the vector at the end of the encrypted string
            $encrypted = $encrypted . ':' . $iv;

            // Explode the string using the `:` separator.
            $parts = explode(':', $encrypted);

            // Decrypt the data
            $decrypted = openssl_decrypt($parts[0], $method, $encryption_key, 0, $parts[1]);

            var_dump("Decrypted: ${decrypted}");        
    }
}
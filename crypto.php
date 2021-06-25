<?php 
    
    function encryption($plaintext){
     
        $encryption_key = base64_decode("khasdkjhsd&&&123213SKJDHAKD");
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("aes-256-cbc")); 
        $encrypted_data = openssl_encrypt($plaintext, "aes-256-cbc", $encryption_key, 0, $iv); 

        return base64_encode($encrypted_data.'::'.$iv);
    }

    function decryption($ciphertext){
      
        $encryption_key = base64_decode("khasdkjhsd&&&123213SKJDHAKD");
        list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($ciphertext), 2), 2, NULL);
        return openssl_decrypt($encrypted_data, "aes-256-cbc", $encryption_key, 0, $iv); 
    }

    function createHash($plaintext){
        return hash('sha256', $plaintext.'secureprogramming');
    }

?>
<?php
    //Sanitizing Functions
    function mysql_entities_fix_string($conn, $string){
        return htmlentities(mysql_fix_string($conn, $string));
    }
    function mysql_fix_string($conn, $string){
        if (get_magic_quotes_gpc()) $string = stripslashes($string);

        $string = str_replace("\n", "", $string);

        return $conn->real_escape_string($string);
    }

    //Destroy Session and Data
    function destroy_session_and_data() {
        $_SESSION = array();
        setcookie(session_name(), '', time() - 2592000, '/');
        session_destroy();
    }

    //Cipher to encrypt and decypt
    function cipher($plaintext, $key, $action = 'e' ) {
        $output = false;
        $cipher = "aes-128-gcm";

        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        if($action == 'e'){
            $output = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
        }
        else{
            $output = openssl_decrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
        }
     
        return $output;
    }
?>
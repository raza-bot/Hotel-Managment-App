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
?>
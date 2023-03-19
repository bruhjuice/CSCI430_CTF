<?php

    function logInfo($log_type, $message) {
        $error_string = "";
        if(session_id() != "") {
            $error_string = $error_string . "[SessionId " . session_id() . "] ";
        }
        $error_string = $error_string . $log_type . " " . $message;
        error_log($error_string);
    }

?>
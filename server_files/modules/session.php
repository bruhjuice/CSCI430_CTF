<?php
    function startSession() {
        if(session_id() == "") {
            //indicating hash function to session ID - sha512
            ini_set('session.hash_function', 'sha512');
            session_start();
        }
    }

    function endSession() {
        startSession();

        // Code from: https://www.php.net/manual/en/function.session-destroy.php
        // Unset all of the session variables.
        $_SESSION = array();

        // If it's desired to kill the session, also delete the session cookie.
        // Note: This will destroy the session, and not just the session data!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Finally, destroy the session.
        session_unset();
        session_destroy();
    }
?>
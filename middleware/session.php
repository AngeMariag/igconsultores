<?php
$sesion_expired = function ($request, $response, $next) {
    $expireAfter = 30;

    //Check to see if our "last action" session
    //variable has been set.
    $response = $next($request, $response);
    if (is_authenticated()) {
        if (isset($_SESSION['last_action'])) {
            //Figure out how many seconds have passed
            //since the user was last active.
            $secondsInactive = time() - $_SESSION['last_action'];

            //Convert our minutes into seconds.
            $expireAfterSeconds = $expireAfter * 60;

            //Check to see if they have been inactive for too long.
            if ($secondsInactive >= $expireAfterSeconds) {
                //User has been inactive for too long.
                //Kill their session.
                session_unset();
                session_destroy();
                $this->flash->addMessage('error', 'Su Sesión ya ah expirado');
                return $response->withRedirect($this->router->pathFor('login_get'));
            }
        }
        $_SESSION['last_action'] = time();
        //Assign the current timestamp as the user's
        //latest activity
        return $response;
    }
    return $response;
};

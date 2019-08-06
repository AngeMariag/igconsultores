<?php

$checkUserNotAuthenticated = function ($request, $response, $next) {
    if (!is_authenticated()) {
        $this->flash->addMessage('error', 'Usuario no tiene la sesión activa');
        return $response->withRedirect($this->router->pathFor('login_get'));
    };
    $response = $next($request, $response);
    return $response;
};

$checkUserAuthenticated = function ($request, $response, $next) {
    if (is_authenticated()) {
        // $this->flash->addMessage('error', 'Usuario no tiene la sesión activa');
        return $response->withRedirect($this->router->pathFor('dashboard'));
    };
    $response = $next($request, $response);
    return $response;
};

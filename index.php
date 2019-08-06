<?php
require 'vendor/autoload.php';

require_once('./settings.php');


// Define app routes
$app->get('/', function ($request, $response, $args) {
    // $this->flash->addMessage('Test', 'This is a message');
    // $csrf = get_csrf_token($request, $this);
    return $this->view->render($response, 'hello.html');
});
// Run app
$app->run();

?>
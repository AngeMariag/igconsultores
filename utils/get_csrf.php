<?php
function get_csrf_token($request, $app){
    $nameKey = $app->csrf->getTokenNameKey();
    $valueKey = $app->csrf->getTokenValueKey();
    return [
        'nameKey' => $nameKey,
        'valueKey' => $valueKey,
        'name' => $request->getAttribute($nameKey),
        'value' => $request->getAttribute($valueKey)

    ];
}
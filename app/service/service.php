<?php


$app->register('back', function() {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
});

$app->register('csrf', function() use ($service){
    $service->startSession();
    $html = '<input type="hidden" name="csrf_token" value="'.$_SESSION['csrf_token'].'">';
    $service = $service->flashes();
    if(isset($er['error']) && $er['error'][0] =="Token not find" ){
        $html .= '
        <br/>
        <div class="alert alert-warning" role="alert">
            Token not find.
        </div>';
    }
    return $html;
});

        
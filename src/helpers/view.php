<?php

use RPF\Core\View;
use React\Http\Response;
use RPF\Builders\ViewBuilder;

/**
 * @return View|bool 
 */
function findView(string $view_name)
{
    $views = [
        'test' => new View('test.latte')
    ];
    return isset($views[$view_name]) ? $views[$view_name] : false;
}

function view(string $view, array $variables = []): Response
{
    return ViewBuilder::Render(findView($view), $variables);
}
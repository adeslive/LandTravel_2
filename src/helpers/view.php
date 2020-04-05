<?php

use RPF\Core\View;
use RPF\core\Component;
use React\Http\Response;
use RPF\Builders\ViewBuilder;
use RPF\Builders\ComponentBuilder;

/**
 * @return View|bool 
 */
function findView(string $name)
{
    assert($name != '');

    if(strpos($name, '.latte') !== false)
    {
        $path = View::TEMPLATE_DIR . $name;
    }else{
        $path = View::TEMPLATE_DIR . $name . '.latte';
    }
    
    $parts = explode('/templates/', $path);
    $real_name = explode("/", $parts[sizeof($parts)-1]);

    if (file_exists($path)){
        return new View($real_name[sizeof($real_name)- 1], $parts[sizeof($parts)-1]);
    }
    return false;
}

function findComponentPath(string $name)
{
    assert($name != '');

    if(strpos($name, '.latte') !== false)
    {
        $path = Component::TEMPLATE_DIR . $name;
    }else{
        $path = Component::TEMPLATE_DIR . $name . '.latte';
    }
    
    $parts = explode('/components/', $path);

    if (file_exists($path)){
        return $parts[sizeof($parts)-1];
    }
    return false;
}

function view(string $name, array $variables = []): Response
{
    $session = getSession();
    if ($session->isActive())
    {
        var_export($session->getContents());
        $variables['SESSION'] = $session->getContents();
    }
    return ViewBuilder::Render(findView($name), $variables);
}

function components(string $name, string $id = "")
{
    return ComponentBuilder::Bring($name, $id);
}
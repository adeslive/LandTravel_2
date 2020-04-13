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
    return findView('errors/ViewNotFound.latte');
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

/**
 * @return Response|String
 */
function view(string $name, array $variables = [], bool $string = false)
{
    if (getSession()->isActive() && !empty(getSession()->getContents())) {
        $variables['user'] = getSession()->getContents();
    }

    return $string == false ? ViewBuilder::Render(findView($name), $variables) : ViewBuilder::Render(findView($name), $variables, true);
}

function components(string $name, string $id = "")
{
    return ComponentBuilder::Bring($name, $id);
}
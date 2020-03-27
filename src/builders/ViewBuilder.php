<?php

namespace RPF\Builders;

use RPF\Core\View;
use Twig\Environment;
use React\Http\Response;
use RuntimeException;

use function RPF\addHeader;

final class ViewBuilder
{
    public static function Build (View $view) {
        return $view->build();
    }

    public static function Render (View $view, array $variables = null)  {
        try{
            addBody($view->render($variables));
        }catch (RuntimeException $e){
            print $e->getMessage();
        }
        
        return getResponse();
    }
}
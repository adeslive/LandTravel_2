<?php

namespace RPF\Core;

use Latte\Engine;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class View
{
    private $name;
    private $relative_path;
    private $variables;
    private $state;

    const TEMPLATE_DIR = __DIR__.'/../../views/templates';
    const TEMPLATE_CACHE_DIR = __DIR__ .'/../../cache/views';
    const BUILDING = 0;
    const DISPLAYING = 1;

    public function __construct(string $name, string $path = "", array $variables = [])
    {
        $this->name = $name;
        if ($this->relative_path !== "") {
            $this->relative_path = $path . '/' . $name;
        }else{
            $this->relative_path = "";
        }
        $this->variables = $variables;
    }

    public function build()
    {
        $latte = new Engine();
        $latte->setTempDirectory(View::TEMPLATE_CACHE_DIR);
        /*// render to output
        $latte->render('template.latte', $parameters);
        $loader = new FilesystemLoader(__DIR__ . '/../../views/templates');
        $twig = new Environment($loader, [
            'cache' => __DIR__ . '/../../cache/views',
            'debug' => true
        ]);*/
        return $latte;
    }

    public function render(array $variables = null): string
    {
        $variables = $variables ? $variables : $this->variables;
        //$this->build()->render($this->relativePath(), $variables)
        return $this->build()->renderToString(View::TEMPLATE_DIR . $this->relativePath(), $variables);
    }

    public function relativePath()
    {
        return $this->relative_path;
    }

    public function name()
    {
        return $this->name;
    }
}

<?php

namespace RPF\core;
use Latte\Engine;
use RPF\Core\View;

class Component extends View
{
    const TEMPLATE_DIR = __DIR__ . '/../../views/templates/components/';
    const TEMPLATE_CACHE_DIR = __DIR__ . '/../../cache/components';

    public function __construct(string $name, string $path, array $variables)
    {
        $this->name = $name;
        $this->path = $path;
        $this->variables = $variables;
    }

    public function build()
    {
        $latte = new Engine();
        $latte->setTempDirectory(Component::TEMPLATE_CACHE_DIR);
        return $latte;
    }

    public function render(array $variables = null) : string
    {
        
        return $this->build()->renderToString(Component::TEMPLATE_DIR . $this->path , $this->variables);
    }


    public function toArray()
    {
        return $this->variables;
    }
}

<?php

namespace RPF\Middleware;

use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;


final class ResourceHandler 
{
    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $path_parts = explode("/", $request->getUri()->getPath());
        $start = -1;
        $final_path = "";

        foreach($path_parts as $index => $part) {
            if (preg_match("/^^(js|img|css|vendors)$/", $part)){
                $start = $index;
            }
        }

        if ($start != -1){
            for($i = $start; $i < sizeof($path_parts); $i++){
                $final_path .= "/" . $path_parts[$i];
            }
    
            $path = __DIR__.'/../../resources' . $final_path;
            if (file_exists($path)){
                $handler = fopen($path, 'r');
                $file = fread($handler, filesize($path));
                fclose($handler);
                return new Response(200, ['Content-type' => mime_content_type($path)], $file);
            }
        }
        return $next($request);
    }
}
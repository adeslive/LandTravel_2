<?php

namespace RPF\Middleware;

use Mimey\MimeTypes;
use DirectoryIterator;
use React\Http\Response;
use Psr\Http\Message\ServerRequestInterface;

final class ResourceHandler
{
    const CACHE_DIR = __DIR__ . '/../../cache/misc';
    const RESOURCE_DIR = __DIR__ . '/../../resources';

    public function __construct(string $dir)
    {
        $this->dir = $dir;
    }

    public function __invoke(ServerRequestInterface $request, callable $next)
    {
        $parts = explode("/", urldecode($request->getUri()->getPath()));
        $start = -1;

        foreach ($parts as $index => $part) {
            if (preg_match("/^(js|img|css|video|favicon.ico)$/", $part)) {
                $start = $index;
            }
        }

        if ($start != -1) {
            $path = "";
            for ($i = $start; $i < sizeof($parts); $i++) {
                $path .= "/" . $parts[$i];
            }
            $real_path = $this->dir . $path;

            if (file_exists($real_path)){
                $handler = fopen($real_path, 'r');
                $file = fread($handler, filesize($real_path));
                fclose($handler);
                $mimes = new MimeTypes;

                $parts = explode(".", $path);

                return new Response(200, ['Content-Type' => $mimes->getMimeType($parts[sizeof($parts)-1])], $file);
            }
            return new Response(404);
        }

        return $next($request);
    }
}

<?php

namespace RPF\core;

use React\Http\Io\HttpBodyStream;
use React\Http\Response;

use function RingCentral\Psr7\stream_for;

final class SimpleResponse extends Response
{
    private $converted = false;

    function __construct(int $code, $data = null)
    {
        if (is_array($data)) {
            $data = json_encode($data);
            $this->converted = true;
        }
        $header = ['Content-type' => 'text/plain'];

        parent::__construct(
            $code,
            $header,
            $data
        );
    }

    public function toJson(string $key = '')
    {
        $response = $this->withoutHeader('Content-type');
        $response = $response->withAddedHeader('Content-type', 'application/json');

        if (!$this->converted) {
            if ($key == '') {
                $response = $response->withBody(stream_for(json_encode($this->getBody()->getContents())));
            } else {
                $response = $response->withBody(stream_for(json_encode([$key => $this->getBody()->getContents()])));
            }
        }

        return $response;
    }

    public function toPDF()
    {
        $response = $this->withoutHeader('Content-type');
        $response = $this->withAddedHeader('Content-type', 'application/pdf');

        return $response;
    }

    public function toPlain()
    {
        $this->withoutHeader('Content-type');
        return $this->withAddedHeader('Content-type', 'text/plain');
    }

    public function toHTML()
    {
        $this->withoutHeader('Content-type');
        return $this->withAddedHeader('Content-type', 'text/html');
    }

    public static function DOWNLOAD($path)
    {
        $quoted = sprintf('"%s"', addcslashes(basename($path), '"\\'));
        $handler = fopen($path, 'r');

        $response = new Response(
            200,
            [
                'Content-Description' => 'File Transfer',
                'Content-Type' => 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename=' . $quoted,
                'Content-Transfer-Encoding' => 'binary'
            ],
            fread($handler, filesize($path))
        );

        return $response;
    }

    public static function OK($data = null): self
    {
        return new self(200, $data);
    }

    public static function NOT_FOUND($data = null): self
    {
        return new self(404, $data);
    }

    public static function METHOD_NOT_ALLOWED($data = null): self
    {
        return new self(405, $data);
    }

    public static function CREATED($data = null): self
    {
        return new self(201, $data);
    }

    public static function ACCEPTED($data = null): self
    {
        return new self(202, $data);
    }

    public static function UNAUTHORIZED($data = null): self
    {
        return new self(401, $data);
    }

    public static function INTERNAL_ERROR($data = null): self
    {
        return new self(500, $data);
    }

    public static function BAD_REQUEST($data = null): self
    {
        return new self(400, $data);
    }
}

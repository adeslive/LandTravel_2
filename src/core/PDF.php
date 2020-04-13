<?php

namespace RPF\Core;

use Mpdf\Mpdf;
use RPF\core\SimpleResponse;
use RPF\Middleware\ResourceHandler;

final class PDF
{
    public $path;

    const PDF_PATH = __DIR__ .'/../../resources';
    const TEMP_PDF_PATH = __DIR__ .'/../../cache/files';

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function getBody(){
        if (isset($this->path) && $this->path != ''){
            $handler = fopen($this->path, 'r');
            return fread($handler, filesize($this->path));
        }
        return '';
    }

    public static function createPDFString(string $text, bool $css = false, string $css_dir = "")
    {
        $mpdf = new Mpdf();
        if ($css) {
            $css = file_get_contents(ResourceHandler::RESOURCE_DIR .'/' . $css_dir);
            $mpdf->writeHTML($css, 1);
        }

        $mpdf->WriteHTML($text);
        $path = PDF::TEMP_PDF_PATH .'/' . uniqid(). '.pdf';
        $body = $mpdf->Output($path, \Mpdf\Output\Destination::FILE);
        return new self($path);
    }

    public static function createPDFTemplate(string $template, array $vars = [], bool $css = false, string $css_dir = "")
    {
        $mpdf = new Mpdf();
        if ($css) {
            $css = file_get_contents(ResourceHandler::RESOURCE_DIR .'/' . $css_dir);
            $mpdf->writeHTML($css, 1);
        }

        $mpdf->WriteHTML(view($template, $vars, true));
        $path = PDF::TEMP_PDF_PATH .'/' . uniqid() . '.pdf';
        $body = $mpdf->Output($path, \Mpdf\Output\Destination::FILE);
        return new self($path);
    }
    
}
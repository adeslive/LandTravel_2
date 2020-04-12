<?php

namespace RPF\Core;

use Mpdf\Mpdf;

final class PDF
{
    public static function createPDFString(string $text, bool $css = false, string $css_dir = "")
    {
        $mpdf = new Mpdf();
        if ($css) {
            $css = file_get_contents(__DIR__.'/../css/factura.css');
            $mpdf->writeHTML($css, 1);
        }

        $mpdf->WriteHTML($text);
    }

    public static function createPDFTemplate(string $template, bool $css = false, string $css_dir = "")
    {
        
    }
}
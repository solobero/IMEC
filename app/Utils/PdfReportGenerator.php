<?php

namespace App\Utils;

use App\Interfaces\ReportGeneratorInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class PdfReportGenerator implements ReportGeneratorInterface
{
    public function generateReport($orderProduct): string
    {
        $dompdf = new Dompdf();
        $html = view('reports.pdf', ['orderProduct' => $orderProduct])->render();
        $dompdf->loadHtml($html);
        $dompdf->render();

        $output = $dompdf->output();
        $filePath = storage_path('reports\pdf\order_' . $orderProduct->getId() . '.pdf');
        file_put_contents($filePath, $output);

        return $filePath;
    }
}
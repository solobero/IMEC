<?php

namespace App\Utils;

use App\Interfaces\ReportGeneratorInterface;

class TxtReportGenerator implements ReportGeneratorInterface
{
    public function generateReport($orderProduct): string
    {
        $content = 'Order ID: '.$orderProduct->getId()."\n";
        $content .= 'Date: '.$orderProduct->getCreatedAt()."\n";
        $content .= 'Total: $'.$orderProduct->getTotal()."\n";

        foreach ($orderProduct->getItemsProduct() as $item) {
            $content .= 'Product: '.$item->getProduct()->getName().' | ';
            $content .= 'Price: $'.$item->getPrice().' | ';
            $content .= 'Quantity: '.$item->getQuantity()."\n";
        }

        $filePath = storage_path('reports\txt\order_'.$orderProduct->getId().'.txt');
        file_put_contents($filePath, $content);

        return $filePath;
    }
}

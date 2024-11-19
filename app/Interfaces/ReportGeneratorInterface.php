<?php

namespace App\Interfaces;

interface ReportGeneratorInterface
{
    public function generateReport($orderProduct): string; 
}
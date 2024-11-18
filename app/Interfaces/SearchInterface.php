<?php

namespace App\Interfaces;

interface SearchInterface {
    
    public function searchByName(string $keyword): array;
}
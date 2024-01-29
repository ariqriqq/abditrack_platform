<?php


namespace Config;

use CodeIgniter\Config\BaseConfig;

class EnvironmentPlatform extends BaseConfig
{
    public string $platform = 'BIB';

    public array $platformSettings = [
        'BC' => [
            'color' => '#ff0000',
            'icon' => 'bc_logo.png',
            'platform' => 'BC',
            'base_url' => 'http://localhost:8000/bc/',
            'prefix_db' => 'bc'
        ],
        'BIB' => [
            'color' => '#ff2222',
            'icon' => 'bib_logo.png',
            'platform' => 'BIB',
            'base_url' => 'http://localhost:8000/bib/',
            'prefix_db' => 'bib'
        ],



        // Add settings for other platforms if needed
    ];
}

<?php

// Nilai bisa diubah lewat UI (/settings) tanpa oprek .env.
// Urutan: file settings > .env > default.
$sv = function ($key, $default = '') {
    $file = storage_path('app/gateway_settings.json');
    static $saved = null;
    if ($saved === null && is_file($file)) {
        $saved = json_decode(@file_get_contents($file), true) ?? [];
    }
    if (is_array($saved) && array_key_exists($key, $saved) && $saved[$key] !== '') {
        return $saved[$key];
    }
    return env($key, $default);
};

return [
    'token' => $sv('GATEWAY_TOKEN', 'gw-dev-123'),

    'timeout' => env('GATEWAY_TIMEOUT', 10),

    'services' => [
        'mis' => [
            'base_url' => $sv('MIS_BASE_URL', 'https://crm.lsfragrance.id'),
            'api_key'  => $sv('MIS_API_KEY', ''),
        ],
        'ao' => [
            'base_url'     => $sv('AO_BASE_URL', 'https://sys-af.lsfragrance.id'),
            'agenda_token' => $sv('AGENDA_TOKEN', ''),
            'ao_key'       => $sv('AO_KEY', ''),
        ],
        'trans' => [
            'base_url'    => $sv('TRANS_BASE_URL', 'https://trans.lssoft88.xyz'),
            'ao_api_key'  => $sv('AO_API_KEY', ''),
            'user_api_key'=> $sv('USER_API_KEY', ''),
        ],
        'drive' => [
            'base_url' => $sv('DRIVE_BASE_URL', 'https://drive.lssoft88.xyz'),
            'api_key'  => $sv('DRIVE_API_KEY', ''),
        ],
    ],
];

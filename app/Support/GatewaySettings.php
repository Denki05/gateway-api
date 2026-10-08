<?php

namespace App\Support;

use Illuminate\Support\Facades\Cache;

class GatewaySettings
{
    const FILE = 'gateway_settings.json';

    public static function fields()
    {
        return [
            'GATEWAY_TOKEN' => 'Kunci pintu depan (dibagikan ke MIS / AO / Landing)',
            'MIS_BASE_URL' => 'Alamat MIS',
            'MIS_API_KEY' => 'Token MIS (X-API-KEY)',
            'AO_BASE_URL' => 'Alamat AO',
            'AGENDA_TOKEN' => 'Token AO Agenda (Bearer)',
            'AO_KEY' => 'Token AO Order-Progress (X-AO-KEY)',
            'TRANS_BASE_URL' => 'Alamat Transaksi',
            'AO_API_KEY' => 'Token Transaksi untuk AO',
            'USER_API_KEY' => 'Token Transaksi untuk User',
            'DRIVE_BASE_URL' => 'Alamat Drive',
            'DRIVE_API_KEY' => 'Token Drive (jika ada)',
            'ADMIN_USER' => 'Username login panel ini',
            'ADMIN_PASS' => 'Password login panel ini',
        ];
    }

    public static function all()
    {
        $file = storage_path('app/' . self::FILE);
        $saved = [];
        if (is_file($file)) {
            $saved = json_decode(@file_get_contents($file), true) ?? [];
        }
        $defaults = [
            'GATEWAY_TOKEN' => env('GATEWAY_TOKEN', 'gw-dev-123'),
            'MIS_BASE_URL' => env('MIS_BASE_URL', 'https://crm.lsfragrance.id'),
            'MIS_API_KEY' => env('MIS_API_KEY', ''),
            'AO_BASE_URL' => env('AO_BASE_URL', 'https://sys-af.lsfragrance.id'),
            'AGENDA_TOKEN' => env('AGENDA_TOKEN', ''),
            'AO_KEY' => env('AO_KEY', ''),
            'TRANS_BASE_URL' => env('TRANS_BASE_URL', 'https://trans.lssoft88.xyz'),
            'AO_API_KEY' => env('AO_API_KEY', ''),
            'USER_API_KEY' => env('USER_API_KEY', ''),
            'DRIVE_BASE_URL' => env('DRIVE_BASE_URL', 'https://drive.lssoft88.xyz'),
            'DRIVE_API_KEY' => env('DRIVE_API_KEY', ''),
            'ADMIN_USER' => env('GATEWAY_ADMIN_USER', 'admin'),
            'ADMIN_PASS' => env('GATEWAY_ADMIN_PASS', 'admin123'),
        ];
        return array_merge($defaults, array_filter($saved, function ($v) {
            return $v !== null;
        }));
    }

    public static function save(array $data)
    {
        $allowed = array_keys(self::fields());
        $clean = [];
        foreach ($allowed as $k) {
            if (array_key_exists($k, $data)) {
                $clean[$k] = trim((string) $data[$k]);
            }
        }
        // Jangan kosongkan password kalau tidak diisi.
        $old = self::all();
        if (empty($clean['ADMIN_PASS'])) {
            $clean['ADMIN_PASS'] = $old['ADMIN_PASS'];
        }
        file_put_contents(storage_path('app/' . self::FILE), json_encode($clean, JSON_PRETTY_PRINT));
        Cache::forget('gw_settings');
        return $clean;
    }

    public static function get($key, $default = '')
    {
        $all = Cache::rememberForever('gw_settings', function () {
            return self::all();
        });
        return $all[$key] ?? $default;
    }
}

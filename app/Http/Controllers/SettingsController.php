<?php

namespace App\Http\Controllers;

use App\Support\GatewaySettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingsController extends Controller
{
    public function show()
    {
        return view('gateway.settings', [
            'fields' => GatewaySettings::fields(),
            'values' => GatewaySettings::all(),
        ]);
    }

    public function save(Request $request)
    {
        GatewaySettings::save($request->except('_token'));
        Cache::forget('gw_settings');
        // Config gateway dibaca dari file settings; kalau config pernah di-cache,
        // hapus agar nilai baru langsung berlaku tanpa perintah manual.
        try {
            \Artisan::call('config:clear');
        } catch (\Throwable $e) {
        }
        return redirect('/settings')->with('ok', 'Tersimpan & langsung berlaku (cache config dibersihkan otomatis).');
    }
}

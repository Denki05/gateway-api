<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CutoverController extends Controller
{
    const FILE = 'cutover.json';

    private static function defaults()
    {
        return [
            ['id' => 'token', 'nama' => 'Isi 5 token pusat di menu Token', 'done' => false],
            ['id' => 'bagi', 'nama' => 'Bagikan GATEWAY_TOKEN (X-GW-KEY) ke konsumen', 'done' => false],
            ['id' => 'landing', 'nama' => 'Cutover Landing → Drive (baca saja)', 'done' => false],
            ['id' => 'mis', 'nama' => 'Cutover MIS baca Trans/Drive', 'done' => false],
            ['id' => 'ao_trans', 'nama' => 'Cutover AO ↔ Transaksi tulis (weekend)', 'done' => false],
            ['id' => 'picker', 'nama' => 'Cutover Picker (terakhir)', 'done' => false],
            ['id' => 'kunci_pusat', 'nama' => 'Kunci pintu belakang pusat (allowlist/internal key)', 'done' => false],
            ['id' => 'rotasi', 'nama' => 'Rotasi API_SECRET_KEY MIS yang bocor', 'done' => false],
        ];
    }

    public static function load()
    {
        $file = storage_path('app/' . self::FILE);
        if (is_file($file)) {
            $saved = json_decode(@file_get_contents($file), true);
            if (is_array($saved)) return $saved;
        }
        return self::defaults();
    }

    public function show()
    {
        $items = self::load();
        $done = collect($items)->where('done', true)->count();
        return view('gateway.cutover', ['items' => $items, 'done' => $done, 'total' => count($items)]);
    }

    public function save(Request $request)
    {
        $checked = (array) $request->input('done', []);
        $items = self::defaults();
        foreach ($items as &$it) {
            $it['done'] = in_array($it['id'], $checked);
        }
        file_put_contents(storage_path('app/' . self::FILE), json_encode($items, JSON_PRETTY_PRINT));
        return redirect('/cutover')->with('ok', 'Checklist tersimpan.');
    }
}

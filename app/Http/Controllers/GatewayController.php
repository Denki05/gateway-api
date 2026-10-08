<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GatewayController extends Controller
{
    private function client()
    {
        return new Client([
            'timeout' => config('gateway.timeout', 10),
            'verify'  => false,
            'http_errors' => false,
        ]);
    }

    // GET /api/v1/drive/list?path=...
    // Contoh endpoint cached. Konsumen pakai GW_KEY, gateway teruskan ke drive.
    public function driveList(Request $request)
    {
        $path = $request->query('path', '/');
        $cacheKey = 'gw:drive:list:' . md5($path);

        if (Cache::has($cacheKey)) {
            return response()->json(Cache::get($cacheKey));
        }

        $base = rtrim(config('gateway.services.drive.base_url'), '/');
        $url = $base . '/api/list?path=' . urlencode($path);

        $res = $this->client()->get($url);
        $data = json_decode((string) $res->getBody(), true) ?? [];

        // Simpan 10 menit agar drive tidak dihantam MIS/AO/Landing bersamaan.
        Cache::put($cacheKey, $data, now()->addMinutes(10));

        Log::info('GW drive/list', ['path' => $path, 'status' => $res->getStatusCode()]);

        return response()->json($data, $res->getStatusCode());
    }

    // POST /api/v1/trans/so-awal/store
    // Contoh endpoint idempoten. Teruskan Idempotency-Key apa adanya.
    public function transSoStore(Request $request)
    {
        $base = rtrim(config('gateway.services.trans.base_url'), '/');
        $url = $base . '/api/ao/so-awal/store';

        $headers = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'X-API-KEY' => config('gateway.services.trans.ao_api_key'),
        ];

        // Jangan hilangkan idempotency dari AO.
        if ($request->header('Idempotency-Key')) {
            $headers['Idempotency-Key'] = $request->header('Idempotency-Key');
        }

        $res = $this->client()->post($url, [
            'headers' => $headers,
            'json' => $request->all(),
        ]);
        $data = json_decode((string) $res->getBody(), true) ?? [];

        Log::info('GW trans/so-awal/store', [
            'status' => $res->getStatusCode(),
            'idem' => $request->header('Idempotency-Key'),
        ]);

        return response()->json($data, $res->getStatusCode());
    }

    public function health()
    {
        return response()->json(['success' => true, 'service' => 'gateway', 'time' => now()->toDateTimeString()]);
    }

    public function dashboard()
    {
        $gw = config('gateway');
        $services = $gw['services'];
        foreach ($services as $k => &$s) {
            $s['ok_url'] = !empty($s['base_url']);
            $keys = array_filter($s, function ($v, $kk) {
                return $kk !== 'base_url';
            }, ARRAY_FILTER_USE_BOTH);
            $s['ok_key'] = !empty(implode('', array_map('strval', $keys)));
        }
        unset($s);
        // PUSAT = penyedia data (tujuan akhir). KONSUMEN = pemakai gateway (pengirim).
        $pusat = [
            'mis' => ['nama' => 'MIS', 'peran' => 'Pusat data customer & prospek', 'url' => $services['mis']['base_url']],
            'ao' => ['nama' => 'AO', 'peran' => 'Pusat agenda & SO', 'url' => $services['ao']['base_url']],
            'trans' => ['nama' => 'TRANSAKSI', 'peran' => 'Pusat produk & SO', 'url' => $services['trans']['base_url']],
            'drive' => ['nama' => 'DRIVE', 'peran' => 'Pusat file & gambar', 'url' => $services['drive']['base_url']],
        ];
        $konsumen = [
            ['nama' => 'MIS', 'pakai' => 'Minta produk/file ke Trans & Drive'],
            ['nama' => 'AO', 'pakai' => 'Minta customer/produk + kirim SO'],
            ['nama' => 'APM', 'pakai' => 'Minta produk/file + kirim prospek'],
            ['nama' => 'LANDING', 'pakai' => 'Minta hero/produk/katalog ke Drive'],
            ['nama' => 'PICKER', 'pakai' => 'Minta tugas gudang ke Transaksi'],
        ];
        $uji = [
            'drive' => [
                ['label' => 'Daftar file (GET /api/list?path=/)', 'method' => 'GET', 'path' => '/api/list?path=/'],
                ['label' => 'Hero landing (GET /api/hero-data?brand=gcf)', 'method' => 'GET', 'path' => '/api/hero-data?brand=gcf'],
            ],
            'trans' => [
                ['label' => 'Produk (GET /api/products)', 'method' => 'GET', 'path' => '/api/products'],
                ['label' => 'Brand SO (GET /api/ao/so-awal/brands)', 'method' => 'GET', 'path' => '/api/ao/so-awal/brands'],
            ],
            'mis' => [
                ['label' => 'Progress officer (GET /api/events/officer-progress)', 'method' => 'GET', 'path' => '/api/events/officer-progress?officer=test'],
                ['label' => 'Prospek saya (GET /api/v1/prospek/my-data)', 'method' => 'GET', 'path' => '/api/v1/prospek/my-data?user_id=test'],
            ],
            'ao' => [
                ['label' => 'Tasks (GET /api/tasks)', 'method' => 'GET', 'path' => '/api/tasks'],
                ['label' => 'Agenda (GET /api/agenda/list)', 'method' => 'GET', 'path' => '/api/agenda/list'],
            ],
        ];
        return view('gateway.dashboard', [
            'gwToken' => $gw['token'],
            'pusat' => $pusat,
            'konsumen' => $konsumen,
            'uji' => $uji,
        ]);
    }

    public function help()
    {
        return view('gateway.help');
    }

    // GET /routes — katalog rute gateway ↔ endpoint pusat (dibaca staf sebelum cutover)
    public function routes()
    {
        $rows = [
            ['GET', '/api/v1/drive/list?path=', 'GET drive/api/list', '—', 'Aktif ✅', 'Landing/MIS/AO/APM'],
            ['POST', '/api/v1/trans/so-awal/store', 'POST trans/api/ao/so-awal/store', 'AO_API_KEY', 'Aktif ✅', 'AO'],
            ['GET', '/api/v1/drive/cms/*', 'GET drive/api/hero-data…', '—', 'Menyusul', 'Landing'],
            ['GET', '/api/v1/trans/master/*', 'GET trans/api/products…', '—', 'Menyusul', 'MIS/AO/APM'],
            ['GET/POST', '/api/v1/trans/so-awal/*', 'trans/api/ao/so-awal/*', 'AO_API_KEY', 'Menyusul', 'AO'],
            ['POST', '/api/v1/ao/inbound/*', 'POST ao/api/ao/notif…', 'AGENDA_TOKEN/AO_KEY', 'Menyusul', 'Transaksi/MIS'],
            ['GET/POST', '/api/v1/ao/agenda|tasks|doctor/*', 'ao/api/…', 'AGENDA_TOKEN', 'Menyusul', 'MIS'],
            ['GET/POST', '/api/v1/mis/prospek|events|customers/*', 'mis/api/…', 'MIS_API_KEY', 'Menyusul', 'AO/APM'],
            ['GET', '/api/v1/trans/users/*', 'trans/api/superusers…', 'USER_API_KEY', 'Menyusul', 'AO'],
            ['*', '/api/v1/trans/picker/*', 'trans/api/picker/*', 'token picker', 'Terakhir', 'Picker'],
        ];
        return view('gateway.routes', ['rows' => $rows]);
    }

    // POST /test-endpoint {konsumen, service, path, mode: gateway|langsung}
    // gateway = lewat kunci gateway (simulasi konsumen). langsung = tembak pusat tanpa gateway.
    public function testEndpoint(Request $request)
    {
        $request->validate([
            'konsumen' => 'required|string|max:20',
            'service' => 'required|in:mis,ao,trans,drive',
            'path' => 'required|string|max:200',
            'mode' => 'required|in:gateway,langsung',
        ]);
        $svc = config('gateway.services.' . $request->service);
        $base = rtrim($svc['base_url'] ?? '', '/');
        $url = $base . $request->path;
        $headers = ['Accept' => 'application/json', 'X-Consumer' => $request->konsumen];

        if ($request->mode === 'gateway') {
            // Simulasi apa yang dilakukan gateway: tempelkan kunci pusat yang tersimpan.
            if ($request->service === 'mis' && !empty($svc['api_key'])) {
                $headers['X-API-KEY'] = $svc['api_key'];
            } elseif ($request->service === 'ao' && !empty($svc['agenda_token'])) {
                $headers['Authorization'] = 'Bearer ' . $svc['agenda_token'];
            } elseif ($request->service === 'trans') {
                $key = !empty($svc['ao_api_key']) ? $svc['ao_api_key'] : ($svc['user_api_key'] ?? '');
                if ($key) $headers['X-API-KEY'] = $key;
            }
        }
        $t0 = microtime(true);
        try {
            $res = $this->client()->get($url, ['headers' => $headers]);
            $ms = (int) ((microtime(true) - $t0) * 1000);
            $body = (string) $res->getBody();
            Log::info('GW test', ['konsumen' => $request->konsumen, 'mode' => $request->mode, 'url' => $url, 'status' => $res->getStatusCode()]);
            return response()->json([
                'success' => true,
                'http' => $res->getStatusCode(),
                'ms' => $ms,
                'body' => substr($body, 0, 800),
            ]);
        } catch (\Exception $e) {
            $ms = (int) ((microtime(true) - $t0) * 1000);
            return response()->json(['success' => false, 'http' => 0, 'ms' => $ms, 'error' => substr($e->getMessage(), 0, 200)]);
        }
    }

    // GET /services-status (dipakai dashboard via AJAX, tanpa auth agar bisa dibuka cepat)
    public function servicesStatus()
    {
        try {
            $out = [];
            $services = config('gateway.services', []);
            foreach ($services as $name => $s) {
                $base = rtrim($s['base_url'] ?? '', '/');
                if (empty($base)) {
                    $out[$name] = ['up' => false, 'http' => 0, 'ms' => 0, 'err' => 'base_url kosong'];
                    continue;
                }
                $t0 = microtime(true);
                try {
                    $res = $this->client()->get($base, ['timeout' => 6, 'connect_timeout' => 4]);
                    $ms = (int) ((microtime(true) - $t0) * 1000);
                    $out[$name] = ['up' => $res->getStatusCode() < 500, 'http' => $res->getStatusCode(), 'ms' => $ms];
                } catch (\Throwable $e) {
                    $ms = (int) ((microtime(true) - $t0) * 1000);
                    $out[$name] = ['up' => false, 'http' => 0, 'ms' => $ms, 'err' => substr($e->getMessage(), 0, 150)];
                }
            }
            return response()->json(['success' => true, 'data' => $out, 'time' => now()->toDateTimeString()]);
        } catch (\Throwable $e) {
            Log::error('GW servicesStatus fatal: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'Status check gagal: ' . substr($e->getMessage(), 0, 150)], 500);
        }
    }
}

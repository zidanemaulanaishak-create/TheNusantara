<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use App\Models\Informasi;
use App\Models\Pengunjung;
use App\Models\Pulau;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $jumlahArtikel = Informasi::count();
        $hariIniArtikel = Informasi::whereDate('created_at', today())->count();
        $persenArtikel = $hariIniArtikel * 2;
        $persenLabel = '+'.$persenArtikel.'%';

        $jumlahGaleri = Galeri::count();
        $hariIniGaleri = Galeri::whereDate('created_at', today())->count();
        $persenGaleriCount = $hariIniGaleri * 2;
        $persenGaleri = '+'.$persenGaleriCount.'%';

        $labels = [];
        $data = [];
        $map = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->toDateString();
            $labels[] = now()->subDays($i)->format('D');
            $map[$date] = 0;
        }
        $rows = Pengunjung::where('tanggal', '>=', now()->subDays(6)->toDateString())
            ->orderBy('tanggal')
            ->get();
        foreach ($rows as $row) {
            $map[$row->tanggal] = (int) $row->jumlah;
        }
        $data = array_values($map);

        $viewsBulanIni = (int) (Pengunjung::whereMonth('tanggal', now()->month)
            ->whereYear('tanggal', now()->year)->sum('jumlah') ?? 0);
        $viewsBulanLalu = (int) (Pengunjung::whereMonth('tanggal', now()->subMonth()->month)
            ->whereYear('tanggal', now()->subMonth()->year)->sum('jumlah') ?? 0);
        $viewsBulanLalu = $viewsBulanLalu ?: 1;
        $persenViews = round((($viewsBulanIni - $viewsBulanLalu) / $viewsBulanLalu) * 2);
        $persenViews = ($persenViews >= 0 ? '+' : '').$persenViews.'%';

        $visitorLabels = json_encode($labels);
        $visitorData = json_encode($data);

        $topPulau = Pulau::orderByDesc('views')->limit(5)->get(['nama', 'views']);
        $notifItems = DB::table('tb_laporan')->where('status', '!=', 'selesai')->where('notif', 0)
            ->orderByDesc('created_at')->limit(5)->get()->toArray();
        $jumlahNotif = count($notifItems);
        $notifData = $notifItems;

        return view('admin.dashboard', compact(
            'jumlahArtikel', 'persenLabel', 'jumlahGaleri', 'persenGaleri',
            'visitorLabels', 'visitorData', 'viewsBulanIni', 'persenViews',
            'topPulau', 'jumlahNotif', 'notifData'
        ));
    }
}

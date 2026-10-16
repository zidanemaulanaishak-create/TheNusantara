<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanAdminController extends Controller
{
    public function index(Request $request)
    {
        $perPage = (int) $request->query('per_page', 10);
        $perPage = $perPage > 0 ? $perPage : 10;
        $halaman = max(1, (int) $request->query('page_num', 1));
        $offset = ($halaman - 1) * $perPage;

        $search = $request->query('search', '');
        $filterStatus = $request->query('filter_status', '');

        $allowedSort = ['id', 'nama', 'created_at', 'status'];
        $sortBy = in_array($request->query('sort'), $allowedSort) ? $request->query('sort') : 'created_at';
        $sortDir = $request->query('dir') === 'asc' ? 'ASC' : 'DESC';

        $query = Laporan::where('status', '!=', 'selesai');
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('pesan', 'like', "%{$search}%");
            });
        }
        if ($filterStatus !== '') {
            $query->where('status', $filterStatus);
        }

        $total = $query->count();
        $totalPages = (int) ceil($total / $perPage);

        $data = $query->orderBy($sortBy, $sortDir)->skip($offset)->take($perPage)->get()->toArray();

        $queryBase = http_build_query(array_filter([
            'page' => 'laporan',
            'search' => $search,
            'filter_status' => $filterStatus,
            'sort' => $sortBy,
            'dir' => $sortDir,
            'per_page' => $perPage,
        ]));

        return view('admin.laporan-index', compact(
            'perPage', 'halaman', 'offset', 'search', 'filterStatus',
            'sortBy', 'sortDir', 'total', 'totalPages', 'data', 'queryBase'
        ));
    }

    public function updateStatus(Request $request)
    {
        $id = (int) $request->input('id');
        $status = $request->input('status');

        if (! in_array($status, ['proses', 'selesai'])) {
            return response()->json(['success' => false]);
        }

        Laporan::where('id', $id)->update(['status' => $status]);

        return response()->json(['success' => true]);
    }

    public function markNotifRead()
    {
        DB::table('tb_laporan')->where('status', '!=', 'selesai')->update(['notif' => 1]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Laporan::where('id', $id)->delete();

        return redirect()->route('admin.laporan.index');
    }
}

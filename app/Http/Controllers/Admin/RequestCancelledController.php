<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RequestCancelled;
use Illuminate\Http\Request;

class RequestCancelledController extends Controller
{
    public function index()
    {
        $items = RequestCancelled::all();
        return view('admin.requestCancelled.index', compact('items'));
    }

    public function destroy(string $id)
    {
        $cancel = RequestCancelled::where('id', $id)->first();
        $cancel->delete();

        return redirect('/admin/permintaan-pembatalan');
    }

    public function confirm(string $id)
    {
        $cancel = RequestCancelled::where('id', $id)->first();

        if ($cancel) {
            $cancel->update([
                'status' => 'confirm'
            ]);
            return redirect('/admin/permintaan-pembatalan');
        }
        
        return redirect('/admin/permintaan-pembatalan');
    }

    public function reject(string $id)
    {
        $cancel = RequestCancelled::where('id', $id)->first();

        if ($cancel) {
            $cancel->update([
                'status' => 'reject'
            ]);
            return redirect('/admin/permintaan-pembatalan');
        }
        
        return redirect('/admin/permintaan-pembatalan');
    }
}

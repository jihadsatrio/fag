<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Nahkoda;
use App\Models\Pembawakapal;
use Illuminate\Http\Request;

class PembawakapalController extends Controller
{

    public function index(Request $request)
    {
        $searchnahkoda = $request->input('searchnahkoda');
        $searchagen    = $request->input('searchagen');
        $pembawakapal  = Pembawakapal::whereHas('nahkoda', function ($query) use ($searchnahkoda)
        {

            if (!empty($searchnahkoda))
            {
                $query = $query->where('nahkoda.name', 'LIKE', '%' . $searchnahkoda . '%');
            }
        })->whereHas('agen', function ($query) use ($searchagen)
        {
            if (!empty($searchagen))
            {
                $query = $query->where('agen.name', 'LIKE', '%' . $searchagen . '%');
            }
        });

        if (!empty($request->searchclass))
        {
            $pembawakapal = $pembawakapal->where('class_kapal', 'LIKE', '%' . $request->searchclass . '%');
        }

        if (!empty($request->searchclass))
        {
            $pembawakapal = $pembawakapal->where('class_kapal', 'LIKE', '%' . $request->searchclass . '%');
        }

        $pembawakapal = $pembawakapal->orderBy('id', 'desc')->paginate(10);

        return view('admin.Pembawakapal.index', compact('pembawakapal'));
    }

    public function create(Request $request)
    {
        $nahkoda = Nahkoda::orderBy('name', 'asc')->pluck('name', 'id');
        $agen   = Agen::orderBy('name', 'asc')->pluck('name', 'id');

        return view('admin.Pembawakapal.create', compact('nahkoda', 'agen'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'roomclass' => 'required',
            'year'      => 'required',
            'nahkoda' => 'required',
            'agen'   => 'required',
        ]);

        $params = [
            'class_kapal'   => $request->input('roomclass'),
            'year'         => $request->input('year'),
            'nahkoda_id' => $request->input('nahkoda'),
            'agen_id'   => $request->input('agen'),
        ];

        $pembawakapal = Pembawakapal::create($params);

        return redirect()->route('admin.pembawakapal');
    }

    public function edit($id)
    {
        $pembawakapal    = Pembawakapal::find($id);
        $nahkoda = Nahkoda::orderBy('name', 'asc')->pluck('name', 'id');
        $agen   = Agen::orderBy('name', 'asc')->pluck('name', 'id');

        if ($pembawakapal == null)
        {
            return view('admin.layouts.404');
        }

        return view('admin.Pembawakapal.edit', compact('pembawakapal', 'nahkoda', 'agen'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'roomclass' => 'required',
            'year'      => 'required',
            'nahkoda' => 'required',
            'agen'   => 'required',
        ]);

        $pembawakapal               = Pembawakapal::find($id);
        $pembawakapal->class_kapal   = $request->input('roomclass');
        $pembawakapal->year         = $request->input('year');
        $pembawakapal->nahkoda_id = $request->input('nahkoda');
        $pembawakapal->agen_id   = $request->input('agen');
        $pembawakapal->save();

        return redirect()->route('admin.pembawakapal');
    }

    public function destroy($id)
    {
        Pembawakapal::find($id)->delete();

        return redirect()->route('admin.pembawakapal')->with('success', 'berhasil dihapus');
    }
}

<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Pembawakapal;
use Illuminate\Http\Request;

class agenController extends Controller
{
    public function index(Request $request)
    {

        $agen = Agen::orderBy('id', 'desc');

        if (!empty($request->searchcode))
        {
            $agen = $agen->where('code_agen', 'LIKE', '%' . $request->searchcode . '%');
        }

        if (!empty($request->searchname))
        {
            $agen = $agen->where('name', 'LIKE', '%' . $request->searchname . '%');
        }

        $agen = $agen->paginate(10);

        return view('admin.agen.index', compact('agen'));
    }

    public function create(Request $request)
    {

        $type = [
            'KARGO'     => 'KARGO',
            'TANKER' => 'TANKER',
            'KONTAINER' => 'KONTAINER',
        ];

        return view('admin.agen.create', compact('type'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code_agen' => 'unique:agen,code_agen|required',
            'nameagen'  => 'required',
            // 'sks'          => 'required',
            // 'semester'     => 'required',

        ]);

        $params = [
            'code_agen' => $request->input('code_agen'),
            'name'         => $request->input('nameagen'),
            // 'sks'          => $request->input('sks'),
            // 'semester'     => $request->input('semester'),
            'type'         => $request->input('type'),
        ];

        $agen = Agen::create($params);

        return redirect()->route('admin.agen');
    }

    public function edit($id)
    {
        $agen = Agen::find($id);

        if ($agen == null)
        {
            return view('admin.layouts.404');
        }

        $type = array(
            'Teori'     => 'Teori',
            'Praktikum' => 'Praktikum');

        return view('admin.agen.edit', compact('agen', 'type'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'code_agen' => 'unique:agen,code_agen,' . $id . '|required',
            'nameagen'  => 'required',

        ]);

        $agen               = Agen::find($id);
        $agen->code_agen = $request->input('code_agen');
        $agen->name         = $request->input('nameagen');
        $agen->type         = $request->input('type');
        $agen->save();

        return redirect()->route('admin.agen');
    }

    public function destroy($id)
    {
        $pembawakapal = Pembawakapal::where('agen_id', $id)->first();

        if (!empty($pembawakapal))
        {
            return redirect()->route('admin.agen')->with('danger', 'Anda Harus Menghapus Data Pembawakapal yang Berhubungan Dengan Agen Ini Terlebih Dahulu');
        }
        else
        {
            Agen::find($id)->delete();
        }

        return redirect()->route('admin.agen')->with('success', 'Berhasil Dihapus');
    }
}

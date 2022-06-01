<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kapal;
use Illuminate\Http\Request;

class kapalController extends Controller
{
    public function index(Request $request)
    {
        $kapal = Kapal::orderBy('id', 'desc');

        if (!empty($request->searchcode))
        {
            $kapal = $kapal->where('code_kapal', 'LIKE', '%' . $request->searchcode . '%');
        }

        if (!empty($request->searchname))
        {
            $kapal = $kapal->where('name', 'LIKE', '%' . $request->searchname . '%');
        }

        $kapal = $kapal->paginate(10);

        return view('admin.Kapal.index', compact('kapal'));
    }

    public function create(Request $request)
    {

        $type = array(
            'Teori'        => 'Teori',
            'Laboratorium' => 'Laboratorium');

        return view('admin.Kapal.create', compact('type'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'code_kapal' => 'unique:kapal,code_kapal|required',
            'namekapal'  => 'required',
            'capacity'   => 'required',

        ]);

        $params = [
            'code_kapal' => $request->input('code_kapal'),
            'name'       => $request->input('namekapal'),
            'capacity'   => $request->input('capacity'),
            'type'       => $request->input('type'),
        ];

        $kapal = Kapal::create($params);

        return redirect()->route('admin.kapal');
    }

    public function edit($id)
    {
        $kapal = Kapal::find($id);

        if ($kapal == null)
        {
            return view('admin.layouts.404');
        }

        $type = array(
            'Teori'        => 'Teori',
            'Laboratorium' => 'Laboratorium');

        return view('admin.Kapal.edit', compact('kapal', 'type'));
    }

    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'code_kapal' => 'unique:kapal,code_kapal,' . $id . '|required',
            'namekapal'  => 'required',
            'capacity'   => 'required',

        ]);

        $kapal             = Kapal::find($id);
        $kapal->code_kapal = $request->input('code_kapal');
        $kapal->name       = $request->input('namekapal');
        $kapal->capacity   = $request->input('capacity');
        $kapal->type       = $request->input('type');
        $kapal->save();

        return redirect()->route('admin.kapal');
    }

    public function destroy($id)
    {
        Kapal::find($id)->delete();

        return redirect()->route('admin.kapal')->with('success', 'Ruangan berhasil dihapus');
    }
}

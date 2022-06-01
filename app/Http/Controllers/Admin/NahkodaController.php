<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nahkoda;
use Illuminate\Http\Request;

class NahkodaController extends Controller
{

    public function index(Request $request)
    {
        $nahkoda = Nahkoda::orderBy('id', 'desc');

        if (!empty($request->searchname))
        {
            $nahkoda = $nahkoda->where('name', 'LIKE', '%' . $request->searchname . '%');
        }

        if (!empty($request->searchnidn))
        {
            $nahkoda = $nahkoda->where('nidn', 'LIKE', '%' . $request->searchnidn . '%');
        }

        $nahkoda = $nahkoda->paginate(10);

        return view('admin.Nahkoda.index', compact('nahkoda'));
    }
    public function create(Request $request)
    {
        return view('admin.Nahkoda.create');
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'code_nahkoda' => 'unique:nahkoda,code_nahkoda|required',
            'nidnNahkoda'   => 'required',
            'name'           => 'required',
            'emailNahkoda'  => 'required',

        ]);

        $params = [
            'code_nahkoda' => $request->input('code_nahkoda'),
            'nidn'           => $request->input('nidnNahkoda'),
            'name'           => $request->input('name'),
            'email'          => $request->input('emailNahkoda'),
        ];

        $nahkoda = Nahkoda::create($params);

        return redirect()->route('admin.nahkoda');
    }

    public function edit($id)
    {
        $nahkoda = Nahkoda::find($id);

        if ($nahkoda == null)
        {
            return view('admin.layouts.404');
        }

        return view('admin.Nahkoda.edit', compact('nahkoda'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code_nahkoda' => 'unique:nahkoda,code_nahkoda,' . $id . '|required',
            'nidnNahkoda'   => 'required',
            'name'           => 'required',
            'emailNahkoda'  => 'required',

        ]);

        $nahkoda                 = Nahkoda::find($id);
        $nahkoda->code_nahkoda = $request->input('code_nahkoda');
        $nahkoda->nidn           = $request->input('nidnNahkoda');
        $nahkoda->name           = $request->input('name');
        $nahkoda->email          = $request->input('emailNahkoda');
        $nahkoda->save();

        return redirect()->route('admin.nahkoda');
    }

    public function destroy($id)
    {
        Nahkoda::find($id)->delete();

        return redirect()->route('admin.nahkoda')->with('success', 'Dosen berhasil dihapus');
    }

}

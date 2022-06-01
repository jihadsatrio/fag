<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Day;
use App\Models\Nahkoda;
use App\Models\Time;
use App\Models\Timenotavailable;
use Illuminate\Http\Request;

class TimenotavailableController extends Controller
{

    public function index(Request $request)
    {
        $searchnahkoda   = $request->input('searchnahkoda');
        $searchday         = $request->input('searchday');
        $timenotavailables = Timenotavailable::whereHas('nahkoda', function ($query) use ($searchnahkoda)
        {

            if (!empty($searchnahkoda))
            {
                $query = $query->where('nahkoda.name', 'LIKE', '%' . $searchnahkoda . '%');
            }
        })->whereHas('day', function ($query) use ($searchday)
        {
            if (!empty($searchday))
            {
                $query = $query->where('days.name_day', 'LIKE', '%' . $searchday . '%');
            }
        });

        $timenotavailables = $timenotavailables->orderBy('id', 'desc')->paginate(10);

        return view('admin.timenotavailable.index', compact('timenotavailables'));
    }

    public function create(Request $request)
    {

        $nahkoda = Nahkoda::orderBy('name', 'asc')->pluck('name', 'id');
        $days      = Day::orderBy('name_day', 'asc')->pluck('name_day', 'id');
        $times     = Time::orderBy('range', 'asc')->pluck('range', 'id');

        return view('admin.timenotavailable.create', compact('nahkoda', 'days', 'times'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nahkoda' => 'required',
            'days'      => 'required',
            'times'     => 'required',

        ]);

        $params = [
            'nahkoda_id' => $request->input('nahkoda'),
            'days_id'      => $request->input('days'),
            'times_id'     => $request->input('times'),
        ];

        $timenotavailables = Timenotavailable::create($params);

        return redirect()->route('admin.timenotavailables');
    }

    public function edit($id)
    {
        $timenotavailables = Timenotavailable::find($id);
        $nahkoda         = Nahkoda::orderBy('name', 'asc')->pluck('name', 'id');
        $days              = Day::orderBy('name_day', 'asc')->pluck('name_day', 'id');
        $times             = Time::orderBy('range', 'asc')->pluck('range', 'id');

        if ($timenotavailables == null)
        {
            return view('admin.layouts.404');
        }

        return view('admin.timenotavailable.edit', compact('timenotavailables', 'nahkoda', 'days', 'times'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nahkoda' => 'required',
            'days'      => 'required',
            'times'     => 'required',
        ]);

        $timenotavailables               = Timenotavailable::find($id);
        $timenotavailables->nahkoda_id = $request->input('nahkoda');
        $timenotavailables->days_id      = $request->input('days');
        $timenotavailables->times_id     = $request->input('times');
        $timenotavailables->save();

        return redirect()->route('admin.timenotavailables');
    }

    public function destroy($id)
    {
        Timenotavailable::find($id)->delete();

        return redirect()->route('admin.timenotavailables')->with('success', 'Waktu berhalangan nahkoda berhasil dihapus');
    }

}

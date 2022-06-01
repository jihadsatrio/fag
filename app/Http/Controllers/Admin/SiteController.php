<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agen;
use App\Models\Day;
use App\Models\Nahkoda;
use App\Models\Kapal;
use App\Models\Schedule;
use App\Models\Pembawakapal;
use App\Models\Time;
use App\Models\User;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request)
    {
        $users     = User::count();
        $agen      = Agen::count();
        $days      = Day::count();
        $nahkoda   = Nahkoda::count();
        $kapal     = Kapal::count();
        $pembawakapal    = Pembawakapal::count();
        $times     = Time::count();
        $schedules = Schedule::count();

        return view('admin.site.admin', compact('users', 'agen', 'days', 'nahkoda', 'kapal', 'pembawakapal', 'times', 'schedules'));
    }
}

<?php namespace App\Models;

use App\Models\Day;
use App\Models\Nahkoda;
use App\Models\Time;
use Illuminate\Database\Eloquent\Model;

class Timenotavailable extends Model
{
    protected $table   = 'time_not_available';
    protected $guarded = [];

    public function nahkoda()
    {
        return $this->belongsTo(Nahkoda::class, 'nahkoda_id');
    }

    public function day()
    {
        return $this->belongsTo(Day::class, 'days_id');
    }

    public function time()
    {
        return $this->belongsTo(Time::class, 'times_id');
    }
}

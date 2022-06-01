<?php namespace App\Models;

use App\Models\Agen;
use App\Models\Nahkoda;
use Illuminate\Database\Eloquent\Model;

class Pembawakapal extends Model
{
    protected $table   = 'pembawakapal';
    protected $guarded = [];

    public function nahkoda()
    {
        return $this->belongsTo(Nahkoda::class, 'nahkoda_id');
    }

    public function agen()
    {
        return $this->belongsTo(Agen::class, 'agen_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataHasilSumberDaya extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];
    protected $table = 'data_hasil_sumber_dayas';

    public function sumberdaya()
    {
        return $this->belongsTo(DataSumberDaya::class, 'id_sumber_daya', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Currency extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'symbol'
    ];

    public function deleteCurrencies($ids_to_delete)
    {
        DB::table('currencies')->whereIn('id', $ids_to_delete)->delete();
    }
}

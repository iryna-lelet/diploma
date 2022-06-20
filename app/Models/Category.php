<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type_id'
    ];

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\Type', 'type_id', 'id');
    }

    public static function getAllCategories(): \Illuminate\Support\Collection
    {
        return DB::table('categories')
            ->select()
            ->leftJoin('types', 'categories.type_id', '=', 'types.id')
            ->select('categories.name AS category', 'types.name AS type', 'categories.id')
            ->get();
    }

    public function deleteCategories($ids_to_delete)
    {
        DB::table('categories')->whereIn('id', $ids_to_delete)->delete();
    }
}

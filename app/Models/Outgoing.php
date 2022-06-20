<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Outgoing extends Model
{
    use HasFactory;

    protected $fillable = [
//        'type_id',
        'amount',
        'creation_date',
        'payment_type_id',
        'category_id',
        'merchant',
        'user_id'
    ];

    public  function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

//    public  function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
//    {
//        return $this->belongsTo('App\Models\Type', 'type_id', 'id');
//    }

    public  function paymentTypes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\PaymentType', 'outgoing_payment_type', 'outgoing_id', 'payment_type_id');
    }

    public static function getAllOutgoings(): \Illuminate\Support\Collection
    {
        return DB::table('outgoings')
            ->select()
            ->leftJoin('categories', 'outgoings.category_id', '=', 'categories.id')
            ->leftJoin('payment_types', 'outgoings.payment_type_id', '=', 'payment_types.id')
            ->select('outgoings.id AS id',
                'outgoings.merchant AS merchant',
                'outgoings.creation_date AS creation_date',
                'outgoings.amount AS amount',
                'categories.name AS category',
                'payment_types.name AS payment_type'
            )
            ->get();
    }

    public function deleteOutgoings($ids_to_delete)
    {
        DB::table('outgoings')->whereIn('id', $ids_to_delete)->delete();
    }
}

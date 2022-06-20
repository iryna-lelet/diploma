<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Incoming extends Model
{
    use HasFactory;

    protected $fillable = [
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

    public  function paymentType(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne('App\Models\PaymentType');
    }

    public  function paymentTypes(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\PaymentType', 'incoming_payment_type', 'incoming_id', 'payment_type_id');
    }

    public static function getAllIncomings(): \Illuminate\Support\Collection
    {
        return DB::table('incomings')
            ->select()
            ->leftJoin('categories', 'incomings.category_id', '=', 'categories.id')
            ->leftJoin('payment_types', 'incomings.payment_type_id', '=', 'payment_types.id')
            ->select('incomings.id AS id',
                'incomings.merchant AS merchant',
                'incomings.creation_date AS creation_date',
                'incomings.amount AS amount',
                'categories.name AS category',
                'payment_types.name AS payment_type'
            )
            ->get();
    }

    public function deleteIncomings($ids_to_delete)
    {
        DB::table('incomings')->whereIn('id', $ids_to_delete)->delete();
    }
}

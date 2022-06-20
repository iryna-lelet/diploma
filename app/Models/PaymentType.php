<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PaymentType extends Model
{
    use HasFactory;


    protected $fillable = [
        'name',
        'notes'
    ];

    public  function incomings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Incoming', 'incoming_payment_type', 'payment_type_id', 'incoming_id');
    }

    public  function outgoings(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany('App\Models\Outgoing', 'outgoing_payment_type', 'payment_type_id', 'outgoing_id');
    }

    public function deletePaymentTypes($ids_to_delete)
    {
        DB::table('payment_types')->whereIn('id', $ids_to_delete)->delete();
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "pagos.payments";

    public const STATUS_PENDING_PAYMENT = 0;

    public const STATUS_DESC = [
        self::STATUS_PENDING_PAYMENT => 'Pendiente de pago',
    ];

    protected $fillable = ['amount'];
}

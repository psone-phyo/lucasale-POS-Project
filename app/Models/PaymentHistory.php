<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    use HasFactory;
    protected $fillable = [
            'username',
            'phone',
            'address',
            'payslip_image',
            'order_code',
            'total_amt',
    ];
}

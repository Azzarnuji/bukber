<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsModel extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'payments';
    public $timestamps = true;
}

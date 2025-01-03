<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['number', 'customer_id', 'total', 'sub_total', 'date', 'due_date', 'discount', 'reference_code', 'terms_and_conditions'];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function invoice_item() {
        return $this->hasMany(InvoiceItem::class);
    }
}

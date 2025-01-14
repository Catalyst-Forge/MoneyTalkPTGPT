<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assets extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'cash_out_id', 'cash_in_id', 'category_id', 'date', 'amount', 'value', 'total'];

    public function cash_out(): BelongsTo
    {
        return $this->belongsTo(CashOut::class)->withDefault();
    }

    public function cash_in(): BelongsTo
    {
        return $this->belongsTo(Cash::class)->withDefault();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class)->withDefault();
    }
}

<?php

namespace App\Models\Sale;

use App\Models\Seller\Seller;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'commission',
        'seller_id',
    ];

    public function seller() :BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }

}

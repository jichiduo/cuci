<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'unit',
        'price',
        'acc_code',
        'acc_name',
        'status',
        'remark',
        'equipment',
        'brand',
        'model',
        'warranty_period',
        'warranty_start_date',
        'warranty_end_date',
        'useful_life',
        'life_end_date',
        'location',
        'type',
        'group_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'price' => 'decimal:2',
        'equipment' => 'boolean',
        'warranty_start_date' => 'datetime',
        'warranty_end_date' => 'datetime',
        'life_end_date' => 'datetime',
        'group_id' => 'integer',
    ];

    public function group(): BelongsTo
    {
        return $this->belongsTo(AppGroup::class);
    }
}
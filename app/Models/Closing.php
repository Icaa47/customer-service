<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Closing extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        "user_id",
        "klien",
        "bisnis",
        "paket",
        "produk",
        "jumlah",
        "poin",
        "status",
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "jumlah" => "decimal:2",
            "poin" => "decimal:2",
            "created_at" => "datetime",
            "updated_at" => "datetime",
        ];
    }

    /**
     * Relasi ke user (CS)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

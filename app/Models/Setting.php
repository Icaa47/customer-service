<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public const TYPE_TEXT = 'text';
    public const TYPE_URL = 'url';
    public const TYPE_BOOLEAN = 'boolean';

    protected $fillable = [
        'section',
        'section_label',
        'key',
        'label',
        'type',
        'value',
        'metadata',
        'description',
        'sort',
    ];

    protected $casts = [
        'metadata' => 'array',
    ];

    public function valueAsBool(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_BOOLEAN);
    }
}

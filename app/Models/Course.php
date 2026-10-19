<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'title',
        'description',
        'price',
        'is_active',
        'duration',
        'user_id', // <--- Обязательно добавляем сюда
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'price' => 'decimal:2',
            'duration' => 'integer',
        ];
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function scopeAvailable(Builder $query): void
    {
        $query->where('is_active', true);
    }

    public function scopeSearch(Builder $query, ?string $text): void
    {
        $query->when($text, function ($q) use ($text) {
            $q->where(fn ($w) => $w->where('title', 'like', "%{$text}%")
                                   ->orWhere('description', 'like', "%{$text}%"));
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
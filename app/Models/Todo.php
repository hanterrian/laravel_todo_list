<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\OwnerScope;
use Database\Factories\TodoFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Todo
 *
 * @property int $id
 * @property int $owner_id
 * @property int $parent_id
 * @property string $status
 * @property int $priority
 * @property string $title
 * @property string $description
 * @property int|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Todo> $chilren
 * @property-read int|null $chilren_count
 * @property-read \App\Models\User|null $owner
 * @property-read Todo|null $parent
 * @method static \Database\Factories\TodoFactory factory($count = null, $state = [])
 * @method static Builder|Todo newModelQuery()
 * @method static Builder|Todo newQuery()
 * @method static Builder|Todo query()
 * @method static Builder|Todo whereCompletedAt($value)
 * @method static Builder|Todo whereCreatedAt($value)
 * @method static Builder|Todo whereDescription($value)
 * @method static Builder|Todo whereId($value)
 * @method static Builder|Todo whereOwnerId($value)
 * @method static Builder|Todo whereParentId($value)
 * @method static Builder|Todo wherePriority($value)
 * @method static Builder|Todo whereStatus($value)
 * @method static Builder|Todo whereTitle($value)
 * @method static Builder|Todo whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'priority',
        'title',
        'description',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'timestamp',
    ];

    protected static function booted(): void
    {
        static::addGlobalScope(new OwnerScope());
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Todo::class, 'parent_id');
    }

    public function chilren(): HasMany
    {
        return $this->hasMany(Todo::class, 'parent_id');
    }
}

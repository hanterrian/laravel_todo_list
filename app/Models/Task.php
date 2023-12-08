<?php

declare(strict_types=1);

namespace App\Models;

use App\DTO\TaskDTO;
use App\Models\Scopes\OwnerScope;
use Database\Factories\TaskFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\LaravelData\WithData;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property int $owner_id
 * @property int|null $parent_id
 * @property string $status
 * @property int $priority
 * @property string $title
 * @property string $description
 * @property int|null $completed_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Task> $chilren
 * @property-read int|null $chilren_count
 * @property-read \App\Models\User|null $owner
 * @property-read Task|null $parent
 * @method static \Database\Factories\TaskFactory factory($count = null, $state = [])
 * @method static Builder|Task newModelQuery()
 * @method static Builder|Task newQuery()
 * @method static Builder|Task query()
 * @method static Builder|Task whereCompletedAt($value)
 * @method static Builder|Task whereCreatedAt($value)
 * @method static Builder|Task whereDescription($value)
 * @method static Builder|Task whereId($value)
 * @method static Builder|Task whereOwnerId($value)
 * @method static Builder|Task whereParentId($value)
 * @method static Builder|Task wherePriority($value)
 * @method static Builder|Task whereStatus($value)
 * @method static Builder|Task whereTitle($value)
 * @method static Builder|Task whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Task extends Model
{
    use HasFactory, WithData;

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

    protected $dataClass = TaskDTO::class;

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
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function chilren(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }
}

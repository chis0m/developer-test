<?php

namespace App\Models;

use Database\Factories\LessonFactory;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\Lesson
 *
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static LessonFactory factory(...$parameters)
 * @method static Builder|Lesson newModelQuery()
 * @method static Builder|Lesson newQuery()
 * @method static Builder|Lesson query()
 * @method static Builder|Lesson whereCreatedAt($value)
 * @method static Builder|Lesson whereId($value)
 * @method static Builder|Lesson whereTitle($value)
 * @method static Builder|Lesson whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-write mixed $slug
 */
class Lesson extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
    ];
}

<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

/**
 * App\Models\AbstractAchievement
 *
 * @method static Builder|Achievement newModelQuery()
 * @method static Builder|Achievement newQuery()
 * @method static Builder|Achievement query()
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Achievement whereCreatedAt($value)
 * @method static Builder|Achievement whereId($value)
 * @method static Builder|Achievement whereTitle($value)
 * @method static Builder|Achievement whereUpdatedAt($value)
 * @property string $type
 * @method static Builder|Achievement whereType($value)
 * @property string $slug
 * @property int $count
 * @method static Builder|Achievement whereCount($value)
 * @method static Builder|Achievement whereSlug($value)
 * @property int $size
 * @method static Builder|Achievement whereSize($value)
 */
class Achievement extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'title',
        'size'
    ];


    /**
     * @param string $value
     */
    public function setTitleAttribute(string $value): void
    {
        $this->attributes['title'] = strtolower($value);
    }

    /**
     * @param string $title
     * @return Achievement|null
     */
    public static function getAchievement(string $title): ?Achievement
    {
        return self::query()->whereTitle($title)->first();
    }

    /**
     * @param string $type
     * @return Achievement[]|Collection
     */
    public static function getAchievements(string $type)
    {
        return self::query()->whereType(strtolower($type))->get();
    }
}

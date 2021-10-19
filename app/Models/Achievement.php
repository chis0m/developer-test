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
        'slug',
        'count'
    ];


    /**
     * @param $value
     */
    public function setTitleAttribute($value): void
    {
        $this->attributes['title'] = strtolower($value);
//        $this->attributes['slug'] = Str::slug(strtolower($value));
    }

    /**
     * @param string $title
     * @return Achievement|Builder|Model|object|null
     */
    public static function getAchievement(string $title): Achievement
    {
        return self::query()->whereTitle(Str::slug(strtolower($title)))->first();
    }

    /**
    /**
     * @param string $type
     * @return Achievement[]|Builder[]|Collection
     */
    public static function getAchievements(string $type): Collection
    {
        return self::query()->whereType(strtolower($type))->get();
    }
}

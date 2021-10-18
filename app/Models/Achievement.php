<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Achievement
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
        'title'
    ];
}

<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Badge
 *
 * @method static Builder|Badge newModelQuery()
 * @method static Builder|Badge newQuery()
 * @method static Builder|Badge query()
 * @mixin Eloquent
 * @property int $id
 * @property string $title
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Badge whereCreatedAt($value)
 * @method static Builder|Badge whereId($value)
 * @method static Builder|Badge whereTitle($value)
 * @method static Builder|Badge whereUpdatedAt($value)
 */
class Badge extends Model
{
    use HasFactory;

    public const BEGINNER = 'beginner';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'total'
    ];
}

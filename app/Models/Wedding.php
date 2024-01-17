<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Wedding
 *
 * @property int $id
 * @property string $unique_code
 * @property string $title
 * @property string $date
 * @property int $user_id
 * @property int $guestlist_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Guest> $guests
 * @property-read int|null $guests_count
 * @method static \Database\Factories\WeddingFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding whereDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding whereGuestlistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding whereUniqueCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wedding whereUserId($value)
 * @mixin Builder
 */
class Wedding extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'unique_code',
        'title',
        'date',
        'guestlist_id',
    ];

    public function guests(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Guest::class);
    }

    public function locations(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Location::class);
    }
}

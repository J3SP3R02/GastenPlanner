<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Guestlist
 *
 * @property int $id
 * @property int $moment_welcome
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\GuestlistFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Guestlist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guestlist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guestlist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Guestlist whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guestlist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guestlist whereMomentWelcome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guestlist whereUpdatedAt($value)
 * @mixin Builder
 */
class Guestlist extends Model
{
    use HasFactory;

    protected $fillable = [
        'welcome_id'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Guest
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phoneNumber
 * @property string|null $password
 * @property string|null $dietary_wishes
 * @property string|null $allergies
 * @property int $guestlist_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Wedding|null $wedding
 * @method static \Database\Factories\GuestFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Guest newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guest newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Guest query()
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereAllergies($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereDietaryWishes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereFirstname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereGuestlistId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereLastname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest wherePhoneNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Guest whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Guest extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'phoneNumber',
        'password',
        'dietary_wishes',
        'allergies',
        'guestlist_id'
    ];

    public function wedding(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Wedding::class);
    }
}

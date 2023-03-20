<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;


/**
 * @property int $id
 * @property string|null $name
 * @property bool $qr
 * @property integer $percent
 */

class User extends Model
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'name',
        'percent',
        'qr'
    ];
}

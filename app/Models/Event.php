<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $table = 'events';

    protected $primaryKey = 'event_id';

    protected $hidden = ['event_id', 'created_at', 'updated_at',];

    protected $fillable = ['name'];

    /**
     * @return Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function schedules()
    {
        return $this->hasMany(EventSchedule::class, 'event_id', 'event_id');
    }
}

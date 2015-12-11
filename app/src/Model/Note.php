<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'notes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['body', 'user_id'];

    /**
     * Get the user that owns the note.
     */
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }
}

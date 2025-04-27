<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tasks extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'due_date',
        'priority_id',
        'status_id',
        'recurrent',
        'frequency_id',
        'start_date',
        'end_date',
        'repetitions'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function priorities()
    {
        return $this->belongsTo(Priorities::class, 'priority_id');
    }
    public function statuses()
    {
        return $this->belongsTo(Statuses::class, 'status_id');
    }
    public function frequencies()
    {
        return $this->belongsTo(Frequencies::class, 'frequency_id');
    }

}
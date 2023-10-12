<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nama', 'deskripsi', 'status', 'user_id'];

    /**
     * Get the user that owns the Task
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeUserId($q)
    {
        return $q->where('user_id', auth()->user()->id);
    }

    protected static function booted()
    {
        //memasukkan user id
        static::creating(function ($tasks) {
            $tasks->user_id = auth()->user()->id;
        });

        static::updating(function ($tasks) {
            $tasks->user_id = auth()->user()->id;
        });
    }

    public function getStatusTeksAttribute()
    {
        if ($this->status == 0) {
            return '<span class="badge bg-danger">Belum Selesai</span>';
        } else {
            return '<span class="badge bg-success">Selesai<span>';
        }
    }
}

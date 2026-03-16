<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'company_name',
        'phone',
        'email',
        'cargo_type',
        'vehicle_type',
        'port_of_arrival',
        'message',
        'attachment',
        'status',
        'admin_notes',
        'assigned_to',
        'read_at',
        'replied_at',
    ];

    protected $casts = [
        'read_at' => 'datetime',
        'replied_at' => 'datetime',
    ];

    /**
     * Get the user assigned to this inquiry.
     */
    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    /**
     * Scope a query to only include new inquiries.
     */
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    /**
     * Scope a query to only include unread inquiries.
     */
    public function scopeUnread($query)
    {
        return $query->whereNull('read_at');
    }

    /**
     * Mark the inquiry as read.
     */
    public function markAsRead()
    {
        if (is_null($this->read_at)) {
            $this->update([
                'read_at' => now(),
                'status' => 'read',
            ]);
        }
    }

    /**
     * Mark the inquiry as replied.
     */
    public function markAsReplied()
    {
        $this->update([
            'replied_at' => now(),
            'status' => 'replied',
        ]);
    }
}

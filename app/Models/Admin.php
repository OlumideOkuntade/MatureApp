<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;


class Admin extends Model
{
    use HasFactory,LogsActivity;

    protected $fillable = [
      'first_name',
      'last_name',
      'phone_number',
      'user_id',
    ];

    protected static $logName = 'admin';
    protected static $logAttributes = ['email'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Admin has been {$eventName}";
    }
    
      public function getActivitylogOptions(): LogOptions
    {
      return LogOptions::defaults()
      ->logOnly(['*'])
      ->useLogName('admin-login')
      ->setDescriptionForEvent(fn(string $eventName) => "This model has been {$eventName}");
    }


      public function user()
    {
      return $this->belongsTo(User::class);
    }
}

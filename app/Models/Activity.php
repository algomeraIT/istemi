<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'client_id',
        'project_id',

        'activities',
        'user_activities',
        'status_activities',

        'team',
        'user_team',
        'status_team',

        'field_activities',
        'user_field_activities',
        'status_field_activities',

        'daily_check_activities',
        'user_daily_check_activities',
        'status_daily_check_activities',

        'contruction_site_media',
        'user_contruction_site_media',
        'status_contruction_site_media',

        'activity_validation',
        'user_activity_validation',
        'status_activity_validation',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function userActivities()
    {
        return $this->belongsTo(User::class, 'user_activities');
    }

    public function userTeam()
    {
        return $this->belongsTo(User::class, 'user_team');
    }

    public function userFieldActivities()
    {
        return $this->belongsTo(User::class, 'user_field_activities');
    }

    public function userDailyCheckActivities()
    {
        return $this->belongsTo(User::class, 'user_daily_check_activities');
    }

    public function userContructionSiteMedia()
    {
        return $this->belongsTo(User::class, 'user_contruction_site_media');
    }

    public function userActivityValidation()
    {
        return $this->belongsTo(User::class, 'user_activity_validation');
    }
}
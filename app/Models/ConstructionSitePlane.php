<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionSitePlane extends Model
{
    use HasFactory;

    protected $table = 'construction_site_plane';

    protected $fillable = [
        'client_id',
        'project_id',
        'user',
        'status',
        'construction_site_plane',
        'user_construction_site_plane',
        'status_construction_site_plane',

        'inspection',
        'user_inspection',
        'status_inspection',

        'travel',
        'user_travel',
        'status_travel',

        'site_pass',
        'user_site_pass',
        'status_site_pass',

        'ztl',
        'user_ztl',
        'status_ztl',

        'supplier',
        'user_supplier',
        'status_supplier',

        'timetable',
        'user_timetable',
        'status_timetable',

        'security',
        'user_security',
        'status_security',
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

    public function userConstructionSitePlane()
    {
        return $this->belongsTo(User::class, 'user_construction_site_plane');
    }

    public function userInspection()
    {
        return $this->belongsTo(User::class, 'user_inspection');
    }

    public function userTravel()
    {
        return $this->belongsTo(User::class, 'user_travel');
    }

    public function userSitePass()
    {
        return $this->belongsTo(User::class, 'user_site_pass');
    }

    public function userZtl()
    {
        return $this->belongsTo(User::class, 'user_ztl');
    }

    public function userSupplier()
    {
        return $this->belongsTo(User::class, 'user_supplier');
    }

    public function userTimetable()
    {
        return $this->belongsTo(User::class, 'user_timetable');
    }

    public function userSecurity()
    {
        return $this->belongsTo(User::class, 'user_security');
    }
}
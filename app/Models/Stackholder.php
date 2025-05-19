<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stackholder extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'role',
        'email',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function insertFromForm(array $formData, int $projectId): array
    {
        $stackholderIds = [];

        if (!isset($formData['stackholder_id']) || !is_array($formData['stackholder_id'])) {
            return $stackholderIds;
        }

        foreach ($formData['stackholder_id'] as $stackholder) {
            $id = DB::table('stackholders')->insertGetId([
                'project_id' => $projectId,
                'name' => $stackholder['name'] ?? '',
                'email' => $stackholder['email'] ?? '',
                'role' => $stackholder['role'] ?? '',
                'is_archived' => 0,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $stackholderIds[] = $id;
        }

        return $stackholderIds;
    }

}

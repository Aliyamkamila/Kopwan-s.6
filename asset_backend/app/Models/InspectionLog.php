<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspectionLog extends Model
{
    protected $table = 'inspection_logs';
    
    protected $fillable = [
        'asset_tag',
        'inspection_method',
        'defect_type',
        'severity_level',
        'image_url',
        'inspector_name',
        'notes',
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
    
    // Scopes untuk filtering
    public function scopeByAssetTag($query, $tag)
    {
        return $query->where('asset_tag', $tag);
    }
    
    public function scopeBySeverity($query, $level)
    {
        return $query->where('severity_level', $level);
    }
    
    public function scopeDateRange($query, $from, $to)
    {
        return $query->whereBetween('created_at', [$from, $to]);
    }
}
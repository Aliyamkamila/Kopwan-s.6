<?php

namespace Database\Seeders;

use App\Models\InspectionLog;
use Illuminate\Database\Seeder;

class InspectionLogSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'asset_tag' => 'PIPA-001',
                'inspection_method' => 'Radiography',
                'defect_type' => 'Porosity',
                'severity_level' => 'Kritis',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041200/inspections/pipa001.jpg',
                'inspector_name' => 'Budi Santoso',
                'notes' => 'Ditemukan cluster porosity di HAZ, perlu repair segera',
            ],
            [
                'asset_tag' => 'PIPA-002',
                'inspection_method' => 'Ultrasonic',
                'defect_type' => 'Crack',
                'severity_level' => 'Peringatan',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041201/inspections/pipa002.jpg',
                'inspector_name' => 'Siti Nurhaliza',
                'notes' => 'Micro crack terdeteksi, monitoring rutin diperlukan',
            ],
            [
                'asset_tag' => 'PIPA-003',
                'inspection_method' => 'Radiography',
                'defect_type' => 'Slag Inclusion',
                'severity_level' => 'Aman',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041202/inspections/pipa003.jpg',
                'inspector_name' => 'Ahmad Wijaya',
                'notes' => 'Slag inclusion minimal, masih dalam standar API 579',
            ],
            [
                'asset_tag' => 'PIPA-004',
                'inspection_method' => 'Magnetic Particle',
                'defect_type' => 'Incomplete Fusion',
                'severity_level' => 'Peringatan',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041203/inspections/pipa004.jpg',
                'inspector_name' => 'Rina Kusuma',
                'notes' => 'Incomplete fusion di root pass, perlu PWHT check',
            ],
            [
                'asset_tag' => 'PIPA-005',
                'inspection_method' => 'Visual',
                'defect_type' => 'Surface Corrosion',
                'severity_level' => 'Aman',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041204/inspections/pipa005.jpg',
                'inspector_name' => 'Hendra Gunawan',
                'notes' => 'Korosi permukaan, dapat dibersihkan dengan wire brush',
            ],
            [
                'asset_tag' => 'PIPA-006',
                'inspection_method' => 'Ultrasonic',
                'defect_type' => 'Porosity',
                'severity_level' => 'Kritis',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041205/inspections/pipa006.jpg',
                'inspector_name' => 'Budi Santoso',
                'notes' => 'Follow-up inspection, porositas masih berkembang',
            ],
            [
                'asset_tag' => 'PIPA-007',
                'inspection_method' => 'Radiography',
                'defect_type' => 'Crack',
                'severity_level' => 'Kritis',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041206/inspections/pipa007.jpg',
                'inspector_name' => 'Siti Nurhaliza',
                'notes' => 'Longitudinal crack di HAZ, immediate repair required',
            ],
            [
                'asset_tag' => 'PIPA-008',
                'inspection_method' => 'Eddy Current',
                'defect_type' => 'Incomplete Fusion',
                'severity_level' => 'Peringatan',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041207/inspections/pipa008.jpg',
                'inspector_name' => 'Ahmad Wijaya',
                'notes' => 'Side wall fusion belum sempurna, monitoring diperlukan',
            ],
            [
                'asset_tag' => 'PIPA-009',
                'inspection_method' => 'Visual',
                'defect_type' => 'Porosity',
                'severity_level' => 'Aman',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041208/inspections/pipa009.jpg',
                'inspector_name' => 'Rina Kusuma',
                'notes' => 'Porositas superfisial, tidak perlu tindakan',
            ],
            [
                'asset_tag' => 'PIPA-010',
                'inspection_method' => 'Magnetic Particle',
                'defect_type' => 'Slag Inclusion',
                'severity_level' => 'Peringatan',
                'image_url' => 'https://res.cloudinary.com/dfwpzvgzj/image/upload/v1715041209/inspections/pipa010.jpg',
                'inspector_name' => 'Hendra Gunawan',
                'notes' => 'Slag inclusion large, approaching acceptance limit',
            ],
        ];

        foreach ($data as $item) {
            InspectionLog::create($item);
        }
    }
}
<?php

namespace App\Http\Controllers;

use App\Models\InspectionLog;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InspectionLogController extends Controller
{
    public function index(Request $request)
    {
        $query = InspectionLog::query();

        // Filtering
        if ($request->has('asset_tag')) {
            $query->byAssetTag($request->asset_tag);
        }
        if ($request->has('severity_level')) {
            $query->bySeverity($request->severity_level);
        }
        if ($request->has('from_date') && $request->has('to_date')) {
            $query->dateRange($request->from_date, $request->to_date);
        }

        $inspections = $query->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $inspections,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'asset_tag' => 'required|string|max:255|unique:inspection_logs',
            'inspection_method' => 'required|string|max:255',
            'defect_type' => 'required|string|max:255',
            'severity_level' => 'required|in:Aman,Peringatan,Kritis',
            'image_url' => 'nullable|url|max:500',
            'inspector_name' => 'required|string|max:255',
            'notes' => 'nullable|string|max:2000',
        ]);

        $inspection = InspectionLog::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Inspection created successfully',
            'data' => $inspection,
        ], 201);
    }

    public function show($id)
    {
        $inspection = InspectionLog::findOrFail($id);

        return response()->json([
            'success' => true,
            'data' => $inspection,
        ]);
    }

    public function update(Request $request, $id)
    {
        $inspection = InspectionLog::findOrFail($id);

        $validated = $request->validate([
            'asset_tag' => ['sometimes', 'string', 'max:255', Rule::unique('inspection_logs')->ignore($id)],
            'inspection_method' => 'sometimes|string|max:255',
            'defect_type' => 'sometimes|string|max:255',
            'severity_level' => 'sometimes|in:Aman,Peringatan,Kritis',
            'image_url' => 'nullable|url|max:500',
            'inspector_name' => 'sometimes|string|max:255',
            'notes' => 'nullable|string|max:2000',
        ]);

        $inspection->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Inspection updated successfully',
            'data' => $inspection,
        ]);
    }

    public function destroy($id)
    {
        $inspection = InspectionLog::findOrFail($id);
        $inspection->delete();

        return response()->json([
            'success' => true,
            'message' => 'Inspection deleted successfully',
        ]);
    }

    public function summary()
    {
        $total = InspectionLog::count();
        $critical = InspectionLog::bySeverity('Kritis')->count();
        $warning = InspectionLog::bySeverity('Peringatan')->count();
        $safe = InspectionLog::bySeverity('Aman')->count();
        $uniqueAssets = InspectionLog::distinct('asset_tag')->count('asset_tag');

        return response()->json([
            'success' => true,
            'data' => [
                'total_inspections' => $total,
                'critical_defects' => $critical,
                'warning_level' => $warning,
                'safe_status' => $safe,
                'unique_assets' => $uniqueAssets,
            ],
        ]);
    }
}
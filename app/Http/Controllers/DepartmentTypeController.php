<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DepartmentType;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DepartmentTypeRequest;

class DepartmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department_types = DepartmentType::whereNull('deleted_at')->paginate(10);
        return view('department_types.index', compact('department_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('department_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentTypeRequest $request)
    {
        $data = $request->validated();
        DB::beginTransaction();
        try {
            DepartmentType::create($data);
            DB::commit();
            return response()->json([
                'success' => 'Department Type Created Successfully.',
                'redirectUrl' => route('department-types.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to create Department Type.'], 500);
        }
        // dd($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepartmentType $department_type)
    {
        return view('department_types.edit', compact('department_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentTypeRequest $request, DepartmentType $department_type)
    {
        // validated data from request. not all the fields in the form
        $data = $request->validated();
        // dd($data);
        DB::beginTransaction();
        try {
            $department_type->update($data);
            DB::commit();
            return response()->json([
                'success' => 'Department Type Updated Successfully.',
                'redirectUrl' => route('department-types.index')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to update Department Type.'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepartmentType $department_type)
    {
        DB::beginTransaction();
        try {
            $department_type->delete();
            DB::commit();
            return response()->json(['success' => 'Department Type Deleted Successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Failed to delete Department Type.'], 500);
        }
    }
}

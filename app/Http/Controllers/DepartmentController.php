<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Services\FileService;
use App\Models\DepartmentType;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $department_types = DepartmentType::whereNull('deleted_at')->get();
        $departments = Department::with('department_type')->filter()->paginate(10);
        return view('departments.index', compact('departments', 'department_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $department_types = DepartmentType::whereNull('deleted_at')->get();
        return view('departments.create', compact('department_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartmentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $imagePath = (new FileService())->storeImage($request->image, 'departments');
            $data['image'] = $imagePath;
        } else {
            $data['image'] = null;
        }

        Department::create($data);

        return response()->json([
            'success' => 'Department Created Successfully.',
            'redirectUrl' => route('departments.index')
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        $department_types = DepartmentType::whereNull('deleted_at')->get();
        return view('departments.edit', compact('department', 'department_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $image = (new FileService())->deleteImage($department->image ?? '');
            $imagePath = (new FileService())->storeImage($request->image, 'departments');
            $data['image'] = $imagePath;
        }

        $department->update($data);

        return response()->json([
            'success' => 'Department Updated Successfully.',
            'redirectUrl' => route('departments.index')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        if ($department->image) {
            (new FileService())->deleteImage($department->image);
        }
        $department->delete();

        return response()->json([
            'success' => 'Department Deleted Successfully.',
            'redirectUrl' => route('departments.index')
        ]);
    }

    
}

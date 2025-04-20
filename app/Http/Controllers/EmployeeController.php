<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::select('id', 'name', 'salary', 'registered_since', 'job_position');

            return DataTables::of($employees)
                ->addIndexColumn()
                ->addColumn('actions', function ($employee) {
                    $btn  = '<button onclick="modalAction(\'' . url('/employee/' . $employee->id . '/') . '\')" class="btn btn-info btn-sm">Details</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/employee/' . $employee->id . '/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                    $btn .= '<button onclick="modalAction(\'' . url('/employee/' . $employee->id . '/delete_ajax') . '\')" class="btn btn-danger btn-sm">Delete</button>';
                    return $btn;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        $breadcrumb = (object)[
            'title' => 'Employee List',
            'list'  => ['Home', 'Employees']
        ];

        $page = (object)[
            'title' => 'List of registered employees'
        ];

        $activeMenu = 'employee';

        return view('index', compact('breadcrumb', 'page', 'activeMenu'));
    }

    public function create_ajax()
    {
        return view('create_ajax');
    }

    public function store_ajax(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'name' => 'required|string|max:100',
                'salary' => 'required|numeric|min:0',
                'registered_since' => 'required|date',
                'job_position' => 'required|string|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed.',
                    'msgField' => $validator->errors(),
                ]);
            }

            Employee::create($request->all());
            return response()->json([
                'status' => true,
                'message' => 'Employee data saved successfully.'
            ]);
        }

        return redirect('/');
    }

    public function edit_ajax(string $id)
    {
        $employee = Employee::find($id);
        return view('edit_ajax', compact('employee'));
    }

    public function update_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'name' => 'required|string|max:100',
                'salary' => 'required|numeric|min:0',
                'registered_since' => 'required|date',
                'job_position' => 'required|string|max:100'
            ];

            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed.',
                    'msgField' => $validator->errors()
                ]);
            }

            $employee = Employee::find($id);
            if ($employee) {
                $employee->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Employee data updated successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Employee not found.'
                ]);
            }
        }
        return redirect('/');
    }

    public function confirm_ajax(string $id)
    {
        $employee = Employee::find($id);
        return view('confirm_ajax', compact('employee'));
    }

    public function delete_ajax(Request $request, $id)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $employee = Employee::find($id);
            if ($employee) {
                $employee->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Employee deleted successfully.'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Employee not found.'
                ]);
            }
        }

        return redirect('/');
    }

    public function show(string $id)
    {
        $employee = Employee::find($id);

        $breadcrumb = (object)[
            'title' => 'Employee Details',
            'list'  => ['Home', 'Employees', 'Details']
        ];

        $page = (object)[
            'title' => 'Employee details'
        ];

        $activeMenu = 'employee';

        return view('show', [
            'page' => $page,
            'activeMenu' => $activeMenu,
            'employee' => $employee
        ]);
    }
}

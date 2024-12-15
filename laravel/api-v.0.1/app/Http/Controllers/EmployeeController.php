<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    // Get All Data 

    public function index()
    {
        $employees = Employee::all();

        return response()->json($employees);
    }


    // Data Store

    public function store(Request $request)
    {

        try {

            $timeStamp = substr(time(), -5);
            $randomNum = random_int(10, 1000);
            $empId = "EMP" . $timeStamp . $randomNum;

            $validationData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers,email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:100',
                'designation' => 'required|string|max:100',
                'branch' => 'required|string|max:100',
                'salary' => 'required|numeric',
                'join_date' => 'required|date'
            ]);

            $validationData['emp_id'] = $empId;
            Employee::create($validationData);

            return response()->json([
                "status" => "success",
                "message" => "Account created successfully"
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "status" => "error",
                "errors" => $e->errors(),
            ], 422); // HTTP status code for Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => "An unexpected error occurred" . $e->getMessage(),
            ], 500); // HTTP status code for Internal Server Error
        }
    }

    // Show by id
    public function show($id)
    {

        return response()->json([
            "status" => "success",
            "data" => Employee::findOrFail($id)
        ]);
    }

    //Data Updated

    public function update(Request $request)
    {
       
        try {
            $validation = $request::validate([
                'id' => 'required',
                'name' => 'required|string',
                'email' => 'required|email|unique:customer,email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:100',
                'designation' => 'required|string|max:100',
                'branch' => 'required|string|max:100',
                'salary' => 'required|numeric',
                'join_date' => 'required|date',

            ]);
            $id = $request->input("id");
            $check = Employee::find($id);

            if ($check) {
                Employee::update($validation);
                return response()->json([
                    "status" => "Success",
                    "message" => "Account updated"
                ], 200);

            } else {
                return response()->json(["status" => "error", "message" => "Id not found"], 500);
            }
            ;

        } catch (\Illuminate\Validation\ValidationException $e) {

            return response()->json([
                "status" => "error",
                "message" => $e->errors(),
            ], 500);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ], 500);
        }
    }

    //Delete Data
    public function destroy(Request $request)
    {
        try {
            $validation = $request->validation([
                'id' => "required",
                'emp_id' => 'required',
            ]);

            $id = $request->input('id');
            $check = Employee::find($id);

            if ($check) {
                Employee::destroy($validation);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->errors(),
            ]);

        } catch (\Exception $e) {
            return response()->json([
                "status" => "error",
                "message" => $e->getMessage(),
            ]);
        }
    }

    //Id genaretor 

    public function makeId($prefix): string
    {

        $timeStamp = substr(time(), -5);
        $randomNum = random_int(10, 1000);

        return $prefix . $timeStamp . $randomNum;

    }
}

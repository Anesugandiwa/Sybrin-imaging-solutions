<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        // get all employees
        $employees = User::where('role','employee')->get();


        return  Inertia::render('Admin/AllEmployees',[
            'employees' => $employees
        ]);
    }

    public function store(Request $request)
    {
        //Validate required fields

        $request->validate([
            'name'=>'required | min:3 | max:260',
            'email'=>'required | email |unique:users',
        ]);


        $employee = new User();

        $employee->name             = $request->name;
        $employee->email            = $request->email;
        $employee->role             = 'employee';
        $employee->phone            = $request->phone;
        $employee->employee_job_id  = $request->employee_job_id;
        $employee->physical_address = $request->physical_address;
        $employee->national_id      = $request->national_id;
        $employee->nationality      = $request->nationality;

        $employee->password         = Hash::make('Pass_Client_123'); // this will be auto generated and emailed to respective client

        $employee->save();

        return back()->with('message',[
            'title'       => 'Successfully',
            'description' => 'Details saved successfully',
            'type'        => 'success'
        ]);

    }

    public function update(Request $request, User $employee)
    {


        $request->validate([
            'name'=>'required | min:3 | max:260',
            'email'=>'required | email',
        ]);

        $employee->name             = $request->name;
        $employee->email            = $request->email;
        $employee->role             = 'employee';
        $employee->phone            = $request->phone;
        $employee->employee_job_id  = $request->employee_job_id;
        $employee->physical_address = $request->physical_address;
        $employee->national_id      = $request->national_id;
        $employee->nationality      = $request->nationality;

        $employee->save();

        return back()->with('message',[
            'title'       => 'Successfully',
            'description' => 'Details updated successfully',
            'type'        => 'success'
        ]);
    }

    public function destroy($id)
    {

        User::find($id)->delete();

        return back()->with('message',[
            'title'       => 'Successfully',
            'description' => 'Employee Record Deleted',
            'type'        => 'success'
        ]);
    }
}

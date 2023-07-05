<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Http\Request;
use Exception;

class EmployeesController extends Controller
{

    /**
     * Display a listing of the employees.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $employees = Employee::paginate(25);

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new employee.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        
        
        return view('employees.create');
    }

    /**
     * Store a new employee in the storage.
     *
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            Employee::create($data);

            return redirect()->route('employees.employee.index')
                ->with('success_message', 'Employee was successfully added.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    /**
     * Display the specified employee.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $employee = Employee::findOrFail($id);

        return view('employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified employee.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $employee = Employee::findOrFail($id);
        

        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified employee in the storage.
     *
     * @param int $id
     * @param Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, Request $request)
    {
        try {
            
            $data = $this->getData($request);
            
            $employee = Employee::findOrFail($id);
            $employee->update($data);

            return redirect()->route('employees.employee.index')
                ->with('success_message', 'Employee was successfully updated.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified employee from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $employee = Employee::findOrFail($id);
            $employee->delete();

            return redirect()->route('employees.employee.index')
                ->with('success_message', 'Employee was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    
    /**
     * Get the request's data from the request.
     *
     * @param Illuminate\Http\Request\Request $request 
     * @return array
     */
    protected function getData(Request $request)
    {
        $rules = [
                'firstName' => 'required|string|min:1|max:100',
            'lastName' => 'required|string|min:1|max:100',
            'address' => 'nullable|string|min:0|max:200',
            'subdistrictID' => 'nullable|string|min:0|max:6',
            'zipcode' => 'nullable|string|min:0|max:5',
            'mobilePhone' => 'nullable|string|min:0|max:10',
            'homePhone' => 'nullable|string|min:0|max:9',
            'birthdate' => 'nullable|date_format:j/n/Y g:i A',
            'gender' => 'nullable|string|min:0',
            'email' => 'nullable|string|min:0|max:200',
            'username' => 'required|string|min:1|max:100',
            'password' => 'required|string|min:1|max:100',
            'imageFile' => 'nullable|numeric|string|min:0|max:200',
            'positionID' => 'required|string|min:1',
            'isActive' => 'boolean', 
        ];

        
        $data = $request->validate($rules);


        $data['isActive'] = $request->has('isActive');


        return $data;
    }

}

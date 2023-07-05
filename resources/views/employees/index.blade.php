@extends('layouts.app')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <div class="panel panel-default">

        <div class="panel-heading clearfix">

            <div class="pull-left">
                <h4 class="mt-5 mb-5">Employees</h4>
            </div>

            <div class="btn-group btn-group-sm pull-right" role="group">
                <a href="{{ route('employees.employee.create') }}" class="btn btn-success" title="Create New Employee">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </a>
            </div>

        </div>
        
        @if(count($employees) == 0)
            <div class="panel-body text-center">
                <h4>No Employees Available.</h4>
            </div>
        @else
        <div class="panel-body panel-body-with-table">
            <div class="table-responsive">

                <table class="table table-striped ">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Address</th>
                            <th>Subdistrict I D</th>
                            <th>Zipcode</th>
                            <th>Mobile Phone</th>
                            <th>Home Phone</th>
                            <th>Birthdate</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Image File</th>
                            <th>Position I D</th>
                            <th>Is Active</th>

                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->firstName }}</td>
                            <td>{{ $employee->lastName }}</td>
                            <td>{{ $employee->address }}</td>
                            <td>{{ $employee->subdistrictID }}</td>
                            <td>{{ $employee->zipcode }}</td>
                            <td>{{ $employee->mobilePhone }}</td>
                            <td>{{ $employee->homePhone }}</td>
                            <td>{{ $employee->birthdate }}</td>
                            <td>{{ $employee->gender }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->username }}</td>
                            <td>{{ $employee->password }}</td>
                            <td>{{ $employee->imageFile }}</td>
                            <td>{{ $employee->positionID }}</td>
                            <td>{{ ($employee->isActive) ? 'Yes' : 'No' }}</td>

                            <td>

                                <form method="POST" action="{!! route('employees.employee.destroy', $employee->empID) !!}" accept-charset="UTF-8">
                                <input name="_method" value="DELETE" type="hidden">
                                {{ csrf_field() }}

                                    <div class="btn-group btn-group-xs pull-right" role="group">
                                        <a href="{{ route('employees.employee.show', $employee->empID ) }}" class="btn btn-info" title="Show Employee">
                                            <span class="glyphicon glyphicon-open" aria-hidden="true"></span>
                                        </a>
                                        <a href="{{ route('employees.employee.edit', $employee->empID ) }}" class="btn btn-primary" title="Edit Employee">
                                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                        </a>

                                        <button type="submit" class="btn btn-danger" title="Delete Employee" onclick="return confirm(&quot;Click Ok to delete Employee.&quot;)">
                                            <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        </button>
                                    </div>

                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="panel-footer">
            {!! $employees->render() !!}
        </div>
        
        @endif
    
    </div>
@endsection
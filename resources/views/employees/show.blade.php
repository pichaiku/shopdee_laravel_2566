@extends('layouts.app')

@section('content')

<div class="panel panel-default">
    <div class="panel-heading clearfix">

        <span class="pull-left">
            <h4 class="mt-5 mb-5">{{ isset($title) ? $title : 'Employee' }}</h4>
        </span>

        <div class="pull-right">

            <form method="POST" action="{!! route('employees.employee.destroy', $employee->empID) !!}" accept-charset="UTF-8">
            <input name="_method" value="DELETE" type="hidden">
            {{ csrf_field() }}
                <div class="btn-group btn-group-sm" role="group">
                    <a href="{{ route('employees.employee.index') }}" class="btn btn-primary" title="Show All Employee">
                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                    </a>

                    <a href="{{ route('employees.employee.create') }}" class="btn btn-success" title="Create New Employee">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    </a>
                    
                    <a href="{{ route('employees.employee.edit', $employee->empID ) }}" class="btn btn-primary" title="Edit Employee">
                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                    </a>

                    <button type="submit" class="btn btn-danger" title="Delete Employee" onclick="return confirm(&quot;Click Ok to delete Employee.?&quot;)">
                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                    </button>
                </div>
            </form>

        </div>

    </div>

    <div class="panel-body">
        <dl class="dl-horizontal">
            <dt>First Name</dt>
            <dd>{{ $employee->firstName }}</dd>
            <dt>Last Name</dt>
            <dd>{{ $employee->lastName }}</dd>
            <dt>Address</dt>
            <dd>{{ $employee->address }}</dd>
            <dt>Subdistrict I D</dt>
            <dd>{{ $employee->subdistrictID }}</dd>
            <dt>Zipcode</dt>
            <dd>{{ $employee->zipcode }}</dd>
            <dt>Mobile Phone</dt>
            <dd>{{ $employee->mobilePhone }}</dd>
            <dt>Home Phone</dt>
            <dd>{{ $employee->homePhone }}</dd>
            <dt>Birthdate</dt>
            <dd>{{ $employee->birthdate }}</dd>
            <dt>Gender</dt>
            <dd>{{ $employee->gender }}</dd>
            <dt>Email</dt>
            <dd>{{ $employee->email }}</dd>
            <dt>Username</dt>
            <dd>{{ $employee->username }}</dd>
            <dt>Password</dt>
            <dd>{{ $employee->password }}</dd>
            <dt>Image File</dt>
            <dd>{{ $employee->imageFile }}</dd>
            <dt>Position I D</dt>
            <dd>{{ $employee->positionID }}</dd>
            <dt>Is Active</dt>
            <dd>{{ ($employee->isActive) ? 'Yes' : 'No' }}</dd>

        </dl>

    </div>
</div>

@endsection
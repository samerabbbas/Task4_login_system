
@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-4">
        <div class="card-header">
            Employee Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name:  {{$employeeshow->name }}</h5>
            <p class="card-text">Email: {{$employeeshow->email}}</p>
            <p class="card-text">Date of Start: {{$employeeshow->date_of_start}} </p>
            <p class="card-text">Salary: {{$employeeshow->salary}} </p>
            <p class="card-text">Created By: {{$employeeshow->user ? $employeeshow->user->name : 'not found'}} </p>
        </div>
            <!-- <h5 class="card-title">Name:  {{$employeeshow->employee ? $employeeshow->employee->name : ' not found'}}</h5>
            <p class="card-text">Email: {{$employeeshow->employee ? $employeeshow->employee->email: ' not found'}}</p>
            <p class="card-text">Role: {{$employeeshow->employee ? $employeeshow->employee->is_admin: ' not found'}} </p>
            <p class="card-text">Created At: {{$employeeshow->employee ? employeeshow->employee->created_at: ' not found'}} </p>
        </div> -->
    </div>
@endsection

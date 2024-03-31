@extends('layouts.app')
@section('title') Index @endsection
@section('content')
           
 
<header class="d-flex justify-content-between my4"> </header>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-4" style="background-color: #00ff5573">
        Employee List        
  </nav>

</nav  >
<header class="d-flex justify-content-between my4"> </header>
<nav style="background-color: #00ff5573">
  <form action="{{route('user.showMulti')}}" method ="POST">
    @csrf
    <input type="text" autocomplete="off" name="search" class="input mb-2" placeholder="Enter Employee Name.."> 
    <input type="submit" autocomplete="off" name="text" class="btn btn-success" placeholder="Enter " value="Search"> 
  </form>
</nav> 

</header>



<table class="table table-success table-striped">
  <thead>
    <tr>
      <th scope="col">N.</th>
      <th scope="col">Name</th>
      <th scope="col">E-Mail</th>
      <th scope="col">Date oF Start</th>
      <th scope="col">Salary</th>
      <th scope="col">Created By</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <tr>
    @php ($i = 0)
   
          @foreach($employees as $employee)
              <td> {{++$i}}</td>

              <td>{{$employee->name}}</td>

              <td>{{$employee->email}}</td>

              <td>{{$employee->date_of_start}}</td>

              <td>{{$employee->salary}}</td>

              <td>{{$employee->user ? $employee->user->name : 'not found'}}</td>
                 
              <td>
                <a href="{{route('admin.show',$employee->id)}} " class="btn btn-info">Read More</a>     
            </td>
            </tr>
          @endforeach
  </tbody>
</table>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif  

@endsection


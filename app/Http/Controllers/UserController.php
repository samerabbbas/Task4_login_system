<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('login');
    }
    public function index()
    {
        //Read data from DataBase
        $allfromDB = Employee::all();//Collection of objects
       // $allfromDB = Employee::select('name', 'salary', 'date_of_start')->find(3);

      // @dd( $items);
        return view('user.index',['employees' => $allfromDB ]); 
    }



    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('user.show',['employeeshow'=> $employee]);
    }

    public function showMulti(Request $request)
    {
        $employees_search = Employee::where('name','LIKE','%'.$request->search.'%')->get();
        $users = User::all();
        return view('user.index' , ["employees"=>$employees_search,"users"=>$users]) ;
    }


}

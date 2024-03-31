<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('login');
    }
    
    public function index()
    {
        //Read data from DtaBase
        $allfromDB = Employee::all();//Collection of objects
        $users = User::all();
        return view('admin.index',['employees' => $allfromDB ],['users'=> $users]); 
    }


    public function show(Employee $employee)
    {
        //All the below is a way to fetch Row from DB(SELECT * From  WHERE id= '')
        //get the id of the row
        //$sigleemployee = employee::find($id);//sigle object(model object)
        //$single = employee::where('id',$id)->first();
        //$single = employee::where('id',$id)->get();
        //  @dd($sigleemployee);
        return view('admin.show',['employeeshow'=> $employee]);
    }

    public function create()
    {
        //select * from employees;
        $employees = Employee::all();
        $users = User::all();

        return view('admin.create', ['employees' => $employees],['users'=> $users]);
    } 
    public function create_Admin()
    {
        $employees = Employee::all();
        $users = User::all();

        return view('admin.createAdmin', ['employees' => $employees],['users'=> $users]);
    } 


    public function store()
    {
        
        $data = request()->all();
        //2.store the data in datatbase
        $dbemployee = new Employee();

        $dbemployee ->name = $data['name'];
        $dbemployee ->address = $data['address'];
        $dbemployee ->date_of_start = $data['date_of_start'];
        $dbemployee ->salary = $data['salary'];
       
        $dbemployee->user_id = $data['employee_creator']; 

        $dbemployee->save();

        //3.redirict to employee.index
        return to_route('admin.index');
    }


    public function stroe_Admin(Request $data,User $dbemployee)
    {
        //2.store the data in datatbase
        $dbemployee ->name = $data['name'];
        $dbemployee ->email = $data['email'];
        $dbemployee ->password = Hash::make($data['password']); 
        $dbemployee->is_admin = 1; 

        $dbemployee->save();

        //3.redirict to employee.index
        return to_route('admin.index');
    }



    public function edit(Employee $employee)
    {
        //select * from employees;
        // $employees = Employee::all();
        $users = User::all();

        return view ('admin.edit',['users'=> $users],['employee'=> $employee]);
    }

    public function edit_Admin(User $user)
    {
        
        return view ('admin.editAdmin',['user'=> $user]);
    }

    public function update($id,Request $request)
    {
        //1.get employee data from the form
        //$data = request()->all();
        
        //3. get the data from DB
        $oldData = Employee::find($id);
        //4.update the data in datatbase
        $oldData  ->name = $request->name; //$data['name'];
        $oldData  ->address =  $request->address;
        $oldData  ->date_of_start =  $request->date_of_start; 
        $oldData ->salary =  $request->salary; 
        $oldData->user_id = $request->employee_creator; 
        
        $oldData->update();

        //3.redirict to employee.show
        return to_route('admin.index');
    }

    public function update_Admin($id,Request $request)
    {
        //1.get the old record from DB
        $old_data = User::find($id);
        
        //4.update the data in datatbase
        $old_data  ->name = $request->name; 
        $old_data  ->email =  $request->email;
        if($request->password != null) $old_data  ->password =  Hash::make($request['password']); 
        
        $old_data->update();
        
        return to_route('admin.index')->with('success', "You  Have Edit the Admin ($old_data->name) Info Successfully :) ");

    }


    
    public function destroy($id)
    {        
       
            //1 -select or find the post
            $employee =Employee::find($id);
            //chk if the employee is last employee in DataBase
            if(Employee::count() == 1 )
                {   Session::flash('message', "Its Not Godd Idea To Delete all Employees!!");
                    return Redirect::back();
                }
            //3- delete the post from database
            $employee->delete();

        // employee::where('id', $id)->delete();
       
        return to_route('admin.index');
    }


    public function destroy_Admin($id)
    {
        $user_Destroy = User::find($id);
       // $name_of_admin = $user_Destroy->name;
        if(User::count() == 1 )
        {   Session::flash('message1', "Its Not Godd Idea To Delete all Admens!!");
            return Redirect::back();
        }
        $user_Destroy->delete();

        return to_route('admin.index')->with('successDelete', "You  Have Deleted the Admin ($user_Destroy->name  Successfully :) ");
    }

    public function showMulti(Request $request)
    {
        $employees_search = Employee::where('name','LIKE','%'.$request->search.'%')->get();
        $users = User::all();
      
        return view('admin.index' , ["employees"=>$employees_search,"users"=>$users]) ;
    }

}

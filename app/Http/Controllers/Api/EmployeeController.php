<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $employee= Employee::all();
        return response()->json($employee);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'name' => 'required|unique:employees|max:255',
            'email' => 'required',
            'phone' => 'required|unique:employees',
        ]);

        if($request->photo) {
            // This takes the position of the image ending with the semi colon in the front end of the console log after the image has been uploaded 
            $position = strpos($request->photo, ';');
            // Take data:image/jpeg;base64
            $sub = substr($request->photo, 0, $position);
            // remove the delimeter /
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($request->photo)->resize(240, 200);
            $upload_path = 'backend/employee/';
            $image_url= $upload_path.$name;
            $img->save($image_url);

            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->salary = $request->salary;
            $employee->address = $request->address;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->photo= $image_url;
            $employee->save();
            return response()->json(['message' => 'Employee Details Added Successfully With Image']);
        }else{
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->salary = $request->salary;
            $employee->address = $request->address;
            $employee->nid = $request->nid;
            $employee->joining_date = $request->joining_date;
            $employee->save();
            return response()->json(['message' => 'Employee Detail Added Successfully']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = array();
        $data['name'] =         $request->name;
        $data['email'] =        $request->email;
        $data['phone'] =        $request->phone;
        $data['salary'] =       $request->salary;
        $data['address'] =      $request->address;
        $data['nid'] =          $request->nid;
        $data['joining_date'] = $request->joining_date;
        $image = $request->newphoto;
        
        if($image){
            $position = strpos($image, ';');
            $sub = substr($image, 0, $position);
            $ext = explode('/', $sub)[1];

            $name = time().".".$ext;
            $img = Image::make($image)->resize(240, 200);
            $upload_path = 'backend/employee/';
            $image_url = $upload_path.$name;
            $success =  $img->save($image_url);
            
            if($success){
                $data['photo'] = $image_url;
                $img = DB::table('employees')->where('id', $id)->first();
                $image_path = $img->photo;
                $done = unlink($image_path);
                $user = DB::table('employees')->where('id', $id)->update($data);
                return response()->json(['message'=>'Employee Info and New Image Updated Successfully']);
            }
        }else{
            $oldphoto = $request->photo;
            $data['photo'] = $oldphoto;
            $user= DB::table('employees')->where('id', $id)->update($data);
            return response()->json(['message' => 'Employee Info Updated Successfully']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = DB::table('employees')->where('id', $id)->first();
        $photo = $employee->photo;
        if($photo){
            unlink($photo);
            DB::table('employees')->where('id', $id)->delete();
        }else{
            DB::table('employees')->where('id', $id)->delete();
        }
    }
}

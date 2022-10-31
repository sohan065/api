<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    // get method for view all user  from data base
    public function index($id = null)
    {
        if ($id == null) {

            $users = User::get();

            return response()->json(['users' => $users], 200);
        } else {

            $users = User::find($id);

            return response()->json(['users' => $users], 201);
        }
    }
    // post method for add single user 
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {

            $inputs = $request->all();

            $rules = [

                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ];


            $message = [
                'name.required' => 'Name is required !',
                'email.required' => 'Email is required !',
                'password.required' => 'Password is required'

            ];

            $validator = Validator::make($inputs, $rules, $message);
            if ($validator->fails()) {

                return response()->json($validator->errors(), 422);
            }

            $user = new User();
            $user->name = $inputs['name'];
            $user->email = $inputs['email'];
            $user->password = $inputs['password'];

            $user->save();
            $message = 'registration seccessfully';
            return response()->json(['message' => $message], 201);
        }
    }

    // post method for add multiple user 
    public function addMultipleUser(Request $request)
    {
        if ($request->isMethod('post')) {

            $inputs = $request->all();

            $rules = [
                'users.*.name' => 'required',
                'users.*.email' => 'required|email',
                'users.*.password' => 'required'
            ];

            $message = [
                'users.*.name.required' => 'Name is required !',
                'users.*.email.required' => 'Email is required !',
                'users.*.password.required' => 'Password is required'

            ];

            $validator = Validator::make($inputs, $rules, $message);
            if ($validator->fails()) {

                return response()->json($validator->errors(), 422);
            }

            foreach ($inputs['users'] as $inputs) {

                $user = new User();
                $user->name = $inputs['name'];
                $user->email = $inputs['email'];
                $user->password = $inputs['password'];

                $user->save();
                $message = 'registration seccessfully';
            }
            return response()->json(['message' => $message], 201);
        }
    }

    //put method for update user multiple information 
    public function updateUser(Request $request, $id)
    {
        if ($request->isMethod('PUT')) {

            $inputs = $request->all();

            $rules = [

                'name' => 'required',
                'password' => 'required'
            ];


            $message = [
                'name.required' => 'Name is required !',
                'password.required' => 'Password is required'

            ];

            $validator = Validator::make($inputs, $rules, $message);
            if ($validator->fails()) {

                return response()->json($validator->errors(), 422);
            }

            $user = User::findOrFail($id);
            $user->name = $inputs['name'];
            $user->password = $inputs['password'];

            $user->save();
            $message = 'update  seccessfully';
            return response()->json(['message' => $message], 202);
        }
    }
    // patch method for update user single information 
    public function updateUserSingleData(Request $request, $id)
    {
        if ($request->isMethod('patch')) {

            $inputs = $request->all();

            $rules = [

                'name' => 'required'

            ];


            $message = [
                'name.required' => 'Name is required !'


            ];

            $validator = Validator::make($inputs, $rules, $message);
            if ($validator->fails()) {

                return response()->json($validator->errors(), 422);
            }

            $user = User::findOrFail($id);
            $user->name = $inputs['name'];


            $user->save();
            $message = 'update  seccessfully';
            return response()->json(['message' => $message], 202);
        }
    }
    //delete method for delete single user by id 

    public function delete($id)
    {
        User::findOrFail($id)->delete();
        $message = "delete successfully ";
        return response()->json(['message' => $message], 200);
    }
    //delete method for delete single user by Json
    public function deleteByJson(Request $request)
    {
        $data = $request->all();
        User::where('id', $data['id'])->delete();
        $message = "delete successfully ";
        return response()->json(['message' => $message], 200);
    }
    // delete method for delete multiple user by json
    public function multipleUserDeleteByJson(Request $request)
    {
        if ($request->isMethod('delete')) {

            $data = $request->all();

            User::where('id', $data['ids'])->delete();

            $message = "delete successfully ";
            return response()->json(['message' => $message], 200);
        }
    }
}

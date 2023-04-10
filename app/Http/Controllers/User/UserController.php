<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Exception;
use Illuminate\Validation\Validator;

class UserController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try{
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];

        $message =  [ 
            'name.required'=> 'Name can not be empty !',
            'email.required'=> 'Email can not be empty !',
            'password.required'=> 'Password can not be empty !'            
            ];

        // $validator = \Validator::make($request->all(), $rules, $message );
            

        // if ($validator->fails()) {
        //     throw new \Exception(json_encode($validator->errors()->all()));
        // }

        $data = $request->all();

        $data['password'] = bcrypt($request->paasword);
        $data['verified'] = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVarificationCode();
        $data['admin'] = User::REGULAR_USER;       
        $users = User::create($data);
        return response()->json(['data' => $users, 201]);

    }catch(\Exception $e){
        return $e->getMessage();
        //throw new \Exception(json_encode($e->getMessage()));
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
       // $users = User::findOrFail($id);  
        return $this->showOne($user);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $users = User::findOrFail($id);


        $rules = [
            'email' => 'required|email|unique:users|email' . $users->$id,
            'password' => 'required|min:6|confirmed',
            'admin' => 'in:' . User::ADMIN_USER . ',' . User::REGULAR_USER
        ];

        // $this->validate($request, $rules);



        if ($request->has('name')) {
            $users->name = $request->name;
        }

        if ($request->has('email') && $users->email != $request->email) {
            $users->verified = User::UNVERIFIED_USER;
            $users->verification_token = User::generateVarificationCode();
            $users->email = $request->email;
        }

        if ($request->has('password')) {
            $users->password = bcrypt($request->password);
        }

        if ($request->has('admim')) {

            if (!$users->isVerified()) {
            return $this->errorResponse('Only Verified user can modify the admin field', 409);
            }
            $users->admin = $request->admin;
        }

        if (!$users->isDirty()) {           
            return $this->errorResponse('You need to specify the different value to change', 422);
        }

        $users->save();
    
        return $this->showAll($users);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $users = User::findOrFail($id);
        $users->delete();
        return $this->showOne($users);
    }

    public function verified($token){
        $users = User::where('verification_token',$token)->get()->firstOrFail();
        $users->verified=User::VERIFIED_USER;
        $users->verification_token=null;
        $users->save();
        return $this->showMessage('The account has been verified sucessfylly');
    }
}

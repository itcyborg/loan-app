<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Notifications\UserCreated;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    use SendsPasswordResetEmails;
    /**
     * Display a listing of the resource.
     *
     * @param \App\DataTables\UsersDataTable $dataTable
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('superadministrator.users',['roles'=>Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required|email:rfc',
            'role'=>'required'
        ]);
        try {
            $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
            $password = substr($random, 0, 10);
            $data=[
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($password)
            ];
            $user=User::create($data);
            $user->removeRole('superadministrator');
            $user->removeRole('administrator');
            $user->removeRole('user');
            $user->assignRole($request->role);
            $mail=$data;
            $mail['password_raw']=$password;
            $mail=json_decode(json_encode($mail));
            Notification::route('mail',$data['email'])->notify(new UserCreated($mail));
            return redirect()->route('users.index');
        }catch (\Throwable $e){
            return $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $user=User::with('roles')->find($id);
        $roles=Role::all();
        return response()->json(['user'=>$user,'roles'=>$roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user=User::findOrFail($id);
        $role=$user->roles[0]->name;
        $user->update($request->all());
        $user->removeRole($role);
        $user->assignRole($request->role);

        if($user->save()){
            return response()->json('User has been successfully updated',200);
        }
        return response()->json('User update failed',401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return User::findOrFail($id)->destroy();
    }

    public function actions(Request $request)
    {
        $this->validate($request,[
            '
}id'=>'required',
            'action'=>'required'
        ]);
        $user=User::findOrFail($request->id);
        if($user){
            if($request->action==='reset_password'){
                $request->request->add(['email'=>$user->email]);
                $response=$this->sendResetLinkEmail($request);
                return $response;
            }
        }
    }
}

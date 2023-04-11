<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Redirect;
use Log;

class UsersAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $search = $request->get('search');
        if(isset($search)){
            $user = User::where('name', 'like', '%'.$search.'%')->paginate(10);
        }else
            $user = User::paginate(10);

        return view('admin.user.list', compact('user','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'store';
        return view('admin.user.form',compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        request()->validate([
            'name'   => 'required',
            'password'   => 'required',
        ]);

        DB::beginTransaction();
        try {
            $data = $request->only(['name']);
            $data['password'] = Hash::make($request->password);
            
            $user = User::create($data);
            DB::commit();

            return redirect('/adminpanel/users')->with('info', 'User berhasil ditambahkan');
            
        } catch (\Exception $e) {
            DB::rollback();
            Log::Error($e->getMessage());
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Tambah User gagal, silahkan coba kembali.']);
            // something went wrong
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $action = 'update';
        return view('admin.user.form',compact('user','action'));
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
        request()->validate([
            'name'   => 'required',
        ]);

        $user = User::find($request->id);
        if($user){

            DB::beginTransaction();
            try {
                $data = $request->only(['name']);
                if(isset($request->password)){
                    $data['password'] = Hash::make($request->password);
                }
                $user = User::where('id',$user->id)->update($data);
                
                DB::commit();
                return redirect('/adminpanel/users')->with('info', 'User berhasil di update');
                
            } catch (\Exception $e) {
                DB::rollback();
                Log::Error($e->getMessage());
                return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Update User gagal, silahkan coba kembali.']);
                // something went wrong
            }
        }else{
            return Redirect::back()->withInput($request->input())->withErrors(['error'=> 'Data User tidak ditemukan.']);
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
        $user = User::find($id);
        $post = Post::where('created_by',$id)->get();
        if($user && $post->count() <= 0){
            User::where('id',$user->id)->delete();
            return redirect('/adminpanel/users')->with('info', 'User berhasil di delete.');
        }else{
            return Redirect::back()->withErrors(['error'=> 'Data User tidak ditemukan atau sedang dipakai.']);
        }
    }
}

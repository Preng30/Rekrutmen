<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function edit($id)
    {
        $user=User::find($id);
        return view('user.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();

        if ($id != $user->id) {
            return back()->with('error','Gak Boleh');
        }

        $data = User::findOrFail($id);
        
        $data->nama_depan = $request->nama_depan;
        $data->nama_belakang = $request->nama_belakang;
        $data->hp = $request->hp;

        if($request->hasFile('foto')) {
            $foto_name = Str::random(16).".".$request->file('foto')->getClientOriginalExtension();
            $request->file('foto')->move('image/user/', $foto_name);
            $data ->foto = $foto_name;
        }
        
        $data->save();

        return redirect('/home')->with(['success' => 'Data berhasil disimpan']);

    }
}

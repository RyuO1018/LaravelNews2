<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Profile;
use App\ProfileHistory;

use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        //Varidation
        $this->validate($request, Profile::$rules);
        
        $profile = new Profile;
        $form = $request->all();
        
        //_token削除
        unset($form['_token']);
        
        //データベースへの保存
        $profile->fill($form);
        $profile->save();
        
        return redirect('admin/profile/create');
    }

    public function edit(Request $request)
    {
        //Profile Modelからデータを取得
        $profile = Profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['profile_form' => $profile]);
    }

    public function update(Request $request)
    {
        //Varidationをかける
        $this->validate($request, Profile::$rules);
        //Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        //送信されてきたフォームデータを格納する
        $profile_form = $request->all();
        unset($profile_form['_token']);
        
        //該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();
        
        $profilehistory = new ProfileHistory;
        $profilehistory->profile_id = $profile->id;
        $profilehistory->edited_at = Carbon::now();
        $profilehistory->save();
        
        return redirect('admin/profile/edit');
    }
}

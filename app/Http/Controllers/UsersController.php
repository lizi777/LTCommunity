<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Klasse;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;
use Auth;
use Mail;

class UsersController extends Controller
{
    public function show(User $user)
    {
    	return view('users.show',compact('user'));
    }
    public function edit(User $user)
    {
    	$this->authorize('update', $user);
    	return view('users.edit',compact('user'));
    }
    public function update(UserRequest $request,ImageUploadHandler $uploader,User $user)
    {
        // dd(Auth::id());
    	$this->authorize('update', $user);
    	$data = $request->all();
    	if($request->avatar){
    		$result = $uploader ->save1($request->avatar,'avatars',$user->id,362,362);
    		if($result){
    			$data['avatar'] = $result['path'];
    		}
    	}
        // if ($request->password) {
        //     $data->password = bcrypt($request->password);
        // }
    	$user->update($data);
    	return redirect()->route('users.show',$user->id)->with('success','个人资料更新成功！');
    }

    public function create()
    {

        $areas = Area::with('klasses')->get();
         // dd($areas);
        return view('users.create',compact('areas'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6',
            'area_id' => 'required',
            'class_id' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'area_id' => $request->area_id,
            'class_id' => $request->class_id,
            'avatar' => config('app.url').'/uploads/default/default.jpg',
            'password' => bcrypt($request->password),
        ]);

        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');
        //$user->setConnection('mysql1');
        // Auth::login($user);
        // $request->session()->flash('success','欢迎加入蓝天校区，希望您能在这里获得更好的学习体验！');

        // return redirect()->route('users.show', [$user]);
    }

    public function classes(){  
       $area_id=$_POST['area']; 
       $classes=Klasse::where("area",$area_id)->get(); //查询出来校区对应的班级 

       return json_encode($classes);  
    }  

    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $to = $user->email;
        $subject = "感谢注册 蓝天教育社区 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($to, $subject) {
            $message->to($to)->subject($subject);
        });

    }

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    //未登录用户只能进入show界面...
    public function __construct()
    {
    	$this->middleware('auth',['except' => ['show','create','classes','store','confirmEmail']]);
    }


}

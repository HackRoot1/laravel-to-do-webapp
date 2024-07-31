<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
    // This method will show login page
    public function login() {
        return view('login');
    }
    
    // This method will show register page
    public function register() {
        return view('register');
    }

    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required|min:3',
            'lastName' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'username' => 'required|min:3',
            'password' => 'required|min:5'
        ]);

        if($validator->fails()) {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }

        $user = new User();
        $user->name = $request->firstName . " " . $request->lastName;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('account.login')->with('success', 'You have registered successfully.');
    }


    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('account.login')->withInput()->withErrors($validator);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('account.profile');
        } else {
            return redirect()->route('account.login')->with('error', 'Either email/password is incorrect.');
        }
    }


    public function profile() {
        $totalTasks = Tasks::get();
        $tasks = Tasks::where('user_id', Auth::id())->where('task_status', '==', 0)->orderBy('created_at', 'DESC')->get();
        $user = User::find(Auth::user()->id);
        return view('user.profile', ['user' => $user, 'tasks' => $tasks, 'totalTasks' => $totalTasks]);
    }

    public function addTask() {
        return view('user.add-task');
    }

    public function addTaskData(Request $request) {
        $validator = Validator::make($request->all(), [
            'task_title' => 'required|min:3',
            'task_description' => 'required|min:10',
            'due_date' => 'required|date',
            'category' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->route('account.add.task')->withInput()->withErrors($validator);
        }

        $tasks = new Tasks();
        $tasks->user_id = Auth::user()->id;
        $tasks->task_title = $request->task_title;
        $tasks->task_description = $request->task_description;
        $tasks->task_due_date = $request->due_date;
        $tasks->task_category = $request->category;
        $tasks->save();

        return redirect()->route('account.view.task')->with('success', 'New Task Added.');
    }

    public function updateTaskData(Request $request) {
        $validator = Validator::make($request->all(), [
            'task_title' => 'required|min:3',
            'task_description' => 'required|min:10',
            'due_date' => 'required|date',
            'category' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->route('ccount.task.edit')->withInput()->withErrors($validator);
        }

        $tasks = Tasks::findOrFail($request->task_id);
        $tasks->task_title = $request->task_title;
        $tasks->task_description = $request->task_description;
        $tasks->task_due_date = $request->due_date;
        $tasks->task_category = $request->category;
        $tasks->save();

        return redirect()->route('account.view.task')->with('success', 'Task updated successfully.');
    }


    public function viewTask(Request $request) {
        $tasks = Tasks::where('user_id', Auth::id());

        $status = ['status' => 'none'];
        if(!empty($request->task_status) || $request->task_status == "0") {
            $status = ['status' => $request->task_status];
            $tasks = $tasks->where('task_status', $request->task_status);
        }

        $tasks = $tasks->orderBy('created_at', 'DESC')->get();

        // Pass the tasks to the view
        return view('user.view-task', ['tasks' => $tasks, 'status' => $status]);
    }
    
    public function editTask($id) {
        $tasks = Tasks::findOrFail($id);
        return view('user.edit-task', ['tasks' => $tasks]);
    }

    public function makeTaskComplete($id, Request $request) {

        $tasks = Tasks::findOrFail($id);

        $tasks->task_status = 1;
        $tasks->save();

        session()->flash('success', 'Task has been completed.');
        return redirect()->route('account.view.task');
    }

    public function deleteTask($id) {
        $task = Tasks::findOrFail($id);

        if($task == null) {
            session()->flash('error', 'Task nor found');
            return redirect()->route('account.view.task', ['success' => 'Task deleted successfully.']);
        } else {
            $task->delete();
            session()->flash('success', 'Task deleted successfully.');
            return redirect()->route('account.view.task', ['success' => 'Task deleted successfully.']);
        }
    }


    public function settings() {
        $user = User::find(Auth::user()->id);
        return view('user.settings', ['user' => $user]);
    }

    public function updateSettings(Request $request) {
        
        $rules = [
            'firstName' => 'required|min:3',
            'lastName' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.Auth::user()->id.',id',
            'username' => 'required|min:3',
        ];

        if(!empty($request->profile)) {
            $rules['profile'] = 'image';
        }

        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }

        // save book in database 
        $user = User::find(Auth::user()->id);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->email = $request->email;
        $user->username = $request->username;

        if(!empty($request->profile)) {
            // $image = $request->file('image');
            
            $image = $request->profile;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . "." . $ext;
            $image->move(public_path('uploads'), $imageName);
            
            $user->profile = $imageName;
        }

        $user->save();

        return redirect()->route('account.settings')->with('success', 'Profile updated successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login');
    }

}

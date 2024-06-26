<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\CnfFood;
use App\Models\TrainingPlan;
use Illuminate\Http\Request;
use App\Models\CnfFoodMeasure;
use Illuminate\Validation\Rule;
use App\Models\CnfConversionFactor;

class UserController extends Controller
{
  public function create()
  {
    return view('users.create');
  }

  public function store(Request $request)
  {
    $formFields = $request->validate([
      'name' => ['required', 'min:3'],
      'email' => ['required', 'email', Rule::unique('users'), 'email'],
    ]);

    $formFields['password'] = bcrypt($formFields['password']);
    $user = User::create($formFields);
    auth()->login($user);
    return redirect('/')->with('notification', 'User created and logged in');
  }

  public function index()
  {
    if (request('search')) {
      $users = User::where('name', 'like', '%' . request('search') . '%')->orWhere('email', 'like', '%' . request('search') . '%')->get();
    } else {
      if (auth()->user()->hasRole('Trainer')) {
        $users = User::where('trainer_id', auth()->user()->id)->get();
      } else if (auth()->user()->hasRole('Admin')) {
        $users = User::orderBy('name', 'ASC')->get();
      }
    }
    return view('users.index', ['users' => $users]);
  }

  public function show(User $user)
  {
    $trainingPlans = $user->trainingPlans;
    $nutritionPlans = $user->nutritionPlans;
    return view('users.show', ['user' => $user, 'trainingPlans' => $trainingPlans, 'nutritionPlans' => $nutritionPlans]);
  }

  //Show login form
  public function login()
  {
    return view('users.login');
  }


  public function logout(Request $request)
  {
    auth()->user()->tokens()->delete();
    auth()->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
  }

  //Authenticate user
  public function authenticate(Request $request)
  {
    $formFields = $request->validate([
      'email' => 'required|string',
      'password' => 'required',
    ]);

    if (auth()->attempt($formFields)) {
      $user = User::where('email', $formFields['email'])->first();
      $request->session()->regenerate();
      $user->createToken('myapptoken')->plainTextToken;
      if ($user->hasRole('Trainer')) {
        return redirect("/user/index");
      } else {
        return redirect("/user/{$user->id}");
      }
    }

    return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
  }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Code;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }

        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $referrer = new User;
        if (session()->has('referrer')) {
            $referrer = User::where('refer_code', session()->pull('referrer'))->first();
        }


        $request->merge(['refer_code' => Str::random(10)]);
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required'],
            'refer_code' => ['required', 'unique:users,refer_code'],
            'aff_code' => ['nullable', Rule::exists('codes', 'gen_code')
                ->where(function ($q) {
                    $q->where('user_registered', null);
                })]
        ]);

        $code = new Code;
        $referrer_id = null;
        if ($referrer->exists) {
            $referrer_id = $referrer->id;
        } else if (isset($request->aff_code)) {
            $code = Code::where('gen_code', $request->aff_code)->first();
            $referrer_id = $code->user_id;
        }
        // dd([$referrer, $referrer_id]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'refer_code' => $request->refer_code,
            'referrer_id' => $referrer_id,
        ]);
        if ($code->exists) {
            $code->update([
                'user_registered' => $user->id
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}

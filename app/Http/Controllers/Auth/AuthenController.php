<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Repositories\Interfaces\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthenController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->middleware('auth', ['only' => 'logout']);
        $this->userRepository = $userRepository;
    }

    /*
     * Show Login form
     *
     * @return view
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /*
     * Show Register form
     *
     * @return view
     */
    public function showRegister()
    {
        return view('auth.register');
    }

    /**
     * Do login when user submit form
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function doLogin(Request $request)
    {
        $credentials = [
            'email' => $request['email'],
            'password' => $request['password'],
        ];
        if (\Auth::attempt($credentials)) {
            $userStatus = \Auth::user()->isActive();
            if ($userStatus) {
                toastr()->success(__('messages.success', ['name' => 'Login']));

                return redirect()->route('home');
            } else {
                toastr()->error(__('messages.inactive'));

                return redirect()->back()->withInput();
            }

        }
        toastr()->error(__('messages.login_error'));

        return redirect()->back()->withInput();
    }

    /**
     * Do register user when submit form
     *
     * @param UserRequest $request
     * @return RedirectResponse
     */
    public function doRegister(UserRequest $request)
    {
        $data = $request->all();
        $this->userRepository->create($data);
        if (\Auth::attempt($request->only('email', 'password'))) {
            toastSuccess(__('messages.success', ['name' => 'Register']));

            return redirect()->route('home');
        }

        return redirect()->back()->withInput();
    }

    /**
     * Log out user
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request)
    {
        \Auth::logout();

        return redirect()->route('login.show');
    }
}

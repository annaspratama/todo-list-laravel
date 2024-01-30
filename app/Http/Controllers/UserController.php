<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    private UserService $userService;

    /**
     * @param UserService $userService
     */
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Displaying login page.
     * 
     * @return Response
     */
    public function login(): Response
    {
        return response()
            ->view('user.login', [
                'title' => "Login"
            ]);
    }

    /**
     * Logging in the user.
     * 
     * @param Request $request
     * @return Response|RedirectResponse
     */
    public function doLogin(Request $request): Response|RedirectResponse
    {
        $user = $request->input(key: 'username');
        $password = $request->input(key: 'password');

        // validate input
        if (empty($user) || empty($password)) {
            return response()->view(view: 'user.login', data: [
                'title' => "Login",
                'error' => "Username or password is required"
            ]);
        }

        if ($this->userService->login(username: $user, password: $password)) {
            $request->session()->put(key: 'username', value: $user);
            return redirect(to: '/');
        }

        return response()->view(view: 'user.login', data: [
            'title' => "Login",
            'error' => "Username or password is wrong"
        ]);
    }

    /**
     * Logging out the user.
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function doLogout(Request $request): RedirectResponse
    {
        $request->session()->forget(keys: 'username');
        return redirect(to: '/login');
    }
}

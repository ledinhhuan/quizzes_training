<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepository;
use Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function __construct(UserRepository $userRepository
    )
    {
        $this->userRepository = $userRepository;
    }

    /**
     * get list user and route to page index user
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = $this->userRepository->search($search);
        
        if ($request->ajax()) {
            $html = view('admin.widgets.users', compact('users'))->render();

            return response()->json($html);
        }

        return view('admin.user.index', compact('users'));
    }

    /**
     * route to page create user
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * store created user
     */
    public function store(UserRequest $userRequest)
    {
        try {
            if (!isset($userRequest) && $userRequest == null) {
                return redirect()->back()->with('error', 'Have error occurared, please try again');
            } else {
                $data = $userRequest->all();
                $this->userRepository->create($data);

                toastr()->success(__('messages.success', ['name' => 'Create']));

            return redirect()
                ->route('topics.index')
                ->with('success', __('messages.success', ['name' => 'Create']));
            }
        } catch (\Exception $exception) {
            Log::error("Error create user" . $exception->getMessage());

            return view('errors.404');
        }
    }

    /**
     * Get user($id) and route to edit user page
     *
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        try {
            $user = $this->userRepository->getUser($id);

            return view('admin.user.update', compact('user'));
        } catch (ModelNotFoundException $e) {
            Log::error('Edit user not found ' . $e->getMessage());

            return view('errors.404');
        }
    }

    /**
     * Update topic and return update topic page
     *
     * @param RequestTopic $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            if(Auth::user()->role == 0 && Auth::user()->user_status == 1 && Auth::id() != $id) {
                $data = $request->all();
                if(!isset($data) || $data['role'] == null) {
                    toastr()->error(__('messages.error'));
    
                    return redirect()->back();
                } else {
                    $this->userRepository->update($data, $id);
                    toastr()->success(__('messages.success', ['name' => 'Edit']));
                    
                    return redirect()
                    ->route('users.index');
                }
            } else {
                toastr()->error(__('messages.permission'));
                return redirect()->back();
            }
        } catch (ModelNotFoundException $e) {
            Log::error('Find user error. ' . $e->getMessage());

            return view('errors.404');
        }
    }

    /**
     * function delete user
     */
    public function destroy($id)
    {
        try {
            if(Auth::user()->role == 0 && Auth::user()->user_status == 1 && Auth::id() != $id) {
                $user = $this->userRepository->getUser($id);
                if($user->delete()) {
                    toastr()->success(__('messages.success', ['name' => 'Delete']));
                    
                    return redirect()->back();
                } else {
                    toastr()->error(__('messages.error'));
    
                    return redirect()->back();
                }
            } else {
                toastr()->error(__('messages.permission'));
    
                return redirect()->back();
            }  
        } catch(ModelNotFoundException $exception) {
            \Log::error("Error delete User ".$exception->getMessage());

            return view('errors.404');
        }
        
    }


    /**
     * function active user
     *
     * @param $id
     * @return RedirectResponse
     */
    public function active($id)
    {
        $this->userRepository->activeUser($id);
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
//use Spatie\Permission\Models\Permission;

class UsersManagementController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of users
     *
     * @return Application|Factory|View
     */
    public function index() {
        $users = User::paginate(env('PAGINATION_SIZE'));
        $roles = Role::all();

        return view('admin.users.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return Application|Factory|View|Response
     */
    public function create() {
        return view('admin.users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'same:password'],
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name' => strip_tags($request->input('name')),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);

//        TODO: add choice of roles and permissions
        $user->assignRole('User');
        $user->save();

        return redirect()
            ->route('admin.users.index')
            ->with('type', 'success')
            ->with('status', "Пользователь {$user->name} успешно создан!");
    }

    /**
     * Display the specified user.
     *
     * @param User $user
     * @return Response
     */
//    public function show(User $user): Response {
//        // TODO: Adding a user profile display form to control panel
//        return abort(404);
//    }

    /**
     * Show the form for editing the specified user.
     *
     * @param User $user
     * @return Application|Factory|View|Response
     */
    public function edit(User $user) {
        $roles = Role::all();
//        $permissions = Permission::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param User $user
     * @return RedirectResponse|Response
     */
    public function update(Request $request, User $user) {
        $emailCheck = ($request->input('email') != '') && ($request->input('email') != $user->email);
        $passwordCheck = $request->input('password') != null;

        $rules = [
            'name' => ['required', 'string', 'max:255'],
        ];

        if ($emailCheck) {
            $rules['email'] = ['required', 'string', 'email', 'max:255', 'unique:users'];
        }

        if ($passwordCheck) {
            $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
            $rules['password_confirmation'] = ['required', 'string', 'same:password'];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user->name = strip_tags($request->input('name'));

        if ($emailCheck) {
            $user->email = $request->input('email');
        }

        if ($passwordCheck) {
            $user->password = Hash::make($request->input('password'));
        }

        $user->syncRoles($request->input('role'));
        $user->save();

        return back()
            ->with('type', 'success')
            ->with('status', "Информация о пользователе {$user->name} была успешно обновлена!");
    }

    /**
     * Remove the specified user from storage.
     *
     * @param User $user
     * @return Application|RedirectResponse|Response|Redirector|void
     * @noinspection PhpVoidFunctionResultUsedInspection
     * @throws Exception
     */
    public function destroy(User $user) {
        $currentUser = Auth::user();

        if (is_null($currentUser)) {
            return abort(500);
        }

        if ($currentUser->id !== $user->id) {
            $user->save();
            $user->delete();

            return back()
                ->with('type', 'success')
                ->with('status', "Пользователь {$user->name} был удален!");
        }

        return back()
            ->with('type', 'danger')
            ->with('status', "Вы не можете удалить свой профиль!");
    }

//    /**
//     * Method to search the users.
//     *
//     * @param Request $request
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function search(Request $request)
//    {
//        $searchTerm = $request->input('user_search_box');
//        $searchRules = [
//            'user_search_box' => 'required|string|max:255',
//        ];
//        $searchMessages = [
//            'user_search_box.required' => 'Search term is required',
//            'user_search_box.string'   => 'Search term has invalid characters',
//            'user_search_box.max'      => 'Search term has too many characters - 255 allowed',
//        ];
//
//        $validator = Validator::make($request->all(), $searchRules, $searchMessages);
//
//        if ($validator->fails()) {
//            return response()->json([
//                json_encode($validator),
//            ], Response::HTTP_UNPROCESSABLE_ENTITY);
//        }
//
//        $results = config('laravelusers.defaultUserModel')::where('id', 'like', $searchTerm.'%')
//            ->orWhere('name', 'like', $searchTerm.'%')
//            ->orWhere('email', 'like', $searchTerm.'%')->get();
//
//        // Attach roles to results
//        foreach ($results as $result) {
//            $roles = [
//                'roles' => $result->roles,
//            ];
//            $result->push($roles);
//        }
//
//        return response()->json([
//            json_encode($results),
//        ], Response::HTTP_OK);
//    }
}

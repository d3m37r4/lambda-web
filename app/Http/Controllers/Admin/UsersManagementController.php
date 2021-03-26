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
        $users = User::paginate(env('USER_LIST_PAGINATION_SIZE'));
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
     * Store a newly created resource in storage.
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
            ->with('type', "success")
            ->with('status', "Пользователь '$user->name' успешно создан!");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(int $id): Response {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function update(Request $request, int $id) {
        $user = User::find($id);
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

        $user->save();

        return back()->with('success', "Информация о пользователе '$user->name' была обновлена!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector|void
     * @throws Exception
     * @noinspection PhpVoidFunctionResultUsedInspection
     */
    public function destroy(int $id) {
        $currentUser = Auth::user();
        $user = User::findOrFail($id);

        if ($currentUser == null) {
            return abort(500);
        }

        if ($currentUser->id !== $user->id) {
            $user->delete();

            return back()->with('success', "Пользователь '$user->name' был удален!");
        }

        return back()->with('error', "Вы не можете удалить свой профиль!");
    }

//    /**
//     * Display form for creating a new user.
//     */
//    public function createNewUser(Request $request) {
//        if ($request->isMethod('post')) {
//            $data = $request->all();
//            dd($data);
////            $validator = Validator::make($data, [
////                'name' => 'required|string|unique:roles|max:30',
////                'permissions' => 'required',
////            ]);
////            if ($validator->fails()) {
////                return redirect()->route('admin.create_role')
////                        ->withErrors($validator)
////                        ->withInput();
////            }
////            $role = Role::create(['name' => $data['name']]);
////            $role->syncPermissions($data['permissions']);
////            return redirect()->route('admin.roleslist')->
////                with('status', "Новая роль '$role->name' создана!");
//        }
////        $permissions = Permission::all();
//
//        return view('admin.users.create');
//    }
//
//    public function editUser(Request $request, User $user) {
////        if ($request->isMethod('post')) {
////            $input = $request->all();
////            $validator = Validator::make($input, [
////                'name' => ['required', 'string', 'max:255'],
////                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' .$user->id],
////                'password' => ['required', 'string', 'min:6'],
////                'role' => ['required', 'string'],
////            ]);
////
////            if ($validator->fails()) {
////                return redirect()->route('admin.users.edit', $user->id)
////                    ->withErrors($validator)
////                    ->withInput();
////            }
////
////            $input['password'] = bcrypt($request->get('password'));
////            $user->update($input);
////            $user->syncRoles($request->input('role'));
////
////            return redirect()->route('admin.users.index')->
////            with('status', "Информация о пользователе '$user->name' была обновлена!");
////        }
//
//        $roles = Role::get()->pluck('name', 'name');
////        $permissions = Permission::all();
//        $permissions = Permission::get()->pluck('name', 'name');
//
//        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
//    }
//
//    /**
//     * Delete user from storage.
//     */
//    public function deleteUser(User $user) {
//        $user->delete();
//
//        return redirect()->route('admin.users.index')->
//        with('status', "Пользователь '$user->name' был удален!");
//    }
//
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

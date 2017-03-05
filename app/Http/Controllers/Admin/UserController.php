<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Flash;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers\Admin
 */
class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        parent::__construct();

        // Set the breadcrumbs
        $this->breadcrumb_route = route('admin.users.index');
        $this->breadcrumb_name = trans('users.users');
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($search = $request->get('search', false)) {
            $this->validate($request, ['search' => 'required|min:3'], [trans('common.search_validation_error')]);
            $users = User::where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%')
                ->orderBy('name')
                ->paginate(self::PAGINATION_SIZE);
        } else {
            $users = User::paginate(self::PAGINATION_SIZE);
        }

        return view('admin.users.index', [
            'users'       => $users,
            'search'      => $search,
            'breadcrumbs' => $this->getBreadcrumbs(),
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('admin.users.show')
            ->with('user', $user)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.users.show', $user), 'name' => $user->name],
            ]));
    }

    /**
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $user = new User;
        return view('admin.users.create')
            ->with('user', $user)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.users.create'), 'name' => trans('crud.create_model', ['model' => strtolower(trans('users.user'))])],
            ]));
    }

    /**
     * @param $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit')
            ->with('user', $user)
            ->with('breadcrumbs', $this->getBreadcrumbs([
                ['route' => route('admin.users.edit', $user), 'name' => trans('crud.edit_name', ['name' => $user->name])],
            ]));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = new User($request->all());
        $user->password = bcrypt($request->get('password'));

        $user->save();

        flash(trans('crud.created_model', ['model' => strtolower(trans('users.user'))]), 'success');
        return redirect()->route('admin.users.show', $user);
    }

    /**
     * @param Request $request
     * @param User    $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name'  => $request->get('name'),
            'email' => $request->get('email'),
        ]);

        // Let's check if we should validate and update the password
        if (!empty($request->get('password'))) {
            $this->validate($request, [
                'password' => 'required|min:6|confirmed',
            ]);
            // Check if we should update the user
            $user->password = bcrypt($request->get('password'));

        }

        $user->save();

        flash(trans('crud.updated_model', ['model' => strtolower(trans('users.user'))]), 'success');

        return redirect()->route('admin.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        flash(trans('crud.deleted_model', ['model' => strtolower(trans('users.user'))]), 'success');
        return redirect()->route('admin.users.index');
    }
}

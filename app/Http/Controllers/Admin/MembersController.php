<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MembersController extends Controller
{
    /**
     * Show the members page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getManage()
    {
        pagetitle( [ trans( 'members.manage' ), trans( 'main.apps.members' ), settings( 'server_name' ) ] );
        $users = User::orderBy( 'id' )->paginate();
        return view( 'admin.members.manage', compact( 'users' ) );
    }

    /**
     * Search for users
     *
     * @param Request $request
     * @return mixed
     */
    public function postSearch( Request $request )
    {
        $result = [];
        $users = User::where( 'username', 'LIKE', '%' . $request->search_query . '%' )->orderBy( 'id' )->get();
        foreach ( $users as $user )
        {
            $give = ( Auth::user()->can( 'manage-users' ) ) ? "<a class=\"btn red btn-outline\" href=\"" . url( 'admin/members/balance/' . $user->id ) . "\">" . trans( 'members.actions.give' ) . "</a>" : NULL;
            $permissions = ( Auth::user()->can( 'manage-permissions' ) ) ? "<a class=\"btn blue btn-outline\" href=\"" . url( 'admin/members/permissions/' . $user->id ) . "\">" . trans( 'members.actions.permissions' ) . "</a>" : NULL;

            $result[] = "<tr><td>" . $user->id . "</td><td>" . $user->username . "</td><td>" . $user->balance() . "</td><td>" . $user->created_at->format( 'l, F jS, Y' ) . "</td><td>" . $give . $permissions . "</td></tr>";
        }
        return $result;
    }

    /**
     * Show the balance page
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getBalance(User $user )
    {
        pagetitle( [ trans( 'members.balance', ['member' =>  $user->username] ), trans( 'main.apps.members' ), settings( 'server_name' ) ] );
        return view( 'admin.members.balance', compact( 'user' ) );
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postBalance( Request $request, User $user )
    {
        $this->validate($request, [
            'amount' => 'required|numeric'
        ]);

        $user_info = UserInfo::find( $user->username );
        $user_info->pvalues = $user_info->pvalues + $request->amount;
        $user_info->save();

        flash()->success( trans( 'members.success.balance', ['user' => $user->username, 'count' => $request->amount] ) );
        return redirect( 'admin/members/manage' );
    }

    /**
     * Show the permissions page
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getPermissions( User $user )
    {
        pagetitle( [ trans( 'members.permissions', ['member' =>  $user->username] ), trans( 'main.apps.members' ), settings( 'server_name' ) ] );
        return view( 'admin.members.permissions', compact( 'user' ) );
    }

    /**
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postPermissions(Request $request, User $user )
    {
        $role = Role::find( $request->role );

        if ( $request->role == 0 )
        {
            $user->detachRoles();
        }
        else
        {
            $user->attachRole( $role );
        }

        flash()->success( trans( 'members.success.permissions', ['user' => $user->username, 'role' => $role ? trans( 'members.roles.' . $role->name ) : trans( 'members.roles.member' ) ] ) );
        return redirect( 'admin/members/manage' );
    }
}

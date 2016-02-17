<?php

namespace App\Http\Controllers\Front;

use App\UserInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * AccountController constructor.
     */
    public function __construct()
    {
        $this->middleware( 'auth' );
    }

    /**
     * Show the account settings page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getSettings()
    {
        pagetitle( [ trans( 'main.settings' ), settings( 'server_name' ) ] );
        return view( 'front.account.index' );
    }

    /**
     * Save the user's new password
     *
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postPassword( Request $request )
    {
        $this->validate($request, [
            'current_password' => 'required|current_pass|max:255',
            'new_password' => 'required|confirmed|min:6'
        ]);

        $user = Auth::user();
        $user->password = Hash::make( $request->new_password );
        $user->save();

        DB::connection('account')
            ->table('accounts')
            ->where('id', $user->id)
            ->update(['password' => $request->new_password]);

        DB::connection('member')
            ->table('tb_user')
            ->where('idnum', $user->id)
            ->update([
                'password' => $request->new_password,
                'pwd' => Hash::make( $request->new_password )
            ]);

        flash()->success( trans( 'main.settings_saved' ) );
        return redirect( 'account/settings#password' );
    }
}

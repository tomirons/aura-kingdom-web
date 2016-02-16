<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\UserInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

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

        flash()->success( trans( 'members.success', ['user' => $user->username, 'count' => $request->amount] ) );
        return redirect()->back();
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
            $button = "<a class=\"btn red btn-outline\" data-toggle=\"modal\" href=\"#" . $user->username . "_balance\">" . trans( 'members.actions.give' ) . "</a>";
            $modal = "<div class=\"modal fade\" id=\"" . $user->username . "_balance\" tabindex=\"-1\" aria-hidden=\"true\">" .
                         "<div class=\"modal-dialog\">" .
                             "<div class=\"modal-content\">" .
                                 "<form action=\"" . url( 'admin/members/balance' ) . "/" . $user->id . "\" method=\"post\">" .
                                     "<input type=\"hidden\" name=\"_token\" value=\"" . csrf_token() . "\">" .
                                     "<div class=\"modal-header\">" .
                                         "<button type=\"button\" class=\"close\" data-dismiss=\"modal\" aria-hidden=\"true\"></button>" .
                                         "<h4 class=\"modal-title\">" . trans( 'members.modal.title', ['user' => $user->username] ) . ":</h4>" .
                                     "</div>" .
                                     "<div class=\"modal-body\">" .
                                         "<div class=\"form-group form-md-line-input form-md-floating-label\">" .
                                             "<input name=\"amount\" type=\"text\" class=\"form-control\" id=\"amount\">" .
                                             "<label for=\"amount\">" . trans( 'members.fields.amount.label' ) . "</label>" .
                                         "</div>" .
                                     "</div>" .
                                     "<div class=\"modal-footer\">" .
                                         "<button class=\"btn dark btn-outline\" data-dismiss=\"modal\">" . trans( 'members.modal.close' ) . "</button>" .
                                         "<button type=\"submit\" class=\"btn green\">" . trans( 'members.modal.submit' ) . "</button>" .
                                     "</div>" .
                                 "</form>" .
                             "</div>" .
                         "</div>" .
                     "</div>";
            $result[] = "<tr><td>" . $user->id . "</td><td>" . $user->username . "</td><td>" . $user->balance() . "</td><td>" . $user->role . "</td><td>" . $button . $modal . "</td></tr>";
        }
        return $result;
    }
}

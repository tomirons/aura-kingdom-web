<?php

namespace App\Http\Controllers\Front;

use App\Payment;
use App\User;
use App\UserInfo;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;

class DonateController extends Controller
{
    /**
     * Omnipay Gateway
     *
     * @var
     */
    protected $gateway;

    /**
     * Assign middleware & initate the PayPal gateway
     */
    public function __construct()
    {
        $this->middleware( 'auth' );

        $this->gateway = Omnipay::create( 'PayPal_Rest' );
        $this->gateway->initialize([
            'clientId' => settings( 'paypal_client_id' ),
            'secret'   => settings( 'paypal_secret' ),
            'testMode' => false,
        ]);
    }

    /**
     * Return the index view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getIndex()
    {
        pagetitle( [ trans( 'main.apps.donate' ), settings( 'server_name' ) ] );
        return view( 'front.donate.index' );
    }

    /**
     * Redirect to PayPal payment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postPaypalSubmit( Request $request )
    {
        $transaction = $this->gateway->purchase([
            'amount'        => number_format( $request->dollars, 2 ),
            'currency'      => settings( 'paypal_currency' ),
            'description'   => trans( 'donate.paypal.description' ),
            'returnUrl'     => url( 'donate/paypal/complete' ),
            'cancelUrl'     => url( 'donate' ),
        ]);
        $response = $transaction->send();

        if ( $response->isRedirect() )
        {
            // redirect to offsite payment gateway
            $response->redirect();
        }
        else
        {
            // payment failed: display message to customer
            echo $response->getMessage();
        }
    }

    public function postPaypalComplete( Request $request )
    {
        $complete = $this->gateway->completePurchase([
            'transactionReference' => $request->paymentId,
            'payerId' => $request->PayerID,
        ]);

        $response = $complete->send();
        $data = $response->getData();

        if ( $data['state'] === 'approved' )
        {
            $user = UserInfo::find( Auth::user()->username );
            $amount = round( $data['transactions'][0]['amount']['total'] );

            $payment_amount = settings( 'paypal_double' ) ? ( $amount * settings( 'paypal_per' ) ) * 2 : $amount * settings( 'paypal_per' );

            Payment::create([
                'user_id' => Auth::user()->id,
                'transaction_id' => $data['id'],
                'amount' => $amount
            ]);

            $user->pvalues = $user->pvalues + $payment_amount;
            $user->save();

        }

        flash()->success( trans( 'donate.paypal.success' ) );
        return redirect( 'donate' );
    }
}

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
use Paymentwall_Config;
use Paymentwall_Pingback;

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
        $this->middleware( 'auth', ['except' => ['getPaymentWall']] );

        // Setup the PayPal gateway
        $this->gateway = Omnipay::create( 'PayPal_Rest' );
        $this->gateway->initialize([
            'clientId' => settings( 'paypal_client_id' ),
            'secret'   => settings( 'paypal_secret' ),
            'testMode' => false,
        ]);

        // Setup the PaymentWall instance
        Paymentwall_Config::getInstance()->set([
            'api_type' => Paymentwall_Config::API_VC,
            'public_key' => settings( 'paymentwall_app_key' ),
            'private_key' => settings( 'paymentwall_key' )
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
    public function postPayPalSubmit( Request $request )
    {
        $transaction = $this->gateway->purchase([
            'items'         => [
                0 => [
                    'name' => 'Aura Points',
                    'quantity' => 1,
                    'price' => number_format( $request->dollars, 2, '.', '' ),
                    'currency' => settings( 'paypal_currency' )
                ]
            ],
            'amount'        => number_format( $request->dollars, 2, '.', '' ),
            'currency'      => settings( 'paypal_currency' ),
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

    /**
     * Process the PayPal payment
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function postPayPalComplete( Request $request )
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

    /**
     * Process the PaymentWall payment
     *
     * @param Request $request
     */
    public function getPaymentWall( Request $request )
    {
        $pingback = new Paymentwall_Pingback( $_GET, $_SERVER['REMOTE_ADDR'] );
        if ( $pingback->validate() )
        {
            $virtualCurrency = $pingback->getVirtualCurrencyAmount();
            $user = UserInfo::find( $request->uid );
            if ( $pingback->isDeliverable() )
            {
                // Add the currency to the user
                $user->pvalues = $user->pvalues + $virtualCurrency;
                $user->save();
            }
            elseif ( $pingback->isCancelable() )
            {
                // Take the currency from the user
                $user->pvalues = $user->pvalues + $virtualCurrency;
                $user->save();
            }
            echo 'OK'; // Paymentwall expects response to be OK, otherwise the pingback will be resent
        }
        else
        {
            echo $pingback->getErrorSummary();
        }
    }
}

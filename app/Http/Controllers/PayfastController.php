<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PayfastController extends Controller
{
    /**
     * @param array $data
     * @param null $passPhrase
     * @return string
     */

    public function __construct()
    {
        $this->middleware('auth')->except('notify');

        //redirect back to payment instruction if the user has already paid, proceed if user has not paid
        $this->middleware('hasNotPaid')->except(['notify', 'success_page']);
    }

    private function generateSignature($data, $passPhrase = null) {
        // Create parameter string
        $pfOutput = '';
        foreach( $data as $key => $val ) {
            if($val !== '') {
                $pfOutput .= $key .'='. urlencode( trim( $val ) ) .'&';
            }
        }
        // Remove last ampersand
        $getString = substr( $pfOutput, 0, -1 );

        if( $passPhrase !== null ) {
            $getString .= '&passphrase='. urlencode( trim( $passPhrase ) );
        }
        return md5( $getString );
    }

    public function pay_now()
    {
        /* Payfast integration, this block of code returns a more secured custom form */

        // Construct variables
        $cartTotal = 150.00;// This amount needs to be sourced from your application
        $data = array(
            // Merchant details
            'merchant_id' => '10000100',
            'merchant_key' => '46f0cd694581a',
            'return_url' => 'http://ccaa7b3fdd50.ngrok.io/success',
            'cancel_url' => 'http://ccaa7b3fdd50.ngrok.io/cancel',
            'notify_url' => 'http://ccaa7b3fdd50.ngrok.io/notify/'. auth()->user()->id,
            // Buyer details
            'name_first' => auth()->user()->first_name,
            'name_last'  => auth()->user()->surname,
            'email_address'=> auth()->user()->email,
            // Transaction details
            'm_payment_id' => auth()->user()->reference_number, //Unique payment ID to pass through to notify_url
            'amount' => number_format( sprintf( '%.2f', $cartTotal ), 2, '.', '' ),
            'item_name' => 'Accomodation fee'
        );

        $signature = $this->generateSignature($data);
        $data['signature'] = $signature;

        // If in testing mode make use of either sandbox.payfast.co.za or www.payfast.co.za
        $testingMode = true;

        //the secured form from PayFast documentation
        $pfHost = $testingMode ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
        $htmlForm = '<form action="https://'.$pfHost.'/eng/process" method="post">';
        
        foreach($data as $name=> $value)
        {
            $htmlForm .= '<input name="'.$name.'" type="hidden" value="'.$value.'" />';
        }
        $htmlForm .= '<input type="submit" class="btn btn-danger" value="Pay Now" /></form>';
        
        return view('pages.pay_now', compact('htmlForm'));
    }

    //the cancel page after payment is the same as pay now, the only difference is, there is a message to notify that the transaction was canceled

    public function cancel_page()
    {
        return redirect('/pay_now')->with('message', 'The transaction was canceled');
    }

    public function success_page()
    {
        return view('pages.payfast.success');
    }

    public function notify($id)
    {   
        // Tell PayFast that this page is reachable by triggering a header 200
        header( 'HTTP/1.0 200 OK' );
        
        flush();

        define( 'SANDBOX_MODE', true );
        $pfHost = SANDBOX_MODE ? 'sandbox.payfast.co.za' : 'www.payfast.co.za';
        // Posted variables from ITN
        $pfData = $_POST;

        // Strip any slashes in data
        foreach( $pfData as $key => $val ) {
            $pfData[$key] = stripslashes( $val );
        }

        $pfParamString = '';
        
        // Convert posted variables to a string
        foreach( $pfData as $key => $val ) {
            if( $key !== 'signature' ) {
                $pfParamString .= $key .'='. urlencode( $val ) .'&';
            } else {
                break;
            }
        }

        $notify_file = fopen('notify.txt', 'wb') or die();

        $pfParamString = substr( $pfParamString, 0, -1 );

        //we will log messages in the file I created above

        $check1 = $this->pfValidSignature($pfData, $pfParamString);
        $check1 ? fwrite($notify_file, "It's a valid signature\n") : fwrite($notify_file, "It's not a valid Signature");

        $check2 = $this->pfValidIP();
        $check2 ? fwrite($notify_file, "It's a valid IP\n") : fwrite($notify_file, "It's not a valid IP");

        $check3 = $this->pfValidPaymentData(150, $pfData);
        $check3 ? fwrite($notify_file, "It's valid data\n") : fwrite($notify_file, "It's not valid data");

        $check4 = $this->pfValidServerConfirmation($pfParamString, $pfHost);
        $check4 ? fwrite($notify_file, "It's a valid confirmation\n") : fwrite($notify_file, "It's not valid");

        if($check1 && $check2 && $check3 && $check4) {
            // All checks have passed, the payment is successful, we can now edit the has_paid column in the database and set it to true

            $user = User::find($id);

            $user->has_paid = 1;

            $user->save();
            
        } else {
            // Some checks have failed, check payment manually and log for investigation

        }
                
    }


    private function pfValidSignature( $pfData, $pfParamString, $pfPassphrase = null ) {

        // Calculate security signature
        if($pfPassphrase === null) {
            $tempParamString = $pfParamString;
        } else {
            $tempParamString = $pfParamString.'&passphrase='.urlencode( $pfPassphrase );
        }

        $signature = md5( $tempParamString );
        return ( $pfData['signature'] === $signature );
    }


    private function pfValidIP() {
        // Variable initialization
        $validHosts = array(
            'www.payfast.co.za',
            'sandbox.payfast.co.za',
            'w1w.payfast.co.za',
            'w2w.payfast.co.za',
            );

        $validIps = [];

        foreach( $validHosts as $pfHostname ) {
            $ips = gethostbynamel( $pfHostname );

            if( $ips !== false )
                $validIps = array_merge( $validIps, $ips );
        }

        // Remove duplicates
        $validIps = array_unique( $validIps );
        $referrerIp = gethostbyname(parse_url($_SERVER['HTTP_REFERER'])['host']);
        if( in_array( $referrerIp, $validIps, true ) ) {
            return true;
        }
        return false;
    }

    //compare payment data (via PayFast Documentation)
    private function pfValidPaymentData( $cartTotal, $pfData ) {
        return !(abs((float)$cartTotal - (float)$pfData['amount_gross']) > 0.01);
    }

    private function pfValidServerConfirmation( $pfParamString, $pfHost = 'sandbox.payfast.co.za', $pfProxy = null ) {
        // Use cURL (if available)
        if( in_array( 'curl', get_loaded_extensions(), true ) ) {
            // Variable initialization
            $url = 'https://'. $pfHost .'/eng/query/validate';

            // Create default cURL object
            $ch = curl_init();
        
            // Set cURL options - Use curl_setopt for greater PHP compatibility
            // Base settings
            curl_setopt( $ch, CURLOPT_USERAGENT, NULL );  // Set user agent
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );      // Return output as string rather than outputting it
            curl_setopt( $ch, CURLOPT_HEADER, false );             // Don't include header in output
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 2 );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, true );
            
            // Standard settings
            curl_setopt( $ch, CURLOPT_URL, $url );
            curl_setopt( $ch, CURLOPT_POST, true );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $pfParamString );
            if( !empty( $pfProxy ) )
                curl_setopt( $ch, CURLOPT_PROXY, $pfProxy );
        
            // Execute cURL
            $response = curl_exec( $ch );
            curl_close( $ch );
            if ($response === 'VALID') {
                return true;
            }
        }
        return false;
    }
}

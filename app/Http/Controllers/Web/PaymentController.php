<?php

namespace App\Http\Controllers\Web;

use App\Models\Order;
use App\Models\Blog;
use App\Models\Page;
use App\Models\Category;
use App\Models\Payment;
use App\Models\UserComment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use DB;

class PaymentController extends Controller
{

    public function pay()
    {
//        $order = Order::findOrFail(Session::get('order_id'));
//        $amount = $order->grand_total;
        $amount = rand(100,1000);


        $idorder = 'PHP_' . rand(100000000, 999999999);//Customer Order ID


        $terminalId = "learntic";// Will be provided by URWAY
        $password = "learntic@URWAY";// Will be provided by URWAY
        $merchant_key = "0bcf44529baa427c3cdda8023f71d23fb38a284213c21d581246339f29b2a351";// Will be provided by URWAY
//        $currencycode = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;

        $currencycode = "SAR";
        $amount = number_format($amount, 2, '.', '');



        $ipaddress = "127.0.0.1";
//        if (getenv('HTTP_CLIENT_IP'))
//            $ipaddress = getenv('HTTP_CLIENT_IP');
//        else if(getenv('HTTP_X_FORWARDED_FOR'))
//            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
//        else if(getenv('HTTP_X_FORWARDED'))
//            $ipaddress = getenv('HTTP_X_FORWARDED');
//        else if(getenv('HTTP_FORWARDED_FOR'))
//            $ipaddress = getenv('HTTP_FORWARDED_FOR');
//        else if(getenv('HTTP_FORWARDED'))
//            $ipaddress = getenv('HTTP_FORWARDED');
//        else if(getenv('REMOTE_ADDR'))
//            $ipaddress = getenv('REMOTE_ADDR');
//        else
//            $ipaddress = 'UNKNOWN';

        $ipp = $ipaddress;
//Generate Hash
        $txn_details= $idorder.'|'.$terminalId.'|'.$password.'|'.$merchant_key.'|'.$amount.'|'.$currencycode;
        $hash=hash('sha256', $txn_details);


        $fields = array(
            'trackid' => $idorder,
            'terminalId' => $terminalId,
            'customerEmail' => "andrewalbert93501@gmail.com",
            'action' => "1",  // action is always 1
            'merchantIp' =>$ipp,
            'password'=> $password,
            'currency' => $currencycode,
            'country'=>"SA",
            'amount' => $amount,
            "udf1"              =>"",
            // "udf2"              =>"https://urway.sa/urshop/scripts/response.php",//Response page URL
            "udf2"              =>route('payment.callback'),//Response page URL
            "udf3"              =>"",
            "udf4"              =>"",
            "udf5"              =>"",
            'requestHash' => $hash  //generated Hash
        );
//        dd($fields);
        $data = json_encode($fields);
 $ch=curl_init('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest'); // Will be provided by URWAY
//        $ch=curl_init('https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest'); // Will be provided by URWAY

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $server_output =curl_exec($ch);
//  dd($server_output);
        //close connection
        curl_close($ch);
        $result = json_decode($server_output);
//          dd($result);
        if (!empty($result->payid) && !empty($result->targetUrl)) {
            $url = $result->targetUrl . '?paymentid=' .  $result->payid;
//            dd($url);
            return redirect($url);
            header('Location: '. $url, true, 307);//Redirect to Payment Page
        }else{


        }

    }

    public function callback(Request $request)
    {
        //http://127.0.0.1:8000/payment/callback?PaymentId=2226717698507166137&TranId=2226717698507166137&ECI=02&Result=Successful&TrackId=PHP_510126140&AuthCode=091693&ResponseCode=000&RRN=226714091693&responseHash=b7c6b419c447a3f9971b4d8ef90aa9e16ba626a7a573f553bbd79843f068c6e7&amount=779.00&cardBrand=MASTER&UserField1=&UserField3=&UserField4=&UserField5=&maskedPAN=512345XXXXXX0008&cardToken=&SubscriptionId=null&email=null&payFor=null
//        DB::table('urway_payments')->insert([
//            'order_id' => session()->get('order_id'),
//            'response' => json_encode($request->all())
//        ]);
//        if(isset($request->Result) && $request->Result == 'Successful'){
//            Order::whereId(session()->get('order_id'))->update([
//                'payment_status' => 'paid'
//            ]);
//        }
        //dd($request->all(),session()->get('order_id'));
    }

    public function payConsultationRequest($orderId,$cost=null,$email=null)
    {
        $amount = $cost == null ? Order::whereId($orderId)->first()->price_after : $cost;
        $email = $email == null ? Auth::guard('web')->user()->email : $email;
//        $email = "andrewalbert93501@gmail.com";

        $idorder = 'num_'. rand(100000,999999) . time();//Customer Order ID

        Payment::create([
            'user_id' => auth()->user()->id,
            'order_id' => $orderId,
            'track_id' => $idorder,
            'email' => $email,
        ]);

        $terminalId = "learntic";// Will be provided by URWAY
        $password = "learntic@URWAY";// Will be provided by URWAY
        $merchant_key = "0bcf44529baa427c3cdda8023f71d23fb38a284213c21d581246339f29b2a351";// Will be provided by URWAY
//        $currencycode = \App\Currency::findOrFail(\App\BusinessSetting::where('type', 'system_default_currency')->first()->value)->code;

        $currencycode = "SAR";
        $amount = number_format($amount, 2, '.', '');



        $ipaddress = "127.0.0.1";
//        if (getenv('HTTP_CLIENT_IP'))
//            $ipaddress = getenv('HTTP_CLIENT_IP');
//        else if(getenv('HTTP_X_FORWARDED_FOR'))
//            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
//        else if(getenv('HTTP_X_FORWARDED'))
//            $ipaddress = getenv('HTTP_X_FORWARDED');
//        else if(getenv('HTTP_FORWARDED_FOR'))
//            $ipaddress = getenv('HTTP_FORWARDED_FOR');
//        else if(getenv('HTTP_FORWARDED'))
//            $ipaddress = getenv('HTTP_FORWARDED');
//        else if(getenv('REMOTE_ADDR'))
//            $ipaddress = getenv('REMOTE_ADDR');
//        else
//            $ipaddress = 'UNKNOWN';

        $ipp = $ipaddress;
//Generate Hash
        $txn_details= $idorder.'|'.$terminalId.'|'.$password.'|'.$merchant_key.'|'.$amount.'|'.$currencycode;
        $hash=hash('sha256', $txn_details);


        $fields = array(
            'trackid' => $idorder,
            'terminalId' => $terminalId,
            'customerEmail' => $email,
            'action' => "1",  // action is always 1
            'merchantIp' =>$ipp,
            'password'=> $password,
            'currency' => $currencycode,
            'country'=>"SA",
            'amount' => $amount,
            "udf1"              =>"",
            // "udf2"              =>"https://urway.sa/urshop/scripts/response.php",//Response page URL
            "udf2"              =>route('payment.consultation.callback'),//Response page URL
            "udf3"              =>"",
            "udf4"              =>"",
            "udf5"              =>"",
            'requestHash' => $hash  //generated Hash
        );

//        dd($fields);
        $data = json_encode($fields);
        $ch=curl_init('https://payments-dev.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest'); // Will be provided by URWAY
//        $ch=curl_init('https://payments.urway-tech.com/URWAYPGService/transaction/jsonProcess/JSONrequest'); // Will be provided by URWAY

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $server_output =curl_exec($ch);
//  dd($server_output);
        //close connection
        curl_close($ch);
        $result = json_decode($server_output);
//          dd($result);
        if (!empty($result->payid) && !empty($result->targetUrl)) {
            $url = $result->targetUrl . '?paymentid=' .  $result->payid;
//            dd($url);
            return Redirect::to((string)$url);
//            return redirect($url);
            return redirect()->away($url);
            header('Location: '. $url, true, 307);//Redirect to Payment Page
        }else{


        }

    }

    public function callbackConsultationRequest(Request $request)
    {
//        http://127.0.0.1:8000/payment/callback?PaymentId=2226717698507166137&TranId=2226717698507166137&ECI=02&Result=Successful&TrackId=PHP_510126140&AuthCode=091693&ResponseCode=000&RRN=226714091693&responseHash=b7c6b419c447a3f9971b4d8ef90aa9e16ba626a7a573f553bbd79843f068c6e7&amount=779.00&cardBrand=MASTER&UserField1=&UserField3=&UserField4=&UserField5=&maskedPAN=512345XXXXXX0008&cardToken=&SubscriptionId=null&email=null&payFor=null
        $thisPayment = DB::table('payments')->where('track_id',$request->TrackId)->first();

        if(isset($request->Result) && $request->Result == 'Successful'){
            Order::whereId($thisPayment->order_id)->update([
                'payment_status' => 1
            ]);
            DB::table('payments')->where('track_id',$request->TrackId)->update([
                'response' => json_encode($request->all()),
                'status' => $request->Result,
            ]);
            session()->flash('success', 'تمت عملية الدفع بنجاح');
        }else{
            session()->flash('error', 'فشلت عملية الدفع بنجاح');

        }

        return redirect('/');
    }
}

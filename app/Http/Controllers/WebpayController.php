<?php

namespace App\Http\Controllers;
use App\Models\Payment;
use Transbank\Webpay\WebpayPlus;
use Transbank\Webpay\WebpayPlus\Transaction;

use Illuminate\Http\Request;

class WebpayController extends Controller
{
    public function __construct(){
        if(app()->environment('production')){
            //WebpayPlus::configureForProduction();
        }else{
            WebpayPlus::configureForTesting();
        }
    }

    public function iniciarCompra(Request $request){
        $nueva_compra = new Payment();
        $nueva_compra->session_id = "123456";
        $nueva_compra->total = 20000;

        $nueva_compra->save();

        $url_to_pay = self::start_web_pay_plus_transaction($nueva_compra);

        return $url_to_pay;
    }

    public function start_web_pay_plus_transaction($nueva_compra){
        $transaccion = (new Transaction())->create(
            $nueva_compra->id,
            $nueva_compra->session_id,
            $nueva_compra->total,
            route("confirmar-pago")
        );

        $url = $transaccion->getUrl() . "?token_ws=" . $transaccion->getToken();

        return $url;
    }

    public function confirmarPago(Request $request){
        $confirmacion = (new Transaction())->commit($request->get("token_ws"));

        $compra = Payment::where("id", "=", $confirmacion->buyOrder)->first();

        if($confirmacion->isApproved()){
            Payment::where("id", "=", $confirmacion->buyOrder)->update(['status' => 2]);

            //return redirect(env("URL_FRONTEND_AFTER_PAYMENT") . "?compra_id={$compra->id}");
            return redirect( "/" . "?compra_id={$compra->id}");
        }else{
            return redirect("/");
        }
    }
}

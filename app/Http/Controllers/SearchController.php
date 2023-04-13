<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\EDM\Client;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public $response = [];
    public function index()
    {
        $client = new Client(env('EDM_TEST'));

        // // $client = new Client(env('EDM_REAL'));

        if (Auth::check()) {
            // //  $login = $client->login('ufkay', '1307Bahar'); //true veya false //fatura no örnek: EFA2023000000105 //ufkay
            // // $login = $client->login('16417037188', 'Fy798102fy'); //true veya false  //E062023000009115  //sönmez manav

            // //$login = $client->login('cc_sonmezmanav', 'Abc.123'); //true veya false  //STN2023000001243  //sönmez manav

            $login = $client->login(Auth::user()->edm_service_user, Auth::user()->edm_service_pass); //true veya false //ANY2023000000303  //OIR2020000000009 //ozkan.ozlu
            session(['EDM_SESSION_ID' => $client->getSessionId()]); //4cbee2fa-fff3-43b6-b007-a6877922cff6 gibi bir değer
 
            if ($login)
                $this->response = $client->getSingleInvoice($_GET['invoiceID']); //test sunucusu için
        }

        // //dd($client->getInvoiceStatus('STN2023000001243'), $_SESSION['EDM_SESSION_ID'] );

        // //$response = $client->getSingleInvoice('STN2023000001243');  //sönmez manav gerçek kullanıcı için


        return view('search', ['response' => $this->response['CONTENT']]);
    }
}
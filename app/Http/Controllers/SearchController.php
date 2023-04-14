<?php

namespace App\Http\Controllers;

use DOMDocument;
use DOMXPath;
use Illuminate\Http\Request;
use App\Http\Controllers\EDM\Client;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    public $faturaXML = [];
    public $faturaHTML = '';
    public function index()
    {
        $client = new Client(env('EDM_REAL'));

        // // $client = new Client(env('EDM_REAL'));

        // //  $login = $client->login('ufkay1', '1307Bahar1'); //true veya false //fatura no örnek: EFA2023000000105 //ufkay
        // // $login = $client->login('164170371881', '1Fy798102fy'); //true veya false  //E062023000009115  //sönmez manav

        $serviceLogin = $client->login(env('EDM_MANAVU'), env('EDM_MANAVP')); //true veya false  //STN2023000001243  //sönmez manav

        // $serviceLogin = $client->login(Auth::user()->edm_service_user, Auth::user()->edm_service_pass); //true veya false //ANY2023000000303  //OIR2020000000009 //ozkan.ozlu
        session(['EDM_SESSION_ID' => $client->getSessionId()]); //4cbee2fa-fff3-43b6-b007-a6877922cff6 gibi bir değer


        if ($serviceLogin) {
            $this->faturaXML = $client->getSingleInvoice(request()->invoiceID, null, false, 'XML'); //test sunucusu için
            $this->faturaHTML = $client->getSingleInvoice(request()->invoiceID, null, false, 'HTML');
        }




        $invoiceItems = $this->readInvoiceContent($this->faturaXML['CONTENT']);

        // //dd($client->getInvoiceStatus('STN2023000001243'), $_SESSION['EDM_SESSION_ID'] );

        // //$response = $client->getSingleInvoice('STN2023000001243');  //sönmez manav gerçek kullanıcı için


        return view('search', ['faturaXML' => $this->faturaXML['CONTENT'], 'faturaHTML' => $this->faturaHTML, 'invoiceItems' => $invoiceItems]);
    }

    public function readInvoiceContent($content)
    {
        $lines = [];
        $xml = new \SimpleXMLElement($content);

        // Extract the <cac:InvoiceLine> lines
        $invoiceLines = $xml->xpath('//cac:InvoiceLine');
        $i = 0;
        // Loop through each <cac:InvoiceLine> element and access its child elements
        foreach ($invoiceLines as $invoiceLine) {
            $lines[$i]['ID'] = (string) $invoiceLine->children('cbc', true)->ID;
            $lines[$i]['name'] = (string) $invoiceLine->children('cac', true)->Item->children('cbc', true)->Name;
            $lines[$i]['priceAmount'] = (string) $invoiceLine->children('cac', true)->Price->children('cbc', true)->PriceAmount;
            $lines[$i]['description'] = (string) $invoiceLine->children('cac', true)->Item->children('cbc', true)->Description;
            $lines[$i]['invoicedQuantity'] = (string) $invoiceLine->children('cbc', true)->InvoicedQuantity;
            $lines[$i++]['lineExtensionAmount'] = (string) $invoiceLine->children('cbc', true)->LineExtensionAmount;
            // Access other child elements of <cac:InvoiceLine> as needed

        }

        return $lines;
    }
}
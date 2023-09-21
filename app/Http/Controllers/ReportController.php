<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;


use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    //



    public function exportExcel($id)
    {

        dd($id);
    }


    public function facture($facture)
    {



        $order = Transaction::where('transaction_numero', $facture)->first();

        if (!$order) {
            return redirect()->back()->withErrors(['message' => 'Une erreur s\'est produite.']);
        }

        if($order->orders != null){

            $pdf = Pdf::loadView('Report.facture', ['order' => $order]);
            return $pdf->download('facture.pdf');

        }



    }
}

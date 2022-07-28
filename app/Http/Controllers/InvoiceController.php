<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use Mail; //IF NOT WORK USE THIS: use Illuminate\Support\Facades\Mail;
use PDF;

class InvoiceController extends Controller
{
    public function index() //VIEW PDF ATTACHMENT
    {      
        $invoices = Invoice::orderBy('id', 'desc')->skip(0)->take(24)->get();
        return view('pdfBody', compact('invoices'));
    }

    public function sendMail() //SEND PDF ATTACHMENT
    {     
        $invoices = Invoice::orderBy('id', 'desc')->skip(0)->take(24)->get();
        $data["subject"] = "This is mail subject from controller";
        $data["name"] = "Tahmeed";
        $data["invoices"] = $invoices;
        
        $pdf = PDF::loadView('pdfBody', $data);
        $data['pdf'] = $pdf;

        Mail::send('emailBody', $data, function($message)use($data) {       
            $message->to("tahmeed@mail.com")
           ->subject($data["subject"])           
           ->attachData($data['pdf']->output(), 
                'InvoiceList'.date("d-m-y").'.pdf', 
                ['mime'=>'application/pdf']);
  
        });
        // return response('Mail sent successfully!', 210);
        return response()->json([
            'message' => 'Mail sent successfully!'], 210);
    }

    public function downloadPDF() //DOWNLOAD PDF
    {     
        $invoices = Invoice::orderBy('id', 'desc')->skip(0)->take(24)->get();
        $data["invoices"] = $invoices;
        
        $pdf = PDF::loadView('pdfBody', $data);

        return $pdf->download('InvoiceList'.date("d-m-y").'.pdf');
    }

    public function streamPDF() //STREAM PDF
    {     
        $invoices = Invoice::orderBy('id', 'desc')->skip(0)->take(24)->get();
        $data["invoices"] = $invoices;
        
        $pdf = PDF::loadView('pdfBody', $data);

        return $pdf->stream('InvoiceList'.date("d-m-y").'.pdf');
    }
}

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/index', [InvoiceController::class, 'index']); //VIEW PDF 
Route::get('/send', [InvoiceController::class, 'sendMail']); //SEND PDF ATTACHMENT
Route::get('/download', [InvoiceController::class, 'downloadPDF']); //DOWNLOAD PDF 
Route::get('/stream', [InvoiceController::class, 'streamPDF']); //STREAM PDF 

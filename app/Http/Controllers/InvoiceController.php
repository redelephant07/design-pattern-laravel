<?php

namespace App\Http\Controllers;

use App\Events\InvoiceCreated;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Invoice;
use Illuminate\Http\Request;


class InvoiceController extends Controller
{
    public function store(StoreInvoiceRequest $request)
    {
        // return Invoice::create($request->validated());
    $invoice= Invoice::class::create($request->validated());
    InvoiceCreated::dispatch($invoice);
return $invoice;
    }
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {

        $invoice->update($request->validated());
        return $invoice;
    }
}

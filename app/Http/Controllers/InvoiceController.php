<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function get_all_invoice()
    {
        $invoices = Invoice::with('customer')->orderBy('id', 'DESC')->get();
        dd("success");
        return response()->json([
            'invoices' => $invoices
        ], 200);
    }

    public function search_invoice(Request $request)
    {
        $search = $request->s;

        if ($search != null) {
            $invoices = Invoice::with('customer')
                ->where('id', 'LIKE', "%$search%")
                ->get();

            return response()->json([
                'invoices' => $invoices
            ], 200);
        } else {
            return $this->get_all_invoice();
        }
    }

    public function new_invoice(Request $request)
    {

        $counter = Counter::where('key', 'invoice')->first();

        $invoice = Invoice::orderBy('id', 'DESC')->first();

        if ($invoice) {
            $invoice = $invoice->id;
            $counters = $counter->value + $invoice;
        } else {
            $counters = $counter->value;
        }

        $formData = [
            'number' => $counter->prefix . $counters,
            'customer_id' => null,
            'customer' => null,
            'date' => date('Y-m-d'),
            'due_date' => null,
            'reference' => null,
            'discount' => 0,
            'term_and_condition' => 'Default Terms And Condtions',
            'items' => [[
                'product_id' => null,
                'product' => null,
                'unit_price' => 0,
                'quantity' => 1
            ]]
        ];

        return response()->json($formData);
        // return "success";
    }

    public function add_invoice(Request $request)
    {

        $invoiceitems = $request->invoice_item;

        $invoicedata['sub_total'] = $request->sub_total;
        $invoicedata['total'] = $request->total;
        $invoicedata['customer_id'] = $request->customer_id;
        $invoicedata['number'] = $request->number;
        $invoicedata['date'] = $request->date;
        $invoicedata['due_date'] = $request->due_date;
        $invoicedata['discount'] = $request->discount;
        $invoicedata['reference_code'] = $request->reference;
        $invoicedata['terms_and_conditions'] = $request->terms_and_conditions;

        $invoice = Invoice::create($invoicedata);

        foreach (json_decode($invoiceitems) as $item) {
            $itemdata['product_id'] = $item->id;
            $itemdata['invoice_id'] = $invoice->id;
            $itemdata['quantity'] = $item->quantity;
            $itemdata['unit_price'] = $item->unit_price;

            $invoice_item = InvoiceItem::create($itemdata);
        }

        return response()->json([
            "message" => "successfully added"
        ], 200);
    }

    public function show_invoice($id)
    {
        $invoices = Invoice::with('customer', 'invoice_item.product')->find($id);

        return response()->json([
            'invoices' => $invoices,
        ]);
    }

    public function get_edit_data($id)
    {

        $data = Invoice::with('customer', 'invoice_item.product')->find($id);

        $formData = [
            'number' => $data->number,
            'customer_id' => $data->customer_id,
            'customer' => $data->customer,
            'date' => $data->date,
            'due_date' => $data->due_date,
            'reference' => $data->reference_code,
            'discount' => $data->discount,
            'sub_total' => $data->sub_total,
            'total' => $data->total,
            'term_and_condition' => $data->terms_and_conditions,
            'items' => $data->invoice_item
        ];

        return response()->json([
            'formData' => $formData
        ], 200);
    }

    public function update_invoice(Request $request)
    {
        $invoiceitems = $request->invoice_item;

        $invoicedata['sub_total'] = $request->sub_total;
        $invoicedata['total'] = $request->total;
        $invoicedata['customer_id'] = $request->customer_id;
        $invoicedata['number'] = $request->number;
        $invoicedata['date'] = $request->date;
        $invoicedata['due_date'] = $request->due_date;
        $invoicedata['discount'] = $request->discount;
        $invoicedata['reference_code'] = $request->reference;
        $invoicedata['terms_and_conditions'] = $request->terms_and_conditions;

        $invoice = Invoice::where('id', $request->invoice_id)->first()->update($invoicedata);

        $old_invoice_items = InvoiceItem::where('invoice_id', $request->invoice_id)->get();
        foreach ($old_invoice_items as $olditem) {
            $olditem->delete();
        }

        foreach (json_decode($invoiceitems) as $item) {

            $itemdata['product_id'] = $item->id;
            $itemdata['invoice_id'] = $request->invoice_id;
            $itemdata['quantity'] = $item->quantity;
            $itemdata['unit_price'] = $item->unit_price;

            $invoice_item = InvoiceItem::create($itemdata);
        }

        return response()->json([
            "message" => "successfully added"
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PurchaseItem;
use App\Models\PurchaseDetail;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($var)
    {
        $purchase = Purchase::where('id',$var)
                    ->with('supplier')
                    ->with('items.product.company')
                    ->withSum('items','amount')
                    ->withSum('items','discount_amount')
                    ->with('user')
                    ->first();
        $product = Product::all();
        return view('purchaseItem.create', ['purchase'=>$purchase, 'products'=>$product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        //
        $request->validate([
            'quantity' => 'required|min:1|max:10',
            'rate' => 'required|min:1|max:10',
            'sp' => 'required|max:100000000000|numeric',
            'mrp' => 'required|max:100000000000|numeric',
        ]);
        $check = Purchase::find($id);
        if($check->status == 'running'){
            $purchaseDetail = new PurchaseDetail;
            $purchaseItem = new PurchaseItem;

            $purchaseItem->quantity = $request->quantity;
            $purchaseItem->rate = $request->rate;
            $purchaseItem->amount = $request->rate*$request->quantity;
            $purchaseItem->discount = $request->discount;
            $purchaseItem->discount_amount = $request->discount/100 * ($request->rate * $request->quantity);
            $purchaseItem->product_id = $request->item;
            $purchaseItem->purchase_id = $id;
            $purchaseItem->save();

            $purchaseDetail->batch = (string) time();
            $purchaseDetail->quantity = $request->quantity;
            $purchaseDetail->sp = $request->sp;
            $purchaseDetail->mrp = $request->mrp;
            $purchaseDetail->purchase_id = $id;
            $purchaseDetail->purchase_item = $purchaseItem->id;
            $purchaseDetail->product_id = $request->item;
            $purchaseDetail->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        $request->validate([
            'shipping_charge' => 'nullable|max:100000000000|numeric',
            'adjustable_discount' => 'nullable|max:100000000000|numeric',
        ]);

        $previous_purchase = Purchase::where('id', $id)
                    ->with('items.product')
                    ->with('user')
                    ->with('supplier')
                    ->withSum('items', 'amount')
                    ->withSum('items', 'discount_amount')
                    ->first();

        if($previous_purchase->status == 'running'){
            $shipping_charge = 0;
            $adjustable_discount = 0;
            if($request->shipping_charge != null){
                $previous_purchase->shipping_charge = $request->shipping_charge;
                $shipping_charge = $request->shipping_charge;
            }
            if($request->adjustable_discount != null){
                $previous_purchase->adjustable_discount = $request->adjustable_discount;
                $adjustable_discount = $request->adjustable_discount;
            }
            $total_dis = $previous_purchase->items_sum_discount_amount;
            $total_amt = $previous_purchase->items_sum_amount;

            $previous_purchase->total_discount = $total_dis;
            $previous_purchase->total_amount = $total_amt;

            $unrounded_amount = $total_amt - $total_dis;
            $rounding_amount = number_format($unrounded_amount - round($unrounded_amount), 2);

            $previous_purchase->rounding_amount = $rounding_amount;
            $previous_purchase->net_amount = ($unrounded_amount - $rounding_amount) + $shipping_charge - $adjustable_discount;
            $previous_purchase->status = 'completed';
            $previous_purchase->save();

            #saving in the supplier ledger
            $supplierLedger = new SupplierLedger;

            $supplierLedger->date = $previous_purchase->date;
            $supplierLedger->purchase_type = $previous_purchase->purchase_type;
            $supplierLedger->invoice_no = $previous_purchase->invoice_no;
            $supplierLedger->debit = 0;
            $supplierLedger->credit = $previous_purchase->net_amount;
            $supplierLedger->balance = $previous_purchase->net_amount;
            $supplierLedger->supplier_id = $previous_purchase->supplier_id;
            $supplierLedger->user_id = Auth::id();
            $supplierLedger->save();
        }
        
        return view('purchaseItem.index', ['purchase'=>$previous_purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseItem $purchaseItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function display($id)
    {
        //
        $purchase = Purchase::where('id', $id)
                ->with('items.product')
                ->with('user')
                ->with('supplier')
                ->first();
        
        return view('purchaseItem.index', ['purchase'=>$purchase]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseItem  $purchaseItem
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $var)
    {
        //
        $purchase = Purchase::find($var);
        if($purchase->status == 'running'){
            PurchaseDetail::where('purchase_item', $id)->delete();
            PurchaseItem::where('id', $id)->delete();
        }
        return redirect()->route('purchaseItem.create', ['var'=>$var]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PurchaseDetail;
use App\Models\PurchaseItem;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\SupplierLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = PurchaseDetail::with('product')
                                ->where('status', '=', 'running')
                                ->get();
        return view('purchaseDetail.index', ['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $pid)
    {
        $data = Supplier::with('purchase.items.productDetails.product')
                ->with(['purchase.items'=> function ($query) {
                    $query->where('purchase_item_type', '!=', 'Return');
                }])
                ->find($id);
        // return $data;
        $details = PurchaseItem::with('product')->where('purchase_id', $pid)->get();

        return view('purchaseDetail.create', ['data'=>$data, 'details'=>$details, 'pid'=>$pid]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $pid)
    {
        $request->validate([
            'quantity' => 'required|min:1|max:10',
        ]);

        if(empty($request->product_id)){
            return back()->withFail('No Items Selected')->withInput();
        }
        
        $details = PurchaseDetail::with('purchaseItem.product')
                ->find($request->product_id);

        if(($request->quantity > $details->quantity) || ($request->quantity <= 0)){
            return redirect()->back()->with('error', 'Not Enough Quantity in the Stock')->withInput();
        } 
        $purchase = Purchase::find($pid);

        if($purchase->status == 'running'){
            PurchaseDetail::find($request->product_id)->decrement('quantity', $request->quantity);
            $isCompleted = PurchaseDetail::find($request->product_id);

            if($isCompleted->quantity == 0){
                $isCompleted->status = 'completed';
                $isCompleted->save();
            }

            $toUse = json_decode($details)->purchase_item;
            $total_amt = $toUse->rate * $request->quantity;
            $purchaseItem = new PurchaseItem;
            $purchaseItem->quantity = $request->quantity;
            $purchaseItem->rate = $toUse->rate;
            $purchaseItem->amount = $total_amt;
            $purchaseItem->discount = $toUse->discount;
            $purchaseItem->discount_amount =(($total_amt) * $toUse->discount)/100;
            $purchaseItem->product_id = $toUse->product_id;
            $purchaseItem->purchase_id = $pid;
            $purchaseItem->purchase_item_type = 'Return';
            $purchaseItem->save();
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $pid)
    {
        $purchase = Purchase::with('items.product')
                ->with('user')
                ->with('supplier')
                ->withSum('items', 'amount')
                ->withSum('items', 'discount_amount')
                ->find($pid);

        if($purchase->status == 'running'){
            $total_amt = $purchase->items_sum_amount;
            $total_dis = $purchase->items_sum_discount_amount;

            $purchase->total_discount = $total_dis;
            $purchase->total_amount = $total_amt;

            $unrounded_amount = $total_amt - $total_dis;
            $rounding_amount = number_format($unrounded_amount - round($unrounded_amount), 2);

            $purchase->rounding_amount = $rounding_amount;
            $purchase->net_amount = ($unrounded_amount-$rounding_amount);
            $purchase->status = 'completed';
            $purchase->save();

            //for inserting in supplier ledger
            $supplierLedger = new SupplierLedger;

            $supplierLedger->date = $purchase->date;
            $supplierLedger->purchase_type = $purchase->purchase_type;
            $supplierLedger->invoice_no = $purchase->invoice_no;
            $supplierLedger->debit = $purchase->net_amount;
            $supplierLedger->credit = 0;
            $supplierLedger->balance = $purchase->net_amount;
            $supplierLedger->supplier_id = $purchase->supplier_id;
            $supplierLedger->user_id = Auth::id();
            $supplierLedger->save();
        }

        return view('purchaseDetail.returnBill', ['purchase'=>$purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchaseDetail $purchaseDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchaseDetail  $purchaseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchaseDetail $purchaseDetail)
    {
        //
    }
}

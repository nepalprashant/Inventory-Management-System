<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Product;
use App\Models\PurchaseDetail;
use App\Models\PurchaseItem;
use App\Models\Supplier;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function data(){
    //     $data = Company::all()->count();
    //     return view('app', ['data'=>$data]);
    // }

    public function index()
    {
        //
        $data = Purchase::with('user')->with('supplier')->get();

        return view('purchase.index', ['purchase'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $supplier = Supplier::all();
        $purchase_t = ['Direct', 'Order', 'Return'];

        return view('purchase.create', ['suppliers'=>$supplier,
                                        'purchase_t'=>$purchase_t]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'invoice_no' => 'required|min:1|max:10'
        ]);

        if(Purchase::where('invoice_no', $request->invoice_no)->get()->isNotEmpty()){
            return redirect()->back()->withFail('The Purchase With Same Invoice No Already Exist.')->withInput();
        }

        $purchase = new Purchase;

        $purchase->date = date('Y-m-d');
        $purchase->invoice_no = $request->invoice_no;
        $purchase->supplier_id = $request->supplier;
        $purchase->purchase_type = $request->purchase_type;
        $purchase->user_id = Auth::id();
        $purchase->remark = $request->remark;
        $purchase->save();
        if($purchase->purchase_type == 'Return'){
            return redirect()->route('purchaseReturn.create', ['id'=>$purchase->supplier_id, 'pid'=>$purchase->id]);
        }
        return redirect()->route('purchaseItem.create', ['var'=>$purchase->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Purchase  $purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Purchase $purchase)
    {
        //
    }
}

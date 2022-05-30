<?php

namespace App\Http\Controllers;

use App\Models\SupplierLedger;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $supplier = Supplier::all();
        return view('supplierLedger.index', ['suppliers'=>$supplier]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierLedger  $supplierLedger
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        //
        $supplier = Supplier::all();

        $details = SupplierLedger::where('supplier_id', $request->supplier_id)
                                    ->get();
        // return $details;
        return view('supplierLedger.show', ['suppliers'=>$supplier, 'details'=>$details]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SupplierLedger  $supplierLedger
     * @return \Illuminate\Http\Response
     */
    public function edit(SupplierLedger $supplierLedger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierLedger  $supplierLedger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SupplierLedger $supplierLedger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierLedger  $supplierLedger
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierLedger $supplierLedger)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class InvoiceController  extends Controller
{
    // Show all listings
    public function index() {
        return view('invoices.index', [
            'invoices' => Invoice::latest()->filter(request(['date', 'no']))->paginate(10)
        ]);
    }

    //Show single listing
    public function show(Invoice $invoice) {
        return view('invoices.show', [
            'invoice' => $invoice
        ]);
    }

    // Show Create Form
    public function create() {
        return view('invoices.create');
    }

    // Store Listing Data
    public function store(Request $request) {
        $formFields = $request->validate([
            'title' => 'required',
            'no' => ['required', Rule::unique('invoices', 'no')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Invoice::create($formFields);

        return redirect('/')->with('message', 'Fatura kaydedildi.');
    }

    // Show Edit Form
    public function edit(Invoice $invoice) {
        return view('invoices.edit', ['invoice' => $invoice]);
    }

    // Update Listing Data
    public function update(Request $request, Invoice $invoice) {
        // Make sure logged in user is owner
        if($invoice->user_id != auth()->id()) {
            abort(403, 'Yetkisiz İşlem!');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $invoice->update($formFields);

        return back()->with('message', 'Fatura başarıyla güncellendi!');
    }

    // Delete Listing
    public function destroy(Invoice $invoice) {
        // Make sure logged in user is owner
        if($invoice->user_id != auth()->id()) {
            abort(403, 'Yetkisiz İşlem!');
        }
        
        if($invoice->logo && Storage::disk('public')->exists($invoice->logo)) {
            Storage::disk('public')->delete($invoice->logo);
        }
        $invoice->delete();
        return redirect('/')->with('message', 'Fatura sistemimizden kaldırıldı.');
    }

    // Manage Listings
    public function manage() {
        return view('invoices.manage', ['invoices' => auth()->user()->invoices()->get()]);
    }
}

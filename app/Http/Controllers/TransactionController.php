<?php

namespace App\Http\Controllers; // ต้องมี namespace นี้

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->query('month'); // format: YYYY-MM
        $query = Transaction::query();
        if ($month) {
            $query->whereMonth('transaction_date', substr($month,5,2))
                  ->whereYear('transaction_date', substr($month,0,4));
        }
        $transactions = $query->orderBy('transaction_date','desc')->get();
        return view('transactions.index', compact('transactions','month'));
    }

    public function create()
    {
        return view('transactions.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type'=>'required|in:income,expense',
            'title'=>'required|string|max:255',
            'amount'=>'required|numeric|min:0',
            'transaction_date'=>'required|date',
        ]);
        Transaction::create($data);
        return redirect()->route('transactions.index')->with('success','บันทึกสำเร็จ');
    }

    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'type'=>'required|in:income,expense',
            'title'=>'required|string|max:255',
            'amount'=>'required|numeric|min:0',
            'transaction_date'=>'required|date',
        ]);
        $transaction->update($data);
        return redirect()->route('transactions.index')->with('success','ปรับปรุงสำเร็จ');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success','ลบสำเร็จ');
    }

    public function report(Request $request)
    {
        $month = $request->query('month'); // YYYY-MM
        $query = Transaction::query();
        if ($month) {
            $query->whereMonth('transaction_date', substr($month,5,2))
                  ->whereYear('transaction_date', substr($month,0,4));
        }
        $transactions = $query->get();
        $totalIncome = $transactions->where('type','income')->sum('amount');
        $totalExpense = $transactions->where('type','expense')->sum('amount');
        $balance = $totalIncome - $totalExpense;

        return view('transactions.report', compact('transactions','month','totalIncome','totalExpense','balance'));
    }
}

<?php

namespace App\Http\Controllers\Deposit;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;


class DepositController extends Controller
{
    public function index(){
        return view('admin.deposit.index');
    }

    public function store(Request $request){
        $userData = Auth::user();
        
        $currentDate = Carbon::now()->toDateString();

        $deposit = new Transaction();
        $deposit->user_id          = $userData->id;
        $deposit->transaction_type = $request->transactionType;
        $deposit->amount           = $request->depositMoney;
        $deposit->fee              = 0;
        $deposit->date             = $currentDate;
        $deposit->save();

        $user          = User::find($userData->id);
        $user->balance = $user->balance + $request->depositMoney;
        $user->save();

        return response()->json([
            "status"=>"success",
           
        ]);
    }
    public function view(){
        $userData   =Auth::user();
        $allDeposit =Transaction::where('user_id',$userData->id)->get();
        $allAmount =  $allDeposit->sum('amount');

        return response()->json([
        "status"      =>"success",
        "allAmount"=>$allAmount,
         "allDeposit" =>$allDeposit,
        ]);

    }
}

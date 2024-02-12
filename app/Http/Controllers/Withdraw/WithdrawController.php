<?php

namespace App\Http\Controllers\Withdraw;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function index(){
       return view('admin.withdraw.index'); 
    }

    public function store(Request $request){
        $userData = Auth::user();
        $currentDate = Carbon::now()->toDateString();
        $userAccountType =  $userData->account_type;

        if($request->withdrawMoney >  $userData->amount){
            if($userAccountType === "Business"){
                $userTotalWithdrawAmount=Transaction::where('user_id',$userData->id)
                ->where('transaction_type', 'Withdraw')
                ->sum('amount');
                if($userTotalWithdrawAmount>=50000){
                    $fee = (0.015*$request->withdrawMoney)/100;
                    $user = User::find($userData->id);
                    $user->balance = $user->balance-($request->withdrawMoney+$fee);
                    $user->save();
    
                    $transaction = new Transaction();
                    $transaction->user_id = $userData->id;
                    $transaction->transaction_type = "Withdraw";
                    $transaction->amount = $request->withdrawMoney;
                    $transaction->fee = $fee;
                    $transaction->date = $currentDate;
                    $transaction->save();
                    return response()->json([
                        "status"=>"success"
                    ]);
    
                }
                else{
                    $fee = (0.025*$request->withdrawMoney)/100;
                    $user = User::find($userData->id);
                    $user->balance = $user->balance-($request->withdrawMoney+$fee);
                    $user->save();
    
                    $transaction = new Transaction();
                    $transaction->user_id = $userData->id;
                    $transaction->transaction_type = "Withdraw";
                    $transaction->amount = $request->withdrawMoney;
                    $transaction->fee = $fee;
                    $transaction->date = $currentDate;
                    $transaction->save();
                    return response()->json([
                        "status"=>"success"
                    ]);
                }
    
                
                
              
    
            }
        }
        else{
            return response()->json([
                "status"=>"failed",
                "message"=>"Withdraw Amount Is Greater Than Current Amount"
            ]);
          
        }
        
    }
}

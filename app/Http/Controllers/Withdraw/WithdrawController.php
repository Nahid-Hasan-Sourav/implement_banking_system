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

        if($request->withdrawMoney < $userData->balance){
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

            if($userAccountType === "Individual"){
                $currentMonth = Carbon::now()->month;
                $currentYear = Carbon::now()->year;

                $currentDayName = Carbon::now()->format('l');
                if($currentDayName === "Friday"){

                    $user = User::find($userData->id);
                    $user->balance = $user->balance-$request->withdrawMoney;
                    $user->save();
    
                    $transaction = new Transaction();
                    $transaction->user_id = $userData->id;
                    $transaction->transaction_type = "Withdraw";
                    $transaction->amount = $request->withdrawMoney;
                    $transaction->fee = 0;
                    $transaction->date = $currentDate;
                    $transaction->save();
                    return response()->json([
                        "status"=>"success"
                    ]);
                    
                }

                $userTotalWithdrawAmount = Transaction::where('user_id', $userData->id)
                ->where('transaction_type', 'Withdraw')
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth)
                ->sum('amount');

                if($userTotalWithdrawAmount <= 5000){
                    
                 if($userTotalWithdrawAmount+$request->withdrawMoney>5000){

                    if($request->withdrawMoney<=1000){
                    $user = User::find($userData->id);
                    $user->balance = $user->balance-$request->withdrawMoney;
                    $user->save();
    
                    $transaction = new Transaction();
                    $transaction->user_id = $userData->id;
                    $transaction->transaction_type = "Withdraw";
                    $transaction->amount = $request->withdrawMoney;
                    $transaction->fee = 0;
                    $transaction->date = $currentDate;
                    $transaction->save();
                    return response()->json([
                        "status"=>"success"
                    ]);
                    }
                    else{
                        $extraAmountGreaterThanOneThousand = $request->withdrawMoney-1000;
                        $fee = (0.015*  $extraAmountGreaterThanOneThousand)/100;
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
                 else{
                    $user = User::find($userData->id);
                    $user->balance = $user->balance-$request->withdrawMoney;
                    $user->save();
    
                    $transaction = new Transaction();
                    $transaction->user_id = $userData->id;
                    $transaction->transaction_type = "Withdraw";
                    $transaction->amount = $request->withdrawMoney;
                    $transaction->fee = 0;
                    $transaction->date = $currentDate;
                    $transaction->save();
                    return response()->json([
                        "status"=>"success"
                    ]);
                 }
                }

                else{
                    if($request->withdrawMoney<=1000){
                    $user = User::find($userData->id);
                    $user->balance = $user->balance-$request->withdrawMoney;
                    $user->save();
    
                    $transaction = new Transaction();
                    $transaction->user_id = $userData->id;
                    $transaction->transaction_type = "Withdraw";
                    $transaction->amount = $request->withdrawMoney;
                    $transaction->fee = 0;
                    $transaction->date = $currentDate;
                    $transaction->save();
                    return response()->json([
                        "status"=>"success"
                    ]);
                    }
                    else{
                        $extraAmountGreaterThanOneThousand = $request->withdrawMoney-1000;
                        $fee = (0.015*  $extraAmountGreaterThanOneThousand)/100;
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


        }
        else{

            return response()->json([
                "status"=>"failed",
                "message"=>"Withdraw Amount Is Greater Than Current Amount"
            ]);
          
        }
        
    }

    public function view(){
        $userData    =Auth::user();
        $allWithdraw =Transaction::where('user_id',$userData->id)->get();
        $totalWithdrawBalance =  $allWithdraw->sum('amount');

        return response()->json([
            "status"=>"success",
            "totalWithdrawBalance"=>$totalWithdrawBalance,
            "allWithdraw" =>$allWithdraw 
        ]);
    }
}

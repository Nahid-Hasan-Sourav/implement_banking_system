@extends('admin.master')


@section('body')
<div class="container">
    <div class="d-flex justify-content-between">
        <h3>All Withdraw Transactions </h3>
        <div class="d-flex ">
            <button class="btn btn-success btn-md mr-3" id="withdrawOpenModalBtn">Withdraw</button>
           
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between my-3">
       <div class="d-flex">
        <h4>TOTAL WITHDRAW BALANCE : </h4><h4 id="withdrawTotalAmount" class="mx-2">000</h4>
       </div>
      
    </div>
    <table class="table table-dark my-3">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Amount</th>
            <th scope="col">Fee</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody id="withdrawTableBody">
          {{-- <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            
          </tr> --}}
        
        </tbody>
      </table>
      @include('admin.withdraw.modal.index')

</div>
@endsection
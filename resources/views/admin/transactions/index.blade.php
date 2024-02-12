@extends('admin.master')


@section('body')
<div class="container">
    <div class="d-flex justify-content-between">
        <h3>All Transactions </h3>
        <div class="d-flex ">
            <button class="btn btn-success btn-md mr-3" id="depositOpenModalBtn">Deposit</button>
            <button class="btn btn-success btn-md" id="withdrawOpenModalBtn">Withdraw</button>
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between my-3">
       <div class="d-flex">
        <h4>CURRENT BALANCE : </h4><h4>000</h4>
       </div>
       <div class="d-flex">
        <h4 class="">WITHDRAW BALANCE : </h4><h4 class=" mx-2">000</h4>
        <h4>DEPOSIT BALANCE : </h4><h4 class=" mx-2">000</h4>
       </div>
    </div>
    <table class="table table-dark my-3">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Transaction Type  </th>
            <th scope="col">Amount</th>
            <th scope="col">Fee</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td>@mdo</td>
          </tr>
        
        </tbody>
      </table>
      @include('admin.transactions.modal.deposit.index')

</div>
@endsection
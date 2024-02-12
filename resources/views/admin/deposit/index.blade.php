@extends('admin.master')


@section('body')
<div class="container">
    <div class="d-flex justify-content-between">
        <h3>All Deposit Transactions </h3>
        <div class="d-flex ">
            <button class="btn btn-success btn-md mr-3" id="depositOpenModalBtn">Deposit</button>
           
        </div>
    </div>
    <hr>
    <div class="d-flex justify-content-between my-3">
       <div class="d-flex">
        <h4>CURRENT DEPOSIT BALANCE : </h4><h4 id="totalAmount" class="mx-2">000</h4>
       </div>
      
    </div>
    <table class="table table-dark my-3">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Amount</th>
            <th scope="col">Date</th>
          </tr>
        </thead>
        <tbody id="depositTableBody">
          {{-- <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            
          </tr> --}}
        
        </tbody>
      </table>
      @include('admin.deposit.modal.index')

</div>
@endsection
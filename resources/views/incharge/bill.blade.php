@extends('layouts.incharge')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="x_panel">
            <div class="x_content">
            @foreach($accountBill as $Bill)
                <section class="content invoice">
                    <!-- title row -->
                    <!-- info row -->
                    <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                        <img src="{{ asset('img/logo.png') }}" alt="" style="width:50px;">
                            
                            <br><strong>ATP Caltex Station</strong>
                            <br>Purok La Joma,
                            <br>San Jose, Aurora
                            <br>Zamboanga Del Sur
                            
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-4 invoice-col">
                        To
                        <address>
                            <strong>{{ucwords($Bill->account->lname)}}, {{ucwords($Bill->account->fname)}} {{ucwords($Bill->account->mname)}}</strong>
                            <br>{{ucwords($Bill->account->address)}}
                            <br>Phone: 1 (804) 123-9876
                            <br>Email: jon@ironadmin.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-4 invoice-col">
                        <b>Bill #: {{$Bill->billnum}}</b>
                        <br>
                        <b>Date:</b> {{$Bill->billdate}}
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                    <div class="col-xs-12 table">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Invoice #</th>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Plate #</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        @forelse($dataCreditPetrol as $CreditPetrol)
                            <tr>
                            <td>{{$CreditPetrol->invoicenum}}</td>
                            <td>{{$CreditPetrol->creditdate}}</td>
                            <td>{{$CreditPetrol->gas->gasname}}</td>
                            <td>{{$CreditPetrol->platenumber}}</td>
                            <td>{{$CreditPetrol->quantity}}</td>
                            <td>{{number_format($CreditPetrol->unitprice,2)}}</td>
                            <td>{{number_format($CreditPetrol->amount,3)}}</td>
                            </tr>
                            @empty
                            <tr>
                            <td colspan="6">No Record</td>
                            </tr>
                            @endforelse
                            
                            @forelse($dataCreditProduct as $CreditProduct)
                            <tr>
                            <td>{{$CreditProduct->invoicenum}}</td>
                            <td>{{$CreditPetrol->creditdate}}</td>
                            <td>{{$CreditProduct->productdetails->productname}}</td>
                            <td>{{$CreditProduct->platenumber}}</td>
                            <td>{{$CreditProduct->quantity}}</td>
                            <td>{{number_format($CreditProduct->unitprice,2)}}</td>
                            <td>{{number_format($CreditProduct->amount,3)}}</td>
                            </tr>
                            @empty
                            <tr>
                            <td colspan="6">No Record</td>
                            </tr>
                            @endforelse
                        </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    @foreach($accountBill as $Bill)
                    <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                    Prepared by: <br>
                    <br>
                    <br>
                    <div style="margin-left:50px;" >
                    <strong>
                        @foreach($accountBill as $Bill)
                        {{$Bill->user->name}}
                        @endforeach
                        </strong>
                    </div>
                    <br> 
                    Recieved by: <br>
                    <br>
                    <br>
                    
                    -------------------------  
                   
                    <br> 
                    Recieved Date: <br>
                    <br>
                    -------------------------  
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th style="width:50%">Total Amount Due:</th>
                                <td>{{number_format($Bill->amount,3)}}</td>
                            </tr>
                            <tr>
                                <th>Less Discount</th>
                                <td>{{number_format($Bill->discount,3)}}</td>
                            </tr>
                            <tr>
                                <th>Amount Due :</th>
                                <td>{{number_format($Bill->totalamount,3)}}</td>
                            </tr>
                            <tr>
                                <th>Previous Balance :</th>
                                <td>{{number_format($Bill->prevbal,3)}}</td>
                            </tr>
                            <tr>
                                <th>Grand Total Amount :</th>
                                <td><?php
                                    $grandTotal = $Bill->totalamount + $Bill->prevbal;
                                    ?>
                                    {{number_format($grandTotal,3)}}
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        
                        
                        
                        </div>
                    </div>
                    <!-- /.col -->
                    </div>
                    @endforeach
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                    <div class="col-xs-12">
                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                       
                    </div>
                    </div>
                </section>
            @endforeach
            </div>
        </div>
    </div><!--row-->
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboardscript.js') }}"></script>

@endsection
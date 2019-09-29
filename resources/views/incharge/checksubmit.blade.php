@extends('layouts.incharge')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="page-title">
            <div class="title_left">
            <h3>
                Daily Sales Report
            </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12 col-lg-12">
        <div class="x_panel tile">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    
                    <div class="x_title">
                        <h4>Pumps</h4>
                    </div>
                    <div class="x_content">
                        <form action="{{ route('savepumplog') }}" method="post">
                            <input type="hidden" name="branchid" class="form-control" id="branchid" value="{{$BranchId}}">
                            {{ csrf_field() }}
                            <table class="table table-striped" id="table">
                                <thead>
                                <tr>
                            
                                    <th> Name</th>
                                    <th> Opening</th>
                                    <th> Closing</th>
                                    <th> Volume </th>
                                    <th> Unit Price </th>
                                    <th> Amount </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    $totalVolume = 0;
                                    $totalAmount = 0;
                                ?>
                                @forelse($dataPumplog as $Pump)
                                <tr class="item{{$Pump->id}}">
                                    
                                    <td>{{$Pump->pump->pumpname}}</td>
                                    <td>{{$Pump->openvolume}}</td>
                                    <td>{{$Pump->closevolume}}</td>
                                    <td>{{$Pump->consumevolume}}</td>
                                    <td>{{$Pump->unitprice}}</td>
                                    <td >{{$Pump->amount}}</td>
                                    <?php 
                                        $totalVolume = $totalVolume + $Pump->consumevolume; 
                                        $totalAmount = $totalAmount + $Pump->amount;
                                    ?>
                                </tr>
                                @empty
                                
                                @endforelse
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total Volume</strong></td>
                                    <td>{{number_format($totalVolume,3)}}</td>
                                    <td class="text-right"><strong>Total Amount</strong></td>
                                    <td >{{number_format($totalAmount, 3) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div><!--x_content-->
                   
                </div><!--col-->
            </div>
            <div class="x_panel tile">        
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <div class="x_content">
                        <div class="row">
                        <div class="col-lg-6">
                                <div class="x_title">
                                    <h4>Discount</h4>
                                </div>
                                <table class="table table-striped" id="discounttable">
                                    <thead>
                                    <tr>
                                    
                                    <td>Account</td>
                                    <td>Product</td>
                                    <td>Plate #</td>
                                    
                                    <td class="text-right">Amount</td>
                                    </tr>
                                    </thead>
                                    <?php $totalDiscount = 0; ?>
                                    @forelse($dataBranchdiscount as $Branchdiscount)
                                    <tr class='discountitem{{$Branchdiscount->id}}'>
                                    
                                    <?php 
                                        $disaccountname = explode(",",$Branchdiscount->account);
                                        $disgasname = explode(",",$Branchdiscount->gasname);
                                    ?>
                                    <td>{{$disaccountname[0]}}, {{$disaccountname[1]}}</td>
                                    <td>{{$disgasname[0]}}</td>
                                    <td>{{$Branchdiscount->platenum}}</td>
                                    <td class="text-right">{{$Branchdiscount->amount}}</td>
                                    </tr>
                                    <?php $totalDiscount = $totalDiscount + $Branchdiscount->amount;?>
                                    @empty
                                    <tr>
                                    <td colspan="6" id="nosalerecord"><em>No Record</em></td>
                                    </tr>
                                    
                                    @endforelse
                                    <tr>
                                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                                        <td class="text-right">{{number_format($totalDiscount,3) }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <div class="x_title">
                                    <h4>Credit</h4>
                                </div>
                                <table class="table table-striped" id="credittable">
                                    <thead>
                                    <tr>
                                    <td>Invoice #</td>
                                    <td>Account</td>
                                    <td>Product</td>
                                    <td>Plate #</td>
                                    <td>Liters</td>
                                    <td class="text-right">Amount</td>
                                    </tr>
                                    </thead>
                                    <?php 
                                        $totalCredit = 0;
                                    ?>
                                    @forelse($dataBranchcredit as $Branchcredit)
                                    <tr class='credititem{{$Branchcredit->id}}'>
                                    <td>{{$Branchcredit->invoice}}</td>
                                    <?php 
                                        $accountname = explode(",",$Branchcredit->account);
                                        $gasname = explode(",",$Branchcredit->gasname);
                                    ?>
                                    <td>{{$accountname[0]}}, {{$accountname[1]}}</td>
                                    <td>{{$gasname[0]}}</td>
                                    <td>{{$Branchcredit->creditplatenum}}</td>
                                    <td>{{$Branchcredit->liters}}</td>
                                    <td class="text-right">{{$Branchcredit->amount}}</td>
                                    </tr>
                                    <?php $totalCredit = $totalCredit + $Branchcredit->amount; ?>
                                    @empty
                                    <tr>
                                    <td colspan="6" id="nocreditrecord"><em>No Record</em></td>
                                    </tr>
                                    
                                    @endforelse
                                    <tr>
                                        <td colspan="5" class="text-right"><strong>Total</strong></td>
                                        <td>{{number_format($totalCredit,3) }}</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    
                    </div><!--x_content-->
                </div><!--col-->
            </div>
            <div class="x_panel tile">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    
                    <div class="x_content">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="x_title">
                                    <h4>Sales</h4>
                                </div>
                                <table class="table table-striped" id="saletable">
                                    <thead>
                                    <tr>
                                    <td>Invoice</td>
                                    <td>Type</td>
                                    <td>Account</td>
                                    <td>Product</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td class="text-right">Amount</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $totalSales = 0;
                                    ?>
                                    @forelse($dataBranchsale as $Branchsale) 
                                    <?php 
                                        $saleaccountname = explode(",",$Branchsale->account);
                                        $saleproduct = explode(",",$Branchsale->product);
                                    ?>
                                    <tr class='saleitem{{$Branchsale->id}}'>
                                        <td>{{$Branchsale->invoice}}</td>
                                        <td>{{$Branchsale->paymenttype}}</td>
                                        <?php 
                                            if($saleaccountname[2] == 0){       
                                        ?>
                                        <td></td>
                                        <?php  
                                        } else {
                                        ?>
                                        <td>{{$saleaccountname[0]}}, {{$saleaccountname[1]}}</td>
                                        <?php }
                                        ?>
                                        <td>{{$saleproduct[0]}}</td>
                                        <td>{{$Branchsale->quantity}}</td>
                                        <td>{{$Branchsale->price}}</td>
                                        <td class="text-right">{{$Branchsale->amount}}</td>
                                    </tr>
                                    <?php $totalSales = $totalSales + $Branchsale->amount; ?>
                                    @empty
                                    <tr>
                                    <td colspan="6" id="nosalesrecord"><em>No Record</em></td>
                                    </tr>
                                    @endforelse
                                    <tr>
                                        <td colspan="6" class="text-right"><strong>Total</strong></td>
                                        <td class="text-right">{{number_format($totalSales,3) }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <div class="x_title">
                                    <h4>Others</h4>
                                </div>
                                <table class="table table-striped" id="otherstable">
                                    <thead>
                                    <tr>
                                    
                                    <td>Description</td>
                                    <td class="text-right">Amount</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $totalOthers = 0; 
                                    ?>
                                    @forelse($dataBranchother as $Branchother) 
                                        <tr class='otheritem{{$Branchother->id}}'>
                                            <td>{{$Branchother->desc}}</td>
                                            <td class="text-right">{{$Branchother->amount}}</td>
                                        </tr>
                                        <?php $totalOthers = $totalOthers + $Branchother->amount;?>
                                    @empty
                                    <tr>
                                    <td colspan="3" id="nootherrecord"><em>No Record</em></td>
                                    </tr>
                                    @endforelse
                                    <tr >
                                        <td class="text-right">Total Amount</td>
                                        <td class="text-right">{{number_format($totalOthers, 3)}}</td>
                                    </tr>
                                    </tbody>
                                </table>           
                            </div>
                        </div>

                    </div><!--x_content-->
                    <div class="row">
                        <div class="col-lg-6"></div>
                        <div class="col-lg-6">
                                <div class="x_title">
                                    <h4>Summary</h4>
                                </div>
                                <table class="table table-striped" id="otherstable">
                                    <thead>
                                    <tr>
                                    
                                    <td>Product</td>
                                    <td>Price</td>
                                    <td>Total Volume</td>
                                    <td>Amount</td>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $totalAmountSummary = 0; 
                                    ?>
                                    @forelse($arrayGas as $gassummary) 
                                        <tr>
                                            <td>{{$gassummary[0]}}</td>
                                            <td>{{$gassummary[2]}}</td>
                                            <td>{{$gassummary[1]}}</td>
                                            <td>{{number_format($gassummary[1] * $gassummary[2], 3)}}</td>
                                        </tr>
                                        <?php 
                                            $gasAmount = $gassummary[1] * $gassummary[2];
                                            $totalAmountSummary = $totalAmountSummary + $gasAmount;?>
                                    @empty
                                    <tr>
                                    <td colspan="4" id=""><em>No Record</em></td>
                                    </tr>
                                    @endforelse
                                    <tr >
                                        <td class="text-right" colspan="3"><strong>Total Amount</strong>  </td>
                                        <td >{{number_format($totalAmountSummary, 3)}}</td>
                                    </tr>
                                    </tbody>
                                </table> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4"><a href="/incharge/backdashboard" class="btn btn-info btn-lg">BACK</a><a href="/incharge/report-save/{{$logsession}}" class="btn btn-info btn-lg">SAVE</a></div>
                        <div class="col-lg-4"></div>
                    </div>
                    
                </div><!--col-->
            </div>
        </div><!--col-->
    </div><!--row-->
    </div>


@endsection
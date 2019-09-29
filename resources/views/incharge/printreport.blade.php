
<style type="text/css">
table td, table th {
    padding:5px 10px;
    border: 1px solid black;
}
.text-right {
    text-align:right;
}
table {
    border-collapse: collapse;
    width:100%;
}
.no-print{
    padding:10px;
    margin: 0 auto;
}
.no-print button{
    padding:10px;
    cursor:pointer;
}
.btn-back {
    border:1px solid black;
    padding:9px 10px;
    text-decoration:none;
    font-size:12px;
    color:black;
    border-style: solid;
    background:rgb(209, 209, 209) ;
    border-color: rgb(216, 216, 216) rgb(209, 209, 209) rgb(186, 186, 186);
    border:1px solid rgb(186, 186, 186);
}
@media print {
 /* styles go here */
 .no-print {
     display:none;
 }
}

</style>
<div class="right_col" role="main">
    <div class="row">
        <div class="page-title">
            <div class="title_left">
            <h3>
                Daily Sales Report - {{$dataDate['datelog']}}
            </h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-lg-12">
        <div class="x_panel tile">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    
                    <div class="x_title">
                        <h4>Pumps</h4>
                    </div>
                    <div class="x_content">
                            <table class="table table-striped table-pump" id="table" style="">
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
                                    <td class="text-right">{{number_format($Pump->unitprice,3)}}</td>
                                    <td class="text-right">{{number_format($Pump->amount,3)}}</td>
                                    <?php 
                                        $totalVolume = $totalVolume + $Pump->consumevolume; 
                                        $totalAmount = $totalAmount + $Pump->amount;
                                    ?>
                                </tr>
                                @empty
                                
                                @endforelse
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total Volume</strong></td>
                                    <td>{{number_format($totalVolume,2)}}</td>
                                    <td class="text-right"><strong>Total Amount</strong></td>
                                    <td class="text-right" >{{number_format($totalAmount, 3) }}</td>
                                    </tr>
                                </tbody>
                            </table>
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
                                    
                                    <th>Account</th>
                                    <th>Product</th>
                                    <th>Plate #</th>
                                    
                                    <th class="text-right">Amount</th>
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
                                    <td class="text-right">{{number_format($Branchdiscount->amount,3)}}</td>
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
                                    <th>Invoice #</th>
                                    <th>Account</th>
                                    <th>Product</th>
                                    <th>Plate #</th>
                                    <th>Liters</th>
                                    <th class="text-right">Amount</th>
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
                                    <td class="text-right" >{{$Branchcredit->liters}}</td>
                                    <td class="text-right">{{number_format($Branchcredit->amount,3)}}</td>
                                    </tr>
                                    <?php $totalCredit = $totalCredit + $Branchcredit->amount; ?>
                                    @empty
                                    <tr>
                                    <td colspan="6" id="nocreditrecord"><em>No Record</em></td>
                                    </tr>
                                    
                                    @endforelse
                                    <tr>
                                        <td colspan="5" class="text-right"><strong>Total</strong></td>
                                        <td class="text-right" >{{number_format($totalCredit,3) }}</td>
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
                                    <th>Invoice</th>
                                    <th>Type</th>
                                    <th>Account</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th class="text-right">Amount</th>
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
                                        <td class="text-right">{{number_format($Branchsale->price,3)}}</td>
                                        <td class="text-right">{{number_format($Branchsale->amount,3)}}</td>
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
                                <table class="table table-striped" id="otherstable" style="wi">
                                    <thead>
                                    <tr>
                                    
                                    <th>Description</th>
                                    <th class="text-right">Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $totalOthers = 0; 
                                    ?>
                                    @forelse($dataBranchother as $Branchother) 
                                        <tr class='otheritem{{$Branchother->id}}'>
                                            <td>{{$Branchother->desc}}</td>
                                            <td class="text-right">{{number_format($Branchother->amount,3)}}</td>
                                        </tr>
                                        <?php $totalOthers = $totalOthers + $Branchother->amount;?>
                                    @empty
                                    <tr>
                                    <td colspan="3" id="nootherrecord"><em>No Record</em></td>
                                    </tr>
                                    @endforelse
                                    <tr >
                                        <td class="text-right"><strong>Total Amount</strong></td>
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
                                    
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Total Volume</th>
                                    <th>Amount</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $totalAmountSummary = 0; 
                                    ?>
                                    @forelse($arrayGas as $gassummary) 
                                        <tr>
                                            <td>{{$gassummary[0]}}</td>
                                            <td class="text-right" >{{number_format($gassummary[2],3)}}</td>
                                            <td class="text-right" >{{$gassummary[1]}}</td>
                                            <td class="text-right" >{{number_format($gassummary[1] * $gassummary[2], 3)}}</td>
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
                                        <td class="text-right" colspan="3" align="right"><strong>Total Amount</strong>  </td>
                                        <td class="text-right" >{{number_format($totalAmountSummary, 3)}}</td>
                                    </tr>
                                    <?php 
                                    $amountSummary = $totalAmountSummary - $totalCredit;
                                    ?>
                                    <tr >
                                        <td class="text-right" colspan="3" align="right"><strong>Cash</strong>  </td>
                                        <td class="text-right" >{{number_format($totalAmountSummary, 3)}}</td>
                                    </tr>
                                    <tr >
                                        <td class="text-right" colspan="3" align="right"><strong>Credit</strong>  </td>
                                        <td class="text-right" >{{number_format($totalCredit, 3)}}</td>
                                    </tr>
                                    <tr >
                                        <td class="text-right" colspan="3" align="right"><strong>Discount</strong>  </td>
                                        <td class="text-right" >{{number_format($totalDiscount, 3)}}</td>
                                    </tr>
                                    <tr >
                                        <td class="text-right" colspan="3" align="right"><strong>Others</strong>  </td>
                                        <td class="text-right" >{{number_format($totalOthers, 3)}}</td>
                                    </tr>
                                    <tr >
                                        <td class="text-right" colspan="3" align="right"><strong>BIR Form</strong>  </td>
                                        <td class="text-right" >{{number_format($totalOthers, 3)}}</td>
                                    </tr>
                                    <tr >
                                        <td class="text-right" colspan="3" align="right"><strong>Total Amount</strong>  </td>
                                        <td class="text-right" >{{number_format($totalAmountSummary, 3)}}</td>
                                    </tr>
                                    </tbody>
                                </table> 
                        </div>
                    </div>
                    <div class="row no-print">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4"><button onclick="window.print();" class="btn btn-info btn-lg"> <i class="fa fa-print"></i> Print</button>
                        <a href="/incharge/dashboard" class="btn btn-info btn-lg btn-back"> <i class="fa fa-print"></i> Back</a>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                    
                </div><!--col-->
            </div>
        </div><!--col-->
    </div><!--row-->
    </div>

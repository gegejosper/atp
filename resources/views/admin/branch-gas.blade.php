@extends('layouts.admin')

@section('content')

<div class="right_col" role="main">
<div class="row"> 
<div class="page-title">
        <div class="title_left">
        <h3>
            @foreach($Branches as $Branch)
                {{$Branch->branchname}} Branch
            @endforeach 
        </h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12  col-sm-12 col-xs-12">
          <div class="x_panel">
                  <div class="x_title">
                    <h4>Branch Menu  
                        
                    </h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @include('admin.includes.branch-menu')
                  </div>
            </div>
        </div>            
</div>  
<div class="row">
    <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h4>Petrol</h4>
            <!-- /widget-header -->
            <div class="widget-content">
                <table class="table table-striped">
                    <tbody>
                    {{ csrf_field() }}   
                    @forelse($Gas as $Gastype)
                    <tr class="productitem{{$Gastype->id}}">
                        
                        <td>{{$Gastype->gasname}} </td>
                        <td>
                            <button class='addbranch btn btn-xs btn-success' data-id='{{$Gastype->id}}' data-gasid='{{$Gastype->gasid}}' data-productname='{{$Gastype->gasname}}' data-branchid='{{$BranchId}}'><i class='fa fa-plus'></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;"><em>All Petrol Types Available to Branch </em></td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /widget-content --> 
        </div>            
    <!-- /container --> 
    </div>

    <div class="col-md-6 col-lg-8 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h4>Petrolium Products</h4>
            <!-- /widget-header -->
            <div class="x_content">
                @foreach($dataBranchgas as $Branchgas)  
                <h4>{{$Branchgas->gas['gasname']}}</h4>
                <?php 
                $tankvolume = 24000; 
                $tankavailable = $Branchgas->volume;
                $tankdiff =   $tankvolume - $tankavailable;
                $tankpercent = ($tankdiff / $tankvolume) * 100;
                if($tankpercent >= 76){
                    $tankprogress = "progress-bar-danger";
                    $tankwidth = 100 - $tankpercent;
                }
                else if($tankpercent >= 26 && $tankpercent <= 75){
                    $tankprogress = "progress-bar-warning";   
                    $tankwidth = 100 - $tankpercent;
                }
                else if($tankpercent <= 25){
                    $tankprogress = "progress-bar-success";   
                    $tankwidth = 100 - $tankpercent;
                }
                else {
                    $tankprogress = "progress-bar-info";
                }
                ?>
                
                <label for="">{{number_format($Branchgas->volume,2)}} <em class="cubic"> m<sup>3</sup></em> @ {{$Branchgas->price}} php/L </label> 
                <button class='update-modal btn btn-xs btn-info' data-id='{{$Branchgas->id}}' data-gasname="{{$Branchgas->gas['gasname']}}" data-volume='{{$Branchgas->volume}}' data-price='{{$Branchgas->price}}' data-gasid='{{$Branchgas->gasid}}' data-branchid='{{$BranchId}}'><i class='fa fa-pencil'></i></button>
                <div class="progress">
                    <div class="progress-bar {{$tankprogress}}" data-transitiongoal="{{$tankwidth}}" aria-valuenow="{{$tankwidth}}" style="width: {{$tankwidth}}%;">{{number_format($Branchgas->volume,2)}} <em class="cubic"> m<sup>3</sup></em></div>
                </div>
                @endforeach
            </div><!--x_content-->
            <!-- /widget-content --> 
        </div>            
    <!-- /container --> 
    </div>
    
</div>
<!-- /main -->
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">	
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="fid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="product_name" >Product Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="productedit_name" name="productedit_name">
                        </div>
                    </div>
                </form>
                <div class="deleteContent">
                    Are you sure you want to delete <span class="dname"></span> ? <span
                        class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="updateGasModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    {{ csrf_field() }}
                    <div class="form-group">	
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="branchid">
                            <input type="hidden" class="form-control" id="branchgasid">
                            <input type="hidden" class="form-control" id="gasid">
                            <input type="hidden" class="form-control" id="fid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="Price" >Gas Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="gasname" name="gasname" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="Price" >Price:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="priceedit" name="priceedit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="Volume" >Volume:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="volumeedit" name="volumeedit">
                        </div>
                    </div>
                </form>
                <div class="deleteContent">
                    Are you sure you want to delete <span class="dname"></span> ? <span
                        class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_update_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/branchgasscript.js') }}"></script>
<!-- /main -->
@endsection
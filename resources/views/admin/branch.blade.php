@extends('layouts.admin')

@section('content')
<div class="right_col" role="main">
<div class="row"> 
<div class="page-title">
        <div class="title_left">
        <h3>
            @foreach($dataBranch as $Branch)
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
<!-- <div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pumps   
                </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {{ csrf_field() }}                              
                <div class="input-group col-lg-12">
                    <input type="text" class="form-control" placeholder="Pump Name"  aria-describedby="basic-addon2" name="branch_name">
                </div>
                <div class="input-group col-lg-12">
                    <select name="gastype" id="" class="form-control">
                        @foreach($dataGastype as $Gastype)
                            <option value="{{$Gastype->id}}">{{$Gastype->gasname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group col-lg-12">
                    <button class="btn btn-primary" type="submit" id="add">Save</button> 
                </div>

                <table class="table table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                        <th> #</th>
                        <th> Name</th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataPump as $Pump)
                    <tr class="item{{$Pump->id}}">
                        <td>{{$Pump->id}}</td>
                        <td>{{$Pump->pumpname}}</td>
                        <td class='td-actions'>
                            <button class='edit-modal btn btn-small btn-success' data-id='{{$Pump->id}}' data-name='{{$Pump->pumpname}}'><i class='fa fa-pencil'> Edit</i></button>
                            <a class='delete-modal btn btn-danger btn-small' data-id='{{$Pump->id}}'><i class='fa fa-times'>Remove</i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>   
             
</div> -->
</div>
<script src="{{ asset('js/app.js') }}"></script>

<!-- /main -->
@endsection
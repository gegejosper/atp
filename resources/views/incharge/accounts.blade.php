@extends('layouts.incharge')

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
        <div class="col-lg-6">
            <form class="form-horizontal" action="{{ route('searchaccount')}}" method="post">
            {{ csrf_field() }}
                <fieldset>
                    <div class="control-group">
                    <div class="controls">             
                        <div class="row-">
                            <div class="col-lg-6">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-user"></i></span>
                                    <input type="text" style="width: 200px" name="searchaccount" id="searchaccount" class="form-control" placeholder="Search account">
                                </div>
                            </div>
                        </div>   
                    </div>
                    </div>
                </fieldset>
            </form>
        </div>
        <div class="x_content">
            <table class="table table-striped" id="table">
                <thead>
                <tr>
                    <th> Account #</th>
                    <th> Account Name</th>                  
                    <th> Address</th>
                    <th> Contact #</th>
                    <th> Action </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody class="accountresult">
                @foreach($dataAccount as $Account)
                <tr class="item{{$Account->id}}">
                    
                    <td><a href="/incharge/account/{{$Account->id}}">{{$Account->id}}</a></td>
                    <td><a href="/incharge/account/{{$Account->id}}">{{$Account->lname}}, {{$Account->fname}} {{$Account->mname}}</a></td>
                    <td>{{$Account->address}}</td>
                    <td>{{$Account->contactnum}}</td>
                    <td class='td-actions'>
                        <a href="/incharge/account/{{$Account->id}}" class='btn btn-info btn-small'><i class='fa fa-search'></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div><!--row-->
</div>

<script type="text/javascript">
$('#searchaccount').on('keyup',function(){
  $value=$(this).val();
  $.ajax({
    type : 'get',
    url : '{{URL::to("/incharge/search")}}',
    data:{'search':$value},
    success:function(data){
      $('.accountresult').html(data);
    } 
  });
})
</script> 
<script type="text/javascript">
$.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboardscript.js') }}"></script>

@endsection
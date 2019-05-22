@extends('layouts.admin')

@section('content')
<div class="right_col" role="main">
          <!-- top tiles -->
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Members</span>
              <div class="count">{{$Member}}</div>   
            </div>
          
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-bank"></i> Total Regions</span>
              <div class="count">{{$Region}}</div>    
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-puzzle-piece"></i> Total Clubs</span>
              <div class="count">{{$Club}}</div>
              
            </div>
            
          </div>

          <div class="row">
            <div class="col-lg-12 col-md-4 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Recent Members <a href="/admin/members" class="pull-right btn btn-info btn-xs"><i class="fa fa-plus"></i> View More</a></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped members">
                      <thead>
                        <tr>
                          <th>ID Number</th>
                          <th>Name</th>
                          <th>Club</th>
                          <th>Region</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($dataMember as $Member)
                        <tr>
                          <th scope="row">{{$Member->personalidnumber}}</th>
                          <td>{{ucwords($Member->lname)}}, {{ucwords($Member->fname)}}</td>
                          <td>{{ucwords($Member->club)}}</td>
                          <td>{{ucwords($Member->region)}}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div><!--End Col-->
              <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Recent Clubs <a href="/admin/clubs" class="pull-right btn btn-info btn-xs"><i class="fa fa-plus"></i> View More</a></h4>
                    
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped members">
                      <thead>
                        <tr>
                          <th>Club Name</th>
                          <th>Members</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($dataClub as $Club)
                        <tr>
                          <th scope="row">{{ucwords($Club->clubname)}}</th>
                          <td>{{$Club->members->count()}}</td>
                          <td><a href="/admin/clubs/{{$Club->clubname}}" class="pull-right btn btn-success btn-xs"><i class="fa fa-search"></i> View</a></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div><!--End Col-->
              <div class="col-lg-6 col-md-4 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h4>Recent Regions <a href="/admin/regions" class="pull-right btn btn-info btn-xs"><i class="fa fa-plus"></i> View More</a></h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped members">
                      <thead>
                        <tr>
                          <th>Region Name</th>
                          <th>Members</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($dataRegion as $Region)
                        <tr>
                          <th scope="row">{{ucwords($Region->regioname)}}</th>
                          <td>{{$Region->members->count()}} </td>
                          <td><a href="/admin/regions/{{$Region->regioname}}" class="pull-right btn btn-success btn-xs"><i class="fa fa-search"></i> View</a></td> 
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                  </div>
                </div>
              </div><!--End Col-->
          </div> <!-- End Row-->
          <!-- /top tiles -->

</div>
@endsection
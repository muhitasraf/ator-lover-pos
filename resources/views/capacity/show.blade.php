@extends('index')
    @section('content')
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Type Name</th>
                            <th style="width: 20%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $capacity_name->capacity_name}}</td>
                            <td>{{ $capacity_name->status ==1 ? 'Active': 'InActive'}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

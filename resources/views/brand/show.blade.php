@extends('index')
    @section('content')
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Brand Name</th>
                            <th style="width: 10%;">Description</th>
                            <th style="width: 15%;">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $brand_data->brand_name;?></td>
                            <td><?php echo $brand_data->description;?></td>
                            <td><?php echo $brand_data->status==1 ? 'Active': 'InActive';?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

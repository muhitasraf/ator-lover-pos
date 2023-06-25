@extends('dashboard.index')
    @section('content')
    <div class="row">
        <div class="col col-md-12 table-responsive">
            <div class="table-responsive">
            	<table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Brand Name</th>
                            <th style="width: 10%;">Type</th>
                            <th style="width: 20%;">Strength</th>
                            <th style="width: 15%;">Packsize</th>
                            <th style="width: 15%;">Group/Generic</th>
                            <th style="width: 20%;">Company Name</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $brand_name->brand_name;?></td>
                            <td><?php echo $brand_name->type_name;?></td>
                            <td><?php echo $brand_name->strength;?></td>
                            <td><?php echo $brand_name->packsize;?></td>
                            <td><?php echo $brand_name->generic_name;?></td>
                            <td><?php echo $brand_name->company_name;?></td>
                            <td><?php echo $brand_name->status==1 ? 'Active': 'InActive';?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

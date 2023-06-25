@extends('dashboard.index')
    @section('content')

    <div class="col-md-8">
        <form action="{{ route('brands.update',$id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="brand_name">Brand Name :</label>
                            <input type="text" class="form-control form-control-sm brand_name" value="{{ $brand_name->brand_name ?? '' }}" name="brand_name" id="brand_name" required/>
                            <input type="hidden" value="{{ $brand_name->id ?? '' }}" name="brand_id">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="packsize">Packing Size :</label>
                            <input type="text" class="form-control form-control-sm packsize" value="{{$brand_name->packsize ?? ''}}" name="packsize" id="packsize" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="generic_name">Generic Name :</label>
                            <select class="form-control select2 generic_name" name="generic_name" id="generic_name">
                                <option value="0">Select Generic Name</option>
                                @php
                                foreach($generic_name as $generic){
                                        $selected = '';
                                        if(isset($brand_name->generic_id) && !empty($brand_name->generic_id))
                                        if($brand_name->generic_id==$generic->id){$selected = 'selected';}
                                        echo "<option value='".$generic->id."' $selected>".$generic->generic_name."</option>";
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="company_name">Company :</label>
                            <select class="form-control select2 company_name" name="company_name" id="company_name">
                                <option value="0">Select Company</option>
                                @php
                                    foreach($company_name as $company){
                                        $selected = '';
                                        if(isset($brand_name->company_id) && !empty($brand_name->company_id))
                                        if($brand_name->company_id==$company->id){$selected = 'selected';}
                                        echo "<option value='".$company->id."' $selected>".$company->company_name."</option>";
                                    }
                                @endphp
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="type_name">Type Name :</label>
                            <select class="form-control select2 type_name" name="type_name" id="type_name">
                                @php
                                    foreach($type_name as $type){
                                        echo "<option value='".$type->id."'>".$type->type_name."</option>";
                                    }
                                @endphp
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="medicine_name">Strength :</label>
                            <input type="text" class="form-control form-control-sm strength" value="{{$brand_name->strength ?? ''}}" name="strength" id="strength" required/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-weight-bold" for="price">Price :</label>
                            <input type="text" class="form-control form-control-sm price" value="{{$brand_name->price ?? ''}}" name="price" id="price" required/>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold" for="status">Status :</label>
                            <select class="form-control select2" name="status" id="status">
                                <option value="1" {{ $brand_name->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $brand_name->status == 0 ? 'selected' : '' }}>De-Active</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <button type="submit" class="btnSubmit">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop

@extends('admin.maindesign')
<base href="/public">
@section('update_food')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Update Food Item</h4>
                </div>
                <div class="card-body">
                    @if(session('update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('update') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('admin.postupdatefood',$food->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="food_name">Food Name</label>
                            <input type="text" class="form-control" id="food_name" name="food_name" value="{{ $food->food_name }}">
                        </div>
                        <div class="form-group">
                            <label for="food_details">Description</label>
                            <textarea class="form-control" id="food_details" name="food_details" rows="4">{{ $food->food_details}}"</textarea>
                        </div>
                        <div class="form-group">
                            <label for="food_price">Price (₱)</label>
                            <input type="number" class="form-control" id="food_price" name="food_price" min="0" step="0.01" value="{{ $food->food_price }}" >
                        </div>
                        <div>
                            <h3>old image</h3>
                            <img style="width: 100px;" src="{{ asset('food_img/'.$food->food_image) }}" alt="">
                        </div>
                        <div class="form-group">
                            <label for="food_image">Update Image from here!</label>
                            <input type="file" class="form-control-file" id="food_image" name="food_image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Update Food</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
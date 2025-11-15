@extends('admin.maindesign')

@section('add_food')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Add New Food Item</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <form action="{{ route('admin.postaddfood') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="food_name">Food Name</label>
                            <input type="text" class="form-control" id="food_name" name="food_name" placeholder="Enter food name" required>
                        </div>
                        <div class="form-group">
                            <label for="food_details">Description</label>
                            <textarea class="form-control" id="food_details" name="food_details" rows="4" placeholder="Enter food description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="food_price">Price (₱)</label>
                            <input type="number" class="form-control" id="food_price" name="food_price" placeholder="Enter price" min="0" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="food_image">Food Image</label>
                            <input type="file" class="form-control-file" id="food_image" name="food_image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Add Food Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin.maindesign')

@section('add_drink')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Add New Drink Item</h4>
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
                    <form action="{{ route('admin.postadddrink') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="drink_name">Drink Name</label>
                            <input type="text" class="form-control" id="drink_name" name="drink_name" placeholder="Enter drink name" required>
                        </div>
                        <div class="form-group">
                            <label for="drink_details">Description</label>
                            <textarea class="form-control" id="drink_details" name="drink_details" rows="4" placeholder="Enter drink description" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="drink_price">Price (₱)</label>
                            <input type="number" class="form-control" id="drink_price" name="drink_price" placeholder="Enter price" min="0" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="drink_image">Drink Image</label>
                            <input type="file" class="form-control-file" id="drink_image" name="drink_image" accept="image/*">
                        </div>
                        <button type="submit" class="btn btn-success btn-block">Add Drink Item</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('admin.maindesign')

@section('show_food')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Food Items</h4>
                </div>
                <div class="card-body">
                    @if(session('danger'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('danger') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Food Name</th>
                                    <th>Food Description</th>
                                    <th>Food Image</th>
                                    <th>Food Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($foods as $food)
                                    <tr>
                                        <td class="align-middle">{{ $food->food_name }}</td>
                                        <td class="align-middle">{{ $food->food_details }}</td>
                                        <td class="text-center align-middle">
                                            <img src="{{ asset('food_img/'.$food->food_image) }}" alt="{{ $food->food_image }}" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                        </td>
                                        <td class="align-middle font-weight-bold text-success">₱{{ $food->food_price }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('admin.updatefood',$food->id ) }}" class="btn btn-sm btn-outline-primary mr-2">Update</a>
                                            <a href="{{ route('admin.deletefood',$food->id ) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger">Delete</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
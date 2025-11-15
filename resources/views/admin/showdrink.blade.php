@extends('admin.maindesign')

@section('show_drink')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Drink Items</h4>
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
                                    <th>Drink Name</th>
                                    <th>Drink Description</th>
                                    <th>Drink Image</th>
                                    <th>Drink Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($drinks as $drink)
                                    <tr>
                                        <td class="align-middle">{{ $drink->drink_name }}</td>
                                        <td class="align-middle">{{ $drink->drink_details }}</td>
                                        <td class="text-center align-middle">
                                            <img src="{{ asset('drink_img/'.$drink->drink_image) }}" alt="{{ $drink->drink_image }}" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                        </td>
                                        <td class="align-middle font-weight-bold text-success">₱{{ $drink->drink_price }}</td>
                                        <td class="align-middle">
                                            <a style="color: lightblue" href="{{ route('admin.updatedrink',$drink->id ) }}" class="btn btn-sm btn-outline-primary mr-2">Update</a>
                                            <a href="{{ route('admin.deletedrink',$drink->id ) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger">Delete</a>
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
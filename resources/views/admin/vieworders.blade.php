@extends('admin.maindesign')

@section('show_orders')
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
                                    <th>Customer Name</th>
                                    <th>Customer Email</th>
                                    <th>Customer Address</th>
                                    <th>Customer Phone</th>
                                    <th>Food Name</th>
                                    <th>Food Image</th>
                                    <th>Food Quantity</th>
                                    <th>Food Price</th>
                                    <th>Order Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="align-middle">{{ $order->customer_name }}</td>
                                        <td class="align-middle">{{ $order->customer_email }}</td>
                                        <td class="align-middle">{{ $order->customer_Address }}</td>
                                        <td class="align-middle">{{ $order->customer_phone }}</td>
                                        <td class="align-middle">{{ $order->food_name }}</td>
                                        
                                        <td class="text-center align-middle">
                                            <img src="{{ asset('food_img/'.$order->food_image) }}" alt="{{ $order->food_image }}" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                        </td>
                                        
                                        <td class="align-middle">{{ $order->food_quantity }}</td>
                                        <td class="align-middle">{{ $order->food_price }}</td>
                                        <td class="align-middle">{{ $order->order_status }}</td>
                                        <td class="align-middle">
                                            <a style="color: lightblue;" href="{{ route('admin.delivered',$order->id) }}" class="btn btn-sm btn-outline-primary mr-2">Confirm</a>
                                            <a href="{{ route('admin.cancel',$order->id) }}" class="btn btn-sm btn-outline-danger">Cancel</a>
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
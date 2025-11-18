@extends('main')

@section('show_cart')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Food Cart Items</h4>
                    <span class="badge badge-light">
                        Active Items: 
                        {{ $cart_food_info->where('status', 'active')->count() }}
                    </span>
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
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('confirm_order'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('confirm_order') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($cart_food_info->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Food Name</th>
                                    <th>Food Details</th>
                                    <th>Food Image</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    @if($cart_food_info->where('status', 'active')->count() > 0)
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $total_price = 0;
                                    $hasActiveItems = false;
                                    $hasConfirmedItems = $cart_food_info->where('status', 'confirmed')->count() > 0;
                                @endphp

                                @foreach ($cart_food_info as $user_cart_foods)
                                    <tr>
                                        <td class="align-middle font-weight-bold">{{ $user_cart_foods->food_name }}</td>
                                        <td class="align-middle">{{ $user_cart_foods->food_details }}</td>
                                        <td class="text-center align-middle">
                                            <img src="{{ asset('food_img/'.$user_cart_foods->food_image) }}" 
                                                 alt="{{ $user_cart_foods->food_image }}" 
                                                 class="img-fluid rounded" 
                                                 style="max-width: 150px; height: auto;">
                                        </td>
                                        <td class="align-middle font-weight-bold text-center text-success">
                                            {{ $user_cart_foods->food_quantity }}
                                        </td>
                                        <td class="align-middle font-weight-bold text-success">
                                            ₱{{ number_format($user_cart_foods->food_price, 2) }}
                                        </td>
                                        <td class="align-middle text-center">
                                            @if($user_cart_foods->status == 'confirmed')
                                                <span class="badge badge-warning p-2">In Progress</span>
                                            @else
                                                <span class="badge badge-success p-2">Active</span>
                                                @php $hasActiveItems = true; @endphp
                                            @endif
                                        </td>
                                        @if($cart_food_info->where('status', 'active')->count() > 0)
                                        <td class="align-middle text-center">
                                            @if($user_cart_foods->status == 'active')
                                                <a href="{{ route('delete.cart', $user_cart_foods->id) }}" 
                                                   onclick="return confirm('Are you sure you want to remove this item from cart?')" 
                                                   class="btn btn-sm btn-outline-danger">
                                                    <i class="fas fa-trash"></i> Remove
                                                </a>
                                            @endif
                                        </td>
                                        @endif
                                    </tr>
                                    @php
                                        $total_price = $total_price + $user_cart_foods->food_price;
                                    @endphp
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="row mt-4">
                            <div class="col-md-8">
                                <h3 class="text-success font-weight-bold">
                                    Total Price: ₱{{ number_format($total_price, 2) }}
                                </h3>
                            </div>
                            <div class="col-md-4 text-right">
                                @if($hasActiveItems)
                                <form action="{{ route('cart.confirm') }}" method="post">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-lg">
                                        <i class="fas fa-check-circle"></i> Confirm Food Order
                                    </button>
                                </form>
                                @else
                                <div class="alert alert-info">
                                    <i class="fas fa-info-circle"></i> No active items to confirm
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">Your food cart is empty</h4>
                        <p class="text-muted">Add some delicious foods to your cart!</p>
                        <a href="#foods" class="btn btn-primary">Browse Foods</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .table th {
        background-color: #343a40;
        color: white;
        border-color: #454d55;
    }
    .card {
        border: none;
        border-radius: 10px;
    }
    .card-header {
        border-radius: 10px 10px 0 0 !important;
    }
</style>
@endsection
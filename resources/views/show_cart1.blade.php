@extends('main')

@section('show_cart1')
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
                    @if(session('confirm_order'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('confirm_order') }}
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
                                    <th>Drink Details</th>
                                    <th>Drink Image</th>
                                    <th>Drink Quantity</th>
                                    <th>Drink Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @php
                                    $total_price=0;
                                @endphp

                                @foreach ($cart_drink_info as $user_cart_drinks)
                                    <tr>
                                        <td style="color: black" class="align-middle">{{ $user_cart_drinks->drink_name }}</td>
                                        <td style="color: black" class="align-middle">{{ $user_cart_drinks->drink_details }}</td>
                                        <td class="text-center align-middle">
                                            <img src="{{ asset('drink_img/'.$user_cart_drinks->drink_image) }}" alt="{{ $user_cart_drinks->drink_image }}" class="img-fluid rounded" style="max-width: 150px; height: auto;">
                                        </td>
                                        <td style="color: black" class="align-middle font-weight-bold text-success">{{ $user_cart_drinks->drink_quantity }}</td>
                                        <td style="color: black" class="align-middle font-weight-bold text-success">₱{{ $user_cart_drinks->drink_price }}</td>
                                        <td class="align-middle">
                                            <a href="{{ route('delete.cart1',$user_cart_drinks->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-outline-danger">Remove</a>
                                        </td>
                                    </tr>
                                @php
                                    $total_price = $total_price+$user_cart_drinks->drink_price;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
                        <h1 style="color: green; text-shadow: 2px;">Total Price: ₱{{$total_price}}</h1>

                        <div>
                            <form action="{{ route('cart.confirm1') }}" method="post">
                            @csrf
                                <input style="background-color: yellowgreen; border-radius: 11px; padding: 10px; " type="submit" value="confirm_order">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
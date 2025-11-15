@extends('main')

@section('home')

    {{-- Success alert from session --}}
    @if(session('cart_message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Added to Cart!',
                    text: '{{ session('cart_message') }}',
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        </script>
    @endif

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <div class="container my-5">
        <h2 class="text-center text-uppercase mb-4 fw-bold text-info"> Foods Menu</h2>
        <div class="row justify-content-center">

            @foreach ($foods as $food)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-4 bg-dark text-white h-100" style="transition: 0.3s;">
                        <img src="{{ asset('food_img/' . $food->food_image) }}" 
                            class="card-img-top rounded-top-4" 
                            alt="{{ $food->food_image }}" 
                            style="height: 250px; object-fit: cover;">

                        <div class="card-body text-center">
                            <h4 class="fw-bold">{{ $food->food_name }}</h4>
                            <p class="text-muted small">{{ $food->food_details }}</p>
                            <span style="color: red" class="badge bg-success mb-3 fs-6">₱{{ $food->food_price }}</span>

                            <form action="{{ route('addtocart') }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="food_id" value="{{ $food->id }}">
                                <div class="form-group mb-3">
                                    <label for="quantity" class="form-label text-white">Quantity:</label>
                                    <input type="number" 
                                        class="form-control text-center bg-transparent text-white border-light" 
                                        name="quantity" 
                                        value="1" 
                                        min="1"
                                        max="1000"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-success w-100 rounded-pill">
                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>

    {{-- ===================== DRINKS SECTION ===================== --}}
    <div class="container my-5">
        <h2 class="text-center text-uppercase mb-4 fw-bold text-info"> Drinks Menu</h2>
        <div class="row justify-content-center">
            @foreach ($drinks as $drink)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-4 bg-dark text-white h-100" style="transition: 0.3s;">
                        <img src="{{ asset('drink_img/' . $drink->drink_image) }}" 
                            class="card-img-top rounded-top-4" 
                            alt="{{ $drink->drink_image }}" 
                            style="height: 250px; object-fit: cover;">

                        <div class="card-body text-center">
                            <h4 class="fw-bold">{{ $drink->drink_name }}</h4>
                            <p class="text-muted small">{{ $drink->drink_details }}</p>
                            <span style="color: red" class="badge bg-info mb-3 fs-6">₱{{ $drink->drink_price }}</span>

                            <form action="{{ route('addtocart1') }}" method="POST" class="add-to-cart-form">
                                @csrf
                                <input type="hidden" name="drink_id" value="{{ $drink->id }}">
                                <div class="form-group mb-3">
                                    <label class="form-label text-white">Quantity:</label>
                                    <input type="number" 
                                        class="form-control text-center bg-transparent text-white border-light" 
                                        name="quantity" 
                                        value="1" 
                                        min="1"
                                        max="1000"
                                        required>
                                </div>
                                <button type="submit" class="btn btn-info w-100 rounded-pill text-white">
                                    <i class="fas fa-shopping-cart me-2"></i> Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    {{-- JS for popup before submitting --}}
    <script>
        document.querySelectorAll('.add-to-cart-form').forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Add this item to cart?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#28a745',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, add it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection

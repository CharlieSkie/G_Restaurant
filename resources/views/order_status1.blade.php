<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            {{ __('Drink Order Status') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-4">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
            
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white text-center py-6">
                <h4 style="color: black;" class="text-2xl font-bold mb-2">My Drink Orders</h4>
                <p style="color: black;" class="text-sm opacity-90">Track your recent drink purchases</p>
            </div>

            <!-- Body -->
            <div class="p-6">
                @if($my_orders->isEmpty())
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h5 class="text-xl font-semibold text-gray-700 mb-2">No Orders Yet</h5>
                        <p class="text-gray-500 mb-6">It looks like you haven't ordered any drinks yet. Start shopping to see them here!</p>
                    </div>
                @else
                    <!-- Desktop Table View -->
                    <div class="hidden md:block">
                        <div class="overflow-x-auto">
                            <table class="min-w-full table-auto border-collapse">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Name</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Email</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Address</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Phone</th>
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Drink Name</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Image</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Quantity</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Price</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($my_orders as $order)
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->customer_name }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->customer_email }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->customer_Address }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->customer_phone }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->drink_name }}</td>
                                            <td class="px-4 py-4 text-center">
                                                <img src="{{ asset('drink_img/'.$order->drink_image) }}" 
                                                    alt="{{ $order->drink_name }}" 
                                                    class="w-16 h-16 object-cover rounded-lg shadow-sm mx-auto">
                                            </td>
                                            <td class="px-4 py-4 text-center text-sm font-medium text-blue-600">{{ $order->drink_quantity }}</td>
                                            <td class="px-4 py-4 text-center text-sm font-medium text-green-600">₱{{ number_format($order->drink_price, 2) }}</td>
                                            <td class="px-4 py-4 text-center">
                                                @if($order->order_status == 'Pending')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">⏳ Pending</span>
                                                @elseif($order->order_status == 'Completed')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✅ Completed</span>
                                                @elseif($order->order_status == 'Cancelled')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">❌ Cancelled</span>
                                                @else
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                        {{ $order->order_status }}
                                                    </span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Mobile Card View -->
                    <div class="md:hidden space-y-4">
                        @foreach ($my_orders as $order)
                            <div class="bg-gray-50 rounded-lg p-4 shadow-sm border border-gray-200">
                                <div class="flex items-center space-x-4 mb-4">
                                    <img src="{{ asset('drink_img/'.$order->drink_image) }}" 
                                        alt="{{ $order->drink_name }}" 
                                        class="w-16 h-16 object-cover rounded-lg shadow-sm">
                                    <div>
                                        <h5 class="text-lg font-semibold text-gray-900">{{ $order->drink_name }}</h5>
                                        <p class="text-sm text-gray-600">
                                            Qty: {{ $order->drink_quantity }} | ₱{{ number_format($order->drink_price, 2) }}
                                        </p>
                                    </div>
                                </div>

                                <div class="space-y-1 text-sm text-gray-700">
                                    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                                    <p><strong>Address:</strong> {{ $order->customer_Address }}</p>
                                    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                                    <p><strong>Status:</strong>
                                        @if($order->order_status == 'Pending')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">⏳ Pending</span>
                                        @elseif($order->order_status == 'Completed')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">✅ Completed</span>
                                        @elseif($order->order_status == 'Cancelled')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">❌ Cancelled</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">{{ $order->order_status }}</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

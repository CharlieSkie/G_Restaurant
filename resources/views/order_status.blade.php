<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight text-center">
            {{ __('Food Order Status') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-8 px-4">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden border border-gray-200">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white text-center py-6">
                <h4 style="color: black;" class="text-2xl font-bold mb-2">My Food Orders</h4>
                <p style="color: black;" class="text-sm opacity-90">Track your recent purchases</p>
            </div>

            <!-- Body -->
            <div class="p-6">
                @if($my_order->isEmpty())
                    <!-- Empty State -->
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <h5 style="color: black;" class="text-xl font-semibold text-gray-700 mb-2">No Orders Yet</h5>
                        <p style="color: black;" class="text-gray-500 mb-6">It looks like you haven't placed any orders. Start shopping to see them here!</p>
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
                                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Food Name</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Image</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Quantity</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Price</th>
                                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach ($my_order as $order)
                                        <tr class="hover:bg-gray-50 transition duration-150">
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->customer_name }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->customer_email }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->customer_Address }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->customer_phone }}</td>
                                            <td class="px-4 py-4 text-sm text-gray-900">{{ $order->food_name }}</td>
                                            <td class="px-4 py-4 text-center">
                                                <img src="{{ asset('food_img/'.$order->food_image) }}" 
                                                    alt="Image of {{ $order->food_name }}" 
                                                    class="w-16 h-16 object-cover rounded-lg shadow-sm mx-auto" 
                                                    loading="lazy">
                                            </td>
                                            <td class="px-4 py-4 text-center text-sm font-medium text-blue-600">{{ $order->food_quantity }}</td>
                                            <td class="px-4 py-4 text-center text-sm font-medium text-green-600">₱{{ number_format($order->food_price, 2) }}</td>
                                            <td class="px-4 py-4 text-center">
                                                @if($order->order_status == 'Pending')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                        </svg>
                                                        Pending
                                                    </span>
                                                @elseif($order->order_status == 'Completed')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                        Completed
                                                    </span>
                                                @elseif($order->order_status == 'Cancelled')
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                        Cancelled
                                                    </span>
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
                        @foreach ($my_order as $order)
                            <div class="bg-gray-50 rounded-lg p-4 shadow-sm border border-gray-200">
                                <div class="flex items-center space-x-4 mb-4">
                                    <img src="{{ asset('food_img/'.$order->food_image) }}" 
                                        alt="Image of {{ $order->food_name }}" 
                                        class="w-16 h-16 object-cover rounded-lg shadow-sm" 
                                        loading="lazy">
                                    <div>
                                        <h5 class="text-lg font-semibold text-gray-900">{{ $order->food_name }}</h5>
                                        <p class="text-sm text-gray-600">Qty: {{ $order->food_quantity }} | ₱{{ number_format($order->food_price, 2) }}</p>
                                    </div>
                                </div>
                                <div class="space-y-2 text-sm">
                                    <p><strong>Name:</strong> {{ $order->customer_name }}</p>
                                    <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                                    <p><strong>Address:</strong> {{ $order->customer_Address }}</p>
                                    <p><strong>Phone:</strong> {{ $order->customer_phone }}</p>
                                    <p><strong>Status:</strong>
                                        @if($order->order_status == 'Pending')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                                </svg>
                                                Pending
                                            </span>
                                        @elseif($order->order_status == 'Completed')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                </svg>
                                                Completed
                                            </span>
                                        @elseif($order->order_status == 'Cancelled')
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                Cancelled
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $order->order_status }}
                                            </span>
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
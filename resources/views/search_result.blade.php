<div class="overflow-x-auto">
    <table class="min-w-full table-auto border-collapse border border-gray-300">
      <thead class="bg-gray-100">
        <tr>
          <th class="border border-gray-300 px-4 py-2 text-center">Transaction No.</th>
          <th class="border border-gray-300 px-4 py-2 text-center">Customer Name</th>
          <th class="border border-gray-300 px-4 py-2 text-center">Status</th>
          <th class="border border-gray-300 px-4 py-2 text-center">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($orders as $order)
            <tr>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$order->transaction_no}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$order->customer_name}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">{{$order->state}}</td>
            <td class="border border-gray-300 px-4 py-2 text-center">
                <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded open-modal" data-order-id="{{$order->transaction_no}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v4a1 1 0 001 1h14a1 1 0 001-1V7m-2 0V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m0 0v4m2 0H5m6 0v4m0-4v2" />
                </svg>
                </button>
            </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>

<!-- Modal Structure -->
<div id="orderModal" class="fixed inset-0 hidden bg-gray-900 bg-opacity-50 flex items-center justify-center">
    <div class="bg-white w-2/3 rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Order Details</h2>
            <button id="closeModal" class="text-gray-500 hover:text-gray-700">&times;</button>
        </div>
        
        <!-- Table of Order Items -->
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 text-center">Item Name</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Quantity</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Unit Price</th>
                    <th class="border border-gray-300 px-4 py-2 text-center">Total Price</th>
                </tr>
            </thead>
            <tbody id="orderItems">
                <!-- Order items will be dynamically loaded here -->
            </tbody>
        </table>

        <!-- Total Amount -->
        <div class="mt-4 text-right">
            <strong>Total Amount: </strong> <span id="totalAmount"></span>
        </div>

        <!-- Close Modal Button -->
        <div class="flex justify-end mt-4">
            <button id="closeModalFooter" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        const modal = $('#orderModal');
        const orderItems = $('#orderItems');
        const totalAmount = $('#totalAmount');

        // Function to close the modal
        function hideModal() {
            modal.addClass('hidden');
            orderItems.html(''); // Clear items when closing
            totalAmount.html(''); // Clear total amount when closing
        }

        // Handle close modal buttons
        $('#closeModal, #closeModalFooter').on('click', hideModal);

        // Open modal and fetch order details
        $('.open-modal').on('click', function () {
            const orderId = $(this).data('order-id'); // Get order ID from the data attribute
            console.log(orderId);

            // Fetch order details using AJAX
            $.ajax({
                url: `/order-item/${orderId}`,
                method: 'GET',
                success: function (data) {
                    // Populate the modal with the data
                    let itemsHtml = '';
                    let total = 0;

                    $.each(data.items, function (index, item) {
                        let totalPrice = item.quantity * item.unit_price;
                        total += totalPrice;

                        itemsHtml += `
                            <tr>
                                <td class="border border-gray-300 px-4 py-2 text-center">${item.name}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">${item.quantity}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">${item.unit_price}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">${totalPrice}</td>
                            </tr>
                        `;
                    });

                    orderItems.html(itemsHtml);  // Inject the order items into the table
                    totalAmount.html(total.toFixed(2));  // Show total amount ordered

                    // Show the modal
                    modal.removeClass('hidden');
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching order details:', error);
                }
            });
        });
    });
</script>

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

<!-- Include the modal -->
@include('modal')

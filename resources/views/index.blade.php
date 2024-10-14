<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Search Form</title>
</head>
<body>
<div class="container mx-auto mt-8">
  <!-- Search Bar -->
  <div class="flex justify-center mb-4">
    <form id="form-search" class="flex items-center space-x-2">
      <input
        type="text"
        id="keyword"
        class="border border-gray-300 rounded-full py-2 px-4 focus:outline-none focus:ring-2 focus:ring-green-500"
        placeholder="01234567"
      />
      <button
        type="submit"
        class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full focus:outline-none"
      >
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6a6 6 0 100 12 6 6 0 000-12zM21 21l-4.35-4.35" />
        </svg>
      </button>
    </form>
  </div>

  <!-- Container for displaying the AJAX response -->
  <div id="content" class="mt-4"></div>

  <script>
    $(document).ready(function(){
        $('#form-search').submit(function(e){
            e.preventDefault();
            let kw = $('#keyword').val();
            let csrf = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: '/',
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrf
            },
            data: { keyword: kw, _token: csrf },
            success: function (response){
                $('#content').html(response);
            }
            })
        })
    })
  </script>
</div>
</body>
</html>

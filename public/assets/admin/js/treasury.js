$(document).ready(function () {
    // Handle search input change
    $('#search').on('input', function () {
        let search = $(this).val();
        fetchData(search);
    });

    // Delegate click event for pagination links
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault(); // Prevent default behavior of the link
        let url = $(this).attr('href'); // Get the href attribute value
        fetchPaginationData(url);
    });

    // Function to fetch data with search query
    function fetchData(search = '') {
        $.ajax({
            url: 'treasuries', // Safely pass the URL here
            method: 'GET',
            data: { search: search },
            success: function (response) {
                $('.table-container').html(response.html); // Update table and pagination
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    // Function to fetch paginated data
    function fetchPaginationData(url) {
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('.table-container').html(response.html); // Update table and pagination
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }  
});

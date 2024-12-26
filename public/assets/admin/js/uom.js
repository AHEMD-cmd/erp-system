$(document).ready(function () {
    // Handle search input change
    $('#search').on('input', function () {
        let search = $(this).val();
        let isMaster = $('#is_master').val(); // Get the selected value for 'is_master'
        fetchData(search, isMaster);
    });

    // Handle change in 'is_master' filter dropdown
    $('#is_master').on('change', function () {
        let isMaster = $(this).val(); // Get the selected value for 'is_master'
        let search = $('#search').val(); // Get the search query
        fetchData(search, isMaster);
    });

    // Delegate click event for pagination links
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault(); // Prevent default behavior of the link
        let url = $(this).attr('href'); // Get the href attribute value
        fetchPaginationData(url);
    });

    // Function to fetch data with search and is_master filter
    function fetchData(search = '', isMaster = '') {
        $.ajax({
            url: 'uoms', // Safely pass the URL for Uom index
            method: 'GET',
            data: { 
                search: search, // Send search query
                is_master: isMaster // Send 'is_master' filter
            },
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

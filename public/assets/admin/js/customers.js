$(document).ready(function () {


    /////////////////////////////////////////////

    $('#start_balance_status').on('change', function () {
        // Check the selected value
        if ($(this).val() === 'متزن') {
            // Set the start_balance input field value to 0
            $('#start_balance').val(0);
        }
    });

    //////////////////////////////////////////////////




    /////////////////////////////// ajax search ///////////
    function fetchFilteredData() {
        let searchBy = $('input[name="searchbyradio"]:checked').val();
        let searchText = $('#search_by_text').val();

        $.ajax({
            url: 'customers',  // Make sure to replace with the correct route if needed
            method: 'GET',
            data: {
                searchbyradio: searchBy,
                search_by_text: searchText
            },
            success: function (response) {
                $('.table-container').html(response.html);  // Update the table with the filtered data
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Event listeners for inputs
    $('#search_by_text').on('input', fetchFilteredData);
    $('input[name="searchbyradio"]').on('change', fetchFilteredData);

    // Pagination link click handler
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        let url = $(this).attr('href');
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('.table-container').html(response.html);  // Update the table with the paginated data
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });

    ////////////// end //////////////    
});

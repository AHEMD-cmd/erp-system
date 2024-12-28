$(document).ready(function () {
    // Initially check the value of is_parent and toggle the parent_account_number field
    toggleParentAccountNumber();
    // Initially check the value of is_parent and toggle the parent_account_number field requirment
    handleIsParentChange();


    // Listen for changes on the is_parent select element
    $('#is_parent').on('change', function () {
        toggleParentAccountNumber();
    });

    // Function to toggle the visibility of the parent_account_number field
    function toggleParentAccountNumber() {
        if ($('#is_parent').val() === '0') {
            $('#parent_account_number').closest('.form-group').css('visibility', 'visible'); // Make it visible
        } else {
            $('#parent_account_number').closest('.form-group').css('visibility', 'hidden'); // Make it invisible
        }
    }


    /////////////////////////////////////////////

    $('#start_balance_status').on('change', function () {
        // Check the selected value
        if ($(this).val() === 'متزن') {
            // Set the start_balance input field value to 0
            $('#start_balance').val(0);
        }
    });

    //////////////////////////////////////////////////


    // Listen for changes in the is_parent field
    $('#is_parent').change(function () {
        handleIsParentChange();

    });

    // Function to handle the is_parent logic
    function handleIsParentChange() {
        if ($('#is_parent').val() === '1') {
            // Clear the parent_account_number field if is_parent is 1
            $('#parent_account_number').val('').prop('required', false);
        } else {
            // Ensure the parent_account_number field is required if is_parent is not 1
            $('#parent_account_number').prop('required', true);
        }
    }

    //////////////////////////////////////////////////////

    /////////////////////////////// ajax search ///////////
    function fetchFilteredData() {
        let searchBy = $('input[name="searchbyradio"]:checked').val();
        let searchText = $('#search_by_text').val();
        let accountTypeId = $('#account_type_id').val();
        let isParent = $('#is_parent').val();
        let active = $('#active').val();

        $.ajax({
            url: 'accounts', // Adjust the route if needed
            method: 'GET',
            data: {
                searchbyradio: searchBy,
                search_by_text: searchText,
                account_type_id: accountTypeId,
                is_parent: isParent,
                active: active,
            },
            success: function (response) {
                $('.table-container').html(response.html);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    }

    // Event listeners for inputs
    $('#search_by_text').on('input', fetchFilteredData);
    $('#account_type_id, #is_parent, #active').on('change', fetchFilteredData);
    $('input[name="searchbyradio"]').on('change', fetchFilteredData);

    // Pagination link click handler
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault();
        let url = $(this).attr('href');
        $.ajax({
            url: url,
            method: 'GET',
            success: function (response) {
                $('.table-container').html(response.html);
            },
            error: function (xhr) {
                console.error(xhr.responseText);
            }
        });
    });
    ////////////// end //////////////    
});

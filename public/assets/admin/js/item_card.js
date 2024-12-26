$(document).ready(function () {

    // ========================= ajax search ====================== //
    // Handle search input change
    $('#search').on('input', function () {
        let search = $(this).val();
        let categoryId = $('#category_id').val(); // Get the selected value for 'category_id'
        let itemType = $('#item_type').val(); // Get the selected value for 'item_type'
        fetchData(search, categoryId, itemType);
    });

    // Handle change in 'category_id' filter dropdown
    $('#category_id').on('change', function () {
        let categoryId = $(this).val(); // Get the selected value for 'category_id'
        let search = $('#search').val(); // Get the search query
        let itemType = $('#item_type').val(); // Get the selected value for 'item_type'
        fetchData(search, categoryId, itemType);
    });

    // Handle change in 'item_type' filter dropdown
    $('#item_type').on('change', function () {
        let itemType = $(this).val(); // Get the selected value for 'item_type'
        let search = $('#search').val(); // Get the search query
        let categoryId = $('#category_id').val(); // Get the selected value for 'category_id'
        fetchData(search, categoryId, itemType);
    });

    // Delegate click event for pagination links
    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault(); // Prevent default behavior of the link
        let url = $(this).attr('href'); // Get the href attribute value
        fetchPaginationData(url);
    });

    // Function to fetch data with search and filters
    function fetchData(search = '', categoryId = '', itemType = '') {
        $.ajax({
            url: 'item-cards', // Safely pass the URL for ItemCard index
            method: 'GET',
            data: { 
                search: search, // Send search query
                category_id: categoryId, // Send 'category_id' filter
                item_type: itemType // Send 'item_type' filter
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

        // ========================= end ajax search ====================== //
        
        
        // ========================= uom_id ====================== //
        
        
            // UOM and dependent fields
            const $uomSelect = $('#uom_id');
            const $dependentFields = $('#dependent-fields');
        
            // Retail Unit and its dependent fields
            const $retailUnitCheckbox = $('#does_has_retail_unit');
            const $retailDependentFields = $('#retail-dependent-fields');
        
            // Show/hide dependent fields for UOM
            $uomSelect.on('change', function () {
                if ($(this).val()) {
                    $dependentFields.show();
                    $('#parent_uom').text($('option:selected', this).text()); // Update with selected option's text
                } else {
                    $dependentFields.hide();
                }
            });
        
            // Initialize: Hide dependent fields for UOM if no value is selected
            if (!$uomSelect.val()) {
                $dependentFields.hide();
            }
        
            // Show/hide dependent fields for Retail Unit
            $retailUnitCheckbox.on('change', function () {
                if ($(this).val() == 1) {
                    $retailDependentFields.show();
                } else {
                    $retailDependentFields.hide();
                    $('#retail_uom_id, #retail_uom_qty_to_parent, #cost_price_retail, #price_retail, #nos_gomla_price_retail, #gomla_price_retail')
                    .val('');
                }
            });
        
            // Initialize: Hide retail dependent fields if the checkbox is not checked
            if (!$retailUnitCheckbox.val()) {
                $retailDependentFields.hide();
            }
        
        // ========================= end uom_id ====================== //
});

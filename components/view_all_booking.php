<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h4>Booking Details</h4>
            <span>View all booking details below. Click "View Detail" to see more information about a specific booking.</span>
        </div>
        <div class="card-body">
            <div class="table-responsive theme-scrollbar custom-scrollbar">
                <table class="display" id="bookingTable" style="width:100%">
                    <thead>
                        <tr>
                            <th>Name of School</th>
                            <th>Audience Size</th>
                            <th>Show Name</th>
                            <th>Email DateTime</th>
                            <th>Alternative Date and Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be populated via AJAX -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#bookingTable').DataTable({
        ajax: {
            url: 'https://apiplayinc.spacegap.net/index.php',
            type: 'POST',
            data: { function: 'LoadViewBooking' },
            dataSrc: function(json) {
                console.log('API Response:', json);
                if (!json || json.length === 0) {
                    console.warn('No data returned from API');
                    return [];
                }
                // Ensure the API response is an array
                return Array.isArray(json) ? json : [];
            },
            error: function(xhr, error, thrown) {
                console.error('AJAX Error:', error, thrown);
                alert('Failed to load booking data. Please check the console for details.');
            }
        },
        columns: [
            { 
                data: 'BookingDetails_NameOfSchool', 
                defaultContent: '-'
            },
            { 
                data: 'BookingDetails_AudienceSize', 
                defaultContent: '-',
                render: function(data, type, row) {
                    if (type === 'sort') {
                        return parseFloat(data.replace(/[^0-9.-]+/g, '')) || 0;
                    }
                    return data;
                }
            },
            { 
                data: 'BookingDetails_ShowName', 
                defaultContent: '-'
            },
            { 
                data: 'BookingDetails_EmailDateTime', 
                defaultContent: '-'
            },
            { 
                data: 'BookingDetails_AlternativeDateAndTime', 
                defaultContent: '-'
            },
            {
                data: null,
                orderable: false,
                render: function(data, type, row) {
                    return '<a href="#" onclick="setSessionAndRedirect(' + row.BookingDetailID + ')">View Detail</a>';
                }
            }
        ],
        createdRow: function(row, data, dataIndex) {
            // Parse AudienceSize as a number, removing any non-numeric characters
            var audienceSize = parseFloat(data.BookingDetails_AudienceSize.replace(/[^0-9.-]+/g, '')) || 0;
            if (audienceSize > 500) {
                $(row).addClass('primary').css('font-weight', 'bold');
            } else if (audienceSize < 100) {
                $(row).addClass('danger').css('font-weight', 'bold');
            }
        },
        responsive: true,
        scrollX: true,
        ordering: true, // Ensure sorting is enabled
        language: {
            emptyTable: "No bookings found."
        }
    });
});

function setSessionAndRedirect(bookingId) {
    $.post('setSession.php', { bookingId: bookingId }, function(response) {
        if (response.trim() === "success") {
            window.location.href = 'dashboard.php?page=view_details';
        } else {
            alert('Failed to set session. Please try again.');
        }
    });
}
</script>
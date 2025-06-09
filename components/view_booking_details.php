<div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0 card-no-border">
                                        <h4>Details for Booking ID: <?php echo $_SESSION['SelectedBookingID']; ?></h4>
                                        <span>View detailed information about the selected booking below.</span>
                                    </div>
                                    <div class="card-body">
                                        <div id="bookingDetailsContainer">
                                            <p>Loading booking details…</p>
                                        </div>
                                        <div id="createSlotSection" style="margin-top: 20px;">
                                            <h5>Additional Information</h5>
                                            <div class="row g-3">
                                                <div class="col-md-3">
                                                    <label for="numberOfRoles" class="form-label">Number of Roles</label>
                                                    <input type="number" class="form-control" id="numberOfRoles" placeholder="Enter number of roles" min="0">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="venue" class="form-label">Venue</label>
                                                    <input type="text" class="form-control" id="venue" placeholder="Enter venue">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="timeToReport" class="form-label">Time to Report</label>
                                                    <input type="time" class="form-control" id="timeToReport" placeholder="Select time">
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="remarks" class="form-label">Remarks</label>
                                                    <input type="text" class="form-control" id="remarks" placeholder="Enter remarks">
                                                </div>
                                            </div>
                                            <div style="margin-top: 20px;">
                                                <button id="createSlotButton" class="btn btn-primary" disabled>Create Slot</button>
                                                <div id="createSlotResult" style="margin-top: 10px;"></div>
                                            </div>
                                        </div>
                                        <!-- Date Selection Boxes (Hidden Initially) -->
                                        <div id="dateSelectionContainer" style="display: none; margin-top: 20px;">
                                            <h5>Select a Date for the Slot</h5>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <h6>First Date</h6>
                                                            <p id="firstDate"></p>
                                                            <button class="btn btn-success select-date-btn" data-date-type="email">Select This Date</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <h6>Alternative Date</h6>
                                                            <p id="alternativeDate"></p>
                                                            <button class="btn btn-success select-date-btn" data-date-type="alternative">Select This Date</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Bootstrap Modal for Error Message -->
                                        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="errorModalLabel">Error</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p id="errorMessage"></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <a id="addSchoolLink" href="#" target="_blank" class="btn btn-primary" style="display:none;">Add School</a>
                                                        <a id="addTeacherLink" href="#" target="_blank" class="btn btn-primary" style="display:none;">Add Teacher</a>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            $(document).ready(function() {
                                let schoolID = null;
                                let teacherID = null;
                                let emailDateTime = null;
                                let alternativeDateTime = null;

                                // Load Booking Details
                                $.ajax({
                                    url: 'https://apiplayinc.spacegap.net/index.php',
                                    method: 'POST',
                                    data: { 
                                        function: 'LoadEmailBookingOneResult',
                                        bookingId: <?= $_SESSION['SelectedBookingID']; ?>
                                    },
                                    dataType: 'json'
                                })
                                .done(function(data) {
                                    if (!data || data.length === 0) {
                                        $('#bookingDetailsContainer').html('<p>No details found for this Booking ID.</p>');
                                        $('#createSlotButton').prop('disabled', true);
                                        return;
                                    }

                                    const row = data[0];
                                    const columnsToShow = [
                                        'BookingDetails_NameOfSchool',
                                        'BookingDetails_Address',
                                        'BookingDetails_AudienceSize',
                                        'BookingDetails_ShowName',
                                        'BookingDetails_ContactPerson',
                                        'BookingDetails_ContactNumber',
                                        'BookingDetails_EmailDateTime',
                                        'BookingDetails_AlternativeDateAndTime',
                                        'BookingDetails_Remark'
                                    ];

                                    let details = '<div class="detail-view">';
                                    columnsToShow.forEach(function(colName) {
                                        let value = row[colName] || '-';
                                        if (colName === 'BookingDetails_NameOfSchool') {
                                            const schoolCellId = `schoolCheck_${Math.random().toString(36).substring(2, 10)}`;
                                            details += `<div><strong>${colName.replace('BookingDetails_', '').replace(/([A-Z])/g, ' $1').trim()}:</strong> ${value}<br><small id="${schoolCellId}" style="color:gray;">Checking school...</small></div>`;
                                        }
                                        else if (colName === 'BookingDetails_ContactNumber') {
                                            const contactCellId = `teacherCheck_${Math.random().toString(36).substring(2, 10)}`;
                                            details += `<div><strong>${colName.replace('BookingDetails_', '').replace(/([A-Z])/g, ' $1').trim()}:</strong> ${value}<br><small id="${contactCellId}" style="color:gray;">Checking teacher...</small></div>`;
                                        }
                                        else {
                                            details += `<div><strong>${colName.replace('BookingDetails_', '').replace(/([A-Z])/g, ' $1').trim()}:</strong> ${value}</div>`;
                                        }
                                        // Store date values
                                        if (colName === 'BookingDetails_EmailDateTime') {
                                            emailDateTime = value;
                                        }
                                        if (colName === 'BookingDetails_AlternativeDateAndTime') {
                                            alternativeDateTime = value;
                                        }
                                    });
                                    details += '</div>';
                                    $('#bookingDetailsContainer').html(details);

                                    // Populate date selection boxes
                                    $('#firstDate').text(emailDateTime || '-');
                                    $('#alternativeDate').text(alternativeDateTime || '-');

                                    // Check School Availability
                                    $.post('https://apiplayinc.spacegap.net/index.php', {
                                        function: 'CheckSchoolAvailability',
                                        SchoolName: row['BookingDetails_NameOfSchool'] || ''
                                    }, function(response) {
                                        const schoolCellId = $(`[id^=schoolCheck_]`).attr('id');
                                        const result = response.exists
                                            ? '<span style="color:green;">✅ School Recorded</span>'
                                            : '<span style="color:red;">❌ School Not Found</span>';
                                        $(`#${schoolCellId}`).html(result);
                                        if (response.exists && response.SchoolID) {
                                            schoolID = response.SchoolID;
                                            $.post('setSession.php', { SchoolID: response.SchoolID });
                                        } else {
                                            $.post('setSession.php', { SchoolID: '' });
                                        }
                                        checkCreateSlotButton();
                                    }, 'json');

                                    // Check Teacher Availability
                                    $.post('https://apiplayinc.spacegap.net/index.php', {
                                        function: 'CheckTeacherAvailability',
                                        ContactNumber: row['BookingDetails_ContactNumber'] || ''
                                    }, function(response) {
                                        const contactCellId = $(`[id^=teacherCheck_]`).attr('id');
                                        const result = response.exists
                                            ? '<span style="color:green;">✅ Teacher Recorded</span>'
                                            : '<span style="color:red;">❌ Teacher Not Found</span>';
                                        $(`#${contactCellId}`).html(result);
                                        if (response.exists && response.TeacherID) {
                                            teacherID = response.TeacherID;
                                            $.post('setSession.php', { TeacherID: response.TeacherID });
                                        } else {
                                            $.post('setSession.php', { TeacherID: '' });
                                        }
                                        checkCreateSlotButton();
                                    }, 'json');
                                })
                                .fail(function(jqXHR, textStatus) {
                                    $('#bookingDetailsContainer').html(`<p style="color:red;">Error loading booking details: ${textStatus}</p>`);
                                    $('#createSlotButton').prop('disabled', true);
                                });

                                // Check if Create Slot button should be enabled
                                function checkCreateSlotButton() {
                                    if (schoolID && teacherID) {
                                        $('#createSlotButton').prop('disabled', false);
                                    } else {
                                        $('#createSlotButton').prop('disabled', true);
                                    }
                                }

                                // Handle Create Slot Button Click
                                $('#createSlotButton').on('click', function() {
                                    if (!schoolID || !teacherID) {
                                        $('#errorMessage').text('School or Teacher not found in the system.');
                                        if (!schoolID) {
                                            $('#addSchoolLink').attr('href', 'contacts.php?add=school&name=' + encodeURIComponent($('[id^=schoolCheck_]').prev().text()));
                                            $('#addSchoolLink').show();
                                        } else {
                                            $('#addSchoolLink').hide();
                                        }
                                        if (!teacherID) {
                                            $('#addTeacherLink').attr('href', 'contacts.php?add=teacher&name=' + encodeURIComponent($('[id^=teacherCheck_]').prev().text()) + '&number=' + encodeURIComponent($('[id^=teacherCheck_]').prev().text()));
                                            $('#addTeacherLink').show();
                                        } else {
                                            $('#addTeacherLink').hide();
                                        }
                                        $('#errorModal').modal('show');
                                        return;
                                    }

                                    // Show date selection boxes
                                    $('#dateSelectionContainer').show();
                                    $('#createSlotButton').prop('disabled', true);
                                });

                                // Handle Date Selection
                                $('.select-date-btn').on('click', function() {
                                    const dateType = $(this).data('date-type');
                                    const selectedDate = dateType === 'email' ? emailDateTime : alternativeDateTime;

                                    const payload = {
                                        function: 'InsertBookingSlot',
                                        BookingSlot_SchoolID: schoolID,
                                        BookingSlot_TeacherID: teacherID,
                                        BookingSlot_BookingDetailID: <?= json_encode($_SESSION['SelectedBookingID'] ?? '') ?>,
                                        BookingSlot_DateTime: selectedDate,
                                        BookingSlot_BookingStatus: 'New Show'
                                    };

                                    $.post('https://apiplayinc.spacegap.net/index.php', payload, function(res) {
                                        if (res.success && res.BookingSlotID) {
                                            $('#createSlotResult').html('<span style="color:green;">✅ Booking Slot Created. ID: ' + res.BookingSlotID + '</span>');
                                            $('#dateSelectionContainer').hide();
                                        } else {
                                            $('#createSlotResult').html('<span style="color:red;">❌ Failed to create booking slot: ' + (res.error || 'Unknown error') + '</span>');
                                            $('#createSlotButton').prop('disabled', false);
                                            $('#dateSelectionContainer').show();
                                        }
                                    }, 'json').fail(function() {
                                        $('#createSlotResult').html('<span style="color:red;">❌ Network or server error.</span>');
                                        $('#createSlotButton').prop('disabled', false);
                                        $('#dateSelectionContainer').show();
                                    });
                                });
                            });
                            </script>
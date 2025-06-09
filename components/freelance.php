<div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0 card-no-border">
                                        <h4>All Shows</h4>
                                        <span>View all shows below. Click "View Details" to see more information about a specific show, or click "Add Show" to create a new show.</span>
                                        <div class="text-end">
                                            <button id="addShowButton" class="btn btn-primary">Add Show</button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div id="viewShowContainer">
                                            <p>Loading shows…</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="createShowContainer" style="display: none;">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="form theme-form">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label>Project Title</label>
                                                            <input class="form-control" type="text" placeholder="Project name *">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label>Client name</label>
                                                            <input class="form-control" type="text" placeholder="Name client or company name">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label>Project Rate</label>
                                                            <input class="form-control" type="text" placeholder="Enter project Rate">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label>Project Type</label>
                                                            <select class="form-select">
                                                                <option>Hourly</option>
                                                                <option>Fix price</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label>Priority</label>
                                                            <select class="form-select">
                                                                <option>Low</option>
                                                                <option>Medium</option>
                                                                <option>High</option>
                                                                <option>Urgent</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label>Project Size</label>
                                                            <select class="form-select">
                                                                <option>Small</option>
                                                                <option>Medium</option>
                                                                <option>Big</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label>Starting date</label>
                                                            <input class="datepicker-here form-control" type="text" data-language="en">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="mb-3">
                                                            <label>Ending date</label>
                                                            <input class="datepicker-here form-control" type="text" data-language="en">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label>Enter some Details</label>
                                                            <textarea class="form-control" id="exampleFormControlTextarea4" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="mb-3">
                                                            <label>Upload project file</label>
                                                            <form class="dropzone" id="singleFileUpload" action="/upload.php">
                                                                <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                                                    <h6 class="f-w-600">Drop files here or click to upload.</h6><span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="text-end">
                                                            <a class="btn btn-success me-3" href="#">Add</a>
                                                            <a class="btn btn-danger" href="#" id="cancelAddShow">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                                // Function to set session and redirect for View Details
                                function setShowSessionAndRedirect(showId) {
                                $.ajax({
                                    url: 'setSession.php',
                                    method: 'POST',
                                    data: {
                                        ShowDashboard: 'ViewShowDetails',
                                        SelectedShowID: showId
                                    },
                                    dataType: 'text',
                                    success: function(response) {
                                        if (response.trim() === 'success') {
                                            window.location.href = 'dashboard.php';
                                        } else {
                                            console.error('Session set failed:', response);
                                            alert('Failed to set session: ' + response);
                                        }
                                    },
                                    error: function(jqXHR, textStatus, errorThrown) {
                                        console.error('AJAX error:', textStatus, errorThrown);
                                        alert('Error communicating with server. Please check the console and try again.');
                                    }
                                });
                            }


                            $(document).ready(function() {
                                // Load shows table
                                $.ajax({
                                    url: 'https://apiplayinc.spacegap.net/index.php',
                                    method: 'POST',
                                    data: { function: 'displayAllShow' },
                                    dataType: 'json'
                                })
                                .done(function(data) {
                                    if (!data || data.length === 0) {
                                        $('#viewShowContainer').html('<p>No shows found.</p>');
                                        return;
                                    }

                                    const columns = ['ShowID', 'ShowName', 'ShowDuration', 'ShowAgeGroup', 'ShowShortDescription', 'ShowDescription'];

                                    let html = '<div class="table-responsive theme-scrollbar custom-scrollbar">';
                                    html += '<table class="display" id="showsTable" style="width:100%">';
                                    html += '<thead><tr>';
                                    columns.forEach(col => {
                                        html += `<th>${col}</th>`;
                                    });
                                    html += '<th>Action</th></tr></thead><tbody>';

                                    data.forEach(row => {
                                        html += '<tr>';
                                        columns.forEach(col => {
                                            html += `<td>${row[col] ?? '-'}</td>`;
                                        });
                                        html += `<td><a href="#" onclick="setShowSessionAndRedirect(${row.ShowID})">View Details</a></td>`;
                                        html += '</tr>';
                                    });

                                    html += '</tbody></table></div>';
                                    $('#viewShowContainer').html(html);

                                    // Initialize DataTable for better table functionality
                                    $('#showsTable').DataTable({
                                        responsive: true,
                                        scrollX: true,
                                        ordering: true,
                                        language: {
                                            emptyTable: "No shows found."
                                        }
                                    });
                                })
                                .fail(function(jq, textStatus) {
                                    $('#viewShowContainer').html(
                                        `<p style="color:red;">Error loading shows: ${textStatus}</p>`
                                    );
                                });

                                // Toggle Add Show form
                                $('#addShowButton').on('click', function() {
                                    $('#viewShowContainer').hide();
                                    $('#addShowButton').hide();
                                    $('#createShowContainer').show();
                                    $('.page-title h4').text('Create Show');
                                });

                                // Cancel Add Show
                                $('#cancelAddShow').on('click', function(e) {
                                    e.preventDefault();
                                    $('#createShowContainer').hide();
                                    $('#viewShowContainer').show();
                                    $('#addShowButton').show();
                                    $('.page-title h4').text('Manage Shows');
                                });

                                // Function to set session and redirect for View Details
                            });
                            </script>
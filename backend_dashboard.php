<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['UserID']) || !isset($_SESSION['UserRole'])) {
    header("Location: login.php");
    exit();
}

// Assign session variables to local variables
$userID = $_SESSION['UserID'];
$userRole = $_SESSION['UserRole'];
$userEmail = isset($_SESSION['UserEmail']) ? $_SESSION['UserEmail'] : '(Email not tracked)';

// Handle sidebar clicks to update the session
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'view_booking':
            $_SESSION['ShowDashboard'] = 'ViewBooking';
            break;
        case 'view_show':
            $_SESSION['ShowDashboard'] = 'ViewShow';
            break;
        case 'view_slot':
            $_SESSION['ShowDashboard'] = 'ViewSlot';
            break;
        case 'slot_booking':
            $_SESSION['ShowDashboard'] = 'SlotBooking';
            break;
        case 'slot_history':
            $_SESSION['ShowDashboard'] = 'SlotBookingHistory';
            break;    
        case 'profile':                    // ← new!
            $_SESSION['ShowDashboard'] = 'Profile';
            break;
        case 'ynm_slot':
            $_SESSION['ShowDashboard'] = 'YNMSlot';
            break;
        case 'admin_ynm':
            $_SESSION['ShowDashboard'] = 'AdminYNM';
            break;
        case 'school_listing':
            $_SESSION['ShowDashboard'] = 'SchoolListing';
            break; 

        case 'home':
        default:
            $_SESSION['ShowDashboard'] = 'Dashboard';
            break;
    }
} elseif (!isset($_SESSION['ShowDashboard'])) {
    $_SESSION['ShowDashboard'] = 'Dashboard';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
        }
        .sidebar {
            width: 200px;
            height: 100vh;
            background-color: #2c3e50;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 10px;
            margin: 5px;
        }
        .sidebar a:hover {
            background-color: #34495e;
        }
        .content {
            padding: 20px;
            flex-grow: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .detail-view {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .detail-view div {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<div class="sidebar">
  <h3>Menu</h3>
  <a href="dashboard.php?page=home">Home</a>
  <a href="dashboard.php?page=view_booking">View Booking</a>
  <a href="dashboard.php?page=view_show">View Shows</a>
  <a href="dashboard.php?page=view_slot">View Slot</a>
  <a href="dashboard.php?page=slot_booking">Slot Booking</a>
  <a href="dashboard.php?page=slot_history">Slot Booking History</a>
    <a href="dashboard.php?page=profile">Profile</a>
    <a href="dashboard.php?page=ynm_slot">YNM Slot</a>
    <a href="dashboard.php?page=admin_ynm">Admin View YNM</a>
    <a href="dashboard.php?page=school_listing">School Listing</a>

  <a href="logout.php">Logout</a>
</div>

<div class="content">
    <?php if ($_SESSION['ShowDashboard'] == 'ViewBooking'): ?>
        <h2>View Booking</h2>
        <div id="viewBookingContainer">
            <p>Loading bookings…</p>
        </div>

        <script>
        $(document).ready(function() {
            $.ajax({
                url: 'https://apiplayinc.spacegap.net/index.php',
                method: 'POST',
                data: { function: 'LoadViewBooking' },
                dataType: 'json'
            })
            .done(function(data) {
                if (!data || data.length === 0) {
                    $('#viewBookingContainer').html('<p>No bookings found.</p>');
                    return;
                }

                const columnsToShow = [
                    'BookingDetails_NameOfSchool',
                    'BookingDetails_Address',
                    'BookingDetails_AudienceSize',
                    'BookingDetails_ShowName',
                    'BookingDetails_ContactPerson',
                    'BookingDetails_ContactNumber',
                    'BookingDetails_ContactEmail',
                    'BookingDetails_DateAndTime',
                    'BookingDetails_AlternativeDateAndTime',
                    'BookingDetails_Remark'
                ];

                let table = '<table><thead><tr>';
                columnsToShow.forEach(function(colName) {
                    table += '<th>' + colName + '</th>';
                });
                table += '<th>Action</th></tr></thead><tbody>';

                data.forEach(function(row) {
                    table += '<tr>';
                    columnsToShow.forEach(function(colName) {
                        table += '<td>' + (row[colName] || '-') + '</td>';
                    });
                    const bookingId = row.BookingDetailID;
                    table += `<td><a href="#" onclick="setSessionAndRedirect(${bookingId})">View Detail</a></td>`;
                    table += '</tr>';
                });
                table += '</tbody></table>';

                $('#viewBookingContainer').html(table);
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                $('#viewBookingContainer').html(
                    '<p style="color:red;">Error loading bookings: ' + textStatus + '</p>'
                );
            });
        });

        function setSessionAndRedirect(bookingId) {
            $.post('setSession.php', { bookingId: bookingId }, function(response) {
                if (response.trim() === "success") {
                    window.location.href = 'dashboard.php';
                } else {
                    alert('Failed to set session. Please try again.');
                }
            });
        }
        </script>
<?php elseif ($_SESSION['ShowDashboard'] == 'ViewShow'): ?>
    <h2>All Shows</h2>
    <div id="viewShowContainer">
        <p>Loading shows…</p>
    </div>

    <script>
$(document).ready(function() {
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

        // Your Show-table columns
        const columns = ['ShowID', 'ShowName', 'ShowDuration', 'ShowAgeGroup', 'ShowShortDescription', 'ShowDescription'];

        // Build table header (add Action)
        let html = '<table><thead><tr>';
        columns.forEach(col => {
            html += `<th>${col}</th>`;
        });
        html += '<th>Action</th></tr></thead><tbody>';

        // Build each row
        data.forEach(row => {
            html += '<tr>';
            columns.forEach(col => {
                html += `<td>${ row[col] ?? '-' }</td>`;
            });
            // Action button
            html += `<td>
                        <button 
                          type="button" 
                          onclick="setShowSessionAndRedirect(${row.ShowID})"
                          class="btn btn-sm btn-primary"
                        >
                          View Details
                        </button>
                     </td>`;
            html += '</tr>';
        });

        html += '</tbody></table>';
        $('#viewShowContainer').html(html);
    })
    .fail(function(jq, textStatus) {
        $('#viewShowContainer').html(
            `<p style="color:red;">Error loading shows: ${textStatus}</p>`
        );
    });
});

// When the user clicks “View Details”, set session and reload to the details view
function setShowSessionAndRedirect(showId) {
    $.post('setSession.php', {
        ShowDashboard: 'ViewShowDetails',
        SelectedShowID: showId
    }, function(response) {
        if (response.trim() === 'success') {
            window.location.href = 'dashboard.php';
        } else {
            alert('Failed to set session. Please try again.');
        }
    });
}
</script>
<?php elseif ($_SESSION['ShowDashboard'] == 'ViewShowDetails'): ?>
    <h2>Details for Show ID: <?= htmlspecialchars($_SESSION['SelectedShowID']) ?></h2>
    <div id="showDetailsContainer">
        <p>Loading show details…</p>
    </div>

    <script>
$(document).ready(function() {
    const showId = <?= json_encode($_SESSION['SelectedShowID']); ?>;

    // 1) Load show details…
    $.ajax({
        url: 'https://apiplayinc.spacegap.net/index.php',
        method: 'POST',
        data: { function: 'displayShowDetails', ShowID: showId },
        dataType: 'json'
    })
    .done(function(data) {
        if (!data || data.length === 0) {
            $('#showDetailsContainer').html('<p>No details found for this show.</p>');
            return;
        }
        const show = data[0];
        let html = '<div class="detail-view">';
        html += `<div><strong>Show ID:</strong> ${show.ShowID || '-'}</div>`;
        html += `<div><strong>Show Name:</strong> ${show.ShowName || '-'}</div>`;
        html += `<div><strong>Duration:</strong> ${show.ShowDuration || '-'}</div>`;
        html += `<div><strong>Age Group:</strong> ${show.ShowAgeGroup || '-'}</div>`;
        html += `<div><strong>Short Description:</strong><br>${show.ShowShortDescription || '-'}</div>`;
        html += `<div><strong>Description:</strong><br>${show.ShowDescription || '-'}</div>`;
        html += '</div>';
        $('#showDetailsContainer').html(html);

        // 2) Then fetch actors…
        $.ajax({
            url: 'https://apiplayinc.spacegap.net/index.php',
            method: 'POST',
            data: { function: 'displayShowActors', ShowID: showId },
            dataType: 'json'
        })
        .done(function(actors) {
            let actorHtml = '<h3>Cast & Roles</h3>';

            if (!actors || actors.length === 0) {
                actorHtml += '<p>No actors found for this show.</p>';
            } else {
                actorHtml += `
                    <table>
                      <thead>
                        <tr>
                          <th>Role Type</th>
                          <th>Description</th>
                          <th>Fee</th>
                          <th>Notes</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                `;
                actors.forEach(actor => {
                    actorHtml += `
                        <tr>
                          <td>${actor.ShowActorRoleType || '-'}</td>
                          <td>${actor.ShowActorRoleDescription || '-'}</td>
                          <td>${actor.ShowActorFee || '-'}</td>
                          <td>${actor.ShowActorNotes || '-'}</td>
                          <td>
  <button class="btn btn-sm btn-danger"
          onclick="deleteActor(${actor.ShowActorID})">
    Delete
  </button>
  <button class="btn btn-sm btn-warning"
          onclick="editActor(${actor.ShowActorID})">
    Edit
  </button>
</td>

                        </tr>`;
                });
                actorHtml += '</tbody></table>';
            }

            // 3) Add the "Add Actor" button below
            actorHtml += `
              <div style="margin-top:15px;">
                <button id="addActorButton" class="btn btn-success">
                  Add Actor
                </button>
              </div>`;

            $('#showDetailsContainer').append(actorHtml);
        })
        .fail(function(_, textStatus) {
            $('#showDetailsContainer')
              .append(`<p style="color:red;">Error loading cast: ${textStatus}</p>`);
        });
    })
    .fail(function(_, textStatus) {
        $('#showDetailsContainer').html(
            `<p style="color:red;">Error loading show details: ${textStatus}</p>`
        );
    });
});
function editActor(actorId) {
  $.post('setSession.php', {
    ShowDashboard: 'EditActorForShow',
    SelectedActorID: actorId
  }, function(resp) {
    if (resp.trim()==='success') {
      window.location.href = 'dashboard.php';
    } else {
      alert('Could not open edit form.');
    }
  });
}

// Delete handler
function deleteActor(actorId) {
    if (!confirm('Are you sure you want to delete this actor role?')) return;
    $.post(
        'https://apiplayinc.spacegap.net/index.php',
        { function: 'deleteShowActor', ShowActorID: actorId },
        function(res) {
            if (res.success) {
                // simply reload this view
                window.location.reload();
            } else {
                alert('Error deleting actor: ' + (res.error || 'Unknown'));
            }
        },
        'json'
    ).fail(function() {
        alert('Network error while attempting delete.');
    });
}

// Add Actor button stays the same
$(document).on('click', '#addActorButton', function() {
    const showId = <?= json_encode($_SESSION['SelectedShowID']); ?>;
    $.post('setSession.php', {
        ShowDashboard: 'AddActorForShow',
        SelectedShowID: showId
    }, function(response) {
        if (response.trim() === 'success') {
            window.location.href = 'dashboard.php';
        } else {
            alert('Failed to switch to Add Actor view.');
        }
    });
});
</script>
<?php elseif ($_SESSION['ShowDashboard'] == 'EditActorForShow'): ?>
  <h2>Edit Actor Role (ID <?= htmlspecialchars($_SESSION['SelectedActorID']) ?>)</h2>
  <div id="editActorContainer">
    <p>Loading form…</p>
  </div>

  <script>
  $(function() {
    const actorId = <?= json_encode($_SESSION['SelectedActorID']) ?>;
    const showId  = <?= json_encode($_SESSION['SelectedShowID']) ?>;

    // 1) Fetch current data
    $.post('https://apiplayinc.spacegap.net/index.php', {
      function: 'getShowActor',
      ShowActorID: actorId
    }, function(data) {
      if (!data || !data[0]) {
        $('#editActorContainer').html('<p>Actor not found.</p>');
        return;
      }
      const a = data[0];

      // 2) Build form with prefilled values
      $('#editActorContainer').html(`
        <form id="editActorForm">
          <input type="hidden" name="ShowActorID" value="${actorId}">
          <div class="form-group">
            <label>Role Type:
              <input type="text" name="ShowActorRoleType"
                     class="form-control" required
                     value="${a.ShowActorRoleType}">
            </label>
          </div>
          <div class="form-group">
            <label>Description:
              <textarea name="ShowActorRoleDescription"
                        class="form-control" required>${a.ShowActorRoleDescription}</textarea>
            </label>
          </div>
          <div class="form-group">
            <label>Fee:
              <input type="number" step="0.01"
                     name="ShowActorFee"
                     class="form-control" required
                     value="${a.ShowActorFee}">
            </label>
          </div>
          <div class="form-group">
            <label>Notes:
              <textarea name="ShowActorNotes"
                        class="form-control">${a.ShowActorNotes}</textarea>
            </label>
          </div>
          <button type="submit" class="btn btn-primary">
            Update Actor
          </button>
        </form>
        <div id="editActorResult" style="margin-top:10px;"></div>
      `);

      // 3) Handle submission
      $('#editActorForm').on('submit', function(e) {
        e.preventDefault();
        const payload = $(this).serializeArray();
        payload.push({name:'function', value:'UpdateShowActor'});

        $.post('https://apiplayinc.spacegap.net/index.php',
               payload, function(res) {
          if (res.success) {
            $('#editActorResult').html(
              '<span style="color:green;">✅ Updated successfully.</span>'
            );
          } else {
            $('#editActorResult').html(
              `<span style="color:red;">❌ ${res.error||'Error.'}</span>`
            );
          }
        }, 'json').fail(function(){
          $('#editActorResult').html(
            '<span style="color:red;">❌ Network error.</span>'
          );
        });
      });
    }, 'json');
  });
  </script>




<?php elseif ($_SESSION['ShowDashboard'] == 'AddActorForShow'): ?>
    <h2>Add Actor(s) to Show ID: <?= htmlspecialchars($_SESSION['SelectedShowID']) ?></h2>
    <div id="addActorFormContainer">
        <form id="addActorForm">
            <!-- Always include the ShowID once -->
            <input 
                type="hidden" 
                name="ShowActorShowID" 
                value="<?= htmlspecialchars($_SESSION['SelectedShowID']) ?>"
            >

            <div class="form-group">
                <label>How many actors to add?
                    <select id="actorCount" class="form-control" style="display:inline-block; width:auto; margin-left:10px;">
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </label>
            </div>

            <!-- Fields will be injected here -->
            <div id="actorFields"></div>

            <button 
                id="insertActorButton" 
                type="submit" 
                class="btn btn-primary"
            >Insert All Actors</button>
        </form>
        <div id="actorInsertResult" style="margin-top:10px;"></div>
    </div>

    <script>
    $(function() {
        // Helper to build N actor sub-forms
        function renderActorFields(count) {
            const container = $('#actorFields').empty();
            for (let i = 0; i < count; i++) {
                container.append(`
                    <fieldset style="margin-bottom:20px; padding:15px; border:1px solid #ccc;">
                      <legend>Actor ${i+1}</legend>
                      <div class="form-group">
                        <label>Role Type:
                          <input type="text" name="ShowActorRoleType[]" class="form-control" required>
                        </label>
                      </div>
                      <div class="form-group">
                        <label>Description:
                          <textarea name="ShowActorRoleDescription[]" class="form-control" required></textarea>
                        </label>
                      </div>
                      <div class="form-group">
                        <label>Fee:
                          <input type="number" step="0.01" name="ShowActorFee[]" class="form-control" required>
                        </label>
                      </div>
                      <div class="form-group">
                        <label>Notes:
                          <textarea name="ShowActorNotes[]" class="form-control"></textarea>
                        </label>
                      </div>
                    </fieldset>
                `);
            }
        }

        // Initial render for default count = 1
        renderActorFields($('#actorCount').val());

        // Re-render whenever the dropdown changes
        $('#actorCount').on('change', function() {
            renderActorFields($(this).val());
        });

        // Handle submission
        $('#addActorForm').on('submit', function(e) {
            e.preventDefault();
            const payload = $(this).serializeArray();
            payload.push({ name: 'function', value: 'InsertShowActor' });

            $.post(
                'https://apiplayinc.spacegap.net/index.php',
                payload,
                function(res) {
                    if (res.success) {
                        $('#actorInsertResult').html(
                            `<span style="color:green;">
                                ✅ Inserted actor IDs: ${res.insertedIDs.join(', ')}
                            </span>`
                        );
                    } else {
                        $('#actorInsertResult').html(
                            `<span style="color:red;">
                                ❌ Error: ${res.error || 'Unknown'}
                            </span>`
                        );
                    }
                },
                'json'
            ).fail(function() {
                $('#actorInsertResult').html(
                    '<span style="color:red;">❌ Network or server error.</span>'
                );
            });
        });
    });
    </script>


<?php elseif ($_SESSION['ShowDashboard'] == 'CreateBookingSlot'): ?>
    <h2>This is Create Booking Slot</h2>
    <div>
        <strong>SelectedBookingID:</strong> <?= $_SESSION['SelectedBookingID'] ?? 'Not set' ?><br>
        <strong>SelectedSlotTime:</strong> <?= $_SESSION['SelectedSlotTime'] ?? 'Not set' ?><br>
        <strong>SchoolID:</strong> <span id="sessionSchoolID"><?= $_SESSION['SchoolID'] ?? 'Not set' ?></span><br>
        <strong>TeacherID:</strong> <span id="sessionTeacherID"><?= $_SESSION['TeacherID'] ?? 'Not set' ?></span><br>
    </div>

    <div id="slotResult"></div>
    <div id="finalBookingSlot" style="margin-top: 20px;">
        <button id="createBookingSlotButton" disabled>Create Booking Slot</button>
        <div id="createBookingSlotResult" style="margin-top: 10px;"></div>
    </div>

<script>
$(document).ready(function() {
    // 0) Always start disabled
    $('#createBookingSlotButton').prop('disabled', true);

    // 1) Define the helper that enables the button only when both IDs are set
    function checkFinalButton() {
        const s = $('#sessionSchoolID').text().trim();
        const t = $('#sessionTeacherID').text().trim();
        if (s && s !== 'Not set' && t && t !== 'Not set') {
            $('#createBookingSlotButton').prop('disabled', false);
        } else {
            $('#createBookingSlotButton').prop('disabled', true);
        }
    }

    // 2) **IMMEDIATE** check in case spans were pre-populated server-side
    checkFinalButton();

    const bookingId = <?= json_encode($_SESSION['SelectedBookingID']); ?>;

    // 3) Load booking details
    $.post('https://apiplayinc.spacegap.net/index.php', {
        function: 'LoadEmailBookingOneResult',
        bookingId: bookingId
    }, function(data) {
        if (!data || data.length === 0) {
            $('#slotResult').html('<p>No booking details found.</p>');
            return;
        }

        const b             = data[0];
        const schoolName    = b.BookingDetails_NameOfSchool || '';
        const schoolAddr    = b.BookingDetails_Address         || '';
        const teacherName   = b.BookingDetails_ContactPerson   || '';
        const contactNumber = b.BookingDetails_ContactNumber   || '';

        let html = `<p><strong>School Name:</strong> ${schoolName}</p>`;

        // 4) Check School
        $.post('https://apiplayinc.spacegap.net/index.php', {
            function: 'CheckSchoolAvailability',
            SchoolName: schoolName
        }, function(res) {
            if (res.exists && res.SchoolID) {
                html += `
                  <p><strong>Status:</strong> ✅ Found</p>
                  <p><strong>SchoolID:</strong> ${res.SchoolID}</p>
                  <hr>
                `;
                $.post('setSession.php', { SchoolID: res.SchoolID }, function() {
                    $('#sessionSchoolID').text(res.SchoolID);
                    // re-check after session update
                    checkFinalButton();
                });
            } else {
                html += `
                  <p><strong>Status:</strong> ❌ Not Found</p>
                  <form id="insertSchoolForm">
                    <label>School Name:
                      <input type="text" name="SchoolName" value="${schoolName}" required>
                    </label><br>
                    <label>School Address:
                      <input type="text" name="SchoolAddress" value="${schoolAddr}" required>
                    </label><br>
                    <button type="submit" id="insertSchoolButton">Insert School</button>
                  </form>
                  <div id="schoolInsertResult"></div>
                  <hr>
                `;
                $.post('setSession.php', { SchoolID: '' }, function() {
                    $('#sessionSchoolID').text('Not set');
                    checkFinalButton();
                });
            }
        }, 'json')
        .always(function() {
            // 5) Then check Teacher
            $.post('https://apiplayinc.spacegap.net/index.php', {
                function: 'CheckTeacherAvailability',
                ContactNumber: contactNumber
            }, function(tres) {
                if (tres.exists && tres.TeacherID) {
                    html += `
                      <p><strong>Contact Number:</strong> ${contactNumber}</p>
                      <p><strong>Status:</strong> ✅ Found</p>
                      <p><strong>TeacherID:</strong> ${tres.TeacherID}</p>
                    `;
                    $.post('setSession.php', { TeacherID: tres.TeacherID }, function() {
                        $('#sessionTeacherID').text(tres.TeacherID);
                        checkFinalButton();
                    });
                } else {
                    html += `
                      <p><strong>Contact Number:</strong> ${contactNumber}</p>
                      <p><strong>Status:</strong> ❌ Not Found</p>
                      <form id="insertTeacherForm">
                        <input type="hidden" name="SchoolID" id="formSchoolID" value="">
                        <label>Teacher Name:
                          <input type="text" name="TeacherName" value="${teacherName}" required>
                        </label><br>
                        <label>Teacher Phone:
                          <input type="text" name="TeacherPhoneNumber" value="${contactNumber}" required>
                        </label><br>
                        <button type="submit" id="insertTeacherButton" disabled>
                          Insert Teacher
                        </button>
                      </form>
                      <div id="teacherInsertResult"></div>
                    `;
                    $.post('setSession.php', { TeacherID: '' }, function() {
                        $('#sessionTeacherID').text('Not set');
                        checkFinalButton();
                    });
                }
            }, 'json')
            .always(function() {
                // 6) Render and bind forms
                $('#slotResult').html(html);
                bindInsertSchool();
                bindInsertTeacher();
            });
        });
    }, 'json');

    // 7) Form bindings
    function bindInsertSchool() {
        $('#insertSchoolForm').on('submit', function(e) {
            e.preventDefault();
            const fd = $(this).serializeArray();
            fd.push({ name:'function', value:'InsertSchool' });
            $.post('https://apiplayinc.spacegap.net/index.php', fd, function(r) {
                if (r.success && r.SchoolID) {
                    $('#schoolInsertResult').html(
                      `<span style="color:green;">✅ School inserted ID: ${r.SchoolID}</span>`
                    );
                    $('#insertSchoolButton').prop('disabled', true);
                    $('#sessionSchoolID').text(r.SchoolID);
                    $('#formSchoolID').val(r.SchoolID);
                    $('#insertTeacherButton').prop('disabled', false);
                    checkFinalButton();
                } else {
                    $('#schoolInsertResult').html(
                      `<span style="color:red;">❌ Failed: ${r.error}</span>`
                    );
                }
            }, 'json');
        });
    }

    function bindInsertTeacher() {
        $('#insertTeacherForm').on('submit', function(e) {
            e.preventDefault();
            const fd = $(this).serializeArray();
            fd.push({ name:'function', value:'InsertTeacher' });
            $.post('https://apiplayinc.spacegap.net/index.php', fd, function(r) {
                if (r.success && r.TeacherID) {
                    $('#teacherInsertResult').html(
                      `<span style="color:green;">✅ Teacher inserted ID: ${r.TeacherID}</span>`
                    );
                    $('#insertTeacherButton').prop('disabled', true);
                    $('#sessionTeacherID').text(r.TeacherID);
                    checkFinalButton();
                } else {
                    $('#teacherInsertResult').html(
                      `<span style="color:red;">❌ Failed: ${r.error}</span>`
                    );
                }
            }, 'json');
        });
    }

    // 8) Finally, handle the create slot click
    $('#createBookingSlotButton').on('click', function() {
        $(this).prop('disabled', true);
        const payload = {
            function: 'InsertBookingSlot',
            BookingSlot_SchoolID:  $('#sessionSchoolID').text().trim(),
            BookingSlot_TeacherID: $('#sessionTeacherID').text().trim(),
            BookingSlot_BookingDetailID: <?= json_encode($_SESSION['SelectedBookingID'] ?? '') ?>,
            BookingSlot_DateTime: <?= json_encode($_SESSION['SelectedSlotTime'] ?? '') ?>,
            BookingSlot_BookingStatus: 'New Show'
        };
        $.post('https://apiplayinc.spacegap.net/index.php', payload, function(res) {
            if (res.success && res.BookingSlotID) {
                $('#createBookingSlotResult').html(
                  `<span style="color:green;">✅ Slot Created. ID: ${res.BookingSlotID}</span>`
                );
            } else {
                $('#createBookingSlotResult').html(
                  `<span style="color:red;">❌ Failed: ${res.error||'Unknown'}</span>`
                );
                $('#createBookingSlotButton').prop('disabled', false);
            }
        }, 'json');
    });
});
</script>






    <?php elseif ($_SESSION['ShowDashboard'] == 'ViewDetails' && isset($_SESSION['SelectedBookingID'])): ?>
    <h2>Details for Booking ID: <?= htmlspecialchars($_SESSION['SelectedBookingID']) ?></h2>
    <div id="bookingDetailsContainer">
        <p>Loading booking details…</p>
    </div>

    <script>
$(document).ready(function() {
    const bookingId = <?= json_encode($_SESSION['SelectedBookingID']); ?>;

    // 1) Fetch the booking details
    $.ajax({
        url: 'https://apiplayinc.spacegap.net/index.php',
        method: 'POST',
        data: {
            function: 'LoadEmailBookingOneResult',
            bookingId: bookingId
        },
        dataType: 'json'
    })
    .done(function(data) {
        if (!data || data.length === 0) {
            $('#bookingDetailsContainer').html('<p>No details found for this Booking ID.</p>');
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
            'BookingDetails_ContactEmail',
            'BookingDetails_DateAndTime',
            'BookingDetails_AlternativeDateAndTime',
            'BookingDetails_Remark'
        ];

        let details = '<div class="detail-view">';
        columnsToShow.forEach(function(colName) {
            const value = row[colName] || '-';
            details += `<div><strong>${colName}:</strong> ${value}`;

            // School check
            if (colName === 'BookingDetails_NameOfSchool') {
                const schoolCellId = `schoolCheck_${Math.random().toString(36).substring(2,10)}`;
                details += `<br><small id="${schoolCellId}" style="color:gray;">Checking school…</small>`;
                // fire the AJAX after insertion
                setTimeout(() => {
                    $.ajax({
                        url: 'https://apiplayinc.spacegap.net/index.php',
                        method: 'POST',
                        data: {
                            function: 'CheckSchoolAvailability',
                            SchoolName: value
                        },
                        dataType: 'json'
                    })
                    .done(function(resp) {
                        const html = resp.exists
                            ? '<span style="color:green;">✅ School Recorded</span>'
                            : '<span style="color:red;">❌ School Not Found</span>';
                        $(`#${schoolCellId}`).html(html);
                    })
                    .fail(function(xhr, status, err) {
                        console.error('School check failed:', status, err, xhr.responseText);
                        $(`#${schoolCellId}`).html(
                          '<span style="color:red;">Error checking school</span>'
                        );
                    });
                }, 0);
            }

            // Teacher check
            else if (colName === 'BookingDetails_ContactNumber') {
                const teacherCellId = `teacherCheck_${Math.random().toString(36).substring(2,10)}`;
                details += `<br><small id="${teacherCellId}" style="color:gray;">Checking teacher…</small>`;
                setTimeout(() => {
                    $.ajax({
                        url: 'https://apiplayinc.spacegap.net/index.php',
                        method: 'POST',
                        data: {
                            function: 'CheckTeacherAvailability',
                            ContactNumber: value
                        },
                        dataType: 'json'
                    })
                    .done(function(resp) {
                        const html = resp.exists
                            ? '<span style="color:green;">✅ Teacher Recorded</span>'
                            : '<span style="color:red;">❌ Teacher Not Found</span>';
                        $(`#${teacherCellId}`).html(html);
                    })
                    .fail(function(xhr, status, err) {
                        console.error('Teacher check failed:', status, err, xhr.responseText);
                        $(`#${teacherCellId}`).html(
                          '<span style="color:red;">Error checking teacher</span>'
                        );
                    });
                }, 0);
            }

            // Slot creation buttons
            else if (
                colName === 'BookingDetails_DateAndTime' ||
                colName === 'BookingDetails_AlternativeDateAndTime'
            ) {
                const btnId = `btn_${colName}`;
                details += `
                  <button id="${btnId}" style="margin-left:10px;">Create Slot</button>
                `;
                // delegate click
                $(document).on('click', `#${btnId}`, function() {
                    $.post('setSession.php', {
                        ShowDashboard: 'CreateBookingSlot',
                        SelectedSlotTime: value
                    }, function(resp) {
                        if (resp.trim() === 'success') {
                            location.reload();
                        } else {
                            alert('Failed to set slot time.');
                        }
                    });
                });
            }

            details += `</div>`;
        });
        details += '</div>';
        $('#bookingDetailsContainer').html(details);
    })
    .fail(function(xhr, status, err) {
        console.error('Booking details load failed:', status, err, xhr.responseText);
        $('#bookingDetailsContainer').html(
            `<p style="color:red;">Error loading booking details: ${status}</p>`
        );
    });
});
</script>
    <?php elseif ($_SESSION['ShowDashboard'] === 'ViewSlot'): ?>
    <h2>All Booking Slots</h2>
    <div id="viewSlotContainer">
        <p>Loading slots…</p>
    </div>

    <script>
    console.log("ViewSlot script loaded");
    $(document).ready(function() {
      console.log("Calling LoadBookingSlots");
      $.ajax({
        url: 'https://apiplayinc.spacegap.net/index.php',
        method: 'POST',
        data: { function: 'LoadBookingSlots' },
        dataType: 'json'
      })
      .done(function(data) {
        console.log("Slots data:", data);
        if (!Array.isArray(data) || data.length === 0) {
          $('#viewSlotContainer').html('<p>No slots found.</p>');
          return;
        }

        // Build table header (columns + “Details/Completed”)
        let table = '<table class="table"><thead><tr>';
        const cols = Object.keys(data[0]);
        cols.forEach(col => {
          table += `<th>${col}</th>`;
        });
        table += '<th>Action</th></tr></thead><tbody>';

        data.forEach(row => {
          table += '<tr>';
          cols.forEach(col => {
            table += `<td>${row[col] ?? '-'}</td>`;
          });

          // If status is "Completed", show “Completed” button → FinalizeBookingPage
          if (row.BookingSlot_BookingStatus === 'Completed') {
            table += `<td>
                        <button class="btn btn-sm btn-success"
                                onclick="goToFinalize(${row.BookingSlotID})">
                          Completed
                        </button>
                      </td>`;
          } else {
            // Otherwise show regular “Details” button → BookingSlotDetail
            table += `<td>
                        <button class="btn btn-sm btn-primary"
                                onclick="showSlotDetails(${row.BookingSlotID})">
                          Details
                        </button>
                      </td>`;
          }

          table += '</tr>';
        });

        table += '</tbody></table>';
        $('#viewSlotContainer').html(table);
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Failed to load slots:", textStatus, errorThrown);
        console.error("Raw response:", jqXHR.responseText);
        $('#viewSlotContainer').html(
          '<p style="color:red;">Error loading slots (check console)</p>'
        );
      });
    });

    // Navigate to BookingSlotDetail view
    function showSlotDetails(slotId) {
      $.post('setSession.php', {
        ShowDashboard: 'BookingSlotDetail',
        SelectedBookingSlotID: slotId
      }, function(resp) {
        if (resp.trim() === 'success') {
          window.location.href = 'dashboard.php';
        } else {
          alert('Failed to navigate to slot details.');
        }
      });
    }

    // Navigate to FinalizeBookingPage for Completed slots
    function goToFinalize(slotId) {
      $.post('setSession.php', {
        ShowDashboard: 'FinalizeBookingPage',
        SelectedBookingSlotID: slotId
      }, function(resp) {
        if (resp.trim() === 'success') {
          window.location.href = 'dashboard.php';
        } else {
          alert('Failed to navigate to finalize booking page.');
        }
      });
    }
    </script>

<?php elseif ($_SESSION['ShowDashboard'] === 'BookingSlotDetail' && isset($_SESSION['SelectedBookingSlotID'])): ?>
    <h2>
      Booking Slot Details for Booking Slot ID:
      <?= htmlspecialchars($_SESSION['SelectedBookingSlotID']) ?>
    </h2>

    <div id="bookingSlotDetailContainer">
      <p>Loading slot details…</p>
    </div>

    <script>
    $(document).ready(function() {
      const slotId = <?= json_encode($_SESSION['SelectedBookingSlotID']); ?>;

      function buildTable(obj) {
        let html = '<table><tbody>';
        for (let key in obj) {
          html += `
            <tr>
              <th style="background:#f0f0f0;padding:8px;text-align:left;">${key}</th>
              <td style="padding:8px;">${obj[key] == null ? '-' : obj[key]}</td>
            </tr>`;
        }
        html += '</tbody></table>';
        return html;
      }

      $.ajax({
        url: 'https://apiplayinc.spacegap.net/index.php',
        method: 'POST',
        data: {
          function: 'LoadBookingSlotDetail',
          BookingSlotID: slotId
        },
        dataType: 'json'
      })
      .done(function(data) {
        if (!data.slot || $.isEmptyObject(data.slot)) {
          $('#bookingSlotDetailContainer').html('<p>No details found for this slot.</p>');
          return;
        }

        let out = '';
        out += '<h3>Slot Info</h3>'       + buildTable(data.slot);
        out += '<h3>Booking Details</h3>' + buildTable(data.bookingDetails);
        out += '<h3>School Info</h3>'     + buildTable(data.school);
        out += '<h3>Teacher Info</h3>'    + buildTable(data.teacher);

        // Show Info (guard against empty)
        out += '<h3>Show Info</h3>';
        if (data.show && Object.keys(data.show).length > 0) {
          out += buildTable(data.show);
        } else {
          out += '<p>No show data available.</p>';
        }

        // Show Actors
        out += '<h3>Show Actors</h3>';
        if (Array.isArray(data.actors) && data.actors.length > 0) {
          let tblA = '<table><thead><tr>';
          Object.keys(data.actors[0]).forEach(col => {
            tblA += `<th>${col}</th>`;
          });
          tblA += '</tr></thead><tbody>';
          data.actors.forEach(actor => {
            tblA += '<tr>';
            Object.keys(actor).forEach(col => {
              tblA += `<td>${actor[col] == null ? '-' : actor[col]}</td>`;
            });
            tblA += '</tr>';
          });
          tblA += '</tbody></table>';
          out += tblA;
        } else {
          out += '<p>No actors found for this show.</p>';
        }

        // Slot‐Specific Actors with SINGLE radio per row, grouped by ShowActorID
        out += '<h3>Slot‐Specific Actors</h3>';
        if (Array.isArray(data.actors) && data.actors.length > 0) {
          // Build map: ShowActorID → [ BookingSlotActor rows ]
          const slotMap = {};
          data.slotActors.forEach(sa => {
            const aId = sa.ShowActorID;
            if (!slotMap[aId]) slotMap[aId] = [];
            slotMap[aId].push(sa);
          });

          data.actors.forEach(actor => {
            const aId = actor.ShowActorID;
            out += `<h4>ShowActor ID ${aId} – Role: ${actor.ShowActorRoleType || '-'}</h4>`;

            const matching = slotMap[aId] || [];
            if (matching.length > 0) {
              // Table header: all BookingSlotActor columns, plus a “Select” column
              let mini = '<table class="table table-sm"><thead><tr>';
              Object.keys(matching[0]).forEach(col => {
                mini += `<th>${col}</th>`;
              });
              mini += '<th>Select</th></tr></thead><tbody>';

              // Each row has a single radio whose name is the ShowActorID
              matching.forEach(saRow => {
                mini += '<tr>';
                Object.keys(saRow).forEach(col => {
                  mini += `<td>${saRow[col] == null ? '-' : saRow[col]}</td>`;
                });
                // One radio button per row, grouped by ShowActorID
                const radioId = `sel_${saRow.BookingSlotActorID}`;
                mini += `
                  <td style="vertical-align:middle;">
                    <div class="form-check">
                      <input class="form-check-input"
                             type="radio"
                             name="actorGroup_${aId}"
                             id="${radioId}"
                             value="${saRow.BookingSlotActorID}">
                      <label class="form-check-label" for="${radioId}">Select</label>
                    </div>
                  </td>`;
                mini += '</tr>';
              });

              mini += '</tbody></table>';
              out += mini;
            } else {
              out += '<p>No slot‐specific actor entries for this ShowActor ID.</p>';
            }
          });
        } else {
          out += '<p>No ShowActor definitions to display.</p>';
        }

        // Insert “Confirm Booking” button below everything
        out += `
          <div class="mt-4">
            <button id="confirmBookingBtn" class="btn btn-success">
              Confirm Booking
            </button>
          </div>`;
        $('#bookingSlotDetailContainer').html(out);

        // Click‐handler for “Confirm Booking”
        $('#confirmBookingBtn').on('click', function() {
          // 1) For each ShowActorID, ensure exactly one radio is selected
          let missing = [];
          data.actors.forEach(actor => {
            const aId = actor.ShowActorID;
            const selected = $(`input[name="actorGroup_${aId}"]:checked`).val();
            if (!selected) {
              missing.push(aId);
            }
          });

          if (missing.length > 0) {
            alert(
              'Please select one BookingSlotActor for each ShowActor.\n' +
              'Missing roles: ' + missing.join(', ')
            );
            return;
          }

          // 2) Collect all selected BookingSlotActorID values
          let toFinalize = [];
          data.actors.forEach(actor => {
            const aId = actor.ShowActorID;
            const chosenId = $(`input[name="actorGroup_${aId}"]:checked`).val();
            toFinalize.push(chosenId);
          });

          // 3) Send to API to update ConfirmStatus = "Finalize"
          $.post('https://apiplayinc.spacegap.net/index.php', {
            function: 'finalizeBookingSlot',
            BookingSlotActorIDs: toFinalize  // array of IDs
          }, function(res) {
            if (res.status) {
              // 4) On success, set session to FinalizeBookingPage and reload
              $.post('setSession.php', {
                ShowDashboard: 'FinalizeBookingPage',
                SelectedBookingSlotID: slotId
              }, function(resp) {
                if (resp.trim() === 'success') {
                  window.location.href = 'dashboard.php';
                }
              });
            } else {
              alert('Error finalizing: ' + res.error);
            }
          }, 'json')
          .fail(function(_, textStatus) {
            alert('Network error: ' + textStatus);
          });
        });
      })
      .fail(function(jqXHR, textStatus, errorThrown) {
        console.error("Error loading slot detail:", textStatus, errorThrown);
        console.error("Raw response:", jqXHR.responseText);
        $('#bookingSlotDetailContainer').html('<p style="color:red;">Error loading details (check console)</p>');
      });
    });
    </script>
<?php elseif ($_SESSION['ShowDashboard'] == 'SlotBooking'): ?>
  <h2>Slot Booking</h2>
  <div id="slotBookingContainer" class="container-fluid">
    <p>Loading slots…</p>
  </div>

  <script>
  // expose the current user’s ID
  const freelanceId = <?= json_encode($_SESSION['UserID'] ?? '') ?>;

  $(document).ready(function() {
    // 1) Fetch all slots + actors
    $.ajax({
      url: 'https://apiplayinc.spacegap.net/index.php',
      method: 'POST',
      data: { function: 'displayAllBookingSlots' },
      dataType: 'json'
    })
    .done(function(data) {
      // build the cards
      let html = '<div class="row">';
      data.forEach(slot => {
        const slotId = slot.BookingSlotID;
        html += `
          <div class="col-md-4 mb-4">
            <div class="card h-100" data-slot-id="${slotId}">
              <div class="card-body d-flex flex-column">
                <!-- Slot Info -->
                <div class="d-flex justify-content-between mb-2">
                  <span class="fw-semibold">Date & Time:</span>
                  <span>${slot.BookingSlot_DateTime || '-'}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="fw-semibold">Status:</span>
                  <span>${slot.BookingSlot_BookingStatus || '-'}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="fw-semibold">School:</span>
                  <span>${slot.BookingDetails_NameOfSchool || '-'}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <span class="fw-semibold">Show Name:</span>
                  <span>${slot.BookingDetails_ShowName || '-'}</span>
                </div>

                <!-- Cast & Roles -->
                <small class="text-muted">Cast & Roles:</small>
                <table class="table table-sm mb-3">
                  <thead>
                    <tr>
                      <th>Role</th>
                      <th>Notes</th>
                      <th>Confirmed?</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${
                      Array.isArray(slot.actors) && slot.actors.length
                        ? slot.actors.map(actor => {
                            const aId           = actor.ShowActorID;
                            const groupName     = `confirmed_${slotId}_${aId}`;
                            const remarkInputId = `remark_in_${slotId}_${aId}`;
                            const remarkBtnId   = `remark_btn_${slotId}_${aId}`;

                            return `
                              <tr>
                                <td>${actor.ShowActorRoleType || '-'}</td>
                                <td>${actor.ShowActorNotes     || '-'}</td>
                                <td>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                           name="${groupName}" value="Yes">
                                    <label class="form-check-label">Yes</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                           name="${groupName}" value="No">
                                    <label class="form-check-label">No</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                           name="${groupName}" value="Maybe">
                                    <label class="form-check-label">Maybe</label>
                                  </div>
                                  <div class="input-group input-group-sm mt-2">
                                    <input type="text"
                                           class="form-control"
                                           id="${remarkInputId}"
                                           data-slot-id="${slotId}"
                                           data-show-actor-id="${aId}"
                                           placeholder="Enter remark">
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="${remarkBtnId}">
                                      Update
                                    </button>
                                  </div>
                                </td>
                              </tr>`;
                          }).join('')
                        : '<tr><td colspan="3">No cast roles.</td></tr>'
                    }
                  </tbody>
                </table>

                <button class="btn btn-primary mt-auto"
                        onclick="openSlotDetail(${slotId})">
                  View
                </button>
              </div>
            </div>
          </div>`;
      });
      html += '</div>';
      $('#slotBookingContainer').html(html);

      // 2) Fetch & apply saved feedback + remark
      data.forEach(slot => {
        (slot.actors || []).forEach(actor => {
          const slotId       = slot.BookingSlotID;
          const aId          = actor.ShowActorID;
          const groupName    = `confirmed_${slotId}_${aId}`;
          const remarkInput  = $(`#remark_in_${slotId}_${aId}`);

          $.post('https://apiplayinc.spacegap.net/index.php', {
            function:      'getSlotActorFeedback',
            BookingSlotID: slotId,
            ShowActorID:   aId,
            FreelanceID:   freelanceId
          }, function(res) {
            if (res.status) {
              const fb = res.feedback || '';
              const rm = res.remark   || '';

              // pre-check the right radio
              if (['Yes','No','Maybe'].includes(fb)) {
                $(`input[name="${groupName}"][value="${fb}"]`).prop('checked', true);
              }
              // fill remark input
              remarkInput.val(rm);
            }
          }, 'json');
        });
      });
    })
    .fail((_, err) => {
      $('#slotBookingContainer').html(
        `<p class="text-danger">Error loading slots: ${err}</p>`
      );
    });
  });

  // 3) radio-change handler
  $(document).on('change', 'input[type=radio][name^="confirmed_"]', function() {
    const [ , slotId, showActorID ] = this.name.split('_');
    const feedback = this.value;

    $.post('https://apiplayinc.spacegap.net/index.php', {
      function:          'saveSlotActorFeedback',
      BookingSlotID:     slotId,
      ShowActorID:       showActorID,
      FreelanceFeedback: feedback,
      FreelanceID:       freelanceId
    });
  });

  // 4) remark-update handler
  $(document).on('click', 'button[id^="remark_btn_"]', function() {
    const $btn = $(this);
    const $inp = $btn.siblings('input.form-control');
    const slotId      = $inp.data('slot-id');
    const showActorID = $inp.data('show-actor-id');
    const rem         = $inp.val();

    $.post('https://apiplayinc.spacegap.net/index.php', {
      function:        'saveSlotActorRemark',
      BookingSlotID:   slotId,
      ShowActorID:     showActorID,
      FreelanceRemark: rem,
      FreelanceID:     freelanceId
    });
  });

  function openSlotDetail(slotId) {
    $.post('setSession.php', {
      SelectedBookingSlotID: slotId,
      ShowDashboard:        'BookingSlotDetails'
    }, resp => {
      if (resp.trim() === 'success') {
        window.location.href = 'dashboard.php';
      }
    });
  }
</script>

<?php elseif ($_SESSION['ShowDashboard'] === 'SlotBookingHistory'): ?>
  <h2>Slot Booking History</h2>
  <div id="slotBookingHistoryContainer" class="container-fluid">
    <p>Loading history…</p>
  </div>

  <script>
  const freelanceId = <?= json_encode($_SESSION['UserID'] ?? '') ?>;

  $(document).ready(function() {
    $.ajax({
      url: 'https://apiplayinc.spacegap.net/index.php',
      method: 'POST',
      data: { function: 'displayBookingSlotHistory' },
      dataType: 'json'
    })
    .done(function(data) {
      if (!Array.isArray(data) || data.length === 0) {
        return $('#slotBookingHistoryContainer')
          .html('<p>No completed slots found.</p>');
      }

      // 1) render cards
      let html = '<div class="row">';
      data.forEach(slot => {
        const slotId = slot.BookingSlotID;
        html += `
          <div class="col-md-4 mb-4">
            <div class="card h-100" data-slot-id="${slotId}">
              <div class="card-body d-flex flex-column">
                <!-- Slot Info -->
                <div class="d-flex justify-content-between mb-2">
                  <span class="fw-semibold">Date & Time:</span>
                  <span>${slot.BookingSlot_DateTime || '-'}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="fw-semibold">Status:</span>
                  <span>${slot.BookingSlot_BookingStatus || '-'}</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                  <span class="fw-semibold">School:</span>
                  <span>${slot.BookingDetails_NameOfSchool || '-'}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                  <span class="fw-semibold">Show Name:</span>
                  <span>${slot.BookingDetails_ShowName || '-'}</span>
                </div>

                <!-- Cast & Roles -->
                <small class="text-muted">Cast & Roles:</small>
                <table class="table table-sm mb-3">
                  <thead>
                    <tr>
                      <th>Role</th>
                      <th>Notes</th>
                      <th>Confirmed?</th>
                    </tr>
                  </thead>
                  <tbody>
                    ${
                      Array.isArray(slot.actors) && slot.actors.length
                        ? slot.actors.map(actor => {
                            const aId        = actor.ShowActorID;
                            const groupName  = `confirmed_${slotId}_${aId}`;
                            const curFb      = actor.FreelanceFeedback || '';
                            const remarkInputId = `remark_in_${slotId}_${aId}`;
                            const remarkBtnId   = `remark_btn_${slotId}_${aId}`;

                            return `
                              <tr>
                                <td>${actor.ShowActorRoleType || '-'}</td>
                                <td>${actor.ShowActorNotes     || '-'}</td>
                                <td>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                           name="${groupName}" value="Yes"
                                           ${curFb==='Yes'?'checked':''}>
                                    <label class="form-check-label">Yes</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                           name="${groupName}" value="No"
                                           ${curFb==='No'?'checked':''}>
                                    <label class="form-check-label">No</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio"
                                           name="${groupName}" value="Maybe"
                                           ${curFb==='Maybe'?'checked':''}>
                                    <label class="form-check-label">Maybe</label>
                                  </div>
                                  <div class="input-group input-group-sm mt-2">
                                    <input type="text"
                                           class="form-control"
                                           id="${remarkInputId}"
                                           data-slot-id="${slotId}"
                                           data-show-actor-id="${aId}"
                                           placeholder="Enter remark"
                                           value="${actor.Remark||''}">
                                    <button class="btn btn-outline-secondary"
                                            type="button"
                                            id="${remarkBtnId}">
                                      Update
                                    </button>
                                  </div>
                                </td>
                              </tr>`;
                          }).join('')
                        : '<tr><td colspan="3">No cast roles.</td></tr>'
                    }
                  </tbody>
                </table>
                <button class="btn btn-primary mt-auto"
                        onclick="openSlotDetail(${slotId})">
                  View
                </button>
              </div>
            </div>
          </div>`;
      });
      html += '</div>';
      $('#slotBookingHistoryContainer').html(html);

      // 2) pre-fill saved feedback/remarks
      data.forEach(slot => {
        slot.actors.forEach(actor => {
          const slotId = slot.BookingSlotID;
          const aId    = actor.ShowActorID;
          const group = `confirmed_${slotId}_${aId}`;
          const inp   = $(`#remark_in_${slotId}_${aId}`);

          $.post('https://apiplayinc.spacegap.net/index.php', {
            function:      'getSlotActorFeedback',
            BookingSlotID: slotId,
            ShowActorID:   aId,
            FreelanceID:   freelanceId
          }, res => {
            if (res.status) {
              if (['Yes','No','Maybe'].includes(res.feedback)) {
                $(`input[name="${group}"][value="${res.feedback}"]`)
                  .prop('checked', true);
              }
              inp.val(res.remark || '');
            }
          }, 'json');
        });
      });

      // 3) disable all radios + text inputs
      $('#slotBookingHistoryContainer')
        .find('input[type="radio"], input[type="text"]')
        .prop('disabled', true);
    })
    .fail((_, err) => {
      $('#slotBookingHistoryContainer').html(
        `<p class="text-danger">Error loading history: ${err}</p>`
      );
    });
  });

  function openSlotDetail(slotId) {
    $.post('setSession.php', {
      SelectedBookingSlotID: slotId,
      ShowDashboard:        'BookingSlotDetails'
    }, resp => {
      if (resp.trim() === 'success') {
        window.location.href = 'dashboard.php';
      }
    });
  }
</script>
<?php elseif ($_SESSION['ShowDashboard'] === 'Profile'): ?>
  <h2>Your Profile</h2>
  <div id="profileContainer">
    <p>Loading profile…</p>
  </div>

  <script>
  $(document).ready(function() {
    // Fetch profile
    $.ajax({
      url: 'https://apiplayinc.spacegap.net/index.php',
      method: 'POST',
      data: {
        function: 'GetUserProfile',
        UserID: <?= json_encode($_SESSION['UserID'] ?? '') ?>
      },
      dataType: 'json'
    })
    .done(function(res) {
      if (!res.status) {
        return $('#profileContainer').html(
          `<p class="text-danger">${res.error}</p>`
        );
      }
      const u = res.data;
      // Build a simple table
      let html = '<table class="table table-striped">';
      html += '<tbody>';
      html += `<tr><th>UserID</th><td>${u.UserID}</td></tr>`;
      html += `<tr><th>Email</th><td>${u.UserEmail}</td></tr>`;
      html += `<tr><th>Role</th><td>${u.UserRole}</td></tr>`;
      html += `<tr><th>Contact #</th><td>${u.UserContactNumber||'-'}</td></tr>`;
      html += `<tr><th>First Name</th><td>${u.UserFirstName||'-'}</td></tr>`;
      html += `<tr><th>Last Name</th><td>${u.UserLastName||'-'}</td></tr>`;
      html += `<tr><th>Active</th><td>${u.UserIsActive?'Yes':'No'}</td></tr>`;
      html += `<tr><th>Created At</th><td>${u.UserCreatedAt}</td></tr>`;
      html += `<tr><th>Updated At</th><td>${u.UserUpdatedAt}</td></tr>`;
      html += `<tr><th>Last Login</th><td>${u.UserLastLogin||'-'}</td></tr>`;
      html += '</tbody></table>';
      $('#profileContainer').html(html);
    })
    .fail(function(_, status) {
      $('#profileContainer').html(
        `<p class="text-danger">Network error: ${status}</p>`
      );
    });
  });
  </script>
<?php elseif ($_SESSION['ShowDashboard'] === 'FinalizeBookingPage' && isset($_SESSION['SelectedBookingSlotID'])): ?>
  <h2>
    Finalize Booking for Slot ID:
    <?= htmlspecialchars($_SESSION['SelectedBookingSlotID']) ?>
  </h2>

  <div id="finalizeBookingContainer">
    <p>Loading finalized details…</p>
  </div>

  <div class="mt-3">
    <button id="markCompletedBtn" class="btn btn-success">
      Mark as Completed
    </button>
    <span id="markCompletedResult" class="ms-2"></span>
  </div>

  <script>
  $(document).ready(function() {
    const slotId = <?= json_encode($_SESSION['SelectedBookingSlotID']); ?>;

    // Only show BookingSlot_DateTime for Slot Info
    function buildSlotDateTime(obj) {
      const dateTime = obj.BookingSlot_DateTime || '-';
      return `
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th style="background:#f0f0f0;padding:8px;text-align:left;">
                BookingSlot_DateTime
              </th>
              <td style="padding:8px;">${dateTime}</td>
            </tr>
          </tbody>
        </table>`;
    }

    // Show BookingDetails, excluding certain keys
    function buildFilteredBookingDetails(obj) {
      const hiddenKeys = [
        "BookingDetailID",
        "BookingDetails_DateAndTime",
        "BookingDetails_AlternativeDateAndTime",
        "BookingDetails_EmailSubject",
        "BookingDetails_EmailDateTime",
        "BookingDetails_EmailID",
        "BookingDetails_Read",
        "BookingDetails_Remark"
      ];
      let html = '<table class="table table-bordered"><tbody>';
      for (let key in obj) {
        if (hiddenKeys.includes(key)) continue;
        html += `
          <tr>
            <th style="background:#f0f0f0;padding:8px;text-align:left;">
              ${key}
            </th>
            <td style="padding:8px;">
              ${obj[key] == null ? '-' : obj[key]}
            </td>
          </tr>`;
      }
      html += '</tbody></table>';
      return html;
    }

    // Show full Show Info
    function buildFullTable(obj) {
      let html = '<table class="table table-bordered"><tbody>';
      for (let key in obj) {
        html += `
          <tr>
            <th style="background:#f0f0f0;padding:8px;text-align:left;">
              ${key}
            </th>
            <td style="padding:8px;">
              ${obj[key] == null ? '-' : obj[key]}
            </td>
          </tr>`;
      }
      html += '</tbody></table>';
      return html;
    }

    // Fetch and render everything
    $.ajax({
      url: 'https://apiplayinc.spacegap.net/index.php',
      method: 'POST',
      data: {
        function: 'LoadBookingSlotDetail',
        BookingSlotID: slotId
      },
      dataType: 'json'
    })
    .done(function(data) {
      if (!data.slot || $.isEmptyObject(data.slot)) {
        $('#finalizeBookingContainer').html('<p>No details found for this slot.</p>');
        return;
      }

      let out = '';

      // 1) Slot Info → only BookingSlot_DateTime
      out += '<h3>Slot Info</h3>' + buildSlotDateTime(data.slot);

      // 2) Booking Details (filtered)
      out += '<h3>Booking Details</h3>';
      out += buildFilteredBookingDetails(data.bookingDetails);

      // 3) Show Info (unchanged)
      out += '<h3>Show Info</h3>';
      if (data.show && Object.keys(data.show).length > 0) {
        out += buildFullTable(data.show);
      } else {
        out += '<p>No show data available.</p>';
      }

      // 4) Combined Show‐Actor + Finalized Slot‐Actor table
      out += '<h3>Finalized Cast & Roles</h3>';
      if (Array.isArray(data.actors) && data.actors.length > 0) {
        // Build a lookup of finalized booking‐slot actors by ShowActorID
        const finalizeMap = {};
        data.slotActors.forEach(sa => {
          if (sa.ConfirmStatus === 'Finalize') {
            if (!finalizeMap[sa.ShowActorID]) {
              finalizeMap[sa.ShowActorID] = sa;
            }
          }
        });

        // Hide unwanted ShowActor columns:
        const hiddenActorCols = [
          "ShowActorID",
          "ShowActorShowID",
          "ShowActorPreferredFreelancerID",
          "ShowActorRehearsalEnd",
          "ShowActorCreatedAt",
          "ShowActorUpdatedAt"
        ];
        const visibleActorCols = Object.keys(data.actors[0])
          .filter(col => !hiddenActorCols.includes(col));

        // Build combined table header
        let tbl = '<table class="table table-striped"><thead><tr>';
        visibleActorCols.forEach(col => {
          tbl += `<th>${col}</th>`;
        });
        tbl += '<th>FreelanceName</th>'; // new column
        tbl += '</tr></thead><tbody>';

        // Populate each row
        data.actors.forEach(actor => {
          const aId = actor.ShowActorID;
          tbl += '<tr>';
          visibleActorCols.forEach(col => {
            tbl += `<td>${actor[col] == null ? '-' : actor[col]}</td>`;
          });
          // Show the finalized user’s name if exists
          if (finalizeMap[aId]) {
            tbl += `<td>${finalizeMap[aId].FreelanceName || '-'}</td>`;
          } else {
            tbl += '<td>-</td>';
          }
          tbl += '</tr>';
        });

        tbl += '</tbody></table>';
        out += tbl;
      } else {
        out += '<p>No cast roles to display.</p>';
      }

      $('#finalizeBookingContainer').html(out);
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
      console.error("Error loading finalized details:", textStatus, errorThrown);
      console.error("Raw response:", jqXHR.responseText);
      $('#finalizeBookingContainer').html(
        '<p style="color:red;">Error loading details (check console)</p>'
      );
    });

    // When the “Mark as Completed” button is clicked:
    $('#markCompletedBtn').on('click', function() {
      $(this).prop('disabled', true);
      $('#markCompletedResult').text('Updating…');

      $.post('https://apiplayinc.spacegap.net/index.php', {
        function:        'finalizeBookingSlot',
        BookingSlotID:   slotId
      }, function(res) {
        if (res.status) {
          $('#markCompletedResult').text(res.message);
          // Optionally redirect to a “history” page or refresh:
          setTimeout(() => {
            location.reload();
          }, 1000);
        } else {
          $('#markCompletedResult').text('Error: ' + res.error);
          $('#markCompletedBtn').prop('disabled', false);
        }
      }, 'json')
      .fail(function(_, err) {
        $('#markCompletedResult').text('Network error: ' + err);
        $('#markCompletedBtn').prop('disabled', false);
      });
    });

  });
  </script>

  <?php elseif ($_SESSION['ShowDashboard'] === 'YNMSlot'): ?>
    <h2>YNM Slot &mdash; All BookingSlot × Teacher × School</h2>
    <div id="ynmSlotContainer">
        <p>Loading all booking slots with teacher & school info…</p>
    </div>

        <script>
    $(function(){
      const userId = <?= json_encode($userID) ?>;
      $.post('https://apiplayinc.spacegap.net/index.php', {
        function: 'LoadYNMSlotUser',
        FreelanceID: userId
      }, function(data){
        if (!Array.isArray(data) || data.length===0) {
          return $('#ynmSlotContainer').html('<p>No “New Show” slots found.</p>');
        }
        // Columns to hide
        const hideCols = [
          'BookingSlotID','BookingSlot_BookingDetailID','BookingSlot_SchoolID',
          'BookingSlot_Address','BookingSlot_AudienceSize',/* booking datetime now shown */
          'BookingSlot_TeacherID','BookingSlot_ShowName','BookingSlot_Remark',
          'BookingSlot_BookingStatus','TeacherName','TeacherEmail',
          'TeacherPhoneNumber','SchoolName','SchoolAddress',
          'SchoolContactNumber','BookingDetails_EmailDateTime',
          'BookingDetails_AlternativeDateAndTime',
          'BookingDetails_AudienceSize','BookingDetails_ContactPerson',
          'BookingDetails_ContactNumber','BookingDetails_ContactEmail'
        ];
        // Filter only New Show
        const rows = data.filter(r=>r.BookingSlot_BookingStatus==='New Show');
        if (rows.length===0) {
          return $('#ynmSlotContainer').html('<p>No “New Show” slots found.</p>');
        }
        let html = '<div class="cards">';
        rows.forEach(r=>{
          html += '<div class="card">';
          html += `<h4>Slot ID: ${r.BookingSlotID}</h4>`;
          Object.keys(r).forEach(key=>{
            if (hideCols.includes(key)) return;
            const val = r[key]===null||r[key]===''? '—' : r[key];
            html += `<p><strong>${key.replace(/([A-Z])/g,' $1')}:</strong> ${val}</p>`;
          });
          html += '<div class="actions">';
          // Only YES and NO
          html += '<div class="radios">';
          ['YES','NO'].forEach(opt=>{
            const chk = r.FreelanceFeedback===opt?' checked':'';
            html += `<label><input type="radio"
                       name="ynm_${r.BookingSlotID}"
                       value="${opt}"${chk}> ${opt}</label>`;
          });
          html += '</div>';
          // Remark
          html += `<div class="remark">
                     <input type="text"
                            id="remark_${r.BookingSlotID}"
                            class="remark-input"
                            value="${r.Remark.replace(/"/g,'&quot;')}"
                            placeholder="Enter remark">
                     <button class="remark-button"
                             data-slotid="${r.BookingSlotID}">
                       Submit Remark
                     </button>
                   </div>`;
          html += '</div>'; // .actions
          html += '</div>'; // .card
        });
        html += '</div>'; // .cards
        $('#ynmSlotContainer').html(html);

        // Handlers
        $('#ynmSlotContainer').on('change','input[type=radio]',function(){
          const slot = this.name.split('_')[1], val=this.value;
          $.post('https://apiplayinc.spacegap.net/index.php',{ 
            function:'SubmitYNMFeedback',
            BookingSlotID:slot,
            FreelanceID:userId,
            FreelanceFeedback:val
          },resp=>{ if(!resp.status) alert(resp.error) },'json');
        });
        $('#ynmSlotContainer').on('click','.remark-button',function(){
          const slot = $(this).data('slotid'),
                remark = $('#remark_'+slot).val().trim();
          if(!remark) return alert('Please enter a remark.');
          $.post('https://apiplayinc.spacegap.net/index.php',{ 
            function:'SubmitYNMRemark',
            BookingSlotID:slot,
            FreelanceID:userId,
            Remark:remark
          },resp=>{ if(!resp.status) alert(resp.error) },'json');
        });

      },'json').fail(()=>{
        $('#ynmSlotContainer').html('<p style="color:red;">Error loading slots.</p>');
      });
    });
    </script>
    <?php elseif ($_SESSION['ShowDashboard'] === 'AdminYNM'): ?>
     <h2>Admin View YNM &mdash; “New Show” Booking Slots</h2>
  <div id="adminYnmContainer"><p>Loading…</p></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $(function(){
    const hideCardCols = [
      'BookingSlotID','BookingSlot_BookingDetailID','BookingSlot_SchoolID',
      'BookingSlot_Address','BookingSlot_AudienceSize','BookingSlot_TeacherID',
      'BookingSlot_ShowName','BookingSlot_Remark','BookingSlot_BookingStatus',
      'BookingDetails_EmailDateTime','BookingDetails_AlternativeDateAndTime'
    ];

    // 1) Load slots
    $.post('https://apiplayinc.spacegap.net/index.php',{
      function:'LoadAdminYNMSlot'
    },function(slots){
      if (!Array.isArray(slots)||!slots.length) {
        return $('#adminYnmContainer').html('<p>No “New Show” slots found.</p>');
      }

      // Build slot cards
      let html = '<div class="cards">';
      slots.forEach(slot=>{
        html += '<div class="card">';
        html += `<h4>Slot ID: ${slot.BookingSlotID}</h4>`;
        Object.keys(slot).forEach(k=>{
          if (hideCardCols.includes(k)) return;
          html += `<p><strong>${k}:</strong> ${slot[k]||'—'}</p>`;
        });
        html += `<h5>YNMBookSlot Records</h5>
                 <div id="ynmTable_${slot.BookingSlotID}">
                   <p>Loading records…</p>
                 </div>`;
        html += '</div>';
      });
      html += '</div>';
      $('#adminYnmContainer').html(html);

      // 2) Load each slot's YNMBookSlot rows
      slots.forEach(slot=>{
        $.post('https://apiplayinc.spacegap.net/index.php',{
          function:'LoadAdminYNMBookSlots',
          BookingSlotID: slot.BookingSlotID
        },function(rows){
          const cont = $(`#ynmTable_${slot.BookingSlotID}`);
          if (!Array.isArray(rows)||!rows.length) {
            return cont.html('<p>No records.</p>');
          }
          // Hide no columns here—api already omitted IDs
          let tbl = '<table><thead><tr>';
          Object.keys(rows[0]).forEach(col=>{
            tbl += `<th>${col}</th>`;
          });
          tbl += '</tr></thead><tbody>';
          rows.forEach(r=>{
            tbl += '<tr>';
            Object.keys(r).forEach(col=>{
              tbl += `<td>${r[col]||'—'}</td>`;
            });
            tbl += '</tr>';
          });
          tbl += '</tbody></table>';
          cont.html(tbl);
        },'json')
        .fail(()=>{
          $(`#ynmTable_${slot.BookingSlotID}`)
            .html('<p style="color:red;">Error loading records.</p>');
        });
      });
    },'json')
    .fail(()=>{
      $('#adminYnmContainer')
        .html('<p style="color:red;">Error loading slots.</p>');
    });
  });
  </script>
  <?php elseif ($_SESSION['ShowDashboard'] === 'SchoolListing'): ?>
  <h2>School Listing</h2>
  <input type="text" id="schoolSearch" placeholder="Type to search schools…"
         style="padding:8px;font-size:1em;width:300px;">
  <ul id="results" style="list-style:none;padding:0;margin:10px 0;
                         width:300px;border:1px solid #ccc;
                         max-height:200px;overflow-y:auto;"></ul>
  <p id="noResult" style="color:#888;display:none;">No results found.</p>

  <div id="schoolDetailsContainer"></div>
  <div id="schoolActions" style="margin:8px 0;"></div>
  <div id="teacherTableContainer" style="margin-top:16px;"></div>

  <script>
  $(function() {
    let debounceTimer, currentSchoolId = null;

    $('#schoolSearch').on('input', function() {
      clearTimeout(debounceTimer);
      const q = $(this).val().trim();
      $('#results').empty();
      $('#noResult').hide();
      $('#schoolDetailsContainer,#schoolActions,#teacherTableContainer').empty();
      if (!q) return;

      debounceTimer = setTimeout(function() {
        $.post('https://apiplayinc.spacegap.net/index.php', {
          function: 'SearchSchools', query: q
        }, function(data) {
          $('#results').empty();
          if (!data.length) {
            $('#noResult').show();
          } else {
            data.forEach(item => {
              $('#results').append(
                `<li data-id="${item.SchoolID}" style="
                    padding:8px;border-bottom:1px solid #eee;
                    cursor:pointer;">
                  ${item.SchoolName}
                </li>`
              );
            });
          }
        }, 'json').fail(()=>{
          $('#noResult').text('Error searching.').show();
        });
      }, 300);
    });

    // School selected
    $('#results').on('click','li',function(){
      currentSchoolId = $(this).data('id');
      const name = $(this).text();
      $('#schoolSearch').val(name);
      $('#results,#noResult').empty();

      // 1) School details
      $.post('https://apiplayinc.spacegap.net/index.php',{
        function:'GetSchoolDetails', schoolId: currentSchoolId
      }, function(rows){
        if (!rows.length) {
          return $('#schoolDetailsContainer').html('<p>No details.</p>');
        }
        const s=rows[0];
        let h = '<h3>School Details</h3><table style="border-collapse:collapse;">';
        Object.keys(s).forEach(k=>{
          h+=`<tr>
                 <th style="padding:4px;border:1px solid #ccc;text-align:left;">
                   ${k}
                 </th>
                 <td style="padding:4px;border:1px solid #ccc;">
                   ${s[k]||''}
                 </td>
               </tr>`;
        });
        h+='</table>';
        $('#schoolDetailsContainer').html(h);

        // Actions for school
        $('#schoolActions').html(`
          <button id="deleteSchool">Delete School</button>
          <button id="editSchool">Edit School</button>
        `);
      }, 'json');

      // 2) Teachers for that school
      $.post('https://apiplayinc.spacegap.net/index.php',{
        function:'GetTeachersBySchool', schoolId: currentSchoolId
      }, function(rows){
        if (!rows.length) {
          return $('#teacherTableContainer').html('<p>No teachers.</p>');
        }
        // Build table with Actions column
        const cols = Object.keys(rows[0]);
        let h = '<h3>Teachers</h3><table style="border-collapse:collapse;"><thead><tr>';
        cols.forEach(c=>h+=`<th style="padding:4px;border:1px solid #ccc;">${c}</th>`);
        h+=`<th style="padding:4px;border:1px solid #ccc;">Actions</th></tr></thead><tbody>`;
        rows.forEach(t=>{
          h+='<tr>';
          cols.forEach(c=>{
            h+=`<td style="padding:4px;border:1px solid #ccc;">${t[c]||''}</td>`;
          });
          h+=`<td style="padding:4px;border:1px solid #ccc;">
                 <button class="deleteTeacher" data-id="${t.TeacherID}">
                   Delete
                 </button>
                 <button class="editTeacher" data-id="${t.TeacherID}">
                   Edit
                 </button>
               </td>`;
          h+='</tr>';
        });
        h+='</tbody></table>';
        $('#teacherTableContainer').html(h);
      }, 'json');
    });

    // Delete School
    $('#schoolActions').on('click','#deleteSchool', function(){
      if (!currentSchoolId) return;
      if (!confirm('Delete this school?')) return;
      $.post('https://apiplayinc.spacegap.net/index.php',{
        function:'DeleteSchool',
        SchoolID: currentSchoolId
      }, function(resp){
        if (resp.success) {
          alert('Deleted');
          $('#schoolDetailsContainer,#schoolActions,#teacherTableContainer').empty();
          $('#schoolSearch').val('');
        } else {
          alert('Error: '+resp.error);
        }
      }, 'json');
    });

    // Edit School
    $('#schoolActions').on('click','#editSchool', function(){
      if (!currentSchoolId) return;
      window.location.href =
        'dashboard.php?page=edit_school&schoolId=' + currentSchoolId;
    });

    // Delete Teacher
    $('#teacherTableContainer').on('click','.deleteTeacher', function(){
      const tid = $(this).data('id');
      if (!confirm('Delete this teacher?')) return;
      $.post('https://apiplayinc.spacegap.net/index.php',{
        function:'DeleteTeacher',
        TeacherID: tid
      }, function(resp){
        if (resp.success) {
          alert('Deleted');
          // re-click the same school to refresh
          $('li[data-id="'+currentSchoolId+'"]').click();
        } else {
          alert('Error: '+resp.error);
        }
      }, 'json');
    });

    // Edit Teacher
    $('#teacherTableContainer').on('click','.editTeacher', function(){
      const tid = $(this).data('id');
      window.location.href =
        'dashboard.php?page=edit_teacher&teacherId='+tid+'&schoolId='+currentSchoolId;
    });

  });
  </script>
  <?php elseif ($_SESSION['ShowDashboard'] === 'EditSchool'): ?>
  <?php
    // Fetch school details server-side
    require 'config.php';
    $sid = $_GET['schoolId'] ?? '';
    $school = [];
    if ($sid) {
      $r = $conn->query("SELECT * FROM School WHERE SchoolID = '$sid'");
      $school = $r->fetch_assoc() ?: [];
    }
  ?>
  <h2>Edit School (ID <?=htmlspecialchars($sid)?>)</h2>
  <form id="editSchoolForm">
    <input type="hidden" name="SchoolID" value="<?=htmlspecialchars($sid)?>">
    <?php foreach ($school as $col => $val): ?>
      <?php if ($col === 'SchoolID') continue; ?>
      <div style="margin-bottom:8px;">
        <label>
          <?=htmlspecialchars($col)?>:
          <input type="text" name="<?=htmlspecialchars($col)?>"
                 value="<?=htmlspecialchars($val)?>" style="width:300px;padding:4px;">
        </label>
      </div>
    <?php endforeach; ?>
    <button type="submit">Update School</button>
  </form>
  <div id="editSchoolResult" style="margin-top:8px;"></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $('#editSchoolForm').on('submit', function(e){
    e.preventDefault();
    const data = $(this).serializeArray();
    data.push({ name:'function', value:'UpdateSchool' });
    $.post('https://apiplayinc.spacegap.net/index.php', data, function(resp){
      if (resp.success) {
        $('#editSchoolResult').html('<span style="color:green;">Updated!</span>');
        setTimeout(()=>{
          window.location.href = 'dashboard.php?page=school_listing';
        }, 1000);
      } else {
        $('#editSchoolResult').html(
          '<span style="color:red;">Error: '+resp.error+'</span>'
        );
      }
    }, 'json');
  });
  </script>

// ─── Edit Teacher ───
<?php elseif ($_SESSION['ShowDashboard'] === 'EditTeacher'): ?>
  <?php
    // Fetch teacher details server-side
    require 'config.php';
    $tid = $_GET['teacherId'] ?? '';
    $teacher = [];
    if ($tid) {
      $r = $conn->query("SELECT * FROM Teacher WHERE TeacherID = '$tid'");
      $teacher = $r->fetch_assoc() ?: [];
    }
  ?>
  <h2>Edit Teacher (ID <?=htmlspecialchars($tid)?>)</h2>
  <form id="editTeacherForm">
    <input type="hidden" name="TeacherID" value="<?=htmlspecialchars($tid)?>">
    <?php foreach ($teacher as $col => $val): ?>
      <?php if ($col === 'TeacherID') continue; ?>
      <div style="margin-bottom:8px;">
        <label>
          <?=htmlspecialchars($col)?>:
          <input type="text" name="<?=htmlspecialchars($col)?>"
                 value="<?=htmlspecialchars($val)?>" style="width:300px;padding:4px;">
        </label>
      </div>
    <?php endforeach; ?>
    <button type="submit">Update Teacher</button>
  </form>
  <div id="editTeacherResult" style="margin-top:8px;"></div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
  $('#editTeacherForm').on('submit', function(e){
    e.preventDefault();
    const data = $(this).serializeArray();
    data.push({ name:'function', value:'UpdateTeacher' });
    $.post('https://apiplayinc.spacegap.net/index.php', data, function(resp){
      if (resp.success) {
        $('#editTeacherResult').html('<span style="color:green;">Updated!</span>');
        setTimeout(()=>{
          window.location.href = 'dashboard.php?page=school_listing';
        }, 1000);
      } else {
        $('#editTeacherResult').html(
          '<span style="color:red;">Error: '+resp.error+'</span>'
        );
      }
    }, 'json');
  });
  </script>


    <?php else: ?>
        <h2>Welcome to your dashboard</h2>
        <p><strong>User ID:</strong> <?= $userID; ?></p>
        <p><strong>User Role:</strong> <?= $userRole; ?></p>
        <p><strong>Email:</strong> <?= $userEmail; ?></p>
        <p><strong>Session:</strong> <?= $_SESSION['ShowDashboard']; ?></p>
    <?php endif; ?>
</div>

</body>
</html>

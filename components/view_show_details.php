<div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0 card-no-border">
                                        <h4>This is Dilton's test line</h4>
                                        <h4>Details for Show ID: <?php echo htmlspecialchars($_SESSION['SelectedShowID']); ?></h4>
                                        <span>View detailed information about the selected show below, including cast and roles.</span>
                                    </div>
                                    <div class="card-body">
                                        <div id="showDetailsContainer">
                                            <p>Loading show details…</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            $(document).ready(function() {
                                const showId = <?php echo json_encode($_SESSION['SelectedShowID']); ?>;

                                // Load show details
                                $.ajax({
                                    url: 'https://apiplayinc.spacegap.net/index.php',
                                    method: 'POST',
                                    data: { function: 'displayShowDetails', ShowID: showId },
                                    dataType: 'json',
                                    success: function(data) {
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

                                        // Fetch actors
                                        $.ajax({
                                            url: 'https://apiplayinc.spacegap.net/index.php',
                                            method: 'POST',
                                            data: { function: 'displayShowActors', ShowID: showId },
                                            dataType: 'json',
                                            success: function(actors) {
                                                let actorHtml = '<h5>Cast & Roles</h5>';

                                                if (!actors || actors.length === 0) {
                                                    actorHtml += '<p>No actors found for this show.</p>';
                                                } else {
                                                    actorHtml += `
                                                        <div class="table-responsive theme-scrollbar custom-scrollbar">
                                                            <table class="display" id="actorsTable" style="width:100%">
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
                                                                    <button class="btn btn-sm btn-danger" onclick="deleteActor(${actor.ShowActorID})">Delete</button>
                                                                    <button class="btn btn-sm btn-warning" onclick="editActor(${actor.ShowActorID})">Edit</button>
                                                                </td>
                                                            </tr>`;
                                                    });
                                                    actorHtml += '</tbody></table></div>';
                                                }

                                                // Add Actor button
                                                actorHtml += `
                                                    <div style="margin-top:15px;">
                                                        <button id="addActorButton" class="btn btn-success">Add Actor</button>
                                                    </div>`;

                                                $('#showDetailsContainer').append(actorHtml);

                                                // Initialize DataTable for actors table
                                                $('#actorsTable').DataTable({
                                                    responsive: true,
                                                    scrollX: true,
                                                    ordering: true,
                                                    language: {
                                                        emptyTable: "No actors found."
                                                    }
                                                });
                                            },
                                            error: function(_, textStatus) {
                                                $('#showDetailsContainer').append(
                                                    `<p style="color:red;">Error loading cast: ${textStatus}</p>`
                                                );
                                            }
                                        });
                                    },
                                    error: function(_, textStatus) {
                                        $('#showDetailsContainer').html(
                                            `<p style="color:red;">Error loading show details: ${textStatus}</p>`
                                        );
                                    }
                                });

                                // Edit Actor
                                function editActor(actorId) {
                                    $.post('setSession.php', {
                                        ShowDashboard: 'EditActorForShow',
                                        SelectedActorID: actorId
                                    }, function(resp) {
                                        if (resp.trim() === 'success') {
                                            window.location.href = 'dashboard.php';
                                        } else {
                                            alert('Could not open edit form: ' + resp);
                                        }
                                    });
                                }

                                // Delete Actor
                                function deleteActor(actorId) {
                                    if (!confirm('Are you sure you want to delete this actor role?')) return;
                                    $.post(
                                        'https://apiplayinc.spacegap.net/index.php',
                                        { function: 'deleteShowActor', ShowActorID: actorId },
                                        function(res) {
                                            if (res.success) {
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

                                // Add Actor
                                $(document).on('click', '#addActorButton', function() {
                                    $.post('setSession.php', {
                                        ShowDashboard: 'AddActorForShow',
                                        SelectedShowID: showId
                                    }, function(response) {
                                        if (response.trim() === 'success') {
                                            window.location.href = 'dashboard.php';
                                        } else {
                                            alert('Failed to switch to Add Actor view: ' + response);
                                        }
                                    });
                                });
                            });
                            </script>
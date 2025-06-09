<div class="col-sm-12">
                                <div class="card">
                                    <div class="card-header pb-0 card-no-border">
                                        <h4>Add Actor(s) to Show ID: <?php echo htmlspecialchars($_SESSION['SelectedShowID']); ?></h4>
                                        <span>Fill in the details below to add actors to the show.</span>
                                    </div>
                                    <div class="card-body">
                                        <div id="addActorFormContainer">
                                            <form id="addActorForm">
                                                <input type="hidden" name="ShowActorShowID" value="<?php echo htmlspecialchars($_SESSION['SelectedShowID']); ?>">
                                                <div class="mb-3">
                                                    <label for="actorCount" class="form-label">How many actors to add?</label>
                                                    <select id="actorCount" class="form-select" style="width: auto;">
                                                        <?php for ($i = 1; $i <= 10; $i++): ?>
                                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                                <div id="actorFields"></div>
                                                <button id="insertActorButton" type="submit" class="btn btn-primary">Insert All Actors</button>
                                            </form>
                                            <div id="actorInsertResult" style="margin-top:10px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <script>
                            $(function() {
                                function renderActorFields(count) {
                                    const container = $('#actorFields').empty();
                                    for (let i = 0; i < count; i++) {
                                        container.append(`
                                            <fieldset class="mb-3" style="padding:15px; border:1px solid #ddd; border-radius:5px;">
                                                <legend>Actor ${i+1}</legend>
                                                <div class="mb-2">
                                                    <label class="form-label">Role Type:</label>
                                                    <input type="text" name="ShowActorRoleType[]" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Description:</label>
                                                    <textarea name="ShowActorRoleDescription[]" class="form-control" required></textarea>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Fee:</label>
                                                    <input type="number" step="0.01" name="ShowActorFee[]" class="form-control" required>
                                                </div>
                                                <div class="mb-2">
                                                    <label class="form-label">Notes:</label>
                                                    <textarea name="ShowActorNotes[]" class="form-control"></textarea>
                                                </div>
                                            </fieldset>
                                        `);
                                    }
                                }

                                renderActorFields(1);

                                $('#actorCount').on('change', function() {
                                    renderActorFields($(this).val());
                                });

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
                                                    `<span style="color:green;">✅ Inserted actor IDs: ${res.insertedIDs.join(', ')}</span>`
                                                );
                                            } else {
                                                $('#actorInsertResult').html(
                                                    `<span style="color:red;">❌ Error: ${res.error || 'Unknown'}</span>`
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
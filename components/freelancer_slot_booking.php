<?php
// Ensure session is started (already handled in dashboard.php)
// No additional session_start() needed here
?>

<div class="container-fluid">
    <div class="row project-cards">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div id="slotBookingContainer" class="row">
                        <p>Loading slots…</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
const freelanceId = <?= json_encode($_SESSION['UserID'] ?? '') ?>;

$(document).ready(function() {
    // Fetch all slots + actors
    $.ajax({
        url: 'https://apiplayinc.spacegap.net/index.php',
        method: 'POST',
        data: { function: 'displayAllBookingSlots' },
        dataType: 'json'
    })
    .done(function(data) {
        if (!Array.isArray(data) || data.length === 0) {
            $('#slotBookingContainer').html('<p>No slots available.</p>');
            return;
        }

        // Build cards using projects.php design
        let html = '';
        data.forEach(slot => {
            const slotId = slot.BookingSlotID;
            html += `
                <div class="col-xxl-4 col-lg-6 box-col-6">
                    <div class="project-box b-light1-primary">
                        <span class="badge badge-primary">${slot.BookingSlot_BookingStatus || 'New'}</span>
                        <h5 class="f-w-500">${slot.BookingDetails_ShowName || 'Untitled Show'}</h5>
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p>${slot.BookingDetails_NameOfSchool || 'Unknown School'}</p>
                            </div>
                        </div>
                        <p>Date & Time: ${slot.BookingSlot_DateTime || '-'}</p>
                        <div class="row details">
                            <div class="col-6"><span>Show Name</span></div>
                            <div class="col-6 font-primary">${slot.BookingDetails_ShowName || '-'}</div>
                            <div class="col-6"><span>Status</span></div>
                            <div class="col-6 font-primary">${slot.BookingSlot_BookingStatus || '-'}</div>
                        </div>
                        <div class="mt-3">
                            <small class="text-muted">Cast & Roles:</small>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Role</th>
                                        <th>Notes</th>
                                        <th>Availability</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${
                                        Array.isArray(slot.actors) && slot.actors.length
                                            ? slot.actors.map(actor => {
                                                const aId = actor.ShowActorID;
                                                const groupName = `confirmed_${slotId}_${aId}`;
                                                const remarkInputId = `remark_in_${slotId}_${aId}`;
                                                const remarkBtnId = `remark_btn_${slotId}_${aId}`;
                                                return `
                                                    <tr>
                                                        <td>${actor.ShowActorRoleType || '-'}</td>
                                                        <td>${actor.ShowActorNotes || '-'}</td>
                                                        <td>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="${groupName}" id="${groupName}_yes" value="Yes">
                                                                <label class="form-check-label" for="${groupName}_yes">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="${groupName}" id="${groupName}_no" value="No">
                                                                <label class="form-check-label" for="${groupName}_no">No</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="${groupName}" id="${groupName}_maybe" value="Maybe">
                                                                <label class="form-check-label" for="${groupName}_maybe">Maybe</label>
                                                            </div>
                                                            <div class="input-group input-group-sm mt-2">
                                                                <input type="text" class="form-control" id="${remarkInputId}" data-slot-id="${slotId}" data-show-actor-id="${aId}" placeholder="Enter remark">
                                                                <button class="btn btn-outline-secondary" type="button" id="${remarkBtnId}">Update</button>
                                                            </div>
                                                        </td>
                                                    </tr>`;
                                            }).join('')
                                            : '<tr><td colspan="3">No cast roles available.</td></tr>'
                                    }
                                </tbody>
                            </table>
                        </div>
                        <button class="btn btn-primary mt-3" onclick="openSlotDetail(${slotId})">View Details</button>
                    </div>
                </div>`;
        });
        $('#slotBookingContainer').html(html);

        // Fetch and apply saved feedback + remarks
        data.forEach(slot => {
            (slot.actors || []).forEach(actor => {
                const slotId = slot.BookingSlotID;
                const aId = actor.ShowActorID;
                const groupName = `confirmed_${slotId}_${aId}`;
                const remarkInput = $(`#remark_in_${slotId}_${aId}`);

                $.post('https://apiplayinc.spacegap.net/index.php', {
                    function: 'getSlotActorFeedback',
                    BookingSlotID: slotId,
                    ShowActorID: aId,
                    FreelanceID: freelanceId
                }, function(res) {
                    if (res.status) {
                        const fb = res.feedback || '';
                        const rm = res.remark || '';
                        if (['Yes', 'No', 'Maybe'].includes(fb)) {
                            $(`input[name="${groupName}"][value="${fb}"]`).prop('checked', true);
                        }
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

    // Radio change handler
    $(document).on('change', 'input[type=radio][name^="confirmed_"]', function() {
        const [, slotId, showActorID] = this.name.split('_');
        const feedback = this.value;

        $.post('https://apiplayinc.spacegap.net/index.php', {
            function: 'saveSlotActorFeedback',
            BookingSlotID: slotId,
            ShowActorID: showActorID,
            FreelanceFeedback: feedback,
            FreelanceID: freelanceId
        });
    });

    // Remark update handler
    $(document).on('click', 'button[id^="remark_btn_"]', function() {
        const $btn = $(this);
        const $inp = $btn.siblings('input.form-control');
        const slotId = $inp.data('slot-id');
        const showActorID = $inp.data('show-actor-id');
        const rem = $inp.val();

        $.post('https://apiplayinc.spacegap.net/index.php', {
            function: 'saveSlotActorRemark',
            BookingSlotID: slotId,
            ShowActorID: showActorID,
            FreelanceRemark: rem,
            FreelanceID: freelanceId
        });
    });

    function openSlotDetail(slotId) {
        $.post('setSession.php', {
            SelectedBookingSlotID: slotId,
            ShowDashboard: 'BookingSlotDetails'
        }, resp => {
            if (resp.trim() === 'success') {
                window.location.href = 'dashboard.php';
            } else {
                alert('Failed to view slot details.');
            }
        });
    }
});
</script>
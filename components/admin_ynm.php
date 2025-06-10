<div class="col-sm-12">
    <div class="card">
        <div class="card-header pb-0 card-no-border">
            <h4>All Shows</h4>
            <span>Shows available for freelancers to indicate YES or NO.</span>
        </div>
        <div class="card-body">
            <div id="ynmShowContainer">
                <p>Loading shows…</p>
            </div>
        </div>
    </div>
    <div id="ynmDetailsContainer" style="display:none;margin-top:20px;">
        <div class="card">
            <div class="card-header pb-0 card-no-border">
                <h4>Freelancer Responses</h4>
            </div>
            <div class="card-body">
                <div id="ynmShowDetails"><p>Select a show to view responses.</p></div>
            </div>
        </div>
    </div>
</div>

<script>
function loadFreelancerDetails(showId){
    $('#ynmDetailsContainer').show();
    $('#ynmShowDetails').html('<p>Loading…</p>');
    $.post('https://apiplayinc.spacegap.net/index.php',{function:'LoadAdminYNMSlot'},function(slots){
        if(!Array.isArray(slots) || !slots.length){
            $('#ynmShowDetails').html('<p>No records found.</p>');
            return;
        }
        const filtered = slots.filter(s => String(s.ShowID||s.BookingDetails_ShowID||s.BookingSlot_ShowID)===String(showId) || String(s.BookingSlot_ShowName)===String(showId));
        if(!filtered.length){
            $('#ynmShowDetails').html('<p>No slots found for this show.</p>');
            return;
        }
        let html='';
        filtered.forEach(slot => {
            const slotId = slot.BookingSlotID;
            html += `<h5>Slot ID: ${slotId}</h5><div id="slot_${slotId}"><p>Loading records…</p></div>`;
            $.post('https://apiplayinc.spacegap.net/index.php',{function:'LoadAdminYNMBookSlots',BookingSlotID:slotId},function(rows){
                if(!Array.isArray(rows) || !rows.length){
                    $(`#slot_${slotId}`).html('<p>No records.</p>');
                    return;
                }
                let tbl='<div class="table-responsive"><table class="table table-bordered"><thead><tr>';
                Object.keys(rows[0]).forEach(c=>{ tbl+=`<th>${c}</th>`; });
                tbl+='</tr></thead><tbody>';
                rows.forEach(r=>{
                    tbl+='<tr>';
                    Object.keys(r).forEach(c=>{ tbl+=`<td>${r[c]??'-'}</td>`; });
                    tbl+='</tr>';
                });
                tbl+='</tbody></table></div>';
                $(`#slot_${slotId}`).html(tbl);
            },'json').fail(()=>{ $(`#slot_${slotId}`).html('<p style="color:red;">Error loading records.</p>'); });
        });
        $('#ynmShowDetails').html(html);
    },'json').fail(()=>{ $('#ynmShowDetails').html('<p style="color:red;">Error loading slots.</p>'); });
}

$(function(){
    $.ajax({
        url:'https://apiplayinc.spacegap.net/index.php',
        method:'POST',
        data:{function:'displayAllShow'},
        dataType:'json'
    }).done(function(data){
        if(!Array.isArray(data) || !data.length){
            $('#ynmShowContainer').html('<p>No shows found.</p>');
            return;
        }
        const cols=['ShowID','ShowName','ShowDuration','ShowAgeGroup','ShowShortDescription','ShowDescription'];
        let html='<div class="table-responsive theme-scrollbar custom-scrollbar">';
        html+='<table class="display" id="ynmShowsTable" style="width:100%"><thead><tr>';
        cols.forEach(c=>{ html+=`<th>${c}</th>`; });
        html+='<th>Action</th></tr></thead><tbody>';
        data.forEach(row=>{
            html+='<tr>';
            cols.forEach(c=>{ html+=`<td>${row[c]??'-'}</td>`; });
            html+=`<td><a href="#" onclick="loadFreelancerDetails(${row.ShowID});return false;">View Details</a></td>`;
            html+='</tr>';
        });
        html+='</tbody></table></div>';
        $('#ynmShowContainer').html(html);
        $('#ynmShowsTable').DataTable({responsive:true,scrollX:true,ordering:true,language:{emptyTable:'No shows found.'}});
    }).fail(function(_,txt){
        $('#ynmShowContainer').html(`<p style="color:red;">Error loading shows: ${txt}</p>`);
    });
});
</script>

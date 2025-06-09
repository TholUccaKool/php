<div class="card">
    <div class="card-body">
        <h5 class="card-title">Manage Freelancers Show</h5>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Show Name</th>
                        <th>Show Date</th>
                        <th>Freelancer Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'backend_dashboard.php'; // adjust if you use different DB connection

                    $query = "SELECT * FROM shows WHERE is_freelancer = 1";
                    $result = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['show_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['show_date']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['freelancer_count']) . "</td>";
                        echo "<td><a href='dashboard.php?page=freelancer_show_details&id=" . $row['id'] . "' class='btn btn-info btn-sm'>View Details</a></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

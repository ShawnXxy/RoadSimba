<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Post By</th>
            <th>Date Posted / Expired</th>
            <th>Pickup/Delivery Date</th>
            <th>Pickup Location</th>
            <th>Delivery Location</th>
            <th>Load Type / Vehicle Size</th>
            <th>Miles</th>
            <th>Pieces / Weight</th>
            <th>Price ($)</th>
            <th>Note</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Posts data loading here -->
        <?php view_loads(); ?>
    </tbody>
</table>

<?php delete_load(); ?>
    
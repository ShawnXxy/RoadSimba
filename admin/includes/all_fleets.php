<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact</th>       
            <th>Vehicle Type / Size</th>
            <th>Date</th>
            <th>Location</th>
            <th>GPS</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Users data loading here -->
        <?php load_fleets(); ?>
    </tbody>
</table>

<?php delete_fleet(); ?>
    
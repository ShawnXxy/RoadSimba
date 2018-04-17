<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Lastname</th>
            <th>Firstname</th>
            <th>Email</th>       
            <th>Phone</th>
            <th>Role</th>
            <th>MC #</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Users data loading here -->
        <?php load_dispatchers(); ?>
    </tbody>
</table>

<?php delete_dispatcher(); ?>
    
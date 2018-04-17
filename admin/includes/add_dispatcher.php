<form action="" method="post" enctype="multipart/form-data">
    <!-- Add User -->
    <?php add_dispatcher(); ?>
    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" class="form-control" name="firstname">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" class="form-control" name="lastname">
    </div>

    <div class="form-group">
        <label for="email">Email *</label>
        <input type="email" class="form-control" name="email" required>
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" class="form-control" name="phone" placeholder="">
    </div>

    <div class="form-group">
        <label for="mc_num">MC #</label>
        <input type="text" class="form-control" name="mc_num" placeholder="">
    </div>

    <div class="form-group">
        <label for="role">Role *</label>
        <select name="role" required>
            <option value="1">Select Role</option>
            <option value="1">Dispatcher</option>
        </select>
    </div>

    <div class="form-group">
        <input type="submit" class="btn btn-success" name="create_dispatcher" value="Create">
    </div>
</form>
<form class="row m-5 g-3" action="#" method="POST">
    <div class="col-6">
        <label for="inputAddress" class="form-label">First name</label>
        <input type="text" class="form-control" name="first_name" value="<?php echo $userData['first_name'] ?>">
    </div>
    <div class="col-6">
        <label for="inputAddress2" class="form-label">Last name</label>
        <input type="text" class="form-control" name="last_name" value="<?php echo $userData['last_name'] ?>">
    </div>
    <div class="col-6">
        <label for="inputEmail4" class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?php echo $userData['email'] ?>">
    </div>
    <div class="col-6">
        <label for="inputPassword4" class="form-label">Password</label>
        <input type="password" class="form-control" name="password" placeholder="New password">
    </div>
    <div class="col-6">
        <label for="inputCity" class="form-label">Adress</label>
        <input type="text" class="form-control" name="adress" value="<?php echo $userData['adress'] ?>">
    </div>
    <div class="col-md-6">
        <label for="inputZip" class="form-label">Phone number</label>
        <input type="text" class="form-control" name="tel" value="<?php echo $userData['tel'] ?>">
    </div>
    <div class="col-md">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>
</form>
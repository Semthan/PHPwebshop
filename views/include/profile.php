<form action="#" method="POST">
    <div>
        <input type="text" name="first_name" value="<?php echo $userData['first_name'] ?>">
    </div>
    <div>
        <input type="text" name="last_name" value="<?php echo $userData['last_name'] ?>">
    </div>
    <div>
        <input type="text" name="email" value="<?php echo $userData['email'] ?>">
    </div>
    <div>
        <input type="text" name="tel" value="<?php echo $userData['tel'] ?>">
    </div>
    <div>
        <input type="text" name="adress" value="<?php echo $userData['adress'] ?>">
    </div>
    <div>
        <input type="text" name="password" placeholder="Nytt lösenord">
    </div>
    <div>
        <input type="submit" value="Uppdatera">
    </div>
</form>
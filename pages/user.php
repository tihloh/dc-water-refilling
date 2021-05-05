<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	//post operation here...
	
	$op=$_POST["op"]??"";
	if($op=="save"){
		$id=$_POST["id"]??"";
		$user=$_POST["user"]??"";
		$pass=$_POST["pass"]??"";
		
		if($id==""){
			$q="INSERT INTO tblusers(user,pass) VALUES('$user', '$pass')";
		}else{
			$q="UPDATE tblusers SET user='$user',pass='$pass' WHERE id='$id'";
		}
		echo $q;
		//$mysqli->query($q);
		header("Location: .?p=orders");
	}
	if($op=="del"){
		$id=$_POST["id"]??"";		
		$q="DELETE FROM tblusers id='$id'";
		echo $q;
	}
	exit;
}

?>

<form method="post">
	<input type="text" name="id" value="<?php echo $_GET["edit"]??""; ?>" />
	User <input type="text" name="user" value="<?php echo $_GET["user"]??""; ?>" />
	Pass <input type="text" name="pass" value="<?php echo $_GET["pass"]??""; ?>" />
	<button name="op" value="save">Save</button>
</form>

    <table >
      <thead>
        <tr>
          <th>User</th>
          <th>Pass</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>User</td>
          <td>Pass</td>
          <td><a href="?p=user&edit=1&user=User&pass=Pass">Edit</a><form method="post"><input type="hidden" name="id" value="1" /><button name="op" value="del">Delete</button><form></td>
        </tr>
        <tr>
          <td>admin</td>
          <td>admin</td>
          <td><a href="?p=user&edit=2&user=admin&pass=admin">Edit</a><form method="post"><input type="hidden" name="id" value="2" /><button name="op" value="del">Delete</button><form></td>
        </tr>
      </tbody>
    </table>

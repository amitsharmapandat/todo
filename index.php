<?php
$db = mysqli_connect('localhost','root','','todo');

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($db,"update task set deleted=1 where id=$delete_id");
}
if(isset($_POST['submit'])){
    $task = $_POST['task'];
    mysqli_query($db,"Insert into task (task,created_at) values ('$task',now())");
}

$query = mysqli_query($db,"select * from task where deleted=0");
?>

<html>
<head>
<title>Todo</title>
<style>
    td{
        padding:10px;
    }
    body{
        background: #bbd5eb;
    }
    div{
        text-align:center;
    }
    /* tr{
        border-top:1px solid grey;
    } */
.delete{
    text-decoration:none;
    color:#ffffff; 
    background:red;
    padding: 7px;
    border-radius:5px;
}
.submit{
    padding: 5px 10px;
    border-radius: 5px;
    background: #c59832;
    color: #fff;
}
#task{
    height: 30px;
    border-radius: 5px;
}
table{
    margin: auto;
}
table, th, td {
  border-bottom: 1px solid black;
  border-collapse: collapse;
}
</style>
</head>
<body>
<div>
<h1>Todo Application</h1>
<form method="POST" action="index.php">
<input type="text" placeholder="Enter Task" name="task" id="task"/>
<input type="submit" value="Add" name="submit" class="submit"/>
</form>
</div>
<table>
<thead>
<tr><th>ID</th><th>Task</th><th>Date</th><th>Action</th></tr>
</thead>
<tbody>
<?php while($row= mysqli_fetch_array($query)){?>
<tr>
<td><?php echo $row['id']?></td>
<td><?php echo $row['task']?></td>
<td><?php echo $row['created_at']?></td>
<td><a class="delete" href='index.php?delete=<?php echo $row['id']?>'>X</td>
</tr>
<?php }?>
<tbody>
</table>                
</body>
</html>
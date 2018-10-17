<?
$mysqli = new Mysqli('localhost', 'root', '', 'test1');
$name = trim($_POST['name']);
$phone = intval($_POST['phone']);
$comment = ($_POST['comment']);
if($comment == ''){
	$comment= NULL;
}
if($name && $phone){
	$query = $mysqli->query("INSERT INTO `main` VALUES(NULL, '$name', '$phone', '$comment')");
	$query2 = $mysqli->query("SELECT * FROM `main` ORDER BY `id` DESC");

	while($row = $query2->fetch_assoc()){
		$users['id'][] = $row['id'];
		$users['name'][] = $row['name'];
		$users['phone'][] = $row['phone'];
		$users['comment'][] = $row['comment'];
	}
	$message = 'Все хорошо';
}else{
	$message = 'Не удалось записать и извлечь данные';
}
$out = array(
	'message' => $message,
	'users' => $users
);
header('Content-Type: text/json; charset=utf-8');
echo json_encode($out);


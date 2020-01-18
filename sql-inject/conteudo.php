<?php

$id = $_GET['id'];
$conn = ConnectDb::_connection();
$stmt = $conn->findAll("select c.* from agenda_2019.contato c where c.id = {$id}");

/*
// 2
$id = $_GET['id'];
$id = preg_replace('/[^A-Za-z0-9_]/', '', $_GET['id']);

$conn = ConnectDb::_connection();
$stmt = $conn->findAll("select c.* from agenda_2019.contato c where c.id = {$id}");
*/

//3
/*$id = $_GET['id'];
$conn = ConnectDb::_connection();
$stmt = $conn->findLikeBy('select c.* from agenda_2019.contato c where c.id = :id', ['id' => $id]);
*/
?>

<table border="1">
	<tr>
		<td>id</td>
		<td>nome</td>
		<td>sexo</td>
		<td>dt_nascimento</td>
		<td>apelido</td>
	</tr>
	<?php foreach ($stmt as $key => $value):?>
		<tr>
			<td><?=$value['id'];?></td>
			<td><?=$value['nome'];?></td>
			<td><?=$value['sexo'];?></td>
			<td><?=$value['dt_nascimento'];?></td>
			<td><?=$value['apelido'];?></td>
		</tr>
	<?php endforeach;?>
</table>
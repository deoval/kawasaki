<?php 
if( (!isset($_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"])) AND (!isset($_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"])) )
echo '<script language= "JavaScript">location.href="' . GLOBAL_PATH . '"</script>';

$id_cliente=$_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"];

$mq= explode("|",isset($_POST['mq'])? $_POST['mq'] : "0|0");
$valor_ativo=isset($_POST['a'])? $_POST['a'] : "1";
$m=$mq[0];
$q=$mq[1];


$db = new DB();
$db->setColuns("s.id_solicitacao as solicitacao_id, s.data, s.ativo, s.valor, c.nome as cliente, s.id_cliente as cliente_id,
m.nome as motoboy, m.id_motoboy as motoboy_id,
seb.id_solicitacao_endereco as sendbusca_id, seb.endereco as enderecoa, seb.numero as numeroa, seb.bairro as bairroa, seb.cidade as cidadea,
see.id_solicitacao_endereco as sendentrega_id , see.endereco as enderecob , see.numero as numerob, see.bairro as bairrob, see.cidade as cidadeb" );
$db->setFrom("solicitacao as s");
$db->setJoin("inner join cliente as c on s.id_cliente = c.id_cliente
left join motoboy as m on s.id_motoboy=m.id_motoboy
inner join solicitacao_endereco as seb on seb.id_solicitacao_endereco=s.id_solicitacao_endereco_busca
inner join solicitacao_endereco as see on see.id_solicitacao_endereco=s.id_solicitacao_endereco_entrega");
if ((int)$m >0 && (int)$m<13 && (int)$q==1)
	$db->setWhere(" and s.id_cliente=". $id_cliente . " and s.ativo= ". $valor_ativo ." and date_format(data,'%m')=" . $m . " and date_format(data,'%d') <= 15");
else if ((int)$m >0 && (int)$m<13 && (int)$q==2)
	$db->setWhere(" and s.id_cliente=". $id_cliente . " and s.ativo= ". $valor_ativo ." and date_format(data,'%m')=" . $m. " and date_format(data,'%d') >= 15");
else	
$db->setWhere(" and s.id_cliente=". $id_cliente . " and s.ativo= ". $valor_ativo);

$db->Query($db->Select());

header("Content-type: application/vnd.ms-excel");
header("Content-type: application/force-download");
header("Content-Disposition: attachment; filename=relatorio.xls");


if ($valor_ativo==1){

	echo "<h3>solicita&ccedil;&otilde;es em aberto:</h3>";
}
else{
	echo "<h3>solicita&ccedil;&otilde;es finalizadas:</h3>";
}
?>
<table >
  		<thead>
   			 <tr>
      			<th>c&oacute;digo</th>
      			<th>Local de Busca</th>
				<th>Local de Entrega</th>
      			<th>Data e hora</th>
      			<th>Valor</th>      			
      			<th>Motoboy</th>      			
    		</tr>
  		</thead>

	
	<?php while ($dado = $db->Fetch()) { 
		$local_busca= htmlentities($dado->enderecoa  . ", " . $dado->numeroa . ", " . $dado->bairroa . ", " . $dado->cidadea);
		$local_entrega= htmlentities($dado->enderecob  . ", " . $dado->numerob . ", " . $dado->bairrob . ", " . $dado->cidadeb);
		$data = new DateTime($dado->data);
	?>	

		 <tbody>
		     <tr>
		        <td><?php echo $dado->solicitacao_id ?></td>
		        <td><?php echo $local_busca ?></td>
				<td><?php echo $local_entrega ?></td>
		        <td><?php echo $data->format('d-m-Y H:i:s') ?></td>
		        <td>R$ <?php echo $dado->valor ?></td>
		        <td><?php echo htmlentities($dado->motoboy) ?></td>
		     </tr>
		     
		</tbody>			
  	<?php }//Fechando while?>
</table>

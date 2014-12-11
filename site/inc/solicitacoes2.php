<?php 
/*
$db = new DB();
$db->setColuns("s.id_solicitacao, s.data, s.ativo, s.valor, c.nome as cliente, m.nome as motoboy, send.endereco, cat.nome as categoria" );
$db->setFrom("solicitacao as s, cliente as c, motoboy as m, solicitacao_endereco as send, categoria as cat");
$db->setWhere("and s.id_cliente = c.id_cliente and s.id_motoboy = m.id_motoboy 
	and s.id_solicitacao_endereco_busca = send.id_solicitacao_endereco and s.id_categoria = cat.id_categoria");
*/
$id_cliente=$_SESSION['site'][_EMPRESA_]['cliente']["id_cliente"];

$mq= explode("|",isset($_POST['mq'])? $_POST['mq'] : "0|0");
$m=$mq[0];
$q=$mq[1];

$db = new DB();
$db->setColuns("s.id_solicitacao as solicitacao_id, s.data, s.ativo, s.valor, c.nome as cliente, s.id_cliente as cliente_id,
m.nome as motoboy, m.id_motoboy as motoboy_id,
seb.id_solicitacao_endereco as sendbusca_id, seb.endereco as enderecoa, seb.numero as numeroa, seb.bairro as bairroa, seb.cidade as cidadea,
see.id_solicitacao_endereco as sendentrega_id , see.endereco as enderecob , see.numero as numerob, see.bairro as bairrob, see.cidade as cidadeb" );
$db->setFrom("solicitacao as s");
$db->setJoin("inner join cliente as c on s.id_cliente = c.id_cliente
inner join motoboy as m on s.id_motoboy=m.id_motoboy
inner join solicitacao_endereco as seb on seb.id_solicitacao_endereco=s.id_solicitacao_endereco_busca
inner join solicitacao_endereco as see on see.id_solicitacao_endereco=s.id_solicitacao_endereco_entrega");
if ((int)$m >0 && (int)$m<13 && (int)$q==1)
	$db->setWhere(" and s.id_cliente=". $id_cliente . " and s.ativo=0 and date_format(data,'%m')=" . $m . " and date_format(data,'%d') <= 15");
else if ((int)$m >0 && (int)$m<13 && (int)$q==2)
	$db->setWhere(" and s.id_cliente=". $id_cliente . " and s.ativo=0 and date_format(data,'%m')=" . $m. " and date_format(data,'%d') >= 15");
else	
$db->setWhere(" and s.id_cliente=". $id_cliente . " and s.ativo=0");

$db->Query($db->Select());
 

?>
<div id="solicitacoes" style="width:70%; height:100%; float:right; margin-top:60px" >

<div class="table-responsive" style="width:90%; margin:auto">
<h3>Solicitações finalizadas:</h3>

<form method="post" action="">
<h5>
Selecione o período:
</h5>
<div style="width:21%;float:left">
<select name="mq" class="form-control" >
<option value="0|0">Todos</option>
<option value="1|1">janeiro-1ª quinzena</option>
<option value="1|2">janeiro-2ª quinzena</option>
<option value="2|1">fevereiro-1ª quinzena</option>
<option value="2|2">fevereiro-2ª quinzena</option>
<option value="3|1">março-1ª quinzena</option>
<option value="3|2">março-2ª quinzena</option>
<option value="4|1">abril-1ª quinzena</option>
<option value="4|2">abril-2ª quinzena</option>
<option value="5|1">maio-1ª quinzena</option>
<option value="5|2">maio-2ª quinzena</option>
<option value="6|1">junho-1ª quinzena</option>
<option value="6|2">junho-2ª quinzena</option>
<option value="7|1">julho-1ª quinzena</option>
<option value="7|2">julho-2ª quinzena</option>
<option value="8|1">agosto-1ª quinzena</option>
<option value="8|2">agosto-2ª quinzena</option>
<option value="9|1">setembro-1ª quinzena</option>
<option value="9|2">setembro-2ª quinzena</option>
<option value="10|1">outubro-1ª quinzena</option>
<option value="10|2">outubro-2ª quinzena</option>
<option value="11|1">novembro-1ª quinzena</option>
<option value="11|2">novembro-2ª quinzena</option>
<option value="12|1">dezembro-1ª quinzena</option>
<option value="12|2">dezembro-2ª quinzena</option>
</select>
</div><input type="submit" name="btnmesok" class="animate" id="btnmesok" value="Ok"/>
</form>
<br>
<form method="post" action="<?php echo GLOBAL_PATH; ?>relatorio_impressao" name="fexcel" id="fexcel">
<input type="hidden" name="mq" value="<?php echo $_POST['mq'] ?>"/>
<input type="hidden" name="a" value="0"/>
<input type="submit" name="Excel" class="animate" id="Excel" value="Exportar para Excel"/>
</form>
<br>
<table class="table-striped table-hover" style="clear:both">
  		<thead>
   			 <tr>
      			<th>Código</th>
      			<th>Local de Busca</th>
				<th>Local de Entrega</th>
      			<th>Data e hora</th>
      			<th>Valor</th>      			
      			<th>Motoboy</th>      			
    		</tr>
  		</thead>

	
	<?php while ($dado = $db->Fetch()) { 
		$local_busca= $dado->enderecoa  . ", " . $dado->numeroa . ", " . $dado->bairroa . ", " . $dado->cidadea;
		$local_entrega= $dado->enderecob  . ", " . $dado->numerob . ", " . $dado->bairrob . ", " . $dado->cidadeb;
		$data = new DateTime($dado->data);
	?>	

		 <tbody>
		     <tr>
		        <td><?php echo $dado->solicitacao_id ?></td>
		        <td><?php echo $local_busca ?></td>
				<td><?php echo $local_entrega ?></td>
		        <td><?php echo $data->format('d-m-Y H:i:s') ?></td>
		        <td>R$ <?php echo $dado->valor ?></td>
		        <td><?php echo $dado->motoboy ?></td>
		     </tr>
		     
		</tbody>			
  	<?php }//Fechando while?>
</table>
<a href="?op=1" class="btn btn-default">Solicitações em aberto</a>
</div>
</div>
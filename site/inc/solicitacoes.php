<?php 

$db = new DB();
$db->setColuns("s.id_solicitacao, s.data, s.ativo, s.valor, c.nome as cliente, m.nome as motoboy, send.endereco, cat.nome as categoria" );
$db->setFrom("solicitacao as s, cliente as c, motoboy as m, solicitacao_endereco as send, categoria as cat");
$db->setWhere("s.id_cliente = c.id_cliente and s.id_motoboy = m.id_motoboy 
	and s.id_solicitacao_endereco_busca = send.id_solicitacao_endereco and s.id_categoria = cat.id_categoria");

$db->Query($db->Select());
 

?>
<div id="solicitacoes" style="width:70%; height:100%; float:right; margin-top:60px" >
<table>
  		<thead>
   			 <tr>
      			<th>Cliente</th>
      			<th>Motoboy</th>
      			<th>Endereço Busca</th>
      			<th>Endereço Entrega</th>      			
      			<th>Categoria</th>      			
      			<th>Data</th>      			
      			<th>Ativo</th>      			
      			<th>Valor</th>      			
    		</tr>
  		</thead>

	
	<?php while ($dado = $db->Fetch()) { ?>	

		 <tbody>
		     <tr>
		        <td><?php echo $dado->cliente ?></td>
		        <td><?php echo $dado->motoboy ?></td>
		        <td><?php echo $dado->endereco ?></td>
		        <td><?php echo "oi"//$dado-> ?></td>
		        <td><?php echo $dado->categoria ?></td>
		        <td><?php echo $dado->data ?></td>
		        <td><?php echo $dado->ativo ?></td>
		        <td><?php echo $dado->valor ?></td>		        
		     </tr>
		     
		</tbody>			
  	<?php }//Fechando while?>
</table>

</div>
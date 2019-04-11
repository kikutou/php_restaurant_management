<?php foreach($result["drink"] as $record):?>

       <tr>
        <td><?php echo $record["product_id"];?></td>
        <td><?php echo $record["number"];?></td>
        <td><p onclick="javascript:this.innerHTML=(this.innerHTML=='完了'?'料理済み':'料理済み');">
					<button type="button" class="btn btn-primary">完了</button></p></td>
       </tr>
<?php endforeach ?>

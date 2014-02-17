<h1>Domaines</h1>
<?php if (!empty($domaines) && count($domaines)): ?>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Active</th>
    </tr>
    <?php foreach ($domaines as $domain): ?>
    <tr>
        <td><?=$domain['name']?></td>
        <td><input type="checkbox" name="<?=$domain['name']?>" value="<?=$domain['etat']?>" /></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>No domaines yet!</p>
<?php endif;?>
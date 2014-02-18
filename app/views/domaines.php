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
<div class="container">
    <div class="row">
        <div class="center span4 well">
            <legend>Create a new domain</legend>
            <form role="form" id="post-domain-form" class="form-inline" method="post">
                <div class="form-group">
                    <label for="domain-field" class="sr-only">Domain name</label>
                    <input type="text" class="form-control" name="domain" id="domain-field" placeholder="Enter domain">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="etat" checked> Active
                    </label>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
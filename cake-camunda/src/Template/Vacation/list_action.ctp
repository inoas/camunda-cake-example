<h1>
    Offene Urlaubsanträge
    <button class="btn btn-default pull-right" data-toggle="modal" data-target="#create">
        <span class="glyphicon glyphicon-plus"></span>
        ANTRAG STELLEN
    </button>
</h1>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th colspan="4">Mitarbeiter</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task) { ?>
    <tr data-row-id="<?php echo $task['id']; ?>">
        <td class="col-xs-8">
            <span data-toggle="tooltip" data-placement="top" title="TASK-ID: <?php echo $task['id']; ?>"><?php echo $task['employee']; ?></span>
        </td>
        <td class="col-xs-2">
            <a class="btn btn-success btn-block btn-xs approve-or-deny" href="/approve/<?php echo $task['id']; ?>">
                <span class="glyphicon glyphicon-thumbs-up"></span> GENEHMIGEN
            </a>
        </td>
        <td class="col-xs-2">
            <a class="btn btn-danger btn-block btn-xs approve-or-deny" href="/deny/<?php echo $task['id']; ?>">
                <span class="glyphicon glyphicon-thumbs-down"></span> ABLEHNEN
            </a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="Urlaubsantrag erstellen">
    <div class="modal-dialog" role="document">
        <form action="/create" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Urlaubsantrag erstellen</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name des Antragstellers">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                        <span class="glyphicon glyphicon-remove"></span>
                        SCHLIEßEN
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-plus"></span>
                        URLAUBSANTRAG STELLEN
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
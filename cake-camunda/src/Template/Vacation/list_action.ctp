<h1>Offene Urlaubsanträge</h1>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th colspan="4">Mitarbeiter</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task) { ?>
    <tr>
        <td class="col-xs-8">
            <span data-toggle="tooltip" data-placement="top" title="TASK-ID: <?php echo $task['id']; ?>"><?php echo $task['employee']; ?></span>
        </td>
        <td class="col-xs-2">
            <a class="btn btn-success btn-block btn-xs" href="#">
                <span class="glyphicon glyphicon-ok"></span> GENEHMIGEN
            </a>
        </td>
        <td class="col-xs-2">
            <a class="btn btn-danger btn-block btn-xs" href="#">
                <span class="glyphicon glyphicon-remove"></span> ABLEHNEN
            </a>
        </td>
    </tr>
    <?php } ?>
    </tbody>
</table>
</div>
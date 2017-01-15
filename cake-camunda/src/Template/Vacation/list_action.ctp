<h1>Urlaubsanträge</h1>
<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th colspan="3">TASK-ID</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tasks as $task) { ?>
    <tr>
        <td class="col-xs-8"><?php echo $task->getId(); ?></td>
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
<h1>
    Offene Urlaubsanträge
    <button class="btn btn-default pull-right" data-toggle="modal" data-target="#create">
        <span class="glyphicon glyphicon-plus"></span>
        ANTRAG STELLEN
    </button>
</h1>
<table class="table table-bordered table-striped" id="vacation-request-table">
    <thead>
        <tr>
            <th colspan="4">Mitarbeiter</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
</div>

<!-- Modal -->
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="Urlaubsantrag erstellen">
    <div class="modal-dialog" role="document">
        <form action="/create" method="post" id="vacation-request-form">
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
<style>
    .output-body {
        white-space: pre-wrap;
        background: #000000;
        color: #00fa4a;
        padding: 10px;
        border-radius: 0;
    }
</style>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Existing backups</h3>

        <div class="card-tools">
            <a onclick="backupRun()" class="btn btn-primary backup-run">Run Backup now</a>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
        <table class="table grid-table table-sm table-hover select-table">
            <tbody>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Disk</th>
                <th>Reachable</th>
                <th>Healthy</th>
                <th># of backups</th>
                <th>Newest backup</th>
                <th>Used storage</th>
                <th>Backups</th>

            </tr>
            @foreach($backups as $index => $backup)
                <tr data-toggle="collapse" data-target="#trace-{{$index+1}}" style="cursor: pointer;">
                    <td>{{ $index+1 }}.</td>
                    <td>{{ @$backup[0] }}</td>
                    <td>{{ @$backup[1] }}</td>
                    <td>{{ @$backup[2] }}</td>
                    <td>{{ @$backup[3] }}</td>
                    <td>{{ @$backup['amount'] }}</td>
                    <td>{{ @$backup['newest'] }}</td>
                    <td>{{ @$backup['usedStorage'] }}</td>
                    <td colspan="8">
                        @foreach($backup['files'] as $file)
                            <div id="{{$file}}">
                                <span class="text">{{ $file }}</span>
                                <!-- Emphasis label -->
                                <div class="tools">
                                    <a target="_blank" href="{{admin_url('/backup/download?disk=local&file='.$backup[0].'/'.$file)}}"><i class="icon-download" style="color:blue"></i></a>
                                    <a onclick="deleteBackup('{{$file}}', '{{$backup[0].'/'.$file}}')" class="backup-delete" style="color:red"><i class="icon-trash"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

<div class="box box-default output-box hide">
    <div class="box-header with-border">
        <i class="fa fa-terminal"></i>

        <h3 class="box-title">Output</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <pre class="output-body"></pre>
    </div>
    <!-- /.box-body -->
</div>

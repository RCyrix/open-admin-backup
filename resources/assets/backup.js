function backupRun(){
    NProgress.start();
    let http = new XMLHttpRequest();
    let url = '/admin/backup/run';
    let params = '_token='+LA.token;
    http.open('POST', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            let result = JSON.parse(http.responseText);
            if(result.status == true){
                document.querySelector('pre[class="output-body"]').innerHTML = result.message;
            } else {
                document.querySelector('pre[class="output-body"]').innerHTML = result.message + " There has been a problem";
            }
            NProgress.done();
        }
    }
    http.send(params);
}

function deleteBackup(file, fqpath){
    NProgress.start();
    let http = new XMLHttpRequest(fqpath);
    let url = '/admin/backup/delete';
    let params = 'disk=local&file='+fqpath+'&_token='+LA.token;
    http.open('DELETE', url, true);

    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.onreadystatechange = function() {//Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) {
            let result = JSON.parse(http.responseText);
            if(result.status == true){
                document.getElementById(file).innerHTML = '';
                Swal.fire({
                    icon: 'success',
                    title: 'Successful',
                    'text': result.message,
                    onClose: () => {
                        window.location.reload()
                    }})
            } else {
                Swal.fire({icon: 'error', title: 'Error', 'text': result.message})
            }
            NProgress.done();
        }
    }
    http.send(params);
}

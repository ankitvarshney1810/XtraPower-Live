<?php include "header.php";  ?>

<?php
$headline = isset($_REQUEST['headline']) ? trim($_REQUEST['headline']) : '';
$linkText = isset($_REQUEST['link-text']) ? trim($_REQUEST['link-text']) : '';
$linkUrl = isset($_REQUEST['link-url']) ? trim($_REQUEST['link-url']) : '';
$newsId = isset($_REQUEST['newsId']) ? trim($_REQUEST['newsId']) : '0';
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : '0';
if(!empty($headline)) {
    insertNewsEvents(htmlentities($headline), htmlentities($linkText), $linkUrl, $newsId);
}
if('status' == $action) {
    updateNewsEventStatus($newsId);
}
$news = fetchAllNewsEvents();
// print_r($news);
?>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.24/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.bootstrap4.min.css">

    <div class="container mt-3">
        <h2>News And Events</h2>
        <form action="" method="post">
            <input type="hidden" id="newsId" name="newsId" value="0">
        <div class="row mt-3">
            <div class="col-sm-12">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Headline</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" id="headline" name="headline">
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-sm-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Link Text</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" id="link-text" name="link-text">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Link Url</span>
                    </div>
                    <input type="text" class="form-control" placeholder="" id="link-url" name="link-url">
                </div>  
            </div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
        </form>
    </div>


    <div class="container mt-5">
        
        <div class="row mt-3">
            <div class="col-sm-12">
                <table id="example" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Headline</th>
                            <th>Link Text</th>
                            <th>Link Url</th>
                            <th style="width: 140px!important">Insertion/Update Time</th>
                            <th style="width: 150px!important">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($news as $item) { ?>
                        <tr id="<?=$item->id ?>">
                            <td><?=$item->id ?></td>
                            <td><?=$item->headline ?></td>
                            <td><?=$item->linkText ?></td>
                            <td><?=$item->linkUrl ?></td>
                            <td><?=$item->insertionTime .' / '. $item->updationTime ?></td>
                            <td><button type="button" class="btn btn-secondary" onclick="editNews(<?=$item->id ?>)">Edit</button> <button type="button" class="btn <?=$item->status == 1 ? 'btn-danger' : 'btn-success' ?>" onclick="changeStatus(<?=$item->id ?>)"><?=$item->status == 1 ? 'Deactivate' : 'Activate' ?></button></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();
        });
        if (window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
        function editNews(id) {
            var tr = $('#'+id);
            $('#newsId').val($(tr.find('td')[0]).html());
            $('#headline').val($(tr.find('td')[1]).html());
            $('#link-text').val($(tr.find('td')[2]).html());
            $('#link-url').val($(tr.find('td')[3]).html());
            $("html, body").animate({scrollTop: 0}, 1000);
        }
        function changeStatus(newsId) {
            $('<form action="" method="post"><input type="hidden" name="action" value="status"><input type="hidden" name="newsId" value="'+newsId+'"></form>').appendTo('body').submit();
        }
    </script>
    
<?php include "footer.php";  ?>
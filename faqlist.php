<?php include "header.php";  ?>

    <section class="supportArticle">
        <div class="container pt-5">
            <ul class="site-path">
                <li class="path">
                    <a href="<?=WEB_URL?>help-center.php"><i class="lni lni-chevron-left"></i>Help Center</a>
                </li>
                <li class="path active">
                    <span class="categoryName">XTRAPOWER</span>
                </li>
            </ul>
            <h3 class="font-weight-bold mb-5 categoryName">XTRAPOWER</h3>
            <div class="faq-list" id="accordionExample">
                
            </div>
        </div>
    </section>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?=WEB_URL?>assets/js/support-article.js?filever=<?=filesize('assets/js/support-article.js')?>"></script>
<script>
    $(document).ready(function(){
        find_questions_based_on_category(<?=$_REQUEST['category']?>, <?=$_REQUEST['question']?>);
    });
</script>

<?php include "footer.php";  ?>


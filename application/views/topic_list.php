<div class="span2">
    <ul class="nav nav-tabs nav-stacked">
    <?php
    foreach($topics as $entry){
    ?>
        <li><a href="/topic/get/<?=$entry->id?>"><?=$entry->title?></a></li>
    <?
    }
    ?>
    </ul>
</div>
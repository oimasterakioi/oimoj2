<script>
    var header = document.createElement('h4');
    header.className = 'ui block top attached header';
    header.innerHTML = '<?php echo changeToVue($header) ?>';
    var content = document.createElement('div');
    content.className = 'ui bottom attached segment markdown markdown-body';
    content.innerHTML = '<?php echo changeToVue($content) ?>';
    <?php if($id != ""): ?>
        content.id = '<?php echo $id ?>';
    <?php endif ?>
    
    $('#<?php echo $direction; ?>Col').append(header);
    $('#<?php echo $direction; ?>Col').append(content);
</script>

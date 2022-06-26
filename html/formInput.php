<script>
    var input = document.createElement('input');
    input.type = '<?php echo $type; ?>';
    input.name = '<?php echo $name; ?>';
    input.placeholder = '<?php echo $placeholder; ?>';
    input.required = true;

    var div = document.createElement('div');
    div.className = 'field';
    div.appendChild(input);

    var tmp = $('button.ui.button.primary.fluid');
    tmp.remove();
    $('.segment').append(div);
    $('.segment').append(tmp);
</script>

<script>
    var header = document.createElement('h4');
    header.className = 'ui block top attached header';
    header.innerHTML = '<?php echo changeToVue("提交") ?>';
    
    var input = document.createElement('input');
    input.type = 'file';
    // input.className = 'ui input';
    input.id = 'code';

    var button = document.createElement('button');
    button.className = 'ui button fluid';
    button.innerHTML = '<?php echo changeToVue("提交") ?>';
    button.id = "submitButton";
    button.style = 'margin-top: 10px;';

    var inputBox = document.createElement('div');
    inputBox.className = 'ui input';
    inputBox.appendChild(input);
    
    var content = document.createElement('div');
    content.className = 'ui bottom attached segment';
    content.appendChild(inputBox);
    content.appendChild(button);
    
    $('#rightCol').append(header);
    $('#rightCol').append(content);

    $(function(){
        console.log($('#submitButton'));
        $('#submitButton').click(function(){
            // post #code file to api/submitProblem.php
            console.log('submit');
            var file = $('#code')[0].files[0];
            console.log(file);
            var formData = new FormData();
            formData.append('code', file);
            formData.append('problem_id', <?php echo $problem_id; ?>);
            <?php if($contest_id != ""): ?>
            formData.append('contest_id', <?php echo $contest_id; ?>);
            <?php endif; ?>
            console.log(formData);
            $.ajax({
                url: '/api/submitProblem.php',
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(data){
                    data = JSON.parse(data);
                    if(data.success == "ok"){
                        alert('提交成功');
                    }
                    else{
                        alert('提交失败');
                    }
                }
            });
        });
    });
</script>

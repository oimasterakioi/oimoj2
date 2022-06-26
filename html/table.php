<script>
    var thead = document.createElement('thead');
    var tbody = document.createElement('tbody');
    var table = document.createElement('table');

    <?php
    // random tr
    $trname = getRandStr(rand(3, 30));
    echo "var $trname = document.createElement('tr');\n";
    foreach($columns as $column=>$value){
        // random name
        $varname = getRandStr(rand(3, 30));
        echo "var $varname = document.createElement('th');\n";
        echo "$varname.innerHTML = '".changeToVue($value)."';\n";
        if($column == $mainAlign){
            echo "$varname.className = 'left aligned';\n";
        }
        else{
            echo "$varname.className = 'two wide';\n";
        }
        echo "$trname.appendChild($varname);\n";
    }
    echo "thead.appendChild($trname);\n";
    ?>
    table.appendChild(thead);

    <?php
    foreach($rows as $row){
        echo "$trname = document.createElement('tr');\n";
        foreach($columns as $column=>$value){
            echo "$varname = document.createElement('td');\n";
            echo "$varname.innerHTML = '".$row[$column]."';\n";
            if($column == $mainAlign){
                echo "$varname.className = 'left aligned';\n";
            }
            else{
                echo "$varname.className = 'two wide';\n";
            }
            echo "$trname.appendChild($varname);\n";
        }
        echo "tbody.appendChild($trname);\n";
    }
    ?>

    table.appendChild(tbody);
    table.className = 'ui table segment';

    $('#<?php echo $direction; ?>Col').append(table);
</script>

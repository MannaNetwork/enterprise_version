<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
<script type="text/javascript">
    $(document).ready(function(){
        $("select#category").change(function(){
            var id = $("select#category option:selected").attr('value');
            $.post("select_type.php?event=type", {id:id}, function(data){
                $("select#type").html(data);
            });
        });

        $("select#type").change(function(){
            var id = $("select#type option:selected").attr('value');
            $.post("select_type.php?event=third_table", {id:id}, function(data){
                $("select#third_table").html(data);
            });
        });

    });
</script>
    </head>
    <body>

    <?php 
    include("select_list_class.php");
 switch ($_GET['event']) {
        case 'third_table':
                echo $opt->ShowThird();
            break;

        default:
                echo $opt->ShowType();
            break;
    }
    ?>


    <form id="select_form">
        Choose a category:<br />
        <select id="category">
            <?php 
            echo $opt->ShowCategory(); 
            ?>
        </select>
        <br /><br />

        choose a type:<br />
        <select id="type">
            <option value="0">choose...</option>
        </select>
        <br /><br />

        choose third drop down: <br />
        <select id="third_table">
             <option value="0">choose...</option>
        </select>
        <br /><br />  

            <input type="submit" value="confirm" />
        </form>
        <div id="result"></div>
    </body>
</html>

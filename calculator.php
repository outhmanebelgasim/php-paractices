<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <input type="number" name="num01" placeholder="Number one" required>
        <select name="operator" id="" required>
            <option value="add">+</option>
            <option value="substract">-</option>
            <option value="multiply">*</option>
            <option value="divide">/</option>
        </select>
        <input type="number" name="num02" placeholder="Number two" required>
        <button>Calculate</button>
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $num1 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
            $num2 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST["operator"]);

            $errors = false;

            if(empty($num1) || empty($num2) || empty($operator)){
                echo "<p class='calc-error'> Fill in all fields!</p>";
                $errors = true;
            }
            if(!is_numeric($num1) || !is_numeric($num2)){
                echo "<p class='calc-error'> Only write numbers!</p>";
                $errors = true;
            }

            if(!$errors){
                $result = 0;
                switch($operator){
                    case "add" : $result = $num1 + $num2;
                        break;
                    case "substract" : $result = $num1 - $num2;
                        break;
                    case "multiply" : $result = $num1 * $num2;
                        break;
                    case "divide" : $result = $num1 / $num2;
                        break;
                    default:
                        echo "<p class='calc-error'> Something went wrong!</p>";
                }
            }

            echo "<p class='calc-result'> Result = " . $result . "</p>";
        }
    ?>
</body>
</html>
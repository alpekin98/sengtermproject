<?php 
include 'header.php';

if($sUsername == null){
    echo"<script>
    window.location.replace('index.php')
    </script>";
}
?>

<body>
<div class="page-container">
    <div class="container">
        <div class="row">
            <form action="addidea.php" method="post" name="QuestionForm" id="QuestionForm" enctype="multipart/form-data" novalidate>
                <div class="span8 page-content">
                    <div class="row separator">
                        <section class="span8 articles-list">
                            <div class="my-3 p-3 rounded box-shadow">
                                <div class="title">
                                    <h3>Add a new IDEA!</h3>
                                    <div class="form-group">
                                        <label for="QuestionTitle">IDEA Title</label>
                                        <input type="text" class="form-control" id="QuestionTitle" name="QuestionTitle" maxlength="75" placeholder="What is your question about?">
                                    </div>
                                </div>
                                <textarea name="QuestionDesc" id="QuestionDesc" required="required" rows="10" cols="70"></textarea><br>
                                <button type="submit" class="btn btn-primary" name="QuestionSubmit" id="QuestionSubmit">Submit</button>                                    
                            </div>
                        </section>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php

$qAuthor = $_SESSION["user_UserID"];

if  (
    isset($_POST['QuestionSubmit']) &&
    isset($_POST['QuestionTitle']) &&
    $_POST['QuestionTitle'] != '' &&
    $_POST['QuestionDesc'] != '' &&
    isset($_POST['QuestionDesc'])
    ) 
{ 
    $qTitle = htmlspecialchars(addslashes($_POST['QuestionTitle']));
    $qDescription = addslashes($_POST['QuestionDesc']);
    $qAuthor = $_SESSION["user_UserID"];
    
    $prepareData = $conn->prepare("INSERT INTO ideas(idea_title,idea_description,idea_author) VALUES ('$qTitle','$qDescription','$qAuthor');");
    $prepareData->execute();

    echo '<script>window.location.replace("index.php");</script>';
    
}
?>
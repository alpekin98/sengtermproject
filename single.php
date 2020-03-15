<?php include "header.php";?>
<body>
    <div class="page-container">
        <div class="container">
            <div class="row">
                <div class="span8 page-content">
                    <div class="row separator">
                        <section class="span8 articles-list">
                            <div class="span8 page-content">
                                <?php
                                    if (isset($_GET['post'])) {
                                        $slug = $_GET['post'];
                                    }
                                    $getQuestion = $conn->query("SELECT * FROM ideas WHERE idea_id='$slug'", PDO::FETCH_ASSOC)->fetch();
                                    $q_id = $getQuestion["idea_id"];
                                    $q_title = $getQuestion["idea_title"];
                                    $q_description = $getQuestion["idea_description"];
                                    $q_author_id = $getQuestion['idea_author'];
                                    $q_date = $getQuestion['idea_date'];
                                    $q_score = $getQuestion["idea_like"]-$getQuestion["idea_dislike"];

                                    $s = $conn->query("UPDATE ideas SET idea_view = idea_view + 1 WHERE idea_id = $slug");

                                    $getAuthor = $conn->query("SELECT * FROM users WHERE user_id='$q_author_id'", PDO::FETCH_ASSOC)->fetch();

                                    if(isset($_SESSION['user_UserID'])){
                                        $user_id = $_SESSION['user_UserID'];
                                        $myQuery="SELECT * FROM like_data WHERE user_id = '$user_id' AND q_id ='$q_id'";
                                        $s = $conn->prepare($myQuery);
                                        $s->execute();
                                        $checkLikeData = $s->rowCount();
                                    }else{
                                        $checkLikeData = 1;
                                    }
                                    
                                ?>
                                <div class ="container">
                                    <article class=" type-post format-standard hentry clearfix">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <h1 class="post-title"><a href="#"><?php echo $q_title; ?></a></h1>
                                        </div>
                                    </div>
                                </div>    
                                    <div class="card bg-light post">
                                        <div class="post-heading">
                                            <div class="float-left image">
                                                <img src="<?php echo $getAuthor["image_link"]?>" height="60" weight="60" class="img-circle avatar" alt="user profile image">
                                            </div>
                                            <div class="float-left meta col-sm-4">
                                                <div class="post-comment">
                                                    <a href='<?php echo "author.php?author=".$getAuthor['username'].""; ?>'>
                                                        <b><?php echo $getAuthor['username']; ?></b></a>
                                                </div>
                                                <h6 class="time-ago">Asked on, <?php echo $q_date; ?></h6>
                                            </div>
                                                <button type="button" class="btn btn-success btn-circle btn-lg" id="btnLike"><i class="fa fa-check"></i></button>
                                                <button type="button" class="btn btn-danger btn-circle btn-lg" id="btnDislike"><i class="fa fa-times"></i></button>
                                                <button type="button" class="btn btn-dark btn-circle btn-lg" id="score"></i><span id="questionScore" class="totalScore" data-value="<?php echo $q_score; ?>"><?php echo $q_score; ?></span></button>
                                        </div>
                                        <br>
                                        <hr>  
                                        <div class="post-heading">
                                            <div class="post-description">
                                            <p>
                                            <?php echo $q_description; ?>
                                            </p>
                                        </div></div>
                                    </div>
                                </article>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

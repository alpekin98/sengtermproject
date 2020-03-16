<?php
include 'header.php';
?>
<div class="page-container">
    <div class="container">
        <div class="row">
            <div class="span8 page-content">
                <div class="row separator">
                    <div class="span8 page-content">
                        <div class="row separator">
                            <section class="span8 articles-list">
                                <h3>All Ideas</h3>
                                <?php
                                    $limit = 7;
                                    $query = "SELECT * FROM ideas";
                                    $s = $conn->prepare($query);
                                    $s->execute();
                                    $total_results = $s->rowCount();
                                    $total_pages = ceil($total_results/$limit);
                                    if (!isset($_GET['page'])) {
                                        $page = 1;
                                    } else{
                                        $page = $_GET['page'];
                                    }
                                    $starting_limit = ($page-1)*$limit;
                                    $show = "SELECT * FROM ideas ORDER BY idea_id DESC LIMIT $starting_limit, $limit";
                                    $r = $conn->prepare($show);
                                    $r->execute();
                                    while($res = $r->fetch(PDO::FETCH_ASSOC)) :
                                        $q_author = $res['idea_author'];
                                        $q_title = $res['idea_title'];
                                        $q_id = $res['idea_id'];
                                        $origin_q_date = $res['q_date'];
                                        $q_score = $res['q_like'] - $res['q_dislike'];
                                        $newDate = date("d m Y", strtotime($origin_q_date));
                                        $user = $conn->query("SELECT user_id, username, idea_author FROM users,ideas WHERE user_id='$q_author'",PDO::FETCH_ASSOC)->fetch();
                                        $user_id = $user['user_id'];
                                        $username = $user['username'];
                                ?>
                                <div class="forum-item">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <div class="forum-icon"> <i class="fa fa-bolt"></i></div> <a href="<?php echo "single.php?post=$q_id"; ?>" class="forum-item-title"><?php echo $q_title; ?></a>
                                            <div class="forum-sub-title"><a href="<?php echo "author.php?author=$username"; ?>"><?php echo $username; ?></a> posted a post.</div>
                                        </div>
                                        <div class="col-md-1 forum-info"> <span class="views-number"> <?php echo $res['idea_view'] ?> </span>
                                            <div> <small>Views</small></div>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile; ?>
                            </section>
                        </div>
                        <div class="index-paging">
                        <?php  for ($i=1; $i <= $total_pages ; $i++):?>
                        <?php if($page == $i ){ ?>
                        <a href='<?php echo "?page=$i"; ?>' class="active"><?php echo $i; ?></a>
                        <?php } else { ?>
                        <a href='<?php echo "?page=$i"; ?>'><?php echo $i; ?></a>
                        <?php } ?>
                        <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<h1 class ="center"> <?php echo htmlspecialchars_decode($page["slug"]); ?></h1>

<section> <?php echo htmlspecialchars_decode($page["content"]); ?> </section>


<?php foreach($articles as $article){ ?>

    <div class="article">
        <div class="center"><h2><?php echo $article['title']; ?></h2>
        <?php echo htmlspecialchars_decode($article['content']); ?><a href="/single-post?id=<?php echo $article['id'];?>">Read more...</a>
        </div>

    </div>

<?php } ?> 

<!DOCTYPE html>
<html>
<head>
  <title>Test Project</title>
  <link rel="stylesheet" href="resources/assets/styles.css">
</head>
<body>
    <main>
        <section class="topnav">
            <div>
                <h1>List of authors and books</h1>
                <div class="search-container">
                <form action="/action_page.php">
                    <input type="text" placeholder="Search.." name="search">
                    <button type="submit">Submit</button>
                </form>
            </div>
        </section>
        <section>
            <div class="content-wrapper">
            <?php
                    require 'src/Factories/AuthorFactory.php';
                    require 'src/Database/PgSqlConnection.php';
                    use Bookstore\Factories\AuthorFactory;
                    use Bookstore\Database\PgSqlConnection;

                    $db = PgSqlConnection::getInstance();
                    $author = new AuthorFactory($db);
                    $data = $author->getAuthorsAndBooks();

                    if ($data) {
                        foreach($data as $res) {
                    ?>
                    <div class="row fade-item">
                        <div class="column"><?php echo $res['author']; ?></div>
                        <div class="column"><?php echo $res['book']; ?></div>
                    </div>
                    <?php
                        }
                    } else {
                    ?>
                    <div class="row fade-item">
                        <p>No results found!</p>
                    </div>
                    <?php
                    }
                ?>
            </div>
        </section>
    </main>
</body>
<script type="text/javascript">
    var items = document.getElementsByClassName("fade-item");
		for (let i = 0; i < items.length; ++i) {
      fadeIn(items[i], i * 1000)
    }
    function fadeIn (item, delay) {
      setTimeout(() => {
        item.classList.add('fadein')
      }, delay)
    }
</script>
</html>




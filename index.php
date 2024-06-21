<!DOCTYPE html>
<html lang="zh">
<head>
<meta charset="UTF-8">
<title>小趣社区网页预览</title>
<style>
    body { font-family: Arial, sans-serif; background-color: #f4f4f4; }
    .container { width: 80%; margin: 20px auto; }
    .post { background-color: #fff; border-radius: 8px; overflow: hidden; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
    .post-header { background-color: #007bff; color: #fff; padding: 10px 15px; }
    .post-content { padding: 15px; }
    .post-footer { background-color: #f9f9f9; padding: 10px 15px; display: flex; justify-content: space-between; }
    .post-footer div { font-size: 0.9em; color: #666; }
    .highlight { color: #007bff; }
</style>
</head>
<body>
<div style="background-image: url('bg.jpg');">
<div class="container">
    <h1>小趣社区网页预览</h1>
    <h2><a href="https://xiaoqu.tonycola.online/beta.php">点我参与beta测试</a>（更新至：评论预览）
    <br>Beta版可能包含不稳定的功能，请尽量使用正式版</h2>
    <?php
    // 小趣网址
    $url = 'http://app.xiaoqu.icu/aceshi.php?admin=2014406795&start=1&end=500000';

    // 获取网页内容
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $content = curl_exec($ch);
    curl_close($ch);

    // 检查是否获取到内容
    if ($content === false) {
        echo "<p>阿嘞？啥也没有？！？！是不是网站挂了？请联系Tonycola</p>";
    } else {
        // 匹配内容
        preg_match_all('/<(\d+)-\/-(\d+)-\/\/-(.+?)-\/\/\/-(.+?) 機型：(.*?)｜(.*?)【用戶:(.*?)】(.*?)\[地区：(.*?)\]-\/\/\/\/-(.+?)>/s', $content, $matches);

        foreach ($matches[1] as $index => $item) {
            echo "<div class='post'>";
            echo "<div class='post-header'>" . htmlspecialchars($matches[6][$index]) . "</div>";
            echo "<div class='post-content'><strong class='highlight'>标题：</strong>" . htmlspecialchars($matches[3][$index]) . "<br><strong class='highlight'>正文：</strong>" . htmlspecialchars($matches[4][$index]) . "</div>";
            echo "<div class='post-footer'>";
            echo "<div><strong class='highlight'>设备：</strong>" . htmlspecialchars($matches[5][$index]) . "</div>";
            echo "<div><strong class='highlight'>用户名：</strong>" . htmlspecialchars($matches[7][$index]) . "</div>";
            echo "<div><strong class='highlight'>IP属地：</strong>" . htmlspecialchars($matches[9][$index]) . "</div>";
            echo "<div><strong class='highlight'>发布日期：</strong>" . htmlspecialchars($matches[10][$index]) . "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
    ?>
</div>
<script>
    // 弱智动态效果
    document.addEventListener('DOMContentLoaded', (event) => {
        const posts = document.querySelectorAll('.post');
        posts.forEach((post, index) => {
            setTimeout(() => {
                post.style.transform = 'translateY(0)';
                post.style.opacity = 1;
            }, 100 * index);
        });
    });
</script>
</body>
</html>

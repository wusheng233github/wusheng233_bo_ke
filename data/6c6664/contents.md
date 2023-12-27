# 主题设置指南
## 如果您是站长，想为网站设置主题
从[https://bootswatch.com/](https://bootswatch.com/)下载你需要的css文件，并打开css文件夹覆盖原来的文件。
## 如果你是文章作者，想为文章页面设置主题
请在页面添加这个，并替换"这里粘贴你的Bootswatch CSS，Bootstrap v5.3"为你的Bootswatch CSS链接(Bootstrap v5.3)。把awa替换为script
## 小心！你的文章需要很多字之后才能添加！而且需要在末尾！
```
<awa>
document.getElementById("style").href = '这里粘贴你的Bootswatch CSS，Bootstrap v5.3';
</awa>
```
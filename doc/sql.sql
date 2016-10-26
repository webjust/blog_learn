-- 创建一个数据库 blog
CREATE DATABASE blog;

-- 选库
USE blog;

-- 建表article
CREATE TABLE article(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(100) NOT NULL,
	author VARCHAR(20) NOT NULL,
	description VARCHAR(255) NOT NULL,
	content TEXT NOT NULL,
	add_date VARCHAR(10) NOT NULL DEFAULT "200000000"
)ENGINE=InnoDB DEFAULT CHARSET=UTF8;

-- 插入(多条)测试数据
INSERT INTO article (title, author, description, content, add_date) VALUES
('文章标题1', '作者1', '短描述1', '文章内容1', UNIX_TIMESTAMP()),
('文章标题2', '作者2', '短描述2', '文章内容2', UNIX_TIMESTAMP()),
('文章标题3', '作者3', '短描述3', '文章内容3', UNIX_TIMESTAMP()),
('文章标题4', '作者4', '短描述4', '文章内容4', UNIX_TIMESTAMP()),
('文章标题5', '作者5', '短描述5', '文章内容5', UNIX_TIMESTAMP()),
('文章标题6', '作者6', '短描述6', '文章内容6', UNIX_TIMESTAMP()),
('文章标题7', '作者7', '短描述7', '文章内容7', UNIX_TIMESTAMP()),
('文章标题8', '作者8', '短描述8', '文章内容8', UNIX_TIMESTAMP()),
('文章标题9', '作者9', '短描述9', '文章内容9', UNIX_TIMESTAMP());
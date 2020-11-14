
-- 创建菜单表
create table cait_menu(
	mname varchar(10) primary key not null,
	mhref varchar(30) not null,
	mtip varchar(100) not null,
	mte varchar(5) not null,
	mstu varchar(5) not null
);
-- 添加菜单记录
insert into cait_menu
	(mname,mhref,mtip,mstu,mte)
	values
	('教师成绩录入','tScoreIn.php','任课教师在本页面录入各个班级某课程的成绩','有','无'),
	('教学任务查询','tTask.php','教师或学生在本页面查询课程的人可见教师及课程信息','有','有'),
	('学生成绩查询','sScoreSearch.php','教师或学生在本页面查询某门课程的成绩','有','有'),
	('用户设置','user.php','任课教师在本页面修改自己的密码','有','有'),
	('注销','logout.php','注销','有','有'),
	('上传头像','portrait.php','注销','有','有');

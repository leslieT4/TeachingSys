-- 创建数据库
create database cait_school;

-- 调用数据库
use cait_school;

-- 系表部
create table cait_dep(
	depname varchar(20) primary key not null
);
-- 专业表
create table cait_major(
	majorname varchar(30) primary key not null,
	majorlength int(1) not null,
	depname varchar(20) not null,
	foreign key(depname) references cait_dep(depname)
	on update cascade
	on delete cascade
);
-- 班级表
create table cait_class(
	stuclass varchar(30) primary key not null,
	stuyear int(4) not null,
	majorname varchar(30) not null,
	foreign key(majorname) references cait_major(majorname)
	on update cascade
	on delete cascade
);
-- 学生表
create table cait_stu(
	stuid bigint(10) primary key not null,
	stuname varchar(20) not null,
	stupa char(32),
	stuclass varchar(30) not null,
	foreign key(stuclass) references cait_class(stuclass)
	on update cascade
	on delete cascade
);
-- 5组  增加字段stupic，保存用户的头像信息
alter table cait_stu add stupic char(41) default "stu.png";
-- 老师表
create table cait_te(
	teid bigint(10) primary key not null,
	tename varchar(20) not null,
	tepa char(32),
	depname varchar(20) not null,
	foreign key(depname) references cait_dep(depname)
	on update cascade
	on delete cascade
);
-- 5组  增加字段tepic，保存用户的头像信息
alter table cait_te add tepic char(41) default "te.png";
-- 课程表
create table cait_course(
	cid int auto_increment primary key not null,
	ccode int(8) not null,
	cname varchar(40) not null,
	cgrade int(4) not null,
	majorname varchar(30) not null,
	cterm int(2) not null,
	cpoint float(2,1) not null,
	cweekh float(2,1) not null,
	cweek char(5) not null,
	ctotalh float(3,1) not null,
	ctype char(10) not null,
	cexam varchar(10) not null,
	foreign key (majorname) references cait_major(majorname)
	on update cascade
	on delete cascade
);
-- 任务表
create table cait_task(
	taskid int auto_increment primary key not null,
	teid bigint(10) not null,
	cid int not null,
	stuclass varchar(30) not null,
	taskterm int(6) not null,
	tasktime varchar(30) not null,
	taskroom varchar(50) not null,
	foreign key(teid) references cait_te(teid)
	on update cascade
	on delete cascade,
	foreign key(cid) references cait_course(cid)
	on update cascade
	on delete cascade,
	foreign key(stuclass) references cait_class(stuclass)
	on update cascade
	on delete cascade
);
-- 成绩表
create table cait_score(
	scid int auto_increment primary key not null,
	taskid int not null,
	stuid bigint(10) not null,
	scnormal float(3,1),
	sclab float(3,1),
	scmidterm float(3,1),
	scfinal int(3),
	scoverall int(3),
	scmakeup int(3),
	scagain int(3),
	foreign key(taskid) references cait_task(taskid)
	on update cascade
	on delete cascade,
	foreign key(stuid) references cait_stu(stuid)
	on update cascade
	on delete cascade
);
-- 创建一个前台用户查询+插入+更新的前台用户
grant select,insert,update
	on cait_school.*
	to 'cait02'@'localhost'
	identified by "87654321";
-- 创建一个后台用户查询+插入+更新+删除的后台用户
grant select,insert,update,delete
	on cait_school.*
	to 'cait'@'localhost'
	identified by "123456";

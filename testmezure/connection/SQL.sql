CREATE SCHEMA testmezure;

CREATE  TABLE folder ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	name                 VARCHAR(100)       ,
	wid                  INT       ,
	cuid                 INT       ,
	cuemail              VARCHAR(100)       
 );

CREATE  TABLE inquiry ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	`fullName`           VARCHAR(100)       ,
	email                VARCHAR(100)       ,
	subject              VARCHAR(500)       ,
	message              VARCHAR(10000)       
 );

CREATE  TABLE qanswer ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	qid                  INT       ,
	ruid                 INT       ,
	ruemail              VARCHAR(100)       ,
	answer               TEXT       
 );

CREATE  TABLE quection ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	uid                  VARCHAR(100)       ,
	uemail               VARCHAR(100)       ,
	quection             TEXT       ,
	`status`             INT   DEFAULT ('0')    
 );

CREATE  TABLE testautomation ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	fid                  INT       ,
	wid                  INT       ,
	cuid                 INT       ,
	testcase             TEXT       ,
	version              VARCHAR(50)       
 );

CREATE  TABLE testcase ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	fid                  INT       ,
	wid                  INT       ,
	cuid                 INT       ,
	testcase             TEXT       ,
	version              VARCHAR(50)       
 );

CREATE  TABLE testcycle ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	name                 VARCHAR(100)       ,
	wid                  INT       ,
	cuid                 INT       ,
	cuemail              VARCHAR(100)       
 );

CREATE  TABLE testcycletestcase ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	fid                  INT       ,
	wid                  INT       ,
	tcaid                INT       ,
	tcyid                INT       ,
	cuid                 INT       ,
	testcase             TEXT       ,
	`status`             TEXT       
 );

CREATE  TABLE testdesign ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	fid                  INT       ,
	wid                  INT       ,
	cuid                 INT       ,
	testcase             TEXT       ,
	version              VARCHAR(50)       
 ) ;

CREATE  TABLE testother ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	fid                  INT       ,
	wid                  INT       ,
	cuid                 INT       ,
	testcase             TEXT       ,
	version              VARCHAR(50)       
 );

CREATE  TABLE users ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	email                VARCHAR(100)       ,
	password             VARCHAR(100)       ,
	usertype             VARCHAR(50)       
 ) ;

CREATE  TABLE workspace ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	name                 VARCHAR(100)       ,
	email                VARCHAR(100)       ,
	usertype             VARCHAR(50)       
 );

CREATE  TABLE workspaceusers ( 
	id                   INT  NOT NULL   AUTO_INCREMENT  PRIMARY KEY,
	wid                  INT       ,
	wname                VARCHAR(100)       ,
	uid                  INT       ,
	email                VARCHAR(100)       ,
	`isAdmin`            INT       
 );

INSERT INTO folder( id, name, wid, cuid, cuemail ) VALUES ( 12, 'BackEnd Test', 5, 1, 'supun@gmail.com');
INSERT INTO folder( id, name, wid, cuid, cuemail ) VALUES ( 13, 'Full Test', 5, 1, 'supun@gmail.com');
INSERT INTO folder( id, name, wid, cuid, cuemail ) VALUES ( 14, 'X', 5, 3, 'ss1@gmail.com');
INSERT INTO inquiry( id, `fullName`, email, subject, message ) VALUES ( 5, 'John Smith', 'jh@gmail.com', 'Test ', 'this is test description');
INSERT INTO qanswer( id, qid, ruid, ruemail, answer ) VALUES ( 7, 14, 3, 'ss1@gmail.com', '<p>This is test <strong>answer</strong></p>');
INSERT INTO qanswer( id, qid, ruid, ruemail, answer ) VALUES ( 8, 14, 1, 'supun@gmail.com', '<p>Reply 02</p>');
INSERT INTO quection( id, uid, uemail, quection, `status` ) VALUES ( 14, '1', 'supun@gmail.com', '<p>What is TestMezure ?</p>', 1);
INSERT INTO testautomation( id, fid, wid, cuid, testcase, version ) VALUES ( 4, 12, 5, 1, '<p>Auth function test</p>', 'V1.0');
INSERT INTO testautomation( id, fid, wid, cuid, testcase, version ) VALUES ( 6, 13, 5, 1, '<p>Full Test&nbsp;</p>', 'V1.5');
INSERT INTO testcase( id, fid, wid, cuid, testcase, version ) VALUES ( 14, 12, 5, 1, '<p>Login function Test updated</p>', 'V1.1');
INSERT INTO testcase( id, fid, wid, cuid, testcase, version ) VALUES ( 15, 12, 5, 1, '<p>Register function test</p>', 'V1.0');
INSERT INTO testcase( id, fid, wid, cuid, testcase, version ) VALUES ( 16, 13, 5, 1, '<p>Full Test&nbsp;</p>', 'V1.5');
INSERT INTO testcase( id, fid, wid, cuid, testcase, version ) VALUES ( 17, 14, 5, 3, '<p>Write Your Test Cases Here &amp; Add to Folder</p>', 'V1.5');
INSERT INTO testcycle( id, name, wid, cuid, cuemail ) VALUES ( 7, 'Cycle 01 updated', 5, 1, 'supun@gmail.com');
INSERT INTO testcycle( id, name, wid, cuid, cuemail ) VALUES ( 8, 'Cycle 02', 5, 1, 'supun@gmail.com');
INSERT INTO testcycletestcase( id, fid, wid, tcaid, tcyid, cuid, testcase, `status` ) VALUES ( 11, null, 5, 14, 7, 1, '<p>Login function Test updated</p>', 'Pass');
INSERT INTO testcycletestcase( id, fid, wid, tcaid, tcyid, cuid, testcase, `status` ) VALUES ( 12, null, 5, 16, 7, 1, '<p>Full Test&nbsp;</p>', '<p>Attached</p>');
INSERT INTO testcycletestcase( id, fid, wid, tcaid, tcyid, cuid, testcase, `status` ) VALUES ( 13, null, 5, 15, 8, 1, '<p>Register function test</p>', null);
INSERT INTO testdesign( id, fid, wid, cuid, testcase, version ) VALUES ( 6, 12, 5, 1, '<p>Login UI test</p>', 'V1.0');
INSERT INTO testdesign( id, fid, wid, cuid, testcase, version ) VALUES ( 7, 13, 5, 1, '<p>Full Test&nbsp;</p>', 'V1.5');
INSERT INTO testother( id, fid, wid, cuid, testcase, version ) VALUES ( 5, 12, 5, 1, '<p>Other Test</p>', 'V1.0');
INSERT INTO testother( id, fid, wid, cuid, testcase, version ) VALUES ( 6, 13, 5, 1, '<p>Full Test&nbsp;</p>', 'V1.5');
INSERT INTO users( id, email, password, usertype ) VALUES ( 1, 'supun@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', null);
INSERT INTO users( id, email, password, usertype ) VALUES ( 2, 'sanjeewa@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', null);
INSERT INTO users( id, email, password, usertype ) VALUES ( 3, 'ss1@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', null);
INSERT INTO users( id, email, password, usertype ) VALUES ( 4, 'ss2@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', null);
INSERT INTO users( id, email, password, usertype ) VALUES ( 5, 'ss3@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', null);
INSERT INTO users( id, email, password, usertype ) VALUES ( 6, 'ss4@gmail.com', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', null);
INSERT INTO users( id, email, password, usertype ) VALUES ( 7, 'admin', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', '1');
INSERT INTO workspace( id, name, email, usertype ) VALUES ( 5, 'FreelancerHub', 'supun@gmail.com', 'freelancer');
INSERT INTO workspaceusers( id, wid, wname, uid, email, `isAdmin` ) VALUES ( 8, 5, 'FreelancerHub', 1, 'supun@gmail.com', 1);
INSERT INTO workspaceusers( id, wid, wname, uid, email, `isAdmin` ) VALUES ( 9, 5, 'FreelancerHub', 3, 'ss1@gmail.com', 0);
INSERT INTO workspaceusers( id, wid, wname, uid, email, `isAdmin` ) VALUES ( 10, 5, 'FreelancerHub', 4, 'ss2@gmail.com', 0);


create table teachqa(id int auto_increment primary key,
teach text
);





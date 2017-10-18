CREATE database synced_watch;
use synced_watch;
CREATE TABLE timer_on (
  `id` INT NOT NULL  AUTO_INCREMENT,
  `title` varchar(30) not null,
  `started` INT(1) not null default 0,
  `start_time` INT(10) not null default 0,
  PRIMARY KEY (id)
);

insert into timer_on(title,started, start_time) values ('main',0,0);
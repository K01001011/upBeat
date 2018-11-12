 show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| music              |
| test               |
+--------------------+
3 rows in set (0.00 sec)

use music

create table Artist (Name varchar(50) primary key, Picture varchar(20),  Genre varchar(20), Band varchar(50), foreign key(Band) references Artist(Name) ON DELETE 
CASCADE ON UPDATE CASCADE);

 desc Artist;
+---------+-------------+------+-----+---------+-------+
| Field   | Type        | Null | Key | Default | Extra |
+---------+-------------+------+-----+---------+-------+
| Name    | varchar(50) | NO   | PRI | NULL    |       |
| Picture | varchar(20) | YES  |     | NULL    |       |
| Band    | varchar(50) | YES  | MUL | NULL    |       |
| Genre   | varchar(20) | YES  |     | NULL    |       |
+---------+-------------+------+-----+---------+-------+
4 rows in set (0.01 sec)


create table Album (Title varchar(50), Album_Pic varchar(20), No_of_Tracks int, Name varchar(50), foreign key(Name) references Artist(Name) ON DELETE CASCADE 
ON UPDATE CASCADE, primary key(Title, Name));

desc Album;
+-----------------+-------------+------+-----+---------+-------+
| Field           | Type        | Null | Key | Default | Extra |
+-----------------+-------------+------+-----+---------+-------+
| Title           | varchar(50) | NO   | PRI | NULL    |       |
| Album_Pic       | varchar(20) | YES  |     | NULL    |       |
| No_of_Tracks    | int(11)     | YES  |     | NULL    |       |
| Name            | varchar(50) | NO   | PRI | NULL    |       |
+-----------------+-------------+------+-----+---------+-------+
4 rows in set (0.14 sec)


create table Tracks (Track_Name varchar(50), Lyrics MEDIUMTEXT, Youtube_Link varchar(100), Name varchar(50), foreign key(Name) references Artist(Name) ON DELETE 
CASCADE ON UPDATE CASCADE, Title varchar(50), foreign key(Title) references Album(Title) ON DELETE CASCADE ON UPDATE CASCADE, primary key(Track_Name, Name, Title));

desc Tracks;
+--------------+--------------+------+-----+---------+-------+
| Field        | Type         | Null | Key | Default | Extra |
+--------------+--------------+------+-----+---------+-------+
| Track_Name   | varchar(50)  | NO   | PRI | NULL    |       |
| Lyrics       | mediumtext   | YES  |     | NULL    |       |
| Youtube_Link | varchar(100) | YES  |     | NULL    |       |
| Name         | varchar(50)  | NO   | PRI | NULL    |       |
| Title        | varchar(50)  | NO   | PRI | NULL    |       |
+--------------+--------------+------+-----+---------+-------+
5 rows in set (0.02 sec)


create table Users (Username varchar(20) primary key, Password varchar(50));
// SHA1('password') to hash

desc Users;
+----------+-------------+------+-----+---------+-------+
| Field    | Type        | Null | Key | Default | Extra |
+----------+-------------+------+-----+---------+-------+
| Username | varchar(20) | NO   | PRI | NULL    |       |
| Password | varchar(50) | YES  |     | NULL    |       |
+----------+-------------+------+-----+---------+-------+
2 rows in set (0.08 sec)


create table Playlist (PName varchar(20), Username varchar(20), foreign key(Username) references Users(Username) ON DELETE CASCADE ON
 UPDATE CASCADE, primary key(PName, Username));

desc Playlist;
+----------+-------------+------+-----+---------+-------+
| Field    | Type        | Null | Key | Default | Extra |
+----------+-------------+------+-----+---------+-------+
| PName    | varchar(20) | NO   | PRI | NULL    |       |
| Username | varchar(20) | NO   | PRI | NULL    |       |
+----------+-------------+------+-----+---------+-------+
2 rows in set (0.02 sec)


create table Playlist_Tracks (Name varchar(50), foreign key(Name) references Artist(Name) ON DELETE CASCADE ON UPDATE CASCADE, Title varchar(50),
 foreign key(Title) references Album(Title) ON DELETE CASCADE ON UPDATE CASCADE, Track_Name varchar(50), foreign key(Track_Name) references 
 Tracks(Track_Name) ON DELETE CASCADE ON UPDATE CASCADE, Username varchar(20), foreign key(Username) references Users(Username) ON DELETE CASCADE 
 ON UPDATE CASCADE, PName varchar(20), foreign key(PName) references Playlist(PName) ON DELETE CASCADE ON UPDATE CASCADE, primary key(Name, Title, 
 Track_Name, Username, PName));

desc Playlist_Tracks;
+------------+-------------+------+-----+---------+-------+
| Field      | Type        | Null | Key | Default | Extra |
+------------+-------------+------+-----+---------+-------+
| Name       | varchar(50) | NO   | PRI | NULL    |       |
| Title      | varchar(50) | NO   | PRI | NULL    |       |
| Track_Name | varchar(50) | NO   | PRI | NULL    |       |
| Username   | varchar(20) | NO   | PRI | NULL    |       |
| PName      | varchar(20) | NO   | PRI | NULL    |       |
+------------+-------------+------+-----+---------+-------+
5 rows in set (0.01 sec)




insert into Artist values ("Imagine Dragons", "id_band.jpg", NULL, "Pop rock");
insert into Artist values ("Dan Reynolds", "id_band.jpg", "Imagine Dragons", "Vocalist"), ("Wayne Sermon", "id_band.jpg", "Imagine Dragons", "Guitarist"), 
("Ben McKee", "id_band.jpg", "Imagine Dragons", "Bassist"), ("Daniel Platzman", "id_band.jpg", "Imagine Dragons", "Drummer");

insert into Artist values ("Queen", "queen_band.jpg", NULL, "Rock");
insert into Artist values ("Freddie Mercury", "queen_band.jpg", "Queen", "Vocalist"), ("Brian May", "queen_band.jpg", "Queen", "Guitarist"),
("John Deacon", "queen_band.jpg", "Queen", "Bassist"), ("Roger Taylor", "queen_band.jpg", "Queen", "Drummer");


insert into Album values ("Night Visions", "id_nv.jpg", 12, "Imagine Dragons");

insert into Album values ("Smoke + Mirrors", "id_sm.jpg", 13, "Imagine Dragons");

insert into Album values ("Best of Queen", "queen_best.jpg", 15, "Queen");


insert into Tracks values ("Radioactive", NULL, "https://www.youtube.com/watch?v=ktvTqknDobU", "Imagine Dragons", "Night Visions"), 
("Tiptoe", NULL, "https://www.youtube.com/watch?v=ajjj4pLnjz8", "Imagine Dragons", "Night Visions"),
("It's Time", NULL, "https://www.youtube.com/watch?v=sENM2wA_FTg", "Imagine Dragons", "Night Visions"),
("Demons", NULL, "https://www.youtube.com/watch?v=mWRsgZuwf_8", "Imagine Dragons", "Night Visions"),
("On Top Of The World", NULL, "https://www.youtube.com/watch?v=w5tWYmIOWGk", "Imagine Dragons", "Night Visions"),
("Amsterdam", NULL, "https://www.youtube.com/watch?v=TKtPXO5iEnA", "Imagine Dragons", "Night Visions"),
("Hear Me", NULL, "https://www.youtube.com/watch?v=1Yr683VLxes", "Imagine Dragons", "Night Visions"),
("Every Night", NULL, "https://www.youtube.com/watch?v=kuijhOvKyYg", "Imagine Dragons", "Night Visions"),
("Bleeding Out", NULL, "https://www.youtube.com/watch?v=gJEoxeW7JvQ", "Imagine Dragons", "Night Visions"),
("Underdog", NULL, "https://www.youtube.com/watch?v=JCUV43T7HZ0", "Imagine Dragons", "Night Visions"),
("Nothing Left To Say", NULL, "https://www.youtube.com/watch?v=Bn7eYibzmTs", "Imagine Dragons", "Night Visions"),
("Cha Ching", NULL, "https://www.youtube.com/watch?v=wO0ohGn-x3E", "Imagine Dragons", "Night Visions");

insert into Tracks values ("Shots", NULL, "https://www.youtube.com/watch?v=qQrgto184Tk", "Imagine Dragons", "Smoke + Mirrors"), 
("Gold", NULL, "https://www.youtube.com/watch?v=Rl3ELiPXFRo", "Imagine Dragons", "Smoke + Mirrors"),
("Smoke and Mirrors", NULL, "https://www.youtube.com/watch?v=49tGK1sC0vs", "Imagine Dragons", "Smoke + Mirrors"),
("I'm So Sorry", NULL, "https://www.youtube.com/watch?v=8dWDD8P71Is", "Imagine Dragons", "Smoke + Mirrors"),
("I Bet My Life", NULL, "https://www.youtube.com/watch?v=4ht80uzIhNs", "Imagine Dragons", "Smoke + Mirrors"),
("Polaroid", NULL, "https://www.youtube.com/watch?v=wmjyO-r1OhA", "Imagine Dragons", "Smoke + Mirrors"),
("Friction", NULL, "https://www.youtube.com/watch?v=o0aoh363PI4s", "Imagine Dragons", "Smoke + Mirrors"),
("It Comes Back to You", NULL, "https://www.youtube.com/watch?v=xKkkIxSQ9wE", "Imagine Dragons", "Smoke + Mirrors"),
("Dream", NULL, "https://www.youtube.com/watch?v=ZCSX3mM6940", "Imagine Dragons", "Smoke + Mirrors"),
("Trouble", NULL, "https://www.youtube.com/watch?v=k4l5SLs5u8A", "Imagine Dragons", "Smoke + Mirrors"),
("Summer", NULL, "https://www.youtube.com/watch?v=kTsbz5fW8-M", "Imagine Dragons", "Smoke + Mirrors"),
("Hopeless Opus", NULL, "https://www.youtube.com/watch?v=BoVKJq5Qvxs", "Imagine Dragons", "Smoke + Mirrors"),
("The Fall", NULL, "https://www.youtube.com/watch?v=8MWglxkw1y4", "Imagine Dragons", "Smoke + Mirrors");

insert into Tracks values ("We Will Rock You", NULL, "https://www.youtube.com/watch?v=-tJYN-eG1zk", "Queen", "Best of Queen"), 
("We Are The Champions", NULL, "https://www.youtube.com/watch?v=04854XqcfCY", "Queen", "Best of Queen"),
("Radio Ga Ga", NULL, "https://www.youtube.com/watch?v=azdwsXLmrHE", "Queen", "Best of Queen"),
("Another One Bites The Dust", NULL, "https://www.youtube.com/watch?v=rY0WxgSXdEE", "Queen", "Best of Queen"),
("I Want It All", NULL, "https://www.youtube.com/watch?v=hFDcoX7s6rE", "Queen", "Best of Queen"),
("Crazy Little Thing Called Love", NULL, "https://www.youtube.com/watch?v=zO6D_BAuYCI", "Queen", "Best of Queen"),
("A Kind Of Magic", NULL, "https://www.youtube.com/watch?v=0p_1QSUsbsM", "Queen", "Best of Queen"),
("Under Pressure", NULL, "https://www.youtube.com/watch?v=a01QQZyl-_I", "Queen", "Best of Queen"),
("Don't Stop Me Now", NULL, "https://www.youtube.com/watch?v=HgzGwKwLmgM", "Queen", "Best of Queen"),
("Killer Queen", NULL, "https://www.youtube.com/watch?v=2ZBtPf7FOoM", "Queen", "Best of Queen"),
("Bohemian Rhapsody", NULL, "https://www.youtube.com/watch?v=fJ9rUzIMcZQ", "Queen", "Best of Queen"),
("I Want To Break Free", NULL, "https://www.youtube.com/watch?v=f4Mc-NYPHaQ", "Queen", "Best of Queen");


PROCEDURE :

delimiter //
 create PROCEDURE proc_track(IN mtitle varchar(50), IN mname varchar(50))
    begin
    declare count int;
    declare cur1 cursor for select count(*) from Tracks where Name = mname and Title = mtitle;
    open cur1;
    fetch cur1 into count;
    update Album set No_of_Tracks = count where Name = mname and Title = mtitle;
    close cur1;
    end;//
delimiter ;


TRIGGER :

create TRIGGER calc_track after insert on Tracks for each row CALL proc_track(new.Title, new.Name);





select * from artist;
+--------------------+----------------+-----------------+-----------+
| Name               | Picture        | Band            | Genre     |
+--------------------+----------------+-----------------+-----------+
| Ben McKee          | id_band.jpg    | Imagine Dragons | Bassist   |
| Brad Delson        | lp_band.jpg    | Linkin Park     | Guitarist |
| Brian May          | queen_band.jpg | Queen           | Guitarist |
| Chester Bennington | lp_band.jpg    | Linkin Park     | Vocalist  |
| Dan Reynolds       | id_band.jpg    | Imagine Dragons | Vocalist  |
| Daniel Platzman    | id_band.jpg    | Imagine Dragons | Drummer   |
| Dave Farrell       | lp_band.jpg    | Linkin Park     | Bassist   |
| Freddie Mercury    | queen_band.jpg | Queen           | Vocalist  |
| Imagine Dragons    | id_band.jpg    | NULL            | Pop rock  |
| John Deacon        | queen_band.jpg | Queen           | Bassist   |
| Linkin Park        | lp_band.jpg    | NULL            | Rock      |
| Queen              | queen_band.jpg | NULL            | Rock      |
| Rob Bourdon        | lp_band.jpg    | Linkin Park     | Drummer   |
| Roger Taylor       | queen_band.jpg | Queen           | Drummer   |
| Wayne Sermon       | id_band.jpg    | Imagine Dragons | Guitarist |
+--------------------+----------------+-----------------+-----------+

select * from album;
+---------------------+----------------+--------------+-----------------+
| Title               | Album_Pic      | No_of_Tracks | Name            |
+---------------------+----------------+--------------+-----------------+
| Best of Linkin Park | lp_best.jpg    |            1 | Linkin Park     |
| Best of Queen       | queen_best.jpg |           12 | Queen           |
| Night Visions       | id_nv.jpg      |           12 | Imagine Dragons |
| Smoke and Mirrors   | id_sm.jpg      |           13 | Imagine Dragons |
+---------------------+----------------+--------------+-----------------+

select * from tracks;
+--------------------------------+--------+--------------------------------------------+-----------------+---------------------+
| Track_Name                     | Lyrics | Youtube_Link                               | Name            | Title               |
+--------------------------------+--------+--------------------------------------------+-----------------+---------------------+
| A Kind Of Magic                | NULL   | https://www.youtube.com/embed/0p_1QSUsbsM  | Queen           | Best of Queen       |
| Amsterdam                      | NULL   | https://www.youtube.com/embed/TKtPXO5iEnA  | Imagine Dragons | Night Visions       |
| Another One Bites The Dust     | NULL   | https://www.youtube.com/embed/rY0WxgSXdEE  | Queen           | Best of Queen       |
| Bleeding Out                   | NULL   | https://www.youtube.com/embed/gJEoxeW7JvQ  | Imagine Dragons | Night Visions       |
| Bohemian Rhapsody              | NULL   | https://www.youtube.com/embed/fJ9rUzIMcZQ  | Queen           | Best of Queen       |
| Cha Ching                      | NULL   | https://www.youtube.com/embed/wO0ohGn-x3E  | Imagine Dragons | Night Visions       |
| Crazy Little Thing Called Love | NULL   | https://www.youtube.com/embed/zO6D_BAuYCI  | Queen           | Best of Queen       |
| Demons                         | NULL   | https://www.youtube.com/embed/mWRsgZuwf_8  | Imagine Dragons | Night Visions       |
| Dont Stop Me Now               | NULL   | https://www.youtube.com/embed/HgzGwKwLmgM  | Queen           | Best of Queen       |
| Dream                          | NULL   | https://www.youtube.com/embed/ZCSX3mM6940  | Imagine Dragons | Smoke and Mirrors   |
| Every Night                    | NULL   | https://www.youtube.com/embed/kuijhOvKyYg  | Imagine Dragons | Night Visions       |
| Friction                       | NULL   | https://www.youtube.com/embed/o0aoh363PI4s | Imagine Dragons | Smoke and Mirrors   |
| Gold                           | NULL   | https://www.youtube.com/embed/Rl3ELiPXFRo  | Imagine Dragons | Smoke and Mirrors   |
| Hear Me                        | NULL   | https://www.youtube.com/embed/1Yr683VLxes  | Imagine Dragons | Night Visions       |
| Hopeless Opus                  | NULL   | https://www.youtube.com/embed/BoVKJq5Qvxs  | Imagine Dragons | Smoke and Mirrors   |
| I Bet My Life                  | NULL   | https://www.youtube.com/embed/4ht80uzIhNs  | Imagine Dragons | Smoke and Mirrors   |
| I Want It All                  | NULL   | https://www.youtube.com/embed/hFDcoX7s6rE  | Queen           | Best of Queen       |
| I Want To Break Free           | NULL   | https://www.youtube.com/embed/f4Mc-NYPHaQ  | Queen           | Best of Queen       |
| Im So Sorry                    | NULL   | https://www.youtube.com/embed/8dWDD8P71Is  | Imagine Dragons | Smoke and Mirrors   |
| In The End                     | NULL   | https://www.youtube.com/embed/eVTXPUF4Oz4  | Linkin Park     | Best of Linkin Park |
| It Comes Back to You           | NULL   | https://www.youtube.com/embed/xKkkIxSQ9wE  | Imagine Dragons | Smoke and Mirrors   |
| Its Time                       | NULL   | https://www.youtube.com/embed/sENM2wA_FTg  | Imagine Dragons | Night Visions       |
| Killer Queen                   | NULL   | https://www.youtube.com/embed/2ZBtPf7FOoM  | Queen           | Best of Queen       |
| Nothing Left To Say            | NULL   | https://www.youtube.com/embed/Bn7eYibzmTs  | Imagine Dragons | Night Visions       |
| On Top Of The World            | NULL   | https://www.youtube.com/embed/w5tWYmIOWGk  | Imagine Dragons | Night Visions       |
| Polaroid                       | NULL   | https://www.youtube.com/embed/wmjyO-r1OhA  | Imagine Dragons | Smoke and Mirrors   |
| Radio Ga Ga                    | NULL   | https://www.youtube.com/embed/azdwsXLmrHE  | Queen           | Best of Queen       |
| Radioactive                    | NULL   | https://www.youtube.com/embed/ktvTqknDobU  | Imagine Dragons | Night Visions       |
| Shots                          | NULL   | https://www.youtube.com/embed/qQrgto184Tk  | Imagine Dragons | Smoke and Mirrors   |
| Smoke and Mirrors              | NULL   | https://www.youtube.com/embed/49tGK1sC0vs  | Imagine Dragons | Smoke and Mirrors   |
| Summer                         | NULL   | https://www.youtube.com/embed/kTsbz5fW8-M  | Imagine Dragons | Smoke and Mirrors   |
| The Fall                       | NULL   | https://www.youtube.com/embed/8MWglxkw1y4  | Imagine Dragons | Smoke and Mirrors   |
| Tiptoe                         | NULL   | https://www.youtube.com/embed/ajjj4pLnjz8  | Imagine Dragons | Night Visions       |
| Trouble                        | NULL   | https://www.youtube.com/embed/k4l5SLs5u8A  | Imagine Dragons | Smoke and Mirrors   |
| Under Pressure                 | NULL   | https://www.youtube.com/embed/a01QQZyl-_I  | Queen           | Best of Queen       |
| Underdog                       | NULL   | https://www.youtube.com/embed/JCUV43T7HZ0  | Imagine Dragons | Night Visions       |
| We Are The Champions           | NULL   | https://www.youtube.com/embed/04854XqcfCY  | Queen           | Best of Queen       |
| We Will Rock You               | NULL   | https://www.youtube.com/embed/-tJYN-eG1zk  | Queen           | Best of Queen       |
+--------------------------------+--------+--------------------------------------------+-----------------+---------------------+

select * from users;
+----------+------------------------------------------+
| Username | Password                                 |
+----------+------------------------------------------+
| karthik  | d3cb830c70d695c0f602cdd529a213f9fa6d963d |
| krishna  | 5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8 |
| upbeat   | a58902a53a8417fbaa5f5abfbb4f08aafde90306 |
+----------+------------------------------------------+

select * from playlist;
+---------+----------+
| PName   | Username |
+---------+----------+
| music   | krishna  |
| shuffle | karthik  |
| upbeat  | karthik  |
+---------+----------+

select * from playlist_tracks;
+-----------------+---------------+----------------------------+----------+---------+
| Name            | Title         | Track_Name                 | Username | PName   |
+-----------------+---------------+----------------------------+----------+---------+
| Imagine Dragons | Night Visions | Demons                     | karthik  | upbeat  |
| Imagine Dragons | Night Visions | Radioactive                | karthik  | shuffle |
| Queen           | Best of Queen | A Kind Of Magic            | karthik  | shuffle |
| Queen           | Best of Queen | Another One Bites The Dust | karthik  | upbeat  |
| Queen           | Best of Queen | Bohemian Rhapsody          | karthik  | upbeat  |
| Queen           | Best of Queen | Killer Queen               | karthik  | upbeat  |
| Queen           | Best of Queen | Killer Queen               | krishna  | music   |
| Queen           | Best of Queen | Radio Ga Ga                | karthik  | shuffle |
+-----------------+---------------+----------------------------+----------+---------+
# Moment5.1 - Skapa REST-webbtjänst

I uppgiften har en REST-webbtjänst skapats för att hantera en lista med kurser. Dessa kurser sparas i JSON-format.

**Skapa tabell i databas:**

CREATE TABLE IF NOT EXISTS `courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` char(6) NOT NULL,
  `name` varchar(52) NOT NULL,
  `progression` char(1) NOT NULL,
  `courseplan` varchar(152) NULL DEFAULT NULL,
  `added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

Curl requests:
* GET: curl -i -X GET http://studenter.miun.se/~maed1801/dt173g/moment5-1/read.php/course
* GET (id): curl -i -X GET http://studenter.miun.se/~maed1801/dt173g/moment5-1/read.php/course/5
* POST: curl -i -X POST -d '{"code":"DT000x","name":"Kursnamn","progression":"a","courseplan":""}' http://studenter.miun.se/~maed1801/dt173g/moment5-1/read.php/course
* PUT (id): curl -i -X PUT -d '{"name":"test2","code":"test","progression":"a","courseplan":""}' http://studenter.miun.se/~maed1801/dt173g/moment5-1/read.php/course/16
* DELETE (id): curl -i -X DELETE http://studenter.miun.se/~maed1801/dt173g/moment5-1/read.php/course/16

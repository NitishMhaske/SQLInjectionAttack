DROP DATABASE sqlinject;
CREATE DATABASE sqlinject;
USE sqlinject;

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`ID`, `email`, `password`) VALUES
(1, 'alice@gmail.com', 'alice');
INSERT INTO `users` (`ID`, `email`, `password`) VALUES
(1, 'bob@gmail.com', 'bob');
INSERT INTO `users` (`ID`, `email`, `password`) VALUES
(1, 'caleb@gmail.com', 'caleb');


ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

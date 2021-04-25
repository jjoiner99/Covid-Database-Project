
CREATE TABLE `patient` (
  `Fname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Middle` text COLLATE utf8mb4_0900_as_ci,
  `Lname` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `ssn` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `age` int DEFAULT NULL,
  `Race` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `occupation_class` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `MHD` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `Phonenum` int DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `username` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `password` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci
) 


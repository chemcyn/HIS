CREATE TABLE patients (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  dob DATE NOT NULL,
  id_number INT NOT NULL,
  address VARCHAR(255) NOT NULL,
  county VARCHAR(255) NOT NULL,
  sub_county VARCHAR(255) NOT NULL,
  gender VARCHAR(255) NOT NULL,
  marital_status VARCHAR(255) NOT NULL,
  kin_name VARCHAR(255) NOT NULL,
  kin_dob DATE NOT NULL,
  kin_id_number INT NOT NULL,
  kin_gender VARCHAR(255) NOT NULL,
  kin_relationship VARCHAR(255) NOT NULL
);
/*Create Database*/
CREATE DATABASE bookstore;

/*Create Tables*/
CREATE TABLE bookInventory 
(
    book_id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    author VARCHAR(50) NOT NULL,
    price DECIMAL(5,2) NOT NULL,
    quantity INT NOT NULL
);

CREATE TABLE user_details
(
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    address VARCHAR(50) NOT NULL,
    card_name VARCHAR(50) NOT NULL,
    card_number INT NOT NULL,
    exp_date VARCHAR(50) NOT NULL,
    cvv INT NOT NULL

);

CREATE TABLE order_details(

    order_id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    book_id INT NOT NULL,
    order_quantity INT NOT NULL,
    total_price DECIMAL(5,2) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES user_details(user_id),
    FOREIGN KEY (book_id) REFERENCES bookInventory(book_id)
);
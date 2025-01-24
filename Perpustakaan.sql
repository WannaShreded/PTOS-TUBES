    CREATE DATABASE LibraryDB;

    USE LibraryDB;

CREATE TABLE Books (
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(255),
    genre VARCHAR(100),
    stock INT NOT NULL DEFAULT 0,
    status ENUM('Tersedia', 'Tidak Tersedia')  DEFAULT 'Tersedia',

);

CREATE TABLE members (
    member_id INT AUTO_INCREMENT PRIMARY KEY,
    member_name VARCHAR(100) NOT NULL,
    address VARCHAR(255) NOT NULL,
    birthdate DATE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    job VARCHAR(100) NOT NULL,
    gender ENUM('Laki-laki', 'Perempuan') NOT NULL,
    password VARCHAR(100) NOT NULL,
    username VARCHAR(100) NOT NULL
);

CREATE TABLE Loans (
    loan_id INT AUTO_INCREMENT PRIMARY KEY,
    member_id INT,
    book_id INT,
    checkout_date DATE NOT NULL,
    return_date DATE,
    FOREIGN KEY (member_id) REFERENCES Members(member_id),
    FOREIGN KEY (book_id) REFERENCES Books(book_id)
);

INSERT INTO books (book_id, title, author, genre, stock, status) VALUES
(1, 'Bintang', 'Tere Liye', 'Manga', 7, 'Tersedia'),
(2, 'Bumi', 'Tere Liye', 'Fantasy', 9, 'Tersedia'),
(3, 'Act of Money', 'Dinda Deliara', 'Romance, Enemies to Lovers, Family Issues', 25, 'Tersedia'),
(4, 'Make U Mine', 'Indah Aini', 'High School Romance', 3, 'Tersedia'),
(5, 'Naverra & Juru Diet', 'Devtnask', 'Romance, Fiction', 0, 'Tersedia'),
(6, 'Atomic Habits', 'James Clear', 'Self-help', 5, 'Tersedia'),
(7, 'The Midnight Library', 'Matt Haig', 'Fiction', 3, 'Tersedia'),
(8, 'Project Hail Mary', 'Andy Weir', 'Science Fiction', 6, 'Tersedia'),
(9, 'The Four Winds', 'Kristin Hannah', 'Historical Fiction', 0, 'Tersedia'),
(10, 'It Ends with Us', 'Colleen Hoover', 'Romance', 3, 'Tersedia'),
(11, 'Dare to Lead', 'Brené Brown', 'Leadership', 5, 'Tersedia'),
(12, 'Filosofi Teras', 'Henry Manampiring', 'Self-help', 10, 'Tersedia'),
(13, 'Laut Bercerita', 'Leila S. Chudori', 'Fiction', 9, 'Tersedia'),
(14, 'Pulang', 'Leila S. Chudori', 'Historical Fiction', 8, 'Tersedia'),
(15, 'Negeri 5 Menara', 'Ahmad Fuadi', 'Fiction', 7, 'Tersedia'),
(16, 'Selamat Tinggal', 'Tere Liye', 'Fiction', 5, 'Tersedia'),
(17, 'Hujan', 'Tere Liye', 'Science Fiction', 6, 'Tersedia'),
(18, 'Komet', 'Tere Liye', 'Fantasy', 9, 'Tersedia'),
(19, 'The Love Hypothesis', 'Ali Hazelwood', 'Romance', 8, 'Tersedia'),
(20, 'Rich Dad Poor Dad', 'Robert Kiyosaki', 'Finance', 7, 'Tersedia'),
(21, 'You Are a Badass', 'Jen Sincero', 'Self-help', 9, 'Tersedia'),
(22, 'The Alchemist', 'Paulo Coelho', 'Fiction', 10, 'Tersedia'),
(23, 'Harry Potter and the Philosophers Stone', 'J.K. Rowling', 'Fantasy', 6, 'Tersedia'),
(24, 'Percy Jackson and the Lightning Thief', 'Rick Riordan', 'Fantasy', 7, 'Tersedia'),
(25, 'Twilight', 'Stephenie Meyer', 'Romance', 5, 'Tersedia'),
(26, 'Eleanor Oliphant Is Completely Fine', 'Gail Honeyman', 'Fiction', 9, 'Tersedia'),
(27, 'Before We Were Strangers', 'Renée Carlino', 'Romance', 8, 'Tersedia'),
(28, 'Mans Search for Meaning', 'Viktor E. Frankl', 'Philosophy', 7, 'Tersedia'),
(29, '21 Lessons for the 21st Century', 'Yuval Noah Harari', 'History', 9, 'Tersedia'),
(30, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'History', 6, 'Tersedia'),
(31, 'Homo Deus: A Brief History of Tomorrow', 'Yuval Noah Harari', 'Philosophy', 8, 'Tersedia'),
(32, 'The Psychology of Money', 'Morgan Housel', 'Finance', 9, 'Tersedia'),
(33, 'Deep Work', 'Cal Newport', 'Self-help', 5, 'Tersedia'),
(34, 'Digital Minimalism', 'Cal Newport', 'Self-help', 7, 'Tersedia'),
(35, 'The Power of Now', 'Eckhart Tolle', 'Spirituality', 10, 'Tersedia');

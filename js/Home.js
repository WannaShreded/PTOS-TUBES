// Filename: client/src/pages/Home.js

import { useEffect, useState } from "react";

const Home = () => {
    const [books, setBooks] = useState([]);

    useEffect(() => {
        // Fetch available books from the database
        const fetchBooks = async () => {
            const response = await fetch("/api/books"); // Adjust the API endpoint as needed
            const data = await response.json();
            setBooks(data);
        };

        fetchBooks();
    }, []);

    return (
        <div>
            <h1>Daftar Buku Tersedia</h1>
            <ul>
                {books.map((book) => (
                    <li key={book.id}>
                        {book.title} - {book.author} (Stok: {book.stock})
                    </li>
                ))}
            </ul>
        </div>
    );
};

export default Home;


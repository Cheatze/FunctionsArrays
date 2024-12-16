<?php
$books = [
    "Harry Potter and the Philosopher's Stone" => [
        "author" => "J.K. Rowling",
        "isbn" => "978-0-7475-3269-9",
        "publisher" => "Bloomsbury",
        "publishing_date" => "26 June 1997",
        "pages" => 223
    ],
    "Harry Potter and the Chamber of Secrets" => [
        "author" => "J.K. Rowling",
        "isbn" => "978-0-7475-3849-3",
        "publisher" => "Bloomsbury",
        "publishing_date" => "2 July 1998",
        "pages" => 251
    ],
    "The Shining" => [
        "author" => "Stephen King",
        "isbn" => "978-0-385-12167-5",
        "publisher" => "Doubleday",
        "publishing_date" => "28 January 1977",
        "pages" => 447
    ],
    "It" => [
        "author" => "Stephen King",
        "isbn" => "978-0-670-81302-5",
        "publisher" => "Viking",
        "publishing_date" => "15 September 1986",
        "pages" => 1138
    ],
    "The Da Vinci Code" => [
        "author" => "Dan Brown",
        "isbn" => "978-0-385-50420-8",
        "publisher" => "Doubleday",
        "publishing_date" => "18 March 2003",
        "pages" => 689
    ],
    "Angels & Demons" => [
        "author" => "Dan Brown",
        "isbn" => "978-0-671-02735-4",
        "publisher" => "Pocket Books",
        "publishing_date" => "1 May 2000",
        "pages" => 616
    ]
];
$authors = ["J.K. Rowling", "Stephen King", "Dan Brown", "Bobby"];

/**
 * Displays all the authors lets you pick one by index and returns that author
 * @param mixed $authors
 * @return mixed
 */
function pickAuthor($authors)
{
    do {
        foreach ($authors as $key => $author) {
            echo $key . ' ' . $author . "\n";
        }
        $authorIndex = readline("Choose an author by index number: ");
        if (array_key_exists($authorIndex, $authors)) {
            $checker = true;
        } else {
            echo "That author index does not exist" . "\n";
        }
    } while ($checker == false);

    return $authors[$authorIndex];
}

/**
 * Loops through given array of books and desplays titles and details
 * @param mixed $books
 * @return void
 */
function bookLoop($books)
{
    foreach ($books as $title => $details) {
        echo "Title: $title\n";
        echo "Author: " . $details['author'] . ", ISBN: " . $details['isbn'] . ", Publisher: " . $details['publisher'] . ", Publishing Date: " . $details['publishing_date'] . ", Pages: " . $details['pages'] . "\n\n";
    }
}


/**
 *Function to add a book to the $books array
 *
 * @return void
 */
function addBook()
{
    global $authors;

    $chosenAuthor = pickAuthor($authors);

    $bookTitle = readline("Enter the title: ");
    $bookNumber = readline("Enter the ISBN: ");
    $publisher = readline("Enter the publisher: ");
    $publicationDate = readline("Enter the publication date: ");
    $pageCount = readline("Enter the page count: ");

    $newBookArr = ["author" => $chosenAuthor, "isbn" => $bookNumber, "publisher" => $publisher, "publishing_date" => $publicationDate, "pages" => $pageCount];
    global $books;
    $books[$bookTitle] = $newBookArr;
    echo "$bookTitle has been added. \n";
}

/**
 * Function to remove a book from the $books array
 * @return void
 */
function removeBook()
{
    global $books;
    do {
        $titles = array_keys($books);
        foreach ($titles as $key => $title) {
            echo $key . ' ' . $title . "\n";
        }
        $removeBookindex = readline("Enter the index of the title you want to remove: ");
        $removeBook = $titles[$removeBookindex];
        if (array_key_exists($removeBook, $books) == false) {
            echo "That book does not exist or you spelled it wrong. " . "\n";
            continue;
        }
        $afirmation = readline('Are you sure you want to remove ' . $removeBook . '? Yes or No: ');
        $afirmation = strtolower($afirmation);
        if ($afirmation == 'yes') {
            break;
        } elseif ($afirmation == 'no') {
            return;
        }
    } while (true);
    unset($books[$removeBook]);
    echo "$removeBook removed \n";
}

/**
 * Function to show all books
 * @return void
 */
function showAllBooks()
{
    global $books;
    if (empty($books)) {
        echo "There are no books in the array.";
    } else {
        bookLoop($books);
    }
}

/**
 * Function to show all books of a certain author
 * @return void
 */
function showAuthorBooks()
{
    global $authors;
    global $books;

    $chosenAuthor = pickAuthor($authors);

    $filteredBooks = array_filter($books, function ($details) use ($chosenAuthor) {
        return $details['author'] === $chosenAuthor;
    });

    if (empty($filteredBooks)) {
        echo "There are no books by that author \n";
    } else {
        bookLoop($filteredBooks);
    }
}


/**
 *Main loop of the program from where you can choose what to do
 *And where you return to the beginning after doing something
 */
while (true) {
    echo "What do you want to do? \n";
    echo "1: add a book \n";
    echo "2: Remove a book \n";
    echo "3: Show all books \n";
    echo "4: Show all books of a certain author \n";
    echo "5: exit \n";
    $choice = readline("Choose by number: ");
    switch ($choice) {
        case "1":
            addBook();
            break;
        case "2":
            removeBook();
            break;
        case "3":
            showAllBooks();
            break;
        case "4":
            showAuthorBooks();
            break;
        case "5":
            exit();
    }
}
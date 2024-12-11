<?php
#$books = [];
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


#Function to add a book to the $books array
function addBook()
{
    #echo "Choose an author by index number:" . "\n";
    global $authors;
    foreach ($authors as $key => $author) {
        echo $key . ' ' . $author . "\n";
    }
    #$authorIndex = readline(": ");

    $checker = false;
    while ($checker == false) {
        $authorIndex = readline("Choose an author by index number: ");
        if (array_key_exists($authorIndex, $authors)) {
            #echo "Yay!";
            $checker = true;
        } else {
            echo "That author index does not exist" . "\n";
        }

    }

    $chosenAuthor = $authors[$authorIndex];

    $bookTitle = readline("Enter the title: ");
    $bookNumber = readline("Enter the ISBN: ");
    $publisher = readline("Enter the publisher: ");
    $publicationDate = readline("Enter the publication date: ");
    $pageCount = readline("Enter the page count: ");

    #echo "New book: " . $chosenAuthor . ' ' . $bookTitle . ' ' . $publicationDate . ' ' . $bookNumber;
    $newBookArr = ["author" => $chosenAuthor, "isbn" => $bookNumber, "publisher" => $publisher, "publishing_date" => $publicationDate, "pages" => $pageCount];
    global $books;
    $books[$bookTitle][] = $newBookArr;
    echo "$bookTitle has been added. \n";
}

#Function to remove a book from the $books
function removeBook()
{
    global $books;
    $checker = false;
    $noRemove = false;
    do {
        foreach ($books as $title => $details) {
            echo "Title: $title\n";
            echo "Author: " . $details['author'] . ", ISBN: " . $details['isbn'] . ", Publisher: " . $details['publisher'] . ", Publishing Date: " . $details['publishing_date'] . ", Pages: " . $details['pages'] . "\n\n";
        }
        $removeBook = readline("Enter the title you want to remove: ");
        if (array_key_exists($removeBook, $books) == false) {
            echo "That book does not exist or you spelled it wrong. " . "\n";
            continue;
        }
        $afirmation = readline('Are you sure you want to remove ' . $removeBook . '? Yes or No: ');
        if ($afirmation == 'Yes' || $afirmation == 'yes') {
            $checker = true;
        } elseif ($afirmation == 'No' || $afirmation == 'no') {
            return;
        }
    } while ($checker == false);
    unset($books[$removeBook]);
    echo "$removeBook removed \n";
}

#Function to show all books
function showAllBooks()
{
    global $books;
    if (empty($books)) {
        echo "There are no books in the array.";
    } else {
        foreach ($books as $title => $details) {
            echo "Title: $title\n";
            echo "Author: " . $details['author'] . ", ISBN: " . $details['isbn'] . ", Publisher: " . $details['publisher'] . ", Publishing Date: " . $details['publishing_date'] . ", Pages: " . $details['pages'] . "\n\n";
        }
    }
}

#Function to show all books of a certain author
function showAuthorBooks()
{
    global $authors;
    global $books;
    $checker = false;
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
    $chosenAuthor = $authors[$authorIndex];
    foreach ($books as $title => $details) {
        if (in_array($chosenAuthor, $details)) {
            echo "Title: $title\n";
            echo "Author: " . $details['author'] . ", ISBN: " . $details['isbn'] . ", Publisher: " . $details['publisher'] . ", Publishing Date: " . $details['publishing_date'] . ", Pages: " . $details['pages'] . "\n\n";
        } else {
            echo "There are no books by that author \n";
            break;
        }
    }

}

#removeBook();
#addBook();
#showAllBooks();
#showAuthorBooks();
#var_dump($books);

$session = true;
while ($session == true) {
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
            $session = false;
    }
}
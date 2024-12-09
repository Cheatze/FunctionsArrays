<?php
$books = [];
$authors = ["J.K. Rowling", "Stephen King", "Dan Brown"];


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

    echo "New book: " . $chosenAuthor . ' ' . $bookTitle . ' ' . $publicationDate . ' ' . $bookNumber;
    $newBookArr = [$bookTitle, $bookNumber, $publisher, $publicationDate, $pageCount];
    global $books;
    $books[$chosenAuthor][] = $newBookArr;
}

function removeBook()
{
    echo "";
}

addBook();
var_dump($books);
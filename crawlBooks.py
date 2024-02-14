import requests 
from bs4 import BeautifulSoup
import json
import time 
import os
import datetime

def crawl_books(genres):
    shelf_url = 'https://www.goodreads.com/shelf/show/'
    books_data = []
    index = 1

    # Alle Bücher allen Genres
    for genre in genres:
        url = shelf_url + genre
        response = requests.get(url)
        
        soup = BeautifulSoup(response.text, 'html.parser')
        books = soup.find_all('div', class_='elementList')[:50]

        # Loop durch alle Bücher
        for book in books:
                        book_url = 'https://www.goodreads.com' + book.find('a', class_='bookTitle')['href']

                        book_response = requests.get(book_url)
                        book_soup = BeautifulSoup(book_response.text, 'html.parser')

                        # Buchtitel 
                        title_elem = book_soup.find('h1', attrs={'data-testid': 'bookTitle'})
                        title = title_elem.text.strip() if title_elem else 'N/A'
                        
                        # Authoren
                        author_elem = book_soup.find('div', class_='BookPageMetadataSection__contributor') 
                        if author_elem:
                            authors = [author.text.strip() for author in author_elem.find_all('span', class_='ContributorLink__name', attrs={'data-testid': 'name'})]
                            
                        else:
                            authors = ['N/A']

                        # Beschreibung
                        desc_elem = book_soup.find('div', class_='BookPageMetadataSection__description', attrs={'data-testid': 'description'}) 
                        desc = desc_elem.text.strip() if desc_elem else 'N/A'

                        # genres
                        genre_elem = book_soup.find('div', class_='BookPageMetadataSection__genres', attrs={'data-testid': 'genresList'}) 
                        if genre_elem:
                            genres = [genre.text.strip() for genre in genre_elem.find_all('span', class_='BookPageMetadataSection__genreButton')]
                        else:
                            genres = ['N/A']

                        # details
                        published = None
                        book_details = book_soup.find('div', class_='BookDetails')
                        if book_details:
                            published_year = book_details.find('p', attrs={'data-testid': 'publicationInfo'})
                            if published_year:
                                published = published_year.text.strip()
                            

                        book_id = str(index)
                        index += 1

                        # Daten-Liste
                        books_data.append({'id': book_id, 'title': title, 'authors': authors, 'description': desc, 'genres': genres, 'published': published, 'url': book_url})

                        cwd = os.getcwd()
                        json_file_path = os.path.join(cwd, 'books_data.json')
                        with open(json_file_path, 'w') as json_file:
                            json.dump(books_data, json_file, indent=4)


                        # Rate Limit umgehen
                        time.sleep(1)
    return books_data 

genres = [
'business', 'history', 'non-fiction', 
'philosophy', 'psychology', 'science',
'art', 'travel', 'theology', 'social-science', 
'sociology', 'economics', 'mathematics', 'music',
'law', 'roman', 'health', 'german-literature', 
'classics', 'biography', 'engineering', 'programming',
'computer-science', 'archaeology', 'art-history',
'finance', 'software', 'information-science', 
'library-science', 'neuroscience', 'personal-development',
'politics', 'productivity', 'read-for-college', 'read-for-school',
'research', 'robots', 'science-nature', 'teaching',
'technology'
]

books = crawl_books(genres)
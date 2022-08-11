import requests
from bs4 import BeautifulSoup


url = 'https://www.megabox.co.kr/movie-detail/trailer?rpstMovieNo='
movie_code = '22037300'
url += movie_code 
print(url)
response = requests.get(url)
html = response.text
soup = BeautifulSoup(html, 'html.parser')
previewes = soup.select('#videoTag > source')

f = open('./movie_preview.txt', 'w', encoding='utf-8')
for preview in previewes:
    print(previewes['src'])
    f.write(previewes['src'])
    f.write('\n')
f.close()




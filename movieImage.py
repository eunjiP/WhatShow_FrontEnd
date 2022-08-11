import requests
from bs4 import BeautifulSoup


url = 'https://movie.naver.com/movie/running/current.naver'
response = requests.get(url)
html = response.text
soup = BeautifulSoup(html, 'html.parser')
titles = soup.select('#content > div > div > div > ul > li > dl > dt > a')
images = soup.select('#content > div > div > div > ul > li > div > a > img')
#content > div.article > div > div.lst_wrap > ul > li:nth-child(1) > dl > dt > a
#content > div.article > div > div.lst_wrap > ul > li:nth-child(1) > div > a > img

f = open('./movie_image.txt', 'w', encoding='utf-8')
for image in images:
    f.write(image['src'])
    f.write('\t')
f.close()

f = open('./movie_img.txt', 'w', encoding='utf-8')
for title in titles:
    f.write(title.text)
    f.write('\t')
f.close()


# 아래는 실행 되는 것.

# from urllib.request import urlopen
# from bs4 import BeautifulSoup

# html = urlopen("https://news.naver.com/")

# bsObject = BeautifulSoup(html, "html.parser")

# #for link in bsObject.find_all('a'):
# #    print(link.text.strip(), link.get('href'))

# for link in bsObject.find_all('img'):
#     print(link.text.strip(), link.get('src'))